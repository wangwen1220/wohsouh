<?php /* Smarty version 2.6.26, created on 2012-03-16 09:26:06
         compiled from show/show_mutilive_room.html */ ?>
<script>
ENV.roomMType='<?php echo $this->_tpl_vars['userinfo'][0]['mic_count']; ?>
';
ENV.userType='<?php echo $this->_tpl_vars['UserType']; ?>
';
ENV.roomadminlist='<?php echo $this->_tpl_vars['roomlist']; ?>
'
</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "home/home_weibo_header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link href="/huoshow/css/multi_live.css" rel="stylesheet" type="text/css" />
<div id="mian">
  <div id="congzhileft">
    <div class="room_left_flash">
      <div style="position:relative;">
        <object type="application/x-shockwave-flash" data="/huoshow/flash/multictrl.swf" name="multictrl_object" id="multictrl_object">
          <param name="movie" value="/huoshow/flash/multictrl.swf">
          <param name="wmode" value="transparent">
          <param name="flashvars" value="userId=<?php echo $this->_tpl_vars['uid']; ?>
&roomId=<?php echo $this->_tpl_vars['roomid']; ?>
">
          <param name="allowScriptAccess" value="always">
        </object>
        <div class="cams">
          <object type="application/x-shockwave-flash" data="/huoshow/flash/cam1.swf" name="cam1_object" id="cam1_object">
            <param name="movie" value="/huoshow/flash/cam1.swf">
            <param name="wmode" value="opaque">
            <param name="flashvars" value="userId=<?php echo $this->_tpl_vars['uid']; ?>
&roomId=<?php echo $this->_tpl_vars['roomid']; ?>
">
            <param name="allowScriptAccess" value="always">
          </object>
          <object type="application/x-shockwave-flash" data="/huoshow/flash/cam2.swf" name="cam2_object" id="cam2_object">
            <param name="movie" value="/huoshow/flash/cam2.swf">
            <param name="wmode" value="opaque">
            <param name="flashvars" value="userId=<?php echo $this->_tpl_vars['uid']; ?>
&roomId=<?php echo $this->_tpl_vars['roomid']; ?>
">
            <param name="allowScriptAccess" value="always">
          </object>
          <object type="application/x-shockwave-flash" data="/huoshow/flash/cam3.swf" name="cam3_object" id="cam3_object">
            <param name="movie" value="/huoshow/flash/cam3.swf">
            <param name="wmode" value="opaque">
            <param name="flashvars" value="userId=<?php echo $this->_tpl_vars['uid']; ?>
&roomId=<?php echo $this->_tpl_vars['roomid']; ?>
">
            <param name="allowScriptAccess" value="always">
          </object>
        </div>
        <div class="mic-buttons">
          <a href="javascript:;" class="cam-setting-button">设置摄像头</a>
          <a href="javascript:;" class="lineup">排麦</a>
        </div>
      </div>
    </div>

    <div class="room_right_liaot">
    
      <div class="chat" id="chat">
        <div id="chat_msgbox">
          <h3><a href="/" target='_blank' style="float:right;"><img src='/static2/images/gohome_1.gif' /></a>聊天</h3>
          <div class="room-notice-bar">
            <div class="room-notice-label">【直播间公告】：</div>
            <div class="room-notice-message">
              <marquee scrolldelay="98" scrollamount="1" onmouseover="this.stop();" onmouseout="this.start();">
              <span id="room_notice"><?php unset($this->_sections['a']);
