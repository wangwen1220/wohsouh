<?php
/*
 * 火秀新社区相关操作封装
 * @author chengkui
 *
 */

require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/DataBase.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/huoshow/FrameWork/weibo.class.php";
require_once  $_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/User.class.php";
require_once $_SERVER["DOCUMENT_ROOT"].'/phpcms/libs/classes/class_cmemcache.php';

class Community
{
	/**
	 * 获取分类是否已存在
	 * @param $classname
	 */
	static public function getClassNameIsExist($classname){
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_class WHERE `name`='$classname'";
		$dbarr = $dblink->getRow($sql);
		if (count($dbarr)>0){
			$isexist = 1;
		}else{
			$isexist = 0;
		}
		return $isexist;
	}
	
	/**
	 * 获取标签是否已存在
	 * @param unknown_type $tagname
	 */
	static public function getTagNameIsExist($tagname){
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_file_tag WHERE tag_name='$tagname'";
		$dbarr = $dblink->getRow($sql);
		if (count($dbarr)>0){
			$isexist = 1;
		}else{
			$isexist = 0;
		}
		return $isexist;
	}
	
	/**
	 * 当分类，标签修改时，也相对应的修改推荐位下的数据
	 * @param unknown_type $name
	 * @param unknown_type $name
	 */
	static public function updatePosName($id,$name){
		$dblink = new DataBase("");
		$sql = "UPDATE pre_community_position_data SET `name`='$name' WHERE classid=$id";
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 添加类别
	 * @param unknown_type $name
	 * @param unknown_type $icon
	 * @return	如果失败，msg为失败原因
	 * 			如果成功，msg为增加后的类别ID
	 */
	static public function createClass($name,$icon)
	{
		if( empty($name) )
			return getR(false,"类别名称异常");
		$dblink = new DataBase("");
		
		$sql = "INSERT INTO pre_community_class (pic,`name`) 
			VALUES ('$icon','$name');";
		$dblink->query($sql);
		
		$id = $dblink->get_id();
		$dblink->dbclose();
		return getR(true,$id);
	}
	
	/**
	 * 修改类别信息
	 * @param unknown_type $id		需要修改类别的ID
	 * @param unknown_type $name	需要修改的类别名
	 * @param unknown_type $icon	需要修改的类别图标
	 * @return 如果false,msg为失败原因
	 */
	static public function updateClass($id,$name,$icon,$h_name)
	{
		if(!is_numeric($id)|| $id<=0)
			return getR(false,"ID信息异常");
		if(empty($name) && empty($icon))
			return getR(false,"类别名称信息异常");
		$dblink = new DataBase("");
		$name_sql = (empty($name))?"":"`name`='$name'";
		$icon_sql = (empty($icon))?"":",`pic`='$icon'";
		$addsql = trim($name_sql.$icon_sql,",");
		$sql = "update pre_community_class set $addsql where id='$id'";
		$dblink->query($sql);
		//修改推荐位下的数据
		$sql = "SELECT * FROM pre_community_position_data WHERE `name`='$h_name'";
		$u_name = $dblink->getRow($sql);
		for ($i = 0; $i < count($u_name); $i++) {
			Community::updatePosName($u_name[$i][classid], $name);
		}
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * * 根据类别ID得到类别信息
	 *  @param unknown_type $id		类别的ID
	 */
	static public function getClassInfo($id)
	{
		if(!is_numeric($id)|| $id<=0)
			return getR(false,"ID信息异常");
		$dblink = new DataBase("");
		$sql = "SELECT `name`,pic,`ORDER` FROM pre_community_class WHERE id=$id";
		$dbarr = $dblink->getRow($sql);
		$v[arr] = $dbarr;
		return getR(true,$v);
	}
	
	/**
	 * 删除类别
	 * @param unknown_type $id
	 * @return 如果false,msg为失败原因
	 */
	static public function deleteClass($id)
	{
		if(!is_numeric($id) || $id<=0)
			return getR(false,"ID信息异常");
		$dblink = new DataBase("");
		$sql = "delete from pre_community_class where id='$id'";
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true);
	}
	
	
	/**
	 * 获取默认类别
	 * @return unknown
	 */
	static public function getDefaultClass(){
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_class WHERE `default`=1";
		$arr = $dblink->getRow($sql);
		return $arr;
	}
	
	/**
	 * 获得类别列表
	 * @param unknown_type $page
	 * @param unknown_type $recordPerPage
	 * @return unknown_type 成功返回true，并返回：num符合条件的类别总数，arr:类别
	 * 						数组（id,pic,'name'）
	 */
	static public function getClassList($page=1,$recordPerPage=20)
	{
		if(!is_numeric($page) || $page<=0)
			return getR(false,"page异常");
		if(!is_numeric($recordPerPage) || $recordPerPage<=0)
			return getR(false,"recordPerPage异常");
		$dblink = new DataBase("");
		$sql = "select count(*) as num FROM pre_community_class";
		$num_arr = $dblink->getRow($sql);
		$num = $num_arr[0][num];
		
		$sql = "SELECT id,pic,`name`,`order` FROM pre_community_class 
			ORDER BY `order` ASC limit ".($page-1)*$recordPerPage.",$recordPerPage";
		$dbarr = $dblink->getRow($sql);
		$dblink->dbclose();
		$v[num] = $num;
		$v[arr] = $dbarr;
		return getR(true,$v);
		
	}
	
	
	
	/**
	 * 获得默认排序类别列表
	 * @param unknown_type $page
	 * @param unknown_type $recordPerPage
	 * @return unknown_type 成功返回true，并返回：num符合条件的类别总数，arr:类别
	 * 						数组（id,pic,'name'）
	 */
	static public function getClassListdesc()
	{
		$dblink = new DataBase("");
		$sql = "select count(*) as num FROM pre_community_class";
		$num_arr = $dblink->getRow($sql);
		$num = $num_arr[0][num];
		
		$sql = "SELECT id,pic,`name`,`order` FROM pre_community_class 
			ORDER BY id ASC ";
		$dbarr = $dblink->getRow($sql);
		$dblink->dbclose();
		$v[num] = $num;
		$v[arr] = $dbarr;
		return getR(true,$v);
		
	}
	
	/**
	 * 用于分享广场，获取类别列表
	 * @param unknown_type $page
	 * @param unknown_type $recordPerPage
	 * @return unknown_type
	 */
	static public function getClassList2($page=1,$recordPerPage=20){
		if(!is_numeric($page) || $page<=0)
			return getR(false,"page异常");
		if(!is_numeric($recordPerPage) || $recordPerPage<=0)
			return getR(false,"recordPerPage异常");
		$dblink = new DataBase("");
		$sql = "select count(*) as num FROM pre_community_class";
		$num_arr = $dblink->getRow($sql);
		$num = $num_arr[0][num];
		
		$sql = "SELECT id,pic,`name`,`order` FROM pre_community_class WHERE `default`=0
			ORDER BY `order` ASC limit ".($page-1)*$recordPerPage.",$recordPerPage";
		$dbarr = $dblink->getRow($sql);
		$dblink->dbclose();
		$v[num] = $num;
		$v[arr] = $dbarr;
		return getR(true,$v);
	}
	
/**
	 * 用于分享广场，获取类别列表
	 * @param unknown_type $page
	 * @param unknown_type $recordPerPage
	 * @return unknown_type
	 */
	static public function getClassList3($page=0,$recordPerPage=20){
		if(!is_numeric($page) || $page<0)
			return getR(false,"page异常");
		if(!is_numeric($recordPerPage) || $recordPerPage<=0)
			return getR(false,"recordPerPage异常");
		$dblink = new DataBase("");
		$sql = "select count(*) as num FROM pre_community_class";
		$num_arr = $dblink->getRow($sql);
		$num = $num_arr[0][num];
		
		$sql = "SELECT id,pic,`name`,`order` FROM pre_community_class WHERE `default`=0
			ORDER BY `order` ASC limit ".$page.",$recordPerPage";
		$dbarr = $dblink->getRow($sql);
		$dblink->dbclose();
		$v[num] = $num;
		$v[arr] = $dbarr;
		return getR(true,$v);
	}
	
	/**
	 * 获得标签列表
	 * @param unknown_type $excludeid 需要排除的类别ID，默认为0
	 * 									如果不为0，则需要去掉与这个类别关联的标签
	 * @return 失败返回原因
	 * 			成功返回数组，内容为pre_community_file_tag表的内容
	 */
	static public function getTagList($lists,$keyword,$exclude_classid=0,$page=1,$recordPerPage=20)
	{
		if(!is_numeric($exclude_classid) || $exclude_classid<0)
			return getR(false,"排除类别ID异常");
		$where = "";
		if ($lists == 0){
			$where = empty($keyword) ? "":"WHERE tag_name like '%$keyword%'";
		}elseif ($lists == 1){
			$where = empty($keyword) ? " WHERE uid='' " : "WHERE tag_name like '%$keyword%' AND uid=''";
		}elseif ($lists == 2) {
			$where = empty($keyword) ? " WHERE uid!=0 " : "WHERE tag_name like '%$keyword%' AND uid!=0";
		}
		$dblink = new DataBase("");

		$sql = "select count(*) as num FROM pre_community_file_tag $where";
		$num_arr = $dblink->getRow($sql);
		$num = $num_arr[0][num];
		
		$exclude_classid_sql = empty($exclude_classid)?"":
			"WHERE id NOT IN(SELECT tagid 
				FROM pre_community_class_tag_map WHERE classid='$exclude_classid')";
		
//		$sql = "SELECT * FROM pre_community_file_tag $exclude_classid_sql $where
//				ORDER BY id DESC limit ".($page-1)*$recordPerPage.",$recordPerPage";
		$sql = "SELECT *,(SELECT COUNT(*) FROM pre_community_file_tag_map c WHERE a.id=c.tag_id) AS num 
				FROM pre_community_file_tag a $exclude_classid_sql $where
				ORDER BY num DESC limit ".($page-1)*$recordPerPage.",$recordPerPage";
//		echo $sql;
		$dbarr = $dblink->getRow($sql);
		$dblink->dbclose();
		$v[num] = $num;
		$v[arr] = $dbarr;
		return getR(true,$v);
	}
	
	/**
	 * 获得标签列表
	 * @param unknown_type $excludeid 需要排除的类别ID，默认为0
	 * 									如果不为0，则需要去掉与这个类别关联的标签
	 * @return 失败返回原因
	 * 			成功返回数组，内容为pre_community_file_tag表的内容
	 */
	static public function getTagList_Admin($lists,$keyword,$exclude_classid=0,$page=1,$recordPerPage=20,$hot,$start_time,$end_time)
	{
		if(!is_numeric($exclude_classid) || $exclude_classid<0)
			return getR(false,"排除类别ID异常");
		$where = "";
		if ($lists == 0){
			$where = empty($keyword) ? "":"AND tag_name like '%$keyword%' ";
		}elseif ($lists == 1){
			$where = empty($keyword) ? " AND uid='' " : "WHERE tag_name like '%$keyword%' AND uid=''";
		}elseif ($lists == 2) {
			$where = empty($keyword) ? " AND uid!=0 " : "WHERE tag_name like '%$keyword%' AND uid!=0";
		}
		
		$time_sql = empty($start_time) ? "":"AND `datetime`>= $start_time";
		$end_time = empty($end_time) ? "":"AND `datetime`<=$end_time";
		$hot_sql = empty($hot) ? "":"WHERE num>=$hot";
		$dblink = new DataBase("");

//		$sql = "SELECT count(*) as num FROM (SELECT *,(SELECT COUNT(*) FROM pre_community_file_tag_map c WHERE a.id=c.tag_id) AS num 
//				FROM pre_community_file_tag a WHERE 1=1 $where $time_sql $end_time) tmp $hot_sql";
//		$num_arr = $dblink->getRow($sql);
//		$num = $num_arr[0][num];
		
//		$sql = "SELECT * FROM (SELECT *,(SELECT COUNT(*) FROM pre_community_file_tag_map c WHERE a.id=c.tag_id) AS num 
//				FROM pre_community_file_tag a WHERE 1=1 $where $time_sql $end_time) tmp $hot_sql
//				ORDER BY num DESC limit ".($page-1)*$recordPerPage.",$recordPerPage";
//		$dbarr = $dblink->getRow($sql);
		
		$sql = "SELECT count(*) as num FROM pre_community_file_tag WHERE 1=1 $where $time_sql $end_time ";
		$num_arr = $dblink->getRow($sql);
		$num = $num_arr[0][num];

		$sql = "SELECT * FROM pre_community_file_tag WHERE 1=1 $where $time_sql $end_time ORDER BY datetime DESC limit ".($page-1)*$recordPerPage.",$recordPerPage";
		$dbarr = $dblink->getRow($sql);
		for ($i = 0; $i < count($dbarr); $i++) {
			if ($dbarr[$i][id]){
				$sql = "SELECT count(*) as num FROM pre_community_file_tag_map WHERE tag_id=".$dbarr[$i][id];
				$arr_num = $dblink->getRow($sql);
				$dbarr[$i][num] = $arr_num[0][num];
			}			
		}
		$dblink->dbclose();
		$v[num] = $num;
		$v[arr] = $dbarr;
		return getR(true,$v);
	}
	
	
	/**
	 * 根据id得到标签信息
	 * @param unknown_type $tagid
	 * @return unknown_type
	 */
	static public function getTagInfo($tagid){
		if(!is_numeric($tagid)|| $tagid<=0)
			return getR(false,"ID标签异常");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_file_tag WHERE id=$tagid";
		$dbarr = $dblink->getRow($sql);
		$v[arr] = $dbarr;
		return getR(true,$v);
	}
	
	
	/**
	 * 根据id得到专辑信息
	 * @param unknown_type $albumid
	 * @return unknown_type
	 */
	static public function getAlbumInfo($tagid){
		if(!is_numeric($tagid)|| $tagid<=0)
			return getR(false,"ID标签异常");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_album WHERE id=$tagid";
		$dbarr = $dblink->getRow($sql);
		$v[arr] = $dbarr;
		return getR(true,$v);
	}
	
	/**
	 * 查找创建专辑名称是否存在
	 * @param unknown_type $album_name
	 * @return unknown_type
	 */
	static public function getCreateAlbumName($album_name = array()){
		if($album_name=="")
			return getR(false,"专辑名称异常");
		$dblink = new DataBase("");
		$sql = "select * from pre_community_album where album_name like '$album_name[0]'";
		$dbarr = $dblink->getRow($sql);
		if(!empty($dbarr)){
			$arr = 1;//要创建的专辑名称已存在	
		}else{
			$arr = 0;
		}
		return $arr;
	}
	
	
	/**
	 * 根据专辑id得到专辑推荐信息
	 * @param unknown_type $albumid
	 * @return unknown_type
	 */
	static public function getAlbumrecommend ($albumid){
		if(!is_numeric($albumid)|| $albumid<=0)
			return getR(false,"专辑ID异常");
		$dblink = new DataBase("");
		$sql = "SELECT recommend FROM pre_community_album WHERE id=$albumid";
		$dbarr = $dblink->getRow($sql);
		if($dbarr[0]['recommend']==1){
			$arr = 1;
		}else{
			$arr = 0;
		}
		return $arr;
	}
	
