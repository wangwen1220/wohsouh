<?php

/**
 * 安装保10洁帖子净化插件
 */
if (!defined('IN_DISCUZ')) exit('Access Denied');
$lockFile = HL_CACHE_ROOT . HL_DS . 'bao10jie' . HL_DS . 'install.lock'; #已安装的锁文件
if (!file_exists($lockFile)) {
    #生成插件的缓存目录
    if (!is_dir(HL_CACHE_ROOT . HL_DS . 'bao10jie')) {
        mkdir(HL_CACHE_ROOT . HL_DS . 'bao10jie', 0777);
    }
    if (!is_dir(HL_CACHE_ROOT . HL_DS . 'bao10jie' . HL_DS . 'log')) {
        mkdir(HL_CACHE_ROOT . HL_DS . 'bao10jie' . HL_DS . 'log', 0777);
    }

    require_once HL_PLUGIN_ROOT . HL_DS . 'config.inc.php';

    $Purify_CONFIG['LOG_LEVEL'] = 1; #日志级别
    $Purify_CONFIG['PURIFY_FIELD'] = "invisible"; #帖子前台显示方式
    $Purify_CONFIG['CALL_NUM'] = 5; #脚本数量
    $Purify_CONFIG['MULTI_POST'] = 0; #是否启用分表
    #版块配置数组
    $Purify_CONFIG['BOARDS_IDENTIFY'] = array();

    #生成配置文件内容
    ob_start();
    include HL_PLUGIN_ROOT . HL_DS . 'template' . HL_DS . 'psetini.tpl.php';
    $setContent1 = ob_get_clean();
    $setContent1 = str_replace('[$]', '$', $setContent1);
    $setContent1 = '<?php' . $setContent1 . '?>';

    ob_start();
    include HL_PLUGIN_ROOT . HL_DS . 'template' . HL_DS . 'psetini_ext.tpl.php';
    $setContent2 = ob_get_clean();
    $setContent2 = str_replace('[$]', '$', $setContent2);
    $setContent2 = '<?php' . $setContent2 . '?>';

    #把配置内容保存到文件
    $cfgFile1 = HL_CACHE_ROOT . HL_DS . 'bao10jie' . HL_DS . 'config.inc.php'; #正式的配置文件
    $cfgFile2 = HL_CACHE_ROOT . HL_DS . 'bao10jie' . HL_DS . 'config_ext.inc.php'; #正式的配置文件

    if (file_put_contents($cfgFile1, $setContent1)) {

        @file_put_contents($cfgFile2, $setContent2);
        
        if (HL_VERSION == "X2" || HL_VERSION == "X1.5") {
            $tb_purify = DB::table('purifyhylanda');
            $tb_cache = DB::table('cachehylanda');
            require_once dirname(__FILE__) . HL_DS . "sql.php";
            DB::query($sql_cache);
            
            DB::query($sql_purify);
            #查询是否存在“applys”字段，没有并添加，并更新补发标识
            $isApplys = 0;
            #查询是否存在“status”字段, 没有并添加
            $isStatus = 0;
            $query = DB::query("DESC `" . $tb_purify . "`");
            while ($row = DB::fetch($query)) {
                if ($row['Field'] == 'applys') {
                    $isApplys = 1;
                    continue;
                }
            	if ($row['Field'] == 'status') {
                    $isStatus = 1;
                    continue;
                }
            }
            if (!$isApplys) {
                DB::query("ALTER TABLE `" . $tb_purify . "` ADD `applys` TINYINT(2) NOT NULL DEFAULT '0' COMMENT '数据补发次数，-1：正在补发 0：未补发 N：补发N次'");
                DB::query("UPDATE `" . $tb_purify . "` SET `applys`='1' WHERE `sig`<>'-1'");
            }
        	if (!$isStatus) {
                DB::query("ALTER TABLE `" . $tb_purify . "` ADD `status` TINYINT(2) NOT NULL DEFAULT '-3' COMMENT '帖子状态字段,-3:未识别;-2:仅识别;-1:删除;0:待审;1:通过'");
                DB::query("ALTER TABLE `" . $tb_purify . "` ADD `first` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '是否是首帖'");
                DB::query("ALTER TABLE `" . $tb_purify . "` ADD `fid` SMALLINT(6) NOT NULL DEFAULT '0' COMMENT '版块id'");
                DB::query("ALTER TABLE `" . $tb_purify . "` ADD `tid` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '主题id'");
            }
        } else {
            $tb_purify = $tablepre . 'purifyhylanda';
            $tb_cache = $tablepre . 'cachehylanda';
            require_once dirname(__FILE__) . HL_DS . "sql.php";
            $db->query($sql_cache);
            
            //将原来版本的表的数据复制到新表
            if ($db->fetch_row($db->query("SHOW TABLES LIKE '".$tb_purify."'"))) {//2.0.0版
                //查询是否存在“ispurify”字段
                $isp = $isa = $upt = 0;
                #查询是否存在“status”字段, 没有并添加
            	$isStatus = 0;

                $query = $db->query("DESC `".$tb_purify."`");
                while ($row = $db->fetch_array($query)) {
                    if ($row['Field'] == 'ispurify') {
                        $isp = 1;
                        continue;
                    }
                    if ($row['Field'] == 'applys') {
                        $isa = 1;
                        continue;
                    }
                    if ($row['Field'] == 'updatetime') {
                        $upt = 1;
                        continue;
                    }
	                if ($row['Field'] == 'status') {
	                    $isStatus = 1;
	                    continue;
	                }
                }

                //为2.0.1版添加‘applys’字段
                if (!$isa) {
                    $db->query("ALTER TABLE `{$tablepre}purifyhylanda` ADD `applys` TINYINT(2) NOT NULL DEFAULT '0' COMMENT '数据补发次数，-1：正在补发 0：未补发 N：补发N次'");
                }
                if (!$upt) {
                    $db->query("ALTER TABLE `{$tablepre}purifyhylanda` ADD `updatetime` INT(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '帖子信息被更新时间'");
                }
	            if (!$isStatus) {
	            	$db->query("ALTER TABLE `{$tablepre}purifyhylanda` ADD `status` TINYINT(2) NOT NULL DEFAULT '-3' COMMENT '帖子状态字段,-3:未识别;-2:仅识别;-1:删除;0:待审;1:通过'");
	            	$db->query("ALTER TABLE `{$tablepre}purifyhylanda` ADD `first` TINYINT(1) NOT NULL DEFAULT '0' COMMENT '是否是首帖'");
	            	$db->query("ALTER TABLE `{$tablepre}purifyhylanda` ADD `fid` SMALLINT(6) NOT NULL DEFAULT '0' COMMENT '版块id'");
	            	$db->query("ALTER TABLE `{$tablepre}purifyhylanda` ADD `tid` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '主题id'");
	            }

                //复制2.0.0版中的老数据到新表
                if ($isp == 1) {
                    //重命名原来的表
                    $db->query("RENAME TABLE `{$tablepre}purifyhylanda` TO `{$tablepre}purifyhylanda_bak2HY`");

                    #安装一个新表
                    $create = $db->query($sql_purify);

                    //将原来的备份表数据，给复制到新表中
                    $db->query("INSERT INTO `{$tablepre}purifyhylanda` SELECT `pid`,`sig`,`sendtime`,`edittime`,`ispurify` AS isignore,`id` AS `applys` FROM `{$tablepre}purifyhylanda_bak2HY`");

                    //修改数据
                    $db->query("UPDATE `{$tablepre}purifyhylanda` SET `isignore`=0 WHERE 1 AND `isignore`=1");
                    $db->query("UPDATE `{$tablepre}purifyhylanda` SET `isignore`=1 WHERE 1 AND `isignore`>1");
                    //$db->query("UPDATE `{$tablepre}purifyhylanda` SET `applys`=0 WHERE 1");

                    //删除原来的表
                    $db->query("DROP TABLE `{$tablepre}purifyhylanda_bak2HY`");
                }
            } else {
                $create = $db->query($sql_purify);
            }
        }


        #生成锁文件
        if (file_put_contents($lockFile, date('YmdHis'))) {
            $finish = TRUE;
        } else {
            $finish = FALSE;
        }
    }
}


