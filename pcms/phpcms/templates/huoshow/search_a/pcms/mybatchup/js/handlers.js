function fileQueued(file) {
	try {
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		/***这里做了一个直接执行下一步操作，如果想要出现等待上传，就把下面这句改注释***/
		$('#btnUpload').click();
		progress.setStatus("等待上传...");
		progress.toggleCancel(true, this);

	} catch (ex) {
		this.debug(ex);
	}

}

function fileQueueError(file, errorCode, message) {
	try {
		if (errorCode === SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED) {
			alert("对不起，每次最多允许选择"+message+"个文件");
			return;
		}

		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setError();
		progress.toggleCancel(false);

		switch (errorCode) {
		case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
			progress.setStatus("文件太大.");
			this.debug("Error Code: File too big, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
			progress.setStatus("不允许上传0字节的文件.");
			this.debug("Error Code: Zero byte file, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
			progress.setStatus("未知文件类型.");
			this.debug("Error Code: Invalid File Type, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		default:
			if (file !== null) {
				progress.setStatus("未知错误!");
			}
			this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		}
	} catch (ex) {
        this.debug(ex);
    }
}

function fileDialogComplete(numFilesSelected, numFilesQueued) {
	try {
		if (numFilesSelected > 0) {
			document.getElementById('btnUpload').disabled = false;
			document.getElementById(this.customSettings.cancelButtonId).disabled = false;
		}

		/* I want auto start the upload and I can do that here */
		//this.startUpload();
	} catch (ex)  {
        this.debug(ex);
	}
}

function uploadStart(file) {
	try {
		/* I don't want to do any file validation or anything,  I'll just update the UI and
		return true to indicate that the upload should start.
		It's important to update the UI here because in Linux no uploadProgress events are called. The best
		we can do is say we are uploading.
		 */
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setStatus("上传中...");
		progress.toggleCancel(true, this);
	}
	catch (ex) {}

	return true;
}

function uploadProgress(file, bytesLoaded, bytesTotal) {
	try {
		var percent = Math.ceil((bytesLoaded / bytesTotal) * 100);

		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setProgress(percent);
		progress.setStatus("上传中...");
	} catch (ex) {
		this.debug(ex);
	}
}

function uploadSuccess(file, serverData) {
	try {
		//if (serverData.substring(1, 5) === "suc:") {
		if (serverData.indexOf("suc")!=-1) {

			//var fileinfo = serverData.substring(4).split(",");
			var fileinfo = serverData.substring(0).split(",");
			var progress = new FileProgress(file, this.customSettings.progressTarget);
			progress.setComplete();
			progress.setText("");
			var status = "<div class='pin-item fn-clear'>";
				status += "<div class='pin-item-img'>";
					status += "<input type='hidden' name='img' value=''/>";
					status += "<a class='img'><img src=\"/myshowpic/image/"+fileinfo[1]+"\" width='100' height='100'/><span class='status'>上传成功</span></a>";
//					status += "<div class='set-cover'><input type='radio' name='setcover' value='1'/> <label>设为封面</span></div>";
				status += "</div>";
				status += "<div class='pin-item-info'>";
					status += "<div class='pin-info-item pin-info-desc'><label class='pint-info-label'>描述：</label>";
					status += "<div class='pin-info-input fancy'><textarea name='description' class='desc'></textarea>";
					status += "<label>描述一下这个专辑...别忘@好友哦</label></div></div>";
					status += "<div class='pin-info-item pin-info-tags'>";
						status += "<label class='pint-info-label'>标签：</label><div class='pin-info-input fancy tags'>";
						status += "<span class='tag-container'></span>";
						status += "<input type='text' class='pin-tags' autocomplete='off' /><label>最多5个标签，以空格隔开</label>";
//						status += "<div class='select-tags'>";
//							status += "<h3>常用标签</h3><div class='tag-list-wrapper'><div class='tag-list'>";
//							status += "<ul class='tag-list-item fn-clear'>";
//							status += "<li><a id='11'>AA</a></li>";
//							status += "</ul></div></div>";
//							status += "<div class='tags-nav tag-list-nav'>";
//								status += "<a class='tags-prev tag-list-prev disabled' href='javascript:;' hidefocus='true'>上一组</a>";
//								status += "<a class='tags-next tag-list-next' href='javascript:;' hidefocus='true'>下一组</a>";
//								status += "<a class='tags-close' href='javascript:;' hidefocus='true'>关闭</a>";
//							status += "</div>";
//						status += "</div>";
					status += "</div>";
				status += "</div>";
			status += "</div>";
			status +="<a class='del-pin' href='javascript:;' title='删除'>删除</a>";
//			status += "恭喜你，文件上传成功！ <br />";
//			status += "大小："+parseFloat(parseInt(fileinfo[2])/1024).toFixed(2)+ "K <br />";
//			status += "地址：http://pnews.zyc.huoshow.com/"+fileinfo[0]+fileinfo[1];   //这里需要自己根据自己网站实际情况坐下修改
			document.getElementById("pin-info-way-one").style.display = 'block';
			document.getElementById("pin-info-way-two").style.display = 'block';
			document.getElementById("js-submit").style.display = 'block';
			document.getElementById("notice-wrapper").style.display = 'none';
			document.getElementById("upload-pin-dialog").style.position = 'absolute';
			document.getElementById("upload-pin-dialog").style.top = '0';
			progress.setStatus(status);
			progress.toggleCancel(false);
			document.getElementById('imglist').innerHTML += '[img]http://pnews.zyc.huoshow.com/'+fileinfo[0]+fileinfo[1]+'[/img]<br/>';
		}else{
			var progress = new FileProgress(file, this.customSettings.progressTarget);
			progress.setError();
			//progress.setStatus("上传失败："+serverData.substring(4));
			progress.setStatus("上传失败："+serverData.substring(0));
			progress.toggleCancel(false);
		}

	} catch (ex) {
		this.debug(ex);
	}
}

function uploadError(file, errorCode, message) {
	try {
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setError();
		progress.toggleCancel(false);

		switch (errorCode) {
		case SWFUpload.UPLOAD_ERROR.HTTP_ERROR:
			progress.setStatus("文件上传失败: " + message);
			this.debug("Error Code: HTTP Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_FAILED:
			progress.setStatus("文件上传失败");
			this.debug("Error Code: Upload Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.IO_ERROR:
			progress.setStatus("服务器IO错误");
			this.debug("Error Code: IO Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.SECURITY_ERROR:
			progress.setStatus("安全错误");
			this.debug("Error Code: Security Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
			progress.setStatus("文件大小超过限制");
			this.debug("Error Code: Upload Limit Exceeded, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_VALIDATION_FAILED:
			progress.setStatus("验证失败，上传已被跳过");
			this.debug("Error Code: File Validation Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
			// If there aren't any files left (they were all cancelled) disable the cancel button
			if (this.getStats().files_queued === 0) {
				document.getElementById('btnUpload').disabled = true;
				document.getElementById(this.customSettings.cancelButtonId).disabled = true;
			}
			progress.setStatus("已取消上传");
			progress.setCancelled();
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
			progress.setStatus("已停止上传");
			break;
		default:
			progress.setStatus("未知错误:" + errorCode);
			this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		}
	} catch (ex) {
		this.debug(ex);
	}
}

function uploadComplete(file) {
	if (this.getStats().files_queued === 0) {
		document.getElementById('btnUpload').disabled = true;
		document.getElementById(this.customSettings.cancelButtonId).disabled = true;
	}
}

// This event comes from the Queue Plugin
function queueComplete(numFilesUploaded) {
	var status = document.getElementById("divStatus");
	if(status) status.innerHTML = numFilesUploaded + "个文件被上传.";
}

// 初始化
var swfu;
//window.onload = function() {
	var settings = {
		flash_url: "/mybatchup/swfupload/swfupload.swf",
		upload_url: "/mybatchup.php",	// Relative to the SWF file
		post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
		file_size_limit: "2 MB",
		file_types: "*.jpg;*.gif;*.png",
		file_types_description: "图像或者flash文件",
		file_upload_limit: 10,
		file_queue_limit: 10,
		custom_settings: {
			progressTarget: "fsUploadProgress",
			cancelButtonId: "btnCancel"
		},
		debug: false,

		// Button settings
		button_image_url: "/mybatchup/images/btn1.jpg",	//Relative to the Flash file
		button_width: "250",
		button_height: "45",
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

	document.forms[0].reset(); // 刷新时重置表单
//};