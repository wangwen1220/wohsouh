<?php /* Smarty version 2.6.26, created on 2012-04-18 11:42:42
         compiled from weibo/weibo_user_send_dynamic.html */ ?>
<div class="infohead">
  <div class="hometip"><span>来，说说你在做什么，想什么：</span></div>
  <form action="/huoshow/module/weibo/ajax/weibo_user_dynamic_ajax.php?tab=ajax_user_dynamic"
    method="POST" name="form" id="send_message_form">
    <textarea class="input_text headtextarea" name="content" id="weibo_content"></textarea>
    <div class="sendbox">
      <div class="fright">
        <span class="sendtip"><span class="tiptext">还可以输入</span><span class="nums">140</span>字</span>
        <input class="sendbutton" type="submit" value="发送广播">
      </div>
      <div class="uploadbox">
        <span class="emos"><a href="javascript:;" class="wb-facepicker">表情</a></span>
        <span class="image"><a href="javascript:;" class="wb-pic-picker">图片</a></span>
        <span class="video"><a href="javascript:;" class="wb-music-picker">音乐</a></span>
      </div>
    </div>
    <input type="hidden" name="music_url" id="music_url" value="" />
  </form>

  <div class="upload-boxes">
    <div class="upload-box insert-pic" id="pic_picker">
      <div class="tab">
        <a title="关闭" href="#" class="close">关闭</a>
        <ul>
          <li class="tab-selected"><span>插入图片</span></li>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="tab-body">
        <p>支持上传单张600K以下的gif、jpg、png文件<span>(最多三张)</span></p>
        <div class="upload-tool">
          <div class="upload-button">
            <span id="span_upload_button"></span>
            <span class="uploading-tip">上传中...<span class="upload-progress"></span></span>
          </div>
        </div>
        <div class="pic-preview"></div>
        <div class="clear"></div>
      </div>
    </div>

    <div class="upload-box insert-music" id="music_picker">
      <div class="tab">
        <a title="关闭" href="#" class="close">关闭</a>
        <ul>
          <li class="tab-selected"><span>插入音乐</span></li>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="tab-body">
        <p>请输入MP3格式歌曲链接地址</p>
        <div style="padding:15px;">
          <input type="text" class="music-input" />
          <input type="button" value="确定" class="music-input-ok" />
        </div>
      </div>
    </div>
  </div>

</div>