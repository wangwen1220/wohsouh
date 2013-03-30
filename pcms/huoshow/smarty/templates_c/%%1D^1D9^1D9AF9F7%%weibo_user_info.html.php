<?php /* Smarty version 2.6.26, created on 2012-03-26 09:19:54
         compiled from weibo/weibo_user_info.html */ ?>
<div class="wb-mine-nums">
	<h3>我的微博</h3>
	<ul>
		<li><a href="/show.php?mod=huoshow&module=weibo&op=user_userfollow&roomid=<?php echo $this->_tpl_vars['room_uid']; ?>
"> <span
				class="num"><?php if ($this->_tpl_vars['user_info'][0]['followCount']): ?><?php echo $this->_tpl_vars['user_info'][0]['followCount']; ?>
<?php else: ?>0<?php endif; ?></span> <span class="text"><span
					class="ic1">关注</span></span>
		</a></li>
		<li><a href="/show.php?mod=huoshow&module=weibo&op=user_fans_list&roomid=<?php echo $this->_tpl_vars['room_uid']; ?>
"> <span
				class="num"><?php if ($this->_tpl_vars['user_info'][0]['beFollowCount']): ?><?php echo $this->_tpl_vars['user_info'][0]['beFollowCount']; ?>
<?php else: ?>0<?php endif; ?></span> <span class="text"><span
					class="ic2">我的粉丝</span></span>
		</a></li>
		<li><a href="/show.php?mod=huoshow&module=weibo&op=user&roomid=<?php echo $this->_tpl_vars['room_uid']; ?>
&list=1"> <span
				class="num"><?php if ($this->_tpl_vars['user_total']): ?><?php echo $this->_tpl_vars['user_total']; ?>
<?php else: ?>0<?php endif; ?></span> <span class="text"><span
					class="ic3">记录</span></span>
		</a></li>
	</ul>
</div>