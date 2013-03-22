<?php
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
	exit('Access Denied');
}
cpheader();
shownav('extended', 'memu_gift');
//showsubmenu('memu_gift', array());
require_once libfile('function/live');
$giftTypearray = cGetGiftType();

$op = empty($_G['gp_op']) ? 'index' : $_G['gp_op'];
$ops = array('index', 'addgift','editgift','addtype');
if (!in_array($op, $ops)) {
	$op = 'index';
}
if ($op == 'index') {#搜索
	cpheader();
	shownav('extended', 'memu_gift');
	$giftname = isset($_G['gp_giftname']) ? $_G['gp_giftname'] : '';
	$gifttype = isset($_G['gp_gifttype']) ? $_G['gp_gifttype'] : 'all';
	//$gifttype=$_G['gp_gifttype'];
	$available = isset($_G['gp_available']) ? $_G['gp_available'] : '1';
if($_G['gp_gifttype']){
		$typeid=$_G['gp_gifttype'];
		$gifttypename = DB::query("SELECT * FROM ".DB::table('live_gift_type')." WHERE typeid='$typeid'");
		$rss = DB::fetch($gifttypename);
		$giftcname=$rss['name'];
	}
?>
<div class="itemtitle"><h3>礼物管理</h3>
<ul class="tab1">
<li class="current"><a href="admin.php?action=gift"><span>搜索</span></a></li>
<li><a href="admin.php?action=gift&op=addgift"><span>添加</span></a></li>
</ul></div>
<div>
<table width="598" border="0" align="left" cellpadding="0" cellspacing="0" style="color:#fff;">
    <form name="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=gift" method="post">
    <tr>
      <td>搜索:礼物名 <input type="text" name="giftname" size=30  maxlength="50" value="<?php echo $giftname;?>"/></td>    
       <td>类别
       <select name="gifttype">
       <?php //if(!empty($gifttype)){
       
       ?>
			<option value="<?php echo $gifttype;?>"><?php echo $giftcname; ?></option>
			 <option value="all">select..</option>>
       <?php // }
        foreach ($giftTypearray as $key=>$value) {
	echo "<option value=\"$value[typeid]\" $selected >$value[name]</option>\n";
	$i++;
       }
?>
      </select> </td>
      <td><input type="radio" <?php if($available==1)echo "checked";?>  value="1" name="available" id="available">生效</td>
      <td><input type="radio" <?php if($available==0)echo "checked";?> value="0" name="available" id="available">失效</td>
       <td><input type="submit" name="submit" value="搜索" /></td>
       </tr>
	</form>
  </table>
</div>
<?php //if(isset($_G['gp_submit'])){
		$Condition = '';
		$act='';
		if ($giftname) {#$giftname
			$Condition .= " AND a.name='$giftname'";
			$addurl .= "&name=$giftname";
		}
		if ($gifttype!= 'all') {#$giftType
			$Condition .= " AND a.typeid='$gifttype'";
			$act.= "&gifttype=$gifttype";
		}
        if (isset($available)) {#$available
			$Condition .= " AND a.available='$available'";
			$act.="&available=$available";
		}
        if ($giftid) {#giftid
			$Condition .= " AND a.giftid='$giftid'";
			$addurl .= "&giftid=$giftid";
		}
       showtableheader();
        $_G['setting']['memberperpage'] = 10;
		$page = max(1, $_G['page']);
		$start_limit = ($page - 1) * $_G['setting']['memberperpage'];
		$gift_res_count=DB::result_first("SELECT COUNT(*) FROM ".DB::table('live_gift')." a left join ".DB::table('live_gift_type')." t on a.typeid=t.typeid WHERE 1 ".$Condition." ");
 			if($gift_res_count > 0) {
 		$multi = multi($gift_res_count, $_G['setting']['memberperpage'], $page, ADMINSCRIPT."?action=gift&submit=yes".$act);
       showsubtitle(array('礼物名', '类别','参与排名','单位', '单价','有效性','图标','文字','操作'));
$queryrs=DB::query("SELECT a.*,t.name as typename FROM ".DB::table('live_gift')." a left join ".DB::table('live_gift_type')." t on a.typeid=t.typeid WHERE 1 ".$Condition." order by a.giftid desc LIMIT $start_limit, {$_G[setting][memberperpage]}");
   while($gift_rs = DB::fetch($queryrs)) {
   	if($gift_rs['available']==1){
		$ava="生效";
	}else{
		$ava="失效";
	}
   if($gift_rs['rank']==1){
		$rank="参与";
	}else{
		$rank="不参与";
	}
				showtablerow('', array('', ''), array(
				$gift_rs['name'],
				$gift_rs['typename'],
				$rank,
				$gift_rs['units'],
				$gift_rs['price'],
				$ava,
				'<img src="static2/images/gift/'.$gift_rs['image'].'" width="48" height="48" />',
				'<div style="width:400px;">'.$gift_rs['content'].'</div>',
				'<a href="admin.php?action=gift&op=editgift&giftid='.$gift_rs['giftid'].'">编辑</a>'
				));
	}
		}else{
			echo "没有搜索到记录！";
		}
		showsubmit('', '', '', '', $multi);
         showtablefooter();
//}
}elseif($op=='addgift' || $op=='editgift'){#添加礼物
   cpheader();
	shownav('extended', 'memu_gift');
	 if ($_G['gp_giftid']) {
	 	   $giftid=$_G['gp_giftid'];
			$sqlgiftname = DB::fetch_first("SELECT * FROM ".DB::table('live_gift')." WHERE giftid='$giftid'");
		} 
	$giftname = isset($_G['gp_giftname']) ? $_G['gp_giftname'] : $sqlgiftname['name'];
	$gifttype = isset($_G['gp_gifttype']) ? $_G['gp_gifttype'] : $sqlgiftname['typeid'];
	$giftunits = isset($_G['gp_giftunits']) ? $_G['gp_giftunits'] : $sqlgiftname['units'];
	$price = isset($_G['gp_price']) ? $_G['gp_price'] : $sqlgiftname['price'];
	$upload_file = isset($_G['gp_upload_file']) ? $_G['gp_upload_file'] : $sqlgiftname['image'];
	$available = isset($_G['gp_available']) ? $_G['gp_available'] : $sqlgiftname['available'];
	$content = isset($_G['gp_content']) ? $_G['gp_content'] : $sqlgiftname['content'];
	$identifier = isset($_G['gp_identifier']) ? $_G['gp_identifier'] : $sqlgiftname['identifier'];
	$rank = isset($_G['gp_rank']) ? $_G['gp_rank'] : $sqlgiftname['rank'];
	
	$gifttypename = DB::query("SELECT * FROM ".DB::table('live_gift_type')." WHERE typeid='$gifttype'");
		$rss = DB::fetch($gifttypename);
		$giftcname=$rss['name'];
	?>
<div class="itemtitle"><h3>礼物管理</h3>
<ul class="tab1">
<li><a href="admin.php?action=gift"><span>搜索</span></a></li>
<li class="current"><a href="admin.php?action=gift&op=addgift"><span>添加</span></a></li>
</ul></div>
<div>
	<form name="addgift" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=gift&op=addgift" method="post" enctype="multipart/form-data" onSubmit="return submitcheck();">
	<table class="tb tb2 ">
		<tr>
			<td colspan="2"><span class="td27"><font color="red">*</font>为必填项</td>
		</tr>
		<tr>
			<td colspan="2"><span class="td27">名称<font color="red">*</font>：</span><input type="text" name="giftname" value="<?php echo $giftname;?>" size="30"/></td>
		</tr>
		<tr>
			<td colspan="2"><span class="td27">类别<font color="red">*</font>：</span><select name="gifttype">
			<?php if(isset($gifttype)){?>
			<option value="<?php echo $gifttype;?>"><?php echo $giftcname; ?></option>
       <?php
			}
       foreach ($giftTypearray as $key=>$value) {
	echo "<option value=\"$value[typeid]\" $selected >$value[name]</option>\n";
	$i++;
       }
?>
      </select>&nbsp;&nbsp;<a href="admin.php?action=gift&op=addtype">+添加分类</a></td>
		</tr>
		<tr>
			<td colspan="2"><span class="td27">单位<font color="red">*</font>：</span><input type="text" name="giftunits" value="<?php echo $giftunits;?>" size="30"/></td>
		</tr>
		<tr>
			<td colspan="2"><span class="td27">单价<font color="red">*</font>：</span><input type="text" name="price" value="<?php echo $price;?>" size="30"/></td>
		</tr>
		<tr>
			<td colspan="2"><span class="td27">生效<font color="red">*</font>：</span><input type="radio" <?php if($available==1 || $op==addgift){echo "checked";}?>  value="1" name="available" id="available">生效
			<input type="radio" <?php if($available==0 && $op!=addgift)echo "checked";?> value="0" name="available" id="available">失效</td>
		</tr>
		<tr>
			<td colspan="2"><span class="td27">图标<font color="red">*</font>：</span><input type="file" name="upload_file" value="" size="30"/>&nbsp;&nbsp;<?php if(!empty($upload_file)){?><a target="_blank" href="http://space.huoshow.com/static2/images/gift/<?php echo $upload_file;?>">查看图片</a><?php }?><font color="red"> (上传图片格式为：.jpg .png .gif .bmp)</font></td>
		</tr>
		<tr>
			<td><span class="td27" align="center">文字<font color="red">*</font>：</span>
			<textarea rows="8" cols="30" name="content"><?php if(isset($content)){echo $content;}?></textarea></td>
				<td><span>自动替换:{sender}=送礼人; {receiver}=收礼人;{name}=礼物名; {unit}=单位; {icon}=图标;{num}=数量</span><br>
				<span>例句：{sender}抱着大捧的{name}{icon}...{icon}（共{num}{unit}）突破保安，冲上舞台，对着{receiver}说：你丫忒美了！</span>
				</td>
		</tr>
		<tr>
			<td colspan="2"><span class="td27">标识  ：</span><input type="text" name="identifier" value="<?php echo $identifier;?>" size="30"/>  注：  标识不能重复使用</td>
		</tr>
		<tr>
			<td colspan="2"><span class="td27">参与排名  ：</span>
			<input type="radio" <?php if($rank==1) echo "checked"; ?> value="1" name="rank" id="rank">参与
			<input type="radio"  <?php if($rank==0) echo "checked"; ?> value="0" name="rank" id="rank">不参与</td>
		</tr>
		<tr>
			<td colspan="1">
			<input type="hidden" name="opt" value="<?php echo $op;?>"/>
			<input type="hidden" name="giftid" value="<?php echo $giftid;?>" size="30"/>
			<input class="btn" type="submit" name="submit" value="提交"/></td>
		</tr>
	</table>
	</form>
</div>
<?php
if(isset($_G['gp_submit'])){
	if(empty($_G['gp_giftid'])){
	    $sqlmaxid = DB::fetch_first("SELECT max(giftid)as giftid FROM ".DB::table('live_gift'));
	    $maxid=$sqlmaxid['giftid']+1;
	
	}else{
	    $maxid=$_G['gp_giftid'];
	
	}
if($_G['gp_opt'] =='editgift'){
	$updateImg = empty($_FILES["upload_file"]["name"]) ? false : true;
} else {
	$updateImg = true;
}
 $time=time();

if ($_G['gp_identifier']) {
	$identifier=$_G['gp_identifier'];
	$giftid=$_G['gp_giftid'];
			$sqlgifti = DB::fetch_first("SELECT * FROM ".DB::table('live_gift')." WHERE identifier='$identifier' and giftid<>'$giftid'");
		} 
if ($updateImg==false) {
	if($sqlgifti<=0){
	$giftid=$_G['gp_giftid'];
	DB::update('live_gift', array('available' => $available,'rank' =>$rank,
	 'identifier' => $identifier,'name' => $giftname,'typeid' => $gifttype,'price' => $price,
	 'units' => $giftunits,'dateline' =>$time,'content' =>$content),"giftid='$giftid'");
	 cpmsg('update_succeed', "admin.php?frames=yes&action=gift&op=addgift", 'succeed');	
	}else{
		echo "标识相同，请更改。。";
	}
}else{
$upload_file=$_FILES["upload_file"]["name"]; //获取上传原文件名
$type=strtolower(substr(strrchr($upload_file, '.'), 1, 10));
$_FILES["upload_file"]["name"]="gift_".$maxid.".".$type;
$upload_file=$_FILES["upload_file"]["name"]; //获取重命名后的文件名

$upload_tmp_file=$_FILES["upload_file"]["tmp_name"]; //获取临时文件名
$upload_filetype=$_FILES["upload_file"]["type"]; //获取文件类型
$upload_status=$_FILES["upload_file"]["error"]; //获取文件出错情况
$upload_size=$_FILES["upload_file"]["size"];
$max_size=102400;
$upload_dir=DISCUZ_ROOT."static2/images/gift/"; //指定文件存储路径
$get_type=explode("/",$upload_filetype);
if($get_type[1]!="gif"&& $get_type[1]!="jpeg"&& $get_type[1]!="pjpeg"&& $get_type[1]!="x-png"&& $get_type[1]!="png"&& $get_type[1]!="bmp")
{
echo "<script> alert('无效的文件名称或上传的是非指定的图片文件！');history.go(-1);</script>";
}else
{if($upload_size>$max_size)
{
echo " <script>alert('文件超过限定大小！');history.go(-1);</script>";
}else{
switch($upload_status)
 {
  case 0:echo "";break;
  case 1:echo "<script>alert('上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。');histroy.go(-1);</script>";break;
  case 2:echo "<script>alert('上传文件的大小超过了协力人力资源网指定的值。');histroy.go(-1);</script>";break;
  case 3:echo "<script>alert('文件只有部分被上传。');histroy.go(-1);</script>";break;
  case 4:echo "<script>alert('没有文件被上传。');histroy.go(-1);</script>";break;
  case 6:echo "<script>alert('没有找到临时文件目录。');histroy.go(-1);</script>";break;
  case 7:echo "<script>alert('文件写入失败。');histroy.go(-1);</script>";break;
  } //分析文件出错情况并给出提示
$upload_path=$upload_dir.$upload_file; //定义文件最终的存储路径和名称
if(file_exists($upload_tmp_file)){
	//if(file_exists($upload_path)){ echo "<script>alert('同名文件已经存在，请修改你要上传的文件名！');history.go(-1);</script>";} 
	if(move_uploaded_file($upload_tmp_file,$upload_path)){
		if ($_G['gp_identifier']) {
	 	   $identifier=$_G['gp_identifier'];
			$sqlgifti = DB::fetch_first("SELECT * FROM ".DB::table('live_gift')." WHERE identifier='$identifier'");
		} 
		 if ($_G['gp_giftid']) {
	 	   $giftid=$_G['gp_giftid'];
			$sqlgiftname = DB::fetch_first("SELECT * FROM ".DB::table('live_gift')." WHERE giftid='$giftid'");
		} 
		$time=time();
	if(empty($sqlgiftname)){#判断礼物是否存在
		if(empty($sqlgifti)){#判断插入是否相同标识
	DB::insert('live_gift', array('available' => $available,'rank' =>$rank,
	 'identifier' => $identifier,'image' => $upload_file,'name' => $giftname,'typeid' => $gifttype,'price' => $price,
	 'units' => $giftunits,'dateline' =>$time,'content' =>$content));
	cpmsg('operate_succeed', "admin.php?frames=yes&action=gift&op=addgift", 'succeed');	
		}else{
			die('礼物标识相同！');
		}
    }else{
    	DB::update('live_gift', array('available' => $available,'rank' =>$rank,
	 'identifier' => $identifier, 'image' => $upload_file,'name' => $giftname,'typeid' => $gifttype,'price' => $price,
	 'units' => $giftunits,'dateline' =>$time,'content' =>$content),"giftid='$giftid'");
	 cpmsg('update_succeed', "admin.php?frames=yes&action=gift&op=addgift", 'succeed');	
    }
   }else{
   	die('上传失败！');
   }
    }
}
  }
}
}
 }elseif($op =='addtype'){#添加礼物分类
   cpheader();
	shownav('extended', 'memu_gift');
if(isset($_G['gp_submit'])){ 
	$typename = isset($_G['gp_typename']) ? $_G['gp_typename'] : '';
	if(!empty($typename)){
	DB::insert('live_gift_type', array('name' => $typename));
	cpmsg('operate_succeed', "admin.php?frames=yes&action=gift&op=addtype", 'succeed');	
  }
}
	?>
	<div class="itemtitle"><h3>礼物管理</h3>
<ul class="tab1">
<li><a href="admin.php?action=gift"><span>搜索</span></a></li>
<li><a href="admin.php?action=gift&op=addgift"><span>添加礼物</span></a></li>
<li class="current"><a href="admin.php?action=gift&op=addtype"><span>添加礼物分类</span></a></li>
</ul></div>
<div>
	<form name="typename" id="typename" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>?action=gift&op=addtype">
	<table class="tb tb2 ">
		<tr>
			<td><span class="td27">分类名称：</span><input type="text" name="typename" value=""/></td>
		</tr>
		<tr>
			<td><input class="btn" type="submit" name="submit" value="提交" /></td>
		</tr>
	</table>
	</form>
</div>
<?php }elseif($op =='del'){#删除礼物
	if ($_GET['op']=='del') {
		$giftid = $_GET['giftid'];
		$sql = "DELETE FROM ".DB::table('live_gift')." WHERE giftid = $giftid ";
		//echo $sql;
		$query = DB::query($sql);
		cpmsg('operate_succeed', "admin.php?frames=yes&action=gift", 'succeed');	
	}
	
}
?>
<script type="text/javascript">
function submitcheck(){ 
	var em=document.addgift;
	if(em.giftname.value==''){
		alert ("请输入礼物名称！");
		em.giftname.focus();
		return false;
	}
	if(em.giftunits.value==''){
		alert ("请输入礼物单位！");
		em.giftunits.focus();
		return false;
	}
	if(em.price.value==''){
		alert ("请输入礼物价格！");
		em.price.focus();
		return false;
	}
	if(em.content.value==''){
		alert("请输入文字！");
		em.content.focus();
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
