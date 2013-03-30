<form action='?m=gamenum&c=gamenum&a=addgamenum&add=yes' method='post' enctype='multipart/form-data' id='myform'>
<input type='file'  name='myfile' size='34' />
<input style='display: none' type='submit' value='上 传' name='submit' id='dosubmit' class='button' />
<input name="gameid" type="hidden" value="<?php echo $gameid;?>" />
</form>
</form>
<script type="text/javascript" src="<?php echo JS_PATH?>jquery.min.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH?>jquery.form.js"></script>
<script type="text/javascript">
	$('#myform').ajaxForm({
		success: function() {
			window.top.art.dialog({id:'edit'}).close();
			window.top.frames.right.location.reload();
		}
	});
</script>