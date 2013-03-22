<?php
header("Content-type:text/html;charset=utf-8");

$dir_date=date('Y/m/d');//日期文件夹
$dir_name="data/avatar/pic/";//文件夹路径
function mkdirm($path) //取文件夹名
{ 
	if (!file_exists($path)) //判断是否存在
	{ 
		mkdirm(dirname($path)); //返回路径中的目录部分
		mkdir($path, 0777); //创建文件夹和权限
	}
} 
mkdirm($dir_name);//创建文件夹
$message = "http://www.huoshow.com/2012/0711/311627.shtml";//文章内容
//正则(这个还不是)
$reg = "/<img[^>]*src=\"(http:\/\/(.+)\/(.+)\.(jpg|gif|bmp|bnp))\"/isU";
//把抠出来的 img 地址存放到 $img_array 变量中
preg_match_all($reg, $message, $img_array, PREG_PATTERN_ORDER);
//过滤重复的图片
$img_array = array_unique($img_array);

foreach ($img_array as $img){
	//判断是否是自己网站上的 图片
	if('www.huoshow.com' != get_domain($img)){// 如果这个图片不是自己服务器上的
		//读取图片文件
		$Gimg = new GetImage();
		$Gimg->source = $img;
		$Gimg->save_to = $dir_name;
		$FILE =  $Gimg->download(); //图片移动到本地
		//保存到相册 得到图片保存的位置
		$img_path = pic_save($FILE,0,'');
		//文本路径替换
		$message = str_replace($img, $img_path, $message);
	}
}

//从url中获得域名
function get_domain($url){
    $pattern = "/[\w-]+\.(com|net|org|gov|cc|biz|info|cn)(\.(cn|hk))*/";
    preg_match($pattern, $url, $matches);
    if(count($matches) > 0) {
        return $matches[0];
    }else{
        $rs = parse_url($url);
        $main_url = $rs["host"];
        if(!strcmp(long2ip(sprintf("%u",ip2long($main_url))),$main_url)) {
            return $main_url;
        }else{
            $arr = explode(".",$main_url);
            $count=count($arr);
            $endArr = array("com","net","org","3322");//com.cn  net.cn 等情况
            if (in_array($arr[$count-2],$endArr)){
                $domain = $arr[$count-3].".".$arr[$count-2].".".$arr[$count-1];
            }else{
                $domain =  $arr[$count-2].".".$arr[$count-1];
            }
            return $domain;
        }// end if(!strcmp...)
    }// end if(count...)
}// end function

// 从远程吧图片载到服务器本地 的 类
class GetImage {

var $source;
var $save_to;
var $quality;

function download($method = 'curl') {
    $info = @GetImageSize($this->source);
    $mime = $info['mime'];
   
// What sort of image?
    $type = substr(strrchr($mime, '/'), 1);
    switch ($type){
        case 'jpeg':
            $image_create_func = 'ImageCreateFromJPEG';
            $image_save_func = 'ImageJPEG';
            $new_image_ext = 'jpg';
        
            // Best Quality: 100
            $quality = isSet($this->quality) ? $this->quality : 100;
            break;
        
        case 'png':
            $image_create_func = 'ImageCreateFromPNG';
            $image_save_func = 'ImagePNG';
            $new_image_ext = 'png';
        
            // Compression Level: from 0  (no compression) to 9
            $quality = isSet($this->quality) ? $this->quality : 0;
            break;
        
        case 'bmp':
            $image_create_func = 'ImageCreateFromBMP';
            $image_save_func = 'ImageBMP';
            $new_image_ext = 'bmp';
            break;
        
        case 'gif':
            $image_create_func = 'ImageCreateFromGIF';
            $image_save_func = 'ImageGIF';
            $new_image_ext = 'gif';

            break;
        
        case 'vnd.wap.wbmp':
            $image_create_func = 'ImageCreateFromWBMP';
            $image_save_func = 'ImageWBMP';
            $new_image_ext = 'bmp';
            break;
        
        case 'xbm':
            $image_create_func = 'ImageCreateFromXBM';
            $image_save_func = 'ImageXBM';
            $new_image_ext = 'xbm';
            break;
        
        default:
            $image_create_func = 'ImageCreateFromJPEG';
            $image_save_func = 'ImageJPEG';
            $new_image_ext = 'jpg';
    }
   
    if(isSet($this->set_extension)){
        $ext = strrchr($this->source, ".");
        $strlen = strlen($ext);
        $new_name = basename(substr($this->source, 0, -$strlen)).'.'.$new_image_ext;
    }else{
        $new_name = basename($this->source);
    }
   $save_to = $this->save_to."/blog_insert_temp_".time().mt_rand(1,99).".".$new_image_ext;
    //输出对象 组成跟$_FILE变量一样 得到后自己和平常图片上传处理一样了
    $img_info['name'] = basename($this->source);
    $img_info['type'] = $mime;
    $img_info['size'] = 1000;
    $img_info['tmp_name'] = $save_to;
    $img_info['error'] = 0;
        
    if($method == 'curl'){
        $save_image = $this->LoadImageCURL($save_to);
    }elseif($method == 'gd'){
        $img = $image_create_func($this->source);
   
            if(isSet($quality)){
               $save_image = $image_save_func($img, $save_to, $quality);
            }else{
               $save_image = $image_save_func($img, $save_to);
            }
           
    }
         return $img_info;
    }
   
    function LoadImageCURL($save_to){
        $ch = curl_init($this->source);
        $fp = fopen($save_to, "wb");
        
        // set URL and other appropriate options
        $options = array(CURLOPT_FILE => $fp,
                         CURLOPT_HEADER => 0,
                         CURLOPT_FOLLOWLOCATION => 1,
                         CURLOPT_TIMEOUT => 60); // 1 minute timeout (should be enough)
        
        curl_setopt_array($ch, $options);
        
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);

    }
}
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>测试</title>
</head>
<body>
</body>
</html>