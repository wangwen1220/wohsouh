var classify={save:function(a){var c="?app=section&controller=classify&action=save",b="\u6dfb\u52a0\u5206\u7c7b";if(typeof a=="object"||!a)a=null;if(typeof a=="string"||typeof a=="number"){c+="&classid="+a;b="\u7f16\u8f91\u5206\u7c7b"}ct.form(b,c,310,175,function(d){if(d.state){tableApp.load();return true}else{ct.alert(d.error,"error");return false}})},view:function(a){ct.assoc.open("?app=section&controller=section&action=index&classid="+a)},del:function(a){if(typeof a=="object"||!a){a=tableApp.checkedIds();
for(k in a)if(a[k]==1)return ct.tips('\u4e0d\u80fd\u5220\u9664"\u5176\u5b83"');a=a.join(",")}if(a==1)return ct.tips('\u4e0d\u80fd\u5220\u9664"\u5176\u5b83"\u5206\u7c7b');if(!a)return ct.tips("\u8bf7\u9009\u62e9\u8981\u5220\u9664\u7684\u533a\u5757");ct.confirm("\u5220\u9664\u5206\u7c7b\u540e\u6b64\u5206\u7c7b\u4e0b\u7684\u6240\u6709\u533a\u5757\u4f1a\u79fb\u52a8\u5230\u201c\u5176\u5b83\u201d\u5206\u7c7b\u4e0b\u9762\uff0c\u662f\u5426\u5220\u9664\uff1f",function(){$.get("?app=section&controller=classify&action=delete&id="+
a,function(c){c==1?tableApp.load():ct.alert("\u5220\u9664\u5931\u8d25\uff01")})})},up:function(a){classify.upDown(a,"up")},down:function(a){classify.upDown(a,"down")},upDown:function(a,c){if(c=="up"){var b=$("#tr_"+a).prev("tr");if(b.length<1)return;$("#tr_"+a).after(b)}else{b=$("#tr_"+a).next("tr");if(b.length<1)return;$("#tr_"+a).before(b)}b=b.attr("id").replace("tr_","");$.get("?app=section&controller=classify&action=upDown&id="+a+"&targetid="+b,function(d){d!=1&&ct.alert("\u4fdd\u5b58\u987a\u5e8f\u5931\u8d25")})}};