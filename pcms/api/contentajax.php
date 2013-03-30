<?php 

define('PHPCMS_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

$action = $_GET["a"];
if($action == "getcategory")
{
	$catid = intval($_GET['catid']);
	$siteid = get_siteid();
	$categoryss = getcache('category_content_'.$siteid,'commons');
	
	$modelid = $categoryss[$catid]['modelid'];
	$tree = pc_base::load_sys_class('tree');
	$tree->icon = array('&nbsp;&nbsp;│ ','&nbsp;&nbsp;├─ ','&nbsp;&nbsp;└─ ');
	$tree->nbsp = '&nbsp;&nbsp;';
	$categorys = array();
	$string = "<select name=\"tocatid\" id=\"tocatid\"  size=\"2\"  style=\"height:300px;width:350px;\">";
	foreach($categoryss as $cid=>$r) {
		if($siteid != $r['siteid'] || $r['type']) continue;
		//if($modelid && $modelid != $r['modelid']) continue;
		if($r['child'])
		{
			$r['disabled'] = 'disabled';
			//continue;
		}
		else
		{
			if($modelid && $modelid != $r['modelid'])
			{
				$r['disabled'] = 'disabled';
				//continue;
			}
			else
			{
				$r['disabled'] = '';
			}
		}
		//$r['disabled'] = $r['child'] ? 'disabled' : '';
		//$r['selected'] = $cid == $catid ? 'selected' : '';
		if($cid == $catid)
			$r['disabled'] = 'disabled';
		$categorys[$cid] = $r;
	}
	$str  = "<option value='\$catid' \$selected \$disabled>\$spacer \$catname</option>";
	$tree->init($categorys);
	$string .= $tree->get_tree(0, $str);
	$string.="</select>";
	echo $string;
}

?>