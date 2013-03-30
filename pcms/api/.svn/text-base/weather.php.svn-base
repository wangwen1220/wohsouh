<?php 
//$act = @$_GET['act'];
/*$url = "http://m.weather.com.cn/data/101280601.html";
$content = @file_get_contents($url); 
$weather  = json_decode($content,true);
echo $weather['weatherinfo']['temp1'].$weather['weatherinfo']['img1'];*/
/*foreach ($weather['weatherinfo'] as $key => $values) {
	echo  "$key : $values<br>";
}*/
require_once $_SERVER['DOCUMENT_ROOT']."/phpcms/libs/functions/global.func.php";
require_once $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/function.core.php";
		//获取Ip
        //$UserIp = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
        //$UserIp = ($UserIp) ? $UserIp : $_SERVER["REMOTE_ADDR"];
        $UserIp = getIp();
         //获取IP地址        
        $url = "http://www.youdao.com/smartresult-xml/search.s?type=ip&q=".$UserIp; //
         //设置超时时间
        $context = stream_context_create(array(
     	'http' => array(
      	'timeout' => 3600 //超时时间，单位为秒
     	) 
		)); 
        $content = array_iconv(@file_get_contents($url,0,$context)); 
        $info = explode(" ",$content);
        
        $citynames = substr($info[3],-9,-3);
        $citycode = array (
        '北京' =>'101010100',
        '上海' =>'101020100',
        '天津' =>'101030100',
        '重庆' =>'101040100',
        '哈尔滨'=>'101050101',
        '长春' =>'101060101',
        '沈阳' =>'101070101',
        '呼和浩特'=>'101080101',
        '石家庄'=>'101090101',
        '太原' =>'101100101',
        '西安' =>'101110101',
        '济南' =>'101120101',
        '乌鲁木齐'=>'101130101',
        '拉萨'=>'101140101',
        '西宁'=>'101150101',
        '兰州'=>'101160101',
        '银川'=>'101170101',
        '郑州'=>'101180101',
        '南京'=>'101190101',
        '武汉'=>'101200101',
        '杭州'=>'101210101',
        '合肥'=>'101220101',
        '福州'=>'101230101',
        '南昌'=>'101240101',
        '长沙'=>'101250101',
        '贵阳'=>'101260101',
        '成都'=>'101270101',
        '昆明'=>'101290101',
        '海口'=>'101310101',
        '香港'=>'101320101',
        '南宁'=>'101300101',
        '广州'=>'101280101',
        '惠州'=>'101280301',
        '韶关'=>'101280201',
		'深圳' => '101280601',
		'珠海' =>'101280701',
		'汕头' =>'101280501',
		'中山' =>'101281701',
		'东莞'=>'101281601'
        );
        foreach ($citycode as $key => $values) {
        	if ($key == $citynames) {
        		$url = "http://m.weather.com.cn/data/".$values.".html";
        	}else {
        		$url = "http://m.weather.com.cn/data/101280601.html";
        	}
		
		}
        //$url = "http://m.weather.com.cn/data/101280601.html";
//		$date_data=date("Y年m月d日").'&nbsp;'.'星期';
//		if (date("w")==1)
//		$weekdata='一';
//		if(date("w")==2)
//		$weekdata='二';
//		if(date("w")==3)
//		$weekdata='三';
//		if(date("w")==4)
//		$weekdata='四';
//		if(date("w")==5)
//		$weekdata='五';
//		if(date("w")==6)
//		$weekdata='六';
//		if(date("w")==0)
//		$weekdata='日';
		
		$content = @file_get_contents($url,0,$context); 
		$weather  = json_decode($content,true);
		if ($content != '') {
		$weatherimg = '<img src="'.'/statics/images/'."weather/".$weather['weatherinfo']['img1'].".png".'"/>';
		$temperature =explode('~',$weather['weatherinfo']['temp1']);
		if ($temperature[0]>$temperature[1])
		{
			$newtemperature = '<span>'.$temperature[1].'~'.$temperature[0].'</span>';
		}else {
			$newtemperature = $temperature[0].'~'.$temperature[1];
		}
			echo $weatherimg.' '.'<span class="status">'.'<span>'.$weather['weatherinfo']['city'].'</span>'.$newtemperature.' '.$date_data.$weekdata.'</span>';
		}else {
			echo $date_data.$weekdata;
		}
?>