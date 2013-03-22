<?php
function tag_content_related($options)
{
	if (!is_array($options)) return false;
	extract($options);
	if (!isset($tags) || empty($tags)) return false;
	if (!isset($size)) $size = 10;
	$db = & factory::db();
	$tagids = '';
    $tags = "'".preg_replace("/\s/", "','", $tags)."'";
    $data = $db->select("SELECT `tagid` FROM `#table_tag` WHERE `tag` IN($tags)");
    foreach ($data as $r)
    {
    	$tagids .= $r['tagid'].',';
    }
    $tagids = rtrim($tagids, ',');
	return $db->select("SELECT DISTINCT t.contentid, c.title, c.thumb, c.url, c.published FROM `#table_content_tag` t LEFT JOIN `#table_content` c ON c.contentid=t.contentid WHERE t.contentid!=$contentid AND c.status=6 AND t.tagid IN($tagids) ORDER BY c.published DESC LIMIT $size");
}

function tag_content_prev($options)
{
	if (!is_array($options)) return false;
	extract($options);
	$db = & factory::db();
	if (!isset($catid) || !isset($published))
	{
		$r = $db->get("SELECT `catid`, `published` FROM `#table_content` WHERE `contentid`=?", array($contentid));
		if (!$r || $r['status'] != 6) return false;
		$catid = $r['catid'];
		$published = $r['published'];
	}
	return $db->get("SELECT `title`, `color`, `thumb`, `url`, `createdby`, `published` FROM `#table_content` WHERE `catid`=? AND `status`=6 AND `published`<? ORDER BY `published` DESC LIMIT 1", array($catid, $published));
}

function tag_content_next($options)
{
	if (!is_array($options)) return false;
	extract($options);
	$db = & factory::db();
	if (!isset($catid) || !isset($published))
	{
		$r = $db->get("SELECT `catid`, `published` FROM `#table_content` WHERE `contentid`=?", array($contentid));
		if (!$r || $r['status'] != 6) return false;
		$catid = $r['catid'];
		$published = $r['published'];
	}
	return $db->get("SELECT `title`, `color`, `thumb`, `url`, `createdby`, `published` FROM `#table_content` WHERE `catid`=? AND `status`=6 AND `published`>? ORDER BY `published` ASC LIMIT 1", array($catid, $published));
}

