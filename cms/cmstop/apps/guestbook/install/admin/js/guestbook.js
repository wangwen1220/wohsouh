var guestbook={view:function(a){ct.form("\u67e5\u770b\u7559\u8a00","?app=guestbook&controller=guestbook&action=reply&gid="+a,560,380,function(b){b?ct.ok("\u64cd\u4f5c\u6210\u529f"):ct.error("\u53d1\u751f\u9519\u8bef");return true})},del:function(a){if(a===undefined){a=tableApp.checkedIds();var b='\u786e\u5b9a\u5220\u9664\u9009\u4e2d\u7684<b style="color:red">'+a.length+"</b>\u6761\u8bb0\u5f55\u5417\uff1f"}else b='\u786e\u5b9a\u5220\u9664\u7f16\u53f7\u4e3a<b style="color:red">'+a+"</b>\u7684\u8bb0\u5f55\u5417\uff1f";
if(a.length===0){ct.warn("\u8bf7\u9009\u62e9\u8981\u64cd\u4f5c\u7684\u8bb0\u5f55");return false}ct.confirm(b,function(){$.getJSON("?app=guestbook&controller=guestbook&action=delete&gid="+a,function(c){if(c.state){tableApp.deleteRow(a);ct.ok("\u64cd\u4f5c\u6210\u529f")}else ct.error(c.error)})})}};
