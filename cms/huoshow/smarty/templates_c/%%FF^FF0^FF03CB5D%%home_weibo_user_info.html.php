<?php /* Smarty version 2.6.26, created on 2012-03-27 10:07:52
         compiled from home/home_weibo_user_info.html */ ?>
<div class="wb-mine-nums">
	<h3>我的微博</h3>
	<ul>
		<li><a href="/home.php?mod=huoshow&do=weibo_userfollow"> <span
				class="num"><?php if ($this->_tpl_vars['user_info'][0]['followCount']): ?><?php echo $this->_tpl_vars['user_info'][0]['followCount']; ?>
<?php else: ?>0<?php endif; ?></span> <span class="text"><span
					class="ic1">关注</span></span>
		</a></li>
		<li><a href="home.php?mod=huoshow&do=weibo_user_fans"> <span
				class="num"><?php if ($this->_tpl_vars['user_info'][0]['beFollowCount']): ?><?php echo $this->_tpl_vars['user_info'][0]['beFollowCount']; ?>
<?php else: ?>0<?php endif; ?></span> <span class="text"><span
					class="ic2">我的粉丝</span></span>
		</a></li>
		<li><a href="/home.php?mod=huoshow&do=weibo&list=2"> <span
				class="num"><?php if ($this->_tpl_vars['user_total']): ?><?php echo $this->_tpl_vars['user_total']; ?>
<?php else: ?>0<?php endif; ?></span> <span class="text"><span
					class="ic3">记录</span></span>
		</a></li>
	</ul>
</div>