function tag_content($options)
{
	if (!is_array($options)) return false;
	extract($options);
	
	$sql = "SELECT * FROM `#table_content` ";
	$extrawhere = $where;
	$where = array();
	$where[] = "`#table_content`.`status`=6";
	if (isset($contentid))
	{
		$where[] = is_numeric($contentid) ? "`#table_content`.`contentid`=".intval($contentid) : "`#table_content`.`contentid` IN($contentid)";
	}
	else 
	{
		if (!empty($catid))
		{
			if (is_numeric($catid))
			{
				$childids = table('category', $catid, 'childids');
				$where[] = $childids ? "`#table_content`.`catid` IN($childids)" : "`#table_content`.`catid`=".intval($catid);
			}
			else 
			{
				$where[] = "`#table_content`.`catid` IN($catid)";
			}
		}
		if (!empty($modelid))
		{
            $where[] = is_numeric($modelid) ? "`#table_content`.`modelid`=".intval($modelid) : "`#table_content`.`modelid` IN($modelid)";
		}
		if (!empty($sourceid))
		{
            $where[] = is_numeric($sourceid) ? "`#table_content`.`sourceid`=".intval($sourceid) : "`#table_content`.`sourceid` IN($sourceid)";
		}
		if (!empty($createdby))
		{
            $where[] = is_numeric($createdby) ? "`#table_content`.`createdby`=".intval($createdby) : "`#table_content`.`createdby` IN($createdby)";
		}
		if (!empty($tags))
		{
			$db = & factory::db();
			$tag_sql = "SELECT `tagid` FROM `#table_tag` WHERE";
			if (strpos($tags, ',') === false)
			{
				$tag = $db->get("$tag_sql `tag`='$tags'");
				if (!$tag) return false;
		        $sql .= ", `#table_content_tag`";
				$where[] = "`#table_content`.`contentid`=`#table_content_tag`.`contentid` AND `#table_content_tag`.`tagid`=".$tag['tagid'];
			}
			else 
			{
				$tags = $db->select("$tag_sql `tag` IN('".str_replace(',', "','", $tags)."')");
				if (!$tags) return false;
		        $sql .= ", `#table_content_tag`";
				$tagid = '';
				foreach ($tags as $tag)
				{
					$tagid .= $tag['tagid'].',';
				}
				$tagid = trim($tagid, ',');
				$where[] = "`#table_content`.`contentid`=`#table_content_tag`.`contentid` `#table_content_tag`.`tagid` IN($tagid)";
			}
		}
		if (!empty($weight))
		{
			if (strpos($weight, ',') === false)
			{
				$where[] = "`#table_content`.`weight`=".intval($weight);
			}
			elseif(preg_match("/^\s*([\d]*)\s*\,\s*([\d]*)\s*$/", $weight, $m)) 
			{
				if ($m[1]) $where[] = "`#table_content`.`weight`>=$m[1]";
				if ($m[2]) $where[] = "`#table_content`.`weight`<=$m[2]";
			}
		}
		if (!empty($published))
		{
			if (strpos($published, ',') === false)
			{
				if (is_numeric($published) && strlen($published) < 4)
				{
					$published = strtotime("-$published day");
					$where[] = where_mintime('`#table_content`.`published`', $published);
				}
				else 
				{
					$where[] = where_mintime('`#table_content`.`published`', $published)." AND ".where_maxtime('published', $published);
				}
			}
			elseif(preg_match("/^\s*([\d]{4}\-[\d]{1,2}\-[\d]{1,2})?\s*\,\s*([\d]{4}\-[\d]{1,2}\-[\d]{1,2})?\s*$/", $published, $m)) 
			{
				if ($m[1]) $where[] = where_mintime('`#table_content`.`published`', $m[1]);
				if ($m[2]) $where[] = where_maxtime('`#table_content`.`published`', $m[2]);
			}
		}
	}
	if (!empty($extrawhere))
	{
		$where[] = "($extrawhere)";
	}
	
	$where = ' WHERE '.implode(' AND ', $where);
	if (!empty($orderby))
	{
		if (strpos($orderby, ',') !== false) $orderby = str_replace(',', ',`#table_content`.', $orderby);
		$orderby =  '`#table_content`.'.$orderby;
	}
	else 
	{
		$orderby = "`#table_content`.`published` DESC";
	}
	$sql .= $where." ORDER BY ".$orderby;
	$options['sql'] = $sql;
	return tag_db($options);
}

