<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><div style="width:600px; white-space:nowrap;" id="css_select_content" overflow:auto;>
<?php $n=1; if(is_array($arr)) foreach($arr AS $r => $v) { ?>
	<div style="width:100px; min-height:100px; float:left; margin:5px; margin-right:10px; padding:3px; border:#999999 solid 1px;">
	<div style="background-image:url(<?php echo CSS_PATH;?>special/thumb/<?php echo $v['thumb'];?>);width:100px; height:100px;">
		<input type="radio" name="cssfile" value="<?php echo $v['css'];?>" <?php if($css_file==$v[css]) { ?> checked="checked"<?php } ?>>
	</div>
	<div style="min-height:20px; text-align:center;"><?php echo $v['descript'];?></div>
	</div>
	
<?php $n++;}unset($n); ?>
</div>
