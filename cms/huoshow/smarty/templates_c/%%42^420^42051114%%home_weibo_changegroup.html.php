<?php /* Smarty version 2.6.26, created on 2012-03-23 15:20:04
         compiled from home/home_weibo_changegroup.html */ ?>
<!--[if IE 6]><iframe class='ie6select' src='javascript:;' frameborder='0'></iframe>
<div class='ie6select'><![endif]-->
<div class="blr" style="width:350px;">
  <h3 id="layer_reginfo_t" class="flb"><em>修改分组名称</em><span>
      <a href="javascript:;" class="flbc" onclick="hideWindow('register')" title="关闭">关闭</a></span>
  </h3>
  <form id="group_form" action="huoshow/module/home/home_weibo_savechangegroup.php?savechangegroup=changegroup&id=<?php echo $this->_tpl_vars['id']; ?>
" method="post" >
    <div id="tangchuang2s">
      <div style="padding:10px;">
        分组名：<input name="groupname" class="input" style="width:150px;vertical-align:middle;height:20px;margin-bottom:5px;color:#cccccc;" >
      </div>
      <div style="text-align:center;background:#eeeeee;padding-top:5px;height:31px;">
        <label>
          <input type="submit" value="提交" />
        </label>
      </div>
    </div>
  </form>
</div>
<!--[if IE 6]></div><![endif]-->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "home/home_weibo_group_script.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>