function tag_shopex($options)
{
	if (!is_array($options))
		return false;
	extract($options);
	if (empty($dsn))	
		return false;
	if (!isset($prefix))
		$prefix = 'sdb_';
	$where = array();
	$on = ' g.goods_id = k.goods_id ';
	
	// 商品关键字
	if (!empty($keywords)) {
		foreach(explode(',',$keywords) as $key)
		{
			$key = trim($key);
			if (empty($key))
				continue;
			$key = str_replace('*', '%', addcslashes($key, '%_'));
			$wkeyword[] = " k.keyword LIKE '".str_replace('_', '\_', $key)."' ";
		}
		$wkeyword = implode(' OR ', $wkeyword);
	}
	if (!empty($wkeyword))
	{
		$where[] = " ($wkeyword) ";
	}
	
	// 商品分类
	if (!empty($catid))
	{
		$where[] = ' g.cat_id IN ('.implode_ids($catid).') ';
	}
	
	// bid 品牌id ，brand 品牌
	$ubrand = array();
	$ids = array();
	foreach(explode(',',$brand) as $b)
	{
		$b = trim($b);
		if (empty($b))
			continue;
		$b = str_replace('*', '%', addcslashes($b, '%_'));
		$ubrand[] = " g.brand LIKE '".str_replace('_', '\_', $b)."' ";
	}
	foreach (explode(',', $bid) as $id)
	{
		$id = intval(trim($id));
		if (empty($id))
			continue;
		$ids[] = $id;
	}
	if (!empty($ids))
	{
		array_unshift($ubrand, ' g.brand_id IN ('.implode_ids($ids).') ');
	}
	$ubrand = implode(' OR ', $ubrand);
	if (!empty($ubrand))
	{
		$where[] = "($ubrand)";
	}
	
	// 搜索时间 published
	if (!empty($published))
	{
		if ($published = abs(intval($published)))
		{
			$published = strtotime("-$published day");
			$where[] = " g.uptime >= $published ";
		}
	}
	
	// 排序类型(orderby):uptime, price, comments_count, view_count, view_w_count, buy_count, buy_w_count
	$order = '';
	if (!empty($orderby))
	{
		if (preg_match('/(\w+)\s+(asc|desc)/i', $orderby, $m))
		{
			$orderAry = array('price', 'comments_count', 'view_count', 'view_w_count', 'buy_count', 'buy_w_count');
			$orderby = in_array($m[1], $orderAry) ? $m[1] : 'uptime';
			$order = ' ORDER BY g.'.$orderby.' '.$m[2];
		}
	}
	$where[] = " g.marketable='true' ";
	
	$where = implode(' AND ', $where);
	$head = " SELECT DISTINCT g.* ";
	$tail = " FROM {$prefix}goods g LEFT JOIN {$prefix}goods_keywords k ON {$on} WHERE $where";
	$sql = $head. $tail. $order;
	
	// 判断是否进行标签过滤
	if (!empty($tagid)) 
	{
		$subwhere = array();
		$head = " SELECT DISTINCT g.goods_id ";
		$subwhere[] = ' g.goods_id = r.rel_id ';
		$subwhere[] = ' r.tag_id IN ('.implode_ids($tagid).') ';
		$subwhere[] = ' g.goods_id IN ('.$head. $tail.') ';
		$subwhere = implode(' AND ', $subwhere);
		$sql = " SELECT DISTINCT g.* FROM {$prefix}tag_rel r , {$prefix}goods g WHERE {$subwhere} ";
		$sql .= $order;
	}
	
	$options['sql'] = $sql;

	return tag_db($options);
}

function tag_phpwind($options)
{
	if (!is_array($options))
		return false;
	extract($options);
	if (empty($dsn))	
		return false;
	if (!isset($prefix))
		$prefix = 'pw_';
	$where = array();
	
	// 主题范围 filter (精华 digest 置顶 top)
	if ($filter == 'digest')
		$where[] = "t.digest>'0'";
	if ($filter == 'top')
	{
		$where[] = "t.topped>'0'";
	}
	else
	{
		$where[] = "t.topped>='0'";
	}
	
	// 论坛版块 fid
	if (!empty($fid))
	{
		$where[] = 't.fid IN ('.implode_ids($fid).')';
	}
	
	$where[] = "s.tid=t.tid ";
	
	// 时间范围 published
	if (!empty($published))
	{
		if ($published = abs(intval($published)))
		{
			$published = strtotime("-$published day");
			$where[] = "t.postdate >= $published";
		}
	}
	
	// 关键字 keywords
	if (!empty($keywords))
	{
		if (preg_match("(AND|\+|&|\s)", $keywords) && !preg_match("(OR|\|)", $keywords))
		{
			$andor = ' AND ';
			$keywords = preg_replace("/( AND |&| )/is", "+", $keywords);
		}
		else
		{
			$andor = ' OR ';
			$keywords = preg_replace("/( OR |\|)/is", "+", $keywords);
		}
		$keywords = str_replace('*', '%', addcslashes($keywords, '%_'));
		$srhwords = array();
		foreach(explode('+', $keywords) as $text)
		{
			$text = trim($text);
			if ($text)
			{
				$srhwords[] = "(s.content LIKE '%".str_replace('_', '\_', $text)."%' OR t.subject LIKE '%$text%')";
			}
		}
		$srhwords = implode($andor, $srhwords);
		if ($srhwords)
		{
			$where[] = "($srhwords)";
		}
	}
	
	// 作者id uid  作者 author
	$uname = array();
	$ids = array();
	foreach(explode(',',$author) as $u)
	{
		$u = trim($u);
		if (empty($u))
			continue;
		$u = str_replace('*', '%', addcslashes($u, '%_'));
		$uname[] = "t.author LIKE '".str_replace('_', '\_', $u)."'";
	}
	foreach (explode(',', $uid) as $id)
	{
		$id = intval(trim($id));
		if (empty($id))
			continue;
		$ids[] = $id;
	}
	if (!empty($ids))
	{
		array_unshift($uname, 't.authorid IN ('.implode_ids($ids).')');
	}
	$uname = implode(' OR ', $uname);
	if (!empty($uname))
	{
		$where[] = "($uname)";
	}
	
	// 特殊主题 special  (投票主题 1 活动主题 2 悬赏主题 3  商品主题 4  辩论主题 5 )
	if (!empty($special))
	{
		$where[] = "t.special IN (".implode_ids($special).")";
	}
	
	$where = implode(' AND ', $where);
	
	// 排序类型 orderby (最后回复 lastpost 发布时间 postdate 回复次数 replies 点击 hits)
	$order = '';
	if (!empty($orderby))
	{
		if (preg_match('/(\w+)\s+(asc|desc)/i', $orderby, $m))
		{
			$orderby = in_array($m[1], array('postdate', 'replies', 'hits')) ? $m[1] : 'lastpost';
			$order = 'ORDER BY t.'.$orderby.' '.$m[2];
		}
	}
	
	$sql = "SELECT * FROM {$prefix}threads t, {$prefix}tmsgs s WHERE $where $order";
	$options['sql'] = $sql;
	return tag_db($options);
}

