//调用swf对象的方法，第一个参数为swf对象的ID，
//第二个是方法名称，第三个开始是要调用方法的参数
function callSwf(swfId, funName) {
  var swf = document.getElementById(swfId);
  var args = Array.prototype.slice.call(arguments, 2);
  HUI.debug('callSwf(', swfId, ',', funName, ',', args, ')');
  return swf[funName].apply(swf, args);
}

var LIVE = {};

LIVE._SWFID_CHAT = 'chat_client';
LIVE._SWFID_MULTICTRL = 'multictrl_object';
LIVE._SWFID_CAMS = {
  1: 'cam1_object',
  2: 'cam2_object',
  3: 'cam3_object'
};

/*用户类型*/
LIVE._USERTYPES = {
  1: {className: 'u-web-admin'}, //超管
  2: {className: 'u-room-owner'}, //房主
  3: {className: 'u-room-admin'}, //管理员
  4: {className: 'u-room-user'}, //注册用户
  5: {className: 'u-room-guest'}  //游客
};

LIVE.user = { uid: ENV.userId, usertype: ENV.userType, username: ENV.userName };
LIVE.dest = { uid: "allusers", username: "所有人" };
LIVE.room = { roomId: ENV.roomId, roomType: ENV.roomType };
LIVE.owner = { uid: ENV.ownerId, usertype: ENV.ownerType };

LIVE.maxMic = parseInt(ENV.roomMType);
LIVE.huocoin = 0;
LIVE._isAutoScroll = true;
LIVE._scrollLogTimer = true;
LIVE._userlist = {};
LIVE._recentlist = {};
LIVE._recentlistCount = 0;
LIVE._takelist = [];
LIVE._waitlist = [];
LIVE._adminlist = {};

LIVE.changeLineSeq = function(uid, order) {
  callSwf(this._SWFID_CHAT, 'changeLineSeq', uid, order);
};

LIVE.inCam = function(uid, camId) {
  var username = this.getUserNameByUid(uid);
  callSwf(this._SWFID_CHAT, 'inCam', uid, username, camId);
};

LIVE.openCamSetting = function() {
  callSwf(this._SWFID_MULTICTRL, 'openConfig');
};

LIVE.loadVideo = function(uid, camId, stream, forbid) {
  var username = this.getUserNameByUid(uid);
  var cam = this._SWFID_CAMS[camId];
  if(cam){
    callSwf(cam, 'loadVideo', uid, username, stream, forbid);
  }
};

LIVE.lineUp = function() {
  callSwf(this._SWFID_MULTICTRL, 'lineUp');
};

LIVE.outLine = function() {
  callSwf(this._SWFID_CHAT, 'outLine');
};

//断开连接
LIVE.socketStop = function () {
  callSwf(this._SWFID_CHAT, 'socketStop');
};

//发送消息
LIVE.sendMessage = function () {
  var priv = "0";
  if (HUI.$("#isPrivate").attr('checked') == true) priv = "1";
  if (priv == "1" && LIVE.dest.uid == 'allusers') {
    LIVE.alertBox("请选择私聊对象");
    HUI.$("#users").focus();
    return false;
  }
  //检查内容
  var msg = HUI.$("#inputMessage").val();
  if (HUI.$.trim(msg) == "") {
    LIVE.alertBox("请填写聊天内容再点发送！");
    HUI.$("#inputMessage").focus();
    return false;
  }
  if (msg.length > 200) {
    LIVE.alertBox("聊天内容不能大于200个字符!");
    HUI.$("#inputMessage").focus();
    return false;
  }
  callSwf(this._SWFID_CHAT, 'sendMessage', LIVE.dest.uid, 0, priv, HUI.htmlEscape(msg));
  HUI.$("#inputMessage").val("").focus();
};

//喝彩
LIVE.clap = function () {
  var _this = this;
  if(!this.clapList) {
    HUI.$.ajax({
      url: '/static2/live/clap_list.txt',
      dataType: "text",
      async: false,
      success: function (d) {
        _this.clapList = d.replace(/[\n\r]+/g, ';')
        .replace(/^;|;$/, '').split(';');
      }
    });
  }
  if(this.clapList) {
    var msg = this.clapList[Math.ceil(Math.random()*(this.clapList.length-1))];
    callSwf(this._SWFID_CHAT, 'sendMessage', 'allusers', 0, 0, HUI.htmlEscape(msg));
  }
};

//禁言、解禁开关
LIVE.canSpeak = function (uid, value) {
  if(value){
    callSwf(this._SWFID_CHAT, 'adminAction', 1, uid, 0);
  }else{
    callSwf(this._SWFID_CHAT, 'adminAction', 1, uid, 300);
  }
};

//踢人
LIVE.kick = function (uid) {
  callSwf(this._SWFID_CHAT, 'adminAction', 2, uid, 300);
};

//设置管理员
LIVE.setAdmin = function (uid, value) {
  value = value? 1: 0;
  callSwf(this._SWFID_CHAT, 'setAdmin', uid, value);
};

//送魅力之星
LIVE.sendStar = function () {
  callSwf(this._SWFID_CHAT, 'sendGift', 1, LIVE.owner.uid, '', '');
};

