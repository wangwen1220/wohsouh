<?php 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>PHP��ͼƬ�ϴ�����</title>
<meta name="keywords" content="flash�ϴ�,���flash�ϴ�,ͼƬ�ϴ������ͼƬ�ϴ���������ͼƬ�ϴ���ͼƬ��ˢ���ϴ�,ͼƬ,�����ϴ�" />
<meta name="description" content="��վΪ�������ṩ�����ļ����2M��FLASH�ϴ���PHP����qhjsw.net," />
<link href="css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="swfupload/swfupload.js"></script>
<script type="text/javascript" src="js/swfupload.queue.js"></script>
<script type="text/javascript" src="js/fileprogress.js"></script>
<script type="text/javascript" src="js/handlers.js"></script>
<script type="text/javascript">
		var swfu;
		window.onload = function() {
			var settings = {
				flash_url : "swfupload/swfupload.swf",	
				upload_url: "upload.php",	// Relative to the SWF file
				post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
				file_size_limit : "2 MB",
				file_types : "*.jpg;*.gif;*.png",
				file_types_description : "ͼ�����flash�ļ�",
				file_upload_limit : 100,
				file_queue_limit : 10,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				debug: false,

				// Button settings
				button_image_url: "images/btn1.gif",	//Relative to the Flash file
				button_width: "125",
				button_height: "25",
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text: '',
				button_text_style: "",
				button_text_left_padding: 0,
				button_text_top_padding: 0,

				// The event handler functions are defined in handlers.js
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : uploadSuccess,
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	// Queue plugin event
			};

			swfu = new SWFUpload(settings);
	     };
	</script>
	
<style>

</style>
</head>
<body>

			<form id="form1" action="#" method="post" enctype="multipart/form-data">
				<div class="button">
					<span id="spanButtonPlaceHolder"></span>
					<input id="btnUpload" type="button" value="" onclick="swfu.startUpload();" disabled="disabled" style="margin-left: 2px; width:121px; height: 25px; background:url(images/btn2.gif) no-repeat; border:0;" />
					<input id="btnCancel" type="button" value="" onclick="swfu.cancelQueue();" disabled="disabled" style="margin-left: 2px; width:121px; height: 25px; background:url(images/btn3.gif) no-repeat; border:0;" />
					<span id="divStatus" class="status">0 ���ļ����ϴ�</span>
				</div>

				<div class="textads">
�ϴ�ҳ�����ڼ��������δ����ѡ���ϴ���Ť���ӵ�Ƭ��...
</div>

				<div class="fieldset flash" id="fsUploadProgress">
					<span class="legend">�ϴ�����</span>
				</div>
			</form>
</body>
</html>