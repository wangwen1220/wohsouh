<?php
$act = $_GET["p"];
if($act == "get_special_collar"){
	getSpecialCollar($_GET["specialid"]);
}

/**
 * 获得专题号子
 */
function getSpecialCollar($specialid){
	
	include template('special','special_collar');
}


?>