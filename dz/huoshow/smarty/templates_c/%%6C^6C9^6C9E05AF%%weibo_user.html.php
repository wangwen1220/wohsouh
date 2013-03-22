<?php /* Smarty version 2.6.26, created on 2012-03-27 10:32:08
         compiled from weibo/weibo_user.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "home/home_weibo_header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="wbCon">
	<div class="conL">
		<div class="userPhoto">
			<?php if ($this->_tpl_vars['user']['uid'] == $this->_tpl_vars['room_uid']): ?>
			<span><img src="<?php echo $this->_tpl_vars['user_info_arr'][0]['head_img_url']; ?>
" /></span>
			<?php else: ?>
			<span><img src="<?php echo $this->_tpl_vars['user_info_arr'][0]['head_img_url']; ?>
" /></span>
			<?php endif; ?>
		</div>
		<ul class="userMenu">
			<?php if ($this->_tpl_vars['user']['uid'] == $this->_tpl_vars['room_uid']): ?>
			<li><span><a
					href="/home.php?mod=huoshow&do=weibo_userfollow">关注(<?php if ($this->_tpl_vars['info_count'][0]['followCount']): ?><?php echo $this->_tpl_vars['info_count'][0]['followCount']; ?>
<?php else: ?>0<?php endif; ?>)</a></span></li>
			<li><span><a
					href="/home.php?mod=huoshow&do=weibo_user_fans">粉丝(<?php if ($this->_tpl_vars['info_count'][0]['beFollowCount']): ?><?php echo $this->_tpl_vars['info_count'][0]['beFollowCount']; ?>
<?php else: ?>0<?php endif; ?>)</a></span></li>
			 <?php else: ?>
			<li><span><a
					href="/show.php?mod=huoshow&module=weibo&op=user_userfollow&roomid=<?php echo $this->_tpl_vars['room_uid']; ?>
">关注(<?php if ($this->_tpl_vars['info_count'][0]['followCount']): ?><?php echo $this->_tpl_vars['info_count'][0]['followCount']; ?>
<?php else: ?>0<?php endif; ?>)</a></span></li>
			<li><span><a
					href="/show.php?mod=huoshow&module=weibo&op=user_fans_list&roomid=<?php echo $this->_tpl_vars['room_uid']; ?>
">粉丝(<?php if ($this->_tpl_vars['info_count'][0]['beFollowCount']): ?><?php echo $this->_tpl_vars['info_count'][0]['beFollowCount']; ?>
<?php else: ?>0<?php endif; ?>)</a></span></li>
			 <?php endif; ?>
		</ul>
	</div>
	<div class="conM">
		<?php if ($this->_tpl_vars['user']['uid'] == $this->_tpl_vars['room_uid']): ?>
		<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/weibo/weibo_user_send_dynamic.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		<?php endif; ?>
		<?php if ($this->_tpl_vars['user']['uid'] != $this->_tpl_vars['room_uid']): ?>
		<div style="height:30px;line-height:30px;">
			<span style="float:left;font-size:16px;font-weight:bold;"><?php echo $this->_tpl_vars['user_info_arr'][0]['nickname']; ?>
 的微博</span>
			<span style="float:right;">
				<?php if ($this->_tpl_vars['user']['uid'] != $this->_tpl_vars['room_uid']): ?> <?php if ($this->_tpl_vars['is_att'] != 1): ?>
			<a class="user"
				href="/huoshow/module/weibo/ajax/weibo_user_dynamic_ajax.php?tab=ajax_user_follow&dst_uid=<?php echo $this->_tpl_vars['user_info_arr'][0]['uid']; ?>
"
				onclick="<?php if ($this->_tpl_vars['user']['uid']): ?>showWindow('register', this.href)
						<?php else: ?>showWindow('login', 'member.php?mod=logging&action=login');<?php endif; ?>">
				加关注</a> <?php endif; ?> <?php endif; ?>
			</span>
		</div>
		<?php endif; ?>
		<div style="clear:both;"></div>
		<?php if ($this->_tpl_vars['user']['uid'] == $this->_tpl_vars['room_uid']): ?>
		<div class="userBar font12">
			<?php if ($this->_tpl_vars['lists'] == 1): ?> <a class="selectedFont">全部动态</a> | <a
				href="show.php?mod=huoshow&module=weibo&op=user&roomid=<?php echo $this->_tpl_vars['r_user_uid']; ?>
&list=2">我的微博</a>
			<?php else: ?> <a class="selectedFont">我的微博</a> | <a
				href="show.php?mod=huoshow&module=weibo&op=user&roomid=<?php echo $this->_tpl_vars['r_user_uid']; ?>
&list=1">全部动态</a>
			<?php endif; ?>
		</div>
		<div class="wb_info"><?php if ($this->_tpl_vars['lists'] == 1): ?> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "weibo/weibo_user_all_dynamic.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <?php else: ?> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "weibo/weibo_user_dynamic.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <?php endif; ?></div>
		<?php else: ?>
		<div class="userBar font12">
			<a class="selectedFont">他的微博</a>
		</div>
		<div class="wb_info"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "weibo/weibo_user_dynamic.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
		<?php endif; ?>
	</div>

	<aside>
		<div class="conR">
			<?php if ($this->_tpl_vars['user']['uid'] == $this->_tpl_vars['room_uid']): ?>
			<!-- 微博统计信息 -->
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/home/home_weibo_user_info.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

			<?php else: ?>
			<!-- 微博统计信息 -->
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/weibo/weibo_user_info.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
 
			<?php endif; ?>
			<div class="wbfans">
				<h3 class="font14">粉丝</h3>
				<ul class="clFrame">
					<?php unset($this->_sections['f']);
$this->_sections['f']['name'] = 'f';
$this->_sections['f']['loop'] = is_array($_loop=$this->_tpl_vars['fans']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['f']['show'] = true;
$this->_sections['f']['max'] = $this->_sections['f']['loop'];
$this->_sections['f']['step'] = 1;
$this->_sections['f']['start'] = $this->_sections['f']['step'] > 0 ? 0 : $this->_sections['f']['loop']-1;
if ($this->_sections['f']['show']) {
    $this->_sections['f']['total'] = $this->_sections['f']['loop'];
    if ($this->_sections['f']['total'] == 0)
        $this->_sections['f']['show'] = false;
} else
    $this->_sections['f']['total'] = 0;
if ($this->_sections['f']['show']):

            for ($this->_sections['f']['index'] = $this->_sections['f']['start'], $this->_sections['f']['iteration'] = 1;
                 $this->_sections['f']['iteration'] <= $this->_sections['f']['total'];
                 $this->_sections['f']['index'] += $this->_sections['f']['step'], $this->_sections['f']['iteration']++):
$this->_sections['f']['rownum'] = $this->_sections['f']['iteration'];
$this->_sections['f']['index_prev'] = $this->_sections['f']['index'] - $this->_sections['f']['step'];
$this->_sections['f']['index_next'] = $this->_sections['f']['index'] + $this->_sections['f']['step'];
$this->_sections['f']['first']      = ($this->_sections['f']['iteration'] == 1);
$this->_sections['f']['last']       = ($this->_sections['f']['iteration'] == $this->_sections['f']['total']);
?>
					<li><a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['fans'][$this->_sections['f']['index']]['uid']; ?>
"
						title="<?php echo $this->_tpl_vars['fans'][$this->_sections['f']['index']]['nickname']; ?>
"><img src="<?php echo $this->_tpl_vars['fans'][$this->_sections['f']['index']]['head_img_url']; ?>
"></a>
						<p>
							<a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['fans'][$this->_sections['f']['index']]['uid']; ?>
" title="<?php echo $this->_tpl_vars['fans'][$this->_sections['f']['index']]['nickname']; ?>
"
								class="uname"><?php echo $this->_tpl_vars['fans'][$this->_sections['f']['index']]['nickname']; ?>
</a>
						</p> <?php if ($this->_tpl_vars['user']['uid'] != $this->_tpl_vars['room_uid'] && $this->_tpl_vars['fans'][$this->_sections['f']['index']]['isfollow'] != 1): ?>
						<p>
							<a class="jsadd"
								href="/huoshow/module/weibo/ajax/weibo_user_dynamic_ajax.php?tab=ajax_user_follow&dst_uid=<?php echo $this->_tpl_vars['fans'][$this->_sections['f']['index']]['uid']; ?>
"
								onclick="<?php if ($this->_tpl_vars['user']['uid']): ?>showWindow('register', this.href)
						<?php else: ?>showWindow('login', 'member.php?mod=logging&action=login');<?php endif; ?>">
								+加关注</a>
						</p> <?php endif; ?> <?php endfor; endif; ?></li>
				</ul>
				<div class="clear"></div>
			</div>
			<div class="wbInter">
				<h3 class="font14">关注</h3>
				<ul class="clFrame">
					<?php unset($this->_sections['a']);
$this->_sections['a']['name'] = 'a';
$this->_sections['a']['loop'] = is_array($_loop=$this->_tpl_vars['follow']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['a']['show'] = true;
$this->_sections['a']['max'] = $this->_sections['a']['loop'];
$this->_sections['a']['step'] = 1;
$this->_sections['a']['start'] = $this->_sections['a']['step'] > 0 ? 0 : $this->_sections['a']['loop']-1;
if ($this->_sections['a']['show']) {
    $this->_sections['a']['total'] = $this->_sections['a']['loop'];
    if ($this->_sections['a']['total'] == 0)
        $this->_sections['a']['show'] = false;
} else
    $this->_sections['a']['total'] = 0;
if ($this->_sections['a']['show']):

            for ($this->_sections['a']['index'] = $this->_sections['a']['start'], $this->_sections['a']['iteration'] = 1;
                 $this->_sections['a']['iteration'] <= $this->_sections['a']['total'];
                 $this->_sections['a']['index'] += $this->_sections['a']['step'], $this->_sections['a']['iteration']++):
$this->_sections['a']['rownum'] = $this->_sections['a']['iteration'];
$this->_sections['a']['index_prev'] = $this->_sections['a']['index'] - $this->_sections['a']['step'];
$this->_sections['a']['index_next'] = $this->_sections['a']['index'] + $this->_sections['a']['step'];
$this->_sections['a']['first']      = ($this->_sections['a']['iteration'] == 1);
$this->_sections['a']['last']       = ($this->_sections['a']['iteration'] == $this->_sections['a']['total']);
?>
					<li><a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['follow'][$this->_sections['a']['index']]['uid']; ?>
" title="<?php echo $this->_tpl_vars['follow'][$this->_sections['a']['index']]['nickname']; ?>
"><img
							src="<?php echo $this->_tpl_vars['follow'][$this->_sections['a']['index']]['head_img_url']; ?>
"></a>
						<p>
							<a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['follow'][$this->_sections['a']['index']]['uid']; ?>
" title="<?php echo $this->_tpl_vars['follow'][$this->_sections['a']['index']]['nickname']; ?>
" class="uname"><?php echo $this->_tpl_vars['follow'][$this->_sections['a']['index']]['nickname']; ?>
</a>
						</p> <?php if ($this->_tpl_vars['user']['uid'] != $this->_tpl_vars['room_uid'] && $this->_tpl_vars['follow'][$this->_sections['a']['index']]['isfollow'] != 1): ?>
						<p>
							<a class="jsadd"
								href="/huoshow/module/weibo/ajax/weibo_user_dynamic_ajax.php?tab=ajax_user_follow&dst_uid=<?php echo $this->_tpl_vars['follow'][$this->_sections['a']['index']]['uid']; ?>
"
								onclick="<?php if ($this->_tpl_vars['user']['uid']): ?>showWindow('register', this.href)
						<?php else: ?>showWindow('login', 'member.php?mod=logging&action=login');<?php endif; ?>">
								+加关注</a>
						</p> <?php endif; ?></li> <?php endfor; endif; ?>
				</ul>
				<div class="clear"></div>
			</div>
		</div>
	</aside>
	<div class="clear"></div>
</div>