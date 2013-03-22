<?php
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: admincp_duixian.php 16352 2011-01-07 11:00:19Z zhouyc $
 */

if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}

if(empty($operation)){
	$operation = 'index';
}

if ($operation=='index'){
	if ($_GET['act']=='del') {
		$id = $_GET['id'];
		$sql = "DELETE FROM ".DB::table('top')." WHERE id = $id ";
		$query = DB::query($sql);
		header("Location:admin.php?action=film&operation=sonall&id=".$_GET['typeid']);
	}
	
	if ($_GET['act']=='fdel') {
		$id = $_GET['id'];
		$sql = "DELETE FROM ".DB::table('top_type')." WHERE id = $id ";
		//echo $sql;
		$query = DB::query($sql);
	}
	
	cpheader();
	shownav('extended', '排行榜');
	showsubmenu('排行榜分类管理', array());
	showformheader('film');
	showtableheader();
	echo '<a href="admin.php?action=film&operation=add"><strong>添加分类</strong></a>';
	$_G['setting']['memberperpage'] = 15;
	$page = max(1, $_G['page']);
	$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
	$search_condition = array_merge($_GET, $_POST);
	foreach($search_condition as $k => $v) {
		if(in_array($k, array('action', 'operation', 'formhash', 'submit', 'page')) || $v === '') {
			unset($search_condition[$k]);
		}
	}
	$film_rs = array();
	$sql = "SELECT COUNT(*) AS count FROM ".DB::table('top_type')." WHERE categories = 1 ";
	$film_rs_count=DB::result_first($sql);
	if ($film_rs_count > 0){
		showsubtitle(array('ID','名称','标识','是否开启','是否推荐','管理'));
		$multi = multi($film_rs_count, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=film&submit=yes".$act);
		$sql = "SELECT * FROM ".DB::table('top_type')." WHERE categories = 1 ORDER BY id LIMIT $start_limit, {$_G[setting][memberperpage]}";
		$query = DB::query($sql);
		while ($film_rs = DB::fetch($query)){
			showtablerow('',array('',''),array(
			$film_rs['id'],
			$film_rs['name'],
			$film_rs['keys'],
			$film_rs['isopen'] == 1 ? '开启' : '关闭',
			$film_rs['isrecommend'] == 1 ? '推荐' : '不推荐',
			'<a href="admin.php?action=film&operation=add&id='.$film_rs['id'].'">添加排行榜</a> |
			<a href="admin.php?action=film&operation=all&id='.$film_rs['id'].'">查看</a> | 
			<a href="admin.php?action=film&operation=edit&id='.$film_rs['id'].'">修改</a> | 
			<a id="del" onclick="delError('."'admin.php?action=film&act=fdel&id=".$film_rs['id']."'".');"  href="javascript:;">删除</a>'
			));
		}
		showsubmit('', '', '', '', $multi);
		showtablefooter();
	}
}

if ($operation=='add'){
	cpheader();
	shownav('extended', '排行榜');
	showsubmenu('添加排行榜分类', array());
	showtableheader();
	$parentid = $_GET['id'];
	if ($_GET['act']=='post') {
		$name = $_G['gp_username'];
		$keys = $_G['gp_keys'];
		$isopen = $_G['gp_isopen'];
		$isrecommend = $_G['gp_isrecommend'];
		$pid = $_GET['pid'];
		$sql = "SELECT name,`keys` FROM ".DB::table('top_type')." where name ='$name' or `keys`='$keys' ";
		//echo $sql;
		$isname = DB::fetch_first($sql);
		if ($isname['name'] != $name and $isname['keys'] != $keys){
			$typeData = array(
				'name' => $name,'keys' => $keys,'isopen' => $isopen,'isrecommend' => $isrecommend,'parentid' => $pid, 'categories' => $pid ? '0' :'1'
			);
			//print_r($typeData);
			DB::insert('top_type',$typeData);
			header("Location: admin.php?action=film");
		}else {
			die('名称或者标示已存在,<a href="admin.php?action=film&operation=add"><strong>请重新添加</strong></a>！！！');
		}
	}
	$fh = '<a href="admin.php?action=film" style="color:blue">返回分类列表</a>';
	showformheader("film&operation=$operation&act=post&pid=$parentid",'onsubmit="return cform(this);"');
	showtableheader();
	echo '名称：&nbsp;<input type="text" name="username" value="" /><br/>';
	echo '<br>';
	echo '标识：&nbsp;<input type="text" name="keys" value="" /><br/>';
	echo '<br>';
	echo '是否开启：<select name="isopen">
		<option value="1">开启</option>
		<option value="0">关闭</option>
		</select><br/>';
	echo '<br>';
	echo '是否推荐：<select name="isrecommend">
		<option value="1">推荐</option>
		<option value="0">不推荐</option>
		</select>';
	showsubmit('submit', '提交', '', $fh);
	showformfooter();
}

if ($operation == 'edit') {
	cpheader();
	shownav('extended', '排行榜');
	showsubmenu('修改排行榜分类', array());
	showtableheader();
	
	$id = $_GET['id'];
	$sonid = $_GET['son'];
	if ($_GET['act']=='post') {
		//echo $_G['gp_bankcode'];
		$name = $_G['gp_fname'];
		$keys = $_G['gp_fkeys'];
		$sonpid = $_GET['sonpid'];
		$isopen = $_G['gp_isopen'];
		$isrecommend =$_G['gp_isrecommend'];
		$sql = "UPDATE ".DB::table('top_type')." SET name='$name',`keys`='$keys',isopen='$isopen',isrecommend='$isrecommend' WHERE id=$id ";
		//echo $sql;
		DB::query($sql);
		if ($sonpid){
			header("Location: admin.php?action=film&operation=all&id=$sonpid");
		}else {
			header("Location: admin.php?action=film");
		}
	}
	$sql = "SELECT * FROM ".DB::table('top_type')." where id=$id";
	//echo $sql;
	$film =DB::fetch_first($sql);
	$fh = '<a href="admin.php?action=film" style="color:blue">返回排行榜列表</a>';
	showformheader("film&operation=$operation&id=$id&act=post&sonpid=$sonid",'onsubmit="return cformadd(this);"');
	showtableheader();
	$liter = getIsOpen($film['isopen']);
	$liter1 = getIsRecommend($film['isrecommend']);
	echo '名称：&nbsp;<input type="text" name="fname" value="'.$film['name'].'" /><br/>';
	echo '<br>';
	echo '标识：&nbsp;<input type="text" name="fkeys" value="'.$film['keys'].'" /><br/>';
	echo '<br>';
	echo '是否开启：&nbsp;
			<select name="isopen" class="select">
				<option value="'.$film['isopen'].'">'.$liter.'</option>
				<option value="1">'.getIsOpen(1).'</option>
				<option value="0">'.getIsOpen(0).'</option>
			</select><br/>';
	echo '<br>';
	echo '是否推荐：&nbsp;
			<select name="isrecommend" class="select">
				<option value="'.$film['isrecommend'].'">'.$liter1.'</option>
				<option value="1">'.getIsRecommend(1).'</option>
				<option value="0">'.getIsRecommend(0).'</option>
			</select>';
	showsubmit('submit', '提交', '', $fh);
	showformfooter();
}

if ($operation == 'all') {
	cpheader();
	shownav('extended', '排行榜');
	showsubmenu('排行榜列表管理', array());
	showtableheader();
	$_G['setting']['memberperpage'] = 12;
	$page = max(1, $_G['page']);
	$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
	$search_condition = array_merge($_GET, $_POST);
	foreach($search_condition as $k => $v) {
		if(in_array($k, array('action', 'operation', 'formhash', 'submit', 'page')) || $v === '') {
			unset($search_condition[$k]);
		}
	}
	$pid = $_GET['id'];
	$film_rs = array();
	$sql = "SELECT COUNT(*) AS count FROM ".DB::table('top_type')." WHERE parentid=$pid ";
	$film_rs_count=DB::result_first($sql);
	echo '<a href="admin.php?action=film&operation=add&id='.$pid.'"><strong>添加排行榜</strong></a>';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;';
	echo '<a href="admin.php?action=film"><strong>返回分类</strong></a>';
	if ($film_rs_count > 0){
		showsubtitle(array('ID','名称','标识','是否开启','是否推荐','管理'));
		$multi = multi($film_rs_count, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=film&submit=yes".$act);
		$sql = "SELECT * FROM ".DB::table('top_type')." WHERE parentid=$pid ORDER BY id LIMIT $start_limit, {$_G[setting][memberperpage]}";
		$query = DB::query($sql);
		while ($film_rs = DB::fetch($query)){
			showtablerow('',array('',''),array(
				$film_rs['id'],
				$film_rs['name'],
				$film_rs['keys'],
				$film_rs['isopen'] == 1 ? '开启' : '关闭',
				$film_rs['isrecommend'] == 1 ? '推荐' : '不推荐',
				'<a href="admin.php?action=film&operation=sonall&id='.$film_rs['id'].'&typename='.$film_rs['name'].'&pid='.$pid.'">查看</a> | 
				<a href="admin.php?action=film&operation=edit&id='.$film_rs['id'].'&pid='.$pid.'">修改</a> | 
				<a id="del" onclick="delError('."'admin.php?action=film&act=fdel&id=".$film_rs['id']."'".');"  href="javascript:;">删除</a>'
			));
		}
		showsubmit('', '', '', '', $multi);
		showtablefooter();
	}
}

if ($operation == 'sonall') {
	cpheader();
	shownav('extended', '排行榜');
	//showsubmenu('排行榜信息管理', array());
	showtableheader();
	$id = $_GET['id'];
	$pid = $_GET['pid'];
	$typename = $_GET['typename'];
	echo '<h3>排行榜名称：'.$typename.'</h3>';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;';
	echo '<a href="admin.php?action=film&operation=addlist&typeid='.$id.'&pid='.$pid.'"><strong>添加排行榜信息</strong></a>';
	echo '&nbsp;&nbsp;&nbsp;&nbsp;';
	echo '<a href="admin.php?action=film&operation=all&id='.$pid.'"><strong>返回排行榜</strong></a>';
	$_G['setting']['memberperpage'] = 12;
	$page = max(1, $_G['page']);
	$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
	$search_condition = array_merge($_GET, $_POST);
	foreach($search_condition as $k => $v) {
		if(in_array($k, array('action', 'operation', 'formhash', 'submit', 'page')) || $v === '') {
			unset($search_condition[$k]);
		}
	}
	$film_rs = array();
	$sql = "SELECT COUNT(*) AS count FROM ".DB::table('top')." WHERE type=$id ";
	$film_rs_count=DB::result_first($sql);
	if ($film_rs_count > 0){
		showsubtitle(array('显示顺序','名称1','值1','名称2','值2','名称3','值3','名称4','值4','名称5','值5','升降情况','链接','图片','管理'));
		$multi = multi($film_rs_count, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=film&submit=yes".$act);
		$sql = "SELECT * FROM ".DB::table('top')." WHERE type=$id ORDER BY sort LIMIT $start_limit, {$_G[setting][memberperpage]} ";
		$query = DB::query($sql);
		while ($film_rs = DB::fetch($query)) {
			showtablerow('',array('',''),array(
				$film_rs['sort'],
				$film_rs['key'],
				$film_rs['value'],
				$film_rs['key2'],
				$film_rs['value2'],
				$film_rs['key3'],
				$film_rs['value3'],
				$film_rs['key4'],
				$film_rs['value4'],
				$film_rs['key5'],
				$film_rs['value5'],
				$film_rs['liters_drop'] = getLitersDrop($film_rs['liters_drop']),
				$film_rs['link'],
				$film_rs['image'] ? '<img src="'.$film_rs['image'].'" width="48" height="48" />' : '',
				'<a href="admin.php?action=film&operation=editlist&typeid='.$id.'&id='.$film_rs['id'].'&pid='.$pid.'">修改</a> | 
				 <a id="del" onclick="delError('."'admin.php?action=film&act=del&typeid=".$film_rs[type]."&id=".$film_rs['id']."'".');"  href="javascript:;">删除</a> '
			));
		}
		showsubmit('', '', '', '', $multi);
		showtablefooter();
	}
}

if ($operation == 'addlist') {
	cpheader();
	shownav('extended', '排行榜管理');
	showsubmenu('添加排行榜', array());
	$typeid = $_GET['typeid'];
	$pid = $_GET['pid'];
	if ($_GET['act']=='post') {
		$type = $_GET['typeid'];
		$sort = $_G['gp_sort'];
		$key = $_G['gp_key'];
		$value = $_G['gp_value'];
		$key2 = $_G['gp_key2'];
		$value2 = $_G['gp_value2'];
		$key3 = $_G['gp_key3'];
		$value3 = $_G['gp_value3'];
		$key4 = $_G['gp_key4'];
		$value4 = $_G['gp_value4'];
		$key5 = $_G['gp_key5'];
		$value5 = $_G['gp_value5'];
		$liters_drop = $_G['gp_liters'];
		$link = $_G['gp_link'];
		
		if (!$_FILES['image']['name']) {
			$image = $_POST['image'];
		}else{		
			$uploaddir="data/attachment/common/admincp"; //指定文件存储路径
			if (!file_exists($uploaddir))	mkdir($uploaddir, 0777, 1 );
			$image = $uploaddir.'/'.$_FILES['image']['name'];	
			
			if(!copy($_FILES['image']['tmp_name'], $image)) {	
				die('上传失败');
			}
		}	
		//echo "成功";
		$filmData = array(
			'sort'=>$sort,'type'=>$type,'key'=>$key ,'value'=>$value,'key2'=>$key2 ,'value2'=>$value2,'key3'=>$key3 ,'value3'=>$value3,
			'key4'=>$key4 ,'value4'=>$value4,'key5'=>$key5 ,'value5'=>$value5,'liters_drop'=>$liters_drop,'image'=>$image,'link'=> $link
		);
		//print_r($filmData);
		DB::insert('top',$filmData);
		header("Location: admin.php?action=film&operation=sonall&id=$typeid&pid=$pid");	
	}
	$fh = '';
showformheader("film&operation=$operation&act=post&typeid=$typeid&pid=$pid",'enctype="multipart/form-data"','onsubmit="return cformadd(this);"');
	showtableheader();
	if ($typeid){
		$topname = getTopNmae($typeid);
	}
	echo '<table>';
	echo '<tr>';
	echo '<td>排行榜名称：</td><td>'.$topname['name'].'</td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">显示顺序：</td><td><input type="text" name="sort" value="" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">名称1：</td><td><input type="text" name="key" value="" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">值1：</td><td><input type="text" name="value" value="" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">名称2：</td><td><input type="text" name="key2" value="" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">值2：</td><td><input type="text" name="value2" value="" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">名称3：</td><td><input type="text" name="key3" value="" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">值3：</td><td><input type="text" name="value3" value="" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">名称4：</td><td><input type="text" name="key4" value="" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">值4：</td><td><input type="text" name="value4" value="" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">名称5：</td><td><input type="text" name="key5" value="" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">值5：</td><td><input type="text" name="value5" value="" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">图片：</td><td><input type="file" name="image" value="" size="30" /><font color="red"> (上传图片格式为：.jpg .png .gif .bmp)</font></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">链接：</td><td><input type="text" size="30" name="link" value="" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">升降情况：</td><td><select name="liters">
		<option value="1">上升</option>
		<option value="2">持平</option>
		<option value="3">下降</option>
		</select></td>';
	echo '</tr>';
	echo '</table>';

	showsubmit('submit', '提交', '', '<a href="admin.php?action=film&operation=sonall&id='.$typeid.'&pid='.$pid.'&typename='.$topname['name'].'">返回排行榜列表</a>');
	showformfooter();
}

if ($operation == 'editlist') {
	cpheader();
	shownav('extended', '排行榜管理');
	showsubmenu('修改排行榜信息', array());
	//showtableheader();
	$id = $_GET['id'];
	$type = $_GET['typeid'];
	$pid = $_GET['pid'];
	if ($_GET['act']=='post') {
		$typeid= $_GET['sonid'];
		$ppid = $_GET['pid'];
		$sort = $_G['gp_sort'];
		$key = $_G['gp_key'];
		$value = $_G['gp_value'];
		$key2 = $_G['gp_key2'];
		$value2 = $_G['gp_value2'];
		$key3 = $_G['gp_key3'];
		$value3 = $_G['gp_value3'];
		$key4 = $_G['gp_key4'];
		$value4 = $_G['gp_value4'];
		$key5 = $_G['gp_key5'];
		$value5 = $_G['gp_value5'];
		$liters_drop = $_G['gp_liters'];
		$link = $_G['gp_link'];
		
		if (!$_FILES['image']['tmp_name']) {
			$image = $_POST['himage'];
		}else{		
			$uploaddir="data/attachment/common/admincp"; //指定文件存储路径
			if (!file_exists($uploaddir))	mkdir($uploaddir, 0777, 1 );
			$image = $uploaddir.'/'.$_FILES['image']['name'];	
			
			if(!copy($_FILES['image']['tmp_name'], $image)) {	
				die('上传失败');
			}
		}	//echo "成功";
		$sql = "UPDATE ".DB::table('top')." SET `key` = '$key', sort='$sort',value='$value',key2='$key2' ,value2='$value2',key3='$key3' ,value3='$value3',
			key4='$key4' ,value4='$value4',key5='$key5',value5='$value5' ,liters_drop='$liters_drop',image='$image',link='$link' WHERE id=$id ";		
		DB::query($sql);
		//header("Location: admin.php?action=film&operation=sonall&id=$typeid");	
		header("Location: admin.php?action=film&operation=sonall&id=$typeid&pid=$ppid");		
	}
	
	$sql = "SELECT * FROM ".DB::table('top')." WHERE id=$id";
	$film =DB::fetch_first($sql);
	$fh = '<a href="admin.php?action=film&operation=sonall&id='.$type.'" style="color:blue">返回排行榜列表</a>';
	showformheader("film&operation=$operation&id=$id&act=post&sonid=$type&pid=$pid",'enctype="multipart/form-data"');
	$gettoptype = getTopType();
	$liter = getLitersDrop($film['liters_drop']);
	echo '<table>';
	echo '<tr>';
	echo '<td style="text-align:right;">显示顺序：</td><td><input type="text" name="sort" value="'.$film['sort'].'" /><input type="hidden" name="type" value="'.$film['typeid'].'" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">名称1：</td><td><input type="text" name="key" value="'.$film['key'].'" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">值1：</td><td><input type="text" name="value" value="'.$film['value'].'" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">名称2：</td><td><input type="text" name="key2" value="'.$film['key2'].'" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">值2：</td><td><input type="text" name="value2" value="'.$film['value2'].'" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">名称3：</td><td><input type="text" name="key3" value="'.$film['key3'].'" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">值3：</td><td><input type="text" name="value3" value="'.$film['value3'].'" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">名称4：</td><td><input type="text" name="key4" value="'.$film['key4'].'" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">值4：</td><td><input type="text" name="value4" value="'.$film['value4'].'" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">名称5：</td><td><input type="text" name="key5" value="'.$film['key5'].'" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">值5：</td><td><input type="text" name="value5" value="'.$film['value5'].'" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">图片：</td><td><input type="file" name="image" value="'.$film['image'].'" size="30" /><input type="text" name="himage" style="display:none;" value="'.$film['image'].'" size="30" /><font color="red"> (上传图片格式为：.jpg .png .gif .bmp)</font></td>';
	echo '</tr>';
	echo '<tr><td colspan="2">';
	if(!empty($film['image'])){?>
		<img src="<?php echo $film['image']?>" width="100"><?php }?>
	<?php 
	echo '</td></tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">链接：</td><td><input type="text" size="30" name="link" value="'.$film['link'].'" /></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td style="text-align:right;">升降情况：</td>
		<td>
			<select name="liters" class="select">
				<option value="'.$film['liters_drop'].'">'.$liter.'</option>
				<option value="1">'.getLitersDrop(1).'</option>
				<option value="2">'.getLitersDrop(2).'</option>
				<option value="3">'.getLitersDrop(3).'</option>
			</select>
		</td>';
	echo '</tr>';
	echo '</table>';
	showsubmit('submit', '提交', '', $fh);
	showformfooter();
}

?>
<script type="text/javascript">
function cformadd(f){
	if(f.sort.value==''){
		alert('显示顺序不能为空，请输入显示顺序！！！');
		f.sort.focus();
		return false;
	}
	if(f.type.value==''){
		alert('类型不能为空，请选择类型！！！');
		f.type.focus();
		return false;
	}
	if(f.key.value==''){
		alert('名称不能为空，请输入名称！！！');
		f.key.focus();
		return false;
	}
	if(f.value.value==''){
		alert('值不能为空，请输入值！！！');
		f.value.focus();
		return false;
	}
}
function cform(f){
	if(f.username.value==''){
		alert('类型不能为空，请输入类型！！！');
		f.username.focus();
		return false;
	}
}
</script>
<script type="text/javascript">
function delError(href)
{
	if (!confirm("确定删除？注意：此操作不可恢复，请谨慎操作！")) {
		return false;
	}else{
		window.location.href= href;
	}
}
</script>
