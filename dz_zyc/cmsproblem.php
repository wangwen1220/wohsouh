<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: home.php 16805 2010-09-15 03:56:11Z zhangguosheng $
 */

header("Content-Type: text/xml; charset=UTF-8");
require_once './source/class/class_core.php';
require_once './source/function/function_home.php';

$discuz = & discuz_core::instance();

$discuz->init();


runhooks();
$res=array();

if(trim($_GET['problem_title'])=='' || trim($_GET['problem_content'])=='' || trim($_GET['problem_email'])=='')
   {
   	  $res['res']=0;
   }
   $data=array(
   'title'=>htmlspecialchars($_GET['problem_title'],ENT_QUOTES),
   'content'=>htmlspecialchars($_GET['problem_content'],ENT_QUOTES),
   'email'=>htmlspecialchars($_GET['problem_email'],ENT_QUOTES),
   'url'=>htmlspecialchars($_SERVER['HTTP_REFERER'],ENT_QUOTES),
   'ip'=>$_SERVER['REMOTE_ADDR'],
   'dateline'=>time()
   );
   !empty($_G['username']) ? $data['username']=$_G['username'] : "";
   $res=DB::insert('web_problem', $data,1);
   if($res)
   {
   	    $res['res']=1;
   }
   else 
   {
   	  $res['res']=0;
   }
//print  json_encode($res);
echo $_GET['jsoncallback'], '(', json_encode($res), ')'; 
exit;

