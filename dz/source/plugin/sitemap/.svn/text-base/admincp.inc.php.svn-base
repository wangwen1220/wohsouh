<?php
/*
	sitemap for DISCUZ X 1.0正式版
	editor: monkee
	version:1.0
*/
$sitemap_lang=$scriptlang['sitemap'];
class sitemap_xml
{
	var $xml=array('');
	var $site='baidu';	//可选：baidu | google
	var $index=0;
	var $sitemap_file='sitemap.xml';
	var $size;
	var $sizet=0;
	function sitemap_xml($sitemap_file='sitemap.xml',$site='baidu')
	{
		$this->site=$site;
		$this->sitemap_file=$sitemap_file;
		$this->size=$site=='baidu'?1024*10240:1024*10240;
	}
	//地址，最后修改时间，更新频率，优先级
	
	function add_url($loc,$lastmod,$changefreq,$priority){
		static $size=0;
		//$this->sizet=$this->sizet==0?$this->size:$this->sizet;
		$size=$size==0?$this->size:$size;
		$str="<url><loc>".str_replace('&','&amp;',$loc)."</loc><lastmod>$lastmod</lastmod><changefreq>$changefreq</changefreq><priority>$priority</priority></url>";
		$this->xml[$this->index].=$str;
		if($size<102400){
			$this->index++;
			$size=$this->size;
			$this->xml[$this->index]='';
		}
		$size-=strlen($str);
	}
	function write(){
		//先写入各个INDEX
		for($i=0;$i<=$this->index;$i++){
			@file_put_contents($this->sitemap_file.'_'.$i.'.xml','<?xml version="1.0" encoding="UTF-8"?> <urlset '.($this->site=='google'?' xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"':'').'> '.$this->xml[$i].'</urlset>');
		}
		$this->write_index();
	}
	function write_index(){
		global $_G;
		$size=$this->size;
		$text='<?xml version="1.0" encoding="UTF-8"?>';
		$text.=($this->site=='google')?'<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">':'<sitemapindex>';
		for($i=0;$i<=$this->index && $size>102400;$i++){
			$str='<sitemap><loc>'.$_G['siteurl'].$this->sitemap_file.'_'.$i.'.xml</loc><lastmod>'.date('Y-m-d').'</lastmod></sitemap>';
			$text.=$str;
			$size-=strlen($str);
		}
		$text.='</sitemapindex>';
		return file_put_contents($this->sitemap_file,$text);
	}
	
}	
if(!$_G['gp_submit']){
	showtips($templatelang['sitemap']['sitemap_tips']);
	showformheader('plugins&operation=config&do='.$pluginid.'&identifier=sitemap&pmod=admincp');
	showtableheader();
	showtitle('生成sitemap');
	$varname = array('site', array(array('baidu',$sitemap_lang['baidu'],'1'),array('google',$sitemap_lang['google'],'1')), 'isfloat');
	showsetting('', $varname, '', 'omcheckbox');
	showsubmit('submit');
	showtablefooter();
	showformfooter();
}
else{
	if(is_array($_G['gp_site'])){
		foreach($_G['gp_site'] as $key=>$item){
			$ct[]=new sitemap_xml('sitemap_'.$key.'.xml',$key);
		}
		//nav板块更新
		$query=DB::query('SELECT id,parentid,url FROM '.DB::table('common_nav').' WHERE available=1');
		while($row=DB::fetch($query)){
			foreach($ct as $key=>$item){
				$ct[$key]->add_url($_G['siteurl'].$row['url'],date('Y-m-d'),'always','0.8');
			}
		}
		 
		//门户文章
		$query =DB::query("SELECT a.aid FROM ".DB::TABLE('portal_article_content')." a,".DB::table('portal_category')." c WHERE c.catid=a.cid AND c.closed=0 LIMIT 0,1000");
		while($row = DB::fetch($query)) {
			$row['url'] = 'article-'.$row['aid'].'-1.html';
			foreach($ct as $key => $item) {
				$ct[$key]->add_url($_G['siteurl'].$row['url'],date('Y-m-d'),'daily','0.6');
			}
		}
		/*广场板块
		$query=DB::query("SELECT fid,type,status FROM ".DB::table('forum_forum')." WHERE status='group' or status='forum'");
		while($row=DB::fetch($query)){
			$row['url']=$row['type'].'.php?';
			$row['url'].=($row['type']=='group')?'gid='.$row['fid']:(($row['status']==1)?'sid='.$row['fid']:'sgid='.$row['fid']);
			foreach($ct as $key=>$item){
				$ct[$key]->add_url($_G['siteurl'].$row['url'],date('Y-m-d'),'always','0.8');
			}
		}*/
		//广场帖子
		$query=DB::query('SELECT tid,lastpost FROM '.DB::table('forum_thread').' order by tid desc limit 0,100000');
		while($row=DB::fetch($query)){
			$row['url']='thread-'.$row['tid'].'-1-1.html';
			foreach($ct as $key=>$item){
				$ct[$key]->add_url($_G['siteurl'].$row['url'],date('Y-m-d',$row['lastpost']),'daily','0.6');
			}
		}
		//家园日志
		$query=DB::query('SELECT blogid,uid,dateline FROM '.DB::table('home_blog').' order by blogid desc limit 0,1000');
		while($row=DB::fetch($query)){
			$row['url']='home-space-uid-'.$row['uid'].'-do-blog-id-'.$row['blogid'].'.html';
			foreach($ct as $key=>$item){
				$ct[$key]->add_url($_G['siteurl'].$row['url'],date('Y-m-d',$row['lastpost']),'daily','0.6');
			}
		}
		foreach($ct as $item){
			$item->write();
		}
	}
	echo '<h3></h3><div class="infobox"><h4 class="infotitle2">'.$sitemap_lang['sitemap_update_success'].'</h4><p class="marginbot"><a href="admin.php?action=plugins&operation=config&do='.$pluginid.'&identifier=sitemap&pmod=admincp" class="lightlink">进入</a></p></div>';
}

?>
