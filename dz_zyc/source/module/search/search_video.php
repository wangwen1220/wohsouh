<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: search_portal.php 8544 2010-04-21 05:25:03Z monkey $
 */

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}

define('NOROBOT', TRUE);

require_once libfile('function/home');

if(!$_G['setting']['search']['video']['status']) {
	showmessage('search_video_closed');
}

if($_G['adminid'] != 1 && !($_G['group']['allowsearch'] & 1)) {
	showmessage('group_nopermission', NULL, array('grouptitle' => $_G['group']['grouptitle']), array('login' => 1));
}

$srchmod = 6;

$cachelife_time = 300;		// Life span for cache of searching in specified range of time
$cachelife_text = 3600;		// Life span for cache of text searching

$sdb = DB::object();

$srchtype = empty($_G['gp_srchtype']) ? '' : trim($_G['gp_srchtype']);
$checkarray = array('posts' => '', 'trade' => '', 'threadsort' => '');

$searchid = isset($_G['gp_searchid']) ? intval($_G['gp_searchid']) : 0;


$srchtxt = $_G['gp_srchtxt'];

$keyword = isset($srchtxt) ? htmlspecialchars(trim($srchtxt)) : '';

if(!submitcheck('searchsubmit', 1)) {

	include template('search/video');

} else {

	$orderby = in_array($_G['gp_orderby'], array('myshowid')) ? $_G['gp_orderby'] : 'myshowid';
	$ascdesc = isset($_G['gp_ascdesc']) && $_G['gp_ascdesc'] == 'asc' ? 'asc' : 'desc';

	if(!empty($searchid)) {
		$tpp = 18;
		$page = max(1, intval($_G['gp_page']));
		$start_limit = ($page - 1) * $tpp;

		$index = $sdb->fetch_first("SELECT searchstring, keywords, num, ids FROM ".DB::table('common_searchindex')." WHERE searchid='$searchid' AND srchmod='$srchmod'");
		if(!$index) {
			showmessage('search_id_invalid');
		}

		$keyword = htmlspecialchars($index['keywords']);
		$keyword = $keyword != '' ? str_replace('+', ' ', $keyword) : '';

		$index['keywords'] = rawurlencode($index['keywords']);
		$myshowlist = array();
		$query = $sdb->query("SELECT vl.*,m.uid FROM ".DB::table('video_list')." vl LEFT JOIN ".DB::table('common_member')." m ON vl.author=m.username WHERE vl.myshowid IN ($index[ids]) ORDER BY $orderby $ascdesc LIMIT $start_limit, $tpp");
		while($myshow = $sdb->fetch_array($query)) {
			$myshow['dateline'] = dgmdate($myshow['dateline']);
			//$myshow['title'] = bat_highlight($myshow['title'], strtolower($keyword));
			//$myshow['title'] = bat_highlight($myshow['title'], strtoupper($keyword));
			$myshow['pic'] = cVideoPic($myshow);
			//$article['summary'] = bat_highlight($article['summary'], $keyword);
			$myshowlist[] = $myshow;
		}

		$multipage = multi($index['num'], $tpp, $page, "search.php?mod=video&searchid=$searchid&orderby=$orderby&ascdesc=$ascdesc&searchsubmit=yes");

		$url_forward = 'search.php?mod=video&'.$_SERVER['QUERY_STRING'];

		include template('search/myshow_search');

	} else {

		$searchstring = 'video|title|'.addslashes($srchtxt);
		$searchindex = array('id' => 0, 'dateline' => '0');

		$query = $sdb->query("SELECT searchid, dateline,
			('".$_G['setting']['search']['video']['searchctrl']."'<>'0' AND ".(empty($_G['uid']) ? "useip='$_G[clientip]'" : "uid='$_G[uid]'")." AND $_G[timestamp]-dateline<".$_G['setting']['search']['video']['searchctrl'].") AS flood,
			(searchstring='$searchstring' AND expiration>'$_G[timestamp]') AS indexvalid
			FROM ".DB::table('common_searchindex')."
			WHERE srchmod='$srchmod' AND ('".$_G['setting']['search']['video']['searchctrl']."'<>'0' AND ".(empty($_G['uid']) ? "useip='$_G[clientip]'" : "uid='$_G[uid]'")." AND $_G[timestamp]-dateline<".$_G['setting']['search']['video']['searchctrl'].") OR (searchstring='$searchstring' AND expiration>'$_G[timestamp]')
			ORDER BY flood");

		while($index = $sdb->fetch_array($query)) {
			if($index['indexvalid'] && $index['dateline'] > $searchindex['dateline']) {
				$searchindex = array('id' => $index['searchid'], 'dateline' => $index['dateline']);
				break;
			} elseif($_G['adminid'] != '1' && $index['flood']) {
				showmessage('search_ctrl', 'search.php?mod=video', array('searchctrl' => $_G['setting']['search']['video']['searchctrl']));
			}
		}

		if($searchindex['id']) {

			$searchid = $searchindex['id'];

		} else {

			if(!$srchtxt) {
				showmessage('search_invalid', 'search.php?mod=video');
			}

			if($_G['adminid'] != '1' && $_G['setting']['search']['video']['maxspm']) {
				if(($sdb->result_first("SELECT COUNT(*) FROM ".DB::table('common_searchindex')." WHERE srchmod='$srchmod' AND dateline>'$_G[timestamp]'-60")) >= $_G['setting']['search']['video']['maxspm']) {
					showmessage('search_toomany', 'search.php?mod=video', array('maxspm' => $_G['setting']['search']['video']['maxspm']));
				}
			}

			$num = $ids = 0;
			$_G['setting']['search']['video']['maxsearchresults'] = $_G['setting']['search']['video']['maxsearchresults'] ? intval($_G['setting']['search']['video']['maxsearchresults']) : 500;
			$srchtxtsql = addcslashes($srchtxt, '%_');
			$query = $sdb->query("SELECT myshowid FROM ".DB::table('video_list')." WHERE type=2 && auditstatus=2 && title LIKE '%$srchtxtsql%' ORDER BY myshowid DESC LIMIT ".$_G['setting']['search']['video']['maxsearchresults']);
			while($article = $sdb->fetch_array($query)) {
				$ids .= ','.$article['myshowid'];
				$num++;
			}
			DB::free_result($query);

			$keywords = str_replace('%', '+', $srchtxt);
			$expiration = TIMESTAMP + $cachelife_text;

			DB::query("INSERT INTO ".DB::table('common_searchindex')." (srchmod, keywords, searchstring, useip, uid, dateline, expiration, num, ids)
					VALUES ('$srchmod', '$keywords', '$searchstring', '$_G[clientip]', '$_G[uid]', '$_G[timestamp]', '$expiration', '$num', '$ids')");
			$searchid = DB::insert_id();

			!($_G['group']['exempt'] & 2) && updatecreditbyaction('search');
		}

		dheader("location: search.php?mod=video&searchid=$searchid&searchsubmit=yes");

	}

}

?>