var i=0,group={init:function(){$(".imagebox>img").attrTips();$(".imagebox").lightBox();$("#pictures>div").find("ul>li").show();$("#pictures>div:first-child").find("ul>li:nth-child(2)").hide();$("#pictures>div:last-child").find("ul>li:nth-child(3)").hide()},add:function(d,b,e,f,a){i++;if(typeof e==="undefined")e="";if(typeof f==="undefined")f=i;if(typeof a==="undefined")a=0;var c='<div id="'+i+'"><table id="picture_'+i+'" width="80%">';c+="<tr>";c+='<th width="25" valign="top"><input type="hidden" name="pictures['+
i+'][pictureid]" id="pictureid_'+i+'" value="'+a+'"/><input type="text" name="pictures['+i+'][sort]" id="sort_'+i+'" onchange="javascript:group.order_sort('+i+', this.value);return false;" value="'+f+'" size="1" class="mar_10"/></th>';c+="<td>";c+='<table  border="0" cellspacing="0" cellpadding="0" style="margin-top:7px;">';c+="<tr>";c+='<td width="110" valign="top">\t\t<div style="position:relative">\t\t<div style="position:absolute;background:#000000;opacity:0.5;filter:alpha(opacity=50);width:100px;height:18px;left:2px;top:65px;">\t\t<span id="uploadphoto'+
i+'" style="display:inline-block;color:#FFFFFF;opacity:1;text-align:center;width:100px;">\u91cd\u65b0\u4e0a\u4f20</span>\t\t</div>\t\t<a href="'+UPLOAD_URL+b+'" title="\u70b9\u51fb\u67e5\u770b\u5927\u56fe" class="imagebox">\t\t<img id="thinkbox_'+i+'" src="'+UPLOAD_URL+b+'" alt="'+b+'" width="100" height="80" class="pic"/>\t\t</a>\t\t</div>\t\t<input type="hidden" name="pictures['+i+'][aid]" id="aid_'+i+'" value="'+d+'"/><input type="hidden" name="pictures['+i+'][image]" id="image_'+i+'" value="'+
b+'"/></td>';c+='<td width="500px"><textarea name="pictures['+i+'][note]" id="note_'+i+'" cols="80" rows="5" class="c_gray w_500 h_80 mar_5">'+e+"</textarea></td>";c+='<td align="left">';c+="<ul>";c+='<li style="width:18px;height:25px;"><span id="picture_delete_'+i+'" style="cursor:pointer" onclick="group.remove('+i+",'"+d+'\')"><img src="images/del.gif" width="16" height="16" alt="\u5220\u9664" /></span></li>';c+='<li style="width:18px;height:25px;"><span id="picture_up_'+i+'" style="cursor:pointer" onclick="group.up('+
i+')"><img src="images/up.gif" width="16" height="16" alt="\u5411\u4e0a" /></span></li>';c+='<li style="width:18px;height:25px;"><span id="picture_down_'+i+'" style="cursor:pointer" onclick="group.down('+i+')"><img src="images/down.gif" width="16" height="16" alt="\u5411\u4e0b"  /></span></li>';c+="</ul>";c+="</td>";c+="</tr>";c+="</table>";c+="</td>";c+="</tr>";c+="</table></div>";$("#pictures").append(c);group.reupload(i);group.init()},reupload:function(d){$("#uploadphoto"+d).uploader({uploader:"uploadify/uploadify.swf",
script:"?app=picture&controller=picture&action=upload&auth="+ct.getCookie(COOKIE_PRE+"auth"),method:"POST",queueID:"fileQueue",fileDesc:"\u6ce8\u610f:\u60a8\u53ea\u80fd\u4e0a\u4f20jpeg,png,gif\u683c\u5f0f\u7684\u6587\u4ef6!",fileExt:"*.jpg;*.jpeg;*.gif;*.png;",width:"100",height:"18",multi:false}).bind("complete.uploadify",function(b,e,f,a){if(a!=0){b=a.split("|");e=b[0];b=b[1];$("#image_"+d).val(b);$("#aid_"+d).val(e);$("#thinkbox_"+d).attr("src",UPLOAD_URL+b).parent().attr("href",UPLOAD_URL+b)}else ct.error("\u5bf9\u4e0d\u8d77\uff01\u60a8\u4e0a\u4f20\u6587\u4ef6\u8fc7\u5927\u800c\u5931\u8d25!")}).bind("error.uploadify",
function(b,e,f,a){alert(a.type)}).next().andSelf().hover(function(){this.style.color="#FFFF00";this.style.textDecoration="underline"},function(){this.style.color="#FFFFFF";this.style.textDecoration="none"})},up:function(d){var b=$("#picture_"+d).parent();if(b.prev().is("div")){var e=b.prev().attr("id"),f=$("#sort_"+d).val(),a=$("#sort_"+e).val();$("#sort_"+d).val(a);$("#sort_"+e).val(f);b.insertBefore(b.prev());group.init()}},down:function(d){var b=$("#picture_"+d).parent();if(b.next().is("div")){var e=
b.next().attr("id"),f=$("#sort_"+d).val(),a=$("#sort_"+e).val();$("#sort_"+d).val(a);$("#sort_"+e).val(f);b.insertAfter(b.next());group.init()}},remove:function(d){$("#picture_"+d).parent().remove();group.init()},order_sort:function(d,b){if(isNaN(b)){ct.warn("\u8bf7\u8f93\u5165\u963f\u62c9\u4f2f\u6570\u5b57\uff01");$("#sort_"+d).val("0")}else{var e=[];$("#pictures > div").each(function(f){var a=$(this).attr("id");e[f]=[$("#aid_"+a).val(),$("#image_"+a).val(),$("#note_"+a).val(),$("#sort_"+a).val(),
$("#pictureid_"+a).val()]});e.sort(function(f,a){return f[3]-a[3]});$("#pictures").html("");$.each(e,function(f,a){group.add(a[0],a[1],a[2],a[3],a[4])})}}};


