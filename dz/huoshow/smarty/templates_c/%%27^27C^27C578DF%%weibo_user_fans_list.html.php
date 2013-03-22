<?php /* Smarty version 2.6.26, created on 2012-04-05 11:29:25
         compiled from weibo/weibo_user_fans_list.html */ ?>
<link href="/huoshow/css/weibo/style_weibo.css" rel="stylesheet" type="text/css" />
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
			<li><span><a href="/home.php?mod=huoshow&do=weibo_userfollow">关注(<?php if ($this->_tpl_vars['info_count'][0]['followCount']): ?><?php echo $this->_tpl_vars['info_count'][0]['followCount']; ?>
<?php else: ?>0<?php endif; ?>)</a></span></li>
			<li><span><a href="/home.php?mod=huoshow&do=weibo_user_fans">粉丝(<?php if ($this->_tpl_vars['info_count'][0]['beFollowCount']): ?><?php echo $this->_tpl_vars['info_count'][0]['beFollowCount']; ?>
<?php else: ?>0<?php endif; ?>)</a></span></li>
			<?php else: ?>
			<li><span><a href="/show.php?mod=huoshow&module=weibo&op=user_userfollow&roomid=<?php echo $this->_tpl_vars['room_uid']; ?>
">关注(<?php if ($this->_tpl_vars['info_count'][0]['followCount']): ?><?php echo $this->_tpl_vars['info_count'][0]['followCount']; ?>
<?php else: ?>0<?php endif; ?>)</a></span></li>
			<li><span><a href="/show.php?mod=huoshow&module=weibo&op=user_fans_list&roomid=<?php echo $this->_tpl_vars['room_uid']; ?>
">粉丝(<?php if ($this->_tpl_vars['info_count'][0]['beFollowCount']): ?><?php echo $this->_tpl_vars['info_count'][0]['beFollowCount']; ?>
<?php else: ?>0<?php endif; ?>)</a></span></li>
			<?php endif; ?>
		</ul>
	</div>
	<div class="conM">
		<div style="height:30px;line-height:30px;">
			<span style="float:left;font-size:16px;font-weight:bold;"><?php echo $this->_tpl_vars['user_info_arr'][0]['nickname']; ?>
 的粉丝</span>
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
		<article>
			<span class="userBar2"><?php echo $this->_tpl_vars['user_info_arr'][0]['nickname']; ?>
的粉丝<?php if ($this->_tpl_vars['info_count'][0]['beFollowCount']): ?> <?php echo $this->_tpl_vars['info_count'][0]['beFollowCount']; ?>
<?php else: ?>0<?php endif; ?> 人</span>
			<ul>
				<?php unset($this->_sections['f']);
$this->_sections['f']['name'] = 'f';
$this->_sections['f']['loop'] = is_array($_loop=$this->_tpl_vars['my_fans']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<li class="itemAtt">
				<?php if ($this->_tpl_vars['user']['uid'] == $this->_tpl_vars['room_uid']): ?>
					<?php if ($this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['each_other'] != 1): ?>
						<div class="attR_closed font14">
							<a
								onClick="add('home.php?mod=huoshow&do=weibo_user_fans&tab=add_fans&dst_uid=<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['uid']; ?>
');return false;"
								href="javascript:;" class="font12">加关注</a>
							<div class="disNone">
								<a
									onClick="delError('home.php?mod=huoshow&do=weibo_user_fans&tab=del_fans&src_uid=<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['uid']; ?>
');return false;"
									href="javascript:;" class="font12">移除粉丝</a>
							</div>
						</div>
					<?php else: ?>
						<div class="attR font14">
							<a
								onClick="delError('home.php?mod=huoshow&do=weibo_user_fans&tab=del_fans&src_uid=<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['uid']; ?>
');return false;"
								href="javascript:;" class="font12">移除粉丝</a>
						</div>
					<?php endif; ?>
				<?php else: ?>
					<?php if ($this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['isfollow'] != 1): ?>
					<div class="attR_closed font14">
							<a class="font12"
				href="/huoshow/module/weibo/ajax/weibo_user_dynamic_ajax.php?tab=ajax_user_follow&dst_uid=<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['uid']; ?>
"
				onclick="<?php if ($this->_tpl_vars['user']['uid']): ?>showWindow('register', this.href)
						<?php else: ?>showWindow('login', 'member.php?mod=logging&action=login');<?php endif; ?>">
				加关注</a></div>
					<?php endif; ?>
				<?php endif; ?>
					<div class="attL">
						<a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['head_img_url']; ?>
" /></a> <a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['uid']; ?>
"
							class="font14"><?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['nickname']; ?>
</a>
						<p class="font12">
							关注：<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['watch_count']; ?>
 <span class="ddd">|</span>
							粉丝：<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['is_watched_count']; ?>
 <span
								class="ddd">|</span> 微博：<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['total']; ?>

						</p>
					</div>
					<div class="clear"></div>
				</li>
				<?php endfor; endif; ?>
			</ul>

		</article>

		<div class="W_pages">
			<?php if ($this->_tpl_vars['fans_count']): ?><?php echo $this->_tpl_vars['page_str']; ?>
<?php endif; ?>
		</div>

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

			<!-- 可能感兴趣的人 -->
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/home/home_weibo_recommend.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

			<!-- 人气用户推荐 -->
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/home/home_weibo_hotrecommend.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

		</div>
	</aside>
	<div class="clear"></div>
</div>
<?php echo '
<script type="text/javascript">
function delError(href)
{
	if (!confirm("确定移除粉丝？")) {
		return false;
	}else{
		window.location.href= href;
	}
}

function add(href)
{
	if (!confirm("确定关注？")) {
		return false;
	}else{
		window.location.href= href;
	}
}

(function($){
  $(function(){
    var $dialog = $(\'.fwin_register\');
    var $dialog_width = $dialog.width();
    var $dialog_height = $dialog.height();
    $iframe = $("<iframe frameborder=\'0\' src=\'javascript:false\' style=\'position: absolute; z-index: -1; width:" + $dialog_width + "px; height: " + $dialog_height + "px; top: 0; left: 0;\'></iframe>");
//$dialog.append($iframe);
  });
})(jQuery);
</script>
'; ?>