//送礼物
LIVE.sendGift = function (dstId, giftId, count) {
  callSwf(this._SWFID_CHAT, 'sendGift', 2, dstId, giftId, count);
};

//抢宝箱
LIVE.catchChest = function (key) {
  callSwf(this._SWFID_CHAT, 'catchChest', 1, key);
};

//自动滚屏开关
LIVE.setAutoScroll = function (o) {
  if(this._isAutoScroll) {
    o.innerHTML = "自动滚屏";
  }else{
    o.innerHTML = "停止滚屏";
  }
  this._isAutoScroll = !this._isAutoScroll;
  return false;
};

//滚屏
LIVE.scrollLog = function () { 
  if (LIVE._isAutoScroll) {
    var chatLogBox1 = HUI.el("chat_log1_w");
    var chatLogBox2 = HUI.el("chat_log2_w");
    chatLogBox1.scrollTop = 99999;
    chatLogBox2.scrollTop = 99999;
  }
};

//清屏
LIVE.clearLog = function () {
  HUI.el("message_list").innerHTML = "";
  HUI.el("my_message_list").innerHTML = "";
};

//添加聊天记录
LIVE.log = function (m, priv) {
  var msgbox = priv? HUI.el("my_message_list"): HUI.el("message_list");
  if(msgbox.children.length >32) {
    msgbox.removeChild(msgbox.firstChild);
  }
  var elem = document.createElement('div');
  msgbox.appendChild(elem);
  elem.className = "message";
  elem.innerHTML = this._replaceFaces(m);
  clearTimeout(this._scrollLogTimer);
  this._scrollLogTimer = setTimeout(this.scrollLog);
};

//弹出一个提示框
LIVE.alertBox = function (s) {
  var liveAlert = HUI.$('#live_alert');
  if(!liveAlert.length){
    HUI.$(document.body).append('<div id="live_alert"></div>');
    liveAlert = HUI.$('#live_alert');
  }
  liveAlert.html(s).css({
    left: (HUI.$(window).width() - liveAlert.width())/2 + 'px',
    top: (HUI.$(window).height() - liveAlert.height())/2 + 'px'
  }).show();
  clearTimeout(LIVE.alertBox.timer);
  LIVE.alertBox.timer = setTimeout(function(){
    liveAlert.hide();
  }, 5000);
};

//选择表情
LIVE.insertFace = function (id) {
  var o = HUI.el('inputMessage');
  o.value += ['{', id, '}'].join('');
  o.focus();
};

//创建一表情图片标签
LIVE.makeFaceHTML = function (faceId) {
  return ['<img src="\/static2\/images\/face\/face', faceId, '.gif" \/>'].join('');
};

//替换表情
LIVE._replaceFaces = function (msg) {
  return msg.replace(/\{(\d+)\}/g, LIVE.makeFaceHTML('$1'));
};

//判断是不是游客身份
LIVE.isGuest = function (user) {
  return user.usertype == '5';
};

//判断是不是登录用户身份
LIVE.isUser = function (user) {
  return user.usertype == '4';
};

//判断有没有管理权限
LIVE.inAdminGroup = function (user) {
  return user.usertype <= '3';
};

//判断是不是一个登录用户
LIVE.inUserGroup = function (user) {
  return user.usertype <= '4';
};

//判断是不是房间管理员
LIVE.isRoomAdmin = function (user) {
  return user.usertype == '3';
};

//判断是不是房主
LIVE.isRoomOwner = function (user) {
  return user.usertype == '2';
};

//创建一个用户菜单
LIVE.makeUserMenu = function (uid, menuType) {
  if(uid == this.user.uid){
    return '';
  }
  var user = LIVE.getUser(uid);
  if(!user || this.isGuest(this.user)){
    return '';
  }
  var html = ['<div class="u-menu"><div class="menu-body">'];
  html.push('<a href="javascript:;" popupboxaction="hide" onmousedown="LIVE.seluser(\'', user.uid, '\');">与TA聊天</a>');

  if(this.inAdminGroup(this.user) && user.usertype > this.user.usertype) {
    if(menuType == 1){
      html.push('<a href="javascript:;" popupboxaction="hide" onmousedown="LIVE.kick(\'', user.uid, '\');">请TA出去</a>');
      if(this.inUserGroup(user)) {
        if(user.cansay == "1") {
          html.push('<a href="javascript:;" popupboxaction="hide" onmousedown="LIVE.canSpeak(\'',
          user.uid, '\', false);">禁止发言</a>');
        }else{
          html.push('<a href="javascript:;" popupboxaction="hide" onmousedown="LIVE.canSpeak(\'',
          user.uid, '\', true);">恢复发言</a>');
        }
        if(this.isRoomOwner(this.user)) {
          if(this.isRoomAdmin(user)) {
            html.push('<a href="javascript:;" popupboxaction="hide" onmousedown="LIVE.setAdmin(\'',
            user.uid, '\', false);">取消管理</a>');
          }else{
            html.push('<a href="javascript:;" popupboxaction="hide" onmousedown="LIVE.setAdmin(\'',
            user.uid, '\', true);">设为管理</a>');
          }
        }
      }
    }else if(menuType == 2){
      var max = LIVE.maxMic;
      html.push('<a href="javascript:;" popupboxaction="hide" onmousedown="LIVE.inCam(\'', user.uid, '\', 1);">把TA上到主麦</a>');
      html.push('<a href="javascript:;" popupboxaction="hide" onmousedown="LIVE.inCam(\'', user.uid, '\', 2);">把TA上到一麦</a>');
      html.push('<a href="javascript:;" popupboxaction="hide" onmousedown="LIVE.inCam(\'', user.uid, '\', 3);">把TA上到二麦</a>');
      for(var i=max+1, l=this._waitlist.length+max+1; i<l; i++){
        html.push('<a href="javascript:;" popupboxaction="hide" ',
          'onmousedown="LIVE.changeLineSeq(\'', user.uid, '\', ', i-max, ');">移至第', i, '位</a>');
      }
    }
  }

  html.push('</div></div>');
  return html.join('');
};

