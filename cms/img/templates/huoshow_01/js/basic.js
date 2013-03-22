(function($){

    window.getNowTime = function (){
        var now= new Date();   
        var year=now.getYear();   
        var month=now.getMonth()+1;   
        var day=now.getDate();   
        var hour=now.getHours();   
        var minute=now.getMinutes();   
        var second=now.getSeconds();   
        var nowdate=year+""+month+""+day+""+hour+""+minute+""+second;   
        return nowdate;
    };

    window.getHtml = function (url,id){
        $("#"+id).html('<div style="width:100%;text-align:center;"><img src="/img/templates/huoshow_01/image/common/loading.gif"  title="加载中..."/></div>');
        $.get(url,function(rs){			
            $("#"+id).html(rs);				
        });
    };
    window.quicklogin=function(APP_URL){	
    	
		var username = $('#username').val();
		var password = $('#password').val();
		if ( username == '') {
			alert('用户名不能为空');
			return false;
		}
		if ( password == '') {
			alert('密码不能为空');
			return false;
		}
		
		$.getJSON(APP_URL+'?app=member&controller=index&action=ajaxlogin&username='+username+'&password='+password+'&jsoncallback=?', function(json){
			if(json.state) {
				username = json.username;
				$('#nickname').html(username);
				$('#fastLoginDiv,#quickLogin').hide();
				$('#quickLogout,#anonymous').show();
			} else {
				alert(json.error);
			}
		});
		return false;
    	
    }

})(jQuery);
