<?php
/*
#分页类
*/

if(!defined('IN_DISCUZ')) exit('Access Denied');

class Pager
{
	protected $perNum = 10;#每页显示条数
	protected $count = 5;#每页显示的页码数
	protected $rootUrl = '';#当前页面的URL
	protected $url = '';#带页码标的URL
	
	protected $first = '首页';#页码标识首页
	protected $end = '尾页';#页码标识尾页
	protected $up = '上一页';#页码标识上一页
	protected $down = '下一页';#页码标识下一页
	protected $rand = '随机翻页';#页码标识下随机翻页
	
	protected $mod = 123;#显示样式有７种组合：１、２、３、１２、１３、２３、０
		
	
	#设置基本参数
	function set_page($perNum = 10, $count = 5, $url='')
	{	
		if($perNum <= 0) $perNum = 10;
		$this->perNum = $perNum;
		$this->count = $count;
		if(empty($url)) $url = $this->set_url();
		$this->rootUrl = $url;
		return true;
	}	
	
	#设置页码的链接地址	
	function set_url($page = 0)
	{
		if($page == 0){
			$this->url = current(explode('?', $_SERVER['REQUEST_URI']));
			return true;
		}
		$this->url = $this->rootUrl.'&page='.$page;
		return true;
	}
	
	/*
	#设置分页栏的样式
	$mod 1: 上一页、下一页　2: 首页、尾页　3:　随机翻页
	$img_src 上一页、下一页、首页、尾页小图片的路径，
	默认文件名：page_up.gif,page_down.gif,page_first.gif,page_end.gif,page_rand.gif
	*/
	function set_style($mod = 123, $img_src = '')
	{
		$this->mod = $mod;
		if($img_src !== ''){
			$this->first = '<img src="'.$img_src.'/page_first.gif">';
			$this->end = '<img src="'.$img_src.'/page_end.gif">';
			$this->up = '<img src="'.$img_src.'/page_up.gif">';
			$this->down = '<img src="'.$img_src.'/page_down.gif">';
			$this->rand = '<img src="'.$img_src.'/page_rand.gif">';
		}
		return true;		
	}
	
	function __construct()
	{
		$this->set_page();
	}
			
	/*
	#打印分页栏	
	$total 总条数
	$page 当前页码
	*/
	function print_page($total, $page = 1)
	{
		$ed = '&nbsp;';#页码之间的间距
		if($page <= 0) $page = 1;
		$half_num = floor($this->count / 2);#当前页码两侧的页码数
		if($half_num <= 0) $half_num = 2;
		
		if(!$total){
			$total = 0;
			$page = 0;
		}
		$barLeft = '共'.$total.'条'.$ed;#左侧	
		$total = ceil($total / $this->perNum);#总页数
		$barLeft .= $page .'/'. $total.$ed;

		$barLeft1 = $barLeft2 = '';
		$barRight = $barRight1 = $barRight2 = '';#右侧
		$pageBar = '<font id="pager_mid">';
		
		#左侧
		$this->set_url(1);
		if($page <= 1) $barLeft2 .= $ed.'<span>'.$this->first.'</span>'.$ed;
		else $barLeft2 .= $ed.'<a href="'.$this->url.'">'.$this->first.'</a>'.$ed;
		if($page > 1) $this->set_url($page - 1);
		$this->set_url($page - 1);
		if($page <= 1 || $page > $total) $barLeft1 .= $ed.'<span>'.$this->up.'</span>'.$ed;
		else $barLeft1 .= $ed.'<a href="'.$this->url.'">'.$this->up.'</a>'.$ed;
		
		#右侧
		if($page < $total) $this->set_url($page + 1); 
		else $this->set_url($total);
		if($page >= $total) $barRight1 .= $ed.'<span>'.$this->down.'</span>'.$ed;
		else $barRight1 .= $ed.'<a href="'.$this->url.'">'.$this->down.'</a>'.$ed;
		$this->set_url($total);
		if($page == $total) $barRight2 .= $ed.'<span>'.$this->end.'</span>';
		else $barRight2 .= $ed.'<a href="'.$this->url.'">'.$this->end.'</a>';
		
		#随机翻页
		$this->set_url(rand(1, $total));
		$barRight .= $ed.$ed.'<a href="'.$this->url.'">'.$this->rand.'</a>';
		
		#中间页码
		if($this->count > 0){
			if($page <= $half_num){
				for($i = 1; $i <= $half_num*2+1; $i++){
					if($i > $total) break;
					if($i == $page){
						$pageBar .= $ed.'<b>'.$i.'</b>'.$ed;
					}else{
						$this->set_url($i);
						$pageBar .= $ed.'<a href="'.$this->url.'">'.$i.'</a>'.$ed;
					}
				}
			} else {
				if($total <= $page + $half_num) $from = $total - $half_num * 2;
				else $from = $page - $half_num;
				if($from < 1) $from = 1;
				for($i = $from; $i <= $page + $half_num; $i++){
					if($i > $total) break;
					if($i == $page){
						$pageBar .= $ed.'<b>'.$i.'</b>'.$ed;
					}else{
						$this->set_url($i);
						$pageBar .= $ed.'<a href="'.$this->url.'">'.$i.'</a>'.$ed;
					}
				}
			}	
		}
		if($pageBar) $pageBar .= '</font>';
		#按模式返回不同样式
		if($this->mod == 1) return $barLeft.$barLeft1.$pageBar.$barRight1;
		if($this->mod == 2) return $barLeft.$barLeft2.$pageBar.$barRight2;
		if($this->mod == 3) return $barLeft.$pageBar.$barRight;
		if($this->mod == 12) return $barLeft.$barLeft2.$barLeft1.$pageBar.$barRight1.$barRight2;
		if($this->mod == 13) return $barLeft.$barLeft1.$pageBar.$barRight1.$barRight;
		if($this->mod == 23) return $barLeft.$barLeft2.$pageBar.$barRight2.$barRight;
		if($this->mod == 123) return $barLeft.$barLeft2.$barLeft1.$pageBar.$barRight1.$barRight2.$barRight;
		return $barLeft.$pageBar;	
	}
	
	
	
}
