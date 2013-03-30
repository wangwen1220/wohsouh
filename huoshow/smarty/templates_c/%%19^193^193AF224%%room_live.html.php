<?php /* Smarty version 2.6.26, created on 2012-03-22 13:03:51
         compiled from home/room_live.html */ ?>
<link href="/huoshow/css/zhibo/master.css" rel="stylesheet" type="text/css" />
<div class="mn">
  <!--[diy=diycontenttop]--><div class="area" id="diycontenttop"></div><!--[/diy]-->
  <div class="bm bw0">
    <h1 class="mt"><img class="vm" src="/huoshow/img/zhibo/lv.jpg" alt="blog">直播</h1>
    <ul class="tb cl"> 	    	    
      <li class="a"><a href="home.php?mod=huoshow&do=live">我的直播</a></li> 
      <li><a href="home.php?mod=space&do=home&view=all">随便看看</a></li>
      <li class="o2"><a href="home.php?mod=huoshow&do=apply_room&room_id=<?php echo $this->_tpl_vars['userinfo'][0]['uid']; ?>
">申请多功能直播间</a></li>
    </ul>
    <div class="clear"></div>
    <div class="cst">
      <p><a href="home.php?mod=space&uid=<?php echo $this->_tpl_vars['homeowner_uid']; ?>
"><img src="<?php echo $this->_tpl_vars['userimages']; ?>
" height="96" width="96" /></a></p>
      <ul class="lh2">
        <li class="wel">HI！<?php echo $this->_tpl_vars['userinfo'][0]['nickname']; ?>
，欢迎参加火秀直播！</li>
      </ul>
      <div class="clear"></div>
    </div>

    <div id="live_rooms">
      <div class="ba"> 
        <a href="home.php?mod=huoshow&do=live" class="nopick bu">普通直播间</a> 
         <?php if ($this->_tpl_vars['ismutillive'] != 0 || $this->_tpl_vars['mutilive'] != 0): ?><a href="show.php?mod=huoshow&do=live&dou=1" class="bu pick">多功能直播间</a><?php endif; ?>
        <div class="clear"></div>
      </div>
      <div class="cst">
        <table width="38%" border="0" class="live_set">
          <tr>
            <td width="42%" rowspan="4"><a href="<?php echo $this->_tpl_vars['liveroom']; ?>
" class="ppic">
                <img src="<?php echo $this->_tpl_vars['usercover']; ?>
" height="90" width="120" /></a>
            </td>
            <td width="58%"><a href="<?php echo $this->_tpl_vars['liveroom']; ?>
"  class="hongse_c" target="_blank">开始直播</a></td>
          </tr>
          <tr>
            <td><a href="<?php echo $this->_tpl_vars['liveroom']; ?>
">更改直播封面</a></td>
          </tr>
          <tr>
            <td>直播总时长:<span class="pink"><?php echo $this->_tpl_vars['totaltime']; ?>
</span></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>

      <div class="cst">
	  <?php if ($this->_tpl_vars['userinfo'][0]['room_name'] != NULL): ?>
        <table width="71%" border="0" class="live_set">
          <tr>
            <td width="27%" rowspan="5"><a href="<?php echo $this->_tpl_vars['live']; ?>
show.php?mod=huoshow&op=mutilive&roomid=<?php echo $this->_tpl_vars['homeowner_uid']; ?>
" class="ppic"><img src="<?php echo $this->_tpl_vars['livecover']; ?>
" /></a></td>
            <td width="33%">房间名：<span class="dyset"><?php echo $this->_tpl_vars['userinfo'][0]['room_name']; ?>
</span></td>
            <td width="18%"><?php if ($this->_tpl_vars['room_expire'] == 1): ?><a href="/home.php?mod=huoshow&do=apply_room&room_id=<?php echo $this->_tpl_vars['userinfo'][0]['roomid']; ?>
" style="color:#red;">续费</a><?php else: ?><!--<a href="<?php echo $this->_tpl_vars['live']; ?>
show.php?mod=huoshow&op=mutilive&uid=<?php echo $this->_tpl_vars['homeowner_uid']; ?>
&roomid=<?php echo $this->_tpl_vars['homeowner_uid']; ?>
&type=1" class="sor_b">进入房间</a>--><a href="<?php echo $this->_tpl_vars['live']; ?>
mv<?php echo $this->_tpl_vars['homeowner_uid']; ?>
" class="sor_b">进入房间</a><?php endif; ?> </td>
            <td width="22%"> <!--升本月活跃天数:<span class="dyset">10天</span>--></td>
          </tr>
          <tr>
            <td>直播间类型： <span class="dyset"><?php echo $this->_tpl_vars['userinfo'][0]['room_type_name']; ?>
 </span></td>
            <td><a href="/home.php?mod=huoshow&do=apply_room&room_id=<?php echo $this->_tpl_vars['userinfo'][0]['roomid']; ?>