/*rewrite group.init*/
group.init = function(){
  $(".imagebox").lightBox();
};

/*rewrite group.reupload*/
group.reupload = function(i){
  var o = $("#uploadphoto"+i);
  o.uploadify({
    uploader: "uploadify/uploadify.swf",
    script: escape("?app=picture&controller=picture&action=upload&auth=" + ct.getCookie(COOKIE_PRE + "auth")),
    method: "POST",
    fileDesc: "\u6CE8\u610F:\u60A8\u53EA\u80FD\u4E0A\u4F20jpeg,png,gif\u683C\u5F0F\u7684\u6587\u4EF6!",
    fileExt: "*.jpg;*.jpeg;*.gif;*.png;",
    queueID: "fileQueue"+i,
    width: "102",
    height: "22",
    auto: true,
    multi: false, 
    buttonImg:'images/reupload.gif',
    wmode:'transparent',
    onComplete: function(evt, ID, fileObj, response, data) {
      b=response.split("|");
      e=b[0];
      b=b[1];
      $("#image_"+i).val(b);
      $("#aid_"+i).val(e);
      $("#thinkbox_"+i).attr("src",UPLOAD_URL+b).parent().attr("href",UPLOAD_URL+b);
    },
    onError: function (a, b, d, c) {ct.error(c.type + c.info);}
  });
};

/*rewrite group.add*/
group.add = function(d, b, e, f, a){
  if(i>=150){
    ct.error('最多只能添加150张图片！');
    return;
  }
  i++;
  if(typeof e==="undefined")e="";
  if(typeof f==="undefined")f=i;
  if(typeof a==="undefined")a=0;
  var c=['<table id="picture_', i, '" width="80%">', "<tr>", '<th width="25" valign="top"><input type="hidden" name="pictures[', i, '][pictureid]" id="pictureid_', i, '" value="', a, '"/><input type="text" name="pictures[', i, '][sort]" id="sort_', i, '" onchange="javascript:group.order_sort(', i, ', this.value);return false;" value="', f, '" size="1" class="mar_10"/></th>', "<td>",

    '<table border="0" cellspacing="0" cellpadding="0" style="margin-top:7px;">',
      '<tr>',
      '<td width="110" valign="top">',
      '<div style="background:#eee;padding:5px;">',
      '<a href="', UPLOAD_URL, b, '" target="_blank" title="\u70b9\u51fb\u67e5\u770b\u5927\u56fe" class="imagebox">',
      '<img id="thinkbox_', i, '" src="', UPLOAD_URL, b, '" width="100" height="80" class="pic"/>',
      '</a>',
      '<div id="uploadphoto', i, '"></div>',
      '</div>',
      '<input type="hidden" name="pictures[', i, '][aid]" id="aid_', i, '" value="', d, '"/>',
      '<input type="hidden" name="pictures[', i, '][image]" id="image_', i, '" value="', b, '"/></td>',
      '<td width="500px">',
      '<textarea name="pictures[', i, '][note]" id="note_', i, '" cols="80" rows="5" class="c_gray w_500 h_80 mar_5">', e,
      '</textarea>',
      '</td>',
      '<td align="left">',
      '<ul>',
      '<li style="width:18px;height:25px;"><span id="picture_delete_', i, '" style="cursor:pointer" onclick="group.remove(', i, ",'", d, '\')"><img src="images/del.gif" width="16" height="16" alt="\u5220\u9664" /></span></li>', '<li style="width:18px;height:25px;"><span id="picture_up_', i, '" style="cursor:pointer" onclick="group.up(', i, ')"><img src="images/up.gif" width="16" height="16" alt="\u5411\u4e0a" /></span></li>', '<li style="width:18px;height:25px;"><span id="picture_down_', i, '" style="cursor:pointer" onclick="group.down(', i, ')"><img src="images/down.gif" width="16" height="16" alt="\u5411\u4e0b" /></span></li>',
      "</ul>",
      "</td>",
      "</tr>",
      "</table>",
      "</td>",
      "</tr>",
      "</table>"].join('');

  var picBox = document.getElementById("pictures");
  var div = document.createElement('div');
  picBox.appendChild(div);
  div.id = i;
  div.innerHTML = c;
  div = null;
  group.reupload(i);
  group.init();
};