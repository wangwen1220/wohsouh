$(function(){
	$("#uploadimg").uploadify({
			'uploader'       : 'uploadify/uploadify.swf',
			'script'         : escape('?app=editor&controller=image&action=upload&auth='+ct.getCookie(COOKIE_PRE+'auth')),
			'method'		 : 'POST',
			'fileDataName'   : 'ctimg',
			'fileDesc'		 : '注意:您只能上传jpg,jpeg,gif,png,bmp格式的文件!',
			'fileExt'		 : '*.jpg;*.jpeg;*.gif;*.png;*.bmp;',
			'queueID'        : 'myvideo',
			'buttonImg'	 	 :'images/upload.gif',	
			'width'			 :'80',
			'height'		 :'22',	
			'auto'           : true,
			'multi'          : false,
			onOpen:function(event,queueID,fileobj)
			{
			},
			onProgress:function(event,queeuID,fileObj,data)
			{
				$('#src').val(data.percentage+'%');
			},
			onComplete:function(event,queueID,fileObj,response,data)
			{
				$('#src').val(response);
				ImageDialog.showPreviewImage(response);
			},
			onError:function(event,queueID,fileObj)
			{
			}
	});
})
