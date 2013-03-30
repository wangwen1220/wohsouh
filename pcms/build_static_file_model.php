<?php
/**
 *  index.php PHPCMS 入口
 *
 * @copyright			(C) 2005-2010 PHPCMS
 * @license				http://www.phpcms.cn/license/
 * @lastmodify			2010-6-1
 */

define('PHPCMS_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
$_SERVER["DOCUMENT_ROOT"] = dirname(__FILE__);

$_GET["m"] = "test";
$_GET["c"] = "test";
$_GET["a"] = "buildallpage";

$_POST["modelid"] = "3";
$_POST["catids[]"] = '0';
$_POST["dosubmit"] = '1';
$_POST["pagesize"] = 10;
$_POST["number"] = 1600;
$_POST["type"] = "lastinput";


include PHPCMS_PATH.'/phpcms/base.php';

pc_base::creat_app();


?>