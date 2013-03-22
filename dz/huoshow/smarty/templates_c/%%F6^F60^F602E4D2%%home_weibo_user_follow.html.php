<?php /* Smarty version 2.6.26, created on 2012-04-05 18:13:16
         compiled from home/home_weibo_user_follow.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "home/home_weibo_header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="conMidAtt">

                            <div class="listPri">
<div class="attFirst">
                             <!--<div node-type="search" class="search">
                                <input node-type="input" notice="输入用户名或火秀号" type="text" name="nicksearch" class="input   input_default" value="输入用户名或火秀号" onClick="this.value=''" onBlur="this.value='输入用户名或火秀号'"><a node-type="submit" href="#" class="btn"></a>
                             </div>-->

                        	 <p class="font18">我关注了<span><?php if (empty ( $this->_tpl_vars['user_countinfo'][0]['followCount'] )): ?>0<?php else: ?><?php echo $this->_tpl_vars['user_countinfo'][0]['followCount']; ?>
</span><?php endif; ?>人</p>
                        </div>
						<ul>
                        <li class="divGroup clearfix"><div class="addAtt font14"><a onClick="showWindow('register', this.href)" href="/huoshow/module/home/home_weibo_creategroup.php?tab=creategroup">创建分组</a></div><div class="divGwidth"><a href="home.php?mod=huoshow&do=weibo_userfollow&id=0" <?php if ($this->_tpl_vars['group_id'] == 0): ?>class="selected"<?php endif; ?>>全部</a><a href="home.php?mod=huoshow&do=weibo_userfollow&id=-2" <?php if ($this->_tpl_vars['group_id'] == -2): ?>class="selected"<?php endif; ?>>相互关注</a><?php unset($this->_sections['bo']);
$this->_sections['bo']['name'] = 'bo';
$this->_sections['bo']['loop'] = is_array($_loop=$this->_tpl_vars['group']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['bo']['show'] = true;
$this->_sections['bo']['max'] = $this->_sections['bo']['loop'];
$this->_sections['bo']['step'] = 1;
$this->_sections['bo']['start'] = $this->_sections['bo']['step'] > 0 ? 0 : $this->_sections['bo']['loop']-1;
if ($this->_sections['bo']['show']) {
    $this->_sections['bo']['total'] = $this->_sections['bo']['loop'];
    if ($this->_sections['bo']['total'] == 0)
        $this->_sections['bo']['show'] = false;
} else
    $this->_sections['bo']['total'] = 0;
if ($this->_sections['bo']['show']):

            for ($this->_sections['bo']['index'] = $this->_sections['bo']['start'], $this->_sections['bo']['iteration'] = 1;
                 $this->_sections['bo']['iteration'] <= $this->_sections['bo']['total'];
                 $this->_sections['bo']['index'] += $this->_sections['bo']['step'], $this->_sections['bo']['iteration']++):
$this->_sections['bo']['rownum'] = $this->_sections['bo']['iteration'];
$this->_sections['bo']['index_prev'] = $this->_sections['bo']['index'] - $this->_sections['bo']['step'];
$this->_sections['bo']['index_next'] = $this->_sections['bo']['index'] + $this->_sections['bo']['step'];
$this->_sections['bo']['first']      = ($this->_sections['bo']['iteration'] == 1);
$this->_sections['bo']['last']       = ($this->_sections['bo']['iteration'] == $this->_sections['bo']['total']);
?><a href="home.php?mod=huoshow&do=weibo_userfollow&id=<?php echo $this->_tpl_vars['group'][$this->_sections['bo']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['group_id'] == $this->_tpl_vars['group'][$this->_sections['bo']['index']]['id']): ?>class="selected"<?php endif; ?>><?php echo $this->_tpl_vars['group'][$this->_sections['bo']['index']]['group_name']; ?>
</a><?php endfor; endif; ?><a href="home.php?mod=huoshow&do=weibo_userfollow&id=-1" <?php if ($this->_tpl_vars['group_id'] == -1): ?>class="selected"<?php endif; ?>>未分组</a> </div> </li>
                        <?php if ($this->_tpl_vars['group_id'] == 0 || $this->_tpl_vars['group_id'] == -1 || $this->_tpl_vars['group_id'] == -2): ?><li class="orderGroup">排序方式： <a href="home.php?mod=huoshow&do=weibo_userfollow&roomid=<?php echo $this->_tpl_vars['uid']; ?>
&ordertype=1&id=<?php echo $this->_tpl_vars['group_id']; ?>
" <?php if ($this->_tpl_vars['ordertype'] == 1): ?>class="selected"<?php endif; ?>>关注时间</a> <span class="ddd">|</span> <a href="home.php?mod=huoshow&do=weibo_userfollow&roomid=<?php echo $this->_tpl_vars['uid']; ?>
&ordertype=2&id=<?php echo $this->_tpl_vars['group_id']; ?>
" <?php if ($this->_tpl_vars['ordertype'] == 2): ?>class="selected"<?php endif; ?>>最近更新</a><span class="ddd">|</span> <a href="home.php?mod=huoshow&do=weibo_userfollow&roomid=<?php echo $this->_tpl_vars['uid']; ?>
&ordertype=4&id=<?php echo $this->_tpl_vars['group_id']; ?>
" <?php if ($this->_tpl_vars['ordertype'] == 4): ?>class="selected"<?php endif; ?>>粉丝数</a></li><?php else: ?>
						 <li class="orderGroup"><span class="font12">该分组共<?php echo $this->_tpl_vars['count']; ?>
人：</span> <a href="/huoshow/module/home/home_weibo_savechangegroup.php?changegroup=change&id=<?php echo $this->_tpl_vars['group_id']; ?>
" onClick="showWindow('register', this.href)">修改分组名称</a> <span class="ddd">|</span><a href="home.php?mod=huoshow&do=weibo_userfollow&delgroup=del&id=<?php echo $this->_tpl_vars['group_id']; ?>
" onclick="return confirm('确定删除？此分组下的人不会被取消关注,归为未分组！');" >删掉该分组</a> <span class="ddd">|</span><?php if ($this->_tpl_vars['count'] != 0): ?> <a href="/home.php?mod=huoshow&do=weibo_followgroupmsg&getgroupmsg=msg&id=<?php echo $this->_tpl_vars['group_id']; ?>
">浏览分组微博</a> <?php endif; ?><span class="ddd"></li><?php endif; ?>
						 </ul>
                        </div>
						<?php if ($this->_tpl_vars['count'] == 0 && $this->_tpl_vars['group_id'] != -1 && $this->_tpl_vars['group_id'] != -2): ?><div><a onClick="showWindow('register', this.href)" href="/huoshow/module/home/home_weibo_nogroup.php?tab=nogroup&id=<?php echo $this->_tpl_vars['group_id']; ?>
">将关注人添加到分组</a></div><?php endif; ?>

                            <article>

                            <ul>
							<?php unset($this->_sections['bo']);
$this->_sections['bo']['name'] = 'bo';
$this->_sections['bo']['loop'] = is_array($_loop=$this->_tpl_vars['user_follow']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['bo']['show'] = true;
$this->_sections['bo']['max'] = $this->_sections['bo']['loop'];
$this->_sections['bo']['step'] = 1;
$this->_sections['bo']['start'] = $this->_sections['bo']['step'] > 0 ? 0 : $this->_sections['bo']['loop']-1;
if ($this->_sections['bo']['show']) {
    $this->_sections['bo']['total'] = $this->_sections['bo']['loop'];
    if ($this->_sections['bo']['total'] == 0)
        $this->_sections['bo']['show'] = false;
} else
    $this->_sections['bo']['total'] = 0;
if ($this->_sections['bo']['show']):

            for ($this->_sections['bo']['index'] = $this->_sections['bo']['start'], $this->_sections['bo']['iteration'] = 1;
                 $this->_sections['bo']['iteration'] <= $this->_sections['bo']['total'];
                 $this->_sections['bo']['index'] += $this->_sections['bo']['step'], $this->_sections['bo']['iteration']++):
$this->_sections['bo']['rownum'] = $this->_sections['bo']['iteration'];
$this->_sections['bo']['index_prev'] = $this->_sections['bo']['index'] - $this->_sections['bo']['step'];
$this->_sections['bo']['index_next'] = $this->_sections['bo']['index'] + $this->_sections['bo']['step'];
$this->_sections['bo']['first']      = ($this->_sections['bo']['iteration'] == 1);
$this->_sections['bo']['last']       = ($this->_sections['bo']['iteration'] == $this->_sections['bo']['total']);
?>
                            <li class="itemAtt">
                            <div class="attR2 font14">
                              <?php if ($this->_tpl_vars['user_follow'][$this->_sections['bo']['index']]['each_other_follow'] == 1): ?><img src="/huoshow/img/weibo/coatt.gif" width="40" height="19"><?php endif; ?>
                              <a href="home.php?mod=huoshow&do=weibo_userfollow&tab=del&id=<?php echo $this->_tpl_vars['group_id']; ?>
&dst_uid=<?php echo $this->_tpl_vars['user_follow'][$this->_sections['bo']['index']]['uid']; ?>
"
                                onclick="return confirm('确定取消关注？');" class="font12 aBlock">取消关注</a>

                            </div>
                            <div class="attL"> <a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['user_follow'][$this->_sections['bo']['index']]['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['user_follow'][$this->_sections['bo']['index']]['head_img_url']; ?>
" /></a> <a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['user_follow'][$this->_sections['bo']['index']]['uid']; ?>
" class="font14"><?php echo $this->_tpl_vars['user_follow'][$this->_sections['bo']['index']]['nickname']; ?>
</a>
                              <p class="font12">粉丝：<?php echo $this->_tpl_vars['user_follow'][$this->_sections['bo']['index']]['is_watched_count']; ?>
</p>
							  <span><a onClick="showWindow('register', this.href)" href="/huoshow/module/weibo/ajax/weibo_user_dynamic_ajax.php?tab=ajax_user_send_message&dst_uid=<?php echo $this->_tpl_vars['user_follow'][$this->_sections['bo']['index']]['uid']; ?>
&src_uid=<?php echo $this->_tpl_vars['uid']; ?>
" class="jsadd">发私信</a></span>
                            </div>

                            <div class="gro">
                          <select name="select" id="select" onChange="location='home.php?mod=huoshow&do=weibo_userfollow&dst_uid=<?php echo $this->_tpl_vars['user_follow'][$this->_sections['bo']['index']]['uid']; ?>
&id=<?php echo $this->_tpl_vars['group_id']; ?>
&isgroupid='+this.value">

						       <option value="-1">末分组</option>
							  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['group']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
							  <option value="<?php echo $this->_tpl_vars['group'][$this->_sections['i']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['group'][$this->_sections['i']['index']]['id'] == $this->_tpl_vars['userisgroup'][$this->_sections['bo']['index']]): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['group'][$this->_sections['i']['index']]['group_name']; ?>
</option>
							  <!--<option value="<?php echo $this->_tpl_vars['group'][$this->_sections['i']['index']]['id']; ?>
" <?php if ($this->_tpl_vars['group'][$this->_sections['i']['index']]['id'] == $this->_tpl_vars['is_group_id']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['group'][$this->_sections['i']['index']]['id']; ?>
--<?php echo $this->_tpl_vars['group'][$this->_sections['i']['index']]['group_name']; ?>
</option>-->

							  <?php endfor; endif; ?>
					        </select>


                            </div>


                            <div class="clear"></div>
                            </li>
          					<?php endfor; endif; ?>
             </ul>

            </article>
        <section>
            <?php if ($this->_tpl_vars['count'] != 0): ?><?php echo $this->_tpl_vars['page_str']; ?>
<?php endif; ?>
            </section>
        </div>
		<div class="conR">
        	<!-- 微博统计信息 -->
  			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/home/home_weibo_user_info.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>


            <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/home/home_weibo_recommend.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

            <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/home/home_weibo_hotrecommend.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

        </div>