//创建一个用户列表
LIVE.createUserList = function (userlist, listType) {
  var list = ['<table style="width:100%">'];
  for(var i=0, l=userlist.length; i<l; i++) {
    var user = userlist[i];
    var classNames = [this._USERTYPES[user.usertype].className];
    var num = '';
    var micName = '';
    var menuType = 1;
    if(!(i%2)){
      classNames.push('odd');
    }
    if(LIVE.user.uid == user.uid && LIVE.user.usertype == 5){
      classNames.push('current-user');
    }
    if(listType == 2){
      num = i+1+'、';
      if(i<this.maxMic){
        classNames.push('take-item');
        micName = user.vid==1? '(主麦)': user.vid==2? '(一麦)': '(二麦)';
      }else{
        menuType = 2;
      }
    }
    if(listType == 3){
      if(user.online == 1){
      }else{
        classNames.push('offline');
      }
    }
    list.push('<tr><td>', '<a href="javascript:;" menutrigger="menu_user" menutype="', menuType,
      '" uid="', user.uid, '" onclick="LIVE.seluser(\'', user.uid, '\');return false;" class="',
      classNames.join(' '), '"><span>', '<em>', num, '</em>',
    user.username, micName, '<br/>', user.uid, '', '</span></a></td></tr>');
  }
  list.push('</table>');
  return list.join('');
};

//按类型排序
LIVE._sortByUsertype = function (a, b) {
  a = a.usertype;
  b = b.usertype;
  return a-b;
};

//按在线状态排序
LIVE._sortByOnline = function (a, b) {
  a = !!parseInt(a.online);
  b = !!parseInt(b.online);
  return b-a;
};

//按麦序排序
LIVE._sortByVid = function(a, b){
  a = a.vid;
  b = b.vid;
  return a-b;
};

//刷新用户列表
LIVE.refreshUserlist = function () {
  var userlist = [];
  for(var i in this._userlist) {
    var user = this._userlist[i];
    userlist.push(user);
  }
  userlist.sort(this._sortByUsertype);
  HUI.el("onlineNum").innerHTML = userlist.length;
  HUI.el("onlineUsers").innerHTML = this.createUserList(userlist, 1);
};

//刷新管理员列表
LIVE.refreshAdminList = function () {
  var adminlist = [];
  for(var i in this._adminlist) {
    var user = this._adminlist[i];
    adminlist.push(user);
  }
  adminlist.sort(this._sortByUsertype);
  adminlist.sort(this._sortByOnline);
  HUI.el("adminlist_length").innerHTML = adminlist.length;
  HUI.el("adminlist").innerHTML = this.createUserList(adminlist, 3);
};

//根据UID从在线列表中得到一个用户
LIVE.getUser = function (uid) {
  return this._userlist[uid];
};

//根据UID从在线列表中得到一个用户的用户名
LIVE.getUserNameByUid = function (uid) {
  var u = this.getUser(uid);
  if(u){
    return u.username;
  }
  return '';
};

//往在线列表中添加一个用户
LIVE.addUser = function (user) {
  this._userlist[user.uid] = user;
};

//从在线列表中删除一个用户
LIVE.removeUser = function (uid) {
  delete this._userlist[uid];
};

//选中一个聊天对象
LIVE.seluser = function (uid) {
  if(uid == this.user.uid){
    return false; 
  }
  var u = this.getUser(uid);
  if(u){
    this.dest.uid = u.uid;
    this.dest.name = u.username;
    HUI.$("#btn_recentlist").html(this.dest.name);
    this.recentlistAdd(u);
  }
};

//往管理员列表中添加一个用户
LIVE.addAdmin = function (user) {
  this._adminlist[user.uid] = user;
};

//从管理员列表中删除一个用户
LIVE.removeAdmin = function (uid) {
  delete this._adminlist[uid];
};

//从管理员列表中获得一个用户
LIVE.getAdmin = function (uid) {
  return this._adminlist[uid];
};

//往在在麦表中添加一个用户
LIVE.takelistAdd = function (user) {
  this.takelistRemove(user.uid);
  this._takelist.push(user);
};