" class="sor_b">升级</a></td>
            <td>总消耗火币: <span class="dyset"><?php echo $this->_tpl_vars['userinfo'][0]['huo']; ?>
</span></td>
          </tr>
          <tr>
            <td>管理员：<span class="dyset"><?php echo $this->_tpl_vars['userinfo'][0]['manage']; ?>
 人</span></td>
            <td><a href="/home.php?mod=huoshow&do=mutilive_room_manager&room_id=<?php echo $this->_tpl_vars['userinfo'][0]['roomid']; ?>
" class="sor_b">管理</a></td>
            <td>我的礼物券: <span class="dyset"><?php echo $this->_tpl_vars['user_huo']; ?>
</span></td>
          </tr>
          <tr>
            <td>创建于：<span class="dyset"><?php echo $this->_tpl_vars['start_time']; ?>
 </span></td>
            <td><a href="/home.php?mod=huoshow&do=multilive_room_apply&room_id=<?php echo $this->_tpl_vars['userinfo'][0]['roomid']; ?>
" class="sor_b">修改属性</a></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>房间有效期：<span class="dyset"><?php echo $this->_tpl_vars['expire_times']; ?>
</span></td>
            <td></td>
            <td>&nbsp;</td>
          </tr>
        </table>
		<?php endif; ?>
		<div class="ba1">多功能直播间管理：</div>
		<?php unset($this->_sections['a']);
$this->_sections['a']['name'] = 'a';
$this->_sections['a']['loop'] = is_array($_loop=$this->_tpl_vars['mutilive']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
?>
           <table width="71%" border="0" class="live_set">
 			 <tr>
    			<td width="27%" rowspan="4"><a href="<?php echo $this->_tpl_vars['live']; ?>
show.php?mod=huoshow&op=mutilive&roomid=<?php echo $this->_tpl_vars['mutilive'][$this->_sections['a']['index']]['roomid']; ?>
" class="ppic"><img src="<?php echo $this->_tpl_vars['livecovers'][$this->_sections['a']['index']]; ?>
" /></a></td>
    			<td width="33%">房主：<span class="dyset"><?php echo $this->_tpl_vars['mutilive'][$this->_sections['a']['index']]['username']; ?>
</span></td>
    			<td width="14%"><!--<a href="<?php echo $this->_tpl_vars['live']; ?>
show.php?mod=huoshow&op=mutilive&uid=<?php echo $this->_tpl_vars['homeowner_uid']; ?>
&roomid=<?php echo $this->_tpl_vars['mutilive'][$this->_sections['a']['index']]['roomid']; ?>
&type=2" class="sor_b">进入房间</a>--><a href="<?php echo $this->_tpl_vars['live']; ?>
mv<?php echo $this->_tpl_vars['mutilive'][$this->_sections['a']['index']]['roomid']; ?>
" class="sor_b">进入房间</a></td>
    			<td width="26%">&nbsp;</td>
  			</tr>
  			<tr>
    			<td>直播间类型： <span class="dyset"><?php echo $this->_tpl_vars['mutilive'][$this->_sections['a']['index']]['room_type_name']; ?>
 </span></td>
    			<td><a href="home.php?mod=huoshow&do=live&roomid=<?php echo $this->_tpl_vars['mutilive'][$this->_sections['a']['index']]['roomid']; ?>
&delete=manager" onclick="return confirm('确定要退出管理？')" class="sor_b">退出管理</a></td>
    			<td>&nbsp;</td>
    			<td>&nbsp;</td>
   			 </tr>
  			<tr>
    			<td>创建于：<span class="dyset"><?php echo $this->_tpl_vars['start_times'][$this->_sections['a']['index']]; ?>
</span></td>
    			<td colspan="2">我领到的礼物券: <span class="dyset"><?php echo $this->_tpl_vars['pointticket_price'][$this->_sections['a']['index']]['price']; ?>
</span></td>
    			<td>&nbsp;</td>
    			<td>&nbsp;</td>
  			</tr>
		</table>
		<?php endfor; endif; ?>
      </div>
      </div>
    </div>
    <script>
    var sssss=<?php echo $this->_tpl_vars['duo']; ?>

      <?php echo '
      make_pagebox(\'live_rooms\', {
        links_selector: \'.ba a\',
        pages_selector: \'.cst\',
        current_class: \'pick\',
        current: sssss
        
      });
      '; ?>

    </script>

  </div>	
</div>
<div class="clear"></div>