$this->_sections['a']['name'] = 'a';
$this->_sections['a']['loop'] = is_array($_loop=$this->_tpl_vars['setNotice']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['a']['show'] = true;
$this->_sections['a']['max'] = $this->_sections['a']['loop'];
$this->_sections['a']['step'] = 1;
$this->_sections['a']['start'] = $this->_sections['a']['step'] > 0 ? 0 : $this->_sections['a']['loop']-1;
if ($this->_sections['a']['show']) {
    $this->_sections['a']['total'] = $this->_sections['a']['loop'];
    if ($this->_sections['a']['total'] == 0)
        $this->_sections['a']['show'] = false;
} else
    $this->_sections['a']['total'] = 0;
if ($this->_sections['a']['show']):

            for ($this->_sections['a']['index'] = $this->_sections['a']['start'], $this->_sections['a']['iteration'] = 1;
                 $this->_sections['a']['iteration'] <= $this->_sections['a']['total'];
                 $this->_sections['a']['index'] += $this->_sections['a']['step'], $this->_sections['a']['iteration']++):
$this->_sections['a']['rownum'] = $this->_sections['a']['iteration'];
$this->_sections['a']['index_prev'] = $this->_sections['a']['index'] - $this->_sections['a']['step'];
$this->_sections['a']['index_next'] = $this->_sections['a']['index'] + $this->_sections['a']['step'];
$this->_sections['a']['first']      = ($this->_sections['a']['iteration'] == 1);
$this->_sections['a']['last']       = ($this->_sections['a']['iteration'] == $this->_sections['a']['total']);
?><?php if (! empty ( $this->_tpl_vars['setNotice'][$this->_sections['a']['index']]['roominfourl'] )): ?><a target="_blank" href="<?php echo $this->_tpl_vars['setNotice'][$this->_sections['a']['index']]['roominfourl']; ?>
"><?php echo $this->_tpl_vars['setNotice'][$this->_sections['a']['index']]['roominfo']; ?>
</a><?php else: ?><?php echo $this->_tpl_vars['setNotice'][$this->_sections['a']['index']]['roominfo']; ?>
<?php endif; ?><?php endfor; endif; ?></span>
              </marquee>
            </div>
          </div>
          <div id="chat_log_box">

            <div id="chat_log1_w">
              <div id="message_list"></div>
            </div>

            <div id="chat_log2_w">
              <div id="my_message_list">
              </div>
            </div>
          </div>
        </div>

        <div id="chat-form-w">
          <div id="chat-form">
            <div class="chat-form-tools">
              <table width="100%">
                <tr>
                  <td class="tool-item">
                    <div id="btn_recentlist">所有人</div>
                  </td>
                  <td class="tool-item" style="display:none;">
                    <div>
                      <label for="isPrivate"><input type="checkbox" value="false" id="isPrivate" />&nbsp;悄悄话</label>
                    </div>
                  </td>
                  <td class="tool-item">
                    <a href="javascript:;" id="btn_face"><img src="/huoshow/img/multi_live/face.gif" width="16" height="16"/></a>
                  </td>
                  <td width="100%">
                    <a href="javascript:;" id="btn_clap">喝彩</a>
                  </td>
                  <td>
                    <div style="white-space:nowrap;">
                      <a href="javascript:;" id="btn_autoscroll">停止滚屏</a>&nbsp;|&nbsp;<a href="javascript:;" id="btn_clean">清屏</a>
                    </div>
                  </td>
                </tr>
              </table>
            </div>

            <div class="chat-form-input">
              <table width="100%">
                <tr>
                  <td width="100%">
                    <input type="text" id="inputMessage" />
                  </td>
                  <td>
                    <div id="button_sendmsg"><span>发送消息</span></div>
                  </td>
                </tr>
              </table>
            </div>

          </div>
        </div>
      </div>
    
    
    </div>

    <div class="clear"></div>

    <div class="gift-bar">
      <input type="hidden" value="" name="giftid" id="giftid">
      <input type="hidden" value="<?php echo $this->_tpl_vars['userinfo'][0]['uid']; ?>
" name="targetuid" id="targetuid">
      <table class="ui-layout">
        <tr>
          <td>挑选</td>
          <td>
            <a href="javascript:;" id="btn_giftbox" class="button-yellow">礼物盒子</a>
          </td>
          <td>数量</td>
          <td><input type="text" class="shuru" id="giftnum" value="1" /></td>
          <td>赠给</td>
          <td><span class="zenggei" id="target_name"><?php echo $this->_tpl_vars['userinfo'][0]['nickname']; ?>
</span></td>
          <td><a href="javascript:;" onclick="givegift();return false;" class="gift-bar-button-send">&nbsp;</a></td>
          <td><a target="_blank" href="/home.php?mod=space&do=pay" class="gift-bar-button-recharge">&nbsp;</a></td>
          <td style="text-align:right;width:100%;">
            <!--<?php if ($this->_tpl_vars['uid'] == $this->_tpl_vars['roomid']): ?>-->
            <a href="/huoshow/module/show/ajax/show_setting_away_config.php?&tab=setNotice&roomid=<?php echo $this->_tpl_vars['uid']; ?>
" onclick="showWindow('register', this.href)"><img src="/huoshow/img/multi_live/setnotice.gif"></a>
            <a href="#" onclick="setRoomBg();return false;" class="gift-bar-button-setbg"><img src="/huoshow/img/multi_live/pifu.jpg"></a>
            <!--<?php endif; ?>-->
          </td>
        </tr>
      </table>
    </div>

  </div>

  <div id="congzhiringht">
    <div class="room_right_xx">
      <div class="room_right_xx_01"><a href="javascript:;">&nbsp;</a></div>
      <div class="room_right_xx_02"><a href="javascript:;">&nbsp;</a></div>
      <div class="room_right_xx_04"><a href="javascript:;" class="on">&nbsp;</a></div>
    </div>

    <div class="member-tab-contents">
      <div class="member-tab-content">
        <h1>麦序(<span id="miclist_length">0</span>)</h1>
        <div id="miclist" class="member-tab-content-body userlist">
          <div id="takelist"></div>
          <div id="waitlist"></div>
        </div>
      </div>
      <div class="member-tab-content">
        <h1>房管(<span id="adminlist_length">0</span>)</h1>
        <div id="adminlist" class="member-tab-content-body userlist"></div>
      </div>
      <div class="member-tab-content">
        <h1>观众(<span id="onlineNum">0</span>)</h1>
        <div id="onlineUsers" class="member-tab-content-body userlist"></div>
      </div>
    </div>

  </div>
  <div class="clear"></div>
  <!--下面弄成左右结构-->
  <div class="dynamic">
  	<div class="dynamic_left">
		<div class="room_505">
			<div class="room_505_xx">
                          <div class="room_505_xxtext"><h1><span class="nick_<?php echo $this->_tpl_vars['userinfo'][0]['uid']; ?>
"><?php echo $this->_tpl_vars['userinfo'][0]['nickname']; ?>
</span> 会所</h1>
					<div class="room_505_xx_pic">
						<img src="<?php echo $this->_tpl_vars['livecover']; ?>
" width="90" height="90">
                                                <p><span class="fenhong">房主：</span><span class="nick_<?php echo $this->_tpl_vars['userinfo'][0]['uid']; ?>
"><?php echo $this->_tpl_vars['userinfo'][0]['nickname']; ?>
</span><br>
						<span class="fenhong">简介：</span><?php echo $this->_tpl_vars['userinfo'][0]['description']; ?>
<br>
						<span class="fenhong">开通时间：</span><?php echo $this->_tpl_vars['start_time']; ?>
</p>
					</div>
				</div>
			</div>
			<div style="clear:both;"></div>
			<!--动态信息-->
			<!--<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => ($this->_tpl_vars['mutilroom_dynamic_path']), 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>
-->
			<?php if ($this->_tpl_vars['uid'] == $this->_tpl_vars['roomid']): ?>
			<?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "huoshow/module/weibo/weibo_user_send_dynamic.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>

			<?php endif; ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "weibo/weibo_user_dynamic.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<!--end-->
		</div>
	</div>
	<div class="dynamic_right">
		<div class="room_right_438">
			<div class="room_right_438_bt"><h1><img src="/huoshow/img/multi_live/xin.jpg" width="22" height="22" />粉丝排行榜</h1></div>
			<div class="right_438_text">
				<?php unset($this->_sections['f']);
$this->_sections['f']['name'] = 'f';
$this->_sections['f']['loop'] = is_array($_loop=$this->_tpl_vars['fanslist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<div class="right_438_textlist">
					<div class="yi_<?php echo $this->_sections['f']['index']; ?>
"><a target="_blank" href="http://space.huoshow.com/<?php echo $this->_tpl_vars['fanslist'][$this->_sections['f']['index']]['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['fanslist'][$this->_sections['f']['index']]['avatar']; ?>
" width="60" height="60" /></a></div>
					<div class="right_nema">
					<span class="nick_<?php echo $this->_tpl_vars['fanslist'][$this->_sections['f']['index']]['uid']; ?>
"><?php echo $this->_tpl_vars['fanslist'][$this->_sections['f']['index']]['nickname']; ?>
</span>
					<br>(<?php echo $this->_tpl_vars['fanslist'][$this->_sections['f']['index']]['uid']; ?>
)
					</div>
					<div class="right_shuzi"><?php echo $this->_tpl_vars['fanslist'][$this->_sections['f']['index']]['price']; ?>
</div>
				</div>
				<?php endfor; endif; ?>
			</div>
		</div>
		<div class="room_right_438">
			<div class="room_right_438_bt"><h1><img src="/huoshow/img/multi_live/maiba.jpg" width="22" height="22" />超级麦霸</h1></div>
			<div class="right_438_text">
				<?php unset($this->_sections['m']);
$this->_sections['m']['name'] = 'm';
$this->_sections['m']['loop'] = is_array($_loop=$this->_tpl_vars['micking']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<div class="right_438_textlist">
					<div class="yi_<?php echo $this->_sections['m']['index']; ?>
"><a target="_blank" href="http://space.huoshow.com/<?php echo $this->_tpl_vars['micking'][$this->_sections['m']['index']]['uid']; ?>
"><img src="<?php echo $this->_tpl_vars['micking'][$this->_sections['m']['index']]['avatar']; ?>
" width="60" height="60" /></a></div>
					<div class="right_nema">
					<span class="nick_<?php echo $this->_tpl_vars['micking'][$this->_sections['m']['index']]['uid']; ?>
"><?php echo $this->_tpl_vars['micking'][$this->_sections['m']['index']]['nickname']; ?>
</span>
					<br>(<?php echo $this->_tpl_vars['micking'][$this->_sections['m']['index']]['uid']; ?>
)
					</div>
					<div class="right_shuzi"><?php echo $this->_tpl_vars['micking'][$this->_sections['m']['index']]['time']; ?>
</div>
				</div>
				<?php endfor; endif; ?>
			</div>
		</div>
		
  </div>
  <!--end-->
</div>

<script src="/huoshow/js/jquery/jquery-ui.min.js"></script>
<script src="/huoshow/js/hui.js"></script>
<script src="/huoshow/js/multi_live.js"></script>
<script src="/huoshow/js/weibo.js"></script>