//从在卖列表中移除一个用户
LIVE.takelistRemove = function (uid) {
  var i = this._takelist.length;
  while(i--){
    if(this._takelist[i].uid == uid){
      this._takelist.splice(i, 1);
      break;
    }
  }
};

//从在卖列表中获得一个用户
LIVE.takelistGet = function (uid) {
  var i = this._takelist.length;
  while(i--){
    var user = this._takelist[i];
    if(user.uid == uid){
      return user;
    }
  }
  return null;
};

//往在麦列表中添加一个用户
LIVE.waitlistAdd = function (user) {
  this.waitlistRemove(user.uid);
  this._waitlist.push(user);
};

//往在麦列表中插入一个用户
LIVE.waitlistInsert = function (user, order) {
  this.waitlistRemove(user.uid);
  this._waitlist.splice(order, 0, user);
};

//从在麦列表中删除一个用户
LIVE.waitlistRemove = function (uid) {
  var i = this._waitlist.length;
  while(i--){
    if(this._waitlist[i].uid == uid){
      this._waitlist.splice(i, 1);
      break;
    }
  }
};

//从在麦列表中获得一个用户
LIVE.waitlistGet = function (uid) {
  var i = this._waitlist.length;
  while(i--){
    var user = this._waitlist[i];
    if(user.uid == uid){
      return user;
    }
  }
  return null;
};

//刷新麦列表
LIVE.refreshMicList = function () {
  var takelist = this._takelist;
  takelist.sort(this._sortByVid);
  var waitlist = this._waitlist
  var miclist = takelist.concat(waitlist);
  HUI.el("miclist_length").innerHTML = miclist.length;
  HUI.el("miclist").innerHTML = this.createUserList(miclist, 2);
};

//选择一个最近用户
LIVE.selRecentUser = function (o) {
  this.dest.uid = o.getAttribute('uid');
  this.dest.name = o.getAttribute('username');
  HUI.$("#btn_recentlist").html(this.dest.name);
};

//添加一个最近用户
LIVE.recentlistAdd = function (user) {
  if(!!this._recentlist[user.uid]){
    return;
  }
  if(this._recentlistCount >= 10){
    for(var key in this._recentlist){
      delete this._recentlist[key];
      this._recentlistCount--;
      break;
    }
  }
  this._recentlist[user.uid] = user;
  this._recentlistCount++;
  this.refreshRecentlist();
};

//刷新最近用户列表
LIVE.refreshRecentlist = function () {
  var tmp = ['<table><tr><td>', 
    '<a href="javascript:;" uid="allusers" username="所有人" ',
  'onmousedown="LIVE.selRecentUser(this);" popupboxaction="hide">'];
  tmp.push('<span>所有人</span></a></td></tr>');
  for(var i in this._recentlist){
    var user = this._recentlist[i];
    tmp.push('<tr><td><a href="javascript:;" popupboxaction="hide" uid="', user.uid,
      '" username="', user.username, '" onmousedown="LIVE.selRecentUser(this);"><span>',
    user.username, '</span></a></td></tr>');
  }
  tmp.push('</table>');
  HUI.el("recentlist").innerHTML = tmp.join('');
};

LIVE._handleMsgInputKeypress = function (e) {
  if(e.which == 13) {
    LIVE.sendMessage();
    return false;
  }
};

/*连接消息服务器*/
LIVE.connect = function () {
  callSwf(this._SWFID_CHAT, 'socketStart', ENV.chatServerHost, ENV.chatServerPort, ENV.roomId,
  LIVE.user.usertype, LIVE.user.uid, LIVE.user.username, ENV.roomMType);
}


