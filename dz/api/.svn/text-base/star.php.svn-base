<?php
define('CURSCRIPT', 'apidb');
define('ACTID',4);
require './../source/class/class_core.php';
$discuz = & discuz_core::instance();
$discuz->init();
require DISCUZ_ROOT.'source/function/function_group.php';
$act = @$_GET['act'];
if(trim($act)=='') die();
//$dzUrl = 'http://dev.huoshow.com/';
$dzUrl = $_GET['dz_url'];

if($act=='star'){
	$data['recommend']=unserialize($_G['setting']['group_recommend']);
	sort($data['recommend']);
	if (empty($data['recommend']['icon'])) {
	$data['recommend']['icon'] = $dzUrl.'static/image/common/groupicon.gif';
	}else {
		$data['recommend']['icon'] = $dzUrl.'data/attachment/group/'.$data['recommend']['icon'];
		exit;
	}
	$uid=$_G['uid'];
	$c1=$data['recommend'][0]['fid'];
	$c2=$data['recommend'][1]['fid'];
	$c3=$data['recommend'][2]['fid'];
	$c4=$data['recommend'][3]['fid'];
	$query = DB::query("SELECT f.name,f.posts,ff.membernum,ff.icon FROM pre_forum_forum f LEFT JOIN pre_forum_forumfield ff ON ff.fid=f.fid WHERE f.fid IN (select fid from pre_forum_groupuser where uid in(SELECT founderuid FROM pre_forum_forumfield WHERE fid =".$c1.")) AND f.type='sub' AND f.status=3 ORDER BY ff.membernum desc");
	while($rs = DB::fetch($query)) {
		$fensi1[]=$rs;
		$data['fensi1']=$fensi1;
	}
	$num_rows = mysql_num_rows($query);
	$data['num0'] = $num_rows;
	$query = DB::query("SELECT ff.membernum,sum(ff.membernum) as num FROM pre_forum_forum f LEFT JOIN pre_forum_forumfield ff ON ff.fid=f.fid WHERE f.fid IN (select fid from pre_forum_groupuser where uid in(SELECT founderuid FROM pre_forum_forumfield WHERE fid =".$c1.")) AND f.type='sub' AND f.status=3 ");
	while($rs = DB::fetch($query)) {
		$numfensi[]=$rs;
		$data['numfensi0']=$numfensi;
	}
	$query = DB::query("SELECT f.name,f.posts,ff.membernum,ff.icon FROM pre_forum_forum f LEFT JOIN pre_forum_forumfield ff ON ff.fid=f.fid WHERE f.fid IN (select fid from pre_forum_groupuser where uid in(SELECT founderuid FROM pre_forum_forumfield WHERE fid =".$c2.")) AND f.type='sub' AND f.status=3 ORDER BY ff.membernum desc");
	while($rs = DB::fetch($query)) {
		$fensi2[]=$rs;
		$data['fensi2']=$fensi2;
	}
	$num_rows = mysql_num_rows($query);
	$data['num1'] = $num_rows;
	$query = DB::query("SELECT ff.membernum,sum(ff.membernum) as num FROM pre_forum_forum f LEFT JOIN pre_forum_forumfield ff ON ff.fid=f.fid WHERE f.fid IN (select fid from pre_forum_groupuser where uid in(SELECT founderuid FROM pre_forum_forumfield WHERE fid =".$c2.")) AND f.type='sub' AND f.status=3 ");
	while($rs = DB::fetch($query)) {
		$numfensi[]=$rs;
		$data['numfensi1']=$numfensi;
	}
	$query = DB::query("SELECT f.name,f.posts,ff.membernum,ff.icon FROM pre_forum_forum f LEFT JOIN pre_forum_forumfield ff ON ff.fid=f.fid WHERE f.fid IN (select fid from pre_forum_groupuser where uid in(SELECT founderuid FROM pre_forum_forumfield WHERE fid =".$c3.")) AND f.type='sub' AND f.status=3 ORDER BY ff.membernum desc");
	while($rs = DB::fetch($query)) {
		$fensi3[]=$rs;
		$data['fensi3']=$fensi3;
	}
	$num_rows = mysql_num_rows($query);
	$data['num2'] = $num_rows;
	$query = DB::query("SELECT ff.membernum,sum(ff.membernum) as num FROM pre_forum_forum f LEFT JOIN pre_forum_forumfield ff ON ff.fid=f.fid WHERE f.fid IN (select fid from pre_forum_groupuser where uid in(SELECT founderuid FROM pre_forum_forumfield WHERE fid =".$c3.")) AND f.type='sub' AND f.status=3 ");
	while($rs = DB::fetch($query)) {
		$numfensi[]=$rs;
		$data['numfensi2']=$numfensi;
	}
	$query = DB::query("SELECT f.name,f.posts,ff.membernum,ff.icon FROM pre_forum_forum f LEFT JOIN pre_forum_forumfield ff ON ff.fid=f.fid WHERE f.fid IN (select fid from pre_forum_groupuser where uid in(SELECT founderuid FROM pre_forum_forumfield WHERE fid =".$c4.")) AND f.type='sub' AND f.status=3 ORDER BY ff.membernum desc");
	while($rs = DB::fetch($query)) {
		$fensi4[]=$rs;
		$data['fensi4']=$fensi4;
	}
	$num_rows = mysql_num_rows($query);
	$data['num3'] = $num_rows;
	$query = DB::query("SELECT ff.membernum,sum(ff.membernum) as num FROM pre_forum_forum f LEFT JOIN pre_forum_forumfield ff ON ff.fid=f.fid WHERE f.fid IN (select fid from pre_forum_groupuser where uid in(SELECT founderuid FROM pre_forum_forumfield WHERE fid =".$c4.")) AND f.type='sub' AND f.status=3 ");
	while($rs = DB::fetch($query)) {
		$numfensi[]=$rs;
		$data['numfensi3']=$numfensi;
	}

	die(json_encode($data));
	
}