	/**
	 * 根据ID修改标签
	 * @param unknown_type $id      		标签ID
	 * @param unknown_type $tag_name		标签名称
	 */
	static public function updateTga($id,$tag_name,$h_name){
		if(!is_numeric($id)|| $id<=0)
			return getR(false,"ID信息异常");
		if(empty($tag_name))
			return getR(false,"类别名称信息异常");
		$dblink = new DataBase("");
		$name_sql = (empty($tag_name))?"":"`tag_name`='$tag_name'";
		$addsql = trim($name_sql,",");
		$sql = "update pre_community_file_tag set
			$addsql where id='$id'";
		$dblink->query($sql);
		//修改推荐位下的数据
		$sql = "SELECT * FROM pre_community_position_data WHERE `name`='$h_name'";
		$u_name = $dblink->getRow($sql);
		for ($i = 0; $i < count($u_name); $i++) {
			Community::updatePosName($u_name[$i][classid], $tag_name);
		}
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 获得类别和标签的映射关系，只显示标签下有分享的标签
	 * @param unknown_type $class_id
	 * @return unknown_type
	 */
	static public function getClassTagMapList($class_id){
		if(!is_numeric($class_id) || $class_id<0)
			return getR(false,"类别ID异常");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM (
			SELECT a.classid,b.id AS tag_id,b.tag_name,
			(SELECT COUNT(*) FROM pre_community_file_tag_map c WHERE b.id=c.tag_id) AS num
			FROM pre_community_class_tag_map a
			INNER JOIN pre_community_file_tag b ON a.tagid=b.id
			WHERE classid='$class_id' ) tmp WHERE num>0 ORDER BY num DESC";
		$dbarr = $dblink->getRow($sql);
		$dblink->dbclose();
		return getR(true,$dbarr);
		
	}
	
	
	/**
	 * 获得类别和标签的映射关系
	 * @param unknown_type $class_id 需要获取的类别ID
	 * @return 失败返回原因
	 *         成功返回数组 classid，tag_id，tag_name
	 * 
	 */
	static public function getClassTagMap($class_id)
	{
		if(!is_numeric($class_id) || $class_id<0)
			return getR(false,"类别ID异常");
		$dblink = new DataBase("");
		$sql = "SELECT a.classid,b.id AS tag_id,b.tag_name 
			FROM pre_community_class_tag_map a
			INNER JOIN pre_community_file_tag b ON a.tagid=b.id
			where classid='$class_id'";
		$dbarr = $dblink->getRow($sql);
		$dblink->dbclose();
		
		return getR(true,$dbarr);
	}
	
	/**
	 * 获得类别和标签的映射关系(后台用到)
	 * @param unknown_type $class_id 需要获取的类别ID
	 * param unknown_type $page 
	 * param unknown_type $recordPerPage 
	 * @return 失败返回原因
	 *         成功返回数组 classid，tag_id，tag_name
	 * 
	 */
	static public function getClassTagMapAdmin($class_id,$page=1,$recordPerPage=20,$order="listorder ASC",$keyword)
	{
		if(!is_numeric($class_id) || $class_id<0)
			return getR(false,"类别ID异常");
		$dblink = new DataBase("");
		
		$where = empty($keyword) ? "":"AND b.tag_name LIKE '%$keyword%'";
		
		$sql = "SELECT count(*) num FROM pre_community_class_tag_map a
			INNER JOIN pre_community_file_tag b ON a.tagid=b.id where classid='$class_id' $where";
		$num_arr = $dblink->getRow($sql);
		$num = $num_arr[0][num];
		
		$sql = "SELECT a.classid,b.id AS tag_id,b.tag_name,a.listorder,
			(SELECT COUNT(*) FROM pre_community_file_tag_map c WHERE b.id=c.tag_id) AS num 
			FROM pre_community_class_tag_map a
			INNER JOIN pre_community_file_tag b ON a.tagid=b.id
			where classid='$class_id' $where ORDER BY $order LIMIT ".($page-1)*$recordPerPage.",$recordPerPage";
		$dbarr = $dblink->getRow($sql);
		$dblink->dbclose();
		$v[num] = $num;
		$v[arr] = $dbarr;
		return getR(true,$v);
//		return getR(true,$dbarr);
	}
	
	/**
	 * 建立类别-标签映射关系
	 * @param unknown_type $classid
	 * @param unknown_type $tagid
	 * @return 如果失败，msg为失败原因
	 */
	static public function createClassTagMap($classid,$tagid)
	{
		if(!is_numeric($classid) || $classid<=0)
			return getR(false,"类别ID异常");
		if(!is_numeric($tagid) || $tagid<=0)
			return getR(false,"标签ID异常");
		$dblink = new DataBase("");
		$sql = "INSERT INTO pre_community_class_tag_map 
			(classid,tagid) VALUES ('$classid','$tagid')";
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 删除类别-标签映射关系
	 * @param unknown_type $classid
	 * @param unknown_type $tagid
	 * @return 如果失败，msg为失败原因
	 */
	static public function deleteClassTagMap($classid,$tagid)
	{
		if(!is_numeric($classid) || $classid<=0)
			return getR(false,"类别ID异常");
		if(!is_numeric($tagid) || $tagid<=0)
			return getR(false,"标签ID异常");
		$dblink = new DataBase("");
		
		$sql = "DELETE FROM pre_community_class_tag_map 
			WHERE classid='$classid' AND tagid='$tagid'";
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true);
	}
	
	static public function getAboutTagList($tagid){
		if(!is_numeric($tagid) || $tagid<=0)
			return getR(false,"标签ID异常");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM (	
				SELECT *,(SELECT COUNT(*) FROM pre_community_file_tag_map c WHERE b.id=c.tag_id) AS num
				FROM pre_community_file_tag b
				WHERE b.id IN (SELECT tagid FROM pre_community_class_tag_map a
				WHERE a.classid IN (SELECT classid FROM pre_community_class_tag_map WHERE tagid='$tagid')
				) AND b.id!='$tagid' ) tmp WHERE num>0 ORDER BY num DESC";
		$dbarr = $dblink->getRow($sql);
		return getR(true,$dbarr);
	}
	
	/**
	 * 获得某个标签的相关标签
	 * @param unknown_type $tagid
	 * @return 如果失败,msg为失败原因，否则是符合条件的标签数组
	 * 			元素是表pre_community_file_tag所有字段
	 */
	static public function getAboutTag($tagid)
	{
		if(!is_numeric($tagid) || $tagid<=0)
			return getR(false,"标签ID异常");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_file_tag 
				WHERE id IN (
				SELECT tagid 
				FROM pre_community_class_tag_map 
				WHERE classid IN (SELECT classid 
						FROM pre_community_class_tag_map WHERE tagid='$tagid')
				) AND id!='$tagid' limit 0,32";
		$dbarr = $dblink->getRow($sql);
		return getR(true,$dbarr);
	}
	
	/**
	 * 创建标签
	 * @param unknown_type $tag_name	标签名
	 * @param unknown_type $uid			用户ID 如果是0则代表是系统标签
	 * @return 如果失败为错误原因，否则是创建成功的标签ID
	 */
	static public function createTag($tag_name,$uid)
	{
		if(empty($tag_name))
			return getR(false,"tag名称异常");
		
		$dblink = new DataBase("");
		$tag_name = new_addslashes($tag_name);
//		if (preg_match("/^[chr(0xa1)-chr(0xff)a-zA-Z0-9]+$/",$tag_name)){
//			
//		}else {
//			
//		}
		$sql = "INSERT INTO pre_community_file_tag (tag_name,uid) 
				VALUES ('$tag_name','$uid')";
		$dblink->query($sql);
		$id = $dblink->get_id();
		$dblink->dbclose();
		return getR(true,$id);
	}
	
	/**
	 * 批量添加标签
	 * @param unknown_type $tag_name
	 * @param unknown_type $uid
	 * @return unknown_type
	 */
	static public function AdminCreateTag($tag_name=array(),$uid)
	{
		if(empty($tag_name))
			return getR(false,"tag名称异常");
		$dblink = new DataBase("");
		for ($i = 0; $i < count($tag_name); $i++) {
			$data = Community::getTagNameIsExist($tag_name[$i]);
			if ($data == 0){
				$dblink->query("INSERT INTO pre_community_file_tag (tag_name,uid) 
				VALUES ('".$tag_name[$i]."','$uid')");
			}
			
		}
//		$dblink->query($sql);
		$id = $dblink->get_id();
		$dblink->dbclose();
		return getR(true,$id);
	}
	
	/**
	 * 删除标签
	 * @param unknown_type $tag_id_arr	标签ID数组
	 * @return 如果失败，返回错误原因
	 */
	static public function deleteTag($tag_id_arr)
	{
		if(!is_array($tag_id_arr))
			return getR(false,"期望参数是标签数组");
		$tagids_str = implode(",",$tag_id_arr);
		$dblink = new DataBase("");
		$sql = "DELETE FROM pre_community_file_tag WHERE id IN($tagids_str)";
		$dblink->query($sql);
		
		$sql = "DELETE FROM pre_community_file_tag_map 
				WHERE tag_id IN ($tagids_str)";
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true,$id);
	}

	
	/**
	 * 获得标签下的所有分享列表
	 * @param unknown_type $tag_id		标签ID
	 * @param unknown_type $order_type	排序类型 1：根据分享被喜欢数排序
	 * 											2: 根据被收藏数排序
	 * 											3: 根据添加时间排序
	 * $param unknown_type $file_type   文件类型 1: 图片
	 * 											2: 视频
	 * 											3：商品
	 * @return 如果失败返回错误原因，否则返回一个数组，其中
	 * 			num是指所有符合条件的条目数，用于分页
	 * 			arr是符合条件的数组，数组元素包括：
	 * 			a.uid,a.nickname,a.albumid,a.file_name,
					a.file_path,a.remote_url,a.file_type,
					a.`status`,a.input_time,a.file_state,a.file_display,
					a.be_like_count,a.be_collect_count,
					a.description,a.source_id
				其中a是表pre_community_file
	 */
	static public function getTagShareList($tag_id,$order_type,$file_type=0,
			$page=1,$record_per_page = 10)
	{
		if(!is_numeric($tag_id) || $tag_id<=0)
			return getR(false,"tagID异常");
		switch ($order_type)
		{
			
			case 1:
				$order_sql = "order by be_like_count desc";
				break;
			case 2:
				$order_sql = "order by be_collect_count desc";
				break;
			case 3:
				$order_sql = "order by input_time desc";
				break;
			default:
				$order_sql = "order by input_time desc";
				break;
		}
		switch($file_type)
		{
			case 1 :
				$file_type_sql = "and file_type='1'";
				break;
			case 2 :
				$file_type_sql = "and file_type='2'";
				break;
			case 3 :
				$file_type_sql = "and file_type='3'";
				break;
			case 0:
			default:
				$file_type_sql = "";
				break;
							
		}
		$dblink = new DataBase("");
		$sql = "select count(*) as num FROM pre_community_file a
				INNER JOIN pre_community_file_tag_map b ON a.id=b.file_id
				WHERE b.tag_id='$tag_id' $file_type_sql";
		$num_arr = $dblink->getRow($sql);
		$num = $num_arr[0][num];
		
		$sql = "SELECT a.id,a.uid,a.nickname,a.albumid,a.file_name,
					a.file_path,a.remote_url,a.thumb,a.file_type,
					a.`status`,a.input_time,a.file_state,a.file_display,
					a.be_like_count,a.be_collect_count,a.be_reply_count,
					a.description,a.source_id,a.price,a.priceimg,c.album_name FROM pre_community_file a
				INNER JOIN pre_community_file_tag_map b ON a.id=b.file_id
				INNER JOIN pre_community_album c ON a.albumid=c.id
				WHERE a.status=99 AND b.tag_id='$tag_id' $file_type_sql $order_sql 
				limit ".($page-1)*$record_per_page.",$record_per_page";
		$arr = $dblink->getRow($sql);
		for ($i = 0; $i < count($arr); $i++) {
			$arr[$i][user_arr] = Community::getUserTotalInfo($arr[$i]["uid"]);
		}
		$v[num] = $num;
		$v[arr] = $arr;
		return getR(true,$v);
	}
	
	
	/**
	 * 根据专辑ID获得类别ID
	 * @param unknown_type $id
	 * @return unknown_type
	 */
	static public function getAlbumClassId($id){
//		if(!is_numeric($id) || $id<=0)
//			return getR(false,"ID信息异常");
		$dblink = new DataBase("");
		if ($id == 'default_id'){
			$sql = "SELECT id AS class_id FROM pre_community_class WHERE `default`=1 LIMIT 1";
		}else {
			$sql = "SELECT * FROM pre_community_album WHERE id='$id'";
		}
		$dbarr = $dblink->getRow($sql);
		for ($i = 0; $i < count($dbarr); $i++) {
			$sql = "select * from pre_community_class where id =".$dbarr[$i][class_id];
			$r = $dblink->getRow($sql);
			$dbarr[$i][class_name] = $r[$i][name];
		}
		//print_r($dbarr);
		return getR(true,$dbarr);
	}
	
	/**
	 * 得到标签是否已存在
	 */
	static public function getTagIsPresence($tag_arr,$uid){
		$dblink = new DataBase("");
		//找出不同的
//		$tag_arr = array('a', 'b', 'c', 'd');
//		$b = array('a', 'c'); 		
//		$c = array_merge(array_diff($a,$b),array_diff($b,$a));
        for ($i=0;$i<count($tag_arr);$i++){
        	$sql = "SELECT * FROM pre_community_file_tag WHERE tag_name='$tag_arr[$i]'";
        	$data = $dblink->getRow($sql);
        	if (count($data)>0){//标签已存在把已存在标签ID返回
        		$v[$i] = $data[0][id];
        	}else {
        		$arr = Community::createTag($tag_arr[$i],$uid);
        		$v[$i] = $arr["-msg-"];
        	}
        }
        return getR(true,$v);    
	}
	
	/**
	 * 创建专辑
	 * @param unknown_type $uid			创建专辑的UID
	 * @param unknown_type $nickname	创建专辑的用户昵称
	 * @param unknown_type $album_name	专辑名
	 * @param unknown_type $discription	专辑描述
	 * @param unknown_type $classid		专辑所属类别
	 * @return 如果失败则返回失败原因，否则返回创建的专辑ID
	 */
	static public function createAlbum($uid,$nickname,$album_name,
			$discription,$classid)
	{	
//		$album_name = htmlentities($album_name, ENT_QUOTES, 'UTF-8');
//		$album_name = safe_replace($album_name);
		$album_name = new_addslashes($album_name);
		$discription = new_addslashes($discription);
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户ID信息异常");
		if(($album_name=="") || ($album_name=="创建新专辑"))
			return getR(false,"创建专辑不规范");
		if(!is_numeric($classid) || $classid<=0)
			return getR(false,"专辑所属类别ID异常");
		$dblink = new DataBase("");
//		$sql = "SELECT COUNT(*) as num FROM pre_community_album WHERE uid=$uid";
//		$count_num = $dblink->getRow($sql);
//		$album_num = $count_num[0][num];
//		if($album_num > 5){
//			return getR(false,"您创建的专辑已超过5个，请您选择其它专辑！");	
//		}
		$sql = "SELECT album_count FROM pre_community_class 
				WHERE id='$classid'";
		$dbarr = $dblink->getRow($sql);
		if(count($dbarr)==0)
			return getR(false,"给定的类别ID异常");
		
		$sql = "INSERT INTO pre_community_album 
			(uid,nickname,album_name,class_id,description) 
			VALUES ('$uid','$nickname','$album_name','$classid','$discription')";
		$dblink->query($sql);
		$id = $dblink->get_id();
		
		$sql = "UPDATE pre_community_class SET album_count=album_count+1 
			WHERE id='$classid'";
		$dblink->query($sql);
		
		$tmp_arr = $dblink->getRow("select uid from pre_community_user_stat
				where uid='$uid' limit 0,1");
		if(count($tmp_arr)==0)
		{
			$sql = "insert INTO pre_community_user_stat 
				SET album_count=1 ,uid='$uid'";
		}
		else
		{
			$sql = "update pre_community_user_stat set album_count=album_count+1
					where uid='$uid'";
		}
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true,$id);
	}
	/**
	 * 修改专辑信息，如果对应字段不修改，则直接传空字符串
	 * @param unknown_type $album_id		需要修改的专辑ID
	 * @param unknown_type $album_name		修改的专辑名
	 * @param unknown_type $discription  	修改的专辑描述
	 * @param unknown_type $classid			修改专辑所属类别
	 * @return 如果失败，返回失败原因
	 */
	static public function updateAlbum($album_id,$album_name,
			$discription,$classid,$cover,$imgid,$uid)
	{
		
		//print_r($album_id.$album_name.$typeid.$discription);die();
		if(!is_numeric($album_id) || $album_id<=0)
			return getR(false,"专辑ID信息异常");
		$album_name = new_addslashes($album_name);
		$discription = new_addslashes($discription);
		$dblink = new DataBase("");
		$sql = "SELECT class_id FROM pre_community_album where id='$album_id'";
		$old_class_arr = $dblink->getRow($sql);
		$old_class_id = $old_class_arr[0][class_id];
		
		if(empty($old_class_id))
			return getR(false,"原始专辑ID信息异常");
		$album_name_sql = (empty($album_name))?"":",album_name='$album_name'";
		$discription_sql = (empty($discription))?"":",description='$discription'";
		$classid_sql = (empty($classid))?"":",class_id='$classid'";
		$cover_sql = ",front_cover='$cover'";
		if ($cover==2){
			$dblink->query("insert INTO pre_community_album_file_tmp SET album_id=$album_id,file_id=$imgid,uid='$uid'");
		}
		
		$addsql = trim($album_name_sql.$discription_sql.$classid_sql.$cover_sql,",");
		$sql = "UPDATE pre_community_album 
			SET $addsql 
			WHERE id='$album_id'";
		$dblink->query($sql);
		//对class中的专辑数进行修改
		if($old_class_id!=$classid)
		{
			$dblink->query("UPDATE pre_community_class 
					SET album_count=album_count-1 WHERE id='$old_class_id'");
			$dblink->query("UPDATE pre_community_class
					SET album_count=album_count+1 WHERE id='$classid'");
		}
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 删除专辑
	 * @param unknown_type $album_id
	 * @return 如果失败，返回失败原因
	 * 
	 */
	static public function deleteAlbum($album_id)
	{
		if(!is_numeric($album_id) || $album_id<=0)
			return getR(false,"专辑ID信息异常");
		$dblink = new DataBase("");
		$sql = "SELECT uid FROM pre_community_album WHERE id='$album_id'";
		$tmparr = $dblink->getRow($sql);
		$uid = $tmparr[0][uid];
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户ID异常");
		
		$sql = "DELETE FROM pre_community_album WHERE id='$album_id'";
		$dblink->query($sql);
		
		//删除专辑时，应该一并删除专辑下的所有分享
		$sql = "DELETE FROM pre_community_file WHERE albumid='$album_id'";
		$dblink->query($sql);
		//删除专辑时，应该一并删除用户与关注专辑的对应关系
		$sql = "DELETE FROM pre_community_album_watch_map WHERE album_id='$album_id'";
		$dblink->query($sql);
		$sql = "UPDATE pre_community_user_stat 
				SET album_count=IF(album_count<=0,0,album_count-1) 
				WHERE uid='$uid'";
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 获得某专辑的分享最新的分享列表图片
	 */
	static public function getalbumsharelist($album_id){
		if(!is_numeric($album_id) || $album_id<=0)
			return getR(false,"专辑ID信息异常");
			$dblink = new DataBase("");
			$sql = "select * from pre_community_file where albumid = $album_id order by input_time desc limit 4";
			
			$arr = $dblink->getRow($sql);
			for($i=0;$i<count($arr);$i++){
				$img[$i]['shareimg'] = $arr[$i]['small'];
			}
			return $img;
	}
	
	
	/**
	 * 获得某专辑的分享所有的分享列表图片
	 */
	static public function getalbumsharelistimg($album_id){
		if(!is_numeric($album_id) || $album_id<=0)
			return getR(false,"专辑ID信息异常");
			$dblink = new DataBase("");
			$sql = "select * from pre_community_file where albumid = $album_id and `status`=99 order by input_time asc";
			$arr = $dblink->getRow($sql);
			for($i=0;$i<count($arr);$i++){
				$img[$i]['shareimg'] = $arr[$i]['small'];
				$img[$i]['id'] = $arr[$i]['id'];
			}
			return $img;
	}
	
	static public function getCoverList($album_id,$uid){
		if(!is_numeric($album_id) || $album_id<=0)
			return getR(false,"专辑ID信息异常");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_album_file_tmp WHERE album_id='$album_id' AND uid='$uid' order by id desc";
		$arr = $dblink->getRow($sql);
		$r_info = Community::getShareInfo($arr[0]['file_id']);
//		print_r($r_info);
		return $r_info;
	}
	
	/**
	 * 获得某专辑的所有评论列表
	 * @param unknown_type $album_id	专辑ID
	 * @param unknown_type $page		当前页
	 * @param unknown_type $record_per_page 每页记录数
	 * @return 如果失败，返回失败原因，否则返回一个数组：
	 * 			num是符合条件的评论总数，用于分页
	 * 			arr是符合条件的数组，元素是pre_community_album_reply表的字段
	 *           
	 */
	static public function getAlbumReply($album_id,$page=1,$record_per_page=10)
	{
		if(!is_numeric($album_id) || $album_id<=0)
			return getR(false,"专辑ID信息异常");
		if(!is_numeric($page) || $page<=0)
			return getR(false,"页码信息异常");
		if(!is_numeric($record_per_page) || $record_per_page<=0)
			return getR(false,"每页记录数信息异常");
		$dblink = new DataBase("");
		$num_sql = "SELECT count(*) as num FROM pre_community_album_reply 
				WHERE album_id='$album_id' ";
		$num_arr = $dblink->getRow($num_sql);
		$num = $num_arr[0][num];
		
		$sql = "SELECT * FROM pre_community_album_reply 
				WHERE album_id='$album_id' 
				ORDER BY reply_time DESC 
				LIMIT ".($page-1)*$record_per_page.",$record_per_page";
		$dbarr = $dblink->getRow($sql);
		//print_r($dbarr);
		$v[num] = $num;
		$v[arr] = $dbarr;
		return getR(true,$v);
	}
	
	/**
	 * 为某专辑添加评论
	 * @param unknown_type $uid		用户UID
	 * @param unknown_type	$nickname 昵称
	 * @param unknown_type $album_id 回复的专辑ID
	 * @param unknown_type $content	回复内容
	 * @param unknown_type $atuid  需要@的好友的数组，比如array(1,3)
	 */
	static public function replyAlbum($uid,$nickname,$album_id,
			$content,$atuid_arr=array())
	{
		if(!is_numeric($uid) || $uid<0)
			return getR(false,"用户ID异常");
		if(!is_numeric($album_id) || $album_id<0)
			return getR(false,"专辑ID异常");
		
		$dblink = new DataBase("");
		//获得专辑信息
		$sql = "SELECT album_name,uid,nickname FROM pre_community_album 
				WHERE id='$album_id'";
		$tmp_arr = $dblink->getRow($sql);
		if(count($tmp_arr)<1)
			return getR(false,"不存在这个专辑");
		
		//if($tmp_arr[0][uid]==$uid)
			//return getR(false,"不能自己评论自己的专辑");
		$sql = "INSERT INTO pre_community_album_reply 
					(album_id,uid,nickname,reply_content)
				VALUES('$album_id','$uid','$nickname','$content')";
		$dblink->query($sql);
		
		//更新专辑的被回复数
		$sql = "UPDATE pre_community_album SET be_reply_count=be_reply_count+1 WHERE id='$album_id'";
		$dblink->query($sql);
		
		//对@好友发私信
		if(is_array($atuid_arr) && count($atuid_arr)>0)
		{
			for($i=0;$i<count($atuid_arr);$i++)
			{
				$rpl = "评论了 ".$tmp_arr[0][nickname]." 的专辑《".$tmp_arr[0][album_name]."》: \"$content\"并邀请我围观";
				Weibo::SendPrivateMail($uid, $atuid_arr[$i], $rpl);
			}
			
		}
		return getR(true);
	}
	
	/**
	 * 删除专辑回复
	 * @param unknown_type $reply_id	回复ID
	 * @return unknown_type 如果失败，返回false和错误原因，否则返回true
	 */
	static public function deleteAlbumReply($reply_id)
	{
		if(!is_numeric($reply_id) || $reply_id<0)
			return getR(false,"回复ID异常");
		
		$dblink = new DataBase("");
		//找到回复的相关信息
		$sql = "SELECT album_id FROM pre_community_album_reply 
				WHERE id='$reply_id'";
		$tmp_arr = $dblink->getRow($sql);
		
		
		//删除专辑回复
		$sql = "DELETE FROM pre_community_album_reply WHERE id='$reply_id'";
		$dblink->query($sql);
		
		//将对应专辑的回复数-1
		$sql = "UPDATE pre_community_album 
				SET be_reply_count=IF(be_reply_count<=0,0,be_reply_count-1) 
				WHERE id='".$tmp_arr[0][album_id]."'";
		$dblink->query($sql);
		return getR(true);
	}
	
	/**
	 * 获得专辑列表
	 * @param unknown_type $classid	专辑所属类别ID，如果为0，则为所有类别
	 * @param unknown_type $uid 专辑所属用户id，如果为0，则代表所有用户
	 * @param unknown_type $nickname 专辑所属用户名称
	 * @param unknown_type $star_time 开始时间
	 * @param unknown_type $end_time  结束时间
	 * @param unknown_type $albumname  专辑名称
	 *  @param unknown_type $is_pos  专辑是否推荐
	 * @param unknown_type $filtertype	1：按照创建时间排序 2:按照id排序 3:被关注数 4:共享数
	 * @param unknown_type $page 第几页
	 * @param unknown_type $recordperpage 每页显示几条
	 * 返回值 checkErr判断，失败false并返回原因，成功返回true并返回
	 *       数据，其中count是符合条件的总数
	 *       arr是列表数组
	 */
	static public function getAlbumListJson_bak($classid,$uid,$filtertype,$page=1,$recordperpage=10,$nickname,$star_time,$end_time,$albumname,$is_pos)
	{
		if(!is_numeric($classid) || $classid<0)
			return getR(false,"类别ID异常");
		if(!is_numeric($uid) || $uid<0)
			return getR(false,"用户ID异常");
		
		$classid_sql = (empty($classid))?"":"and class_id='$classid'";
		$uid_sql = (empty($uid))?"":"and uid='$uid'";
		$nickname_sql = (empty($nickname))?"":"and nickname like '%$nickname%'";
		$star_time_sql = (empty($star_time))?"":"and input_time >= '$star_time'";
		$end_time_sql = (empty($end_time))?"":"and input_time <= '$end_time'";
		$albumname_sql = (empty($albumname))?"":"and album_name like '%$albumname%'";
		//print_r($nickname_sql);die();
		switch ($filtertype)
		{
			case 1:
				$filter_sql = "order by input_time desc";
				break;
			case 2:
				$filter_sql = "order by file_count desc";
				break;
			case 3:
				$filter_sql = "order by be_watch_count desc";
				break;
			case 4:
				$filter_sql = "order by id desc";
				break;
			default:
				$filter_sql = "order by input_time desc";
				break;
		}
		switch ($is_pos) {
			case 1:
				$is_pos_sql = "and recommend=1 ";
				break;
			case 2:
				$is_pos_sql = "and recommend=2 ";
				break;
			case 3:
				$is_pos_sql = "and recommend=3";
				break;
			case all:
				$is_pos_sql = "and recommend!=0";
				break;
			default:
				$is_pos_sql = "";
				break;
				
		}
		//print_r($is_pos_sql);die();
		$dblink = new DataBase("");
		$sql = "SELECT a.id,a.uid,a.nickname,a.album_name,a.class_id,a.front_cover,
				a.input_time,a.description,a.file_count,a.be_reply_count,a.recommend,b.name,
				(SELECT COUNT(*) FROM pre_community_file c WHERE c.albumid=a.id AND `status`=99) AS num 
				FROM pre_community_album a INNER JOIN pre_community_class b ON a.class_id=b.id";
		$count_arr = $dblink->getRow($sql);
		$count_num = $count_arr[0][num];
		$sql = "SELECT a.id,a.uid,a.nickname,a.album_name,a.class_id,a.front_cover,
				a.input_time,a.description,a.file_count,a.be_reply_count,a.recommend,b.name,
				(SELECT COUNT(*) FROM pre_community_file c WHERE c.albumid=a.id AND `status`=99) AS num 
				FROM pre_community_album a INNER JOIN pre_community_class b ON a.class_id=b.id
				WHERE 1=1 $classid_sql $uid_sql $nickname_sql $star_time_sql $end_time_sql $albumname_sql $is_pos_sql $filter_sql limit ".($page-1)*$recordperpage.",$recordperpage";
//		echo $sql;
		$dbarr = $dblink->getRow($sql);
		for ($i=0;$i<count($dbarr);$i++){
			if ($dbarr[$i][front_cover]==2){//如果设置了封面，则取封面
				$c = Community::getCoverList($dbarr[$i][id],$dbarr[$i][uid]);
				$c_arr = $c["-msg-"];
				$dbarr[$i][img] = $c_arr[0]['small'];
			}else {//取九宫格
				$r = Community::getShareListFromAlbumPic($dbarr[$i][id],3,"desc",1,9);
				$arr = $r["-msg-"]["arr"];
				for($j=0;$j<count($arr);$j++){
					$dbarr[$i][img][] = $arr[$j]['small'];
				}
			}
			
		}
//		print_r($dbarr);
		$v[count] = $count_num;
		$v[arr] = $dbarr;
		$dblink->dbclose();
		return getR(true,$v);
	}
	
/**
	 * 获得专辑列表
	 * @param unknown_type $classid	专辑所属类别ID，如果为0，则为所有类别
	 * @param unknown_type $uid 专辑所属用户id，如果为0，则代表所有用户
	 * @param unknown_type $nickname 专辑所属用户名称
	 * @param unknown_type $star_time 开始时间
	 * @param unknown_type $end_time  结束时间
	 * @param unknown_type $albumname  专辑名称
	 *  @param unknown_type $is_pos  专辑是否推荐
	 * @param unknown_type $filtertype	1：按照创建时间排序 2:按照id排序 3:被关注数 4:共享数
	 * @param unknown_type $page 第几页
	 * @param unknown_type $recordperpage 每页显示几条
	 * 返回值 checkErr判断，失败false并返回原因，成功返回true并返回
	 *       数据，其中count是符合条件的总数
	 *       arr是列表数组getAlbumListJson
	 */
	static public function getAlbumListJson($classid,$uid,$filtertype,$page=1,$recordperpage=10,$nickname,$star_time,$end_time,$albumname,$is_pos)
	{
		if(!is_numeric($classid) || $classid<0)
			return getR(false,"类别ID异常");
		if(!is_numeric($uid) || $uid<0)
			return getR(false,"用户ID异常");
		
		$classid_sql = (empty($classid))?"":"and class_id='$classid'";
		$uid_sql = (empty($uid))?"":"and uid='$uid'";
		$nickname_sql = (empty($nickname))?"":"and nickname like '%$nickname%'";
		$star_time_sql = (empty($star_time))?"":"and input_time >= '$star_time'";
		$end_time_sql = (empty($end_time))?"":"and input_time <= '$end_time'";
		$albumname_sql = (empty($albumname))?"":"and album_name like '%$albumname%'";
		//print_r($nickname_sql);die();
		switch ($filtertype)
		{
			case 1:
				$filter_sql = "order by input_time desc";
				break;
			case 2:
				$filter_sql = "order by file_count desc";
				break;
			case 3:
				$filter_sql = "order by be_watch_count desc";
				break;
			case 4:
				$filter_sql = "order by id desc";
				break;
			default:
				$filter_sql = "order by input_time desc";
				break;
		}
		switch ($is_pos) {
			case 1:
				$is_pos_sql = "and recommend=1 ";
				break;
			case 2:
				$is_pos_sql = "and recommend=2 ";
				break;
			case 3:
				$is_pos_sql = "and recommend=3";
				break;
			case all:
				$is_pos_sql = "and recommend!=0";
				break;
			default:
				$is_pos_sql = "";
				break;
				
		}
		//print_r($is_pos_sql);die();
		$dblink = new DataBase("");
		$sql = "SELECT count(*) as num FROM (
				SELECT a.id,a.uid,a.nickname,a.album_name,a.class_id,a.front_cover,
				a.input_time,a.description,a.file_count,a.be_reply_count,a.recommend,b.name,
				(SELECT COUNT(*) FROM pre_community_file c WHERE c.albumid=a.id AND `status`=99) AS num 
				FROM pre_community_album a
				INNER JOIN pre_community_class b ON a.class_id=b.id) bc WHERE num>=1";
		$count_arr = $dblink->getRow($sql);
		$count_num = $count_arr[0][num];
		$sql = "SELECT * FROM (
				SELECT a.id,a.uid,a.nickname,a.album_name,a.class_id,a.front_cover,
				a.input_time,a.description,a.file_count,a.be_reply_count,a.recommend,b.name,
				(SELECT COUNT(*) FROM pre_community_file c WHERE c.albumid=a.id AND `status`=99) AS num 
				FROM pre_community_album a INNER JOIN pre_community_class b ON a.class_id=b.id
				) bc WHERE 1=1 and num>=1 $classid_sql $uid_sql $nickname_sql $star_time_sql $end_time_sql $albumname_sql $is_pos_sql $filter_sql limit ".($page-1)*$recordperpage.",$recordperpage";
		$dbarr = $dblink->getRow($sql);
		for ($i=0;$i<count($dbarr);$i++){
			if ($dbarr[$i][front_cover]==2){//如果设置了封面，则取封面
				$c = Community::getCoverList($dbarr[$i][id],$dbarr[$i][uid]);
				$c_arr = $c["-msg-"];
				$dbarr[$i][img] = $c_arr[0]['small'];
			}elseif ($dbarr[$i][front_cover]==1){//取九宫格
				$r = Community::getShareListFromAlbumPic($dbarr[$i][id],3,"desc",1,9);
				$arr = $r["-msg-"]["arr"];
				for($j=0;$j<count($arr);$j++){
					$dbarr[$i][img][] = $arr[$j]['small'];
				}
			}else {
				$r = Community::getShareListFromAlbumPic($dbarr[$i][id],3,"ASC",1,1);
				$arr = $r["-msg-"]["arr"];
				$dbarr[$i][img] = $arr[0]['small'];
			}
		}
		
		$v[count] = $count_num;
		$v[arr] = $dbarr;
		$dblink->dbclose();
		return getR(true,$v);
	}
	
	/**
	 * 获得专辑列表
	 * @param unknown_type $classid	专辑所属类别ID，如果为0，则为所有类别
	 * @param unknown_type $uid 专辑所属用户id，如果为0，则代表所有用户
	 * @param unknown_type $nickname 专辑所属用户名称
	 * @param unknown_type $star_time 开始时间
	 * @param unknown_type $end_time  结束时间
	 * @param unknown_type $albumname  专辑名称
	 *  @param unknown_type $is_pos  专辑是否推荐
	 * @param unknown_type $filtertype	1：按照创建时间排序 2:按照id排序 3:被关注数 4:共享数
	 * @param unknown_type $page 第几页
	 * @param unknown_type $recordperpage 每页显示几条
	 * 返回值 checkErr判断，失败false并返回原因，成功返回true并返回
	 *       数据，其中count是符合条件的总数
	 *       arr是列表数组
	 */
	static public function getAlbumList($classid,$uid,$filtertype,$page=1,$recordperpage=10,$nickname,$star_time,$end_time,$albumname,$is_pos)
	{
		if(!is_numeric($classid) || $classid<0)
			return getR(false,"类别ID异常");
		if(!is_numeric($uid) || $uid<0)
			return getR(false,"用户ID异常");
		
		$classid_sql = (empty($classid))?"":"and class_id='$classid'";
		$uid_sql = (empty($uid))?"":"and uid='$uid'";
		$nickname_sql = (empty($nickname))?"":"and nickname like '%$nickname%'";
		$star_time_sql = (empty($star_time))?"":"and input_time >= '$star_time'";
		$end_time_sql = (empty($end_time))?"":"and input_time <= '$end_time'";
		$albumname_sql = (empty($albumname))?"":"and album_name like '%$albumname%'";
		//print_r($nickname_sql);die();
		switch ($filtertype)
		{
			case 1:
				$filter_sql = "order by a.input_time desc";
				break;
			case 2:
				$filter_sql = "order by a.id desc";
				break;
			case 3:
				$filter_sql = "order by a.be_watch_count desc";
				break;
			case 4:
				$filter_sql = "order by a.file_count desc";
				break;
			default:
				$filter_sql = "order by a.input_time desc";
				break;
		}
		switch ($is_pos) {
			case 1:
				$is_pos_sql = "and a.recommend=1 ";
				break;
			case 2:
				$is_pos_sql = "and a.recommend=2 ";
				break;
			case 3:
				$is_pos_sql = "and a.recommend=3";
				break;
			case all:
				$is_pos_sql = "and a.recommend!=0";
				break;
			default:
				$is_pos_sql = "";
				break;
				
		}
		//print_r($is_pos_sql);die();
		$dblink = new DataBase("");
		$sql = "select count(*) as num FROM pre_community_album a
				INNER JOIN pre_community_class b ON a.class_id=b.id
				WHERE 1=1 $classid_sql $uid_sql $nickname_sql $star_time_sql $end_time_sql $albumname_sql $is_pos_sql $filter_sql";
		$count_arr = $dblink->getRow($sql);
		$count_num = $count_arr[0][num];
		//print_r($count_num);die();
		$sql = "SELECT a.id,a.uid,a.nickname,a.album_name,a.class_id,a.front_cover,
					a.input_time,a.description,a.file_count,a.be_reply_count,a.recommend,b.name
				FROM pre_community_album a
				INNER JOIN pre_community_class b ON a.class_id=b.id
				WHERE 1=1 $classid_sql $uid_sql $nickname_sql $star_time_sql $end_time_sql $albumname_sql $is_pos_sql $filter_sql 
				limit ".($page-1)*$recordperpage.",$recordperpage";
		$dbarr = $dblink->getRow($sql);		
		for ($i=0;$i<count($dbarr);$i++){
			$r = Community::getShareListFromAlbumPic($dbarr[$i][id],3,"desc",1,9);
			if (checkErr($r)) {
				$arr = $r["-msg-"]["arr"];
				for($j=0;$j<count($arr);$j++){
					$dbarr[$i][img][] = $arr[$j]['small'];
				}
			}else {
				echo $r["-msg-"];
				die();
			}
			
		}
//		print_r($dbarr);
		$v[count] = $count_num;
		$v[arr] = $dbarr;
		$dblink->dbclose();
		return getR(true,$v);
	}
	
	/**
	 * 获得作者其它专辑
	 */
	static public function getOtherAlbum($uid,$album_id)
	{
		if(!is_numeric($uid) || $uid<0)
			return getR(false,"用户ID异常");
		if(!is_numeric($album_id) || $album_id<0)
			return getR(false,"专辑ID异常");
		$dblink = new DataBase("");	
		$sql = "select * from pre_community_album where uid=$uid and id not in($album_id)";
		$dbarr = $dblink->getRow($sql);
		$dblink->dbclose();
		return $dbarr;
	}
	
	
	/**
	 * 获得分享列表
	 * @param unknown_type $classid	分享所属类别ID，如果为0，则为所有类别
	 * @param unknown_type $uid 分享所属用户uid，如果为0，则代表所有用户
	 * @param unknown_type $nickname 分享所属用户名称
	 * @param unknown_type $star_time  开始时间
	 * @param unknown_type $end_time   结束时间
	 * @param unknown_type $tag_name   标签名称
	 * @param unknown_type $albumname  分享名称
	 * @param unknown_type $file_type  分享类别
	 * @param unknown_type $file_state 分享来源
	 * @param unknown_type $status     分享审核状态
	 * @param unknown_type $file_recommend     分享推荐状态 0为未推荐 1为已推荐 
	 * @param unknown_type $top 		分享置顶操作：0为默认未置顶 1.全局置顶 2.分类置顶 3.首页置顶
	 * @param unknown_type $filtertype	1：按照创建时间排序
	 * @param unknown_type $file_class	分享分类
	 * @param unknown_type $likecount	分享喜欢数
	 * @param unknown_type $collectcount	分享收藏数
	 * @param unknown_type $replycount	分享回复数
	 * @param unknown_type $page 第几页
	 * @param unknown_type $recordperpage 每页显示几条
	 * 返回值 checkErr判断，失败false并返回原因，成功返回true并返回
	 *       数据，其中count是符合条件的总数
	 *       arr是列表数组
	 */
	static public function getShareList($uid,$filtertype,$page=1,$recordperpage=10,$nickname,$star_time,
	$end_time,$tag_name,$description,$file_type,$file_state,$status,$file_recommend,$top,$file_class,$likecount,$collectcount,$replycount)
	{
		if(!is_numeric($uid) || $uid<0)
			return getR(false,"类别ID异常");
		$nickname_sql = (empty($nickname))?"":"and a.nickname like '$nickname'";
		$star_time_sql = (empty($star_time))?"":"and a.input_time > '$star_time'";
		$end_time_sql = (empty($end_time))?"":"and a.input_time <= '$end_time'";
		$description_sql = (empty($description))?"":"and a.description like '$description'";
		$uid_sql = ($uid==0)?"":"and uid=$uid";
		$file_class_sql = ($file_class=="all" || $file_class=="")?"":"and c.name like'$file_class'";//分享分类
		$likecount_sql = ($likecount=="")?"":"and a.be_like_count >=$likecount";//分享喜欢数
		$collectcount_sql = ($collectcount=="")?"":"and a.be_collect_count >=$collectcount";//分享收藏数
		$replycount_sql = ($replycount=="")?"":"and a.be_reply_count >=$replycount";//分享评论数
		switch ($filtertype)
		{
			case 1:
				$filter_sql = "order by a.input_time desc";
				break;
			default:
				$filter_sql = "order by a.input_time desc";
				break;
		}
		//分享类别 1：图片 2：视频 3：商品
		switch ($file_type) {
			case 1:
				$file_type_sql = "and a.file_type=1 ";
				break;
			case 2:
				$file_type_sql = "and a.file_type=2 ";
				break;
			case 3:
				$file_type_sql = "and a.file_type=3";
				break;
			case all:
				$file_type_sql = "";
				break;
			default:
				$file_type_sql = "";
				break;
				
		}
		
		//文件状态：1，上传 2，网址采集 3，转藏  
		switch ($file_state) {
			case 1:
				$file_state_sql = "and a.file_state=1 ";
				break;
			case 2:
				$file_state_sql = "and a.file_state=2 ";
				break;
			case 3:
				$file_state_sql = "and a.file_state=3";
				break;
			case all:
				$file_state_sql = "";
				break;
			default:
				$file_state_sql = "";
				break;
				
		}
		//审核状态 0：未审核 99：已审核 98：审核不通过 97:系统拦截过滤
		if ($status == "0"){
			$status_sql = "and a.status=0 ";
		}elseif($status == "99"){
			$status_sql = "and a.status=99 ";
		}elseif($status == "98"){
			$status_sql = "and a.status=98";
		}elseif($status == "97"){
			$status_sql = "and a.status=97";
		}elseif($status == "all"){
			$status_sql = "";
		}
		
		//分享推荐状态 0为未推荐 1为已推荐 
		if ($file_recommend == "0"){
			$file_recommend_sql = "and a.file_recommend=0";
		}elseif($file_recommend == "1"){
			$file_recommend_sql = "and a.file_recommend=1";
		}elseif($file_recommend == "all"){
			$file_recommend_sql = "";
		}
		$nowtime = date('Y-m-d G:i:s');//获取当前时间
		//分享置顶操作：0为默认未置顶 1.全局置顶 2.分类置顶 3.首页置顶
		if($top == "0"){
			$top_sql = "and a.top=0";
		}elseif($top == "1"){
			$top_sql = "and a.top=1 and a.top_time > '$nowtime'";
		}elseif($top == "2"){
			$top_sql = "and a.top=2 and a.top_time > '$nowtime'";
		}elseif($top == "3"){
			$top_sql = "and a.top=3 and a.top_time > '$nowtime'";
		}elseif($top == "all"){
			$top_sql = "";
		}
		
		$dblink = new DataBase("");
		$sql = "SELECT COUNT(*) AS num,a.*,b.album_name,c.id AS class_id,
					c.name AS class_name FROM pre_community_file a INNER JOIN pre_community_album b ON a.albumid=b.id
				INNER JOIN pre_community_class c ON b.class_id=c.id
				WHERE 1=1 $uid_sql $nickname_sql $star_time_sql $end_time_sql $file_type_sql $status_sql $description_sql $file_state_sql $file_recommend_sql $top_sql 
 $likecount_sql $collectcount_sql $replycount_sql $file_class_sql";
		$count_arr = $dblink->getRow($sql);
		$count_num = $count_arr[0][num];
		/*$sql = "SELECT * FROM pre_community_file 
				WHERE 1=1 $uid_sql $nickname_sql $star_time_sql $end_time_sql $file_type_sql $status_sql $file_state_sql $description_sql $file_recommend_sql $top_sql 
 $likecount_sql $collectcount_sql $replycount_sql $filter_sql 
				limit ".($page-1)*$recordperpage.",$recordperpage";*/
		//增加分享所属分类查询
		$sql = "SELECT  a.*,b.album_name,c.id AS class_id,
					c.name AS class_name FROM pre_community_file a INNER JOIN pre_community_album b ON a.albumid=b.id
				INNER JOIN pre_community_class c ON b.class_id=c.id
				WHERE 1=1 $uid_sql $nickname_sql $star_time_sql $end_time_sql $file_type_sql $status_sql $file_state_sql $description_sql $file_recommend_sql $top_sql 
 $likecount_sql $collectcount_sql $replycount_sql $file_class_sql $filter_sql 
				limit ".($page-1)*$recordperpage.",$recordperpage";
		$dbarr = $dblink->getRow($sql);
		$v[count] = $count_num;
		$v[arr] = $dbarr;
		$dblink->dbclose();
		return getR(true,$v);
	}
	
	/**
	 * 关注某专辑
	 * @param unknown_type $uid
	 * @param unknown_type $album_id
	 * @return 如果失败，返回错误原因
	 */
	static public function watchAlbum($uid,$album_id)
	{
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户ID异常");
		if(!is_numeric($album_id) || $album_id<=0)
			return getR(false,"专辑ID异常");
		
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_album_watch_map WHERE album_id='$album_id' AND uid='$uid'";
		$arr = $dblink->getRow($sql);
		if (count($arr)>0) {
			$id = 0;
		}else {
			$sql = "INSERT INTO pre_community_album_watch_map (album_id,uid) 
				VALUES ('$album_id','$uid')";
			$dblink->query($sql);
			$id = $dblink->get_id();
			
			$sql = "UPDATE pre_community_album SET be_watch_count=be_watch_count+1
					 WHERE id='$album_id'";
			$dblink->query($sql);	
		}
		$dblink->dbclose();
		return getR(true,$id);
	}
	
	
	/**
	 * 取消关注某专辑
	 * @param unknown_type $uid
	 * @param unknown_type $album_id
	 * @return 如果失败，返回错误原因
	 */
	static public function delwatchAlbum($uid,$album_id)
	{
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户ID异常");
		if(!is_numeric($album_id) || $album_id<=0)
			return getR(false,"专辑ID异常");
		$dblink = new DataBase("");
			$sql = "DELETE FROM pre_community_album_watch_map WHERE album_id=$album_id AND uid=$uid";
			$dblink->query($sql);
			$sql = "UPDATE pre_community_album SET be_watch_count=be_watch_count-1
					 WHERE id='$album_id'";
			$dblink->query($sql);	
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 创建一个分享
	 * @param unknown_type $uid			创建人的UID
	 * @param unknown_type $nickname	创建人的昵称
	 * @param unknown_type $share_name	分享名称
	 * @param unknown_type $local_path	分享本地地址 图片或者视频的URL
	 * @param unknown_type $url			分享的来源URL，比如，一个阿里巴巴的商品
	 * 									这个字段就是那个产品详细页的URL 
	 * @param unknown_type $thumb		缩略图
	 * @param unknown_type $tag_arr		分享所属的标签Id的数组
	 * @param unknown_type $albumid		分享所属的专辑ID
	 * @param unknown_type $descrition	分享的描述
	 * @param unknown_type $share_state 文件状态：1，上传 2，网址采集 3，转藏
	 * @param unknown_type $fileid      如果是转藏，则记录被转藏共享ID,如果为0
	 * 									代表不是转藏
	 * @param unknown_type $type		分享的类别 1,图片 2，视频 3，商品
	 * @param unknown_type $display		分享的可见性 1，所有人可见 
	 * 									2，好友可见 3，仅对自己可见
	 * @param unknown_type $price       价格，如果$type==3，表示商品价格，否则无用字段
	 * @param unknown_type $priceimg	价格图片，采集的是图片则记录，否则无用字段
	 * @param unknown_type $status		分享审核，0：未审核 99：已审核 98:审核不通过 97:系统拦截过滤
	 * return 失败返回false,成功返回共享ID
	 */
	static public function createShare($uid,$nickname,$share_name,$local_path,$url,$thumb,$small,$tag_arr,$albumid,
		$descrition,$share_state,$fileid,$type=1,$display=1,$price=0,$priceimg="",$status=0)
	{
		if(!is_numeric($uid) || $uid<0)
			return getR(false,"用户ID异常");
		if(!is_numeric($albumid) || $uid<0)
			return getR(false,"专辑ID异常");
		if(!is_numeric($type) || $type<0)
			return getR(false,"分享类别异常");
		if(!is_numeric($display) || $display<0)
			return getR(false,"分享显示方式异常");
		if(!is_numeric($share_state) || $share_state<0)
			return getR(false,"分享来源方式异常");
//		$share_name	= htmlentities($share_name,ENT_QUOTES,'UTF-8');
//		$descrition = htmlentities($descrition,ENT_QUOTES,'UTF-8');
		$share_name = new_addslashes($share_name);
		$descrition = new_addslashes($descrition);
		$dblink = new DataBase("");
		//检查是否选择的默认专辑
		$sql = "SELECT * FROM pre_community_album WHERE id='$albumid' AND stat=1";
		$stat = $dblink->getRow($sql);
		if (count($stat)==0){
			//检查专辑合法性
			$sql = "SELECT uid FROM pre_community_album WHERE id='$albumid'";
			$tmp_arr = $dblink->getRow($sql);
			if(empty($tmp_arr) || $tmp_arr[0][uid]!=$uid)
				return getR(false,"此用户不拥有此专辑或者专辑不存在");
		}		
		
		if($share_state==3 && (!is_numeric($fileid) || $fileid<=0))
			return getR(false,"转藏的共享ID异常");
		
		$source_fileid = 0;
		if($share_state==3)
		{
			$sql = "SELECT source_id FROM pre_community_file WHERE id='$fileid'";
			$tmp_arr = $dblink->getRow($sql);
			$source_fileid = (empty($tmp_arr[0][source_id]))?$fileid:$tmp_arr[0][source_id];
			$sql = "UPDATE pre_community_file SET be_collect_count=be_collect_count+1 WHERE id='$fileid'";
			$dblink->query($sql);
		}
		$sql = "INSERT INTO pre_community_file (uid,nickname,albumid,
					file_name,file_path,remote_url,thumb,small,file_type,
					file_state,file_display,description,source_id,price,priceimg,status)
				VALUES ('$uid','$nickname','$albumid','$share_name',
					'$local_path','$url','$thumb','$small','$type','$share_state','$display',
					'$descrition','$source_fileid','$price','$priceimg','$status')";
		
		$dblink->query($sql);
		$id = $dblink->get_id();
		
		if ($status == 99){
			//增加专辑下的共享数
			$sql = "UPDATE pre_community_album SET file_count=file_count+1
			WHERE id='$albumid'";
			$dblink->query($sql);
			//更新用户分享数
			$sql = "SELECT uid FROM pre_community_user_stat WHERE uid='$uid'";
			$tmp_arr = $dblink->getRow($sql);
			if(count($tmp_arr)>0){
				$dblink->query("UPDATE pre_community_user_stat 
				SET share_count=share_count+1 WHERE uid='$uid'");
			}else{
				$dblink->query("INSERT INTO pre_community_user_stat 
				SET share_count=1,uid='$uid'");
			}				
		}
		
		//专辑和标签的映射关系
		if(is_array($tag_arr))
		{
			for($i=0;$i<count($tag_arr);$i++)
			{
				$dblink->query("insert into pre_community_file_tag_map 
						(tag_id,file_id) VALUES ('".$tag_arr[$i]."','$id')");
			}
		}
		$dblink->dbclose();
		return getR(true,$id);
	}
	
	/**
	 * 转藏某分享
	 * @param unknown_type $uid			用户名
	 * @param unknown_type $nickname    昵称
	 * @param unknown_type $share_id    转藏的分享ID
	 * @param unknown_type $tag_arr		标签数组
	 * @param unknown_type $album_id	专辑ID
	 */
	static public function collectShare($uid,$nickname,$share_id,$album_id,
			$tagarr = array(),$descrition)
	{
		if(!is_numeric($uid) || $uid<0)
			return getR(false,"用户ID异常");
		if(!is_numeric($share_id) || $share_id<0)
			return getR(false,"分享ID异常");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_file WHERE id='$share_id'";
		$dbarr = $dblink->getRow($sql);
		if(count($dbarr)==0)
			return getR(false,"没有这个分享，转藏失败");
		$depict = empty($descrition) ? $dbarr[0][description]:$descrition;
		$r = Community::createShare(
		$uid,$nickname,$dbarr[0][file_name],$dbarr[0][file_path],
		$dbarr[0][remote_url],$dbarr[0][thumb],$dbarr[0][small],$tagarr, $album_id,
		$depict,3,$share_id,$dbarr[0][file_type],$dbarr[0][file_display],
		$dbarr[0][price],$dbarr[0][priceimg],99);
		$dblink->dbclose();
		return $r;
	}
	
	/**
	 * 根据分享ID得到分享信息
	 * @param unknown_type $share_id
	 */
	static public function getShareInfo($share_id){
		if(!is_numeric($share_id) || $share_id<0)
			return getR(false,"分享ID异常");
		$dblink = New DataBase("");
		//$sql = "SELECT * FROM pre_community_file WHERE id='$share_id'";
		//增加根据分享ID得到专辑名称
		$sql = "SELECT a.*,b.album_name FROM pre_community_file a INNER JOIN pre_community_album b ON a.albumid=b.id WHERE a.id='$share_id'";
		$dbarr = $dblink->getRow($sql);
		$dblink->dbclose();
		return getR(true,$dbarr);
	}
	
	/**
	 * 修改分享的基本信息
	 * @param unknown_type $uid			用户UID
	 * @param unknown_type $share_id	共享ID
	 * @param unknown_type $album_id  	修改专辑ID
	 * @param unknown_type $default_album_id	默认专辑ID
	 * @param unknown_type $descrition  修改共享描述,没有就为空字符串
	 * @param unknown_type $status		分享状态
	 * @param unknown_type $addtag		添加标签
	 * @param unknown_type $deltag		删除标签
	 * @return 如果失败，返回错误原因
	 */
	static public function updateShareBaseInfo($uid,$share_id,$album_id,$default_album_id,$descrition,$status,$addtag=array(),$deltag=array())
	{
		if(!is_numeric($share_id) || $share_id<0)
			return getR(false,"分享ID异常");
		$descrition = new_addslashes($descrition);
		$dblink = new DataBase("");
		//如果是已经通过的，则应该减分享数、专辑下的分享数
		if ($status == 99){
			//减去专辑下的分享数
			$sql = "UPDATE pre_community_album SET file_count=file_count-1 WHERE uid=$uid AND id=$default_album_id";
			$dblink->query($sql);
			$sql = "UPDATE pre_community_user_stat SET share_count=share_count-1 WHERE uid=$uid";
			$dblink->query($sql);
		}
		//添加标签
		if ($addtag){
			foreach ($addtag as $k => $v){
				$addtag1[] = $v; 
			}
			//检查标签是否已存在库里
			$r = Community::getTagIsPresence($addtag1, $uid);
			$add_arr = $r["-msg-"];
			for($i=0;$i<count($add_arr);$i++)
			{
				$dblink->query("insert into pre_community_file_tag_map (tag_id,file_id) VALUES ('".$add_arr[$i]."','$share_id')");
			}
		}
		//删除标签
		if ($deltag){
			foreach ($deltag as $k => $v){
				$deltag1[] = $v; 
			}
			//查找标签信息，再删除分享与标签的关联
			for ($j = 0; $j < count($deltag1); $j++) {
				$sql = "SELECT * FROM pre_community_file_tag WHERE tag_name='$deltag1[$j]'";
				$tag_name = $dblink->getRow($sql);
				for ($k = 0; $k < count($tag_name); $k++) {
					$sql = "DELETE FROM pre_community_file_tag_map WHERE tag_id='".$tag_name[$k][id]."' AND file_id='$share_id'";
					$dblink->query($sql);
				}
			}
		}
		
		$sql = "UPDATE pre_community_file SET albumid='$album_id',description='$descrition',`status`=0 WHERE id='$share_id' AND uid=$uid";
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true);
	}
	
		/**
	 * 修改分享的审核信息
	 * @param unknown_type $shareid	共享ID,这里为数组形式
	 * @param unknown_type $status      修改分享审核状态，没有就为空字符串
	 * @param unknown_type $isdel      判断之前分享的审核状态
	 * @param unknown_type $toptype      分享置顶类型
	 * @param unknown_type $end_time 	 分享置顶有效期
	 * @return 如果失败，返回错误原因
	 */
	static public function updateSharestatusInfo($shareid=array(),$status,$isdel=array(),$toptype,$end_time)
	{
		$dblink = new DataBase("");
		$status_sql = (empty($status))?"":"status='$status'";
		for($i=0;$i<count($shareid);$i++){
			if(!is_numeric($shareid[$i]) || $shareid[$i]<0)
			return getR(false,"分享ID异常");
			if ($status == 99){ //审核通过增加数值
				$r  = Community::getShareInfo($shareid[$i]);
				$album_arr = $r["-msg-"];
				for ($j = 0; $j < count($album_arr); $j++) {
					if($album_arr[$j][status]!=99){
					$sql = "UPDATE pre_community_file SET $status_sql WHERE id='$shareid[$i]'";
					$dblink->query($sql);
					//增加专辑下的共享数
					$sql = "UPDATE pre_community_album SET file_count=file_count+1
						WHERE id=".$album_arr[$j][albumid];
					$dblink->query($sql);
					//更新用户分享数
					$sql = "SELECT uid FROM pre_community_user_stat WHERE uid=".$album_arr[$j][uid];
					$tmp_arr = $dblink->getRow($sql);
					if(count($tmp_arr)>0){
						$dblink->query("UPDATE pre_community_user_stat SET share_count=share_count+1 WHERE uid=".$album_arr[$j][uid]);
					}else{
						$dblink->query("INSERT INTO pre_community_user_stat SET share_count=1,uid=".$album_arr[$j][uid]);
					}
				 }	
				}
			}
			
			
			if ($status == "file_recommend"){ //审核通过并且推荐
				$r  = Community::getShareInfo($shareid[$i]);
				$album_arr = $r["-msg-"];
				for ($j = 0; $j < count($album_arr); $j++) {
					if($album_arr[$j][status]!=99){
					$sql = "UPDATE pre_community_file SET status=99,file_recommend=1 WHERE id='$shareid[$i]'";
					$dblink->query($sql);
					//增加专辑下的共享数
					$sql = "UPDATE pre_community_album SET file_count=file_count+1
						WHERE id=".$album_arr[$j][albumid];
					$dblink->query($sql);
					//更新用户分享数
					$sql = "SELECT uid FROM pre_community_user_stat WHERE uid=".$album_arr[$j][uid];
					$tmp_arr = $dblink->getRow($sql);
					if(count($tmp_arr)>0){
						$dblink->query("UPDATE pre_community_user_stat SET share_count=share_count+1 WHERE uid=".$album_arr[$j][uid]);
					}else{
						$dblink->query("INSERT INTO pre_community_user_stat SET share_count=1,uid=".$album_arr[$j][uid]);
					}
				 }elseif($album_arr[$j][status]==99){//已经通过审核的，只更新推荐字段
				 	$sql = "UPDATE pre_community_file SET file_recommend=1 WHERE id='$shareid[$i]'";
					$dblink->query($sql);
				 }	
				}
			}
			
			
			
			if ($status == "top"){ //审核通过并且置顶
				$r  = Community::getShareInfo($shareid[$i]);
				$album_arr = $r["-msg-"];
				for ($j = 0; $j < count($album_arr); $j++) {
					if($album_arr[$j][status]!=99){
					$sql = "UPDATE pre_community_file SET status=99,top=$toptype,top_time='$end_time' WHERE id='$shareid[$i]'";//更新status,top,top_time字段
					$dblink->query($sql);
					//增加专辑下的共享数
					$sql = "UPDATE pre_community_album SET file_count=file_count+1
						WHERE id=".$album_arr[$j][albumid];
					$dblink->query($sql);
					//更新用户分享数
					$sql = "SELECT uid FROM pre_community_user_stat WHERE uid=".$album_arr[$j][uid];
					$tmp_arr = $dblink->getRow($sql);
					if(count($tmp_arr)>0){
						$dblink->query("UPDATE pre_community_user_stat SET share_count=share_count+1 WHERE uid=".$album_arr[$j][uid]);
					}else{
						$dblink->query("INSERT INTO pre_community_user_stat SET share_count=1,uid=".$album_arr[$j][uid]);
					}
				 }elseif($album_arr[$j][status]==99){//已经通过审核的，只更新推荐字段
				 	$sql = "UPDATE pre_community_file SET top=$toptype,top_time='$end_time' WHERE id='$shareid[$i]'";
					$dblink->query($sql);
				 }	
				}
			}
			
			
			if ($status == "nopass_file_recommend"){ //取消推荐
				$r  = Community::getShareInfo($shareid[$i]);
				$album_arr = $r["-msg-"];
				for ($j = 0; $j < count($album_arr); $j++) {
					$sql = "UPDATE pre_community_file SET file_recommend=0 WHERE id='$shareid[$i]'";
					$dblink->query($sql);	
				}
			}
			
			
			if ($status == "nopass_top"){ //取消置顶
				$r  = Community::getShareInfo($shareid[$i]);
				$album_arr = $r["-msg-"];
				for ($j = 0; $j < count($album_arr); $j++) {
					$sql = "UPDATE pre_community_file SET top=0 WHERE id='$shareid[$i]'";
					$dblink->query($sql);	
				}
			}
			
			if ($status == 98){ 
				$r  = Community::getShareInfo($shareid[$i]);
				$album_arr = $r["-msg-"];
				for ($j = 0; $j < count($album_arr); $j++) {
					if($isdel[$j] ==1){//判断该分享之前是否审核通过，是减1，其它审核状态不减1
					//更新审核状态
					$sql = "UPDATE pre_community_file SET $status_sql WHERE id='$shareid[$i]'";
					$dblink->query($sql);
					//减少专辑下的共享数
					$sql = "UPDATE pre_community_album SET file_count=file_count-1
						WHERE id=".$album_arr[$j][albumid];
					$dblink->query($sql);
					//更新用户分享数
					$sql = "SELECT uid FROM pre_community_user_stat WHERE uid=".$album_arr[$j][uid];
					$tmp_arr = $dblink->getRow($sql);
					if(count($tmp_arr)>0){
						$dblink->query("UPDATE pre_community_user_stat SET share_count=share_count-1 WHERE uid=".$album_arr[$j][uid]);
					}
				  }elseif($album_arr[$j][status]!=98){
				  	//更新审核状态
				  	$sql = "UPDATE pre_community_file SET $status_sql WHERE id='$shareid[$i]'";
					$dblink->query($sql);
				  }
				}
			}		
			
		}
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 根据分享的ID判断审核状态					文件状态：0：未审核 99：已审核 98:审核不通过 97:系统拦截过滤
	 * @param unknown_type $share_id		分享ID
	 */
	static public function getsharestates($share_id=array()){
		//print_r($share_id);
		//if(!is_numeric($share_id) || $share_id<=0)
			//return getR(false,"用户分享ID异常");
			$dblink = new DataBase("");
			//echo "1111";
			for($i=0;$i<count($share_id);$i++){
			$sql = "SELECT * FROM pre_community_file WHERE id=$share_id[$i]";
			//print_r("SELECT * FROM pre_community_file WHERE id=$share_id");
			$shareinfo[$i] = $dblink->getRow($sql);
				if($shareinfo[$i][0][status] == 99){
					$status[$i] = 1;
				}else{
					$status[$i] = 0;
				}
			}
			//print_r($status);
			//print_r($shareinfo);
			return $status;
	}

	
	
	
	/**
	 * 喜欢一个分享
	 * @param unknown_type $uid		用户ID
	 * @param unknown_type $shareid 分享ID
	 * @return 如果成功，msg为映射ID，来自表pre_community_file_like
	 *         如果失败，msg为失败原因
	 */
	static public function likeShare($uid,$shareid)
	{
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户ID异常");
		if(!is_numeric($shareid) || $shareid<=0)
			return getR(false,"分享ID异常");
		$dblink = new DataBase("");
		$sql = "INSERT INTO pre_community_file_like (file_id,uid) 
				VALUES ('$shareid','$uid')";
		$dblink->query($sql);
		$id = $dblink->get_id();
		
		$sql = "UPDATE pre_community_file 
				SET be_like_count=be_like_count+1 WHERE id='$shareid'";
		$dblink->query($sql);
		
		$dblink->dbclose();
		return getR(true,$id);
	}
	
	/**
	 * 取消喜欢分享
	 * @param unknown_type $uid				用户UID
	 * @param unknown_type $shareid			分享ID
	 */
	static public function CancelLikeShare($uid,$shareid){
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户ID异常");
		if(!is_numeric($shareid) || $shareid<=0)
			return getR(false,"分享ID异常");
		$dblink = new DataBase("");
		$sql = "DELETE FROM pre_community_file_like WHERE file_id =$shareid AND uid=$uid";
		$dblink->query($sql);
		$sql = "UPDATE pre_community_file 
				SET be_like_count=be_like_count-1 WHERE id='$shareid'";
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 是否已喜欢分享
	 * @param unknown_type $id				分享ID
	 * @param unknown_type $uid				用户ID
	 * @return 已关注msg为1
	 * 		        未关注msg为0
	 */
	static public function IsLikeShare($id, $uid){
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户ID异常");
		if(!is_numeric($id) || $id<=0)
			return getR(false,"ID异常");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_file_like WHERE file_id=$id AND uid=$uid";
		$arr = $dblink->getRow($sql);
		if (count($arr)>0) {
			$msg = 1;
		}else {
			$msg = 0;
		}
		return $msg;
	}
	
	/**
	 * 是否已关注专辑
	 * @param unknown_type $id				专辑ID
	 * @param unknown_type $uid				用户ID
	 * @return 已关注msg为1
	 * 		       未关注msg为0
	 */
	static public function IsFollowAlbum($id, $uid){
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户ID异常");
		if(!is_numeric($id) || $id<=0)
			return getR(false,"ID异常");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_album_watch_map WHERE album_id=$id AND uid=$uid";
		$arr = $dblink->getRow($sql);
		if (count($arr)>0) {
			$msg = 1;
		}else {
			$msg = 0;
		}
		return $msg;
	}
	
	/**
	 * 是否已关注用户
	 * @param unknown_type $src_uid				用户ID
	 * @param unknown_type $dst_uid				目标ID
	 * @return 已关注msg为1
	 * 		        未关注msg为0
	 */
	static public function IsFollowUser($src_uid, $dst_uid){
		if(!is_numeric($src_uid) || $src_uid<=0)
			return getR(false,"用户ID异常");
		if(!is_numeric($dst_uid) || $dst_uid<=0)
			return getR(false,"目标ID异常");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_weibo_follow WHERE src_uid=$src_uid AND dst_uid=$dst_uid";
		$arr = $dblink->getRow($sql);
		if (count($arr)>0) {
			$msg = 1;
		}else {
			$msg = 0;
		}
		return $msg;
	}
	
	/**
	 * 删除分享
	 * @param unknown_type $uid
	 * @param unknown_type $shareid
	 * @return 如果失败，返回失败原因
	 */
	static public function deleteShare($uid,$shareid)
	{
		if(!is_numeric($shareid) || $shareid<=0)
			return getR(false,"分享ID异常");
		$dblink = new DataBase("");
		
		$sql = "SELECT uid,albumid FROM pre_community_file WHERE id='$shareid'";
		$uid_arr = $dblink->getRow($sql);
		$uid = $uid_arr[0][uid];
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"UID异常");
		
		$sql = "DELETE FROM pre_community_file WHERE id='$shareid'";
		$dblink->query($sql);
		
		//用户分享数减1
		$sql = "UPDATE pre_community_user_stat 
				SET share_count=IF(share_count<=0,0,share_count-1)
				WHERE uid='$uid'";
		$dblink->query($sql);
		
		//喜欢这个分享的用户的映射解除
		$sql ="DELETE FROM pre_community_file_like WHERE file_id='$shareid'";
		$dblink->query($sql);
		
		//删除这个分享的标签映射关系
		$sql = "DELETE FROM pre_community_file_tag_map WHERE file_id='$shareid'";
		$dblink->query($sql);
		
		
		//减少专辑下的共享数
		$sql = "UPDATE pre_community_album 
				SET file_count=IF(file_count<=0,0,file_count-1) 
				WHERE id='".$uid_arr[0][albumid]."'";
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 回复某个分享
	 * @param unknown_type $uid			回复人的UID
	 * @param unknown_type $nickname	回复人的昵称
	 * @param unknown_type $share_id	共享ID
	 * @param unknown_type $content		回复内容
	 * @param unknown_type $at_uid_arr	需要at的用户数组，空数组为不需要私信
	 */
	static public function replyShare($uid,$nickname,$share_id,$content,
			$at_uid_arr=array())
	{
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户ID异常");
		if(!is_numeric($share_id) || $share_id<=0)
			return getR(false,"共享ID异常");
		
		$dblink = new DataBase("");
		//查询分享的基本信息
		$sql = "SELECT uid,nickname,file_name FROM pre_community_file WHERE id='$share_id'";
		$tmp_arr = $dblink->getRow($sql);
		if(count($tmp_arr)<1)
			return getR(false,"没有这个共享");
		
		//if($tmp_arr[0][uid]==$uid)
		//	return getR(false,"自己不能给自己的");
		
		//添加回复
		$sql = "INSERT INTO pre_community_file_reply 
					(uid,file_id,nickname,content) 
				VALUES ('$uid','$share_id','$nickname','$content')";
		$dblink->query($sql);
		
		//增加分享回复数
		$sql = "UPDATE pre_community_file 
				SET be_reply_count=be_reply_count+1 
				WHERE id='$share_id'";
		$dblink->query($sql);
		
		//发送私信
		if(is_array($at_uid_arr) && count($at_uid_arr)>0)
		{
			for($i=0;$i<count($at_uid_arr);$i++)
			{
				$rpl = "评论了 ".$tmp_arr[0][nickname]." 的<a href=\"javascript:clickshare('$share_id');\">分享</a>: \"$content\"并邀请我围观";
				Weibo::SendPrivateMail($uid, $atuid_arr[$i], $rpl);
			}
		}
		
		
		$dblink->dbclose();
		return getR(true);
		
	}
	
	/**
	 * 删除共享回复
	 * @param unknown_type $rid	需要被删除的回复ID
	 */
	static public function deleteShareReply($rid)
	{
		if(!is_numeric($rid) || $rid<=0)
			return getR(false,"回复ID异常");
		
		$dblink = new DataBase("");
		//获得共享回复的相关信息
		$sql = "SELECT file_id FROM pre_community_file_reply WHERE id='$rid'";
		$tmp_arr = $dblink->getRow($sql);
		if(count($tmp_arr)==0)
			return getR(false,"不存在这条评论");
		
		//删除回复
		$sql = "DELETE FROM pre_community_file_reply WHERE id='$rid'";
		$dblink->query($sql);
		
		//让分享的回复数-1
		$sql = "UPDATE pre_community_file 
				SET be_reply_count=IF(be_reply_count<=0,0,be_reply_count-1) 
				WHERE id='".$tmp_arr[0][file_id]."'";
		$dblink->query($sql);
		
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 获得某分享的回复信息
	 * @param unknown_type $share_id 分享ID
	 * @param unknown_type $page	当前页码
	 * @param unknown_type $record_per_page 每页记录数
	 */
	static public function getShareReplyList($share_id,$page=1,
			$record_per_page=10,$nickname,$star_time,$end_time,$description)
	{
		if(!is_numeric($share_id) || $share_id<=0)
			return getR(false,"共享ID异常");
		$nickname_sql = (empty($nickname))?"":"and nickname like '$nickname'";	
		$star_time_sql = (empty($star_time))?"":"and input_time >= '$star_time'";
		$end_time_sql = (empty($end_time))?"":"and input_time <= '$end_time'";
		$description_sql = (empty($description))?"":"and content like '$description'";
		
		$dblink = new DataBase("");

		$count_arr = $dblink->getRow("select count(*) as num from pre_community_file_reply 
						where file_id='$share_id' $nickname_sql $star_time_sql $end_time_sql $description_sql");
		$num = $count_arr[0][num];
		
		$sql = "SELECT * FROM pre_community_file_reply 
				WHERE file_id='$share_id' $nickname_sql $star_time_sql $end_time_sql $description_sql ORDER BY reply_time DESC 
				LIMIT ".($page-1)*$record_per_page.",$record_per_page";
		$dbarr = $dblink->getRow($sql);
		for ($i=0;$i<count($dbarr);$i++){
			$dbarr[$i][thumb] = getLiveHead($dbarr[$i]["uid"],"small");
		}
		$dblink->dbclose();
		$v[num] = $num;
		$v[arr] = $dbarr;
		return getR(true,$v);
	}
	
	
	/**
	 * 获得专辑中所有分享
	 * @param unknown_type $album_id	专辑ID
	 * @param unknown_type $order_type	排序类型 1：根据分享被喜欢数排序
	 * 											2: 根据被收藏数排序
	 * 											3: 根据添加时间排序
	 * @param unknown_type $order_asc  排序是升序还是降序 "asc"
	 * 													"desc"
	 * @param unknown_type $page
	 * @param unknown_type $page_per_page
	 * @return 如果成功，返回一个数组，其中num是符合条件的总数，用于分页
	 * 			arr表示符合条件的分享数组，数组元素来自pre_community_file表
	 */
	static public function getShareListFromAlbum($album_id,$order_type,
			$order_asc="desc",$page=1,$page_per_page=10)
	{
		if(!is_numeric($album_id) || $album_id<=0)
			return getR(false,"专辑ID异常");
		if(!is_numeric($order_type) || $order_type<=0)
			return getR(false,"排序方式异常");
		if(!is_numeric($page) || $page<=0)
			return getR(false,"页码异常");
		if(!is_numeric($page_per_page) || $page_per_page<=0)
			return getR(false,"每页记录数异常");
		
		switch ($order_type)
		{
			case 1:
				$order_sql = "order by be_like_count $order_asc";
				break;
			case 2:
				$order_sql = "order by be_collect_count $order_asc";
				break;
			case 3:
				$order_sql = "order by input_time $order_asc";
				break;
			default:
				$order_sql = "order by input_time $order_asc";
				break;
		}
		
		$dblink = new DataBase("");
		//获取符合条件的总数
		$num_sql = "SELECT count(*) as num FROM pre_community_file 
					WHERE status=99 AND albumid='$album_id'";
		$num_arr = $dblink->getRow($num_sql);
		$num = $num_arr[0][num];
		//获得符合条件的数组
		$sql = "SELECT * FROM pre_community_file WHERE status=99 AND albumid='$album_id'
				$order_sql LIMIT ".($page-1)*$page_per_page.",$page_per_page";
		$dbarr = $dblink->getRow($sql);
		for ($i = 0; $i < count($dbarr); $i++) {
			$album_name = Community::getAlbumInfo($dbarr[$i]["albumid"]);
			$dbarr[$i][album_name] = $album_name["-msg-"][arr][0][album_name];
			$dbarr[$i][user_arr] = Community::getUserTotalInfo($dbarr[$i]["uid"]);
		}
		$v[num] = $num;
		$v[arr] = $dbarr;
		return getR(true,$v);
	}
	
	/**
	 * 获得专辑中9个分享图
	 * @param unknown_type $album_id	专辑ID
	 * @param unknown_type $order_type	排序类型 1：根据分享被喜欢数排序
	 * 											2: 根据被收藏数排序
	 * 											3: 根据添加时间排序
	 * @param unknown_type $order_asc  排序是升序还是降序 "asc"
	 * 													"desc"
	 * @param unknown_type $page
	 * @param unknown_type $page_per_page
	 * @return 如果成功，返回一个数组，其中num是符合条件的总数，用于分页
	 * 			arr表示符合条件的分享数组，数组元素来自pre_community_file表
	 */
	static public function getShareListFromAlbumPic($album_id,$order_type,
			$order_asc="desc",$page=1,$page_per_page=10)
	{
		if(!is_numeric($album_id) || $album_id<=0)
			return getR(false,"专辑ID异常");
		if(!is_numeric($order_type) || $order_type<=0)
			return getR(false,"排序方式异常");
		if(!is_numeric($page) || $page<=0)
			return getR(false,"页码异常");
		if(!is_numeric($page_per_page) || $page_per_page<=0)
			return getR(false,"每页记录数异常");
		
		switch ($order_type)
		{
			case 1:
				$order_sql = "order by be_like_count $order_asc";
				break;
			case 2:
				$order_sql = "order by be_collect_count $order_asc";
				break;
			case 3:
				$order_sql = "order by input_time $order_asc";
				break;
			default:
				$order_sql = "order by input_time $order_asc";
				break;
		}
		
		$dblink = new DataBase("");
		$num = $num_arr[0][num];
		//获得符合条件的数组
		$sql = "SELECT * FROM pre_community_file WHERE status=99 AND albumid='$album_id'
				$order_sql LIMIT ".($page-1)*$page_per_page.",$page_per_page";
		$dbarr = $dblink->getRow($sql);
		$v[arr] = $dbarr;
		return getR(true,$v);
	}
	
	/**
	 * 根据类别获取对应的共享列表
	 * @param unknown_type $class_id		类别ID，如果为0，则为所有类别
	 * @param unknown_type $order_type		1：按发布时间排序
	 * 										2：按浏览人数+喜欢数+转藏数排序(热度)
	 * @param unknown_type $file_type       分享类型：0,所有类型  1,图片 2，视频 3，商品
	 * @param unknown_type $start_time		开始时间 2012-02-10 12:10:20
	 * @param unknown_type $end_time		结束时间 2012-02-10 12:10:20
	 * @param unknown_type $order_asc		desc：倒序 asc：升序
	 * @param unknown_type $page			当前页
	 * @param unknown_type $page_per_page	每页记录数
	 * @return 如果失败，返回失败原因
	 * 			如果成功，返回数组中num为总记录数，用于分页
	 * 					arr为符合条件的数组，其中元素包括	pre_community_file表
	 *                  所有内容、class_name 类别(分享所属的专辑的类别)、allnum热点数
	 */
	static public function getShareListFromClass($class_id,$order_type,$file_type=0,
			$start_time=0,$end_time=0,$order_asc="desc",$page=1,$page_per_page=10)
	{
		if(!is_numeric($class_id) || $class_id<0)
			return getR(false,"分享ID异常");
		//加缓存
        $c_memcache = new cmemcache;
        //取缓存结果集
        if($class_id == 0)
        {
            $result = $c_memcache->get("pnews_data".$page);
            $result = unserialize($result);
        }
        if(!empty($result))
        {
              return getR(true,$result);
        }
        else
        {
            $class_id_sql=($class_id==0)?"":"and class_id='$class_id'";
            $start_time_sql = (empty($start_time))?"":" and a.input_time>='$start_time'";
            $end_time_sql = (empty($end_time))?"":" and a.input_time<='$end_time'";
            if ($class_id !=0){
                $top_sql = "and (a.top=2 or a.top=1) and  NOW()<=top_time";//首页置顶,分类标签置顶
            }else{
                $top_sql = "and (a.top=3 or a.top=1) and  NOW()<=top_time";//首页置顶，全局置顶
            }

            $file_recommend = "and a.file_recommend=1";//推荐
            //$del_toprecommend = "and a.file_recommend=0 and  a.top=0";//过滤置顶，推荐
            //$no_indextop_sql = (empty($class_id))?"":"or a.top=3";//分类页，包含top3
            if (empty($class_id)){
                $del_toprecommend = "and a.file_recommend=0 and  (a.top=0 or a.top=2)";//过滤置顶，推荐
            }else{
                $del_toprecommend = "and a.file_recommend=0 and  (a.top=0 or a.top=3)";//过滤置顶，推荐
            }
            switch ($order_type)
            {
                case 1:
                    $order_sql = "order by input_time $order_asc";
                    break;
                case 2:
                    $order_sql = "order by allnum $order_asc";
                    break;
                default:
                    $order_sql = "order by input_time $order_asc";
                    break;
            }

            switch($file_type)
            {
                case 1 :
                    $file_type_sql = "and a.file_type='1'";
                    break;
                case 2 :
                    $file_type_sql = "and a.file_type='2'";
                    break;
                case 3 :
                    $file_type_sql = "and a.file_type='3'";
                    break;
                case 0:
                default:
                    $file_type_sql = "";
                    break;

            }

            $dblink = new DataBase("");
            $num_sql = "select count(*) as num
					FROM pre_community_file a
					INNER JOIN pre_community_album b ON a.albumid=b.id
					INNER JOIN pre_community_class c ON b.class_id=c.id
					where a.status=99 $class_id_sql $start_time_sql $end_time_sql $file_type_sql
					";
            $num_arr = $dblink->getRow($num_sql);
            $num = $num_arr[0][num];
            $sql = "SELECT * FROM (SELECT * FROM (SELECT  a.*,b.album_name,c.id AS class_id,
					c.name AS class_name,
					a.be_like_count+a.be_collect_count+a.be_views AS allnum
				FROM pre_community_file a
				LEFT OUTER JOIN pre_community_album b ON a.albumid=b.id
				LEFT OUTER JOIN pre_community_class c ON b.class_id=c.id
				where a.status=99 $top_sql $class_id_sql $start_time_sql $end_time_sql $file_type_sql
				$order_sql
				) AS aa UNION ALL
				SELECT * FROM (SELECT  a.*,b.album_name,c.id AS class_id,
					c.name AS class_name,
					a.be_like_count+a.be_collect_count+a.be_views AS allnum
				FROM pre_community_file a
				LEFT OUTER JOIN pre_community_album b ON a.albumid=b.id
				LEFT OUTER JOIN pre_community_class c ON b.class_id=c.id
				where a.status=99 $file_recommend $class_id_sql $start_time_sql $end_time_sql $file_type_sql
				$order_sql
				) AS bb UNION ALL
				SELECT * FROM (SELECT  a.*,b.album_name,c.id AS class_id,
					c.name AS class_name,
					a.be_like_count+a.be_collect_count+a.be_views AS allnum
				FROM pre_community_file a
				LEFT OUTER JOIN pre_community_album b ON a.albumid=b.id
				LEFT OUTER JOIN pre_community_class c ON b.class_id=c.id
				where a.status=99   $del_toprecommend  $class_id_sql $start_time_sql $end_time_sql $file_type_sql
				  $order_sql )AS cc)tmp LIMIT ".($page-1)*$page_per_page.",$page_per_page";
            $dbarr = $dblink->getRow($sql);
//		    for ($i = 0; $i < count($dbarr); $i++) {
//			        $dbarr[$i][user_arr] = Community::getShearTotalUserInfo($dbarr[$i]["uid"]);
//		    }
            $v[num] = $num;
            $v[arr] = $dbarr;
            //缓存结果集
            if($class_id == 0)
            {
                 $c_memcache->set("pnews_data".$page,serialize($v),1800);
            }
            $dblink->dbclose();
            return getR(true,$v);
        }
	}
	
	/**
	 * 获取分类最近分享用户
	 * @param unknown_type $class_id
	 * @param unknown_type $page
	 * @param unknown_type $page_per_page
	 */
	static public function getClassRecentShareUser($class_id,$page=1,$page_per_page=10){
		if(!is_numeric($class_id) || $class_id<0)
			return getR(false,"分享ID异常");
		$class_id_sql=($class_id==0)?"":"and class_id='$class_id'";
		$dblink = new DataBase("");
		$sql = "SELECT a.uid,a.nickname,b.album_name,c.id AS class_id, c.name AS class_name, 
				a.be_like_count+a.be_collect_count+a.be_views AS allnum FROM pre_community_file a 
				INNER JOIN pre_community_album b ON a.albumid=b.id 
				INNER JOIN pre_community_class c ON b.class_id=c.id 
				WHERE a.status=99 AND class_id='$class_id' GROUP BY uid ORDER BY allnum DESC 
				LIMIT ".($page-1)*$page_per_page.",$page_per_page";
		$dbarr = $dblink->getRow($sql);
		for ($i = 0; $i < count($dbarr); $i++) {
			$dbarr[$i][user_avatar] = getLiveHead($dbarr[$i]["uid"],"small");
		}
		$dblink->dbclose();
		return getR(true,$dbarr);
	}
	
	/**
	 * 获取分类活跃用户
	 * @param unknown_type $class_id
	 * @param unknown_type $page
	 * @param unknown_type $page_per_page
	 */
	static public function getClassActiveUser($class_id,$page=1,$page_per_page=10){
		if(!is_numeric($class_id) || $class_id<0)
			return getR(false,"分享ID异常");
		$dblink = new DataBase("");
		$sql = "SELECT *,SUM(file_state) AS num FROM pre_community_file
				WHERE albumid=$class_id AND STATUS=99 GROUP BY uid ORDER BY num DESC 
				LIMIT ".($page-1)*$page_per_page.",$page_per_page";
		$dbarr = $dblink->getRow($sql);
		for ($i = 0; $i < count($dbarr); $i++) {
			$dbarr[$i][user_avatar] = getLiveHead($dbarr[$i]["uid"],"small");
		}
		$dblink->dbclose();
		return getR(true,$dbarr);
	}
	
	/**
	 * 获得某分享"同出自"的专辑
	 * @param unknown_type $share_id	分享ID
	 * @param unknown_type $order_type	排序类型 1：按专辑创建时间排序
	 * 											2：按专辑下分享数排序
	 * @param unknown_type $order_state 按照什么排序："asc" "desc"
	 * @return 如果失败，msg返回false
	 *      	如果成功，msg返回一个数组，数组元素为pre_community_album a表中的
	 *          a.id,a.uid,a.album_name,a.file_count
	 */
	static public function getSameSouceAlbumFromId($share_id,$order_type=1,
			$order_state="desc")
	{
		if(!is_numeric($share_id) || $share_id<=0)
			return getR(false,"分享ID异常");
		
		switch ($order_type)
		{
			case 1:
				$order_sql = "order by input_time $order_state";
				break;
			case 2:
				$order_sql = "order by file_count $order_state";
				break;
			default:
				$order_sql = "order by input_time $order_state";
				break;
		}
		
		$dblink = new DataBase("");
		$sql = "SELECT a.id,a.uid,a.album_name,a.file_count 
				FROM pre_community_album a
				WHERE a.id IN 
					(SELECT DISTINCT albumid FROM pre_community_file b 
					 WHERE b.source_id='$share_id')
				$order_sql";
		$dbarr = $dblink->getRow($sql);
		$dblink->dbclose();
		return getR(true,$dbarr);
	}
	
	/**
	 * 前台首页获取推荐位列表
	 * @param unknown_type $posid		推荐ID
	 * @param unknown_type $listorder   排序(默认DESC) 
	 * @return unknown_type
	 */
	static public function getPosList($posid,$listorder="DESC"){
		if(!is_numeric($posid) || $posid<0)
			return getR(false,"推荐ID异常");
		$dblink = new DataBase("");
		if($listorder != '') {
			$listorder = " ORDER BY b.listorder $listorder";
		}
		$sql = "SELECT b.name,b.url,b.classid FROM pre_community_position a LEFT JOIN pre_community_position_data b 
ON a.posid=b.posid WHERE a.posid=$posid $listorder";
		$dbarr = $dblink->getRow($sql);
		$dblink->dbclose();
		return $dbarr;
	}
	
	
	
	/**
	 * 获得某个分享，TA们喜欢 
	 *  @param unknown_type $uid	登录用户UID
	 * @param unknown_type $share_id	分享ID
	 * @param unknown_type $order_type	排序类型
	 * @param unknown_type $order_asc  排序是升序还是降序 "asc"
	 * 													"desc"
	 * *@param unknown_type $include_user  登录用户是否包含 
	 * @param unknown_type $page
	 * @param unknown_type $page_per_page
	 * @return 如果成功，返回一个数组，其中num是符合条件的总数，用于分页
	 * 			arr表示符合条件的分享数组，数组元素来自pre_community_file表
	 */
	static public function getLikeShareList($uid,$share_id,$page=1,$page_per_page=10)
	{
		if(!is_numeric($share_id) || $share_id<=0)
			return getR(false,"专辑ID异常");
		if(!is_numeric($page) || $page<=0)
			return getR(false,"页码异常");
		if(!is_numeric($page_per_page) || $page_per_page<=0)
			return getR(false,"每页记录数异常");
		
		
		//是否包含用户
		$include_user=empty($uid)?"":"and uid not in($uid)";
		//是否登录，登录按最新点了喜欢的时间排序
		$order_type =empty($uid)?"":"order by id asc";
		$dblink = new DataBase("");
		//取出用户喜欢这个分享总数
		$num_sql = "SELECT count(*) as num FROM pre_community_file_like 
					WHERE file_id='$share_id'";
		$num_arr = $dblink->getRow($num_sql);
		$num = $num_arr[0][num];
		//获得符合条件的数组
		$sql = "select * from pre_community_file_like where file_id = '$share_id' $include_user $order_type LIMIT ".($page-1)*$page_per_page.",$page_per_page";
		
		
		$dbarr = $dblink->getRow($sql);
		$allnum= array();
		//获取用户的活跃度
		for($i=0;$i<count($dbarr);$i++){
			$dbarr[$i][allnum]=Community::getUserActive($dbarr[$i][uid]);
		}
		
		for ($i=0;$i<count($dbarr);$i++){
			$dbarr[$i][thumb] = getLiveHead($dbarr[$i]["uid"],"small");
		}
		$v[num] = $num;
		//未登录，按用户活跃度
		if($uid == "") {
		$dbarr = Community::sortByOneKey($dbarr, 'allnum',false);
		}
		$v[arr] = $dbarr;
		return getR(true,$v);
	}
	
	//重新排序数组函数
	
	function sortByOneKey(array $array, $key, $asc = true) {
	    $result = array();
	        
	    $values = array();
	    foreach ($array as $id => $value) {
	        $values[$id] = isset($value[$key]) ? $value[$key] : '';
	    }
	        
	    if ($asc) {
	        asort($values);
	    }
	    else {
	        arsort($values);
	    }
	        
	    foreach ($values as $key => $value) {
	        $result[$key] = $array[$key];
	    }
	        
	    return $result;
	 }


	
	/**
	 * 获得用户活跃度
	 *  @param unknown_type $uid	用户UID
	 *
	 */
	static public function getUserActive($uid){
			//$uid="27384";
			$dblink = new DataBase("");
			$sql = "select count(*) as num from pre_community_file where uid=".$uid;
			$usernum = $dblink->getRow($sql);//用户发布分享条数
			$sql ="select count(*) as num from pre_community_file_like where uid=".$uid;
			$collectnum = $dblink->getRow($sql);//喜欢收藏分享条数
			$allnum = $usernum[0][num] +$collectnum[0][num];
			return $allnum;
		}
	
	/**
	 * 得到分享前后的集合
	 * @param unknown_type $album_id			专辑ID
	 * @param unknown_type $share_id			分享ID
	 * @return unknown_type
	 */
	static public function getShowAlbumShare($album_id,$share_id){
		if(!is_numeric($album_id) || $album_id<=0)
			return getR(false,"专辑ID异常");
		if(!is_numeric($share_id) || $share_id<=0)
			return getR(false,"分享ID异常");
		$dblink = new DataBase("");
		$sql = "SELECT COUNT(*) as count FROM pre_community_file WHERE status=99 AND albumid=$album_id";
		$total_share = $dblink->getRow($sql);
		$sql = "SELECT COUNT(*) as count FROM pre_community_file WHERE status=99 AND albumid=$album_id AND id<=$share_id";
		$first_several = $dblink->getRow($sql);
		$first = ($first_several[0][count]<5) ? '0':($first_several[0][count]-4);
		$sql = "SELECT * FROM pre_community_file WHERE status=99 AND albumid=$album_id ORDER BY id LIMIT $first,9";
		$dbarr = $dblink->getRow($sql);
		$v[num] = $total_share[0][count];
		$v[first] = $first_several[0][count];
		$v[arr] = $dbarr;
		return getR(true,$v);
	}
	
	
	
	/**
	 * 获得某个分享，TA们转藏
	 * @param unknown_type $collect_id	转藏ID
	 * @param unknown_type $order_type	排序类型 1：根据分享被喜欢数排序
	 * 											2: 根据被收藏数排序
	 * 											3: 根据添加时间排序
	 * @param unknown_type $order_asc  排序是升序还是降序 "asc"
	 * 													"desc"
	 * @param unknown_type $page
	 * @param unknown_type $page_per_page
	 * @return 如果成功，返回一个数组，其中num是符合条件的总数，用于分页
	 * 			arr表示符合条件的分享数组，数组元素来自pre_community_file表
	 */
	static public function getCollectList($collect_id,$order_type,
			$order_asc="desc",$page=1,$page_per_page=10)
	{
		if(!is_numeric($collect_id) || $collect_id<=0)
			return getR(false,"专辑ID异常");
		if(!is_numeric($order_type) || $order_type<=0)
			return getR(false,"排序方式异常");
		if(!is_numeric($page) || $page<=0)
			return getR(false,"页码异常");
		if(!is_numeric($page_per_page) || $page_per_page<=0)
			return getR(false,"每页记录数异常");
		
		switch ($order_type)
		{
			case 1:
				$order_sql = "order by be_like_count $order_asc";
				break;
			case 2:
				$order_sql = "order by be_collect_count $order_asc";
				break;
			case 3:
				$order_sql = "order by input_time $order_asc";
				break;
			default:
				$order_sql = "order by input_time $order_asc";
				break;
		}
		
		$dblink = new DataBase("");
		//获取符合条件的他们转藏总数
		$num_sql = "select count(*) as num from pre_community_file where source_id='$collect_id' and file_state=3";
		$num_arr = $dblink->getRow($num_sql);
		$num = $num_arr[0][num];
		//获得符合条件的数组
		$sql = "select a.input_time,a.id,a.uid,a.nickname,a.albumid,a.source_id,a.file_state,a.remote_url,b.album_name,b.file_count from pre_community_file a inner join pre_community_album b on a.albumid=b.id where  source_id='$collect_id' and file_state=3 $order_sql
		LIMIT ".($page-1)*$page_per_page.",$page_per_page";
		$dbarr = $dblink->getRow($sql);
		//过滤同一个人转藏同一个分享，只记录最新的一个
		$temp=array();
		foreach($dbarr as $e){
			$uid=intval($e['uid']);
			$temp[$uid]=isset($temp[$uid])?
					(strtotime($e['input_time'])>strtotime($temp[$uid]['input_time']))? $e:$temp[$uid] : $e;
		
		}
		$temp=array_values($temp);
		$dbarr = $temp;
		
		for ($i=0;$i<count($dbarr);$i++){
			$dbarr[$i][thumb] = getLiveHead($dbarr[$i]["uid"],"small");
			$dbarr[$i][share_img] = Community::getUserShare($dbarr[$i]["uid"]);
			$dbarr[$i][share_count] = Community::getUserTotalInfo($dbarr[$i]["uid"]);
		}
		$v[num] = $num;
		$v[arr] = $dbarr;
		//print_r($v);
		return getR(true,$v);
	}
	/**
	 * 根据分享ID获取标签
	 * @param unknown_type $share_id			分享ID
	 * @param unknown_type $page_per_page		获取几个标签	
	 */
	static public function getShareTagName($share_id,$page_per_page=3){
		if(!is_numeric($share_id) || $share_id<=0)
			return getR(false,"分享异常");
		if(!is_numeric($page_per_page) || $page_per_page<=0)
			return getR(false,"记录数异常");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_file_tag_map WHERE file_id=$share_id LIMIT $page_per_page";
		$arr = $dblink->getRow($sql);
		for ($i = 0; $i < count($arr); $i++) {
			$sql = "SELECT * FROM pre_community_file_tag WHERE id=".$arr[$i][tag_id];
			$arr_r = $dblink->getRow($sql);
			for ($j = 0; $j < count($arr_r); $j++) {
				$dbarr[$i][id] = $arr_r[$j][id];
				$dbarr[$i][name] = $arr_r[$j][tag_name];
			}
		}
		return $dbarr;
	}
	
	/**
	 * 根据用户UID获取用户最近的几个分享
	 * @param unknown_type $uid					用户UID
	 * @param unknown_type $page_per_page		获取几个分享(默认取最新的三个)
	 */
	static public function getUserShare($uid,$page_per_page=3){
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"UID异常");
		if(!is_numeric($page_per_page) || $page_per_page<=0)
			return getR(false,"记录数异常");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_file WHERE uid=$uid AND status=99 ORDER BY input_time DESC LIMIT $page_per_page";
		$dbarr = $dblink->getRow($sql);
		return $dbarr;
	}
	
	/**
	 * 用户的专辑列表
	 * @param unknown_type $uid						用户UID
	 * @param unknown_type $list					区分方式 1: 我自己的专辑
	 * 														2: 我关注的专辑
	 * @param unknown_type $order_type				排序类型 1：根据被关注数排序
	 * 														2: 根据专辑下共享的数排序
	 * 														3: 根据被评论数排序
	 * @param unknown_type $order_asc				排序是升序还是降序(默认DESC)
	 * @param unknown_type $page					当前页
	 * @param unknown_type $page_per_page			每页记录数
	 */
	static public function getUserAlbumList($uid,$list=1,$order_type,$order_asc="desc",$page=1,$page_per_page=10){
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"UID异常");
		if(!is_numeric($order_type) || $order_type<=0)
			return getR(false,"排序方式异常");
		if(!is_numeric($page) || $page<=0)
			return getR(false,"页码异常");
		if(!is_numeric($page_per_page) || $page_per_page<=0)
			return getR(false,"每页记录数异常");
		switch ($order_type)
		{
			case 1:
				$order_sql = "order by be_watch_count $order_asc";
				break;
			case 2:
				$order_sql = "order by file_count $order_asc";
				break;
			case 3:
				$order_sql = "order by be_reply_count $order_asc";
				break;
			default:
				$order_sql = "order by input_time $order_asc";
				break;
		}
		$dblink = new DataBase("");
		if ($list == '1'){
			$sql = "SELECT * FROM pre_community_album WHERE uid=$uid $order_sql LIMIT ".($page-1)*$page_per_page.",$page_per_page";
			$my_dbarr = $dblink->getRow($sql);
		}else {
			$sql = "SELECT album_id as id FROM pre_community_album_watch_map WHERE uid=$uid";
			$numfollow = $dblink->getRow($sql);//分页总页数
			$sql = "SELECT album_id as id FROM pre_community_album_watch_map WHERE uid=$uid LIMIT ".($page-1)*$page_per_page.",$page_per_page";
			$my_arr = $dblink->getRow($sql);
			for ($j2 = 0; $j2 < count($my_arr); $j2++) {
				$sql = "SELECT * FROM pre_community_album WHERE id = ".$my_arr[$j2][id]." $order_sql";
				$my_r = $dblink->getRow($sql);
				for ($k = 0; $k < count($my_r); $k++) {
					$my_dbarr[$j2] = $my_r[$k];
					$my_dbarr[$j2]['numfollow'] = count($numfollow);
				}
			}
		}
		
		for ($i=0;$i<count($my_dbarr);$i++){
			$my_dbarr[$i][avatar] = getLiveHead($my_dbarr[$i]["uid"],"small");
			if ($my_dbarr[$i][front_cover]==2){//如果设置了封面，则取封面
				$c = Community::getCoverList($my_dbarr[$i][id],$my_dbarr[$i][uid]);
				$c_arr = $c["-msg-"];
				$my_dbarr[$i][thumb] = $c_arr[0]['small'];
			}elseif ($my_dbarr[$i][front_cover]==1){//取九宫格
				$r = Community::getShareListFromAlbumPic($my_dbarr[$i][id],3,'desc',1,9);
				$r_arr = $r["-msg-"][arr];
				for ($j = 0; $j < count($r_arr); $j++) {
					$my_dbarr[$i][thumb][] = $r_arr[$j][small];
				}
			}else {
				$r = Community::getShareListFromAlbumPic($my_dbarr[$i][id],3,'asc',1,1);
				$r_arr = $r["-msg-"][arr];
				$my_dbarr[$i][thumb] = $r_arr[0][small];
			}
			
		}
		return $my_dbarr;
		//print_r($my_dbarr);
		
	}
	
	
	/**
	 * 用户的喜欢列表
	 * @param unknown_type $uid						用户UID
	 * @param unknown_type $order_type				排序类型 1：根据被收藏数排序
	 * 														2: 根据时间排序
	 * 														3: 根据被喜欢数排序
	 * @param unknown_type $order_asc				排序是升序还是降序(默认DESC)
	 * @param unknown_type $page					当前页
	 * @param unknown_type $page_per_page			每页记录数
	 */
	static public function getUserLikeList($uid,$order_type,$order_asc="desc",$page=1,$page_per_page=10){
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"UID异常");
		if(!is_numeric($order_type) || $order_type<=0)
			return getR(false,"排序方式异常");
		if(!is_numeric($page) || $page<=0)
			return getR(false,"页码异常");
		if(!is_numeric($page_per_page) || $page_per_page<=0)
			return getR(false,"每页记录数异常");
		switch ($order_type)
		{
			case 1:
				$order_sql = "order by be_collect_count $order_asc";
				break;
			case 2:
				$order_sql = "order by input_time $order_asc";
				break;
			case 3:
				$order_sql = "order by be_like_count $order_asc";
				break;
			default:
				$order_sql = "order by be_like_count $order_asc";
				break;
		}
		$dblink = new DataBase("");
		$sql = "SELECT count(*) FROM pre_community_file_like WHERE uid=$uid";
		$con_num = $dblink->getRow($sql);
		$num = $con_num[0][num];
		$sql = "SELECT file_id AS id FROM pre_community_file_like WHERE uid=$uid";
		$r = $dblink->getRow($sql);
		for ($i = 0; $i < count($r); $i++) {
			$sql = "SELECT * FROM pre_community_file WHERE status=99 AND id=".$r[$i][id]." $order_sql LIMIT ".($page-1)*$page_per_page.",$page_per_page";
			$r_arr = $dblink->getRow($sql);
			for ($j = 0; $j < count($r_arr); $j++) {
				$dbarr[$i] = $r_arr[$j];
				$album_name = Community::getAlbumInfo($r_arr[$j]["albumid"]);
				$dbarr[$i][album_name] = $album_name["-msg-"][arr][0][album_name];
				$dbarr[$i][avatar] = getLiveHead($r_arr[$j]["uid"],"small");
				$dbarr[$i][tag_name] = Community::getShareTagName($r_arr[$j]["id"]);
				$dbarr[$i][user_arr] = Community::getUserTotalInfo($r_arr[$j]["uid"]);
			}
		}
//		return $dbarr;
		$v[num] = $num;
		$v[arr] = $dbarr;
		//print_r($v);
		return getR(true,$v);
	}
	
	
	/**
	 * 用户的分享列表
	 * @param unknown_type $uid						用户UID
	 * @param unknown_type $order_type				排序类型 1：根据被收藏数排序
	 * 														2: 根据被喜欢数排序
	 * 														3: 根据时间排序
	 * @param unknown_type $order_asc				排序是升序还是降序(默认DESC)
	 * @param unknown_type $page					当前页
	 * @param unknown_type $page_per_page			每页记录数
	 */
	static public function getUserShareList($uid,$order_type,$status=99,$order_asc="desc",$page=1,$page_per_page=10){
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"UID异常");
		if(!is_numeric($order_type) || $order_type<=0)
			return getR(false,"排序方式异常");
		if(!is_numeric($page) || $page<=0)
			return getR(false,"页码异常");
		if(!is_numeric($page_per_page) || $page_per_page<=0)
			return getR(false,"每页记录数异常");
		switch ($order_type)
		{
			case 1:
				$order_sql = "order by be_collect_count $order_asc";
				break;
			case 2:
				$order_sql = "order by be_like_count $order_asc";
				break;
			case 3:
				$order_sql = "order by input_time $order_asc";
				break;
			default:
				$order_sql = "order by input_time $order_asc";
				break;
		}
		if ($status==0){
			$status_sql = "";
		}else {
			$status_sql = "AND status=99";
		}
		$dblink = new DataBase("");
		$sql = "SELECT count(*) num FROM pre_community_file WHERE uid=$uid";
		$con_num = $dblink->getRow($sql);
		$num = $con_num[0][num];
		$sql = "SELECT * FROM pre_community_file WHERE uid=$uid $status_sql $order_sql LIMIT ".($page-1)*$page_per_page.",$page_per_page";
		$dbarr = $dblink->getRow($sql);
		for ($i = 0; $i < count($dbarr); $i++) {
			$album_name = Community::getAlbumInfo($dbarr[$i]["albumid"]);
			$dbarr[$i][album_name] = $album_name["-msg-"][arr][0][album_name];
			$dbarr[$i][avatar] = getLiveHead($dbarr[$i]["uid"],"small");
			$dbarr[$i][tag_name] = Community::getShareTagName($dbarr[$i]["id"]);
			$dbarr[$i][user_arr] = Community::getUserTotalInfo($dbarr[$i]["uid"]);
		}
//		return $dbarr;
		$v[num] = $num;
		$v[arr] = $dbarr;
		//print_r($v);
		return getR(true,$v);
		
	}
	
	
	/**
	 * 获取首次登录关注专辑推荐位
	 */
	static public function getLogPositionInfo(){
		$dblink = new DataBase("");
		$sql = "SELECT posid,`name` FROM pre_community_position WHERE posid IN(4,5,6,7) ORDER BY posid";
		$dbarr = $dblink->getRow($sql);
		return $dbarr;				
	}
	
	
	/**
	 * 获取推荐位列表
	 * @param unknown_type $posid					推荐位所属ID，如果为0，则为所有		
	 * @param unknown_type $order_type				排序类型 1: posid
	 * 													    2: 排序位
	 * @param unknown_type $order_asc				排序是升序还是降序(默认DESC)
	 * @param unknown_type $page					当前页
	 * @param unknown_type $page_per_page			每页记录数
	 */
	static public function getPositionList($posid,$order_type,$order_asc="desc",$page=1,$page_per_page=20){

		if(!is_numeric($posid) || $posid<0)
			return getR(false,"POSID异常");
		if(!is_numeric($order_type) || $order_type<=0)
			return getR(false,"排序方式异常");
		if(!is_numeric($page) || $page<=0)
			return getR(false,"页码异常");
		if(!is_numeric($page_per_page) || $page_per_page<=0)
			return getR(false,"每页记录数异常");
		switch ($order_type)
		{
			case 1:
				$order_sql = "order by posid $order_asc";
				break;
			case 2:
				$order_sql = "order by listorder $order_asc";
				break;
			default:
				$order_sql = "order by posid $order_asc";
				break;
		}
		$dblink = new DataBase("");
		$posid = ($posid == 0) ? "" : "and posid='$posid'";
		$num_sql = "SELECT count(*) as num FROM pre_community_position WHERE 1=1 $posid ";
		$num_arr = $dblink->getRow($num_sql);
		$num = $num_arr[0][num];
		$sql = "SELECT * FROM pre_community_position WHERE 1=1 $posid $order_sql LIMIT ".($page-1)*$page_per_page.",$page_per_page";
		$dbarr = $dblink->getRow($sql);
		$v[num] = $num;
		$v[arr] = $dbarr;
		return $v;
	}
	
	/**
	 * 添加推荐位和修改推荐
	 * @param unknown_type $posid				推荐位ID 如果为0，则为添加
	 * @param unknown_type $name				推荐位名称
	 * @param unknown_type $max					推荐位保存最大数据数
	 * @param unknown_type $listorder			推荐位排序
	 */
	static public function AddEditPosition($posid,$name,$max,$listorder){
		
		if(!is_numeric($posid) || $posid<0)
			return getR(false,"推荐位ID异常");
		if(!is_numeric($max) || $max<0)
			return getR(false,"最大保存数异常");
		if(!is_numeric($listorder) || $listorder<0)
			return getR(false,"排序号异常");
		$dblink = new DataBase("");
		$max = ($max == 0 ) ? '20':$max;
		$order = ($listorder == 0 ) ? '0':$listorder;
		if ($posid == 0){
			$sql = "INSERT INTO pre_community_position SET NAME='$name',maxnum=$max,listorder='$order'";	
		}else{
			$sql = "UPDATE pre_community_position SET name='$name',maxnum='$max',listorder='$listorder' WHERE posid='$posid'";
		}
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true);		
	}
	
	/**
	 * 删除推荐位，并且把推荐位下的数据也删除
	 * @param unknown_type $posid				推荐位ID
	 * @return unknown_type
	 */
	static public function delPosition($posid){
		if(!is_numeric($posid) || $posid<=0)
			return getR(false,"推荐位ID异常");
		$dblink = new DataBase("");
		$sql = "DELETE FROM pre_community_position WHERE posid='$posid'";
		$dblink->query($sql);
		$sql = "SELECT id FROM pre_community_position_data WHERE posid='$posid'";
		$dbarr = $dblink->getRow($sql);
		for ($i = 0; $i < count($dbarr); $i++) {
			$sql = "DELETE FROM pre_community_position_data WHERE id=".$dbarr[$i][id];
			$dblink->query($sql);
		}
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 删除推荐位下信息
	 * @param unknown_type $id
	 * @return unknown_type
	 */
	static public function delPositionData($id){
		if(!is_numeric($id) || $id<=0)
			return getR(false,"ID异常");
		$dblink = new DataBase("");
		$sql = "DELETE FROM pre_community_position_data WHERE id=$id";
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 根据推荐位ID获取推荐位下的数据
	 * @param unknown_type $posid					推荐位ID
	 * @param unknown_type $order_type				排序类型 1：id
	 * 														2：listorder
	 * @param unknown_type $order_asc				排序是升序还是降序(默认DESC)
	 * @param unknown_type $page
	 * @param unknown_type $page_per_page
	 * @return unknown_type|unknown
	 */
	static public function getPositionDataList($posid,$order_type,$order_asc="desc",$page=1,$page_per_page=20){
		if(!is_numeric($posid) || $posid<=0)
			return getR(false,"推荐位ID异常");
		switch ($order_type)
		{
			case 1:
				$order_sql = "order by id $order_asc";
				break;
			case 2:
				$order_sql = "order by listorder $order_asc";
				break;
			default:
				$order_sql = "order by listorder $order_asc";
				break;
		}
		$dblink = new DataBase("");
		$num_sql = "SELECT count(*) as num FROM pre_community_position_data WHERE posid=$posid";
		$num_arr = $dblink->getRow($num_sql);
		$num = $num_arr[0][num];
		
		$sql = "SELECT * FROM pre_community_position_data WHERE posid=$posid $order_sql LIMIT ".($page-1)*$page_per_page.",$page_per_page";
		$dbarr = $dblink->getRow($sql);
		$v[num] = $num;
		$v[arr] = $dbarr;
		return $v;
	}
	

	/**
	 * 获取可以选取的推荐 (暂时只获取： 专辑、类别、标签)
	 * @param unknown_type $list				获取类型		1:分类
	 * 														2:标签
	 * 														3:专辑
	 * @param unknown_type $page							
	 * @param unknown_type $page_per_page
	 * @return unknown_type|unknown
	 */
	static public function getPositionGatherInfo($list=1){
		if(!is_numeric($list) || $list<=0)
			return getR(false,"类型异常");
//		if(!is_numeric($page) || $page<=0)
//			return getR(false,"页码异常");
//		if(!is_numeric($page_per_page) || $page_per_page<=0)
//			return getR(false,"每页记录数异常");	
		
		$dblink = new DataBase("");
		$arr = array();
		if ($list == 1) {
			$sql = "SELECT id,name FROM pre_community_class";
			$class_arr = $dblink->getRow($sql);
			for ($j = 0; $j < count($class_arr); $j++) {
				$arr[$j][id] = $class_arr[$j][id];
				$arr[$j][name] = $class_arr[$j][name];
				$arr[$j][url] = "/index.php?m=community&c=index&a=lists&classid=".$class_arr[$j][id];
			}
		}elseif ($list == 2){
			$sql = "SELECT id,tag_name AS name FROM pre_community_file_tag";
			$tag_arr = $dblink->getRow($sql);
			for ($j2 = 0; $j2 < count($tag_arr); $j2++) {
				$arr[$j2][id] = $tag_arr[$j2][id];
				$arr[$j2][name] = $tag_arr[$j2][name];
				$arr[$j2][url] = "/index.php?m=community&c=index&a=tag_lists&tag_id=".$tag_arr[$j2][id];
			}
		}elseif ($list == 3){
			$sql = "SELECT id,album_name AS name FROM pre_community_album";
			$album_arr = $dblink->getRow($sql);
			for ($i = 0; $i < count($album_arr); $i++) {
				$arr[$i][id] = $album_arr[$i][id];
				$arr[$i][name] = $album_arr[$i][name];
				$arr[$i][url] = "/index.php?m=community&c=index&a=myshow_show_album&album_id=".$album_arr[$i][id];
			}
		}
		return $arr;
		
//		//合并成一个数组
//		$is_album_arr = implode(',',$album_arr);
//		$is_class_arr = implode(',',$class_arr);
//		$is_tags_arr = implode(',',$tag_arr);
//		
//		if (empty($is_album_arr)){
//			$v[album] = array();	
//		}
//		if (empty($is_class_arr)){
//			$v[arr] = array();	
//		}
//		if (empty($is_tags_arr)){
//			$v[tag] = array();	
//		}
//		$v[album] = $album_arr;
//		$v[arr] = $class_arr;
//		$v[tag] = $tag_arr;
//		
//		$cards = array_merge($v[album], $v[arr], $v[tag]);
//		return $cards;
		
	}
	
	/**
	 *分类排序
	 */
	static public function Add_Class_Listorder($arr = array()){
		$dblink = new DataBase("");
		foreach ($arr as $k=>$v){
			$sql = "UPDATE pre_community_class SET `order`='$v' WHERE id='$k' ";
			$dblink->query($sql);
		}
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 *分类下标签排序
	 */
	static public function Add_Class_Tag_Listorder($arr = array(),$classid){
		$dblink = new DataBase("");
		foreach ($arr as $k=>$v){
			$sql = "UPDATE pre_community_class_tag_map SET `listorder`='$v' WHERE tagid='$k' and classid='$classid'";
//			echo $sql;
			$dblink->query($sql);
		}
		$dblink->dbclose();
		return getR(true);
	}
	
	
	/**
	 * 给推荐排序
	 * @param unknown_type $arr				排序数组
	 */
	static public function Add_Pos_Listorder($arr = array()){
		$dblink = new DataBase("");
		foreach ($arr as $k=>$v){
			$sql = "UPDATE pre_community_position_data SET listorder='$v' WHERE id='$k' ";
			$dblink->query($sql);
		}
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 推荐位选取的信息添加
	 * @param unknown_type $arr					数组
	 * @param unknown_type $posid				推荐位ID
	 * @param unknown_type $classid				类型ID
	 * @return unknown_type
	 */
	static public function Add_pos_data_news($arr = array(),$posid,$classid){
		$dblink = new DataBase("");
		for ($i = 0; $i < count($arr); $i++) {
			$sql = "INSERT INTO pre_community_position_data SET posid='$posid',classid='".$arr[$i]['classid']."',name='".$arr[$i]['name']."',url='".$arr[$i]['url']."'";
			$dblink->query($sql);
		}
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 创建举报
	 * @param unknown_type  $uid		      被举报用户uid	
	 * @param unknown_type  $report_type      举报类型：1.举报用户 2.举报分享 3.举报评论 4.举报私信
	 * @param unknown_type  $report_content   举报内容（分享内容/评论/私信内容）
	 * @param unknown_type  $report_uid       举报人uid				
	 * @param unknown_type  $report_reason	  举报理由
	 * @param unknown_type  $reply_type 	  如果是举报评论 0.非举报评论1.专辑评论 2.分享评论
	 * @param unknown_type  $url 	  		  举报URL
	 * @return unknown_type
	 */
	static public function CreateReport($uid,$report_type,$report_content,$report_uid,$report_reason,$reply_type="0",$url="")
	{
		if(!is_numeric($uid) || $uid<0)
			return getR(false,"被举报用户ID异常");
		if(!is_numeric($report_uid) || $uid<0)
			return getR(false,"举报用户ID异常");
			$dblink = new DataBase("");
			
			$user_info = UserApi::getUserName($uid);
			$nickname = $user_info[0][nickname];//获取被举报人昵称
			$report_user_info = UserApi::getUserName($report_uid);
			$report_nickname = $report_user_info[0][nickname];//获取举报人昵称
			if ($report_reason == "")
			{
				echo "请填写举报理由";die();
			}
			
			if ($report_uid == "") {
				echo "请登录再进行操作";
				header();die();//跳转到登录页面
			}
			$sql = "INSERT INTO pre_community_report (uid,nickname,report_type,report_content,report_uid,report_name,report_reason,reply_type,url)
VALUES ('$uid','$nickname','$report_type','$report_content','$report_uid','$report_nickname','$report_reason','$reply_type','$url')";
			$dblink->query($sql);
			$dblink->dbclose();
			return getR(true);
	}
	
	/**
	 * 举报列表
	 * @param unknown_type $order_asc				排序是升序还是降序(默认DESC)
	 * @param unknown_type $page					当前页
	 * @param unknown_type $page_per_page			每页记录数
	 */
	static public function getReportList($order_asc="desc",$page=1,$page_per_page=10){

		if(!is_numeric($page) || $page<=0)
			return getR(false,"页码异常");
		if(!is_numeric($page_per_page) || $page_per_page<=0)
			return getR(false,"每页记录数异常");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_report ORDER BY id $order_asc LIMIT ".($page-1)*$page_per_page.",$page_per_page";
		$dbarr = $dblink->getRow($sql);
		return $dbarr;
		
	}
	
	
	/**
	 * 获取推荐用户列表
	 */
	static public function getRecommendedUsers(){
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_user_stat WHERE is_recommend=1";
		$dbarr = $dblink->getRow($sql);
		for ($i = 0; $i < count($dbarr); $i++) {
			$user_r = UserApi::getUserName($dbarr[$i]["uid"]);
			for ($j2 = 0; $j2 < count($user_r); $j2++) {
				$dbarr[$i]["nickname"] = $user_r[$j2]['nickname'];
				$dbarr[$i]["head_img_url"] = $user_r[$j2]['head_img_url'];
			}
			//$dbarr[$i]["head_img_url"] = getLiveHead($dbarr[$i]["uid"],"small");
			
			$r = Community::getUserShare($dbarr[$i]["uid"]);
			for ($j = 0; $j < count($r); $j++) {
				$dbarr[$i][thumb][$j] = $r[$j]['thumb']; 
			}
		}
		return $dbarr;
	}
	
	
	/**
	 * 获取默认专辑
	 * @return unknown
	 */
	static public function getDefaultAlbum(){
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_album WHERE stat=1";
		$arr = $dblink->getRow($sql);
		return $arr;
	}
	
	
	/**
	 * 根据专辑ID获取专辑名称
	 * @return unknown
	 */
	static public function getAlbumName($albumid){
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_album WHERE id='$albumid'";
		$arr = $dblink->getRow($sql);
		return $arr;
	}
	
	
	/**
	 * 首次登录，创建专辑
	 * @param unknown_type $arr						数组：专辑名称
	 * @param unknown_type $uid						用户UID
	 * @param unknown_type $username				用户姓名
	 */
	static public function UserCreateAlbum($arr = array(),$uid,$username){
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"UID异常");
		$dblink = new DataBase("");
		//得到默认类别
		$sql = "SELECT id FROM pre_community_class WHERE `default`=1";
		$r = $dblink->getRow($sql);
		$class_id =  $r[0][id];
		for ($i = 0; $i < count($arr); $i++) {
			$sql = "INSERT INTO pre_community_album (uid,nickname,album_name,class_id) 
			VALUES ('$uid','$username','$arr[$i]','$class_id')";
			$dblink->query($sql);
			$id = $dblink->get_id();
			$sql = "UPDATE pre_community_class SET album_count=album_count+1 WHERE id='$class_id'";
			$dblink->query($sql);
			
			$tmp_arr = $dblink->getRow("select uid from pre_community_user_stat where uid='$uid' limit 0,1");
			if(count($tmp_arr)==0) {
				$sql = "insert INTO pre_community_user_stat SET album_count=1 ,uid='$uid'";
			}else {
				$sql = "update pre_community_user_stat set album_count=album_count+1 where uid='$uid'";
			}
			$dblink->query($sql);
		}
		return getR(true,$id);
	}
	
	/**
	 * 获取用户信息和专辑信息
	 * @param unknown_type $albumid			专辑ID 
	 * @param unknown_type $uid				用户UID
	 */
	static public function getUserAlbumInfo($albumid,$uid){
		if(!is_numeric($albumid) || $albumid<=0)
			return getR(false,"专辑ID异常");
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户UID异常");
		$dblink = new DataBase("");
		$dbarr = array();
		
		$count = Community::getUserTotalInfo($uid);
		$dbarr[users] = $count;
		$sql = "SELECT id,uid,nickname,album_name,description FROM pre_community_album WHERE uid=$uid AND id = '$albumid' ORDER BY input_time DESC LIMIT 1";
		$r = $dblink->getRow($sql);
		//分类名
		$class_arr = Community::getAlbumClassId($albumid);
		$dbarr[arr][class_id] = $class_arr["-msg-"][0][id];
		$dbarr[arr][class_name] = $class_arr["-msg-"][0][class_name];
		$dbarr[arr][avatar] = getLiveHead($uid,"small");
		$dbarr[arr][nickname] = $r[0][nickname];
		$dbarr[arr][description] = $r[0][description];
		//所有的专辑
		$r2 = Community::getUserAlbumList($uid,1,1);
		for ($j = 0; $j < count($r2); $j++) {
			$dbarr[datas][$j][album_id] = $r2[$j][id];
			$dbarr[datas][$j][album_name] = $r2[$j][album_name];
			$dbarr[datas][$j][file_count] = $r2[$j][file_count];
		}
		//关注专辑的人
		$sql = "SELECT * FROM pre_community_album_watch_map WHERE album_id='$albumid'";
		$r3 = $dblink->getRow($sql);
		for ($j2 = 0; $j2 < count($r3); $j2++) {
			$dbarr[follow][$j2][uid] = $r3[$j2][uid];
			$dbarr[follow][$j2][avatar2] = getLiveHead($r3[$j2][uid],"small");
		}
//		print_r($dbarr);
		return $dbarr;
		
	}
	
	/**
	 * 获取用户总的信息数据
	 * @param unknown_type $uid
	 */
	static public function getUserTotalInfo($uid){
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户UID异常");
		$dblink = new DataBase("");
//		$sql = "SELECT share_count,album_count FROM pre_community_user_stat WHERE uid=$uid";
//		$num1 = $dblink->getRow($sql);
//		$sql = "SELECT `watch_count` AS followCount,`is_watched_count` AS beFollowCount FROM `pre_weibo_user_stat` WHERE uid='$uid'";
//		$num2 = $dblink->getRow($sql);
//		
//		//合并成一个数组
//		$is_num1_arr = implode(',',$num1);
//		$is_num2_arr = implode(',',$num2);
//		
//		//判断数组是否为空
//		if (empty($is_num1_arr)){
//			$v[num1] = array();	
//		}
//		if (empty($is_num2_arr)){
//			$v[num2] = array();	
//		}
//		$v[num1] = $num1;
//		$v[num2] = $num2;
//		$cards = array_merge($v[num1],$v[num2]);
//		return $cards;
//		$arr = Community::getAllUserInfo(2,$uid);
		$arr = Community::getTotalUserInfo($uid);
		$v = $arr[arr][0];
		return $v;
	}
	
	/**
	 * 只获取用户，专辑数、分享、粉丝、总的数据信息
	 * @param unknown_type $uid
	 * @return unknown_type|unknown
	 */
	static public function getTotalUserInfo($uid){
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户UID异常");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM 
				(SELECT a.uid,m.username,m.nickname,a.share_count AS `share`,a.album_count AS album,
				(SELECT is_watched_count FROM pre_weibo_user_stat e WHERE e.uid=a.uid) AS fans,
				(SELECT watch_count FROM pre_weibo_user_stat f WHERE f.uid=a.uid) AS follow
				FROM pre_community_user_stat a,pre_common_member m WHERE a.uid=m.uid)
				tmp WHERE tmp.uid=$uid ORDER BY tmp.share DESC limit 1";
		$arr = $dblink->getRow($sql);
		for ($i = 0; $i < count($arr); $i++) {
			$arr[$i][fans] = empty($arr[$i][fans]) ? '0':$arr[$i][fans];
			$arr[$i][follow] = empty($arr[$i][follow]) ? '0':$arr[$i][follow];
		}
		$v[arr] = $arr;
		return $v;
	}
	
/**
	 * 只获取用户，专辑数、分享、粉丝、总的数据信息
	 * @param unknown_type $uid
	 * @return unknown_type|unknown
	 */
	static public function getShearTotalUserInfo($uid){
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户UID异常");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM 
				(SELECT a.uid,a.share_count AS `share`,a.album_count AS album,
				(SELECT is_watched_count FROM pre_weibo_user_stat e WHERE e.uid=a.uid) AS fans
				FROM pre_community_user_stat a)
				tmp WHERE tmp.uid=$uid limit 1";
		$arr = $dblink->getRow($sql);
		for ($i = 0; $i < count($arr); $i++) {
			$arr[$i][fans] = empty($arr[$i][fans]) ? '0':$arr[$i][fans];
		}
		$v = $arr[0];
		return $v;
	}
	
	
	/**
	 *根据专辑评论ID获取评论内容
	 * @param unknown_type  $album_id		 专辑ID
	 * @param unknown_type  $reply_id        回复专辑评论ID
	 * @return unknown_type
	 */
	static public function GetAlbumComment($album_id,$reply_id) {
		if(!is_numeric($album_id) || $album_id<0)
			return getR(false,"专辑ID异常");
		if(!is_numeric($reply_id) || $reply_id<0)
			return getR(false,"评论ID异常");
			$dblink = new DataBase("");
			$sql = "select * from pre_community_album_reply where id =$reply_id and album_id=$album_id";
			$reply_content = $dblink->getRow($sql);
			$dblink->dbclose();
			return $reply_content;
	}
	
	
	/**
	 *根据分享评论ID获取评论内容
	 * @param unknown_type  $comment_id		 评论ID
	 * @return unknown_type
	 */
	static public function GetCommentReply($comment_id) {
		
		if(!is_numeric($comment_id) || $comment_id<0)
			return getR(false,"分享评论ID异常");
			$dblink = new DataBase("");
			$sql = "SELECT * FROM pre_community_file_reply WHERE id=$comment_id";
			$comment_content = $dblink->getRow($sql);
			$dblink->dbclose();
			return $comment_content;
	}
	
	/**
	 *获取专辑相关统计信息
	 * @param unknown_type  $album_id		 专辑ID
	 * @return unknown_type
	 */
	static public function GetAlbumCount($album_id,$page=1,$recordperpage=10) {
		
		if(!is_numeric($album_id) || $album_id<0)
			return getR(false,"专辑ID异常");
			$dblink = new DataBase("");
			$sql = "SELECT count(*) as num from pre_community_file where  albumid='$album_id' and file_type=1";
			$content = $dblink->getRow($sql);
			$album_count['pic_count'] = $content[0]['num'];//专辑图片数
			$sql = "SELECT count(*) as num from pre_community_file where  albumid='$album_id' and file_type=2";
			$content = $dblink->getRow($sql);
			$album_count['video_count'] = $content[0]['num'];//视频数
			$sql = "SELECT count(*) as num from pre_community_file where  albumid='$album_id' and file_type=3";
			$content = $dblink->getRow($sql);
			$album_count['goods_count'] = $content[0]['num'];//商品数
			//print_r($album_count);die();
			//专辑所属分类
			$sql= "select a.id,a.class_id,a.stat,b.name,b.default from
					pre_community_album a inner join pre_community_class b 
					on a.class_id = b.id where a.id = '$album_id'";
			$content = $dblink->getRow($sql);
			//print_r($content[0]['name']);die();
			$album_count['class_name'] = $content[0]['name'];
			$dblink->dbclose();
			return $album_count;
	}
	
  
	// 把远程图片保存本地 ,并生成二张缩略图
	// $url 是远程图片的完整URL地址，不能为空。  
	// $filename 是可选变量: 如果为空，本地文件名将基于时间和日期   
	// 自动生成.   
	static function get_photo($url,$filename='',$savefile='myshowpic/') 
	{   
		$imgArr = array('gif','bmp','png','ico','jpg','jepg','*');
	    if(!$url) return false;
	    if(!$filename) {   
	      $ext=strtolower(end(explode('.',$url)));   
	      if(!in_array($ext,$imgArr)) return false;
	      $filename=date("dMYHis").'.'.$ext;   
	    }   
	
		if(!is_dir($savefile)) mkdir($savefile, 0777);
		if(!is_readable($savefile)) chmod($savefile, 0777);
		
		$filename = $savefile.$filename;
	
	    ob_start();   
	    readfile($url);   
	    $img = ob_get_contents();   
	    ob_end_clean();   
	    $size = strlen($img);   
	  
	    $fp2=@fopen($filename, "a");   
	    fwrite($fp2,$img);   
	    fclose($fp2);
		$v[pic] = $filename;
		$v[thumb] = CommunityImg($filename,"208**",100,0,'big',true);//	MiniImg($filename,"208**",72,0,true);
		$v[small] = CommunityImg($filename,"165*165",100,1,'small',true);
		return $v;
//	    return $filename;   
	 }   
	 
	/**
	 * 获取社区全部用户的信息(只获取已经开通社区的用户)
	 * @param unknown_type $page				
	 * @param unknown_type $recordperpage		
	 */
	static function getAllUserInfo($lists,$keyword,$page=1,$record_per_page=20,$recommend=""){
		if(!is_numeric($page) || $page<=0)
			return getR(false,"页码异常");
		if(!is_numeric($record_per_page) || $record_per_page<=0)
			return getR(false,"每页记录数异常");
		$dblink = new DataBase("");
		$where = "";
		if ($lists == 1){
			$where = "AND tmp.username like '%$keyword%'";
		}elseif ($lists == 2) {
			$where = "AND tmp.uid = $keyword";
		}elseif ($lists == 3) {
			$where = "AND tmp.email like '%$keyword%'";
		}elseif ($lists == 4) {
			$where = "AND tmp.nickname like '%$keyword%'";
		}
		$is_recommend = "";
		if ($recommend){
			$is_recommend = "AND tmp.is_recommend=1";
		}
		$sql = "SELECT count(*) as num FROM 
				(SELECT a.uid,m.username,m.nickname,m.email,a.share_count AS `share`,a.album_count AS album,a.is_recommend,
				(SELECT COUNT(file_state) FROM pre_community_file b WHERE b.file_state = 1 AND b.uid=a.uid) AS sc,
				(SELECT COUNT(file_state) FROM pre_community_file c WHERE c.file_state = 2 AND c.uid=a.uid) AS cj,
				(SELECT COUNT(file_state) FROM pre_community_file d WHERE d.file_state = 3 AND d.uid=a.uid) AS zc,
				(SELECT is_watched_count FROM pre_weibo_user_stat e WHERE e.uid=a.uid) AS fans,
				(SELECT watch_count FROM pre_weibo_user_stat f WHERE f.uid=a.uid) AS follow
				FROM pre_community_user_stat a,pre_common_member m WHERE a.uid=m.uid)
				tmp WHERE 1=1 $where $is_recommend ORDER BY tmp.share DESC";
		$num_arr = $dblink->getRow($sql);
		$num = $num_arr[0][num];
		$sql = "SELECT * FROM 
				(SELECT a.uid,m.username,m.nickname,m.email,a.share_count AS `share`,a.album_count AS album,a.is_recommend,
				(SELECT COUNT(file_state) FROM pre_community_file b WHERE b.file_state = 1 AND b.uid=a.uid) AS sc,
				(SELECT COUNT(file_state) FROM pre_community_file c WHERE c.file_state = 2 AND c.uid=a.uid) AS cj,
				(SELECT COUNT(file_state) FROM pre_community_file d WHERE d.file_state = 3 AND d.uid=a.uid) AS zc,
				(SELECT is_watched_count FROM pre_weibo_user_stat e WHERE e.uid=a.uid) AS fans,
				(SELECT watch_count FROM pre_weibo_user_stat f WHERE f.uid=a.uid) AS follow
				FROM pre_community_user_stat a,pre_common_member m WHERE a.uid=m.uid)
				tmp WHERE 1=1 $where $is_recommend ORDER BY tmp.share DESC limit ".($page-1)*$record_per_page.",".$record_per_page;
		$arr = $dblink->getRow($sql);
		for ($i = 0; $i < count($arr); $i++) {
			$arr[$i][fans] = empty($arr[$i][fans]) ? '0':$arr[$i][fans];
			$arr[$i][follow] = empty($arr[$i][follow]) ? '0':$arr[$i][follow];
		}
		$v[num] = $num;
		$v[arr] = $arr;
		return $v;
	}
	
	/**
	 * 取消或者推荐会员
	 * @param unknown_type $lists			类型
	 * @param unknown_type $uid				uid
	 * @return unknown_type
	 */
	static function UserRecommend($lists,$uid){
		if(!is_numeric($lists) || $lists<=0)
			return getR(false,"类型list异常");
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"UID异常");
		$dblink = new DataBase("");
		if ($lists == 1) {
			$sql = "UPDATE pre_community_user_stat SET is_recommend=0 WHERE uid=$uid";
		}else{
			$sql = "UPDATE pre_community_user_stat SET is_recommend=1 WHERE uid=$uid";
		}
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true);
	}
	
	/**
	 * 取消或者推荐专辑
	 * @param unknown_type $lists			类型
	 * @param unknown_type $id				id
	 * @return unknown_type
	 */
	static function AlbumRecommend($lists,$id){
		if(!is_numeric($lists) || $lists<=0)
			return getR(false,"类型list异常");
		if(!is_numeric($id) || $id<=0)
			return getR(false,"ID异常");
		$dblink = new DataBase("");
		if ($lists == 1) {
			$sql = "UPDATE pre_community_album SET recommend =0 where id=$id";
		}else{
			$sql = "UPDATE pre_community_album SET recommend =1 where id=$id";
		}
		$dblink->query($sql);
		$dblink->dbclose();
		return getR(true);
	}
	
	
	
	/**
	 * 取消或者推荐分享
	 * @param unknown_type $file_recommend			分享推荐信息
	 * @param unknown_type $id						分享id
	 * @return unknown_type
	 */
	static function FileRecommend($file_recommend,$id){
		/*if(!is_numeric($file_recommend) || $file_recommend<0)
			return getR(false,"分享类型异常");
		if(!is_numeric($id) || $id<=0)
			return getR(false,"ID异常");*/
		$dblink = new DataBase("");
		$r  = Community::getShareInfo($id);
		$album_arr = $r["-msg-"];
		//print_r($album_arr);die();
		if (($album_arr[0]['status']!=99) && ($file_recommend == 0)){
			$sql = "UPDATE pre_community_file SET status=99,file_recommend=1 WHERE id='$id'";
					$dblink->query($sql);
					//增加专辑下的共享数
					$sql = "UPDATE pre_community_album SET file_count=file_count+1
						WHERE id=".$album_arr[0][albumid];
					$dblink->query($sql);
					//更新用户分享数
					$sql = "SELECT uid FROM pre_community_user_stat WHERE uid=".$album_arr[0][uid];
					$tmp_arr = $dblink->getRow($sql);
					if(count($tmp_arr)>0){
						$dblink->query("UPDATE pre_community_user_stat SET share_count=share_count+1 WHERE uid=".$album_arr[0][uid]);
					}else{
						$dblink->query("INSERT INTO pre_community_user_stat SET share_count=1,uid=".$album_arr[0][uid]);
					}
			
		}else{
				$sql = "UPDATE pre_community_file SET file_recommend =0 where id=$id";//通过审核的只更新推荐字段
				$dblink->query($sql);
			}
		
		$dblink->dbclose();
		return getR(true);
	}
	
	
	
	/**
	 * 分享置顶操作
	 * @param unknown_type $top_type			分享置顶类型
	 * @param unknown_type $id					分享id
	 * @param unknown_type $end_time			分享置顶有效期
	 * @return unknown_type
	 */
	/*static function topshare($id,$top_type,$end_time){
		/*if(!is_numeric($file_recommend) || $file_recommend<0)
			return getR(false,"分享类型异常");
		if(!is_numeric($id) || $id<=0)
			return getR(false,"ID异常");
		if(!is_numeric($top_type) || $top_type<0)
			return getR(false,"置顶类型异常");
		$dblink = new DataBase("");
		$r  = Community::getShareInfo($id);
		$album_arr = $r["-msg-"];
		if (($top_type != 0) && ($end_time!="")) {
			$sql = "UPDATE pre_community_file SET top=$top_type,top_time='$end_time' where id=$id";//更新置顶操作
			$dblink->query($sql);
		}
		
		$dblink->dbclose();
		return getR(true);
	}*/
	
	/**
	 * 取消全部推荐会员
	 * @param unknown_type $arr
	 */
	static function CanceledAllRecommendUser($arr = array()){
		$dblink = new DataBase("");
		for ($i = 0; $i < count($arr); $i++) {
			$sql = "UPDATE pre_community_user_stat SET is_recommend=0 WHERE uid=".$arr[$i];
			$dblink->query($sql);	
		}
		
	}
	
	
	/**
	 * 获取私信列表
	 * @param unknown_type $keyword				关键字
	 * @param unknown_type $start_time			开始时间
	 * @param unknown_type $end_time			结束时间
	 * @param unknown_type $page				
	 * @param unknown_type $recordPayPage
	 * @return unknown_type|unknown
	 */
	static function getAllUserPrivateMail($keyword,$start_time,$end_time,$page=1,$recordPayPage=20){
		if(!is_numeric($page) || $page<=0)
			return getR(false,"页码异常");
		if(!is_numeric($recordPayPage) || $recordPayPage<=0)
			return getR(false,"每页记录数异常");
		$dblink = new DataBase("");
		$where = "";
		if (isset($keyword) && !empty($keyword)) {
			$where .= " AND msg like '%$keyword%'";
		}
		if (isset($start_time) && !empty($start_time)) {
			$where .= " AND append_time >= '$start_time'";
		}
		if (isset($end_time) && !empty($end_time)) {
			$where .= " AND append_time <= '$end_time'";
		}
		$sql = "SELECT count(*) as num FROM pre_weibo_private_msg WHERE 1=1 $where ORDER BY append_time DESC";
		$num_arr = $dblink->getRow($sql);
		$num = $num_arr[0][num];
		
		$sql = "SELECT * FROM pre_weibo_private_msg WHERE 1=1 $where ORDER BY append_time DESC LIMIT ".($page-1).",".$recordPayPage;
		$arr = $dblink->getRow($sql);
		for ($i = 0; $i < count($arr); $i++) {
			$src_name = UserApi::getUserName($arr[$i][src_uid]);
			$dst_name = UserApi::getUserName($arr[$i][dst_uid]);
			$arr[$i][src_name] = $src_name[0][nickname];
			$arr[$i][dst_name] = $dst_name[0][nickname];
		}
		$v[num] = $num;
		$v[arr] = $arr;
		return $v;
	}
	
	/**
	 * 删除用户私信
	 * @param unknown_type $arr
	 */
	static function delUserMsg($arr = array()){
	$dblink = new DataBase("");
		for ($i = 0; $i < count($arr); $i++) {
			$sql = "DELETE FROM pre_weibo_private_msg WHERE id=".$arr[$i];
			$dblink->query($sql);	
		}
	}
	
	
	
	/*
	 *判断是否是违禁词
	 *@param unknown_type $content 用户填写内容
	 */
	static public function Getcensor($content)
	{
		$dblink = new DataBase("");
		$sql = "SELECT id,admin,find,replacement,extra FROM pre_common_word where find like '$content'";
		$textcontent = $dblink->getRow($sql);
		if($textcontent !="") {
			$iscensor = 0;//0为内容是违禁词
		}else {
			$iscensor = 1;
		}
		
		return $iscensor;
	}
	
	/**
	 * 获取分享的上一个和下一个分享
	 * @param unknown_type $share_id			分享ID
	 * @param unknown_type $list				类型：	1为上一个
	 * 												  	2为下一个
	 */
	static public function GetPreviousNext($share_id,$list=1){
		if(!is_numeric($share_id) || $share_id<=0)
			return getR(false,"分享ID异常");
		if(!is_numeric($list) || $list<=0)
			return getR(false,"类型list异常");
		$dblink = new DataBase("");
		if ($list==1){
			$sql = "SELECT id FROM pre_community_file WHERE id<$share_id AND status=99 ORDER BY id DESC LIMIT 1";
		}else{
			$sql = "SELECT id FROM pre_community_file WHERE id>$share_id AND status=99 ORDER BY id ASC LIMIT 1";
		}
		$arr = $dblink->getRow($sql);
		return $arr;
	}
	
	
		/**
	 * 获取某个专辑分享的上一个和下一个分享
	 * @param unknown_type $share_id			分享ID
	 * @param unknown_type $list				类型：	1为上一个
	 * 												  	2为下一个
	 */
	static public function GetAlbumPreviousNext($share_id,$list=1){
		if(!is_numeric($share_id) || $share_id<=0)
			return getR(false,"分享ID异常");
		if(!is_numeric($list) || $list<=0)
			return getR(false,"类型list异常");
		$dblink = new DataBase("");
		$sql = "SELECT albumid FROM pre_community_file WHERE id=$share_id";
		$tmp = $dblink->getRow($sql);
		$albumid = $tmp[0]['albumid'];
		if ($list==1){
			$sql = "SELECT id FROM pre_community_file WHERE id<$share_id AND status=99 AND albumid=$albumid ORDER BY input_time DESC LIMIT 1";
		}else{
			$sql = "SELECT id FROM pre_community_file WHERE id>$share_id AND status=99 AND albumid=$albumid ORDER BY input_time  ASC LIMIT 1";
		}
		$arr = $dblink->getRow($sql);
		return $arr;
	}
	
	/**
	 * 用户是否关注了此用户
	 */
	static public function getUserIsFollow($uid,$dst_uid){
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"UID异常");
		if(!is_numeric($dst_uid) || $dst_uid<=0)
			return getR(false,"目标UID异常");
		$dblink = new DataBase("");
		$sql = "select * from pre_weibo_follow where src_uid='$uid' and dst_uid=".$dst_uid;
		$is_attention = $dblink->getRow($sql);
		//判断是否已经关注,1为已经关注
		if (count($is_attention)>0) {
			$arr = 1;
		}else {
			$arr = 0;
		}
		return $arr;
	}
	
	/**
	 * 火秀、社区修改昵称。如还有表要修改，则添加表，相对应DZ函数updateNickName也要修改
	 * @param unknown_type $uid				用户ID
	 * @param unknown_type $nickname		用户昵称
	 * @return unknown_type
	 */
	static public function UpdateUserAllNickName($uid,$nickname){
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户UID异常");
		if(isset($nickname) && empty($nickname))
			return getR(false,"用户昵称异常");
		$dblink = new DataBase("");
		$sql = "update pre_common_member SET nickname = '$nickname' WHERE uid = $uid";
		$dblink->query($sql);
		$sql = "update pre_ucenter_members SET nickname = '$nickname' WHERE uid = $uid";
		$dblink->query($sql);
		$sql = "update pre_weibo_msg SET nicename = '$nickname' WHERE uid = $uid";
		$dblink->query($sql);
		$sql = "update `huoshow_bbs_x2`.pre_common_member SET nickname = '$nickname' WHERE uid = $uid";
		$dblink->query($sql);
		//分享
		$sql = "UPDATE pre_community_file SET nickname ='$nickname' WHERE uid=$uid";
		$dblink->query($sql);
		//专辑
		$sql = "UPDATE pre_community_album SET nickname = '$nickname' WHERE uid=$uid";
		$dblink->query($sql);
		//专辑评论
		$sql = "UPDATE pre_community_album_reply SET nickname='$nickname' WHERE uid=$uid";
		$dblink->query($sql);
		//分享评论
		$sql = "UPDATE pre_community_file_reply SET nickname='$nickname' WHERE uid=$uid";
		$dblink->query($sql);
		//举报
		$sql = "UPDATE pre_community_report SET nickname='$nickname' WHERE uid=$uid";
		$dblink->query($sql);
	}
	/**
	 * 专辑归属用户判断
	 * @param unknown_type $uid 用户ID
	 * @param unknown_type $album_id 专辑ID
	 */
	static public function GetAlbumUid($uid,$album_id){
		if(!is_numeric($album_id) || $album_id<=0)
			return getR(false,"专辑ID异常");
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户ID异常");
		$dblink = new DataBase("");
		$sql = "select uid from pre_community_album where id=$album_id";
		$getuid = $dblink->getRow($sql);
		if ($uid == $getuid[0]['uid']) {
			$isalbum = 1;//属于用户自己的专辑
		}else {
			$isalbum = 0;
		}
		return $isalbum;
	}
	
	/**
	 * 获取分享广场数据
	 */
	static public function getShareSquare(){
		$dblink = new DataBase("");
		$dbarr = array();
		//获取所有分类
		$class_arr = Community::getClassList2(1,100);
		$dbarr = $class_arr["-msg-"]["arr"];
		for ($i = 0; $i < count($dbarr); $i++) {
			$album_arr = Community::getAlbumList($dbarr[$i][id],0,4,1,1);
			$album_data = $album_arr["-msg-"]["arr"];
			$dbarr[$i][count] = $album_arr["-msg-"]["count"];
			for ($j = 0; $j < count($album_data); $j++) {
				$img_arr = Community::getShareListFromAlbumPic($album_data[$j][id],1,"desc",1,3);
				$dbarr[$i][share_num] = $img_arr["-msg-"]["num"];
				$img_data = $img_arr["-msg-"]["arr"];
				for ($j2 = 0; $j2 < count($img_data); $j2++) {
					$dbarr[$i][share_arr][id][] = $img_data[$j2][id];
					$dbarr[$i][share_arr][img][] = $img_data[$j2][small];
				}
			}
			$share_arr = Community::getClassRecentShareUser($dbarr[$i][id],1,5);
			$share_data = $share_arr["-msg-"];
			for ($k = 0; $k < count($share_data); $k++) {
				$dbarr[$i][user_arr][uid][] = $share_data[$k][uid];
				$dbarr[$i][user_arr][avatar][] = $share_data[$k][user_avatar];
			}
			$active_arr = Community::getClassActiveUser($dbarr[$i][id],1,3);
			$active_data = $active_arr["-msg-"];
			for ($k2 = 0; $k2 < count($active_data); $k2++) {
				$dbarr[$i][active_arr][uid][] = $active_data[$k2][uid];
				$dbarr[$i][active_arr][avatar][] = $active_data[$k2][user_avatar];
			}
			
		}
		return $dbarr;
//		print_r($dbarr);
	}
	
	
	/**
	 * 获取myshow用户基本资料
	 */
	static public function GetMyShowInof($uid){
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户ID异常");
		$dblink = new DataBase("");
		//查找用户邮箱，昵称，签名，所在城市，个人主页
		$sql = "SELECT a.uid,a.email,a.username,a.nickname,b.sightml,c.resideprovince,c.residecity,c.site,c.bio FROM pre_common_member  a
				INNER JOIN pre_common_member_field_forum b ON a.uid=b.uid
				INNER JOIN pre_common_member_profile c ON a.uid=c.uid
				WHERE a.uid=$uid";
		$userinof=$dblink->getRow($sql);
		return $userinof;
	}
	
	
	/**
	 * 达人分享列表
	 */
	static public function getTalentShareList(){
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_community_user_stat WHERE share_count>0 ORDER BY share_count DESC LIMIT 10";
		$dbarr = $dblink->getRow($sql);
		for ($i = 0; $i < count($dbarr); $i++) {
			$dbarr[$i][avatar] =getLiveHead($dbarr[$i]["uid"],"small");
			$user_arr = Community::getTotalUserInfo($dbarr[$i][uid]);
			$user_data = $user_arr["arr"];
			$dbarr[$i][info] = $user_data;
			$share_arr = Community::getUserShare($dbarr[$i][uid],10);
			for ($j = 0; $j < count($share_arr); $j++) {
				$dbarr[$i][arr][id][] = $share_arr[$j][id];
				$dbarr[$i][arr][img][] = $share_arr[$j][small];	
			}
			
		}
		return $dbarr;
	}
	
	/**
	 * 达人粉丝列表
	 */
	static public function getTalentFansList(){
		$dblink = new DataBase("");
		$sql = "SELECT b.uid,a.is_watched_count FROM pre_weibo_user_stat a INNER JOIN 
			pre_community_user_stat b ON a.uid=b.uid
			WHERE a.is_watched_count>0 ORDER BY a.is_watched_count DESC LIMIT 10";
		$dbarr = $dblink->getRow($sql);
		for ($i = 0; $i < count($dbarr); $i++) {
			$dbarr[$i][avatar] =getLiveHead($dbarr[$i]["uid"],"small");
			$user_arr = Community::getTotalUserInfo($dbarr[$i][uid]);
			$user_data = $user_arr["arr"];
			$dbarr[$i][info] = $user_data;
			$share_arr = Community::getUserShare($dbarr[$i][uid],10);
			for ($j = 0; $j < count($share_arr); $j++) {
				$dbarr[$i][arr][id][] = $share_arr[$j][id];
				$dbarr[$i][arr][img][] = $share_arr[$j][small];	
			}
			
		}
//		print_r($dbarr);
		return $dbarr;
	}
	
	/**
	 * 达人排行榜
	 * @param unknown_type $type			类型		1:分享排行
	 * 												2:粉丝排行
	 */
	static public function getTalentList($type=1){
		$dblink = new DataBase("");
		if ($type==1){
			$dbarr = Community::getTalentShareList();
		}else {
			$dbarr = Community::getTalentFansList();
		}
		return $dbarr;
	}
	
	/**
	 * 搜索
	 * @param unknown_type $list
	 * @param unknown_type $keyword
	 * @param unknown_type $page
	 * @param unknown_type $page_per_page
	 * @return unknown
	 */
	static public function getSearchList($list,$keyword,$page=1,$page_per_page=20){
		$dblink = new DataBase("");
		if ($list==1){
			$sql = "SELECT * FROM pre_community_file WHERE status=99 AND description LIKE '%$keyword%' 
			ORDER BY input_time DESC LIMIT ".($page-1)*$page_per_page.",$page_per_page";
			$dbarr = $dblink->getRow($sql);
			for ($i = 0; $i < count($dbarr); $i++) {
				$album_name = Community::getAlbumInfo($dbarr[$i]["albumid"]);
				$dbarr[$i][album_name] = $album_name["-msg-"][arr][0][album_name];
				$dbarr[$i][avatar] = getLiveHead($dbarr[$i]["uid"],"small");
				$dbarr[$i][tag_name] = Community::getShareTagName($dbarr[$i]["id"]);
				$dbarr[$i][user_arr] = Community::getUserTotalInfo($dbarr[$i]["uid"]);
			}	
		}elseif ($list==2){
			$sql = "SELECT * FROM pre_community_album WHERE album_name LIKE '%$keyword%' 
			ORDER BY file_count DESC LIMIT ".($page-1)*$page_per_page.",$page_per_page";
			$dbarr = $dblink->getRow($sql);
			for ($i=0;$i<count($dbarr);$i++){
				$dbarr[$i][avatar] = getLiveHead($dbarr[$i]["uid"],"small");
//				$r = Community::getShareListFromAlbumPic($dbarr[$i][id],3,'',1,9);
//				$r_arr = $r["-msg-"][arr];
//				for ($j = 0; $j < count($r_arr); $j++) {
//					$dbarr[$i][thumb][] = $r_arr[$j][small];
//				}
				if ($dbarr[$i][front_cover]==2){//如果设置了封面，则取封面
					$c = Community::getCoverList($dbarr[$i][id],$dbarr[$i][uid]);
					$c_arr = $c["-msg-"];
					$dbarr[$i][img] = $c_arr[0]['small'];
				}elseif ($dbarr[$i][front_cover]==1){//取九宫格
					$r = Community::getShareListFromAlbumPic($dbarr[$i][id],3,"desc",1,9);
					$arr = $r["-msg-"]["arr"];
					for($j=0;$j<count($arr);$j++){
						$dbarr[$i][img][] = $arr[$j]['small'];
					}
				}else {
					$r = Community::getShareListFromAlbumPic($dbarr[$i][id],3,"ASC",1,1);
					$arr = $r["-msg-"]["arr"];
					$dbarr[$i][img] = $arr[0]['small'];
				}
			}
		}elseif ($list ==3){
			$sql = "SELECT a.uid,c.username,c.nickname FROM pre_community_user_stat a
			INNER JOIN pre_community_user_stat b ON a.uid=b.uid
			INNER JOIN pre_common_member c ON b.uid=c.uid WHERE c.username LIKE '%$keyword%' 
			ORDER BY b.share_count DESC LIMIT ".($page-1)*$page_per_page.",$page_per_page";
			$dbarr = $dblink->getRow($sql);
			for ($i = 0; $i < count($dbarr); $i++) {
				$dbarr[$i][avatar] = getLiveHead($dbarr[$i]["uid"],"big");
			}
		}
//		print_r($dbarr);
		return $dbarr;
		
	}
	
	/**
	 * 获取搜索关键字总数
	 * @param unknown_type $keyword
	 * @return unknown
	 */
	static public function getSearchToal($keyword){
		$dblink = new DataBase("");
		$dbarr = array();
		$sql = "SELECT COUNT(*) num FROM pre_community_file WHERE status=99 AND description LIKE '%$keyword%'";
		$file_num = $dblink->getRow($sql);
		$sql = "SELECT COUNT(*) num FROM pre_community_album WHERE album_name LIKE '%$keyword%'";
		$album_num = $dblink->getRow($sql);
		$sql = "SELECT COUNT(*) num FROM pre_community_user_stat a
			INNER JOIN pre_community_user_stat b ON a.uid=b.uid
			INNER JOIN pre_common_member c ON b.uid=c.uid WHERE c.username LIKE '%$keyword%'";
		$user_num = $dblink->getRow($sql);
		$dbarr[file_num] = $file_num[0][num];
		$dbarr[album_num] = $album_num[0][num];
		$dbarr[user_num] = $user_num[0][num];
		return $dbarr;
	}
	
	
	/**
	 * 更新myshow用户资料
	 * @param unknown_type $uid			用户UID
	 * @param unknown_type $email		用户邮箱
	 * @param unknown_type $nickname	用户昵称
	 * @param unknown_type $sightml		个人签名
	 * @param unknown_type $residecity	城市
	 * @param unknown_type $site	    个人主页
	 * @return unknown_type
	 */
	static public function UpdateMyshowInfo($uid,$email,$nickname="",$sightml,$residecity,$site){
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户ID异常");
		$dblink = new DataBase("");
		//更新昵称
		if(!empty($nickname)){
			Community::UpdateUserAllNickName($uid,$nickname);
		}
		//更新邮箱
		$sql = "UPDATE pre_common_member SET email='$email' WHERE uid=$uid";
		$dblink->query($sql);
		//更新个人签名
//		$sql = "UPDATE pre_common_member_field_forum SET sightml='$sightml' WHERE uid=$uid";
//		$dblink->query($sql);	
		//更新用户所在城市
		$sql = "UPDATE pre_common_member_profile SET residecity='$residecity',bio='$sightml',site='$site' WHERE uid=$uid";
		$dblink->query($sql);
		//更新个人主页
//		$sql = "UPDATE pre_common_member_profile SET site='$site' WHERE uid=$uid";
//		$dblink->query($sql);	
	}
	
	/**
	 * 获取用户个性签名
	 * @param unknown_type $uid
	 * @return unknown
	 */
	static public function getUserSignature($uid){
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户ID异常");
		$dblink = new DataBase("");
		$sql = "SELECT bio FROM pre_common_member_profile WHERE uid='$uid'";
		$dbarr = $dblink->getRow($sql);
		$dbarr = $dbarr[0][bio];
		return $dbarr;
	}
	
	/**
	 * 用户名是否已注册
	 * @param unknown_type $username
	 */
	static public function IsUserNameExist($username){
		$dblink = new DataBase("");
		$sql = "SELECT username FROM pre_common_member WHERE username='$username'";
		$dbarr = $dblink->getRow($sql);
		if (count($dbarr)>0) {
			$is_user = false;
		}else {
			$is_user = true;
		}
		return $is_user;
	}

	/**
	 * 邮箱是否已注册
	 * @param unknown_type $email
	 * @return boolean
	 */
	static public function IsUserEmailExist($email){
		$dblink = new DataBase("");
		$sql = "SELECT email FROM pre_common_member WHERE email='$email'";
		$dbarr = $dblink->getRow($sql);
		if (count($dbarr)>0) {
			$is_user = false;
		}else {
			$is_user = true;
		}
		return $is_user;
	}
	
	
	/**
	 * 获取用户一条私信的所有相关回复信息
	 * @param unknown_type $msgid		私信ID
	 * @param unknown_type $uid		用户UID
	 */
	static public function getmsgreply($uid,$msgid){
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"UID异常");
		if(!is_numeric($msgid) || $msgid<=0)
			return getR(false,"私信ID异常");
		$dblink = new DataBase("");
		$msginfo = Community::getmsgidcontent($msgid);
		$msgid = $msginfo[0]['root_msg_id'];
		$sql = "SELECT a.id,a.src_uid,a.dst_uid,a.msg,a.reply_msg_id,a.root_msg_id,a.append_time,IF(b.nickname='',b.username,b.nickname)
		 AS src_nickname FROM pre_weibo_private_msg a
		 INNER JOIN pre_common_member b ON a.src_uid = b.uid
				WHERE root_msg_id='$msgid' AND reply_msg_id !=0
				order by a.append_time asc
		 ";
		$msgallreply = $dblink->getRow($sql);
		for($i=0;$i<count($msgallreply);$i++)
		{	
			//判断是否我回复他的私信
			if($msgallreply[$i][src_uid] ==$uid){
				$arr[$i]['isself']=true;
			}else{
				$arr[$i]['isself']=false;
			}
			$arr[$i]['id'] = $msgallreply[$i]['id'];
			$arr[$i]['msg'] = urlencode($msgallreply[$i]['msg']);
			$arr[$i]['time'] = $msgallreply[$i]['append_time'];
			$arr[$i]['uid'] = $msgallreply[$i]['src_uid'];
			$arr[$i]['avatar'] = getLiveHead($msgallreply[$i]["src_uid"],"small");//发信用户图像;
			$arr[$i]['name'] = urlencode($msgallreply[$i]['src_nickname']);
			$arr[$i]['url'] = DX_URL.$msgallreply[$i]['src_uid'];
			$arr[$i]['del_url'] = '/index.php?m=community&c=myhuoshow&a=delmymsg&msg_id='.$msgallreply[$i]['id'];
			$arr[$i]['report_url'] = '';
		}
		return $arr;
	}
	
	/**
	 * 获取最新一条私信
	 */
	static public function getnewmsg(){
		$dblink = new DataBase("");
		$sql = "select * from pre_weibo_private_msg order by id desc limit 1";
		$arr=$dblink->getRow($sql);
		return $arr;
	}
	
		/**
	 * 获取最新一条专辑
	 */
	static public function getnewalbumid(){
		$dblink = new DataBase("");
		$sql = "select * from pre_community_album order by id desc limit 1";
		$arr=$dblink->getRow($sql);
		return $arr;
	}
	
	
	/**
	 * 获取最新分享一条评论
	 */
	static public function getnewcomment(){
		$dblink = new DataBase("");
		$sql = "select * from pre_community_file_reply order by id desc limit 1";
		$arr=$dblink->getRow($sql);
		return $arr;
	}
	
	/**
	 * 获取最新专辑一条评论
	 */
	static public function getnewalbumcomment(){
		$dblink = new DataBase("");
		$sql = "select * from pre_community_album_reply order by id desc limit 1";
		$arr=$dblink->getRow($sql);
		return $arr;
	}
	/**
	 * 获得某用户收到的私信,不包含回复
	 * @param unknown_type $uid					用户ID
	 * @param unknown_type $page				当前页
	 * @param unknown_type $recordPayPage		每页记录数
	 * @return unknown_type 失败返回false（checkErr判断）
	 * 						成功返回数组：
	 * 						num：记录总数
	 * 						arr: src_uid：发信人UID
	 * 							 src_nickname：发信人昵称
	 *                           reply_msg_id：回复的哪条消息
	 *                           root_msg_id：根消息（具体看数据库定义）
	 */
	static public function getPrivateMsg($uid,$page=1,$recordPayPage=20)
	{
		if(empty($uid) || !is_numeric($uid))
			return getR(false,"uid异常");
		if(empty($page) || !is_numeric($page))
			return getR(false,"page异常");
		if(empty($recordPayPage) || !is_numeric($recordPayPage))
			return getR(false,"recordPayPage异常");
		$dblink =new DataBase("");
		$count_sql = "select count(*) as num from pre_weibo_private_msg 
					  where dst_uid='$uid' AND reply_msg_id=0";
		$count_arr = $dblink->getRow($count_sql);
		$num = $count_arr[0]["num"];
		
		$sql = "SELECT a.id,a.append_time,a.src_uid,a.dst_uid,a.msg,
					IF(b.nickname='',b.username,b.nickname) AS src_nickname,
					a.reply_msg_id,a.root_msg_id,a.msg_type,a.myshare_id FROM pre_weibo_private_msg a
				INNER JOIN pre_common_member b ON a.src_uid = b.uid
				WHERE a.dst_uid='$uid' 
				order by a.append_time desc
				limit ".($page-1)*$recordPayPage.",$recordPayPage";
		$dbarr = $dblink->getRow($sql);
		$count = count($dbarr);
		for($i=0;$i<$count;$i++)
		{
			$dbarr[$i]["head_img_url"] = getLiveHead($dbarr[$i]["src_uid"],"small");
		}
		$dblink->dbclose();
		$returnV["num"] = $num;
		$returnV["arr"] = $dbarr;
		return $returnV;
	}
	
	/**
	 * 我的通知
	 */
	static public function getnotification($uid){
		if(empty($uid) || !is_numeric($uid))
			return getR(false,"uid异常");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_home_notification WHERE uid=$uid ORDER BY dateline DESC LIMIT 10";
		$arr = $dblink->getRow($sql);
		for ($i = 0; $i < count($arr); $i++) {
			$arr[$i][note]  = str_replace("home.php",DX_URL.'home.php',$arr[$i][note]);
		}
		return $arr;
	}
	
	/**
	 * 根据msg_id获取私信内容
	 */
	static public function getmsgidcontent($msg_id){
		if(empty($msg_id) || !is_numeric($msg_id))
			return getR(false,"msg_id异常");
		$dblink = new DataBase("");
		$sql = "SELECT * FROM pre_weibo_private_msg WHERE id=$msg_id";
		$arr = $dblink->getRow($sql);
		return $arr;
	}
	
	static public function getUserShareNum($uid){
		if(empty($uid) || !is_numeric($uid))
			return getR(false,"uid异常");
		$dblink = new DataBase("");
		$sql = "SELECT COUNT(*) AS num FROM pre_community_file WHERE uid=$uid";
		$arr = $dblink->getRow($sql);
		$num = $arr[0][num];
		return $num;
	}
	
	
	/**
	 * 新火秀开放测试开关
	 * $uid得到用户uid
	 */
	static public function NewMyshowUidAllow($uid){
		$dblink = new DataBase("");
		$sql = "SELECT config_value FROM pre_mutilive_config WHERE config_name LIKE 'newhuoshow_test'";
		$newhuoshow_config = $dblink->getRow($sql);
		if(!empty($uid)) {	
			if (!is_numeric($uid) || $uid<1) {
				return getR(false,"uid格式错误");
			}
			$sql = "SELECT uid FROM pre_mutilive_allow_user_list WHERE uid=$uid";
			$newhuoshow_allowuser = $dblink->getRow($sql);
		}		
		//判断是否开启测试
		if ($newhuoshow_config[0]['config_value'] == 0 || ($newhuoshow_config[0]['config_value'] == 1 && $newhuoshow_allowuser[0]['uid'] != "")) {
			return 1;//判断上，返回1则显示新火秀相关内容
		}else {
			return 0;
		}
		$dblink->dbclose();
		
	}
	
	/**
	 * 系统用户管理员在前台可删除分享
	 * @param unknown_type $uid
	 */
	static public function SystemUserDelShare($uid){
		if(!is_numeric($uid) || $uid<=0)
			return getR(false,"用户ID异常");
		$dblink = new DataBase("");
		$arr = array(102486,102258,27519,211994,28154,174680,209388);
		if (in_array($uid,$arr)){
			$is_system = 1;
		}else {
			$is_system = 0;
		}
		return $is_system;
	}
	
	
	/**
	 * 获取此用户是否在一小时内已注册
	 * @param unknown_type $ip
	 * @return number
	 */
	static public function getUserRegIp($ip){
		$dblink = new DataBase("");
		$datetime = time();
		//$sql = "SELECT count FROM pre_common_regip WHERE ip='$ip' AND count>'0' AND dateline>'$datetime'-1800";
		$sql = "SELECT ip FROM pre_common_regip WHERE ip LIKE '$ip' AND COUNT='-1' AND dateline>'$datetime'-0.5*3600 LIMIT 1";
		$arr = $dblink->getRow($sql);
		if (count($arr)>0) {
			$reg_id = 1;
		}else {
			$reg_id = 0;
		}
		return $reg_id;
	}
	
	
	/**
	 * 根据专辑ID获取类别的相关标签
	 */
	public function getalbumtap($album_id){
		//$album_id = $_POST['album_id'];
		$album_arr = Community::getAlbumClassId($album_id);
		if (checkErr($album_arr)){
			$datas = $album_arr["-msg-"];
			$class_arr = Community::getClassTagMap($datas[0][class_id]);
			if (checkErr($class_arr)){
				$class_data = $class_arr["-msg-"];
				/*foreach ($class_data as $k=>$v){
					if($k==0 || $k%19==0){
					echo '<ul class="tag-list-item fn-clear">';
					}
					echo '<li><a href="#" id='.$v[tag_id].'>'.$v[tag_name].'</a></li>';
					if(($k+1)%19==0){
					echo '</ul>';
					}
				}*/
				return $class_data;
			}else {
				return $class_arr["-msg-"];
				die();
			}
			
		}else {
			return $album_arr["-msg-"];
			die();
		}
	}
	//查询首页置顶分享数量
	public function gettoptypeindex($update){
		$dblink = new DataBase("");
		$sql = "select * from pre_community_file where status=99 and (top=1 or top=3) and  NOW()<=top_time";
		$arr = $dblink->getRow($sql);
		if($update == 1){
			$sql = "UPDATE pre_community_file SET top=0 WHERE id=".$arr[0]['id'];//全局置顶，挤掉原来的置顶分享
			$dblink->query($sql);
		}
		$num = count($arr);
		
		$topindex['arr'] =  $arr;
		$topindex['num'] =  $num;
		return $topindex;
	}
	//查询分类置顶分享数量
	public function gettoptypeclass($id,$update){
		//print_r($id);die();
		$dblink = new DataBase("");
		//for ($i=0;$i<count($i);$i++){
		$sql = "SELECT  a.*,b.album_name,c.id AS class_id,c.name AS class_name
				FROM pre_community_file a
				INNER JOIN pre_community_album b ON a.albumid=b.id
				INNER JOIN pre_community_class c ON b.class_id=c.id
				where a.id=$id
				order by a.input_time desc";
		$class_tmp = $dblink->getRow($sql);
		$class_id = $class_tmp[0]['class_id'];//查询分享所属分类
		$sql = "SELECT  a.*,b.album_name,c.id AS class_id,c.name AS class_name
				FROM pre_community_file a
				INNER JOIN pre_community_album b ON a.albumid=b.id
				INNER JOIN pre_community_class c ON b.class_id=c.id
				where a.status=99 and (a.top=2 or a.top=1) and  NOW()<=top_time and class_id='$class_id'   
				order by a.input_time desc";
		//echo $sql;
		$arr = $dblink->getRow($sql);
		if($update == 1){
			$sql = "UPDATE pre_community_file SET top=0 WHERE id=".$arr[0]['id'];//全局置顶，挤掉原来的置顶分享
			$dblink->query($sql);
		}
		$num = count($arr);
		//}
		$topclass['arr'] =  $arr;
		$topclass['num'] =  $num;
		return $topclass;
	}
	
	
	
	/* * 
	 * HTML切取
	 * @param string $html    要进入切取的HTML代码
	 * @param string $start   开始
	 * @param string $end     结束
	 */
	public   function communitycut_html($html, $start, $end) {
		if (empty($html)) return false;
		$html = str_replace(array("\r", "\n"), "", $html);
		$start = str_replace(array("\r", "\n"), "", $start);
		$end = str_replace(array("\r", "\n"), "", $end);
		$html = explode(trim($start), $html);
		if(is_array($html)) $html = explode(trim($end), $html[1]);
		return $html[0];
	}
	
}


/*
Community::Class(1, '1', '');
*/
?>