HUI.$(function(){
  if(ENV.roomType == '0' && checkFlashVersion(10, 2)<1) {
    alert('要正常使用直播功能，请升级您的Flash插件到最近版本！');
    return;
  }

  make_pagebox('congzhiringht', {
    links_selector: '.room_right_xx a',
    pages_selector: '.member-tab-content',
    current: 2,
    current_class: 'on'
  });

  make_hoverbox("notices_t", function () {
    var h = HUI.$('#notices_ex').height();
    HUI.$("#notices_ex_if").css("height", h+"px");
  }, function () {
    HUI.$("#notices_ex_if").css("height", "0");
  });

  if(ie6) { 
    window.onscroll = function(){
      setTimeout(function () {
        HUI.el("notice_box").style.visibility = 'hidden';
        HUI.el("notice_box").style.visibility = 'visible';
      }, 15);
    };
  }

  HUI.$("#btn_recentlist").pickBox('recentlist', {site: 'tl'});

  HUI.$("#btn_face").pickBox('face_box', {
    site: 'tc',
    onshow: function(){
      var facesHTML = [];
      for(var i=1; i<49; i++){
        facesHTML.push('<a href="javascript:;" popupboxaction="hide" faceid="', i, '">',
          '<img src="\/static2\/images\/face\/face', i, '.gif" width="24" height="24" \/>',
        '<\/a>');
      }
      HUI.$(this.getNode()).html(facesHTML.join('')).find('a').mousedown(function(e){
        e.preventDefault();
        LIVE.insertFace(this.getAttribute('faceid'));
      });
      this.onshow = null;
    }
  });

  HUI.$("#btn_giftbox").pickBox('giftbox', {
    site: 'tl',
    onshow: function(){
      var box = this;
      HUI.$(box.getNode()).append('<div class="loading"><span>&nbsp;</span></div>');
      HUI.$(box.getNode()).load('/show.php?operation=ajax&tab=get_all_gift_list', function(){
        make_pagebox("giftbox", {
          links_selector: ".lipin-tabs a",
          pages_selector: ".lipin-b",
          current_class: "on",
          effect:1
        });

        HUI.$(".lipin-b a").click(function (e) {
          e.preventDefault();
          var giftId = this.getAttribute('giftId');
          var giftName = this.getAttribute('giftName');
          HUI.$('#giftid').val(giftId);
          HUI.$('#btn_giftbox').html(giftName);
          HUI.$(document).trigger('mousedown');
        }).tipBox('gift_tip', {site: 'bl', onshow: function(target){
          var price = target.getAttribute('giftPrice');
          var html = ['<span>&nbsp;</span>价格：<strong>', price,
            '</strong>火币/个<br />您还可以购买：<strong>',
            Math.floor(LIVE.huocoin/price), '</strong>个'].join('');
            HUI.$(this.getNode()).html(html);
        }});

        HUI.$(box.getNode()).append(['<div class="gift-box-foot"><span class="coin">火币：<em id="hcoin">',
          LIVE.huocoin, '</em></span></div>'].join(''));

          box.onshow = null;
      });
    }
  }).bind('mousedown', function(e){
    HUI.$.ajax({
      async: false,
      cache: false,
      url: '/huoshow/module/commom/live_index_list.php?act=user_huocoin',
      success: function(data){
        LIVE.huocoin = parseInt(data);
        HUI.$('#hcoin').html(LIVE.huocoin);
      }
    });
  });

  HUI.$("#btn_clap").click(function(e){
    e.preventDefault();
    LIVE.clap();
  });

  HUI.$("#btn_clean").click(function(e){
    e.preventDefault();
    LIVE.clearLog();
  });

  HUI.$("#btn_autoscroll").click(function(e){
    e.preventDefault();
    LIVE.setAutoScroll(this);
  });

  HUI.$("#chat_log_box").layout({
    a: "#chat_log1_w",
    b: "#chat_log2_w"
  });

  //Enter发送消息
  HUI.listen("#inputMessage", 'keypress', LIVE._handleMsgInputKeypress);

  HUI.listen("#button_sendmsg", 'click', function(){
    LIVE.sendMessage();
  });

  //初始化用户菜单
  LIVE.userMenu = new HUI.PopupBox('menu_user', { site: 'lt' });
  LIVE.userMenu.onshow = function(trigger){
    var menuType = trigger.getAttribute('menutype');
    var uid = trigger.getAttribute('uid');
    this.getNode().innerHTML = LIVE.makeUserMenu(uid, menuType);
  };
  HUI.$(document).bind('mouseover', function(e){
    var trigger = HUI.searchUp(e.target, 'menutrigger', 10);
    if(trigger && trigger.getAttribute('menutrigger') == 'menu_user'){
      clearTimeout(LIVE.timer_userMenu);
      LIVE.timer_userMenu = setTimeout(function(){
        LIVE.userMenu.show(trigger);
      }, 0);
    }else{
      clearTimeout(LIVE.timer_userMenu);
      LIVE.userMenu.hide();
    }
  });

  HUI.$('.cam-setting-button').click(function(){
    if(LIVE.user.usertype == '5'){
      showWindow('login', 'http://space.zyc.huoshow.com/member.php?mod=logging&action=login');
    }else{
      LIVE.openCamSetting();
    }
  });

  HUI.$('.lineup').click(function(){
    if(LIVE.user.usertype == '5'){
      showWindow('login', 'http://space.zyc.huoshow.com/member.php?mod=logging&action=login');
    }else{
      if(this.className.indexOf('active')>-1){
        LIVE.outLine();
      }else{
        LIVE.lineUp();
      }
    }
  });
});

HUI.listen(window, 'load', function(e){
  var wait = window.navigator.userAgent.toLowerCase().indexOf('webkit')>-1? 2000: 0;
  setTimeout(function(){
    LIVE.connect();
  }, wait);
});

HUI.listen(window, 'unload', function(e){
  try{ LIVE.socketStop(); }catch(ex) {}
});


/*礼物*/
function givegift () {
  var giftid = HUI.el("giftid").value;
  var giftnum =parseInt(HUI.el("giftnum").value);
  var dstuid = HUI.el("targetuid").value;
  if(giftid.length<1) {
    LIVE.alertBox('请选择要赠送的礼物');
    return;
  }
  if(giftnum && giftnum>0 && giftnum<100) {
    LIVE.sendGift(dstuid, giftid, giftnum);
  }else{
    LIVE.alertBox('请填写正确的礼物数量');
  }
  HUI.el('giftid').value = '';
  HUI.el('giftnum').value = 1;
  HUI.$('#btn_giftbox').html('礼物盒子');
}

function hideGiftBox() {
  HUI.$(document).trigger('mousedown');
}

