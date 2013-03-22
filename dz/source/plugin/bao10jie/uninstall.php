<?php

/*
 * 卸载海量信息帖子净化插件
 * 将数据库中存储净化返回标识的数据表删除
 */
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "common.php";
$DS = DIRECTORY_SEPARATOR;
if (HL_VERSION == "X2" || HL_VERSION == "X1.5") {
    /*
      $sql = "show tables like '" . DB::table('purifyhylanda') . "'";
      $isTable = DB::result_first($sql);
      if($isTable){
      $sql = "drop table `".DB::table('purifyhylanda')."`";
      runquery($sql);
      } */
    @unlink(DISCUZ_ROOT . $DS . 'data' . $DS . 'plugindata' . $DS . 'bao10jie' .$DS.'install.lock');
} else {
    #不删除日志表，在安装的时候，将升级此表
    /*
      $sql = "show tables like '{$tablepre}purifyhylanda'";
      $isTable = $db->fetch_row($db->query($sql));

      if($isTable){
      $sql = "drop table `{$tablepre}purifyhylanda`";
      $db->query($sql);
      }
     */
    @unlink(DISCUZ_ROOT . $DS . 'forumdata' . $DS . 'plugins' . $DS . 'bao10jie'.$DS.'install.lock');
}
$finish = TRUE;
?>

