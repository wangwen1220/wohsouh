<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: member_logging.php 17133 2010-09-25 00:35:09Z monkey $
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/huoshow/configs/config.php');

if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
error_reporting(E_ALL ^ E_NOTICE);
define('NOROBOT', TRUE);
if(!in_array($_G['gp_action'], array('login', 'logout', 'seccode'))) {
	showmessage('undefined_action', NULL);
}

$ctl_obj = new logging_ctl();
$method = 'on_'.$_G['gp_action'];
$ctl_obj->$method();

class logging_ctl {

	var $var = null;

	function logging_ctl() {
		require_once libfile('function/misc');
		loaducenter();
	}

	function on_login() {
		global $_G;
		if($_G['uid']) {
			setcookie("loginStatus", 1, time()+(3600*60*24)) 	;	
			$ucsynlogin = $_G['setting']['allowsynlogin'] ? uc_user_synlogin($_G['uid']) : '';
			$param = array('username' => $_G['member']['username'], 'uid' => $_G['member']['uid']);
			showmessage('login_succeed', dreferer(), $param, array('showdialog' => 1, 'locationtime' => true, 'extrajs' => $ucsynlogin));
		}
		
		$seccodecheck = $_G['setting']['seccodestatus'] & 2;
		$invite = getinvite();

		if(!submitcheck('loginsubmit', 1, $seccodecheck)) {

			$_G['referer'] = dreferer();

			$thetimenow = '(GMT '.($_G['setting']['timeoffset'] > 0 ? '+' : '').$_G['setting']['timeoffset'].') '.
				dgmdate(TIMESTAMP, 'u').

			$cookietimecheck = !empty($_G['cookie']['cookietime']) ? 'checked="checked"' : '';

			if($seccodecheck) {
				$seccode = random(6, 1) + $seccode{0} * 1000000;
			}

			$username = !empty($_G['cookie']['loginuser']) ? htmlspecialchars($_G['cookie']['loginuser']) : '';
			$navtitle = lang('core', 'title_login');
			include template('member/login');

		} else {
			if(!($_G['member_loginperm'] = logincheck())) {
				//showmessage('login_strike'); //注释掉登录次数为5次时，密码输入正确,却不能正常登录
			}
			if($_G['gp_fastloginfield']) {
				$_G['gp_loginfield'] = $_G['gp_fastloginfield'];
			}
			
			$_G['uid'] = $_G['member']['uid'] = 0;
			$_G['username'] = $_G['member']['username'] = $_G['member']['password'] = '';
//			$result = userlogin($_G['gp_username'], $_G['gp_password'], $_G['gp_questionid'], $_G['gp_answer'], $_G['setting']['autoidselect'] ? 'auto' : $_G['gp_loginfield']);
//			print_r($_POST);
//			die();
			if ($_GET['social_session']){//社化登录
				$s_username = $_GET['username'];
				$s_password = '';
				$s_questionid = '0';
				$s_answer = '';
				$s_loginfield = 'username';
				$s_social_session = $_GET['social_session'];
				$s_social_uid = $_GET['session_uid'];
				
				$result = userlogin($s_username,$s_password,$s_questionid,$s_answer,'',$s_social_session);
			}else {
				$result = userlogin($_G['gp_username'], $_G['gp_password'], $_G['gp_questionid'], $_G['gp_answer'], $_G['setting']['autoidselect'] ? 'auto' : $_G['gp_loginfield']);
			}

			if($result['status'] > 0) {	
				setloginstatus($result['member'], $_G['gp_cookietime'] ? 2592000 : 0);
				DB::query("UPDATE ".DB::table('common_member_status')." SET lastip='".$_G['clientip']."', lastvisit='".time()."' WHERE uid='$_G[uid]'");
				ClearFail();
				$ucsynlogin = $_G['setting']['allowsynlogin'] ? uc_user_synlogin($_G['uid']) : '';

				include_once libfile('function/stat');
				updatestat('login');
				updatecreditbyaction('daylogin', $_G['uid']);
				checkusergroup($_G['uid']);
				if($invite['id']) {
					DB::update("common_invite", array('fuid'=>$uid, 'fusername'=>$username), array('id'=>$invite['id']));
					updatestat('invite');
				}
				if($invite['uid']) {
					require_once libfile('function/friend');
					friend_make($invite['uid'], $invite['username'], false);
					dsetcookie('invite_auth', '');
					if($invite['appid']) {
						updatestat('appinvite');
					}
				}
			
				
				setcookie("loginStatus", 1, time()+(3600*60*24)) 	;			
				if(!empty($_G['inajax']) && empty($_G['gp_quickforward'])) {
					$_G['setting']['msgforward'] = unserialize($_G['setting']['msgforward']);
					$mrefreshtime = intval($_G['setting']['msgforward']['refreshtime']) * 1000;
					loadcache('usergroups');
					$usergroups = addslashes($_G['cache']['usergroups'][$_G['groupid']]['grouptitle']);
					$message = 1;
					include template('member/login');
				} else {
					$param = array('username' => $_G['member']['username'], 'uid' => $_G['member']['uid'], 'syn' => $ucsynlogin ? 1 : 0);
					if($_G['groupid'] == 8) {
						showmessage('login_succeed_inactive_member', 'home.php?mod=space&do=home', $param, array('extrajs' => $ucsynlogin));
					} else {
						if ($_G['gp_isbound'] == 'isbound'){
							//$code_url = DX_URL;
							$code_url = MYSHOW_URL."index.php?m=community&c=index&a=index";
							showmessage('login_succeed',$code_url,$param);
						}else {
							if ($_G['gp_s_binding'] == 'binding') { //从社会化绑定页登录
								//$code_url = DX_URL;
								$code_url = MYSHOW_URL."index.php?m=community&c=index&a=index";
								showmessage('login_succeed',$code_url,$param);
							}elseif($_G['gp_myshow'] == 'yes'){ //从myshow登录，返回到关注专辑页面
								require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php";
								$my_user = UserApi::getCommunityUser($_G['member']['uid']);
								if(count($my_user)==0){
									//$my_data = array(
									//	'uid' => $_G['member']['uid']
									//);
									//DB::insert('community_user_stat',$my_data);
									DB::query("INSERT INTO pre_community_user_stat SET uid=". $_G['member']['uid']);
								}
								$r = UserApi::getUserIsFollow($_G['member']['uid']);
								$isfollow = $r["-msg-"];
								if ($isfollow[album] <= 0) { //专辑页
									$code_url = MYSHOW_URL."index.php?m=community&c=firstlogshow&a=follow_album";
									showmessage('login_succeed',$code_url,$param, array('extrajs' => $ucsynlogin));	
								}elseif ($isfollow[follow] <= 0){  //用户页
									$code_url = MYSHOW_URL."index.php?m=community&c=firstlogshow&a=follow_user";
									showmessage('login_succeed',$code_url,$param, array('extrajs' => $ucsynlogin));
								}elseif ($isfollow[arr] <= 0){   //创建专辑页
									$code_url = MYSHOW_URL."index.php?m=community&c=firstlogshow&a=create_album";
									showmessage('login_succeed',$code_url,$param, array('extrajs' => $ucsynlogin));
								}else {
									//$code_url = PCMS_URL."index.php?m=community&c=firstlogshow&a=follow_album";
									//showmessage('login_succeed',$code_url,$param);
									showmessage('login_succeed', $invite?'home.php?mod=space&do=home':dreferer(), $param, array('extrajs' => $ucsynlogin));
								}
							}else {
								showmessage('login_succeed', $invite?'home.php?mod=space&do=home':dreferer(), $param, array('extrajs' => $ucsynlogin));
							}
						}
						
//						showmessage('login_succeed', $invite?'home.php?mod=space&do=home':dreferer(), $param, array('extrajs' => $ucsynlogin));
					}
				}
				
				
			} elseif($result['status'] == -1) {
				$auth = authcode($result['ucresult']['username']."\t".FORMHASH, 'ENCODE');
				$location = 'member.php?mod='.$_G['setting']['regname'].'&action=activation&auth='.rawurlencode($auth);
				if($_G['inajax'] && empty($_G['gp_quickforward'])) {
					$message = 2;
					include template('member/login');
				} else {
					showmessage('login_activation', $location);
				}
			} else {
				$password = preg_replace("/^(.{".round(strlen($_G['gp_password']) / 4)."})(.+?)(.{".round(strlen($_G['gp_password']) / 6)."})$/s", "\\1***\\3", $_G['gp_password']);
				$errorlog = dhtmlspecialchars(
					TIMESTAMP."\t".
					($result['ucresult']['username'] ? $result['ucresult']['username'] : dstripslashes($_G['gp_username']))."\t".
					$password."\t".
					"Ques #".intval($_G['gp_questionid'])."\t".
					$_G['clientip']);
				writelog('illegallog', $errorlog);
				loginfailed($_G['member_loginperm']);
				$fmsg = $result['ucresult']['uid'] == '-3' ? (empty($_G['gp_questionid']) || $answer == '' ? 'login_question_empty' : 'login_question_invalid') : 'login_invalid';
				if($_G['gp_myshow'] == 'yes'){
					$url = MYSHOW_URL."index.php?m=community&c=index&a=index";
				}else{
					$url = "/";
				}
				showmessage($fmsg, $url, array('loginperm' => $_G['member_loginperm']));
			}

		}

	}

	function on_logout() {
		global $_G;

		$ucsynlogout = $_G['setting']['allowsynlogin'] ? uc_user_synlogout() : '';
		setcookie("loginStatus", 0, time()+(3600*60*24)); 
		if($_G['gp_formhash'] != $_G['formhash']) {
			showmessage('logout_succeed', dreferer(), array('formhash' => FORMHASH, 'ucsynlogout' => $ucsynlogout));
		}

		clearcookies();
		$_G['groupid'] = $_G['member']['groupid'] = 7;
		$_G['uid'] = $_G['member']['uid'] = 0;
		$_G['username'] = $_G['member']['username'] = $_G['member']['password'] = '';
		$_G['setting']['styleid'] = $_G['setting']['styleid'];

		showmessage('logout_succeed', dreferer(), array('formhash' => FORMHASH, 'ucsynlogout' => $ucsynlogout));
	}

}

function clearcookies() {
	setcookie("loginStatus", 0, time()+(3600*60*24));
	global $_G;
	foreach($_G['cookie'] as $k => $v) {
		dsetcookie($k);
	}
	$_G['uid'] = $_G['adminid'] = 0;
	$_G['username'] = $_G['member']['password'] = '';
}

?>