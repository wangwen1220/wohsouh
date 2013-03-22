<?php
/*************
# 插件设置
*************/

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) exit('Access Denied');

require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'common.php';

#是否将配置文件保存成功
$saveOK = 2;

#生成配置文件
if(!empty($_POST)){
	require_once HL_PLUGIN_ROOT.HL_DS.'config.inc.php';
	#界面中定义的配置项
	$Purify_CONFIG['LOG_LEVEL'] = abs(intval($_POST['Purify_LOG_LEVEL']));
	$Purify_CONFIG['PURIFY_FIELD'] = strip_tags(trim($_POST['Purify_PURIFY_FIELD']));
	$Purify_CONFIG['CALL_NUM'] = abs(intval($_POST['Purify_CALL_NUM']));
	$Purify_CONFIG['MULTI_POST'] = abs(intval($_POST['Purify_MULTI_POST']));
	#版块配置数组
	$Purify_CONFIG['BOARDS_IDENTIFY'] = array();
	$board_a = $_POST['board_a'];
	$board_b = $_POST['board_b'];
	$board_c = $_POST['board_c'];
	$board_d = $_POST['board_d'];
	if($board_a){
		$board_purify = array();
		foreach($board_a as $key=>$val){
			$board_purify[$key] = array(abs(intval($board_a[$key])), abs(intval($board_b[$key])), abs(intval($board_c[$key])), abs(intval($board_d[$key])));
		}
		$Purify_CONFIG['BOARDS_IDENTIFY'] = $board_purify;
	}
	
    //初始化工作类
    $HL_Purify = & Purify::singleton();
	$HL_Purify->config['log_level'] = 0;#close log
	if($Purify_PREDICT_API && $Purify_FEEDBACK_API){
		#检查与保10洁接口是否能连接
		if(!$sm = $HL_Purify->send_request($Purify_PREDICT_API, '', 0, 5, false)){
                    $saveOK = -1;
		}	
	}
	
	#检查是否能访问到本机上的代理页面
	if(!$Purify_CONFIG['BBS_ROOT']){
		$port = $_SERVER['SERVER_PORT'] == 80 ? '' : ':'.$_SERVER['SERVER_PORT'];
		$path = $port . rtrim(dirname($_SERVER['REQUEST_URI']), "\\/");
		$callUrl = $path.'/source/plugin/bao10jie/call.php';

		$callUrl1 = 'http://'.$_SERVER['SERVER_NAME'] . $callUrl;
		$callUrl2 = 'http://127.0.0.1' . $callUrl;		
	
		#通过域名可访问代理页面
		$s1 = $HL_Purify->send_request($callUrl1, '', 0, 5, false);

		if(!$s1){
			$s2 = $HL_Purify->send_request($callUrl2, '', 0, 5, false);
			if(!$s2){
				$Purify_CONFIG['BBS_ROOT'] = '';#代理页面不可用
				$saveOK = -2;
			}else{
				$Purify_CONFIG['BBS_ROOT'] = 'http://127.0.0.1' . $path;#通过IP可访问代理页面
			}
		}else{
			$Purify_CONFIG['BBS_ROOT'] = 'http://'.$_SERVER['SERVER_NAME'] .$path;
		} 
	}
	
	#生成配置文件内容
	
	$cfgFile1 = HL_CACHE_ROOT.HL_DS.'bao10jie'.HL_DS.'config.inc.php';
	$cfgFile2 = HL_CACHE_ROOT.HL_DS.'bao10jie'.HL_DS.'config_ext.inc.php';
	
	ob_start();
	include HL_PLUGIN_ROOT.HL_DS.'template'.HL_DS.'psetini.tpl.php';
	$setContent1 = ob_get_clean();
	$setContent1 = str_replace('[$]', '$', $setContent1);
	$setContent1 = '<?php'. $setContent1 .'?>';

	ob_start();
	include HL_PLUGIN_ROOT.HL_DS.'template'.HL_DS.'psetini_ext.tpl.php';
	$setContent2 = ob_get_clean();
	$setContent2 = str_replace('[$]', '$', $setContent2);
	$setContent2 = '<?php'. $setContent2 .'?>';
	
	#把配置内容保存到文件
	if(file_put_contents($cfgFile1, $setContent1) && file_put_contents($cfgFile2, $setContent2)){
		if($saveOK == 2) $saveOK = 1;
	}else{
		if($saveOK == 2) $saveOK = 0;
		else $saveOK -= 2;
	}
	
}else{
	#导入插件的配置文件
	if(file_exists(HL_CACHE_ROOT.HL_DS.'bao10jie'.HL_DS.'config.inc.php')){
		require_once HL_CACHE_ROOT.HL_DS.'bao10jie'.HL_DS.'config.inc.php';
	}
	#post display mode
	if(!$Purify_PURIFY_FIELD){
		$Purify_PURIFY_FIELD = "invisible";
	}
	#log level
	if(!in_array($Purify_LOG_LEVEL, array(0,1,2))){
		$Purify_LOG_LEVEL = 1;
	}
	#call num
	if(!isset($Purify_CALL_NUM) || $Purify_CALL_NUM<0){
		$Purify_CALL_NUM = 5;
	}
	
//	if(!$Purify_HTTP_DELAYTIME) $Purify_HTTP_DELAYTIME = 10;
//	if(!$Purify_LAG_SHOWTIME) $Purify_LAG_SHOWTIME = 1;
//	if(!$Purify_APP_TYPE) $Purify_APP_TYPE = 'discuz_bbs';
//	if(!$Purify_CRONTAB_TIMES) $Purify_CRONTAB_TIMES = 10;
//	if(!$Purify_SEND_TOP) $Purify_SEND_TOP = 0;
//	if(!$Purify_SEND_StrNum) $Purify_SEND_StrNum = 0;

	#取出版块们，并加载配置页面
	$pforumtop = $pforumsub = $pgroups = array();
        if (HL_VERSION == "X2" || HL_VERSION == "X1.5") {
            $sql = "SELECT f.fid, f.type, f.status, f.name, f.fup, f.displayorder, f.inheritedmod, ff.moderators, ff.password, ff.redirect 
            FROM " . DB::table('forum_forum') . " f 
            LEFT JOIN " . DB::table('forum_forumfield') . " ff USING(fid) 
            WHERE status=1 
            ORDER BY f.type<>'group', f.displayorder";
            $query = DB::query($sql);
            while ($forum = DB::fetch($query)) {
                if ($forum['type'] == 'group')
                    $pgroups[$forum['fid']] = $forum;
                elseif ($forum['type'] == 'forum')
                    $pforumtop[$forum['fup']][] = $forum;
                elseif ($forum['type'] == 'sub')
                    $pforumsub[$forum['fup']][] = $forum;
            }
        }else{
            $sql = "SELECT f.fid, f.type, f.status, f.name, f.fup, f.displayorder, f.inheritedmod, ff.moderators, ff.password, ff.redirect 
            FROM {$tablepre}forums f 
            LEFT JOIN {$tablepre}forumfields ff USING(fid) 
            ORDER BY f.type<>'group', f.displayorder";
            $query = $db->query($sql);
            while($forum = $db->fetch_array($query)) {
                    if($forum['type'] == 'group') $pgroups[$forum['fid']] = $forum;
                    elseif($forum['type'] == 'forum') $pforumtop[$forum['fup']][] = $forum;
                    elseif($forum['type'] == 'sub') $pforumsub[$forum['fup']][] = $forum;
            }
        }
}

include HL_PLUGIN_ROOT.HL_DS.'template'.HL_DS.'pset.tpl.php';

?>

