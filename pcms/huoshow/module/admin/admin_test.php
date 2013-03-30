<?
//引入需要的文件
//数据库操作类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
//火秀系统类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/HuoshowSys.class.php");
//分页类
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/Pager.class.php");
//后台所有php文件都需要加这句话，用于权限判断等初始化操作
$huoshowSys = & HuoshowSys::instance();
$huoshowSys->checkAdminLimit();
var_dump($_GET);
//模板初始化
$smarty1 = smarty_init();

//开始程序逻辑
//$_G["gp_ 在huoshow中也有定义，因此可以放心使用,代表_GET或者_POST传值
$page = empty($_G["gp_page"])?1:$_G["gp_page"];
//每页条目数
$page_record = 10;
//初始化数据库链接
//数据库操作最重要就是两个成员函数，getRow 获得查询结果(select)，query 只提交执行而不管返回(insert,update...)
//getRow返回结果数组
//其他用法看类实现文件
$dblink = new DataBase("");
//查询，获得记录总数
$db_arr = $dblink->getRow("select count(*) as count from pre_common_member order by uid desc");
$user_count = $db_arr[0]["count"];
$user_arr = $dblink->getRow("select uid,username,email from pre_common_member order by uid desc limit ".($page-1)*$page_record.",$page_record");
//关闭数据库链接
$dblink->dbclose();
//获得分页字符串
//注意，分页类除了适用动态链接，也适用伪静态链接和js链接，具体看类实现
$page_split = new PagerSplit($user_count,$page,$page_record);
$page_str = $page_split->GetPagerContent();


//开始定义模板
$smarty1->assign("user_arr",$user_arr);
$smarty1->assign("page_str",$page_str);
$smarty1->display("admin/user_list.html");
?>