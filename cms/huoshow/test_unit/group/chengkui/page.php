<!DOCTYPE html>
<html>
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title> 火秀网_美女视频</title>
                <meta name="keywords" content="" />
        <meta name="description" content=",火秀网" />
        </head>
        <body>
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php");

$CurrentPage=isset($_GET['page'])?$_GET['page']:1;
	 
	 //die($CurrentPage);
       $myPage=new PagerSplit(1300,intval($CurrentPage),false,10);
       
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
?>
</body>
</html>