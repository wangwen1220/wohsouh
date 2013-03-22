<?php
set_time_limit(0);
error_reporting(0);
session_start();
define('RUN_CMSTOP', true);
//require '../cmstop/cmstop.php';
require_once 'Db.class.php';
$dbinc =  require_once '../cmstop/config/db.php';
$db = new Db($dbinc['host'],$dbinc['username'],$dbinc['password'],$dbinc['dbname'],$dbinc['charset']);
$sectionName = $_GET['name'];
$sql = " SELECT sectionid FROM `cmstop_section` where memo = '$sectionName' ";
$id = $db->getOne($sql);
include '../section/'.$id.'.html';
