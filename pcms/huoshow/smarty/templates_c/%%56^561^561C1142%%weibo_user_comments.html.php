<?php /* Smarty version 2.6.26, created on 2012-03-23 13:49:37
         compiled from weibo/weibo_user_comments.html */ ?>
<div class="comment-form-body">
  <form action="/huoshow/module/weibo/ajax/weibo_user_dynamic_ajax.php?tab=ajax_user_comments"
    method="POST" id="send_comment_form">
    <input type="hidden" value="<?php echo $this->_tpl_vars['msg_id']; ?>
" name="msgid" />
    <div class="c_tx5">
      <a class="close" title="关闭" href="#close">关闭</a>
      <span class="left">
        <span class="number cNote">评论原文，把它分享给你的听众</span>
        <span class="replyTitle"></span>
        <span class="addReply">
          <a href="#clean" class="reset-form">[清空评论理由]</a>
        </span>
      </span>
    </div>
    <div class="cont">
      <div class="frameIn">
        <textarea id="comment_textarea_<?php echo $this->_tpl_vars['msg_id']; ?>
" class="inputTxt" style="overflow-y:hidden; height:68px;" padding="10" name="comments"></textarea>
      </div>
    </div>
    <div class="bot">
      <div class="insertFun">
        <div class="sendList">
          <a title="表情" href="javascript:;" class="txt wb-facepicker"><em class="sico ico_face2"></em></a>
        </div>
      </div>
      <div class="naviL">
        <label style="display:none"><input id="replayListCheckbox" class="check1" type="checkbox">同时转播</label>
      </div>
      <input class="inputBtn sendBtn" type="submit" title="评论" value="评论">
    </div>
  </form>

  <div class="clear"></div>
  <div class="relayList bgr3">
    <div class="zb_multi">
      <ul>
        <?php unset($this->_sections['g']);
$this->_sections['g']['name'] = 'g';
$this->_sections['g']['loop'] = is_array($_loop=$this->_tpl_vars['getFullMsgReply']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['g']['show'] = true;
$this->_sections['g']['max'] = $this->_sections['g']['loop'];
$this->_sections['g']['step'] = 1;
$this->_sections['g']['start'] = $this->_sections['g']['step'] > 0 ? 0 : $this->_sections['g']['loop']-1;
if ($this->_sections['g']['show']) {
    $this->_sections['g']['total'] = $this->_sections['g']['loop'];
    if ($this->_sections['g']['total'] == 0)
        $this->_sections['g']['show'] = false;
} else
    $this->_sections['g']['total'] = 0;
if ($this->_sections['g']['show']):

            for ($this->_sections['g']['index'] = $this->_sections['g']['start'], $this->_sections['g']['iteration'] = 1;
                 $this->_sections['g']['iteration'] <= $this->_sections['g']['total'];
                 $this->_sections['g']['index'] += $this->_sections['g']['step'], $this->_sections['g']['iteration']++):
$this->_sections['g']['rownum'] = $this->_sections['g']['iteration'];
$this->_sections['g']['index_prev'] = $this->_sections['g']['index'] - $this->_sections['g']['step'];
$this->_sections['g']['index_next'] = $this->_sections['g']['index'] + $this->_sections['g']['step'];
$this->_sections['g']['first']      = ($this->_sections['g']['iteration'] == 1);
$this->_sections['g']['last']       = ($this->_sections['g']['iteration'] == $this->_sections['g']['total']);
?>
        <li class="">
        <div class="msgCnt">
          <strong><a rel="<?php echo $this->_tpl_vars['user_all_msg'][$this->_sections['g']['index']]['nicename']; ?>
" ctype="2" card="1" title="<?php echo $this->_tpl_vars['user_all_msg'][$this->_sections['g']['index']]['nicename']; ?>
" target="_blank" href="<?php echo $this->_tpl_vars['space_url']; ?>
<?php echo $this->_tpl_vars['getFullMsgReply'][$this->_sections['g']['index']]['uid']; ?>
"><?php echo $this->_tpl_vars['getFullMsgReply'][$this->_sections['g']['index']]['nicename']; ?>
</a>:</strong>
          <span class="content"><?php echo $this->_tpl_vars['getFullMsgReply'][$this->_sections['g']['index']]['msg']; ?>
</span>
          <span class="cNote" from="3" >(<?php echo $this->_tpl_vars['getFullMsgReply'][$this->_sections['g']['index']]['append_time']; ?>
)</span>
          <a class="replyCite reply-button" href="#reply">回复<input type="hidden" class="reply-text" value="|| @<?php echo $this->_tpl_vars['getFullMsgReply'][$this->_sections['g']['index']]['nicename']; ?>
:<?php echo $this->_tpl_vars['getFullMsgReply'][$this->_sections['g']['index']]['msg1']; ?>
" /></a>
        </div>
        <div class="clearfix"></div>
        </li>
        <?php endfor; endif; ?>
      </ul>
    </div>
  </div>
</div>