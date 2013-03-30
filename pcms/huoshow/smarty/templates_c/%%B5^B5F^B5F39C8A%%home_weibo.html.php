<?php /* Smarty version 2.6.26, created on 2012-04-06 11:01:31
         compiled from home/home_weibo.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "home/home_weibo_header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="conM" style="width:545px; margin:0px;">
	<?php if ($this->_tpl_vars['lists'] == 1 || $this->_tpl_vars['lists'] == 2): ?>
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/weibo/weibo_user_send_dynamic.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<?php endif; ?>
	<article>
		<div class="userBar font12">
			<?php if ($this->_tpl_vars['lists'] == 1): ?> 
				<a class="selectedFont">全部动态</a> | 
				<a href="home.php?mod=huoshow&do=weibo&list=2">我的微博</a> | 
				<a href="home.php?mod=huoshow&do=weibo&list=3">我的消息</a> |
				<a href="home.php?mod=huoshow&do=weibo&list=4">随便看看</a>
			<?php elseif ($this->_tpl_vars['lists'] == 2): ?> 
				<a href="home.php?mod=huoshow&do=weibo&list=1">全部动态</a> | 
				<a class="selectedFont">我的微博</a> | 
				<a href="home.php?mod=huoshow&do=weibo&list=3">我的消息</a> |
				<a href="home.php?mod=huoshow&do=weibo&list=4">随便看看</a>
			<?php elseif ($this->_tpl_vars['lists'] == 3): ?>
				<a href="home.php?mod=huoshow&do=weibo&list=1">全部动态</a> | 
				<a href="home.php?mod=huoshow&do=weibo&list=2">我的微博</a> | 
				<a class="selectedFont">我的消息</a> |
				<a href="home.php?mod=huoshow&do=weibo&list=4">随便看看</a>
			<?php else: ?>
				<a href="home.php?mod=huoshow&do=weibo&list=1">全部动态</a> | 
				<a href="home.php?mod=huoshow&do=weibo&list=2">我的微博</a> | 
				<a href="home.php?mod=huoshow&do=weibo&list=3">我的消息</a> |
				<a class="selectedFont">随便看看</a>
			<?php endif; ?>
		</div>
		<div class="wb_info">
			<?php if ($this->_tpl_vars['lists'] == 1): ?>  
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "weibo/weibo_user_all_dynamic.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php elseif ($this->_tpl_vars['lists'] == 2): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "weibo/weibo_user_dynamic.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php elseif ($this->_tpl_vars['lists'] == 3): ?>
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/home/home_weibo_user_message.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

			<?php else: ?>
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/home/home_weibo_all_sys_dynamic.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

			<?php endif; ?>
		</div>
	</article>
</div>


<div class="conR">
	<!-- 微博统计信息 -->
  	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/home/home_weibo_user_info.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<!-- 可能感兴趣的人 -->
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/home/home_weibo_recommend.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

	<!-- 人气用户推荐 -->
	<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/home/home_weibo_hotrecommend.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

</div>
