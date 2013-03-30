<?php
/**
 *  index.php PHPCMS 入口
 *
 * @copyright			(C) 2005-2010 PHPCMS
 * @license				http://www.phpcms.cn/license/
 * @lastmodify			2010-6-1
 */
 //PHPCMS根目录
//xhprof_enable();
//xhprof_enable(XHPROF_FLAGS_NO_BUILTINS); //不记录内置的函数
//xhprof_enable(XHPROF_FLAGS_CPU + XHPROF_FLAGS_MEMORY);  //同时分析CPU和Mem的开销
//$xhprof_on = false;
//
//define('PHPCMS_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
//
//include PHPCMS_PATH.'/phpcms/base.php';
//
//pc_base::creat_app();
//
//
//if($xhprof_on){
//	$xhprof_data = xhprof_disable();
//	$xhprof_root = PHPCMS_PATH.'/xhprof_html';
//	require_once($xhprof_root."/xhprof_lib/utils/xhprof_lib.php");
//	require_once($xhprof_root."/xhprof_lib/utils/xhprof_runs.php");
//	$xhprof_runs = new XHProfRuns_Default();
//	$run_id = $xhprof_runs->save_run($xhprof_data, "hx");
//	//echo '<a href="http://pnews.ck.huoshow.com/xhprof_html/xhprof_html/index.php?run='.$run_id.'&source=hx" target="_blank">统计</a>';
//}

/**
 *  index.php PHPCMS 入口
 *
 * @copyright			(C) 2005-2010 PHPCMS
 * @license				http://www.phpcms.cn/license/
 * @lastmodify			2010-6-1
 */
 //PHPCMS根目录

define('PHPCMS_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

include PHPCMS_PATH.'/phpcms/base.php';

pc_base::creat_app();


?>