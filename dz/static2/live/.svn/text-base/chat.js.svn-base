hs.debug = true;

function callSwf(objectID, funName) {
  var swf = document.getElementById(objectID);
  var args = Array.prototype.slice.call(arguments, 2);
  if(window.console){
    console.info('[', objectID, '].', funName, '(', args.join(','), ')');
  }
  return swf[funName].apply(swf, args);
}


var _mo = {
  _objectId: 'chat_client',

  socketStart: function (host, port, roomId, userId) {
    callSwf(this._objectId, 'socketStart', host, port, roomId,
    chat.user.type, userId, chat.user.name);
  },

  socketStop: function () {
    callSwf(this._objectId, 'socketStop');
  },

  sendMessage: function () {
    var priv = "0";
    if (_$("#isPrivate").attr('checked') == true) priv = "1";
    if (priv == "1" && chat.dest.uid == 'allusers') {
      chat.info("请选择私聊对象");
      _$("#users").focus();
      return false;
    }
    //检查内容
    var msg = _$("#inputMessage").val();
    if (_$.trim(msg) == "") {
      chat.info("请填写聊天内容再点发送！");
      _$("#inputMessage").focus();
      return false;
    }
    if (msg.length > 200) {
      chat.info("聊天内容不能大于200个字符!");
      _$("#inputMessage").focus();
      return false;
    }
    callSwf(this._objectId, 'sendMessage', chat.dest.uid, 0, priv, hs.htmlEscape(msg));
    _$("#inputMessage").val("").focus();
  },

  clap: function () {
    var _this = this;
    if(!this.clapList) {
      _$.ajax({
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
      callSwf(this._objectId, 'sendMessage', 'allusers', 0, 0, hs.htmlEscape(msg));
    }
  },

  cantSpeak: function (uid) {
    callSwf(this._objectId, 'adminAction', 1, uid, 300);
  },

  canSpeak: function (uid) {
    callSwf(this._objectId, 'adminAction', 1, uid, 0);
  },

  kick: function (uid) {
    callSwf(this._objectId, 'adminAction', 2, uid, 300);
  },

  addToAdminGroup: function (uid) {
    if(_$('#onlineUsers .u-room-admin').length<10){
      callSwf(this._objectId, 'adminAction', 3, uid, 1);
    }else{
      popinfo('最多只能设置10个管理员');
    }
  },

  delFromAdminGroup: function (uid) {
    callSwf(this._objectId, 'adminAction', 3, uid, 0);
  },

  sendStar: function () {
    callSwf(this._objectId, 'sendGift', 1, chat.owner.uid, '', '');
  },

  sendGift: function (dstId, giftId, count) {
    callSwf(this._objectId, 'sendGift', 2, dstId, giftId, count);
  },

  catchChest: function (key) {
    callSwf(this._objectId, 'catchChest', 1, key);
  },

  setMatchStatus: function (value) {
    callSwf(this._objectId, 'setMatchStatus', value);
  }
};


var chat = {
  user: { uid: ENV.userId, type: ENV.userType, name: ENV.userName },
  dest: { uid: "allusers", name: "所有人" },
  room: { id: ENV.roomId, type: ENV.roomType },
  owner: { uid: ENV.ownerId, type: ENV.ownerType },

  huocoin: 0,

  /*滚屏*/
  _isAutoScroll: true,

  setAutoScroll: function (o) {
    if(this._isAutoScroll) {
      o.innerHTML = "自动滚屏";
    }else{
      o.innerHTML = "停止滚屏";
    }
    this._isAutoScroll = !this._isAutoScroll;
    return false;
  },

  scrollLog: function () {
    if (chat._isAutoScroll) {
      var chatLogBox1 = hs.$("chat_log1_w");
      var chatLogBox2 = hs.$("chat_log2_w");
      chatLogBox1.scrollTop = chatLogBox1.scrollHeight;
      chatLogBox2.scrollTop = chatLogBox2.scrollHeight;
    }
  },

  /*清屏*/
  clearLog: function () {
    hs.$("message_list").innerHTML = "";
    hs.$("my_message_list").innerHTML = "";
  },

  /*添加聊天记录*/
  log: function (m, t) {
    var msgbox = t? hs.$("my_message_list"): hs.$("message_list");
    if(msgbox.children.length >32) {
      hs.rmNode(msgbox.firstChild);
    }
    var elem = document.createElement('div');
    msgbox.appendChild(elem);
    elem.className = "message";
    elem.innerHTML = chat.replaceFaces(m);
    setTimeout(chat.scrollLog);
  },

  info: function (s) {
    popinfo(s);
  },

  /*选择表情*/
  selectFace: function (id) {
    var o = hs.$('inputMessage');
    o.value += ['{', id, '}'].join('');
    o.focus();
    _$.pop_close();
  },

  makeFaceHTML: function (faceId) {
    return ['<img src="\/static2\/images\/face\/face', faceId, '.gif" \/>'].join('');
  },

  /*替换表情*/
  replaceFaces: function (msg) {
    return msg.replace(/\{(\d+)\}/g, chat.makeFaceHTML('$1'));
  },

  send: function () {
    _mo.sendMessage();
  },

  onlineListShowHide: function () {
    var o = _$("#chat");
    if(o.hasClass("hide-online-list"))
      o.removeClass("hide-online-list");
    else
      o.addClass("hide-online-list");
  },

  clap: function () {
    _mo.clap();
  },

  /*用户类型*/
  userTypes: {
    1: {className: 'u-web-admin'}, //超管
    2: {className: 'u-room-owner'}, //主播
    3: {className: 'u-room-admin'}, //管理员
    4: {className: 'u-room-user'}, //注册用户
    5: {className: 'u-room-guest'}  //游客
  },

  /*观众列表*/
  _userlist: {},
  makeUserMenu: function (u) {
    var ul = ['<div class="u-menu">'];
    ul.push(['<a href="javascript:;" onclick="_mo.kick(\'', u.uid,
      '\');chat.closeUserMenu();return false;">请出</a>'].join(''));
      if(u.usertype<'5') {
        if(u.cansay == "1") {
          ul.push('<a href="javascript:;" onclick="_mo.cantSpeak(\'');
          ul.push(u.uid);
          ul.push('\');chat.closeUserMenu();return false;">禁止发言</a>');
        }else{
          ul.push('<a href="javascript:;" onclick="_mo.canSpeak(\'');
          ul.push(u.uid);
          ul.push('\');chat.closeUserMenu();return false;">恢复发言</a>');
        }
        if(ENV.roomType=='0') {
          if(u.usertype>'3') {
            ul.push('<a href="javascript:;" onclick="_mo.addToAdminGroup(\'');
            ul.push(u.uid);
            ul.push('\');chat.closeUserMenu();return false;">设为管理</a>');
          }else{
            ul.push('<a href="javascript:;" onclick="_mo.delFromAdminGroup(\'');
            ul.push(u.uid);
            ul.push('\');chat.closeUserMenu();return false;">取消管理</a>');
          }
        }
      }
      ul.push('</div>');
      return ul.join('');
  },

  _showUserMenu: function (o) {
    hs.addClassName(o, 'user-menu-open');
    _$('.u-menu', o).css('top', o.getBoundingClientRect().top+_$(document).scrollTop()+'px');
  },

  _hideUserMenu: function (o) {
    hs.removeClassName(o, 'user-menu-open');
  },

  closeUserMenu: function () {
    _$('.u-menu').parent().removeClass('user-menu-open');
  },

  createUserList: function (userlist) {
    var _ul = ['<table style="width:100%">'];
    for(var i=0, l=userlist.length; i<l; i++) {
      var u = userlist[i];
      var _li = [];
      _li.push('<tr><td class="');
      if(i%2 == 0){
        _li.push('odd');
      }
      _li.push('"><div class="');
      if(chat.user.uid == u.uid && chat.user.type == 5){
        _li.push('current-user');
      }
      _li.push('" ');
      _li.push('onmouseover="chat._showUserMenu(this);" ');
      _li.push('onmouseout="chat._hideUserMenu(this);" ');
      _li.push('>');

      /*创建用户菜单*/
      if(parseInt(u.usertype)>parseInt(chat.user.type) &&
      parseInt(chat.user.type)<=3 && chat.user.uid !=u.uid) {
        _li.push(chat.makeUserMenu(u));
      }

      _li.push('<a href="javascript:;" class="');
      _li.push(this.userTypes[u.usertype].className);
      _li.push('" uid="');
      _li.push(u.uid);
      _li.push('" ');
      _li.push('onclick="chat.seluser(this.getAttribute(\'uid\'));return false;" >');
      _li.push('<span>');
      _li.push(u.username);
      _li.push('<br/>(');
      _li.push(u.uid);
      _li.push(')');
      _li.push('</span></a>');
      _li.push('</div></td></tr>');

      _ul.push(_li.join(''));
    }
    _ul.push('</table>');

    return _ul.join('');
  },

  refreshUserlist: function () {
    var userlist = [];
    for(var i in this._userlist) {
      userlist.push(this._userlist[i]);
    }
    userlist.sort(function (a, b) {
      if(a.usertype > b.usertype) return 1;
      if(a.usertype == b.usertype) return 0;
      if(a.usertype < b.usertype) return -1;
    });
    hs.$("onlineNum").innerHTML = userlist.length;
    var ol = hs.$("onlineUsers");
    ol.innerHTML = this.createUserList(userlist);
  },

  getUser: function (uid) {
    return this._userlist[uid];
  },

  getUserNameByUid: function (uid) {
    var u = this.getUser(uid);
    if(u) return u.username;
  },

  addUser: function (user) {
    this._userlist[user.uid] = user;
  },

  removeUser: function (uid) {
    delete this._userlist[uid];
  },


  seluser: function (uid) {
    //选中对象不能是自己
    if(uid == this.user.uid){
      return false;
    }

    var u = this.getUser(uid);

    if(u){
      this.dest.uid = u.uid;
      this.dest.name = u.username;
      _$("#users_label").html(this.dest.name);
      this.recentlistAdd(u);
    }
  },

  _recentlist: {},

  selRecentUser: function (o) {
    _$.pop_close();
    this.dest.uid = o.getAttribute('uid');
    this.dest.name = o.getAttribute('username');
    _$("#users_label").html(this.dest.name);
  },

  _recentlistCount: 0,

  recentlistAdd: function (user) {
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
    this.refreshRecenlist();
  },

  refreshRecenlist: function () {
    var tmp = ['<table><tr><td><a href="javascript:;" uid="allusers" username="所有人" onclick="chat.selRecentUser(this);return false;">'];
    tmp.push('<span>所有人</span></a></td></tr>');

    for(var i in this._recentlist){
      var user = this._recentlist[i];
      tmp.push(['<tr><td><a href="javascript:;" uid="', user.uid,
        '" username="', user.username,
        '" onclick="chat.selRecentUser(this);return false;"><span>',
        user.username, '</span></a></td></tr>'].join(''));
    }
    tmp.push('</table>');
    hs.$("audience-list").innerHTML = tmp.join('');
    console.info(this._recentlistCount);
  },

  msgInputBoxKeypress: function (e) {
    e = e || event;
    key = e.which || e.keyCode;
    if(key == 13) {
      chat.send();
      return false;
    }
  },

  /*初始化消息客户端*/
  init: function () {
    var t = 0;
    if(navigator.userAgent.toLowerCase().indexOf('webkit')){
      t = 1000;
    }
    setTimeout(function(){
      _mo.socketStart(ENV.chatServerHost, ENV.chatServerPort, ENV.roomId, ENV.userId);
    }, t);
  }

};


/*chat.swf callback*/
/*聊天消息*/
function receiveMessage(o) {
  o = unescape(o);
  hs.log('receiveMessage<<<'+o);
  o = hs.parseJSON(o);
  if(o.type == "1") {
    var m = ['<div class="mt-sys">'];
    if(o.time){
      m.push('<span class="m-time">');
      m.push(o.time);
      m.push('</span>');
    }
    m.push('<span class="m-msg">');
    m.push(o.msg);
    m.push('</span>');
    m.push('</div>');
    chat.log(m.join(''));
  }else{
    var srcUser = chat.getUser(o.srcuid);
    var dstUser = chat.getUser(o.dstuid);
    var m = ['<div><span class="m-time">', o.time, '</span>'];
    m.push(['<span><a class="', chat.userTypes[srcUser.usertype].className,
      '" href="javascript:;" onclick="chat.seluser(\'', o.srcuid, '\');">',
      srcUser.username, '</a></span>'].join(''));
      if(o.dstuid != 'allusers') {
        m.push(['对<span><a class="', chat.userTypes[dstUser.usertype].className,
          '"href="javascript:;" onclick="chat.seluser(\'', o.dstuid, '\');">',
          dstUser.username, "</a></span>："].join(''));
      }else{
        m.push('：');
      }
      m.push(o.msg);
      m.push('</div>');
      m = m.join('');
      if(o.priv == '1') {
        chat.log(m, true);
      }else{
        chat.log(m);
        if(o.srcuid == chat.user.uid || o.dstuid == chat.user.uid){
          chat.log(m, true);
        }
      }
  }
}

/*更新当前用户资料*/
function updateUserInfo(o) {
  hs.log('updateUserInfo<<<'+o);
  o = hs.parseJSON(o);
  chat.user.uid = o.uid;
  chat.user.name = o.username;
  chat.user.type = o.usertype;
  chat.user.cansay = o.cansay;
}

/*更新观众列表*/
function updateUserList(o) {
  hs.log('updateUserList<<<'+o);
  o = hs.parseJSON(o);
  var users = {};
  for(var i=0,l=o.userlist.length; i<l; i++) {
    var user = o.userlist[i];
    users[user.uid] = user;
  }
  chat._userlist = users;
  chat.refreshUserlist();

  //连接完成
  onConnected();
}

/*连接成功*/
function onConnected() {
  if(ENV.roomType == '1' && chat.user.type != '1'){
    initVote();
  }
}

/*生成宝箱*/
function buildChest(o) {
  hs.log('buildChest<<<'+o);
  o = hs.parseJSON(o);
  var m = ['<div class="mt-sys">您在聊天室里聊得正开心，突然天上掉下来一个宝箱',
    '<a href="javascript:_mo.catchChest(\'', o.value, '\');"><img src="/static/image/randbox/box1.gif" /></a>',
    '，快去抢啊！</div>'].join('');
    chat.log(m);
}

/*获得奖励*/
function prizeSuccess(o) {
  hs.log('prizeSuccess<<<'+o);
  o = hs.parseJSON(o);
  if(o.act == '1') {
    chat.info('系统赠送魅力之星：'+o.value);
  }else{
    chat.info('抢到宝箱，得火币：'+o.value);
  }
}

/*用户进出*/
function userInOrOut(o) {
  hs.log('userInOrOut<<<'+o);
  o = hs.parseJSON(o);
  for(var i=0, l=o.userlist.length; i<l; i++) {
    var user = o.userlist[i];
    if(o.act == "enter") {
      chat.addUser(user);
      printSysMsg(['欢迎[', user.username, ']进入'].join(''));
    }else if(o.act == "leave") {
      if(user.mode == '0') {
        //离开
      }else if(user.mode == '1') {
        //掉线
      }else if(user.mode == '2') {
        if(user.uid == chat.user.uid) {
          setCookie("kicked", chat.room.id, 5*60);
          location.reload();
        } else {
          printSysMsg(['[', chat.getUserNameByUid(user.uid), ']被[', user.name, ']一脚踢出'].join(''));
        }
      }
      chat.removeUser(user.uid);
    }
  }
  chat.refreshUserlist();

  if(chat.user.uid != chat.owner.uid){
    if(o.room_stat == '0'){
      ownerInOrOut(false);
    }else{
      ownerInOrOut(true);
    }
  }
}

chat._t_fetchRoomList = null;

chat.fetchRoomList = function (){
  _$.ajax({
    cache: false,
    dataType: 'json',
    url: '/api/other_apply.php?act=live_hot_list',
    success:function(data){
      var html = [];
      for(var i=0,l=data.length; i<l; i++){
        var user = data[i];
        html.push('<ul class="item">',
          '<li class="rl-thumb"><a href="/', user.uid, '" style="background-image:url(',
        user.avatar, ');">&nbsp;</a></li>',
        '<li class="rl-link"><a href="/', user.uid, '">', user.nicename, '</a></li>',
        '<li class="rl-uid">(', user.uid, ')</li>',
        '</ul>');
      }
      _$('#room_list').html(html.join(''));
      chat._t_fetchRoomList = setTimeout(chat.fetchRoomList, 60000);
    }
  });
};

function ownerInOrOut(value){
  clearTimeout(chat._t_fetchRoomList);
  if(value){
    _$('#video_area').removeClass('owner-out');
  }else{
    _$('#video_area').addClass('owner-out');
    chat.fetchRoomList();
  }
}

/*系统消息*/
function printSysMsg(str) {
  var m = ['<div class="mt-sys">', str, '</div>'].join('');
  chat.log(m);
}

/*权限更新*/
function getAdminAction(o) {
  hs.log('getAdminAction<<<'+o);
  o = hs.parseJSON(o);
  var user = chat.getUser(o.dstuid);
  if(!user) return;

  var m = '';
  var priv = false;
  if(o.act == '1') {
    if(parseInt(o.value) > 0) {
      user.cansay = 0;
      m = ['[', user.username, ']被[', chat.getUserNameByUid(o.srcuid), ']禁言'].join('');
    }else{
      user.cansay = 1;
      m = ['[', user.username, ']恢复发言'].join('');
    }
    if(o.dstuid == chat.user.uid) {
      priv = true;
    }
  }else if(o.act == '3') {
    if(o.value == '1') {
      user.usertype = 3;
      m = ['[', user.username, ']被[', chat.getUserNameByUid(o.srcuid), ']设为管理员'].join('');
    }else{
      user.usertype = 4;
      m = ['[', user.username, ']被取消管理员身份'].join('');
    };
    if(o.dstuid == chat.user.uid)
      chat.user.type = user.usertype;
  }
  m = ['<div class="mt-sys">', m, '</div>'].join('');
  chat.log(m, priv);
  chat.refreshUserlist();
}


/*更新比赛状态*/
function updateMatchStatus(status) {
  hs.log('updateMatchStatus<<<'+status);
  if(ENV.roomType == '0'){
    if(status == '0') {
      hs.$("canVoteStatus").innerHTML = '<img src="/static2/images/vote_start.gif" onclick="startVote();" />';
    }else{
      hs.$("canVoteStatus").innerHTML = '<img src="/static2/images/vote_stop.gif" onclick="stopVote();" />';
    }
  }
}


/*接收到礼物/魅力之星*/
function acceptGift(o) {
  hs.log('acceptGift<<<'+o);
  o = hs.parseJSON(o);
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
      chat.log(m);
  }
}

/*送星、送礼*/
function sendGiftResult(o) {
  o = unescape(o);
  hs.log('sendGiftResult<<<'+o);
  o = hs.parseJSON(o);
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

/*更新房间魅力值，魅力之星，魅力指数，当前排名*/
function updatePopular(o) {
  hs.log('updatePopular<<<'+o);
  if(o.indexOf('votes')>-1){
    return;
  }
  o = hs.parseJSON(o);
  if(o) {
    _$('#charm_value').html(o.charm);
    _$('#vote_value').html(o.vote);
    _$('#score_value').html(o.exponent);
    _$('#paiming_value').html(o.rank);
  }
}


function showNotice(o) {
  hs.log('showNotice<<<'+o);
  o = hs.parseJSON(o);
  if(o) {
    var notices = hs.$('notices');
    if(notices.children.length>4){
      notices.removeChild(notices.firstChild);
    }
    var li = document.createElement('li');
    notices.appendChild(li);
    var msg = ['<span class="notice-time">', o.time, '</span>', o.msg].join('');
    li.innerHTML = msg;
    hs.$('notice_first').innerHTML = msg;
  }
}


function callServer(o) {
  hs.log('callServer<<<'+o);
  if(o == 1){
    if(typeof chat.currFansRank === 'function'){
      chat.currFansRank();
    }
  } else if(o == '2'){
    _$.get('/api/zhibo.php?act=getUserinfo&uid='+chat.room.id, function(data){
      _$('#owner_info').html(data);
    });
  } else if(o == '3'){
    _$.get('/api/zhibo.php?act=getNotice&uid='+chat.room.id, function(data){
      _$('#room_notice').html(data);
    });
  }
}


function nameChanged(o) {
  hs.log('nameChanged<<<'+o);
  o = hs.parseJSON(o);
  var tmp = chat._userlist[o.uid].username;
  //printSysMsg(['用户(', o.uid, ')换名啦，由[', tmp, ']改为[', o.username, ']'].join(''));
  chat._userlist[o.uid].username = o.username;
  chat.refreshUserlist();
  try{
    chat._recentlist[o.uid].username = o.username;
    chat.refreshRecenlist();
  }catch(e){}
  if(hs.$('users_label').innerHTML == tmp){
    hs.$('users_label').innerHTML = o.username;
  }
  if(o.uid == chat.user.uid){
    _$('.user-bar-nick').html(o.username);
  }
  if(o.uid == chat.owner.uid){
    _$('.owner-nick').html(o.username);
    _$('#target_name').val(o.username);
  }
}
/*swf callbacks end*/


/*获得房间状态*/
function getRoomStatus() {
  var r = 0;
  hs.ajax({
    url: ['/show.php?operation=ajax&tab=getRoomstatus&spaceuid=', ENV.roomId,
      '&', 'ttiimmee=', (new Date()).getTime()].join(''),
      async: false,
      onsuccess: function (d) {
        d = hs.parseJSON(d);
        r = d.status;
      }
  });
  return r;
}


/*创建粉丝排行榜*/
function createFansList(data) {
  var rows = [];
  for(var i=0, l=data.length; i<l; i++) {
    var item = data[i];
    rows.push(['<table class="fans-rank-item"><tr>',
      '<td class="col1" style="background:url(\/static2\/images\/xuhao',
    i+1, '.jpg) center center no-repeat;">&nbsp;</td>',
    '<td class="col2 avatar"><img src="', item.avatar, '" /><\/td>',
    '<td class="col3">', item.username, '<br \/>',
    '<img src="\/static2\/images\/charmlevel\/', item.level1 ,'.png" />&nbsp;',
    '<img src="\/static2\/images\/huoshowlevel\/', item.level2 ,'.png" />',
    '<\/td>',
    '<td class="col4"><span class="con">', item.contribution, '</span><\/td>',
    '</tr></table>'].join(''));
  }
  return rows.join('');
}


/*粉丝排行榜---日*/
function getFansRankDaySuccess(data) {
  var box = hs.$("fans_list_day");
  box.innerHTML = createFansList(data);
}
function getFansRankDay () {
  chat.currFansRank = arguments.callee;
  hs.getJSON(['\/show.php?mod=fans&uid=', ENV.ownerId,
    '&type=day', '&t=', (new Date()).getTime()].join(''), getFansRankDaySuccess);
}


/*粉丝排行榜---月*/
function getFansRankMonthSuccess(data) {
  var box = hs.$("fans_list_month");
  box.innerHTML = createFansList(data);
  box.loaded = true;
}
function getFansRankMonth () {
  chat.currFansRank = arguments.callee;
  hs.getJSON(['\/show.php?mod=fans&uid=', ENV.ownerId,
    '&type=month', '&t=', (new Date()).getTime()].join(''), getFansRankMonthSuccess);
}


/*粉丝排行榜---总*/
function getFansRankAllSuccess(data) {
  var box = hs.$("fans_list_total");
  box.innerHTML = createFansList(data);
  box.loaded = true;
}
function getFansRankAll () {
  chat.currFansRank = arguments.callee;
  hs.getJSON(['\/show.php?mod=fans&uid=', ENV.ownerId,
    '&type=total', '&t=', (new Date()).getTime()].join(''), getFansRankAllSuccess);
}


/*停止比赛*/
function stopVote () {
  _mo.setMatchStatus(0);
}


/*开始比赛*/
function startVote () {
  _mo.setMatchStatus(1);
}


/*收到魅力之星*/
function receiveVote(n) {
  popinfo(['<span style="position:absolute; padding:55px 0 0 245px; font-size:24px; color:#c40000;">', n,
    '</span><img onload="hs.$(\'popup_popinfo\').repos();" src="/static2/images/200star.png"/>'].join(''), 5);
}

var VOTE_WAIT = 60;
var VOTE_ENABLED = false;
var TIMER_VOTE_SUCCESS = null;

function voteSuccess() {
  hs.$("vote_button_box").className = "vote-status-success";
  removeTimer(TIMER_VOTE_SUCCESS);
  TIMER_VOTE_SUCCESS = setTimer(function (s) {
    hs.$("vote_timer_success").innerHTML = s;
  }, function () {
    VOTE_ENABLED = true;
    hs.$("vote_timer_success").innerHTML = VOTE_WAIT;
    hs.$("vote_button_box").className = "vote-status-vote";
  }, VOTE_WAIT);
}


//预热...
function initVote() {
  hs.$("vote_button_box").className = "vote-status-wait";
  removeTimer(chat.TIMER_VOTE);
  chat.TIMER_VOTE = setTimer(function (s) {
    hs.$("vote_timer_wait").innerHTML = s;
  }, function () {
    VOTE_ENABLED = true;
    hs.$("vote_timer_wait").innerHTML = VOTE_WAIT;
    hs.$("vote_button_box").className = "vote-status-vote";
  }, VOTE_WAIT);
}


function vote() {
  if(VOTE_ENABLED) {
    VOTE_ENABLED = false;
    _mo.sendStar();
  }
}


function noticesBoxFixIE6() {
  setTimeout(function () {
    hs.$("notice_box").style.visibility = 'hidden';
    hs.$("notice_box").style.visibility = 'visible';
  }, 15);
};


/*礼物*/
function givegift () {
  var giftid = hs.$("giftid").value;
  var giftnum =parseInt(hs.$("giftnum").value);
  var dstuid = hs.$("targetuid").value;
  if(giftid.length<1) {
    chat.info('请选择要赠送的礼物');
    return;
  }
  if(giftnum && giftnum>0 && giftnum<100) {
    _mo.sendGift(dstuid, giftid, giftnum);
  }else{
    chat.info('请填写正确的礼物数量');
  }
  hs.$('giftid').value = '';
  hs.$('giftnum').value = 1;
  hs.$('imageField2').value = '礼物盒子';
}

function showGiftBox(uid) {
  if(!_$("#gift_box").attr('isLoaded')){
    _$.get('/show.php?operation=ajax&tab=get_all_gift_list', function(data){
      _$('#gift_box_body').html(data);
      make_pagebox("gift_box", {
        links_selector: ".lipin-tabs a",
        pages_selector: ".lipin-b",
        current_class: "on",
        effect:1
      });

      _$(".lipin-b a").click(function (e) {
        e.preventDefault();
        var giftId = this.getAttribute('giftId');
        var giftType = this.getAttribute('gifttypeid');
        var giftName = this.getAttribute('giftName');
        var g = hs.$('giftid');
        g.value = giftId;
        g.setAttribute('gifttypeid', giftType);
        hs.$('imageField2').value = giftName;
        hideGiftBox();
      }).bind('mouseover', function (e) {
        e.stopPropagation();
        var _this = this;
        setTimeout(function () {
          var x = _this.getBoundingClientRect().left+_$(window).scrollLeft()+25+'px';
          var y = _this.getBoundingClientRect().top+_$(window).scrollTop()+_this.offsetHeight-5+'px';
          var price = _this.getAttribute('giftPrice');
          var html = ['<span>&nbsp;</span>价格：<strong>', price, '</strong>火币/个<br />您还可以购买：<strong>',
            Math.floor(chat.huocoin/price) + '</strong>个'].join('');
            showGiftTip(x, y, html);
        });
      });
    });
    _$("#gift_box").attr('isLoaded', true);
  }

  hs.$("gift_box").style.display = 'block';
  var uname = chat.getUserNameByUid(uid);
  if(!uname) {
    uid = ENV.ownerId;
    uname = ENV.ownerName;
  }
  hs.$("targetuid").value = uid;
  hs.$("target_name").value = uname;

  _$.ajax({
    async: false,
    cache: false,
    url: '/huoshow/module/commom/live_index_list.php?act=user_huocoin',
    success: function(data){
      chat.huocoin = parseInt(data);
      _$('#hcoin').html(chat.huocoin);
    }
  });
}

function hideGiftBox() {
  hs.$("gift_box").style.display = 'none';
}


function setRoomBg () {
  showWindow('register', '/show.php?operation=ajax&tab=setRoomBg&t='+(new Date()).getTime());
}


function setNotice() {
  showWindow('register', '/show.php?operation=ajax&tab=setNotice&t='+(new Date()).getTime());
}


function showUpdateLink() {
  _$('#flash_update_link').show();
}

function showGiftTip(x, y, html) {
  _$('#gift_price_box').html(html).css({ left: x, top: y}).show().mouseover(function (e) {
    e.stopPropagation();
  });
  _$(document).bind('mouseover', hideGiftTip);
}

function hideGiftTip() {
  _$('#gift_price_box').hide();
  _$(document).unbind('mouseover', hideGiftTip);
}

function locationToCheck() {
  popinfo("检测到您禁用了本地存储，无法正常访问直播间，请在跳转后设置");
  setTimeout("window.location.href='http://live.huoshow.com/static2/live/checkCam.htm'", 5000);
}

function initPage() {
  if(ENV.roomType == '0' && checkFlashVersion(10, 2)<1) {
    alert('要正常使用直播功能，请升级您的Flash插件到最近版本！');
    return;
  }

  make_pagebox("fans_rank", {
    links_selector: ".fans-rank-tabs li",
    pages_selector: ".fans-rank-list",
    current_class: "curr",
    current: 1
  });
  getFansRankMonth();

  make_hoverbox("notices_t", function () {
    var h = _$('#notices_ex').height();
    _$("#notices_ex_if").css("height", h+"px");
  }, function () {
    _$("#notices_ex_if").css("height", "0");
  });
  if(ie6) { window.onscroll = noticesBoxFixIE6; }

  _$("#btn_audience-list").pop("n", function () {
    var l = _$("#audience-list").position().left;
    var t = _$("#audience-list").position().top + 26;
    _$("#audience-list").css({ left: l + "px", top: t + "px" });
    _$(".pop-iframe").css({ left: l + "px", top: t + "px" });
  });

  _$("#btn_face").pop("n", function () {
    if(!_$("#face_box").attr('isLoaded')){
      var facesHTML = [];
      for(var i=1; i<49; i++){
        facesHTML.push(['<a href="javascript:;" onclick="chat.selectFace(\'', i, '\');return false;">',
          '<img src="\/static2\/images\/face\/face', i, '.gif" width="24" height="24" \/>',
          '<\/a>'].join(''));
      }
      _$("#face_box").html(facesHTML.join('')).attr('isLoaded', true);
    }
    var l = _$("#face_box").position().left - 100;
    var t = _$("#face_box").position().top + 10;
    _$("#face_box").css({ left: l + "px", top: t + "px" });
    _$(".pop-iframe").css({ left: l + "px", top: t + "px" });
  });

  _$("#chat_log_box").layout({
    a: "#chat_log1_w",
    b: "#chat_log2_w"
  });

  /*Enter发送消息*/
  hs.addListener(hs.$("inputMessage"), 'keypress', chat.msgInputBoxKeypress);

  _$.get('/show.php?operation=ajax&tab=get_uid_gift_order_list&uid='+ENV.roomId, function(data){
    _$('#mod_gift_body').html(data);
  });

  var getCharm = function(data){
    _$.get(['/huoshow/module/commom/live_index_list.php?act=user_charm_rank&roomid=',
      ENV.roomId, '&t=', (new Date()).getTime()].join(''), updatePopular);
  };
  getCharm();
  setInterval(getCharm, 1800000);
}

_$(function(){
  initPage();
});

window.onload = function(){
  chat.init();
};

window.onunload = function () {
  try{
    _mo.socketStop();
  }catch(e) {}
};