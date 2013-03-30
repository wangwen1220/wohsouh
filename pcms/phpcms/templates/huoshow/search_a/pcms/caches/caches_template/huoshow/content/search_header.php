<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><form action="<?php echo APP_PATH;?>index.php" id="search" method="get" target="_blank" onsubmit="return checkSForm()">
	<input type="hidden" name="m" value="search" /> 
	<input type="hidden" name="c" value="index" /> 
	<input type="hidden" name="a" value="init" />
	<input type="hidden" name="siteid" value="<?php echo $siteid;?>" id="siteid" /> 
	<input type="text" class="text" name="q" id="q" value="请输入关键字" onfocus="clearKeyword()" onblur="clearKeyword()"/>
	<?php $search_model = getcache('search_model_'.$siteid,'search');?>  
	<select name="typeid" id="search_type">
		<option value="1" >全部</option>
		<?php $n=1;if(is_array($search_model)) foreach($search_model AS $k=>$v) { ?> 
		<option value="<?php echo $v['typeid'];?>" ><?php echo $v['name'];?></option>
		<?php $n++;}unset($n); ?>
	</select>
	<input type="submit" id="search_submit" value="搜 索" />
</form>
<script>
	$(function(){
		window.clearKeyword = function(){
			var search_wd = $.trim($("#q").val());
			if(search_wd=='请输入关键字'){
				$("#q").val('');
			}
			if(search_wd==''){
				$("#q").val('请输入关键字');
			}
		}
		window.checkSForm = function()
		{
			var search_wd = $.trim($("#q").val());
			if(search_wd=='请输入关键字' || search_wd==''){
				alert('请输入关键字');
				return false;
			}
		}
	})
</script>