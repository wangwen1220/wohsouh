<?php /* Smarty version 2.6.26, created on 2012-03-19 17:00:26
         compiled from home/home_weibo_user_message.html */ ?>
<div class="listPri">
	<li class="orderGroup">排序方式：
		<?php if ($this->_tpl_vars['msg_type'] == 1): ?>
		<a href="/home.php?mod=huoshow&do=weibo&list=3&msg=1" class="selected">提到我的</a> <span class="ddd">|</span>
		<a href="/home.php?mod=huoshow&do=weibo&list=3&msg=2">私信</a><span class="ddd">|</span>
		<a href="/home.php?mod=huoshow&do=weibo&list=3&msg=3">我的通知</a><span class="ddd">|</span>
		<?php elseif ($this->_tpl_vars['msg_type'] == 2): ?>
		<a href="/home.php?mod=huoshow&do=weibo&list=3&msg=1" >提到我的</a> <span class="ddd">|</span>
		<a href="/home.php?mod=huoshow&do=weibo&list=3&msg=2" class="selected">私信</a><span class="ddd">|</span>
		<a href="/home.php?mod=huoshow&do=weibo&list=3&msg=3">我的通知</a><span class="ddd">|</span>
		<?php else: ?>
		<a href="/home.php?mod=huoshow&do=weibo&list=3&msg=1">提到我的</a> <span class="ddd">|</span>
		<a href="/home.php?mod=huoshow&do=weibo&list=3&msg=2">私信</a><span class="ddd">|</span>
		<a href="/home.php?mod=huoshow&do=weibo&list=3&msg=3" class="selected">我的通知</a><span class="ddd">|</span>
		<?php endif; ?>
	</li>
</div>
<article>
	<div class="wb_info">
		<ul class="font12">
		<?php if ($this->_tpl_vars['msg_type'] == 1): ?>
		<?php unset($this->_sections['m']);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['usermsg']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['m']['show'] = true;
$this->_sections['m']['max'] = $this->_sections['m']['loop'];
$this->_sections['m']['step'] = 1;
$this->_sections['m']['start'] = $this->_sections['m']['step'] > 0 ? 0 : $this->_sections['m']['loop']-1;
if ($this->_sections['m']['show']) {
    $this->_sections['m']['total'] = $this->_sections['m']['loop'];
    if ($this->_sections['m']['total'] == 0)
        $this->_sections['m']['show'] = false;
} else
    $this->_sections['m']['total'] = 0;
if ($this->_sections['m']['show']):

            for ($this->_sections['m']['index'] = $this->_sections['m']['start'], $this->_sections['m']['iteration'] = 1;
                 $this->_sections['m']['iteration'] <= $this->_sections['m']['total'];
                 $this->_sections['m']['index'] += $this->_sections['m']['step'], $this->_sections['m']['iteration']++):
