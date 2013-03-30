<?php /* Smarty version 2.6.26, created on 2012-03-26 09:19:22
         compiled from home/home_weibo_user_fans.html */ ?>
<link href="/huoshow/css/weibo/style_weibo.css" rel="stylesheet"
	type="text/css" />
<div class="conM" style="width:555px; margin:0px;">
	<div class="listPri">
		<div class="attFirst">
			<p class="font18">
				我有<span><?php echo $this->_tpl_vars['user_info'][0]['beFollowCount']; ?>
</span>个粉丝
			</p>
		</div>
		<li class="orderGroup">
			<span class="font12">排序方式：</span>
			<?php if ($this->_tpl_vars['lists'] == 1): ?>
			<a class="selected">关注时间</a> <span class="ddd">|</span>
			<a href="home.php?mod=huoshow&do=weibo_user_fans&list=2">最近更新</a><span class="ddd">|</span>
			<a href="home.php?mod=huoshow&do=weibo_user_fans&list=4">粉丝数</a>
			<?php elseif ($this->_tpl_vars['lists'] == 2): ?>
			<a href="home.php?mod=huoshow&do=weibo_user_fans&list=1">关注时间</a> <span class="ddd">|</span>
			<a class="selected">最近更新</a><span class="ddd">|</span>
			<a href="home.php?mod=huoshow&do=weibo_user_fans&list=4">粉丝数</a>
			<?php elseif ($this->_tpl_vars['lists'] == 4): ?>
			<a href="home.php?mod=huoshow&do=weibo_user_fans&list=1">关注时间</a>
			<a href="home.php?mod=huoshow&do=weibo_user_fans&list=2">最近更新</a><span class="ddd">|</span>
			<a class="selected">粉丝数</a>
			<?php endif; ?>
		</li>
	</div>
	<article>
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
				<?php if ($this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['each_other'] != 1): ?>
				<div class="attR_closed font14">
					<a onClick="add('home.php?mod=huoshow&do=weibo_user_fans&tab=add_fans&dst_uid=<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['uid']; ?>
');return false;" href="javascript:;" class="font12">加关注</a>
					<div class="disNone">
						<a onClick="delError('home.php?mod=huoshow&do=weibo_user_fans&tab=del_fans&src_uid=<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['uid']; ?>
');return false;" href="javascript:;" class="font12">移除粉丝</a>
					</div>
				</div>
				<?php else: ?>
				<div class="attR font14">
                	<a onClick="delError('home.php?mod=huoshow&do=weibo_user_fans&tab=del_fans&src_uid=<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['uid']; ?>
');return false;" href="javascript:;" class="font12">移除粉丝</a>
                </div>
				<?php endif; ?>
				<div class="attL">
					<a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['head_img_url']; ?>
" /></a>
					<a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['uid']; ?>
"	class="font14"><?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['nickname']; ?>
</a>
					<p class="font12">
						关注：<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['watch_count']; ?>
 <span class="ddd">|</span> 粉丝：<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['is_watched_count']; ?>

						<span class="ddd">|</span> 微博：<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['total']; ?>

					</p>
					<p>
						<a class="jsadd"
							href="/huoshow/module/weibo/ajax/weibo_user_dynamic_ajax.php?tab=ajax_user_send_message&dst_uid=<?php echo $this->_tpl_vars['my_fans'][$this->_sections['f']['index']]['uid']; ?>
&src_uid=<?php echo $this->_tpl_vars['home_uid']; ?>
"
							onclick="<?php if ($this->_tpl_vars['home_uid']): ?>showWindow('register', this.href)
							<?php else: ?>showWindow('login', 'member.php?mod=logging&action=login');<?php endif; ?>">
								发私信</a>
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

;(function($){
  //修正 IE6 中 a 标签外的其它元素不支持hover伪类问题
  $(\'.attR_closed\').hover(function(){
    $(this).addClass(\'hover\');
  },function(){
    $(this).removeClass(\'hover\');
  });
})(jQuery);
</script>
'; ?>