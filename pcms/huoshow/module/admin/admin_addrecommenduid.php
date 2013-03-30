<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/HuoshowSys.class.php");//分页类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php");
$huoshowSys = & HuoshowSys::instance();
$huoshowSys->checkAdminLimit();
//模板初始化
$smarty1 = smarty_init();
$dblink = new DataBase("");
if (!empty($_POST)) {
	$recommend_uid = $_G['gp_recommend_uid'];
		if (empty($recommend_uid)){
			echo "<script>alert('请填写内容');</script>";
		}elseif(!is_numeric($recommend_uid) || $recommend_uid < 0) {
			echo "<script>alert('填写内容必须是整数数字');</script>";
		}else {
			$sql = "select uid from pre_weibo_recommend where uid='$recommend_uid'";
			$isrecommend = $dblink->getRow($sql);
				if(empty($isrecommend[0]['uid'])) {
					$dblink->query("insert into pre_weibo_recommend (`uid`) value ('$recommend_uid');");
				} else {
					die('Uid已存在,<a href="?action=huoshow&operation=addrecommenduid"><strong>请重新添加</strong></a>！！！');
				}
			
			header("Location:?action=huoshow&operation=weibo");
	}
}

$dblink->dbclose();
//$smarty1->assign("test",$test);
$smarty1->display("admin/admin_addrecommenduid.html");
?>