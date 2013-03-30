<?php /* Smarty version 2.6.26, created on 2012-03-28 12:21:12
         compiled from home/home_weibo_nogroup.html */ ?>
<!--[if IE 6]><iframe class='ie6select' src='javascript:;' frameborder='0'></iframe>
<div class='ie6select'><![endif]-->
<div class="addFans group">
  <div style="position:relative;">
    <span class="closeSpan"><a title="关闭" onclick="hideWindow('register')" class="flbc" href="javascript:;">关闭</a></span>
    <form action="/huoshow/module/home/home_weibo_nogroup.php?tab=ingroup" method="post" id="group_add_user_form">
      <input name="groupid" type="hidden" id="groupid" value="<?php echo $this->_tpl_vars['id']; ?>
" />
      <ul class="showIt">
        <?php unset($this->_sections['n']);
$this->_sections['n']['name'] = 'n';
$this->_sections['n']['loop'] = is_array($_loop=$this->_tpl_vars['nogroup']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
        <li>
        <label>
          <input name="select[]" type="checkbox" value="<?php echo $this->_tpl_vars['nogroup'][$this->_sections['n']['index']]['uid']; ?>
" />
          <a>
            <span><img src="<?php echo $this->_tpl_vars['nogroup'][$this->_sections['n']['index']]['head_img_url']; ?>
" /></span>
            <span class='name'><?php echo $this->_tpl_vars['nogroup'][$this->_sections['n']['index']]['nickname']; ?>
</span>
          </a>
        </label>
        </li>
        <?php endfor; endif; ?>
      </ul>
      <div class="clear"></div>
      <div class="addPage">
        <?php if ($this->_tpl_vars['count'] == 1): ?>
        <input type="submit" value="应用" />
        <?php else: ?>没有未分组的关注用户！<?php endif; ?>
      </div>
    </form>
  </div>
</div>
<!--[if IE 6]></div><![endif]-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "home/home_weibo_group_script.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>