function tag_discuz($options)
{
	if (!is_array($options)) return false;
	extract($options);
	if (empty($dsn)) return false;
	if (!isset($prefix))
		$prefix = 'cdb_';
	
	// 兼容DiscuzX
	if (!isset($discuzX))
	{
		$tpost = 'posts'; $tthread = 'threads';
	}
	else 
	{
		$prefix = $prefix. 'forum_';
		$tpost = 'post'; $tthread = 'thread';
	}
	
	$where = array();
	// 主题范围(filter):全部主题(all) 精华主题(digest) 置顶主题(top)
	// 精华
	if ($filter == 'digest')
	{
		$where[] = "t.digest>'0'";
	}
	// 置顶否
	if ($filter == 'top')
	{
		$where[] = "t.displayorder>'0'";
	}
	else
	{
		$where[] = "t.displayorder>='0'";
	}
	
	// 论坛版块：fid
	if (!empty($fid))
	{
		$where[] = 't.fid IN ('.implode_ids($fid).')';
	}
	
	$where[] = "p.tid=t.tid AND p.first='1' AND p.invisible='0'";
	
	// 时间范围：dateline
	if (!empty($published))
	{
		if ($published = abs(intval($published)))
		{
			$published = strtotime("-$published day");
			$where[] = "t.dateline >= $published";
		}
	}
	
	// 关键字：
	if (!empty($keywords))
	{
		if (preg_match("(AND|\+|&|\s)", $keywords) && !preg_match("(OR|\|)", $keywords))
		{
			$andor = ' AND ';
			$keywords = preg_replace("/( AND |&| )/is", "+", $keywords);
		}
		else
		{
			$andor = ' OR ';
			$keywords = preg_replace("/( OR |\|)/is", "+", $keywords);
		}
		$keywords = str_replace('*', '%', addcslashes($keywords, '%_'));
		$srhwords = array();
		foreach(explode('+', $keywords) as $text)
		{
			$text = trim($text);
			if ($text)
			{
				$srhwords[] = "(p.message LIKE '%".str_replace('_', '\_', $text)."%' OR p.subject LIKE '%$text%')";
			}
		}
		$srhwords = implode($andor, $srhwords);
		if ($srhwords)
		{
			$where[] = "($srhwords)";
		}
	}
	
	// 作者id：uid 作者：author
	$uname = array();
	$ids = array();
	foreach(explode(',',$author) as $u)
	{
		$u = trim($u);
		if (empty($u))
			continue;
		$u = str_replace('*', '%', addcslashes($u, '%_'));
		$uname[] = "t.author LIKE '".str_replace('_', '\_', $u)."'";
	}
	foreach (explode(',', $uid) as $id) 
	{
		$id = intval(trim($id));
		if (empty($id))
			continue;
		$ids[] = $id;
	}
	if (!empty($ids))
	{
		array_unshift($uname, 't.authorid IN ('.implode_ids($ids).')');
	}
	$uname = implode(' OR ', $uname);
	if (!empty($uname))
	{
		$where[] = "($uname)";
	}	
	
	// 特殊主题(special):投票主题(1) 商品主题(2) 悬赏主题(3)  活动主题(4)  辩论主题(5)
	if (!empty($special))
	{
		$where[] = "t.special IN (".implode_ids($special).")";
	}

	$where = implode(' AND ', $where);
	
	// 排序类型(orderby):lastpost dateline replies views
	$order = '';
	if (!empty($orderby))
	{
		if (preg_match('/(\w+)\s+(asc|desc)/i', $orderby, $m))
		{
			$orderby = in_array($m[1], array('dateline', 'replies', 'views')) ? $m[1] : 'lastpost';
			$order = 'ORDER BY t.'.$orderby.' '.$m[2];
		}
	}
	
	$sql = "SELECT * FROM {$prefix}{$tpost} p, {$prefix}{$tthread} t WHERE $where $order";
	$options['sql'] = $sql;
	return tag_db($options);
}