function setRoomBg() {
  showWindow('register', '/show.php?operation=ajax&tab=setRoomBg&t='+(new Date()).getTime());
}


function setNotice() {
  showWindow('register', '/show.php?operation=ajax&tab=setNotice&t='+(new Date()).getTime());
}



/*SWF callbacks*/

/*聊天消息*/
function receiveMessage(json) {
  json = unescape(json);
  HUI.printCallInfo();
  var o = HUI.parseJSON(json);
  if(o.type == "1") {
    var m = ['<div class="mt-sys">'];
    if(o.time){
      m.push('<span class="m-time">', o.time, '</span>');
    }
    m.push('<span class="m-msg">', o.msg, '</span></div>');
    LIVE.log(m.join(''));
  }else{
    var srcUser = LIVE.getUser(o.srcuid);
    var dstUser = LIVE.getUser(o.dstuid);
    var m = ['<div><span class="m-time">', o.time, '</span>'];
    m.push('<span><a class="', LIVE._USERTYPES[srcUser.usertype].className,
      '" href="javascript:;" menutrigger="menu_user" uid="', o.srcuid, 
      '" onclick="LIVE.seluser(\'', o.srcuid, '\');">',
    srcUser.username, '</a></span>');
    if(o.dstuid != 'allusers') {
      m.push('对<span><a class="', LIVE._USERTYPES[dstUser.usertype].className,
        '"href="javascript:;" menutrigger="menu_user" uid="', o.dstuid,
        '" onclick="LIVE.seluser(\'', o.dstuid, '\');">',
      dstUser.username, "</a></span>：");
    }else{
      m.push('：');
    }
    m.push(o.msg, '</div>');
    m = m.join('');
    if(o.priv == '1') {
      LIVE.log(m, true);
    }else{
      LIVE.log(m);
      if(o.srcuid == LIVE.user.uid || o.dstuid == LIVE.user.uid){
        LIVE.log(m, true);
      }
    }
  }
}


/*更新当前用户资料*/
function updateUserInfo(o) {
  HUI.printCallInfo();
  o = HUI.parseJSON(o);
  LIVE.user.uid = o.uid;
  LIVE.user.username = o.username;
  LIVE.user.usertype = o.usertype;
  LIVE.user.cansay = o.cansay;
}


/*更新观众列表*/
function updateUserList(o) {
  HUI.printCallInfo();
  o = HUI.parseJSON(o);
  var users = {};
  var admins = {};
  var adminlist = HUI.parseJSON(ENV.roomadminlist);
  for(var i=0,l=adminlist.length; i<l; i++) {
    var admin = adminlist[i];
    admins[admin.uid] = admin;
  }
  for(var i=0,l=o.userlist.length; i<l; i++) {
    var user = o.userlist[i];
    users[user.uid] = user;
    if(LIVE.inAdminGroup(user)){
      admins[user.uid] = user;
    }
  }
  LIVE._userlist = users;
  LIVE._adminlist = admins;
  LIVE.refreshUserlist();
  LIVE.refreshAdminList();
}


/*生成宝箱*/
function buildChest(o) {
  HUI.printCallInfo();
  o = HUI.parseJSON(o);
  var m = ['<div class="mt-sys">',
    '您在聊天室里聊得正开心，突然天上掉下来一个宝箱',
    '<a href="javascript:LIVE.catchChest(\'', o.value, '\');">',
    '<img src="/static/image/randbox/box1.gif" /></a>',
    '，快去抢啊！</div>'].join('');
    LIVE.log(m);
}


/*用户进出*/
function userInOrOut(o) {
  HUI.printCallInfo();
  o = HUI.parseJSON(o);
  for(var i=0, l=o.userlist.length; i<l; i++) {
    var user = o.userlist[i];
    if(o.act == "enter") {
      user.online = 1;
      LIVE.addUser(user);
      if(LIVE.inAdminGroup(user)){
        LIVE.addAdmin(user);
      }
      printSysMsg(['欢迎[', user.username, ']进入'].join(''));
    }else if(o.act == "leave") {
      if(user.mode == '0') {
        //离开
      }else if(user.mode == '1') {
        //掉线
      }else if(user.mode == '2') {
        var username = LIVE.getUserNameByUid(user.uid);
        printSysMsg(['[', username, ']被[', user.username, ']一脚踢出'].join(''));
        if(user.uid == LIVE.user.uid) {
          setCookie("kicked", LIVE.room.roomId, 5*60);
          location.reload();
        }
      }
      LIVE.removeUser(user.uid);
      var admin = LIVE.getAdmin(user.uid);
      if(admin){
        if(admin.usertype == 1){
          LIVE.removeAdmin(admin.uid);
        }else{
          admin.online = 0;
        }
      }
    }
  }
  LIVE.refreshUserlist();
  LIVE.refreshAdminList();
}


/*系统消息*/
function printSysMsg(str) {
  str = unescape(str);
  var m = ['<div class="mt-sys">', str, '</div>'].join('');
  LIVE.log(m);
}


