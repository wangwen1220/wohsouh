<?php
ini_set("display_errors","On");
/*
	$require_path 需要测试的目录
	
	如果只需要测试某个人的测试用例，
	则修改$require_path为	那个人的目录，比如
	$require_path = "./group/chengkui";
	注意，变量后面不要加"/"
	
	如果只需要测试某个单元测试，可直接浏览器访问，比如
	http://live.beta.huoshow.com/test_unit/group/chengkui/test_circle.php
*/
$require_path = "./group";


$total_file = array();
traversal_and_include($require_path);
$count = count($total_file);
for($i=0;$i<$count;$i++)
{
	require_once($total_file[$i]);
}

/**
 * 遍历并且引入
 *
 * @param unknown_type $root_path 遍历的根目录
 */
function traversal_and_include($root_path)
{
	global $total_file;
	if ($handle = opendir($root_path)) 
	{
		while (false !== ($file = readdir($handle))) 
		{
			if ($file != "." && $file != ".." && $file!='.svn') 
			{
				if(is_dir($root_path."/".$file))
				{
					traversal_and_include($root_path."/".$file);
				}
				else 
				{
					$total_file[] =  $root_path."/".$file;
				}
			}
		}
		closedir($handle);
	}
}



?>