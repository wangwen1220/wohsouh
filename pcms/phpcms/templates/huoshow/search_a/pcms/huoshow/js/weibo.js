(function(){
	if(window.WEIBO){
		return;
	}
	var $ = jQuery;
	var WEIBO = window.WEIBO = {};
	Backbone.setDomLibrary($);

	var config = WEIBO.config = WB_CONFIG;
	WEIBO.uid = discuz_uid;
	WEIBO.roomid = config.roomid;

	//往一输入框中插入表情
	WEIBO.insertFace = function (inputNode, faceId) {
		var faceText = '['+faceId+']';
			HUI.insertText(inputNode, faceText);
	};

	WEIBO._facePickerId = 'weibo_face_box';

	//显示表情选择框
	WEIBO.showFacePicker = function(triggerNode, inputNode){
		var picker = $('#'+this._facePickerId);
		if(!picker.length){
			picker = $('<div id="'+this._facePickerId+'"></div>');
			picker.css({visibility: 'hidden', position: 'absolute'});
		}
		$(document.body).append(picker);
		var content = [];
		for(var i=1; i<49; i++){
			content.push('<a href="#face', i, '" class="face" faceid="', i, '">',
				'<img src="\/static2\/images\/face\/face', i, '.gif" width="24" height="24" \/>',
			'<\/a>');
		}
		picker.html(content.join(''));
		HUI.park(picker.get(0), triggerNode, 'bl');
		picker.css({visibility: 'visible'}).show();
		picker.bind('click', function(e){
			e.stopPropagation();
		});
		picker.find('.face').bind('click', function(e){
			e.preventDefault();
			var textarea = inputNode;
			var faceid = this.getAttribute('faceid');
			WEIBO.insertFace(textarea, faceid);
			WEIBO.hideFacePicker();
		});
	};

	//隐藏表情选择框
	WEIBO.hideFacePicker = function(){
		$('#'+this._facePickerId).hide();
	};

	//微博消息模型类
	var Message = Backbone.Model.extend({});

	//微博消息集合类
	var MessageList = Backbone.Collection.extend({
		model: Message
	});

	//微博消息视图
	var MessageView = Backbone.View.extend({

		//下面这个标签的作用是，把template模板中获取到的html代码放到这标签中
		tagName:	"li",

		//微博消息视图模板
		template: _.template($('#_template_message').html()+''),

		//在初始化设置了 MessageView 和 Message 的以一对一引用
		initialize: function() {
			this.model.bind('change', this.change, this);
		},

		//渲染 Message 中的数据到 _template_message 中，然后返回对自己的引用 this
		render: function() {
			$(this.el).html(this.template(this.model.toJSON()));
			return this;
		},

		// 为每一个任务条目绑定事件
		events: {
			"click .reply": "toggleReplyForm",
			"click .forward": "showForwarForm",
			"click .close": "closeReplyForm",
			'submit #send_comment_form': 'sendComment',
			"click .destory": "destoryMessage",
			"click .wb-facepicker": "showFacePicker",
			"click .reset-form": "resetCommentFomm",
			"click .reply-button": "reply",
			"click .attachment-preview img": "showAttachmentView",
			"click .attachment-preview .img_wrapper": "showAttachmentView",
			"click .attachment-view-close": "closeAttachmentView"
		},

		//显示图片的大图或者音视频播放器
		//附件类型分来3种：
		//1图片、2视频、3音乐
		showAttachmentView: function(e) {
			$('.attachment', this.el).addClass('view-open');
			var type = $(e.target).attr('media_type');
			var url = $(e.target).attr('media_url');
			var content = '';
			if(type == 1){
				content = '<img src="'+url+'" />';
			}else{
				content = ['<object width="450" height="384" data="/static2/player.swf" ',
					'type="application/x-shockwave-flash" id="attachment_player">',
					'<param value="/static2/player.swf" name="movie">',
					'<param value="true" name="allowfullscreen">',
					'<param value="always" name="allowscriptaccess">',
					'<param value="file=', url, '" name="flashvars">',
					'</object>'].join('');
			}
			var $attachment_view_body = $('.attachment-view-body', this.el).html(content);
			if (ie6) {
				var $attachment_view_img = $attachment_view_body.find('img');
				if ($attachment_view_img.width() > $attachment_view_body.width() - 1) {
					$attachment_view_img.css('width', '100%');
				}
			}
			return false;//阻止冒泡
		},

		//关闭大图的显示和音视频播放器
		closeAttachmentView: function(e) {
			e.preventDefault();
			$('.attachment', this.el).removeClass('view-open');
			$('.attachment-view-body', this.el).html('');
		},

		//发送评论
		sendComment: function(e) {
			e.preventDefault();
			var form = $('#send_comment_form').get(0);
			var url = form.action;
			var _this = this;
			var content = form.comments.value;
			content = content.replace(/[\n]/g, '');
			if(content.replace(/[\n\s*\r]/g, '')==''){
				alert('评论内容不能为空！');
			}
			else if(content.length > 140){
				alert('评论内容不能超过140字！');
			}
			else{
				var data = {content: content, msgid: form.msgid.value};
				$.post(url, data, function(data){
					if(data){
						alert('评论成功！');
						$('.reply-count', _this.el).html(data);
						_this.closeReplyForm();
					}else{
						alert('评论失败！');
					}
				});
			}
		},

		//重置评论表单
		resetCommentFomm: function (e) {
			e.preventDefault();
			var form = $('#send_comment_form').get(0);
			form.reset();
		},

		//显示表情选择框
		showFacePicker: function(e) {
			e.preventDefault();
			e.stopPropagation();
			var trigger = $('.wb-facepicker', this.el).get(0);
			var input = $('textarea', this.el).get(0);
			WEIBO.showFacePicker(trigger, input);
		},

		//关闭评论表单框
		closeReplyForm: function(e) {
			if(e){
				e.preventDefault();
			}
			$('.reply-form', this.el).fadeOut(400).remove();
		},

		//显示或关闭评论框切换
		toggleReplyForm: function(e) {
			e.preventDefault();
			var form = $('.reply-form', this.el);
			if(form.length>0){
				form.remove();
			}else{
				$('#messages .reply-form').remove();
				$(this.el).append('<div class="reply-form">...</div>');
				form = $('.reply-form', this.el);
				$.get('/huoshow/module/weibo/weibo_user_comments.php?msg_id='+this.model.get('id'), function(data){
					form.html(data);
				});
			}
		},

		//回复（在评论框文本域中插入相关的内容并获得焦点）
		reply: function (e) {
			e.preventDefault();
			var text = $('.reply-text', e.target).val();
			var node = $('textarea', this.el).val(text).focus().get(0);
			if(node){
				if(document.selection){
					var r = node.createTextRange();
					r.collapse(true);
					r.select();
				}else{
					node.setSelectionRange(0, 0);
				}
			}
		},

		//弹出转发表单对话框
		showForwarForm: function(e) {
			e.preventDefault();
			//判断用户是否登录
			if(WEIBO.uid && (WEIBO.uid != 0) ) {
				showWindow('register', '/huoshow/module/weibo/ajax/weibo_user_dynamic_ajax.php?tab=ajax_user_forwarding&msg_id='+this.model.get('id')+'&reply_msg_id='+this.model.get('route_parent_msg_id'));
			}else{
				alert('没有权限，请登录');
			}
		},

		//删除一条微博消息
		destoryMessage: function(e) {
			e.preventDefault();
			if(confirm('确定删除这条广播？')){
				var url = '/huoshow/module/weibo/ajax/weibo_user_dynamic_ajax.php?tab=ajax_user_del_dynamic&manager_uid='+WEIBO.uid+'&msg_id='+this.model.get('id')+'&t='+(new Date).getTime();
				var _this = this;
				$.getJSON(url, function(data){
					if(data){
						_this.model.set('is_del', 1);
					}else{
						alert('操作失败');
					}
				});
			}
		},

		//微博消息被修改事件触发并调用该处理函数
		change: function(){
			this.render();
		}

	});

	//微博列表总视图
	var AppView = Backbone.View.extend({
		el: $(document.body),

		initialize: function() {
		},

		events:{
			'click .emos a': 'showFacePicker',
			'input #weibo_content': 'refreshInputLength',
			'keyup #weibo_content': 'refreshInputLength',
			'cut #weibo_content': 'refreshInputLength',
			'paste #weibo_content': 'refreshInputLength',
			'blur #weibo_content': 'refreshInputLength',
			'focus #weibo_content': 'refreshInputLength',
			'mouseup #weibo_content': 'refreshInputLength',
			'submit #send_message_form': 'sendMessage',
			'click .more-messages': 'fetchMore',
			'click .wb-music-picker': 'showMusicPicker',
			'click .wb-pic-picker': 'showPicPicker',
			'click .upload-box .close': 'hideUploadPicker',
			'click .music-input-ok': 'insertMusic',
			'click .del-pic': 'delPicture'
		},

		//图片上传选择框的ID标识
		_picPickerId: 'pic_picker',

		//显示图片上传选择框
		showPicPicker: function(e) {
			e.preventDefault();
			this.hideUploadPicker();
			$('#'+this._picPickerId).show();
		},

		//音乐插入框的ID标识
		_musicPickerId: 'music_picker',

		//显示音乐插入框
		showMusicPicker: function(e) {
			e.preventDefault();
			this.hideUploadPicker();
			$('.music-input').val($('#music_url').val());
			$('#'+this._musicPickerId).show();
		},

		//隐藏所有的选择框
		hideUploadPicker: function(e) {
			if(e){
				e.preventDefault();
			}
			$('.upload-box').hide();
		},

		//插入一个音乐URL
		insertMusic: function (e) {
			if($('.music-input').val().match(/^http:\/\/[\.a-zA-Z0-9\/]*(\.mp3)$/)) {
				$('#music_url').val($('.music-input').val());
				this.hideUploadPicker();
			}else{
				alert('歌曲链接地址错误：目前只支持MP3格式歌曲链接');
			}
		},

		//获得“发送消息表单”中已经插入的图片，返回这些图片的一个数组
		getPictures: function () {
			var form = $('#send_message_form').get(0);
			var pictures = form.elements.namedItem('pictures[]');
			if(!pictures){
				return [];
			}
			if(pictures.length === undefined){
				return [pictures];
			}
			return pictures;
		},

		//从“发送消息表单”中删除一张图片
		delPicture: function (e) {
			e.preventDefault();
			var fileId = $(e.target).attr('picid');
			$('#pic_'+fileId).remove();
			$('#pic_preview_item_'+fileId).remove();
			this.uploader.cancelUpload();
		},

		//添加一张图片到“发送消息表单”中
		addPicture: function (fileId, src) {
			if(this.getPictures().length<3){
				var input = '<input type="hidden" class="pic-field" name="pictures[]" value="'+src+'" id="pic_'+fileId+'" />';
				var indexDot = src.lastIndexOf('.');
				var thumb = src.substring(0, indexDot)+'_small'+src.substring(indexDot);
				var item = '<div class="pic-preview-item" id="pic_preview_item_'+fileId+'"><a href="#" class="del-pic" picid="'+fileId+'">删除</a><div><img src="'+thumb+'" /></div></div>';
				$('#send_message_form').append(input);
				$('.pic-preview').append(item);
			}
		},

		//字数计算
		charCount: function(node) {
			var content = $(node).val();
			var content_format;
			var count = 140;
			var $tiptext = $('.sendbox .tiptext');
			var $sendbutton = $('.sendbox .sendbutton');
			if(content) {
				content = content.replace(/[\n]/g, '');
				content_format = content.replace(/[\n\s*\r]/g, '');
				count = 140 - content.length;
			}

			//判断文字输入状态
			if(count < 0){
				count = -count;
				$tiptext.text('已经超过').next().addClass('error');
				$sendbutton.addClass('disabled').click(function(){ return false; });
				//$sendbutton.addClass('disabled').attr('disabled', 'disabled'); //不兼容IE
			}else{
				$tiptext.text('还可以输入').next().removeClass('error');
				$sendbutton.removeClass('disabled').unbind('click');
				//$sendbutton.toggleClass('disabled'); //会产生闪烁现象
				//count == 140 ? $sendbutton.addClass('disabled').click(function(){ return false; }) : $sendbutton.removeClass('disabled').unbind('click');
				if (count == 140 || content_format == '') $sendbutton.addClass('disabled').click(function(){ return false; });
			}
			return count;
		},

		//刷新显示“发送消息表单”表单中的字符统计
		refreshInputLength: function(e){
			$('.sendbox .nums').html(this.charCount($('#weibo_content').get(0)));
		},

		//“发送消息表单”中的消息输入框ID标识
		msgInputId: 'weibo_content',

		//发送一条微博消息
		sendMessage: function(e) {
			e.preventDefault();
			var form = $('#send_message_form').get(0);
			var url = form.action;
			var input = $(form.content);
			input.val(input.val().replace(/[\n]/g, ''));
			var formData = $(form).serialize();
			var _this = this;
			$.post(url, formData, function(data){
				if(data){
					var message = new Message(data);
					WEIBO.messages.add(message);
					_this.addToFirst(message);
					_this.hideUploadPicker();
					form.reset();
					$('.pic-field', form).remove();
					$('#pic_picker .pic-preview').html('');
					$('.sendbox .nums').html('140');
					$('.more-button').html('');
				}else{
					alert('发布失败！');
				}
			}, 'json');
		},

		//显示表情选择框
		showFacePicker: function(e) {
			e.preventDefault();
			var trigger = $('#send_message_form .wb-facepicker').get(0);
			var input = $('#send_message_form textarea').get(0);
			WEIBO.showFacePicker(trigger, input);
		},

		//添加一条微博消息到消息列表中
		appendOne: function(message) {
			var view = new MessageView({model: message});
			$("#messages").append(view.render().el);
		},

		//往消息列表的顶部插入一条消息
		addToFirst: function(message) {
			var view = new MessageView({model: message});
			$("#messages").prepend(view.render().el).find('li:first').hide().slideDown(400);
		},

		//消息列表中最后一条消息的ID
		lastMsgId: 0,

		//获取下一页的消息JSON数据
		fetchMore: function(e) {
			if(e){
				e.preventDefault();
			}
			var data = {page_id: this.lastMsgId, roomid: WEIBO.roomid};
			var url = '/huoshow/module/weibo/weibo_user_dynamic.php';
			if(config.channel === 'all'){
				url = '/huoshow/module/weibo/weibo_user_all_dynamic.php';
			}else if(config.channel === 'group'){
				url = '/huoshow/module/weibo/weibo_user_group_dynamic.php';
				data.id = config.groupId;
			}else if(config.channel === 'space' || config.channel === 'sys'){
				url = '/huoshow/module/home/home_weibo_all_system_dynamic.php';
			}
			var _this = this;
			$.ajax({
				url: url,
				dataType: 'json',
				cache: false,
				data: data,
				success: function(res){
					if(res){
						if (res.type == 0) $('.conMidAtt .contenter').html('该分组下用户没有微博动态！');

						if(res.type == 0 && WEIBO.uid == WEIBO.roomid){
							$('.more-button').html('<img src="/huoshow/img/weibo/nomes.jpg" width="472" height="80" />');
							return;
						}else if(res.type == 1){
							$('.more-button').html('');
						}else if(res.type == 2){
							$('.more-button').html('<a class="more-messages" href="#more-messages"><span>更多</span></a>');
						}
						var list = [];
						if(res.data){
							list = res.data;
						}
						for(var i=0, l=list.length; i<l; i++){
							var message = new Message(list[i]);
							WEIBO.messages.add(message);
							_this.appendOne(message);
						}

						//修正 IE6 最大宽高 bug，限制图片最大宽度和高度为 80px
						$('.attachment-preview').find('img').each(function() {
							if (ie6) {
								if (this.width > 80 && this.width >= this.height) {
									this.style.width = '80px';
								} else if (this.height > 80 && this.height >= this.width) {
									this.style.height = '80px';
								}
							}
						});

						if (WEIBO.messages.last()) _this.lastMsgId = WEIBO.messages.last().id;
					}
				}
			});
		},

		//选择的文件成功加入上传队列时被调用
		fileQueued: function (file) {
			HUI.printCallInfo();
			this.uploader.startUpload(file.id);
		},

		//选择文件发生异常时被调用
		fileQueueError: function (file, errorCode, message) {
			HUI.printCallInfo();
		},

		//开始上传文件时被调用
		uploadStart: function (file) {
			HUI.printCallInfo();
			$('#pic_picker').addClass('uploading');
		},

		//上传进度回调函数，这是处理进度的显示
		uploadProgress: function (file, bytesLoaded, bytesTotal) {
			$('#pic_picker .upload-progress').html(Math.round(bytesLoaded/bytesTotal*100)+'%');
		},

		//上传发生异常时被调用
		uploadError: function (file, errorCode, message) {
			HUI.printCallInfo();
			if(file){
				if(errorCode == SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED){
				}else if(errorCode == SWFUpload.UPLOAD_ERROR.FILE_CANCELLED){
				}
			}
		},

		//上传成功时被调用
		uploadSuccess: function (file, serverData) {
			HUI.printCallInfo();
			var fileId = file.id;
			// $('<div />').appendTo('body').html(serverData).css({
			//	 'position': 'fixed',
			//	 'top': '20%',
			//	 'margin': '0 20px',
			//	 'padding': '15px',
			//	 'border': '4px solid #D60921',
			//	 'background-color': 'rgba(255, 255, 255, 0.9)'
			// });
			var data = HUI.parseJSON(serverData);
			if(data.mid == '1'){
				this.addPicture(file.id, data.msg);
			}else{
				alert(data.msg);
			}
			$('#pic_picker').removeClass('uploading');
		},

		//文件选择对话框关闭时被调用
		fileDialogComplete: function (fileNum, selQueuedNum, queuedNum) {
			HUI.printCallInfo();
		},

		//整个微博应用的初始化放在这里处理
		run: function() {
			this.fetchMore();
			this.refreshInputLength();
			var _this = this;
			if(document.getElementById('span_upload_button')){
				this.uploader = new SWFUpload({
					debug: false,
					flash_url : "/huoshow/js/swfupload/swfupload.swf",
					upload_url: "/huoshow/module/weibo/weibo_upload.php",
					post_params: {"uid" : WEIBO.roomid},
					file_size_limit : "10MB",
					file_types : "*.jpg;*.gif;*.png",
					file_types_description : "图片文件",

					// Button settings
					button_action: SWFUpload.BUTTON_ACTION.SELECT_FILE,
					button_image_url: '',
					button_width: "75",
					button_height: "29",
					button_placeholder_id: "span_upload_button",
					button_text: '本地上传',
					button_text_left_padding: 12,
					button_text_top_padding: 3,

					file_queued_handler : function(){_this.fileQueued.apply(_this, arguments);},
					file_queue_error_handler : function(){_this.fileQueueError.apply(_this, arguments);},
					upload_start_handler : function(){_this.uploadStart.apply(_this, arguments);},
					upload_progress_handler : function(){_this.uploadProgress.apply(_this, arguments);},
					upload_error_handler : function(){_this.uploadError.apply(_this, arguments);},
					upload_success_handler : function(){_this.uploadSuccess.apply(_this, arguments);},
					file_dialog_complete_handler : function(){_this.fileDialogComplete.apply(_this, arguments);}
				});
			}
		}

	});

	//创建一个微博消息列表对象
	WEIBO.messages = new MessageList();

	$(function(){
		$(document.body).bind('click', function(e){
			WEIBO.hideFacePicker();
		});

		window.app = new AppView();
		app.run();
	});
})();

function hs_wb_over() {}
function hs_wb_click() {}

;(function($) {
	$(window).load(function() {
		//修正 IE6 最大宽高 bug，限制图片最大宽度和高度为 80px （在IE6中有时获取不到元素，
		//已转到生成列表时判断
		/*if(ie6) {
			$('.attachment-preview').find('img').each(function() {
				if (this.width > this.height) {
					this.style.width = (this.width < 80) ? 'auto' : '80px';
				} else {
				this.style.height = (this.height < 80) ? 'auto' : '80px';
				}
			});
		}*/
	});
})(jQuery);