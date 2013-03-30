<?php /* Smarty version 2.6.26, created on 2012-04-12 14:51:43
         compiled from home/home_weibo_header.html */ ?>
<link href="/huoshow/css/weibo/style_weibo.css" rel="stylesheet" type="text/css" />
<link href="/huoshow/css/weibo/weibo_dynamic.css" rel="stylesheet" type="text/css" />

<?php echo '
<script id="_template_message" type="text/template">
  <div class="wb-item">
    <div>
      <div class="wb-user-pic">
        <a href="<%= url %>"><img src="<%= head_img_url %>" width="32" height="32"></a>
      </div>
      <div class="wb-msg-box">
        <div class="t_cont">
          <strong><a href="<%= url %>"><%= nicename %></a>:</strong>
          <span class="t_msg"><%= is_del==0? msg: \'对不起，此微博已被删除。\' %></span>
          <div class="clear"></div>
        </div>
        <% if (is_del == 0) { %>
          <% if (msg_type == 3) { %>
            <div class="stwi">
              <% if (route_msg.msginfo.length > 0) { %>
                <div class="twice_con">
                  <a class="suavt" href="<%= url_b + route_msg.msginfo[0].uid %>"><img width="32" height="32" src="<%= route_msg.msginfo[0].head_img_url %>"></a>
                  <a href="<%= url_b + route_msg.msginfo[0].uid %>"><%= route_msg.msginfo[0].nicename %></a>: <%= route_msg.msginfo[0].msg %>
                </div>

                <% if ( route_msg.msginfo[0].attachment_img_count>0 || route_msg.msginfo[0].attachment_music_count>0 || route_msg.msginfo[0].attachment_vedio_count>0) { %>
                  <div class="attachment">
                    <div class="attachment-preview">
                      <% for (var i in route_msg.attachment) { %>
                        <% if (route_msg.attachment[i].type == 1) { %>
                          <div class=\'img_wrapper\' media_url="<%= route_msg.attachment[i].url %>" media_type="<%= route_msg.attachment[i].type %>"><img src="<%= route_msg.attachment[i].small_url %>" media_url="<%= route_msg.attachment[i].url %>" media_type="<%= route_msg.attachment[i].type %>" /></div>
                          <% } else { %>
                          <div class=\'img_wrapper\' media_url="<%= route_msg.attachment[i].url %>" media_type="<%= route_msg.attachment[i].type %>"><img src="/huoshow/img/weibo/vol.jpg" media_url="<%= route_msg.attachment[i].url %>" media_type="<%= route_msg.attachment[i].type %>" /></div>
                          <% } %>
                        <% } %>
                    </div>
                    <div class="attachment-view">
                      <div class="attachment-view-tool">
                        <a href="#" class="attachment-view-close">收起</a>
                      </div>
                      <div class="attachment-view-body">
                      </div>
                    </div>
                  </div>
                  <% } %>

                <div>
                  <span class="stview"><%= route_msg.msginfo[0].append_time %></span>
                  <span>回复(<span><%= route_msg.msginfo[0].reply_count %></span>)</span>
                  <span>转发(<span><%= route_msg.msginfo[0].route_count %></span>)</span>
                </div>
                <% } else { %> 对不起，原文已经被作者删除。 <% } %>
            </div>
            <% } %>
          <% } %>
      </div>
      <div class="clear"></div>
    </div>

    <% if (is_del == 0) { %>
      <% if (attachment_img_count>0 || attachment_music_count>0 || attachment_vedio_count>0) { %>
        <div class="attachment">
          <div class="attachment-preview">
            <% for (var i in attachment) { %>
              <% if (attachment[i].type == 1) { %>
                <div class=\'img_wrapper\' media_url="<%= attachment[i].url %>" media_type="<%= attachment[i].type %>"><img src="<%= attachment[i].small_url %>" media_url="<%= attachment[i].url %>" media_type="<%= attachment[i].type %>" /></div>
                <% } else { %>
                <div class=\'img_wrapper\' media_url="<%= attachment[i].url %>" media_type="<%= attachment[i].type %>"><img src="/huoshow/img/weibo/vol.jpg" media_url="<%= attachment[i].url %>" media_type="<%= attachment[i].type %>" /></div>
                <% } %>
              <% } %>
          </div>
          <div class="attachment-view">
            <div class="attachment-view-tool">
              <a href="#" class="attachment-view-close">收起</a>
            </div>
            <div class="attachment-view-body">
            </div>
          </div>
        </div>
        <% } %>
      <% } %>

    <% if (is_del == 0) { %>
      <div class="wb-item-form">
        <span class="wbInfoDate font12">
          <strong class="fr">
            <% if (WEIBO.uid == uid) { %> <a class="jsadd destory" href="#delete">删除</a> <% } %>
            <a class="jsadd forward" href="#forward">转发(<span class="route-count"><%= route_count %></span>)</a>
            <a class="jsadd reply" href="#reply">评论(<span class="reply-count"><%= reply_count %></span>)</a>
          </strong> <%= append_time %>
        </span>
      </div>
      <% } %>
    <div class="clear"></div>
  </div>
</script>
'; ?>


<script>
  <?php echo '
  var WB_CONFIG = {};
  '; ?>

  <?php if ($this->_tpl_vars['lists'] == '1'): ?>
  WB_CONFIG.channel = 'all';
  <?php elseif ($this->_tpl_vars['lists'] == '4'): ?>
  WB_CONFIG.channel = 'sys';
  <?php else: ?>
  WB_CONFIG.channel = 'user';
  <?php endif; ?>
  WB_CONFIG.roomid = '<?php echo $this->_tpl_vars['r_user_uid']; ?>
';
</script>

<script src="/huoshow/js/jquery/jquery-ui.min.js"></script>
<script src="/huoshow/js/hui.js"></script>
<script src="/huoshow/js/json2.js"></script>
<script src="/huoshow/js/underscore.js"></script>
<script src="/huoshow/js/backbone.js"></script>
<script src="/huoshow/js/swfupload/swfupload.js"></script>
<script src="/huoshow/js/weibo.js"></script>