$this->_sections['m']['rownum'] = $this->_sections['m']['iteration'];
$this->_sections['m']['index_prev'] = $this->_sections['m']['index'] - $this->_sections['m']['step'];
$this->_sections['m']['index_next'] = $this->_sections['m']['index'] + $this->_sections['m']['step'];
$this->_sections['m']['first']      = ($this->_sections['m']['iteration'] == 1);
$this->_sections['m']['last']       = ($this->_sections['m']['iteration'] == $this->_sections['m']['total']);
?>
			<li class="wbItem">
				<div class="user_avata">
					<a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['usermsg'][$this->_sections['m']['index']]['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['usermsg'][$this->_sections['m']['index']]['head_img_url']; ?>
" width="50" height="52"
						border="0" alt="<?php echo $this->_tpl_vars['usermsg'][$this->_sections['m']['index']]['nicename']; ?>
"></a>
				</div>
				<div class="t_body" style="border-bottom:none;">
					<?php if ($this->_tpl_vars['usermsg'][$this->_sections['m']['index']]['msg_type'] == 2): ?>
					<p class="t_cont">
						<strong><a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['usermsg'][$this->_sections['m']['index']]['uid']; ?>
"><?php echo $this->_tpl_vars['usermsg'][$this->_sections['m']['index']]['nicename']; ?>
</a></strong> 回复
						<strong><a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['usermsg'][$this->_sections['m']['index']]['be_reply_uid']; ?>
"><?php echo $this->_tpl_vars['usermsg'][$this->_sections['m']['index']]['be_reply_nicename']; ?>
</a></strong>
						<span class="t_msg"><?php echo $this->_tpl_vars['usermsg'][$this->_sections['m']['index']]['msg']; ?>

							<a href="#" class="font12">（<?php echo $this->_tpl_vars['usermsg'][$this->_sections['m']['index']]['append_time']; ?>
）</a><br>
							 回复我的评论:&quot;<?php echo $this->_tpl_vars['usermsg'][$this->_sections['m']['index']]['be_reply_msg']; ?>
&quot;
						</span>
					</p>
					<?php else: ?>
					<p class="t_cont">
						<strong><a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['usermsg'][$this->_sections['m']['index']]['uid']; ?>
"><?php echo $this->_tpl_vars['usermsg'][$this->_sections['m']['index']]['nicename']; ?>
</a>:</strong>
						<span class="t_msg"><?php echo $this->_tpl_vars['usermsg'][$this->_sections['m']['index']]['msg']; ?>
</span>
					</p>
					<?php endif; ?>
				</div>
				<div class="clear"></div>
			</li>
		<?php endfor; endif; ?>
		<?php elseif ($this->_tpl_vars['msg_type'] == 2): ?>
		<?php unset($this->_sections['m']);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['user_mail']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['m']['show'] = true;
$this->_sections['m']['max'] = $this->_sections['m']['loop'];
$this->_sections['m']['step'] = 1;
$this->_sections['m']['start'] = $this->_sections['m']['step'] > 0 ? 0 : $this->_sections['m']['loop']-1;
if ($this->_sections['m']['show']) {
    $this->_sections['m']['total'] = $this->_sections['m']['loop'];
    if ($this->_sections['m']['total'] == 0)
        $this->_sections['m']['show'] = false;
} else
    $this->_sections['m']['total'] = 0;
if ($this->_sections['m']['show']):

            for ($this->_sections['m']['index'] = $this->_sections['m']['start'], $this->_sections['m']['iteration'] = 1;
                 $this->_sections['m']['iteration'] <= $this->_sections['m']['total'];
                 $this->_sections['m']['index'] += $this->_sections['m']['step'], $this->_sections['m']['iteration']++):
$this->_sections['m']['rownum'] = $this->_sections['m']['iteration'];
$this->_sections['m']['index_prev'] = $this->_sections['m']['index'] - $this->_sections['m']['step'];
$this->_sections['m']['index_next'] = $this->_sections['m']['index'] + $this->_sections['m']['step'];
$this->_sections['m']['first']      = ($this->_sections['m']['iteration'] == 1);
$this->_sections['m']['last']       = ($this->_sections['m']['iteration'] == $this->_sections['m']['total']);
?>
			<li class="wbItem">
				<div class="user_avata">
					<a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['user_mail'][$this->_sections['m']['index']]['src_uid']; ?>
"><img src="<?php echo $this->_tpl_vars['user_mail'][$this->_sections['m']['index']]['head_img_url']; ?>
" width="50" height="52"
						border="0" alt="<?php echo $this->_tpl_vars['user_mail'][$this->_sections['m']['index']]['src_nickname']; ?>
"></a>
				</div>
				<div class="t_body" style="border-bottom:none;">
					<p class="t_cont">
						<strong><a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['user_mail'][$this->_sections['m']['index']]['src_uid']; ?>
"><?php echo $this->_tpl_vars['user_mail'][$this->_sections['m']['index']]['src_nickname']; ?>
:</a></strong>
						<span class="t_msg"><?php echo $this->_tpl_vars['user_mail'][$this->_sections['m']['index']]['msg']; ?>
</span>
					</p>
					<div class="t_from">
						<span class="wbInfoDate font12">
						<strong class="fr">
							<a
								onClick="delError('/huoshow/module/weibo/ajax/weibo_user_dynamic_ajax.php?tab=ajax_user_del_message&msg_id=<?php echo $this->_tpl_vars['user_mail'][$this->_sections['m']['index']]['id']; ?>
');return false;"
								href="javascript:;" class="jsadd">删除</a>
							<a class="jsadd" href="/huoshow/module/weibo/ajax/weibo_user_dynamic_ajax.php?tab=ajax_user_message&reply_uid=<?php echo $this->_tpl_vars['home_uid']; ?>
&msg_id=<?php echo $this->_tpl_vars['user_mail'][$this->_sections['m']['index']]['id']; ?>
&msg=<?php echo $this->_tpl_vars['user_mail'][$this->_sections['m']['index']]['msg']; ?>
&src_name=<?php echo $this->_tpl_vars['user_mail'][$this->_sections['m']['index']]['src_nickname']; ?>
"
							onclick="<?php if ($this->_tpl_vars['home_uid']): ?>showWindow('register', this.href)
							<?php else: ?>showWindow('login', 'member.php?mod=logging&action=login');<?php endif; ?>">
							回复</a>
						</strong>
						</span>
					</div>
				</div>
				<div class="clear"></div>
			</li>
		<?php endfor; endif; ?>
		<?php else: ?>
		<?php unset($this->_sections['n']);
$this->_sections['n']['name'] = 'n';
$this->_sections['n']['loop'] = is_array($_loop=$this->_tpl_vars['user_noti']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<li class="wbItem">
				<div class="t_body" style="border-bottom:none;">
					<p class="t_cont">
						<strong><a href="#">系统管理员:</a>给您发送</strong>
						<span class="t_msg"><?php echo $this->_tpl_vars['user_noti'][$this->_sections['n']['index']]['note']; ?>
</span>
					</p>
				</div>
				<div class="clear"></div>
			</li>
		<?php endfor; endif; ?>
		<?php endif; ?>
		</ul>
	</div>
</article>
<?php echo '
<script type="text/javascript">
function delError(href)
{
	if (!confirm("确定删除私信？")) {
		return false;
	}else{
		window.location.href= href;
	}
}
</script>
'; ?>