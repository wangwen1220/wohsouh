<?php $roomid=$_GET['roomid'];?>
<div class="blr" style="width:350px;">
  <h3 id="layer_reginfo_t" class="flb">
    <em id="returnmessage4">设置直播间公告</em>
    <span>
      <a href="javascript:;" class="flbc" onclick="hideWindow('register')" title="关闭">关闭</a></span>
  </h3>

  <div id="tangchuang2s">
    <div style="padding:10px;">
      直播间公告
      <textarea class="textarea" id="roomnotice" style="width:300px;margin-bottom:5px;color:#cccccc;" rows="3"  id="intro" name="intro" 
        onclick="inputText(this)" onblur="initText(this)" str="输入文字，不超过50个字">输入文字，不超过50个字</textarea>
      <input class="input" id="roomnotice_link" style="width:300px;height:20px;margin-bottom:5px;color:#cccccc;" 
      onclick="inputText(this)" onblur="initText(this)" str="公告的链接地址" 
      value="公告的链接地址"><br />
      请输入类似http://www.huoshow.com/链接地址
    </div>
    <div style="text-align:center;background:#eeeeee;padding-top:5px;height:31px;">
      <a href="javascript:;" onclick="saveNotice()"><img src="/static2/images/yingyong.png" width="86" height="24" /></a>&nbsp;&nbsp;&nbsp;&nbsp;	          
    </div>
  </div>
</div>
<script>
  (function($){
    window.inputText=function(e) {
      $(e).css("color","#000000");
      if($(e).val()=='' || $(e).val()=='私聊留言链接地址' || $(e).val()=='公告的链接地址' || $(e).val()=='输入文字，不超过50个字' ){
        $(e).val('');
      }
    };
        window.initText=function(e) {
      if($(e).val()=='' || $(e).val()=='私聊留言链接地址' || $(e).val()=='公告的链接地址' || $(e).val()=='输入文字，不超过50个字' ) {
        $(e).val($(e).attr("str"));
        $(e).css("color","#cccccc");
      }	
    };
   window.saveNotice=function() {
      var roomnotice        =  $("#roomnotice").val();
      var roomnotice_link   =  $("#roomnotice_link").val();
      var s_roomnotice      =  $("#s_roomnotice").val();
      var s_roomnotice_link =  $("#s_roomnotice_link").val();
     
      if(roomnotice=='输入文字，不超过50个字') {
        roomnotice='';
      }
      if(roomnotice_link=='公告的链接地址' ) {
        roomnotice_link='';
      }
      if(s_roomnotice=='输入文字，不超过50个字') {
        s_roomnotice='';
      }
      if(s_roomnotice_link =='私聊留言链接地址') {
        s_roomnotice_link ='';
      }
	  var url = "huoshow/module/show/ajax/show_setting_away_config.php?&tab=setNotice&roomid=<?php echo $roomid;?>&act=save&t=" + (new Date()).getTime();
      $.post(url, {
          roomnotice: roomnotice,
              roomnotice_link: roomnotice_link,
              s_roomnotice: s_roomnotice,
              s_roomnotice_link: s_roomnotice_link
      }, function(data){

        if(data.status==1) {				
          alert('设置成功！');

          if(s_roomnotice!="{$roominfo['s_roomnotice']}"){
            if(s_roomnotice_link==''){
              s_roomnotice_link='javascript:;';
              }else{
              s_roomnotice_link = s_roomnotice_link+"' target='_blank"
            }
            var ns_html="<a href='"+s_roomnotice_link+"'>"+s_roomnotice+" </a>";
          }
          var roomnotice_link2 = roomnotice_link;
          if(roomnotice_link==''){
            roomnotice_link='javascript:;';
            }else{
            roomnotice_link = roomnotice_link+'" target="_blank"'
          }		
          if(roomnotice!=''){
            var ns_html='<a href="'+roomnotice_link+'">'+roomnotice+' </a>';				
            $("#room_notice").html(ns_html);
          }		

          hideWindow('register');
        }
        if(data.status==0) {
          alert('设置失败！');
        }
        if(data.status=='-1') {
          alert('设置失败，公告或链接长度太长！');
        }
        if(data.status=='-2') {
          alert('设置失败，链接地址有误！');
        }
		  if(data.status=='-3') {
          alert('请填写公告内容！');
        }

      }, 'json');
     
    }    
})(jQuery);
</script>
