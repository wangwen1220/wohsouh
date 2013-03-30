<?php
defined('IN_ADMIN') or exit('No permission resources.');
include $this->admin_tpl('header');?>
<script language="javascript" type="text/javascript" src="<?php echo JS_PATH?>position_select.js"></script>
<table border="0" cellspacing="0" cellpadding="0" style="margin:5px;">
	<tr>
		<td height="30">
		<form action="/index.php?m=admin&c=position&a=selectInfoToRecommend&pid=<?php echo $pid?>&pc_hash=<?php echo $_SESSION["pc_hash"]?>" id="search" method="post">
			<div class='select_top'>
				<input name="key" type="text" id="key" />
				<select name="catinfo" id="catinfo">
					<?php echo $string; ?>
				</select>
				<select name="modelinfo" id="modelinfo">
					<option value="0">所有模型</option>
					<?php for($i=0;$i<count($model_arr);$i++) { ?>
					<option value="<?php echo $model_arr[$i][id]?>"><?php echo $model_arr[$i][name]?></option>
					<?php } ?>
				</select>
				<select name="article_type" id="article_type" style='display:none'>
					<option value="0">所有</option>
					<option value="1">文章</option>
					<option value="2">组图</option>
					<option value="3">图库</option>
				</select>
				<input name="dosubmit_fiter" type="submit" id="dosubmit_fiter" value="提交" />
			</div>
		</form>
		</td>
	</tr>
	<tr>
		<td>
			<table  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td class='select_td'><h3 class="layout"><span class="f_l">待选(<span id="total">0</span>)</span></h3>
						<div id='select_box_left' class='select_box'>
							<ul>
							<?php for($i=0;$i<count($dataarr);$i++) {?>
								<li>
									<input id="select_id_<?php echo $dataarr[$i][id]?>" name="select_id[]?>" type="checkbox" value="<?php echo $dataarr[$i][id]?>" />
									<span style="color:#999999"><?php echo $dataarr[$i][catname]?></span>&nbsp;&nbsp;<a title="<?php echo new_html_special_chars($dataarr[$i][title])?>" href="<?php echo $dataarr[$i][url]?>" target="_blank"><?php echo str_cut($dataarr[$i][title],40)?></a> </li>
								<?php }?>
							</ul>
						</div>
					</td>
					<td width="30" align="center" valign="middle"><img src="/statics/images/common/move_left.gif" /></td>
					<td class='select_td'>
					<form id="batch_send_recommend" name="batch_send_recommend" action="/index.php?m=admin&c=position&a=batch_send_recommend&pid=<?php echo $pid?>&pc_hash=<?php echo $_SESSION["pc_hash"]?>" method="post">
					<input type="hidden" id="pos_id" name="pos_id" value="<?php echo $pid ?>" />
						<h3>已选(<span id="checked_count">0</span>)</h3>
						<div id='select_box_right' class='select_box'>
							<ul>
							</ul>
						</div>
						<div class="bk15"></div>
    <input name="dosubmit" type="submit" value="<?php echo L('submit')?>" class="dialog" id="dosubmit">
					</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
