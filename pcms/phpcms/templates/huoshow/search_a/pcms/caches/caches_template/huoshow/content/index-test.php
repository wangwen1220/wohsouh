<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8' />
	<title><?php if(isset($SEO['title']) && !empty($SEO['title'])) { ?><?php echo $SEO['title'];?><?php } ?> 火秀网</title>
	<meta name="keywords" content="<?php echo $SEO['keyword'];?>">
	<meta name="description" content="<?php echo $SEO['description'];?>">
	<meta name='author' content='火秀网' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
	<link href='<?php echo CSS_PATH;?>hs-game-android.css' rel='stylesheet' />
	<link href='http://www.huoshow.com/favicon.ico' rel='icon' />
</head>

<body class='game-android'>
	<?php include template('content', 'hs_topbar'); ?>
	<?php include template('content', 'game_header_android'); ?>

	<!-- 安卓游戏 -->
	<div id='content-android-game' class='ui-box ui-box-android-app fn-clear'>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=8cc188b9575cd9931ccb31a3f3ded725&action=position&posid=366&order=listorder+DESC&num=20\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'366','order'=>'listorder DESC','limit'=>'20',));}?>
		<ul class='ui-art-list ui-art-list-game fn-clear'>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class='ui-art-item'>
				<h3 class='title'><?php echo $r['title'];?></h3>
				<div class="content"><p><?php echo $r['description'];?></p></div>
				</li>
			<?php $n++;}unset($n); ?>
		</ul>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	</div>


	<!-- 此脚本最好放底部，不然在 IE6 中可能会有兼容问题 -->
	<script src='<?php echo JS_PATH;?>seajs/sea.js' id='seajsnode' data-main='hs-game-main'></script>
	<?php include template('content', 'hs_footer'); ?>
</body>
</html>