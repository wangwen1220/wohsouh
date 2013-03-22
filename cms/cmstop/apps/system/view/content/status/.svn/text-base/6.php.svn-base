	<div id="published_x" class="th_pop" style="display:none;width:150px">
     <div>
        <a href="javascript: tableApp.load('published_min=<?=date('Y-m-d', TIME)?>');">今日</a> |
        <a href="javascript: tableApp.load('published_min=<?=date('Y-m-d', strtotime('yesterday'))?>&published_max=<?=date('Y-m-d', strtotime('yesterday'))?>');">昨日</a> | 
        <a href="javascript: tableApp.load('published_min=<?=date('Y-m-d', strtotime('last monday'))?>');">本周</a> | 
        <a href="javascript: tableApp.load('published_min=<?=date('Y-m-01', strtotime('this month'))?>');">本月</a>
     </div>
     <ul>
       <?php 
       for ($i=2; $i<=7; $i++) { 
       	  $publishdate = date('Y-m-d', strtotime("-$i day"));
       ?>
        <li><a href="javascript: tableApp.load('published_min=<?=$publishdate?>&published_max=<?=$publishdate?>');"><?=$publishdate?></a></li>
       <?php } ?>
     </ul>
  </div>
  <div id="weight_x" class="th_pop" style="display:none;width:60px">
     <ul>
        <li><a href="javascript: tableApp.load('weight_min=0&weight_max=29');">0-29</a></li>
        <li><a href="javascript: tableApp.load('weight_min=30&weight_max=49');">30-49</a></li>
        <li><a href="javascript: tableApp.load('weight_min=50&weight_max=59');">50-59</a></li>
        <li><a href="javascript: tableApp.load('weight_min=60&weight_max=69');">60-69</a></li>
        <li><a href="javascript: tableApp.load('weight_min=70&weight_max=79');">70-79</a></li>
        <li><a href="javascript: tableApp.load('weight_min=80&weight_max=89');">80-89</a></li>
        <li><a href="javascript: tableApp.load('weight_min=90&weight_max=100');">90-100</a></li>
     </ul>
  </div>
  <div id="publishedby_x" class="th_pop" style="display:none;width:150px">
     <input type="text" id="publishedbyname" size="12" /> <input type="button" value="查询" onclick="tableApp.load('publishedbyname='+$('#publishedbyname').val());"/>
  </div>
  <table width="98%" cellpadding="0" cellspacing="0" id="item_list" class="tablesorter table_list mar_l_8">
    <thead>
      <tr>
        <th width="30" class="t_l bdr_3"><input type="checkbox" id="check_all" class="checkbox_style"/></th>
        <th>标题</th>
        <th width="80">管理操作</th>
        <th width="60" class="ajaxer"><div name="pv">点击</div></th>
        <th width="60" class="ajaxer"><em class="more_pop" name="weight_x"></em><div name="weight">权重</div></th>
        <th width="80" class="ajaxer"><em class="more_pop" name="publishedby_x"></em><div name="publishedby">发布人</div></th>
        <th width="120" class="ajaxer"><em class="more_pop" name="published_x"></em><div name="published">发布时间</div></th>
      </tr>
    </thead>
    <tbody id="list_body">
    </tbody>
  </table>
  <div class="table_foot">
    <div id="pagination" class="pagination f_r"></div>
    <p class="f_l">
<?php if ($_roleid < 3) {?>
	  <input type="button" onclick="tableApp.load();return false;" value="刷新" class="button_style_1"/>
	  <input type="button" onclick="content.section();" value="推荐" class="button_style_1"/>
	  <input type="button" onclick="content.forward();" value="转发" class="button_style_1"/>
	  <input type="button" onclick="content.move();" value="移动" class="button_style_1"/>
      <input type="button" onclick="content.reference();" value="引用" class="button_style_1"/>
      <input type="button" onclick="content.remove();" value="删除" class="button_style_1"/>
      <input type="button" onclick="content.createhtml();" value="生成" class="button_style_1"/>
      
      
      
      
<?php }?>
    </p>
  </div>

		
<script type="text/javascript">
var row_template = '<tr id="row_{contentid}" right_menu_id="right_menu_{modelalias}" modelid="{modelid}" model="{modelalias}">\
                	    <td><input type="checkbox" class="checkbox_style" name="chk_row" id="chk_row_{contentid}" value="{contentid}" /></td>\
	                	<td><a title="查看内容" href="javascript:content.view({contentid});"><div class="icon {modelalias}"></div></a><?php if(!empty($childids)):?><a href="javascript: content.category({catid});" class="c_blue">[{catname}]</a> <?php endif?>{thumb_icon}<a href="javascript:;" onclick="content.edit({contentid});" style="color:{color}" tips="ID：{contentid}<br />点击：{pv}次<br />评论：{comments}条<br />来源：{source_name}<br />Tags：{tags}<br />创建：{createdbyname}（{created}）<br />修改：{modifiedbyname}（{modified}）<br />审核：{checkedbyname}（{checked}）" class="title_list">{title}</a> {note} {lock}</td>\
	                 	<td class="t_c"><a href="{url}" target="_blank"><img src="images/view.gif" alt="访问" width="16" height="16" /></a> &nbsp;<img src="images/edit.gif" alt="编辑" width="16" height="16" class="hand edit"/> &nbsp;<img src="images/delete.gif" alt="删除" width="16" height="16" class="hand delete" /></td>\
	                	<td class="t_r">{pv}</td>\
	                	<td class="t_r">{weight}</td>\
	                	<td class="t_c"><a href="javascript: url.member({publishedby});">{publishedbyname}</a></td>\
	                	<td class="t_c">{published}</td>\
	                </tr>';
</script>