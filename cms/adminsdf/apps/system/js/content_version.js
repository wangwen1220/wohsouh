var versionid;function version_add(){$("#content_version_add").ajaxForm("add_ok")}function add_ok(a){if(a.state){ct.ok("\u4fdd\u5b58\u6210\u529f");window.location.reload()}else ct.error(a.error)}function version_restore(a){$.getJSON("?app=system&controller=content_version&action=restore&versionid="+a,function(b){b.state?ct.ok("\u6062\u590d\u6210\u529f"):ct.error(b.error)})}
function version_delete(a){versionid=a;ct.confirm("\u6b64\u64cd\u4f5c\u4e0d\u53ef\u6062\u590d\uff0c\u786e\u8ba4\u5220\u9664\u5417\uff1f","version_delete_submit","null_func")}function version_delete_submit(){$.getJSON("?app=system&controller=content_version&action=delete&versionid="+versionid,function(a){if(a.state){$("#tr_"+versionid).remove();ct.ok("\u522a\u9664\u6210\u529f")}else ct.error(a.error)})};