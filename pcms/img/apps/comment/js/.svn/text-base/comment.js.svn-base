(function($){
    window.init_row_event = function (b,c){c.unbind("click")};


    window.json_loaded = function (b){var c=$("#pagination span.current:not(.prev,.next)").html();parseInt(c)>1?$("#hotcomment").hide():buildHot(b.hotdata);c=$("#pagination").clone(true);$("#paginationTop").replaceWith(c.attr("id","paginationTop"));total=b.total;$(".commentTotal").html(total)};


    window.buildHot = function (b){$("#hotcomment").empty();for(var c=0,a;a=b[c++];){var d=row_template.replace(RegExp("commentbox_","gm"),"hotcommentbox_");for(var e in a)d=d.replace(RegExp("{"+e+"}","gm"),a[e]);$("#hotcomment").append(d)}};


    window.support = function (b,c){$.getJSON("?app=comment&controller=comment&action=support&commentid="+b,"",function(a){if(a.state){a=parseInt($("#supportNum_"+b).html())+1;$(c).before('<span class="f-l">\u5df2\u652f\u6301<em>[<b id="supportNum_11">'+a+"</b>]</em></span>").remove()}else alert(a.error)})};


    window.report = function (b,c){$.getJSON("?app=comment&controller=comment&action=report",{commentid:b},function(a){if(a.state){$(c).before("<a>\u5df2\u4e3e\u62a5</a>").remove();alert("\u4e3e\u62a5\u6210\u529f")}else alert(a.error)})};


    window.commentSubmit = function (b){b=$(b);var c=b.find("textarea");if(islogin==1&&userid<1)alert("\u8bf7\u767b\u5f55\u540e\u518d\u53d1\u8868\u8bc4\u8bba\uff01");else if(c.val()=="")alert("\u8bc4\u8bba\u5185\u5bb9\u4e0d\u80fd\u4e3a\u7a7a");else c.val().length>wordage?alert("\u8bc4\u8bba\u5185\u5bb9\u4e0d\u80fd\u8d85\u8fc7"+wordage+"\u5b57"):$.ajax({type:"POST",data:b.serialize(),url:"?app=comment&controller=comment&action=comment",dataType:"json",success:function(a){if(a.state){if(parseInt(a.data.commentid)!=
            0){tableApp.addRow(a.data,true);ischeck!=0&&$("#commentbox_"+a.data.commentid+"> .user-info").prepend("<span>\u8bc4\u8bba\u63d0\u4ea4\u6210\u529f\uff0c\u5c06\u5728\u5ba1\u6838\u540e\u5176\u4ed6\u7528\u6237\u624d\u80fd\u770b\u5230...</span>");$(".commentTotal").html(++total);window.location.hash="commentbox_"+a.data.commentid}c.val("")}else alert(a.error)}});return false};


    window.reply = function (b,c){if(islogin==1&&userid<1){alert("\u8bf7\u767b\u5f55\u540e\u518d\u56de\u590d\uff01");$("#quickLogin").click();return false}var a=$(c),d=$("#replyBox_"+b);if(a.hasClass("re-click"))d.slideUp(500,function(){d.empty();a.removeClass("re-click")});else{$(".replyBox").empty();d.empty();var e=username==""?defaultname:username,f="";f=userid>0?'\u6b22\u8fce\u4f60\uff0c<strong class="cor-06c">'+e+'</strong> <lable><input type="checkbox"  name="anonymous" value="1" title="\u9009\u4e2d\u540e\uff0c\u4f60\u5c06\u4ee5\u533f\u540d\u65b9\u5f0f\u53d1\u5e03\u7559\u8a00\uff0c\u4e0d\u4f1a\u663e\u793a\u4f60\u7684\u7528\u6237\u540d" /> \u533f\u540d\u53d1\u5e03</lable>':
        "\u6e38\u5ba2\u53d1\u5e03";$(".re-click").removeClass("re-click");a.addClass("re-click");e="<div class='post-comment-area italk-area re-italk-area' id='replyBox'><form action='?app=comment&controller=comment&action=reply' method='POST' onsubmit='replySubmit(this);return false'><input type='hidden' name='contentid' value='"+contentid+"'/><input type='hidden' name='commentid' value='"+b+"'/><textarea name='content' id='replyContent' rows='10' cols='58' class='textarea textarea-w573'></textarea><div class='user-writeinfo'><span class='f-r'><input type='submit' value='\u53d1\u8868\u8bc4\u8bba' name='' class='post-btn p-pl'></span><span class='f-l'>"+
            f+"</span></div></form></div>";d.hide().html(e).slideDown(500)}};


    window.replySubmit = function (b){var c=$(b).find("textarea").val();if(islogin==1&&userid<1)alert("\u8bf7\u767b\u5f55\u540e\u518d\u53d1\u8868\u8bc4\u8bba\uff01");else if(c=="")alert("\u8bc4\u8bba\u5185\u5bb9\u4e0d\u80fd\u4e3a\u7a7a");else c.length>wordage?alert("\u8bc4\u8bba\u5185\u5bb9\u4e0d\u80fd\u8d85\u8fc7"+wordage+"\u5b57"):$.ajax({type:"POST",data:$(b).serialize(),url:"?app=comment&controller=comment&action=reply",dataType:"json",success:function(a){if(a.state){$("#replyContent").addClass("reply-suc");$("#replyBox").fadeOut("slow",
                function(){$("#replyBox").remove();$(".re-click").removeClass("re-click");if(parseInt(a.data.commentid)!=0){tableApp.addRow(a.data,true);ischeck!=0&&$("#commentbox_"+a.data.commentid+"> .user-info").append("<span>\u8bc4\u8bba\u63d0\u4ea4\u6210\u529f\uff0c\u5c06\u5728\u5ba1\u6838\u540e\u5176\u4ed6\u7528\u6237\u624d\u80fd\u770b\u5230...</span>");$(".commentTotal").html(++total)}window.location.hash="commentbox_"+a.data.commentid})}else alert(a.error)}});return false};


    window.login = function (){var b=$("#login_username").val(),c=$("#login_password").val();if(b==""){alert("\u8bf7\u8f93\u5165\u7528\u6237\u540d");$("#login_username").focus();return false}if(c==""){alert("\u8bf7\u8f93\u5165\u5bc6\u7801");$("#login_password").focus();return false}$.ajax({type:"POST",data:{username:b,password:c},url:"?app=member&controller=index&action=ajaxlogin",dataType:"json",success:function(a){if(a.state){userid=a.userid;username=a.username;$(".notLogin").hide()}else alert(a.error)}})};


    window.logout = function (){$.getJSON("?app=member&controller=index&action=logout",function(){userid=0;username=""});window.location.reload()};

})(jQuery);

