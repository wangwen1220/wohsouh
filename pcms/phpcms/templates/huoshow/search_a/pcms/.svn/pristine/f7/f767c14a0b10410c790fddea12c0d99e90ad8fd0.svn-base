<form id='myform' name="myform" action="?m=gamenum&c=gamenum&a=addgame&add=yes" method="post">
<input type="text" name="gamename">
<input style='display: none' type="submit" name="Submit" id='dosubmit' value="提交">
请关联专题：<select name="specialid" ><?php for($i=0;$i<count($specilainfo);$i++){echo "<option value=".$specilainfo[$i]["id"].">".$specilainfo[$i]["title"]."</option>";}?></select>
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