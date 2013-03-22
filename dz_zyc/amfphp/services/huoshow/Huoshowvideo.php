<?php

include "Init.php";

class Huoshowvideo extends Init{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/**这个是用来测试请无视**/
	public function Test($arr)
	{
		if($arr[0]=="1")
		{
			$str = "http://res1.netwaymedia.com/huoshow/video/ff80808127092f4e0127094e5b10006b/20100226042314.flv";
		}
		return $str;
	}
	
	/**
	
	对了每页打开都会有一个视频
	
	而这个视频源是根据URL后面的参数来获取视频地址
	
	这个需要与JS交互才能获得数据  这个需要沟通下
	
	**/
	
	/**
	返回广告给我，广告很多所以最后写成一个
	数组，我在AS里可以用随机数显示这
	样每次暂定广告都不一样
	**/
	public function VideoLogo()
	{
		$array = array();
		//数组内容你们添加
		return $array;
	}
	
	/**
	这个函数我会给你们传入个参数
	第1个参数是这个视频的信息ID
	你们根据这个ID查询跟这个视频名字类似，参考用模糊搜索
	搜索出来的视频返回成数组返回给我
	还有最重要一个数组元素  要把搜索出来的视频的页面添加到数组里这样他们在点击列表时候就要可以到相应的页面
	**/
	public function VideoInit($arr)
	{
		$back = array('cur'=>array(), 'lastlist'=>array());
		$r = $this->selectInit("pre_video_list","myshowid",$arr[0]);
		$myshowInfo = @$r[0];
		
		if(is_array($myshowInfo))
		{
			if($myshowInfo['isrecord']==1){
				$url="http://res1.netwaymedia.com/saishi/".$myshowInfo['uid']."/".$myshowInfo['videourl'];
			}else{		
				$url="http://res1.netwaymedia.com/huoshow/video/".$myshowInfo['videourl'];
			}					
			$curMyshow['myshowid'] = $myshowInfo['myshowid'];
			$curMyshow['title'] = $myshowInfo['title'];
			$curMyshow['username'] = $myshowInfo['author'];
			$curMyshow['uid'] = $myshowInfo['uid'];
			$curMyshow['isfanart'] = $myshowInfo['isfanart'];
			$curMyshow['type'] = $myshowInfo['type'];
			$curMyshow['classify'] = $myshowInfo['classify'];
			$curMyshow['dateline'] = $myshowInfo['dateline'];
			$curMyshow['reply'] = $myshowInfo['reply'];
			$curMyshow['viewnum'] = $myshowInfo['viewnum'];
			$curMyshow['timelength'] = $myshowInfo['timelength'];
			$curMyshow['recommand'] = $myshowInfo['recommand'];
			$curMyshow['url'] = $url;
			$back['cur'] = $curMyshow;
			
			//最近8个myshow
			$lastMyshow = array();
			$sql = "SELECT * FROM pre_video_list WHERE uid=".$myshowInfo['uid']." AND auditstatus=2 AND myshowid != ".$myshowInfo['myshowid']." ORDER BY dateline DESC LIMIT 8";
			$arrMyshow = $this->select($sql);
			
			if (!empty($arrMyshow)) {
				foreach ($arrMyshow as $value) {
					if($value['isrecord']==1){
						$url="http://res1.netwaymedia.com/saishi/".$value['uid']."/".$value['videourl'];
					}else{		
						$url="http://res1.netwaymedia.com/huoshow/video/".$value['videourl'];
					}					
					$myshow['myshowid'] = $value['myshowid'];
					$myshow['title'] = $value['title'];
					$myshow['username'] = $value['author'];
					$myshow['uid'] = $value['uid'];
					$myshow['isfanart'] = $value['isfanart'];
					$myshow['type'] = $value['type'];
					$myshow['classify'] = $value['classify'];
					$myshow['dateline'] = $value['dateline'];
					$myshow['reply'] = $value['reply'];
					$myshow['viewnum'] = $value['viewnum'];
					$myshow['timelength'] = $value['timelength'];
					$myshow['recommand'] = $value['recommand'];
					$myshow['url'] = $url;
					
					$lastMyshow[] = $myshow;
					return serialize($lastMyshow);
				}
			}
			$back['lastlist'] = $lastMyshow;
		}
		
		return $back['cur']['url'];
	}

}
?>