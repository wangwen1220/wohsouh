<?php

/*
 * PHP分页类
 */
class MyPagerSplit {
	private $pageSize = 10;
	private $pageIndex;
	private $totalNum;

	private $totalPagesCount;
	
	private $pageUrl;
	private static $_instance;
	
	private $mLinkType;
    private $mReturnVal;
	
	
	/**
	 * 构造函数
	 *
	 * @param unknown_type $p_totalNum
	 * @param unknown_type $p_pageIndex
	 * @param unknown_type $linkType 链接类型，有如下几种：
	 * 1，动态链接，这是默认的方式，此时$linkType==false
	 * 2,自定义，类似news-huoshow-param-{#page}.html,其中，{#page}系统会自动替换,$linkType=="news-huoshow-param-{#page}.html"
	 *          或者javascript:setHotpage(this,{#page}),$linkType=="javascript:setHotpage(this,{#page})"
	 * @param unknown_type $p_pageSize 每页记录数
	 * @param unknown_type $p_initNum  
	 */
	public function __construct($p_totalNum, $p_pageIndex, 
		 $p_pageSize = 10,$linkType=false,$p_initNum=2,$css="page.css") 
	{
		if (! isset ( $p_totalNum ) || !isset($p_pageIndex)) {
			die ( "pager initial error" );
		}
		
		$this->mLinkType = $linkType;
		$this->totalNum = $p_totalNum;
		$this->pageIndex = $p_pageIndex;
		$this->pageSize = $p_pageSize;
        $this->initNum=$p_initNum;
		$this->initMaxNum=$p_initMaxNum;
		$this->totalPagesCount= ceil($p_totalNum / $p_pageSize);
		$this->pageUrl=$this->_MygetPageUrl();
		$this->mReturnVal = "";
		 $this->_MyinitPagerLegal();
	}
	
	
  /**
	* 获取去除page部分的当前URL字符串
	*
	* @return String URL字符串
	*/
  private function _MygetPageUrl() {
  	if(empty($this->mLinkType))
  	{
  		$CurrentUrl = $_SERVER["REQUEST_URI"];
  		$arrUrl     = parse_url($CurrentUrl);
  		$urlQuery   = $arrUrl["query"];

  		if($urlQuery){
  			$urlQuery  = ereg_replace("(^|&)page=" . $this->pageIndex, "", $urlQuery);
  			$CurrentUrl = str_replace($arrUrl["query"], $urlQuery, $CurrentUrl);

  			if($urlQuery){
  				$CurrentUrl.="&page";
  			}
  			else $CurrentUrl.="page";

  		} else {
  			$CurrentUrl.="?page";
  		}
  	}
  	else 
  		$CurrentUrl = $this->mLinkType;
    return $CurrentUrl;
	
  }
  /*
   *设置页面参数合法性
   *@return void
  */
  private function _MyinitPagerLegal()
  {
	  if((!is_numeric($this->pageIndex)) ||  $this->pageIndex<1)
	  {
		  $this->pageIndex=1;
	  }elseif($this->pageIndex > $this->totalPagesCount)
	  {
		  $this->pageIndex=$this->totalPagesCount;
	  }
	  
	  
	  
  }
//$this->pageUrl}={$i}
//{$this->CurrentUrl}={$this->TotalPages}
	public function MyGetPagerContent($type="default") {  //$type 评论分页类型
		switch ($type){
			case "share":
				$str = "<div class='pagination pagination-normal' id='pager'>";
				break;
			case "sharepage":
				$str = "";
				break;
			case "album":
				$str = "<div class=\"pagination\">";
				break;
			case "default":
				$str = "<div id='pagination' class=\"pagination\">";
				break;
		}
		//$str = "<div id='pagination' class=\"pagination\">";
		//首页 上一页
		if($this->pageIndex==1)
		{
			$str .="<a href='javascript:void(0)' class='tips first-page' title='首页'>首页</a> "."\n";
			$str .="<a href='javascript:void(0)' class='tips' title='上一页'>上一页</a> "."\n"."\n";
		}else
		{
			if(empty($this->mLinkType))
			{
				$str .="<a href='{$this->pageUrl}=1' class='tips first-page' title='首页'>首页</a> "."\n";
				$str .="<a href='{$this->pageUrl}=".($this->pageIndex-1)."'class='tips' title='上一页'>上一页</a>"."\n"."\n";
				//$str .="<a href='{$this->pageUrl}=1' class='tips' title='1'>1</a> "."\n";
			}
			else 
			{
				$str .="<a href='".str_replace("{#page}",1,$this->pageUrl)."' class='tips first-page' title='首页'>首页</a> "."\n";
				$str .="<a href='".str_replace("{#page}",$this->pageIndex-1,$this->pageUrl)."'class='tips' title='上一页'>上一页</a>"."\n"."\n";
			}
		}
		
		$left = ($this->pageIndex-$this->initNum)<0?$this->pageIndex-1:$this->initNum/2-1;
		$right = ($this->pageIndex+($this->initNum-$left-1))<=$this->totalPagesCount?$this->initNum-$left-1:$this->totalPagesCount-$this->pageIndex;
		for($i=$this->pageIndex-$left;$i<=$this->pageIndex;$i++)
		{
			if($i==$this->pageIndex)
			{$currnt="class='current'";}
			else
			{$currnt="";}
			if(empty($this->mLinkType))
				$str .="<a href='{$this->pageUrl}={$i}'{$currnt}>$i</a>"."\n" ;
			else
				$str .="<a href='".str_replace("{#page}",$i,$this->pageUrl)."'{$currnt}>$i</a>"."\n" ;
		}
		for($i=$this->pageIndex+1;$i<=$this->pageIndex+$right;$i++)
		{
			if($i==$this->pageIndex)
			{$currnt="class='current'";}
			else
			{$currnt="";}
			if(empty($this->mLinkType))
				$str .="<a href='{$this->pageUrl}={$i}'{$currnt}>$i</a>"."\n" ;
			else
				$str .="<a href='".str_replace("{#page}",$i,$this->pageUrl)."'{$currnt}>$i</a>"."\n" ;
		}
		
		if($this->totalPagesCount-$this->pageIndex>$this->initNum/2 && $this->totalPagesCount>$this->initNum)
		{
			if($this->totalPagesCount==$this->pageIndex)
			{$currnt="class='current'";}
			else
			{$currnt="";}
			if(empty($this->mLinkType))
				$str .="<span class='dot'>...</span> <a href='{$this->pageUrl}={$this->totalPagesCount}'{$currnt}>{$this->totalPagesCount}</a>"."\n";
			else
				$str .="<span class='dot'>...</span> <a href='".str_replace("{#page}",$i,$this->pageUrl)."'{$currnt}>{$this->totalPagesCount}</a>"."\n";
		}
		
		 
		 
		 
		/*
		
		除首末后 页面分页逻辑结束
		
		*/
		
		//下一页 末页
		if($this->pageIndex==$this->totalPagesCount)
		{
			$str .="\n"."<a href='javascript:void(0)' class='tips' title='下一页'>下一页</a>"."\n" ;
			$str .="<a href='javascript:void(0)' class='tips last-page' title='末页'>末页</a>"."\n";

			
		}else
		{
			if(empty($this->mLinkType))
			{
				$str .="\n"."<a href='{$this->pageUrl}=".($this->pageIndex+1)."'class='tips' title='下一页'>下一页</a>"."\n";
				$str .="<a href='{$this->pageUrl}={$this->totalPagesCount}' class='tips last-page' title='末页'>末页</a> "."\n" ;
			}
			else 
			{
				$str .="\n"."<a href='".str_replace("{#page}",$this->pageIndex+1,$this->pageUrl)."'class='tips' title='下一页'>下一页</a>"."\n";
				$str .="<a href='".str_replace("{#page}",$this->totalPagesCount,$this->pageUrl)."' class='tips last-page' title='末页'>末页</a> "."\n" ;
			}
		}
		if($type=="sharepage"){
			$str .= "";
		}else{
			$str .= "</div>";
		}
		$this->mReturnVal .= $str;
		return $this->mReturnVal;
	}




/*
$CurrentPage=isset($_GET['page'])?$_GET['page']:1;
	 
	 //die($CurrentPage);
       $myPage=new PagerSplit(1300,intval($CurrentPage));
       
       $pageStr= $myPage->GetPagerContent();
	   echo $pageStr;
 
 
       $myPage=new PagerSplit(90,intval($CurrentPage));
       $pageStr= $myPage->GetPagerContent();
	   echo $pageStr;
	   
	   $myPage=new PagerSplit(90,intval($CurrentPage),"javascript:senddata(this,{#page})");
       $pageStr= $myPage->GetPagerContent();
	   echo $pageStr;
	   
	   $myPage=new PagerSplit(90,intval($CurrentPage),"news-3-4-{#page}.html");
       $pageStr= $myPage->GetPagerContent();
	   echo $pageStr;	 

*/

}
?>