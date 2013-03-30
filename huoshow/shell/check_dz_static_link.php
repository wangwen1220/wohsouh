<?php

/**
 * 对dz_ext目录下的文件在对应的discuz目录下查找是否有对应的
 * 静态链接，如果没有，自动增加
 *
 * @author chengkui
 * @package defaultPackage
 */
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/configs/config.php");

//if(!file_exists(""))

$src_path   = $_SERVER['DOCUMENT_ROOT']."/huoshow/module/dz_ext";
$dist_path  = $_SERVER['DOCUMENT_ROOT']."";

//var_dump(is_dir("/local/ck_files/project/huoshow/trunk/huoshow_code/dz/source/admincp/menu/"));die();
clearstatcache();
traversing_path($src_path,$dist_path);

/**
 * 对$src的目录进行遍历，如果$dist中不存在$src中的目录或者文件，则做静态链接
 * 使$dist中好像存在$src中的文件一样。
 *
 * @param unknown_type $src
 * @param unknown_type $dist
 */
function traversing_path($src, $dist)
{
	if ($handle = opendir($src))
	{
		while (false !== ($file = readdir($handle))) 
		{
			if ($file != "." && $file != ".." && $file!='.svn') 
			{
				if(!file_exists("$dist/$file"))
				{
					echo "ln -s $src/$file $dist/$file<br>";
					system("ln -s $src/$file $dist/$file");
				}
				else 
				{
					if(is_dir("$dist/$file"))
						traversing_path("$src/$file","$dist/$file");
					/*
					else 
					{
						echo "ln2 -s $src/$file $dist/$file<br>";
						system("ln -s $src/$file $dist/$file");
					}
					*/
				}
			}
		}
		closedir($handle);
	}
}


?>