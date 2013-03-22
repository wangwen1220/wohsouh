<div class="bk_8"></div>
<form name="<?=$controller?>_form" id="<?=$controller?>_form" method="POST" action="?app=<?=$app?>&controller=<?=$controller?>&action=<?=$action?>">
	<input type="hidden" name="sectionid" value="<?=$sectionid?>"/>
	<table width="98%" border="0" cellspacing="0" cellpadding="0" class="table_form">
		<tr>
			<th width="90"><span class="c_red">*</span> 名称：</th>
			<td><input type="text" name="name" id="name" value="<?=$name?>" size="30"/> <span class="c_red">*</span></td>
		</tr>
		<tr>
			<th><img align="absmiddle" tips="代码:静态html代码<br/>自动:自动获取/更新数据<br/>推荐位：需要手工推荐" class="tips hand" src="images/question.gif"/><span class="c_red">*</span> 类型：</th>
			<td>
				<input type="radio" name="type" value="html" <?php if($type=='html') echo 'checked';?>/> 代码
				<input type="radio" name="type" value="auto" <?php if($type=='auto') echo 'checked';?>/> 自动
				<input type="radio" name="type" value="commend" <?php if($type=='commend') echo 'checked';?>/> 推荐位
			</td>
		</tr>
		<tr>
			<th><img align="absmiddle" tips="代码:静态html代码<br/>自动:自动获取/更新数据<br/>推荐位：需要手工推荐" class="tips hand" src="images/question.gif"/><span class="c_red">*</span> 分类：</th>
			<td>
				<select name="classid">
				<?php foreach ($class AS $r): ?>
					<option value="<?php echo $r['classid']?>"><?php echo $r['name']?></option>
				<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr class="auto">
			<th><img align="absmiddle" tips="自动区块由计划任务定时刷新内容,设为0则不更新" class="tips hand" src="images/question.gif"/><span class="c_red">*</span> 更新频率：</th>
			<td><input type="text" name="frequency" id="frequency" value="<?=$frequency?>" size="5"/></td>
		</tr>
		<tr class="commend">
			<th><img align="absmiddle" tips="当超过此数目时自动挤下最下方的内容，设为0则不限制" class="tips hand" src="images/question.gif"/><span class="c_red">*</span> 条数：</th>
			<td><input type="text" name="num" id="num" value="<?=$num?>" size="5"/></td>
		</tr>
		<tr>
			<th valign="top">
				<br/>
				<img align="absmiddle" tips="
								  推荐位：在loop循环中可使用字段如下<br/>
								  序号: {$i}或者{($i+1)}<br/>
								  内容ID: $r[contentid]:<br/>
								  标题: $r[title]<br/>
								  作者ID: $r[createdby]<br/>
								  作者名: $r[createdby_user]<br/>
								  链接: $r[url]<br/>
								  缩略图: $r[thumb]<br/>
								  颜色: $r[color]<br/>
								  描述: $r[description]<br/>
								  时间: $r[created_str](格式:2010-01-01 12:30)<br/>
								  时间戳: $r[created]<br/>"
				class="tips hand" src="images/question.gif"/><span class="c_red">*</span> 模板：
			</th>
			<td><textarea id="hidecode" style="display:none" name="data"><?=$data?></textarea><textarea id="codeEd" wrap="off" style="display:none"><?=$data?></textarea><textarea id="htmlEd" style="display:none"><?php if($type=="html") echo $data; ?></textarea></td>
		</tr>
		<tr>
			<th valign="top"> 备注：</th>
			<td><textarea id="memo" name="memo" style="width:490px;"><?=$memo?></textarea></td>
		</tr>
	</table>
</form>
<script type="text/javascript">
//初始代码
var codeEditor = null,
	defaultData = {
	commend: '<ul>\n\
{loop $data $i $r}\n\
    <li>\n\
    {if $r[color]}\n\
    	<a href="{$r[url]}" style="color:{$r[color]};">{$r[title]}<span>({date("y-m-d H:i", $r[created])})</span></a>\n\
    {else}\n\
    	<a href="{$r[url]}">{$r[title]}<span>({date("y-m-d H:i", $r[created])})</span></a>\n\
    {/if}\n\
    </li>\n\
{/loop}\n\
</ul>\n',
	auto: '{content modelid="1" orderby="published desc" size="10"}\n\
{$r[title]},{$r[color]},{$r[thumb]},{$r[url]},{date("Y-m-d H:i", $r[published])}\n\n\
{/content}\n',
	html: '这儿输入html代码'
};
$(function (){
	$('.tips').attrTips('tips', 'tips_green', 200, 'top');
	var type = '<?=$type?>';
	var sectionid = '<?=$_GET['sectionid']?>';
	$('select[name=classid]').val(<?=$classid?>);
	
	$('input[name=type]').click(function (){
		if(this.value == 'html'){
			if(tinyMCE.editors.htmlEd)
			{	
				tinyMCE.editors.htmlEd.show();
			}else initHtmlEd();
			codeEditor && codeEditor.hide();
			$('tr.auto,tr.commend').hide();
		}else{
			if(this.value == 'auto') {
				$('tr.auto').show();
			}else {
				$('tr.auto').hide();
			}
			if(this.value == 'commend')
			{
				$('tr.commend').show();
			}else{
				$('tr.commend').hide();
			}
			if(tinyMCE.get('htmlEd')) {
				tinyMCE.get('htmlEd').hide();
				$('#htmlEd').hide();
			}
			codeEditor ? codeEditor.show() : initCodeEd();
		}
		//添加区块时，原始代码填充
		if(sectionid == '' && '<?=$_GET['src']?>' != 'tpl')
		{
			$('#codeEd').val(defaultData[this.value]);
		}
	});
	$('tr.'+type).show();
	type == 'html'?initHtmlEd():initCodeEd();
});

function initCodeEd(){
	$('#codeEd').show();
	setTimeout(function(){
		codeEditor =  $('#codeEd').editplus({
			buttons:'fullscreen,wrap,|,db,content,discuz,|,loop,ifelse,elseif,template,|,preview,section,clip',
			width: 500,
			height: 200
		});
	}, 0);
}
function initHtmlEd(){
	$('#htmlEd').html()=='' && $('#htmlEd').html(defaultData.html);
	
	$('#htmlEd').show();
	setTimeout(function(){
		$('#htmlEd').editor('section', {width:"500",height:"200",forced_root_block : ''});
	}, 0);
}

</script>