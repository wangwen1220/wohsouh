<style type='text/css'>
.menu-content {
	margin: 10px;
	padding: 5px;
	border: 1px solid #FFBE7A;
	background-color: #FFFCED;
	line-height: 30px;
}
.menu-content label, .menu-content a {
	margin-left: 5px;
}
.menu-content input, .menu-content select {
	height: 20px;
	line-height: 20px;
}
.menu-content input.date {
	background-position: 100% 0;
}
.menu-content .brv {
	margin-right: 8px;
}
.content-menu, .subnav {/* 这两个东西影响布局暂时隐藏 */
	display: none;
}
.ui-table {
	font-size: 12px;
	width: 100%;
}
td.desc {
	word-wrap: break-word;
}
td.desc p {
	width: 150px;
	word-wrap: break-word;
}

/* powerFloat */
.float_ajax_box {
	border: 1px solid #ccc;
	background-color: #fff;
}

.float_loading {
	width: 100px;
	height: 100px;
	background: url(http://www.zhangxinxu.com/study/image/loading.gif) no-repeat center;
}

.float_ajax_image {
	padding: 5px;
}

.float_ajax_error {
	width: 200px;
	padding: 40px 0;
	text-align: center;
}

.float_list_ul {
	margin: 0;
	padding: 1px;
	border: 1px solid #beceeb;
	background-color: #fff;
	font-size: 12px;
	list-style-type: none;
}

.float_list_a {
	display:block;
	text-decoration: none;
}
.float_list_a:hover {
	background-color:#f0f3f9;
	color: #333;
	text-decoration: none;
}

.float_list_ul li {
	line-height: 20px;
	border-top: 1px solid #f0f3f9;
	text-indent: 5px;
}

.float_list_ul li:first-child {
	border-top: 0;
}

.float_list_null {
	padding: 40px 20px;
	text-align: center;
}

.float_remind_box {
	border: 1px solid #F7CE39;
	background: #ffffe0;
	padding: 5px 10px;
}

.float_tip_box {
	line-height: 18px;
	padding: 0 3px;
	background-color: #ffffe0;
	-moz-box-shadow: 1px 1px 2px rgba(0, 0, 0, .4);
	-webkit-box-shadow: 1px 1px 2px rgba(0, 0, 0, .4);
	box-shadow: 1px 1px 2px rgba(0, 0, 0, .4);
	border: 1px solid #333;
	position:absolute;
} 

.float_doing_box {
	border: 1px solid #F7CE39;
	background: #ffffe0 url(http://www.zhangxinxu.com/study/image/loading_s.gif) no-repeat 5px center;
	padding: 5px 10px 5px 25px;
	font-size: 12px;
	position: absolute;
}

.float_corner {
	font-size: 18px;
	font-family: '宋体';
	position: absolute;
	left: -6000px;
	overflow: hidden;
}
.float_corner .corner {
	position: absolute;
}
.float_corner .corner_1 {
	/*可去除*/
	color: #ccc;
}
.float_corner .corner_2 {
	/*可去除*/
	color: #fff;
}
.float_corner_top, .float_corner_bottom {
	width: 16px;
	height: 8px;
}
.float_corner_top {
	line-height: 14px;
}
.float_corner_bottom {
	line-height: 17px;
}
.float_corner_left, .float_corner_right {
	width: 8px;
	height: 16px;
}
.float_corner_top .corner, .float_corner_bottom .corner {
	left: 0;
}
.float_corner_right .corner, .float_corner_left .corner{
	top: -2px;
}
.float_corner_bottom .corner_1 {
}
.float_corner_bottom .corner_2 {
	top: 1px;
}
.float_corner_left .corner_1 {
	right: 0;
}
.float_corner_left .corner_2 {
	right: 1px;
}
.float_corner_top .corner_1 {
	bottom: 0;
}
.float_corner_top .corner_2 {
	bottom: 1px;
}
.float_corner_right .corner_2 {
	left: 1px;
}
</style>
<?php 
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header', 'admin');
?>
<div id="closeParentTime" style="display:none"></div>
<form name="search" action="?m=community&c=communityshare&a=community_share_list&search=yes" method="post">
	<div class='menu-content'>
		<label>发布日期：</label><?php echo form::date('start_time',$_GET['start_time'],0,0,'false');?><span class='brv'>-</span><?php echo form::date('end_time',$_GET['end_time'],0,0,'false');?>
		<!--<label>标签：</label> <input name="tag_name" type="text" id="tag_name" />-->
		<label>发布者：</label> <input name="nickname" type="text" id="nickname"  value="<?php echo $nickname;?>"/>
		<label>分享类别：</label>
		<select name="file_type" id="file_type">
			<option value="all">全部</option>
			<option value="1">图片</option>
			<option value="2">视频</option>
			<option value="3">商品</option>
		</select>
		<label>来源：</label>
		<select name="file_state" id="file_state">
			<option value="all">全部</option>
			<option value="1">上传</option>
			<option value="2">网址采集</option>
			<option value="3">转藏</option>
		</select>
		<br />
		<label>分类：</label>
		<select name="file_class" id="file_class">
		<option value="all">全部</option>
		 <?php foreach($getClassListcontent as $r) { ?>
			<option value="<?php echo $r['name']?>"><?php echo $r['name']?></option>
		<?php }?>
		</select>
		<label>喜欢数大于：</label> <input name="likecount" type="text" id="likecount" />
		<label>转藏数大于：</label> <input name="collectcount" type="text" id="collectcount" />
		<label>评论数大于：</label> <input name="replycount" type="text" id="replycount" />
		<br />
		<label>置顶：</label>
		<select name="file_top" id="file_top">
			<option value="all">全部</option>
			<option value="3">首页置顶</option>
			<option value="2">分类置顶</option>
			<option value="1">全局置顶</option>
		</select>
		推荐：<input type="checkbox" name="file_recommend" value="1" />
		<label>审核状态：</label>
		<select name="status" id="status">
			<option value="all">全部</option>
			<option value="0">未审核</option>
			<option value="99">已审核并通过</option>
			<option value="98">已审核不通过</option>
			<option value="97">系统拦截过滤</option>
		</select>
		<label>内容描述或关键词：</label>
		<input name="description" type="text" id="description" />
		<input type="submit" class='button' name="Submit" value="搜索" />
		<!--<a href="?m=community&c=communitalbum&a=community_album_position&is_pos=all">分享评论管理</a>-->
	</div>
</form>
<form id='myform' name="myform" action="?m=community&c=communityshare&a=community_status_share" method="post">
<div class="pad_10">
	<div class="table-list">
		<table class='ui-table' width="100%" cellspacing="0" >
			<thead>
				<tr>
					<th width="2%"><input type="checkbox" id="checked-all" /></th>
					<th width="2%">ID</th>
					<th width="3%">&nbsp;</th>
					<th width="8%">尺寸</th>
					<th width="4%">描述</th>
					<th width="5%">标签</th>
					<th width="6%">作者</th>
					<th width="8%">出自专辑</th>
					<th width="9%">所属分类</th>
					<th width="6%">类别</th>
					<th width="8%">来源</th>
					<th width="5%">喜欢</th>
					<th width="5%">转藏</th>
					<th width="9%">分享评论</th>
					<th width="6%">发布时间</th>
					<th width="8%">处理状态</th>
					<th width="10%">操作</th>
				</tr>
	        </thead>
		    <tbody>
		    <?php foreach($arr as $r) { ?>
				<tr>
					<td align="center"><input name="shareid[]" type="checkbox" class='shareid' id="shareid[]" value="<?php echo $r['id']?>" /></td>
					<td align="center"><?php echo $r['id']?></td> 
					<td align="center"><img class='img-preview' src="<?php echo $r['small']?>" rel="<?php echo $r['file_path']?>" width="55" height="55"></td>
					<td align="center">图宽<?php echo $r['thumb_parameter']?></td>
					<td class='desc' align="center" width='50'><p><?php echo $r['description']?><p></td>
					<td align="center"><?php for($i=0;$i<count($r['tags']);$i++){echo $r['tags'][$i]['name']."&nbsp;";}?></td>
					<td align="center"><?php echo $r['nickname']?></td>
					<td align="center"><?php echo $r['album_name']['-msg-']['arr'][0]['album_name']?></td>
					<td align="center"><?php echo $r['class_name']?></td>
					<td align="center"><?php if($r['file_type']==1){echo "图片";}elseif($r['file_type']==2){echo "视频";}elseif($r['file_type']==3){echo "商品";}?></td>
					<td align="center"><?php if($r['file_state']==1){echo "上传";}elseif($r['file_state']==2){echo "网址采集";}elseif($r['file_state']==3){echo "转藏";}?></td>
					<td align="center"><?php echo $r['be_like_count']?></td>
					<td align="center"><?php echo $r['be_collect_count']?></td>
					<td align="center" style="text-decoration: underline;"><a href="?m=community&c=communityshare&a=community_reply_share&shareid=<?php echo $r['id']?>">(<?php echo $r['be_reply_count']?>)</a></td>
					<td align="center"><?php echo $r['input_time']?></td>
					<td align="center"><?php if($r['status']==0){echo '<img src="/statics/images/myshow/status_0.gif " wide="24" height="24">';}elseif($r['status']==98){echo '<img src="/statics/images/myshow/status_98.gif" wide="24" height="24">';}elseif($r['status']==99){echo '<img src="/statics/images/myshow/status_99.gif " wide="24" height="24">';}elseif($r['status']==97){echo '<img src="/statics/images/myshow/status_97.png " wide="24" height="24">';}?></td>
					<td align="center"> <a href="javascript:;" onclick="data_delete(this,'<?php echo $r['id']?>','<?php echo $r['uid']?>','您确定要删除此分享！此操作不可恢复！')"><?php echo L('delete')?></a> | <a target="_blank" href="?m=community&c=myhuoshow&a=myshare&myuid=<?php echo $r['uid']?>">查看</a> | <?php if($r['file_recommend']==1){echo "<a class='action-recommend' href='javascript:;' data-cancel='?m=community&c=communityshare&a=community_file_recommend&file_recommend=1&id=$r[id]' data-set='?m=community&c=communityshare&a=community_file_recommend&file_recommend=0&id=$r[id]'>取消推荐</a>";}else{echo "<a class='action-recommend' href='javascript:;' data-cancel='?m=community&c=communityshare&a=community_file_recommend&file_recommend=1&id=$r[id]' data-set='?m=community&c=communityshare&a=community_file_recommend&file_recommend=0&id=$r[id]'>推荐</a>";}?> | <?php if($r['top']==0){echo "<a href="."javascript:edit('$r[id]','分享置顶')".'>置顶</a>';}else{echo "<a href="."?m=community&c=communityshare&a=community_status_share&onestates=yes&shareid=".$r[id].'>取消置顶</a>';}?></td>
				</tr>
			<?php }?>
			</tbody>
	    </table>
	    <!-- >div class="btn"><input type="submit" class="button" name="dosubmit" value="<?//php echo L('listorder')?>" /></div-->  </div>
			<div class="btn" style='padding:4px 6px;'>
				<label for="checked-all">全选/取消</label>
				<input name="states" type="submit" class='button' id="states1" value="通过" />
				<input name="states" type="submit" class='button' id="states0" value="不通过" />
				<input name="states" type="submit" class='button' id="" value="通过并推荐" />
				<input name="states" type="submit" class='button' id="js-set-top" value="置顶操作" />
				<input name="states" type="submit" class='button' id="" value="取消推荐" />
				<input name="states" type="submit" class='button' id="" value="取消置顶" />
				<!-- <input name="states" type="submit" class='button' onclick="data_delete(this,'<?php echo $r['id']?>','<?php echo $r['uid']?>','您确定要删除此分享！此操作不可恢复！')" id="states-del" value="删除" /> -->
				<input name="states" type="submit" class='button' id="states-del" value="删除" />
			</div>

		<div ><?php echo $page_str;?></div>
  </div>
</div>
<label>
</label>
</form>
<!-- <script type="text/javascript" src="<?php echo JS_PATH?>jquery.form.js"></script> -->
<script type="text/javascript"> 
<!--
window.top.$('#display_center_id').css('display','none');
/*function edit(id, name) {
	window.top.art.dialog({id:'edit'}).close();
	window.top.art.dialog({title:'修改专辑《'+name+'》',id:'edit',iframe:'?m=community&c=communitalbum&a=community_edit_album&typeid='+id,width:'540',height:'200'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
}*/
function edit(id, name) {
	window.top.art.dialog({id:'edit'}).close();
	window.top.art.dialog({title:'置顶操作《'+name+'》',id:'edit',iframe:'?m=community&c=communityshare&a=community_top_share&top=yes&typeid='+id,width:'540',height:'150'}, function(){var d = window.top.art.dialog({id:'edit'}).data.iframe;d.document.getElementById('dosubmit').click();return false;}, function(){window.top.art.dialog({id:'edit'}).close()});
}
function data_reply(id, name) {
	window.top.art.dialog({id:'reply'}).close();
	window.top.art.dialog({title:'评论管理《'+name+'》',id:'reply',iframe:'?m=community&c=communitalbum&a=community_reply_album&typeid='+id,okVal:'关闭',width:'540',height:'200'},function(){window.top.art.dialog({id:'reply'}).close()});
}
function data_delete(obj,id,uid,name){
	window.top.art.dialog({content:name, fixed:true, style:'confirm', id:'data_delete'}, 
	function(){
	$.get('?m=community&c=communityshare&a=community_delete_share&typeid='+id+'&uid='+uid+'&pc_hash='+pc_hash,function(data){
				if(data) {
					$(obj).parent().parent().fadeOut("slow");
				}
			}) 	
		 }, 
	function(){});
};

// 设置 / 取消推荐
$('.action-recommend').click(function(){
	var $ths = $(this);
	if($ths.text() == '取消推荐'){
		$.get($ths.attr('data-cancel'), function(d){
			if(d == 1){
				$ths.text('推荐');
			}else{
				alert('出错了，请联系网站管理员！');
			}
		});
	}else{
		$.get($ths.attr('data-set'), function(d){
			if(d == 1){
				$ths.text('取消推荐');
			}else{
				alert('出错了，请联系网站管理员！');
			}
		});
	}
	return false;
});

// 预览大图
$.getScript('/statics/js/jquery-powerFloat-min.js', function(){
	$('.img-preview').powerFloat({ 
		targetMode: "ajax",
		//width: '300px',
		hoverFollow: "y",
		hoverHold: false,
		position: "6-8"
	});
});

// 批量置顶
$('#js-set-top').click(function(){
	var ids = [];
	$('input.shareid:checked').each(function(){
		ids.push(this.value);
	});
	edit(ids, '批量');
	return false;
});

// 批量删除
$("#states-del").click(function() {
	$ths = $(this);
	window.top.art.dialog({
		content: '您确定要删除此分享！此操作不可恢复！', 
		fixed: true, 
		style: 'confirm', 
		id: 'data_delete'
	}, function() {
		//$("#myform").ajaxSubmit();
		$ths.unbind('click').click();
	}, function() {});
	return false;
});

//选择全部分享
var $checked_all = $('#checked-all'),
	$checkbox_shareid = $('.shareid:checkbox');
$checked_all.click(function(){//全选
	$checkbox_shareid.attr("checked", this.checked);
});
$checkbox_shareid.click(function(){//改变选择按钮的选择状态
	var $temp = $('.shareid:checkbox');
	//用filter方法筛选出选中的复选框。并直接给 $checked_all 赋值。
	$checked_all.attr('checked', $checkbox_shareid.length == $checkbox_shareid.filter(':checked').length);
});
//-->
</script>