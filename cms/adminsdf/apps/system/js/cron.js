var cron={save:function(a){function b(){ct.form(e,c,500,380,function(d){if(d.state){a?tableApp.updateRow(a,d.data):tableApp.addRow(d.data);return true}else{ct.error(d.error);return false}},function(){$("input.mode").click(function(){$("tr.mode1,tr.mode2,tr.mode3").hide();$("tr.mode"+this.value).show()});$("input.input_calendar").focus(function(){var d={dateFmt:"yyyy-MM-dd HH:mm:00",minDate:"%y-%M-%d %H:%m",maxDate:"%y-%M-{%d+365}"};if(this.id=="starttime")d.maxDate="#F{$dp.$D('endtime') || '%y-%M-{%d+365}'}";
if(this.id=="endtime")d.minDate="#F{$dp.$D('starttime') || '%y-%M-%d %H:%m'}";WdatePicker(d)});$("a.checkAll, a.cancelAll").click(function(){$(this).parent().parent().find("input[type=checkbox]").attr("checked",this.className=="checkAll")})})}var c="?app=system&controller=cron&action=save",e="\u6dfb\u52a0\u8ba1\u5212\u4efb\u52a1";if(typeof a=="object"||!a)a=null;if(typeof a=="string"){c+="&id="+a;e="\u7f16\u8f91\u8ba1\u5212\u4efb\u52a1"}if($("#row_"+a+'>td:contains("\u7cfb\u7edf\u4efb\u52a1")').length){ct.warn("\u8fd9\u662f\u7cfb\u7edf\u4efb\u52a1,\u8bf7\u8c28\u614e\u4fee\u6539");
$("div.pop_box>.btn_area>button").click(b)}else b()},del:function(a){if(typeof a=="object"||!a){a=tableApp.checkedIds().join(",");var b=1}if(!a)return ct.warn("\u8bf7\u9009\u62e9\u8981\u5220\u9664\u7684\u4efb\u52a1");var c="\u786e\u5b9a\u5220\u9664\u9009\u4e2d\u7684\u4efb\u52a1\u5417\uff1f";if($("#list_body>tr.row_chked, #row_"+a).find('td:contains("\u7cfb\u7edf\u4efb\u52a1")').length>0)c="\u9009\u4e2d\u7684\u4efb\u52a1\u5305\u542b\u7cfb\u7edf\u4efb\u52a1, \u5f3a\u70c8\u5efa\u8bae\u4e0d\u8981\u5220\u9664, \u9664\u975e\u4f60\u786e\u5b9a\u81ea\u5df1\u5728\u5e72\u4ec0\u4e48.";
ct.confirm(c,function(){$.getJSON("?app=system&controller=cron&action=delete&id="+a,function(e){if(e.state){if(b)a=null;tableApp.deleteRow(a)}else ct.error("\u5220\u9664\u5931\u8d25\uff01")})})},copy:function(a){if(typeof a=="object"||!a){a=tableApp.checkedIds();if(a.length<1)return ct.warn("\u8bf7\u9009\u62e9\u8981\u590d\u5236\u7684\u8bb0\u5f55");else if(a.length==1)a=a[0];else return ct.warn("\u53ea\u80fd\u590d\u5236\u4e00\u6761\u8bb0\u5f55")}$.getJSON("?app=system&controller=cron&action=copy&id="+
a,function(b){b.state?tableApp.addRow(b.data):ct.error("\u590d\u5236\u5931\u8d25\uff01")})},log:function(a){var b="?app=system&controller=cron&action=viewlog",c="\u5168\u90e8\u4efb\u52a1\u8fd0\u884c\u65e5\u5fd7";if(typeof a!="string"){a=tableApp.checkedIds();a=a.length==1?a[0]:null}if(a){b+="&id="+a;c=$("#row_"+a+" a:first").text()+"-\u8fd0\u884c\u65e5\u5fd7"}ct.ajax(c,b,600,360,function(){})},delLog:function(a){var b="?app=system&controller=cron&action=delLog";if(a=="all"){b+="&type=all";a="\u786e\u5b9a\u8981\u5220\u9664\u6240\u6709\u4efb\u52a1\u7684\u8fd0\u884c\u65e5\u5fd7\u5417?"}else if(a==
"select"){a=logTable.checkedIds().join(",");if(!a)return ct.warn("\u8bf7\u9009\u62e9\u8981\u5220\u9664\u7684\u8bb0\u5f55");b+="&type=select&id="+a;a="\u786e\u5b9a\u5220\u9664\u9009\u4e2d\u7684\u65e5\u5fd7\u5417?"}else{b+="&type=cron&id="+a;a="\u786e\u5b9a\u5220\u9664\u9009\u4e2d\u4efb\u52a1\u7684\u65e5\u5fd7\u5417\uff1f"}ct.confirm(a,function(){$.getJSON(b,function(c){c.state?logTable.load():ct.error(c.error)})})},run:function(a){$.getJSON("?app=system&controller=cron&action=interval&run="+a,function(b){if(b.state){ct.ok(b.info);
tableApp.load()}else ct.error("\u68c0\u6d4b\u51fa\u9519")})},interval:function(){$.getJSON("?app=system&controller=cron&action=interval",function(a){if(a.state){ct.ok(a.info);tableApp.load()}else ct.error("\u68c0\u6d4b\u51fa\u9519")})}};