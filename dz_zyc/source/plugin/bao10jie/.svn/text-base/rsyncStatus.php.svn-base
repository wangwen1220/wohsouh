<?php 
/***********
# ‘保10洁审核平台’同步帖子状态的接口
# 以客户序列号做签名的密钥
# 返回一个数字型标引值
# lsj 2011-5-10
***********/

/***********************处理结果标识**********
#1: 帖子状态操作成功     

#-1: 帖子状态操作失败
#-2: 帖子不存在

#-11: 签名不合法
#-12: 缺少签名参数
#-13: 缺少帖子ID参数
#-14: 缺少操作动作参数
#-15: 本地缺少客户序列号
*********************************************/

set_time_limit(10);
error_reporting(0);
date_default_timezone_set('PRC');

define('APPTYPEID', 1006);
define('CURSCRIPT', 'rsyncStatus');
define('ALLOWGUEST', 1);

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'common.php';
//初始化工作类
$HL_Purify = & Purify::singleton();

#导入保10洁插件的配置文件
require HL_CACHE_ROOT.HL_DS.'bao10jie'.HL_DS.'config.inc.php';
#获取外部参数
$BAO10jie_pid = abs(intval($_POST['pid']));#帖子ID
$BAO10jie_act = abs(intval($_POST['act']));#操作动作：1：通过 2：删除(前台显示‘已删除’字样) 3: 删除(前台直接不显示帖子)
$BAO10jie_sig = strip_tags(trim($_POST['sig']));#签名

#参数校验
if(!$BAO10jie_sig) exit('-12');
if(!$BAO10jie_pid) exit('-13');
if(!$BAO10jie_act) exit('-14');
if(!$Purify_APP_KEY) exit('-15');
#校验签名
$BAO_sig = md5(md5($BAO10jie_act . '&' . $BAO10jie_pid . $Purify_APP_KEY) . $Purify_APP_KEY);
if($BAO_sig != $BAO10jie_sig) exit('-11');

$status = $HL_Purify->rsync($BAO10jie_pid, $BAO10jie_act);
echo $status;
exit();



