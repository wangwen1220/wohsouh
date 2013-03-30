<?php /* Smarty version 2.6.26, created on 2012-04-05 11:29:10
         compiled from weibo/weibo_user_userfollow.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "home/home_weibo_header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="wbCon">
	<div class="conL">
		<div class="userPhoto">
			<span><img src="<?php echo $this->_tpl_vars['roomidimg'][0]['head_img_url']; ?>
" /></span>
		</div>
		<ul class="userMenu">
			<?php if ($this->_tpl_vars['roomid'] == $this->_tpl_vars['user']['uid']): ?>
			<li><span><a
					href="/home.php?mod=huoshow&do=weibo_userfollow">关注<?php if (empty ( $this->_tpl_vars['user_countinfo'][0]['followCount'] )): ?>(0)<?php else: ?>(<?php echo $this->_tpl_vars['user_countinfo'][0]['followCount']; ?>
)<?php endif; ?></a></span></li>
			<li><span><a
					href="/home.php?mod=huoshow&do=weibo_user_fans">粉丝<?php if (empty ( $this->_tpl_vars['user_countinfo'][0]['beFollowCount'] )): ?>(0)<?php else: ?>(<?php echo $this->_tpl_vars['user_countinfo'][0]['beFollowCount']; ?>
)<?php endif; ?></a></span></li>

			<?php else: ?>
			<li><span><a
					href="/show.php?mod=huoshow&module=weibo&op=user_userfollow&roomid=<?php echo $this->_tpl_vars['roomid']; ?>
">关注<?php if (empty ( $this->_tpl_vars['user_countinfo'][0]['followCount'] )): ?>(0)<?php else: ?>(<?php echo $this->_tpl_vars['user_countinfo'][0]['followCount']; ?>
)<?php endif; ?></a></span></li>
			<li><span><a
					href="/show.php?mod=huoshow&module=weibo&op=user_fans_list&roomid=<?php echo $this->_tpl_vars['roomid']; ?>
">粉丝<?php if (empty ( $this->_tpl_vars['user_countinfo'][0]['beFollowCount'] )): ?>(0)<?php else: ?>(<?php echo $this->_tpl_vars['user_countinfo'][0]['beFollowCount']; ?>
)<?php endif; ?></a></span></li>

			<?php endif; ?>
		</ul>
	</div>
	<div class="conM">
		<div style="height:30px;line-height:30px;">
			<span style="float:left;font-size:16px;font-weight:bold;"><?php echo $this->_tpl_vars['roomname']; ?>
 的关注</span>
			<span style="float:right;">
				<?php if ($this->_tpl_vars['user']['uid'] != $this->_tpl_vars['roomid']): ?> <?php if ($this->_tpl_vars['roomis_att'] != 1): ?>
			<a class="user"
				href="/huoshow/module/weibo/ajax/weibo_user_dynamic_ajax.php?tab=ajax_user_follow&dst_uid=<?php echo $this->_tpl_vars['roomid']; ?>
"
				onclick="<?php if ($this->_tpl_vars['user']['uid']): ?>showWindow('register', this.href)
						<?php else: ?>showWindow('login', 'member.php?mod=logging&action=login');<?php endif; ?>">
				加关注</a> <?php endif; ?> <?php endif; ?>
			</span>
		</div>
		<article>
			<span class="userBar2"><?php echo $this->_tpl_vars['roomname']; ?>
关注了<?php if (empty ( $this->_tpl_vars['user_countinfo'][0]['followCount'] )): ?>0<?php else: ?><?php echo $this->_tpl_vars['user_countinfo'][0]['followCount']; ?>
<?php endif; ?>人</span>
			<ul>
				<?php unset($this->_sections['n']);
$this->_sections['n']['name'] = 'n';
$this->_sections['n']['loop'] = is_array($_loop=$this->_tpl_vars['user_follow']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['n']['show'] = true;
$this->_sections['n']['max'] = $this->_sections['n']['loop'];
$this->_sections['n']['step'] = 1;
$this->_sections['n']['start'] = $this->_sections['n']['step'] > 0 ? 0 : $this->_sections['n']['loop']-1;
if ($this->_sections['n']['show']) {
    $this->_sections['n']['total'] = $this->_sections['n']['loop'];
    if ($this->_sections['n']['total'] == 0)
        $this->_sections['n']['show'] = false;
} else
    $this->_sections['n']['total'] = 0;
if ($this->_sections['n']['show']):

            for ($this->_sections['n']['index'] = $this->_sections['n']['start'], $this->_sections['n']['iteration'] = 1;
                 $this->_sections['n']['iteration'] <= $this->_sections['n']['total'];
                 $this->_sections['n']['index'] += $this->_sections['n']['step'], $this->_sections['n']['iteration']++):
$this->_sections['n']['rownum'] = $this->_sections['n']['iteration'];
$this->_sections['n']['index_prev'] = $this->_sections['n']['index'] - $this->_sections['n']['step'];
$this->_sections['n']['index_next'] = $this->_sections['n']['index'] + $this->_sections['n']['step'];
$this->_sections['n']['first']      = ($this->_sections['n']['iteration'] == 1);
$this->_sections['n']['last']       = ($this->_sections['n']['iteration'] == $this->_sections['n']['total']);
?>
				<li class="itemAtt"><?php if ($this->_tpl_vars['user']['uid'] != $this->_tpl_vars['roomid']): ?><?php if ($this->_tpl_vars['user_follow'][$this->_sections['n']['index']]['is_att'] != 1): ?><?php if ($this->_tpl_vars['user']['uid'] != $this->_tpl_vars['user_follow'][$this->_sections['n']['index']]['uid']): ?>
					<div class="attR_closed font14">
						<!--<a href="#" class="font12">加关注</a>-->

						<a class="font12"
							href="/huoshow/module/weibo/ajax/weibo_user_dynamic_ajax.php?tab=ajax_user_follow&dst_uid=<?php echo $this->_tpl_vars['user_follow'][$this->_sections['n']['index']]['uid']; ?>
"
							onclick="<?php if ($this->_tpl_vars['user']['uid']): ?>showWindow('register', this.href)
<?php else: ?>showWindow('login', 'member.php?mod=logging&action=login');<?php endif; ?>">
							加关注</a>
						<!--<div class="disNone"><a href="#">移除粉丝</a><a href="#">发私信</a></div>-->
					</div> <?php endif; ?><?php endif; ?><?php endif; ?>
					<div class="attL">
						<a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['user_follow'][$this->_sections['n']['index']]['uid']; ?>
"><img
							src="<?php echo $this->_tpl_vars['user_follow'][$this->_sections['n']['index']]['head_img_url']; ?>
" /></a> <a
							href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['user_follow'][$this->_sections['n']['index']]['uid']; ?>
" class="font14"><?php echo $this->_tpl_vars['user_follow'][$this->_sections['n']['index']]['nickname']; ?>
</a>
						<a href="#" class="font12 aaa"></a>
						<p class="font12">粉丝：<?php echo $this->_tpl_vars['user_follow'][$this->_sections['n']['index']]['is_watched_count']; ?>
</p>
					</div>
					<div class="clear"></div>
				</li> <?php endfor; endif; ?>
			</ul>
		</article>
		<div><?php if ($this->_tpl_vars['count']): ?><?php echo $this->_tpl_vars['page_str']; ?>
<?php endif; ?></div>
	</div>
	<aside>
		<div class="conR">
			<?php if ($this->_tpl_vars['user']['uid'] == $this->_tpl_vars['roomid']): ?>
			<!-- 微博统计信息 -->
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/home/home_weibo_user_info.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

			<?php else: ?>
			<!-- 微博统计信息 -->
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/weibo/weibo_user_info.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
 <?php endif; ?>

			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/home/home_weibo_recommend.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/home/home_weibo_hotrecommend.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		</div>
	</aside>
	<div class="clear"></div>
</div>