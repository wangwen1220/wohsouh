function confirmurl(url,message) {
	url = url+'&pc_hash='+pc_hash;
	if(confirm(message)) redirect(url);
}
function redirect(url) {
	location.href = url;
}
//滚动条
$(function(){
	$(":text").addClass('input-text');
})

/**
 * 全选checkbox,注意：标识checkbox id固定为为check_box
 * @param string name 列表check名称,如 uid[]
 */
function selectall(name) {
	if ($("#check_box").attr("checked")==false) {
		$("input[name='"+name+"']").each(function() {
			this.checked=false;
		});
	} else {
		$("input[name='"+name+"']").each(function() {
			this.checked=true;
		});
	}
}
function openwinx(url,name,w,h) {
	if(!w) w=screen.width-4;
	if(!h) h=screen.height-95;
	url = url+'&pc_hash='+pc_hash;
    window.open(url,name,"top=100,left=400,width=" + w + ",height=" + h + ",toolbar=no,menubar=no,scrollbars=yes,resizable=yes,location=no,status=no");
}
//弹出对话框
function omnipotent(id,linkurl,title,close_type,w,h) {
	if(!w) w=700;
	if(!h) h=500;
	art.dialog({id:id,iframe:linkurl, title:title, width:w, height:h, lock:true},
	function(){
		if(close_type==1) {
			art.dialog({id:id}).close()
		} else {
			var d = art.dialog({id:id}).data.iframe;
			var form = d.document.getElementById('dosubmit');form.click();
		}
		return false;
	},
	function(){
			art.dialog({id:id}).close()
	});void(0);
}

//火秀定制
(function($) {
	$(function() {
		// 隐藏阅读权限
		if($('#js_table_form').length){
			$('#description').parents('tr').insertAfter($('#content_tip').parents('tr'));
		}
		$('tr:contains("阅读权限")').hide();

		// 栏目权限页添加全选功能
		var $priv_table = $('#load_priv table');
		$priv_table.find('th').each(function(){
			this.title = '点击全选';
		});
		$priv_table.find('th').click(function(){
			var $ts = $(this);
			var i = $ts.index();
			var flag = true;
			$priv_table.find('tbody tr').each(function(){
				if(!$(this).find('td:eq(' + i + ') input:checkbox')[0].checked) flag= false;
			});
			if(flag){
				$ts.attr('title', '点击全选');
			}else{
				$ts.attr('title', '点击取消全选');
			}
			$priv_table.find('tbody tr').each(function(){
				var $checkbox = $(this).find('td:eq(' + i + ') input:checkbox');
				if(i == 0){
					$(this).find('td input:checkbox').attr('checked', !flag);
				}else{
					$checkbox.attr('checked', !flag);
				}
			});
		});
	});
})(jQuery);