<?php
defined('IN_PHPCMS') or exit('No permission resources.');

class MY_html extends html {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * 生成内容页
	 * @param  $file 文件地址
	 * @param  $data 数据
	 * @param  $array_merge 是否合并
	 * @param  $action 方法
	 * @param  $upgrade 是否是升级数据
	 */
	public function show($file, $data = '', $array_merge = 1,$action = 'add',$upgrade = 0) {
		if($upgrade) $file = '/'.ltrim($file,WEB_PATH);
		$allow_visitor = 1;
		$id = $data['id'];
		$_GET[id] = $id;
		//var_dump($id);die();
		if($array_merge) {
			$data = new_stripslashes($data);
			$data = array_merge($data['system'],$data['model']);
		}
		//通过rs获取原始值
		$rs = $data;
		if(isset($data['paginationtype'])) {
			$paginationtype = $data['paginationtype'];
			$maxcharperpage = $data['maxcharperpage'];
		} else {
			$paginationtype = 0;
		}
		$catid = $data['catid'];
		$CATEGORYS = $this->categorys;
		$CAT = $CATEGORYS[$catid];
		$CAT['setting'] = string2array($CAT['setting']);
		define('STYLE',$CAT['setting']['template_list']);

		//最顶级栏目ID
		$arrparentid = explode(',', $CAT['arrparentid']);
		$top_parentid = $arrparentid[1] ? $arrparentid[1] : $catid;
		//获取二级栏目ID
		$arrparentid2 = explode(',', $CATEGORYS[$catid][arrparentid]);
		$top2_parentid = $arrparentid2[2] ? $arrparentid2[2] : $catid;
		//$file = '/'.$file;
		//添加到发布点队列
		//当站点为非系统站点
		
		if($this->siteid!=1) {
			$site_dir = $this->sitelist[$this->siteid]['dirname'];
			$file = $this->html_root.'/'.$site_dir.$file;
		}
		
		$this->queue->add_queue($action,$file,$this->siteid);
		
		$modelid = $CAT['modelid'];
		require_once CACHE_MODEL_PATH.'content_output.class.php';
		$content_output = new content_output($modelid,$catid,$CATEGORYS);
		$output_data = $content_output->get($data);
		extract($output_data);
		if(module_exists('comment')) {
			$allow_comment = isset($allow_comment) ? $allow_comment : 1;
		} else {
			$allow_comment = 0;
		}
		$this->db = pc_base::load_model('content_model');
		$this->db->set_model($modelid);
		//上一页
		$previous_page = $this->db->get_one("`catid` = '$catid' AND `id`<'$id' AND `status`=99",'*','id DESC');
		//下一页
		$next_page = $this->db->get_one("`catid`= '$catid' AND `id`>'$id' AND `status`=99");
		
		if(empty($previous_page)) {
			$previous_page = array('title'=>L('first_page','','content'), 'thumb'=>IMG_PATH.'nopic_small.gif', 'url'=>'javascript:alert(\''.L('first_page','','content').'\');');
		}
		if(empty($next_page)) {
			$next_page = array('title'=>L('last_page','','content'), 'thumb'=>IMG_PATH.'nopic_small.gif', 'url'=>'javascript:alert(\''.L('last_page','','content').'\');');
		}
	
		$title = strip_tags($title);
		//SEO
		$seo_keywords = '';
		if(!empty($keywords)) $seo_keywords = implode(',',$keywords);
		$siteid = $this->siteid;
		$SEO = seo($siteid, $catid, $title, $description, $seo_keywords);
		
		$ishtml = 1;
		$template = $template ? $template : $CAT['setting']['show_template'];
		if($modelid==3)//如果是图片模型，则特殊处理
		{
			
			$pagenumber = count($pictureurls);
			$this->url = pc_base::load_app_class('url', 'content');
			for($i=1; $i<=$pagenumber; $i++)
			{
				$upgrade = $upgrade ? '/'.ltrim($file,WEB_PATH) : '';
				$pageurls[$i] = $this->url->show($id, $i, $catid, $data['inputtime'],'','','edit',$upgrade);
				//$pageurls[$i] = $this->url->show($id, $i, $catid, $r["inputtime"]);
			}
			if($pagenumber == 0)
			{
				$upgrade = $upgrade ? '/'.ltrim($file,WEB_PATH) : '';
				$pageurls[$i] = $this->url->show($id, $i, $catid, $data['inputtime'],'','','edit',$upgrade);
			}
			//$pages = content_pages($pagenumber,$page, $pageurls);
			//$this->db->table_name = $tablename;
			//上一个图集
			$previous_page = $this->db->get_one("`catid` = '$catid' AND `id`<'$id' AND `status`=99",'*','id DESC');
			//下一个图集
			$next_page = $this->db->get_one("`catid`= '$catid' AND `id`>'$id' AND `status`=99");
			$page=1;
			//如果没有组图，也要生成静态页，否则就是404
			/*
			if(empty($pageurls) || count($pageurls)==0)
			{
				$page = 1;
				$current_imgno = 0;
				$pre_img = ($page==1)?-1:$page-1;
				$next_img = ($page==$pagenumber)?-1:$page+1;
				$pagefile = $urls[1];
				if($this->siteid!=1) {
					$pagefile = $this->html_root.'/'.$site_dir.$pagefile;
				}
				$this->queue->add_queue($action,$pagefile,$this->siteid);
				$pagefile = PHPCMS_PATH.$pagefile;
				//include template('content', $template);die();
				ob_start();
				include template('content', $template);
				$this->createhtml($pagefile);
				return;
			}
			*/
			foreach ($pageurls as $key=>$urls) {
				$page = max($page,1);
				$current_imgno = $page-1;
				$pre_img = ($page==1)?-1:$page-1;
				$next_img = ($page==$pagenumber)?-1:$page+1;
				$pagefile = $urls[1];
				if($this->siteid!=1) {
					$pagefile = $this->html_root.'/'.$site_dir.$pagefile;
				}
				$this->queue->add_queue($action,$pagefile,$this->siteid);
				$pagefile = PHPCMS_PATH.$pagefile;
				//include template('content', $template);die();
				ob_start();
				include template('content', $template);
				$this->createhtml($pagefile);
				$page++;
			}
			return;
		}
		else 
		{
			//支持资讯模型发组图
			if(!empty($pictureurls))
			{
				$pagenumber = count($pictureurls);
				$this->url = pc_base::load_app_class('url', 'content');
				for($i=1; $i<=$pagenumber; $i++)
				{
					$upgrade = $upgrade ? '/'.ltrim($file,WEB_PATH) : '';
					$pageurls[$i] = $this->url->show($id, $i, $catid, $data['inputtime'],'','','edit',$upgrade);
					//$pageurls[$i] = $this->url->show($id, $i, $catid, $r["inputtime"]);
				}
				//$pages = content_pages($pagenumber,$page, $pageurls);
				//$this->db->table_name = $tablename;
				//上一个图集
				//$previous_page = $this->db->get_one("`catid` = '$catid' AND `id`<'$id' AND `status`=99",'*','id DESC');
				//下一个图集
				//$next_page = $this->db->get_one("`catid`= '$catid' AND `id`>'$id' AND `status`=99");
				
				$tmparr = $this->db->sselect("select a.* from v9_news a,v9_news_data b
							where a.id=b.id and a.catid = '$catid' AND a.`id`<'$id' AND a.`status`=99
							and b.pictureurls!='' and img_attachment_mode=1 order by id desc limit 0,1");
				$previous_page = $tmparr[0];
				$tmparr = $this->db->sselect("select a.* from v9_news a,v9_news_data b
						where a.id=b.id and a.catid = '$catid' AND a.`id`>'$id' AND a.`status`=99
						and b.pictureurls!='' and img_attachment_mode=1 order by id asc limit 0,1");
				$next_page = $tmparr[0];
				
				$page=1;
				foreach ($pageurls as $key=>$urls) {
					$page = max($page,1);
					$current_imgno = $page-1;
					$pre_img = ($page==1)?-1:$page-1;
					$next_img = ($page==$pagenumber)?-1:$page+1;
					$pagefile = $urls[1];
					if($this->siteid!=1) {
						$pagefile = $this->html_root.'/'.$site_dir.$pagefile;
					}
					$this->queue->add_queue($action,$pagefile,$this->siteid);
					$pagefile = PHPCMS_PATH.$pagefile;
					//include template('content', $template);die();
					ob_start();
					include template('content', $template);
					$this->createhtml($pagefile);
					$page++;
				}
				return;
			}
			//分页处理
			$pages = $titles = '';
			if($paginationtype==1) {
				//自动分页
				if($maxcharperpage < 10) $maxcharperpage = 500;
				$contentpage = pc_base::load_app_class('contentpage');
				$content = $contentpage->get_data($content,$maxcharperpage);
			}
		
			if($paginationtype!=0) {
				//手动分页
				$CONTENT_POS = strpos($content, '[page]');
				if($CONTENT_POS !== false) {
					$this->url = pc_base::load_app_class('url', 'content');	
					$contents = array_filter(explode('[page]', $content));
					$pagenumber = count($contents);
					if (strpos($content, '[/page]')!==false && ($CONTENT_POS<7)) {
						$pagenumber--;
					}
					for($i=1; $i<=$pagenumber; $i++) {
						$upgrade = $upgrade ? '/'.ltrim($file,WEB_PATH) : '';
						$pageurls[$i] = $this->url->show($id, $i, $catid, $data['inputtime'],'','','edit',$upgrade);
					}
					$END_POS = strpos($content, '[/page]');
					if($END_POS !== false) {
						if($CONTENT_POS>7) {
							$content = '[page]'.$title.'[/page]'.$content;
						}
						if(preg_match_all("|\[page\](.*)\[/page\]|U", $content, $m, PREG_PATTERN_ORDER)) {
							foreach($m[1] as $k=>$v) {
								$p = $k+1;
								$titles[$p]['title'] = strip_tags($v);
								$titles[$p]['url'] = $pageurls[$p][0];
							}
						}
					}
					//生成分页
					foreach ($pageurls as $page=>$urls) {
						$pages = content_pages($pagenumber,$page, $pageurls);
						//判断[page]出现的位置是否在第一位 
						if($CONTENT_POS<7) {
							$content = $contents[$page];
						} else {
							if ($page==1 && !empty($titles)) {
								$content = $title.'[/page]'.$contents[$page-1];
							} else {
								$content = $contents[$page-1];
							}
						}
						if($titles) {
							list($title, $content) = explode('[/page]', $content);
							$content = trim($content);
							if(strpos($content,'</p>')===0) {
								$content = '<p>'.$content;
							}
							if(stripos($content,'<p>')===0) {
								$content = $content.'</p>';
							}
						}
						$pagefile = $urls[1];
						if($this->siteid!=1) {
							$pagefile = $this->html_root.'/'.$site_dir.$pagefile;
						}
						$this->queue->add_queue($action,$pagefile,$this->siteid);
						$pagefile = PHPCMS_PATH.$pagefile;
						ob_start();
						include template('content', $template);
						$this->createhtml($pagefile);
					}
					return true;
				}
			}
		}
		//分页处理结束
		$file = PHPCMS_PATH.$file;
		ob_start();
		include template('content', $template);
		return $this->createhtml($file);
	}

}