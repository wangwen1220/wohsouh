<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!-- Topbar -->
<div id='topbar' class="fn-clear">
	<div class="nav"><a target="_blank" href="http://www.huoshow.com">首页</a>-<a target="_blank" href="<?php echo APP_PATH;?>star/">明星</a>-<a target="_blank" href="<?php echo APP_PATH;?>movie/">电影</a>-<a target="_blank" href="<?php echo APP_PATH;?>tv/">电视</a>-<a target="_blank" href="<?php echo APP_PATH;?>music/">音乐</a>-<a target="_blank" href="<?php echo APP_PATH;?>supermodel/">超模</a>-<a target="_blank" href="<?php echo APP_PATH;?>events/">赛事</a>-<a target="_blank" href="http://game.huoshow.com/">游戏</a>-<a target="_blank" href="<?php echo APP_PATH;?>pic/">美图</a>-<a target="_blank" href="http://myshow.huoshow.com">我秀</a></div>
	<div id="login-bar" class="login-bar" data-url='http://<?php global $SYSCONFIG;echo $SYSCONFIG["SpaceSiteRoot"]?>/api/login.php?jsoncallback=?'></div>
</div>
<!-- Topbar End -->