function tag_db($options)
{
	if (!is_array($options)) return false;
	extract($options);
	if (!isset($sql)) return false;
	if (!empty($dsn))
	{
		$dsns = table('dsn');
		foreach ($dsns as $dsnid=>$d)
		{
			if ($d['name'] == $dsn)
			{
				$dsn = $d;
				break;
			}
		}
		$db = & factory::db($dsn);
	}
	else 
	{
		$db = & factory::db();
		if ($db->options['prefix'] != 'cmstop_')
		{
			$sql = str_replace('cmstop_', $db->options['prefix'], $sql);
		}
	}
	if (isset($dbname))
	{
		if (! $db->select_db($dbname))
		{
			exit("The database $dbname is not exists!");
		}
	}
	$size = isset($size) ? intval($size) : 0;
	$page = isset($page) ? max(intval($page), 1) : 0;
	$pages = $limit = '';
	if ($page)
	{
		if ($size < 1) $size = 10;
		$offset = $size * ($page-1);
		$limit = $offset > 0 ? " LIMIT $offset,$size" : " LIMIT $size";
		$r = $db->get("SELECT COUNT(*) AS `count` ".stristr($sql, 'from'));
		$total = $r['count'];
	}
	elseif ($size > 0)
	{
		$offset = isset($offset) ? intval($offset) : 0;
		$limit = $offset > 0 ? " LIMIT $offset,$size" : " LIMIT $size";
	}
	$sql .= $limit;
	$data = $size == -1 ? $db->get($sql) : $db->select($sql);
	if (isset($dbname) && (empty($dsn) || $dsn == 'db'))
	{
		$db->select_db(config('db', 'dbname'));
	}
	if ($data)
	{
		if (!empty($dsn)) $charset = config('db', 'charset');
		if (isset($charset) && $db->charset != $charset) $data = str_charset($db->charset, $charset, $data);
		if ($page) $data = array('data'=>$data, 'count'=>count($data), 'total'=>$total, 'size'=>$size, 'page'=>$page);
	}
	return $data;
}

function tag_xml($options)
{
	if (!is_array($options)) return false;
	extract($options);
	if(!isset($url)) return false;
	
	unset($options['url']);
	$url = url_query($url, $options);
}

function tag_json($options)
{
	if (!is_array($options)) return false;
	extract($options);
	if(!isset($url)) return false;
	
	unset($options['url']);
	$url = url_query($url, $options);
	
	$data = file_get_contents($url);
	$json = & factory::json();
	$data = $json->decode($data);
	return $data;
}

function tag_rpc($options)
{
	if (!is_array($options)) return false;
	extract($options);
	if(!isset($url)) return false;
	
	unset($options['url'], $options['encoding'], $options['method'], $options['return']);
	$url = url_query($url, $options);
	
	import('helper.xmlrpc_client');
	$xmlrpc_client = new xmlrpc_client($url, 'POST', $encoding);
	$data = $xmlrpc_client->request($method, $options);
	return $data;
}