/*禁言状态更新*/
function getAdminAction(o) {
  HUI.printCallInfo();
  o = HUI.parseJSON(o);
  var user = LIVE.getUser(o.dstuid);
  if(!user) return;

  var m = '';
  var priv = false;
  if(o.act == '1') {
    if(parseInt(o.value) > 0) {
      user.cansay = 0;
      m = ['[', user.username, ']被[', LIVE.getUserNameByUid(o.srcuid), ']禁言'].join('');
    }else{
      user.cansay = 1;
      m = ['[', user.username, ']恢复发言'].join('');
    }
    if(o.dstuid == LIVE.user.uid) {
      priv = true;
    }
  }
  m = ['<div class="mt-sys">', m, '</div>'].join('');
  LIVE.log(m, priv);
  LIVE.refreshUserlist();
}


/*更新权限*/
function setAdminResult(o) {
  HUI.printCallInfo();
  o = HUI.parseJSON(o);
  var m = '';
  var priv = false;

  if(o.act == '1') {
    var user = LIVE.getUser(o.dstuid);
    if(!user) return;
    user.usertype = 3;
    m = ['[', user.username, ']被[', LIVE.getUserNameByUid(o.srcuid), ']设为管理员'].join('');
    LIVE.addAdmin(user);
    var u = LIVE.takelistGet(user.uid) || LIVE.waitlistGet(user.uid);
    if(u){
      u.usertype = 3;
    }
  }else{
    var user = LIVE.getAdmin(o.dstuid);
    if(!user) return;
    user.usertype = 4;
    m = ['[', user.username, ']被取消管理员身份'].join('');
    LIVE.removeAdmin(user.uid);
    var u = LIVE.takelistGet(user.uid) || LIVE.waitlistGet(user.uid);
    if(u){
      u.usertype = 4;
    }
  };

  if(o.dstuid == LIVE.user.uid){
    LIVE.user.usertype = user.usertype;
    priv = true;
  }

  m = ['<div class="mt-sys">', m, '</div>'].join('');
  LIVE.log(m, priv);

  LIVE.refreshUserlist();
  LIVE.refreshAdminList();
  LIVE.refreshMicList();
}


/*收到礼物*/
function acceptGift(json) {
  HUI.printCallInfo();
  var o = HUI.parseJSON(json);
  if(o.act == '2') {
    var tmp = o.t1;
    var img = ['<img src="static2/images/gift/', ENV.giftFiles[o.param1], '" width="70" height="70" />'].join('');
    var imgs = [];
    for(var i=0, l=parseInt(o.param2); i<l; i++) {
      imgs.push(img);
    }
    imgs = imgs.join('');
    tmp = tmp.replace('{icon}*{num}', imgs).replace('{icon}', img).replace('{num}', o.param2);
    var m = ["<div class='mt-sys'><span class='m-time'>",
      o.time, "</span>", tmp, "</div>"].join('');
      LIVE.log(m);
  }
}


/*送礼结果*/
function sendGiftResult(o) {
  o = unescape(o);
  HUI.printCallInfo();
  o = HUI.parseJSON(o);
  if(o.result == 'succ') {
    if(o.act == 1) {
      voteSuccess();
    }
  }else{
    printSysMsg(o.msg);
    if(o.act == 1) {
      VOTE_ENABLED = true;
    }
  }
}


function updatePopular(o) {
  HUI.printCallInfo();
  o = HUI.parseJSON(o);
  if(o) {
    HUI.$('#charm_value').html(o.charm);
    HUI.$('#vote_value').html(o.votes);
    HUI.$('#score_value').html(o.exponent);
    HUI.$('#paiming_value').html(o.rank);
  }
}


function showNotice(o) {
  HUI.printCallInfo();
  o = HUI.parseJSON(o);
  if(o) {
    var notices = HUI.el('notices');
    if(notices.children.length>4){
      notices.removeChild(notices.firstChild);
    }
    var li = document.createElement('li');
    notices.appendChild(li);
    var msg = ['<span class="notice-time">', o.time, '</span>', o.msg].join('');
    li.innerHTML = msg;
    HUI.el('notice_first').innerHTML = msg;
  }
}


function callServer(o) {
  HUI.printCallInfo();
  if(o == 1){
    if(typeof LIVE.currFansRank === 'function'){
      LIVE.currFansRank();
    }
  } else if(o == '2'){
    HUI.$.get(['/api/zhibo.php?act=getUserinfo&uid=', LIVE.room.roomId, '&t=', (new Date).getTime()].join(''), function(data){
      HUI.$('#owner_info').html(data);
    });
  } else if(o == '3'){
    HUI.$.get(['/huoshow/module/show/ajax/show_setting_away_config.php?act=getNotice&roomid=', LIVE.room.roomId,
      '&t=', (new Date).getTime()].join(''), function(data){
        HUI.$('#room_notice').html(data);
      });
  }
}


