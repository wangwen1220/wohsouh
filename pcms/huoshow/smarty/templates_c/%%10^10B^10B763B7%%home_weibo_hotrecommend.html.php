<?php /* Smarty version 2.6.26, created on 2012-03-27 10:07:52
         compiled from home/home_weibo_hotrecommend.html */ ?>
<div class="wbInter">
            <h3 class="font14">人气用户推荐</h3>
              <ul class="clFrame">
              <?php unset($this->_sections['bo']);
$this->_sections['bo']['name'] = 'bo';
$this->_sections['bo']['loop'] = is_array($_loop=$this->_tpl_vars['watched_count']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
              <li>
              <a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['watched_count'][$this->_sections['bo']['index']]['uid']; ?>
" title=""><img src="<?php echo $this->_tpl_vars['watched_count'][$this->_sections['bo']['index']]['head_img_url']; ?>
"></a>
              <p><a href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['watched_count'][$this->_sections['bo']['index']]['uid']; ?>
" title=""  class="uname"><?php echo $this->_tpl_vars['watched_count'][$this->_sections['bo']['index']]['name']; ?>
</a></p>
              <?php if ($this->_tpl_vars['watched_count'][$this->_sections['bo']['index']]['is_att'] == 0 && $this->_tpl_vars['watched_count'][$this->_sections['bo']['index']]['uid'] != $this->_tpl_vars['uid']): ?>
              <p><a class="jsadd" href="/huoshow/module/weibo/ajax/weibo_user_dynamic_ajax.php?tab=ajax_user_follow&dst_uid=<?php echo $this->_tpl_vars['watched_count'][$this->_sections['bo']['index']]['uid']; ?>
"
            onclick="<?php if ($this->_tpl_vars['uid']): ?>showWindow('register', this.href)
            <?php else: ?>showWindow('login', 'member.php?mod=logging&action=login');<?php endif; ?>">
            +加关注</a></p><?php endif; ?>
              </li>
                <?php endfor; endif; ?>
        </ul>
              <div class="clear"></div>
            </div>