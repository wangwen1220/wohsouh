<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
	<title>Huoshow主播端</title>
	<script type="text/javascript" src="swfobject.js"></script>
</head>

<form action="http://space.beta.huoshow.com/api/avatar.php" method="POST" enctype="multipart/form-data">
<td style="text-align:right;">图片：</td>
<td><input type="file" name="image" value="" size="30" />
<input type="submit"/>
</td>
</form>

<body>
	<div>	
		<object id="myId" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="480" height="360">
			<param name="movie" value="Server.swf" />
    		<!--[if !IE]>-->
			<object type="application/x-shockwave-flash" data="Server.swf" width="480" height="360">
			<!--<![endif]-->
			<div>
				<h1>Alternative content</h1>
				<p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
			</div>
			<!--[if !IE]>-->
			</object>
			<!--<![endif]-->
		</object>
	</div>
</body>
</html>