function nameChanged(o) {
  HUI.printCallInfo();
  o = HUI.parseJSON(o);

  var user = LIVE.getUser(o.uid);
  if(user){
    user.username = o.username;
    LIVE.refreshUserlist();
  }

  user = LIVE.getAdmin(o.uid);
  if(user){
    user.username = o.username;
    LIVE.refreshAdminList();
  }

  var waitUser = LIVE.waitlistGet(o.uid);
  if(waitUser){
    waitUser.username = o.username;
  }

  var takeUser = LIVE.takelistGet(o.uid);
  if(takeUser){
    takeUser.username = o.username;
  }

  if(waitUser || takeUser){
    LIVE.refreshMicList();
  }

  try{
    LIVE._recentlist[o.uid].username = o.username;
    LIVE.refreshRecentlist();
    if(HUI.el('btn_recentlist').innerHTML == tmp){
      HUI.el('btn_recentlist').innerHTML = o.username;
    }
  }catch(e){}
  if(o.uid == LIVE.user.uid){
    HUI.$('.user-bar-nick').html(o.username);
  }

  HUI.$('.nick_'+o.uid).html(o.username);
  var giftTarget = LIVE.getUser(HUI.$("#targetuid").val());
  if(giftTarget){
    HUI.$('#target_name').html(giftTarget.username);
  }
}


function showUpdateLink() {
  HUI.$('#flash_update_link').show();
}


/**
* 接受麦序列表
*/
function getMicList(json){
  HUI.printCallInfo();
  var o = HUI.parseJSON(json);

  LIVE._takelist = o.takelist;
  LIVE._waitlist = o.waitlist;
  for(var i=0,l=o.takelist.length; i<l; i++) {
    var user = o.takelist[i];
    LIVE.loadVideo(user.uid, user.vid, user.stream, user.forbid);
  }
  LIVE.refreshMicList();
}


/**
* 排麦
*/
function inLine(json){
  HUI.printCallInfo();
  var o = HUI.parseJSON(json);
  var user = o;
  LIVE.waitlistAdd(user);
  LIVE.refreshMicList();
}


/**
* 放麦
*/
function outLine(json){
  HUI.printCallInfo();
  var o = HUI.parseJSON(json);
  var uid = o.dstuid;
  LIVE.waitlistRemove(uid);
  LIVE.refreshMicList();

  if(uid === LIVE.user.uid){
    HUI.$('.lineup').removeClass('lineup-active');
  }
}


/**
* 上麦消息
*/
function inCam(json){
  HUI.printCallInfo();
  var o = HUI.parseJSON(json);
  var user = LIVE.getUser(o.dstuid);
  if(user){
    user.vid = o.vid;
    user.stream = o.stream;
    LIVE.takelistAdd(user);
    LIVE.refreshMicList();
    printSysMsg(['[', user.username, ']上麦'].join(''));
  }
}


/**
* 下麦消息
*/
function outCam(json){
  HUI.printCallInfo();
  var o = HUI.parseJSON(json);
  LIVE.takelistRemove(o.dstuid);
  LIVE.refreshMicList();
  var user = LIVE.getUser(o.dstuid);
  if(user){
    printSysMsg(['[', user.username, ']下麦'].join(''));
  }
}


/**
* 麦上列表发生改变
*/
function takelistChanged(json){
  HUI.printCallInfo();
  var o = HUI.parseJSON(json);
  var user1 = LIVE.takelistGet(o.src_uid);
  var user2 = LIVE.takelistGet(o.dst_uid);
  user1.vid = o.dst_vid;
  user2.vid = o.src_vid;
  LIVE.refreshMicList();
}


/**
* 等麦列表发生改变
*/
function lineSeqChanged(json){
  HUI.printCallInfo();
  var o = HUI.parseJSON(json);
  var user = LIVE.waitlistGet(o.uid);
  var index = parseInt(o.order)-1;
  if(user){
    LIVE.waitlistInsert(user, index);
    LIVE.refreshMicList();
  }
}


/**
* 排麦结果
*/
function lineUpResult(json){
  HUI.printCallInfo();
  var o = HUI.parseJSON(json);
  LIVE.alertBox(o.msg);
  if(o.result == 'succ'){
    HUI.$('.lineup').addClass('lineup-active');
  }
}


/**
* 打开礼物框
*/
function openGiftBox(uid){
  var user = LIVE.getUser(uid);
  if(user){
    HUI.$('#targetuid').val(user.uid);
    HUI.$('#target_name').html(user.username);
    HUI.$('#btn_giftbox').trigger('mousedown');
  }
}


/**
* 打开或关闭摄像头设置对话框
*/
function setLocalCamMode(mode) {
  var swf = HUI.el(LIVE._SWFID_MULTICTRL);
  swf.style.visibility = 'hidden';
  if(mode){
    swf.className = 'localcam-mode-'+mode;
  }else{
    swf.className = '';
  }
  swf.style.visibility = 'visible';

  swf.style.backgroundColor = 'white';
  swf.style.backgroundColor = '';
}


/**
* 摄像头准备就绪
*/
function localCamReady() {
  HUI.$('.cam-setting-button').addClass('cam-setting-button-active');
}


/**
* 清理
*/
function clear(){
  HUI.printCallInfo();
  setLocalCamMode(0);
  LIVE._userlist = {};
  LIVE._adminlist = {};
  LIVE._takelist = [];
  LIVE._waitlist = [];
  LIVE.refreshUserlist();
  LIVE.refreshAdminList();
  LIVE.refreshMicList();
  HUI.$('.lineup').removeClass('lineup-active');
}
