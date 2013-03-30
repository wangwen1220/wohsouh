////////////////////////////////////////////////////////////////////////////////
//	名称: 火秀影视主程序
//	作者: 王文 wangwen1220@139.com
//	说明: 需 jQuery 1.8.3 及以上版本支持
//	日期: 2013-1-23
////////////////////////////////////////////////////////////////////////////////
// 配置
seajs.config({
	//base: '/statics/js/seajs/',
	alias: {
		'jquery': 'jquery',
		//'jqcookie': 'jquery-cookie-debug',
		'cookie': 'cookie',
		'jqetab': 'jquery-etab',
		'jcarousel': 'jquery-jcarousel',
		//'switchable': 'jquery-switchable',
		'myfocus': '../seajs-myfocus'
	},

	// 预加载
	preload: ['jquery'],

	// 值为 true 时，加载器会使用 console.log 输出所有错误和调试信息
	// 值设为 2 时， 每个脚本请求都会加上唯一时间戳，以强制浏览器每次都请求最新版本
	// 默认为 false, 只输出关键信息
	debug: true,

	// 批量更新时间戳
	map: [
		[/^(.*\.(?:css|js))(.*)$/i, '$1?t=20130118']
	]
});

// 主程序模块
define('hs-video', ['jquery', 'myfocus', 'jqetab', 'jcarousel', 'cookie'], function(require) {
	'use strict';
	/*====================加载依赖模块=====================*/
	var $ = jQuery = require('jquery'),
		myFocus = require('myfocus'),
		Cookie = require('cookie');
	require('jqetab')($);
	require('jcarousel')($);

	/*====================常用工具=====================*/
	$.extend({
		// 浏览器版本判断
		isIE: !!window.ActiveXObject,
		isIE6: !window.XMLHttpRequest,

		// 常用变量
		head: document.head || document.getElementsByTagName('head')[0] || document.documentElement,

		// 提示信息
		log: function(msg) {
			window.console && console.log(msg);
		},

		id: function(id) {
			if (!id) return null; //修改 IE 下 $.id('dose_not_exist_id') 报错的 bug
			if ('string' == typeof id || id instanceof String) {
				return document.getElementById(id);
			} else if (id.nodeName && (id.nodeType == 1 || id.nodeType == 9)) {
				return id;
			}
			return null;
		},

		// 加载样式
		loadCSS: function(path) {
			var link = document.createElement('link');
			link.href = path;
			link.rel = 'stylesheet';
			if (!$('link[href*="' + path + '"]').length) {
				$.head.appendChild(link);
			}
		},

		// 加载脚本
		loadtJS: function(path) {
			var script = document.createElement('script');
			script.src = path;
			if (!$('script[src*="' + path + '"]').length) {
				$.head.appendChild(script);
			}
		},

		// 动态批量加载 js、css 文件。使用方法：
		// $.includePath = '/statics/js/jquery.tree/';
		// $.include(['jquery.tree.js', 'jquery.tree.css']);
		includePath: '',
		include: function(file) {
			var files = typeof file == 'string' ? [file] : file;
			for (var i = 0; i < files.length; i++) {
				var name = files[i].replace(/^\s|\s$/g, ''),
					//att = name.split('.'),
					//ext = att[att.length - 1].toLowerCase(),
					isCSS = name.substring(name.lastIndexOf('.') + 1).toLowerCase() === 'css',
					//tagname = isCSS ? 'link' : 'script',
					//tag = isCSS ? document.createElement('link') : document.createElement('script'),
					tag;
				if (isCSS) {
					tag = document.createElement('link');
					tag.href = $.includePath + name;
					tag.rel = 'stylesheet';
				} else {
					tag = document.createElement('script');
					tag.src = $.includePath + name;
				}
				if (!$(tag.tagName + '[' + (isCSS ? 'href' : 'src') + '*="' + name + '"]').length) {
					$.head.appendChild(tag);
				}
			}
		}
	});

	$.fn.extend({
		jtShare: function(options){// 分享到（使用 JiaThis API）
			if(typeof options == 'string'){// 如果传的参数是字符串
				options = {webid: options};
			}
			options = $.extend({
				webid: this.attr('data-i') || 'tsina',
				title: this.attr('data-t') || document.title,
				summary: this.attr('data-s') || $('meta[name="description"]').attr('content'),
				pic: this.attr('data-p') || '',
				url: this.attr('data-u') || window.location.href
			}, options);
			var domain = window.location.protocol + '//' + window.location.hostname,
				webid = options.webid,
				title = options.title,
				summary = options.summary,
				url = options.url,
				pic = options.pic,
				jturl;
			title = '#' + title + '#';
			summary = summary.replace(/\s+/g, " ");
			if(summary.length > 88){
				summary = summary.substr(0, 88) + '...';
			}
			summary += '（分享自 @火秀社区） >> ';
			if(url.indexOf('http') != 0){url = domain + url;} // 转为绝对路径
			switch(webid){
				case 'tsina': // 新浪微博
					jturl = 'http://www.jiathis.com/send/?webid=tsina&url=' + encodeURIComponent(url) + '&title=' + encodeURIComponent(title) + '&summary=' + encodeURIComponent(summary);
					if(pic){
						if(pic.indexOf('http') != 0){pic = pic.indexOf('/') != 0 ? domain + '/' + pic : domain + pic;} // 转为绝对路径
						jturl += '&pic=' + encodeURIComponent(pic);
					}
					window.open(jturl);
					break;
				case 'tqq': // 腾讯微博
					jturl = 'http://www.jiathis.com/send/?webid=tqq&url=' + encodeURIComponent(url) + '&title=' + encodeURIComponent(title) + '&summary=' + encodeURIComponent(summary);
					if(pic){
						if(pic.indexOf('http') != 0){pic = pic.indexOf('/') != 0 ? domain + '/' + pic : domain + pic;} // 转为绝对路径
						jturl += '&pic=' + encodeURIComponent(pic);
					}
					window.open(jturl);
					break;
				case 'renren': // 人人网
					jturl = 'http://www.jiathis.com/send/?webid=renren&url=' + encodeURIComponent(url) + '&title=' + encodeURIComponent(title) + '&summary=' + encodeURIComponent(summary);
					if(pic){
						if(pic.indexOf('http') != 0){pic = pic.indexOf('/') != 0 ? domain + '/' + pic : domain + pic;}
						jturl += '&pic=' + encodeURIComponent(pic);
					}
					window.open(jturl);
					break;
				case 'qzone': // QQ空间
					jturl = 'http://www.jiathis.com/send/?webid=qzone&url=' + encodeURIComponent(url) + '&title=' + encodeURIComponent(title) + '&summary=' + encodeURIComponent(summary);
					if(pic){
						if(pic.indexOf('http') != 0){pic = pic.indexOf('/') != 0 ? domain + '/' + pic : domain + pic;}
						jturl += '&pic=' + encodeURIComponent(pic);
					}
					window.open(jturl);
					break;
				case 'kaixin': // 开心网
					jturl = 'http://www.jiathis.com/send/?webid=kaixin001&url=' + encodeURIComponent(url) + '&title=' + encodeURIComponent(title) + '&summary=' + encodeURIComponent(summary);
					if(pic){
						if(pic.indexOf('http') != 0){pic = pic.indexOf('/') != 0 ? domain + '/' + pic : domain + pic;}
						jturl += '&pic=' + encodeURIComponent(pic);
					}
					window.open(jturl);
					break;
				case 'douban': // 豆瓣
					jturl = 'http://www.jiathis.com/send/?webid=douban&url=' + encodeURIComponent(url) + '&title=' + encodeURIComponent(title) + '&summary=' + encodeURIComponent(summary);
					if(pic){
						if(pic.indexOf('http') != 0){pic = pic.indexOf('/') != 0 ? domain + '/' + pic : domain + pic;}
						jturl += '&pic=' + encodeURIComponent(pic);
					}
					window.open(jturl);
					break;
			}
		}
	});

	/*====================通用变量=====================*/
	var CSS_PATH = '/statics/css/',
		JS_PATH = '/statics/js/',
		$body = $('body'),
		$login_bar = $('#login-bar'),
		$search = $('#search'),
		$content = $('#content'),
		$nav = $('#nav');

	/*====================通用动作=====================*/
	// 登录后加载用户菜单
	$.getJSON($login_bar.attr('data-url'), function(d) {
		$login_bar.html(d.html.replace('<script>(function($){$(function(){make_hoverbox("user_setting");});})(jQuery);</script>', '')); // 操蛋
		//$login_bar.html(d.html);
	});

	// 文本框获得或失去焦点
	$('.search-wd').focus(function() {
		$(this).addClass('focus');
		if (this.value === this.defaultValue) {
			this.value = '';
		}
	}).blur(function() {
		$(this).removeClass('focus');
		if (this.value === '') {
			this.value = this.defaultValue;
		}
	});

	// 查找关键词不能为空
	$('form.search').submit(function() {
		var $search_wd = $(this).find('.search-wd'),
			wd = $search_wd.val();
		if ($.trim(wd) == '' || wd == $search_wd[0].defaultValue) {
			alert('请输入你要查找的关键词！');
			return false;
		}
	});

	// Tab 切换动画
	$('.ui-tab').etab();
	$('.ui-tab-related, .ui-tab-mv, .ui-tab-video').etab({
		event: 'click'
	});
	$('.ui-tab-tv').etab({
		event: 'click',
		fadeIn: true,
		callback: function() {/* TODO */
			/*$('.ui-gallery-details .ui-tab-nav-item').on('click', function() {
				var $ths = $(this);
				if ($ths.hasClass('ui-tab-nav-item-cur')) {
					$ths.removeClass('ui-tab-nav-item-cur').parents('.ui-tab-tv').find('.ui-tab-cnt').hide();
				} else {
					$ths.parents('.ui-tab-tv').find('.ui-tab-cnt').show();
				}
			});*/
		}
	});

	// 排行榜动画
	$('.ui-ranking-item').on('mouseover', function(){
		$(this).addClass('ui-ranking-item-cur').siblings().removeClass('ui-ranking-item-cur');
	});
	$('.ui-ranklist-item').on('mouseover', function(){
		$(this).addClass('ui-ranklist-item-cur').siblings().removeClass('ui-ranklist-item-cur');
	});

	// 影视筛选
	//$('#select').on('click', '.filter-list-item .more', function() {/* TODO */
		//$(this).prev().toggleClass('multi-line');
	//});

	// 设置图片列表项的宽度－为了那操蛋的 IE6；为了不想在样式用设置宽度
	$('.ui-gallery-list-item, .ui-pic-list-item').each(function() {
		var $ths = $(this),
			imgwraper_border_width = $ths.find('.img').outerWidth() - $ths.find('.img').innerWidth(),
			img_width = $ths.find('img').outerWidth();
		// 设置宽度为图片宽度加上边框的宽度
		$ths.width(img_width + imgwraper_border_width);
	});

	/*====================焦点图设置=====================*/
	// 焦点图 myfocus-video
	if ($('#myfocus-video').length) {
		if ($body.hasClass('mvhome')) {
			var test = myFocus.set({
				id: 'myfocus-video',
				pattern: 'hs-video', // 风格应用的名称
				width: 680, // 设置图片区域宽度(像素)
				height: 300, // 设置图片区域高度(像素)
				wrap: false,
				auto: true,
				txtHeight: 0,
				thumbShowNum: 6 // 略缩图显示数目
			}, function() {
				var $myfocus = $('#myfocus-video');
				$myfocus.find('.thumb a').each(function() {
					var $ths = $(this),
						i = $ths.index(),
						url = $myfocus.find('.pic a').eq(i).attr('href'),
						title = $myfocus.find('.pic img').eq(i).attr('alt');
					// 给缩略图添加标题和链接
					$ths.attr('href', url).append('<span>' + title + '</span>');
				});
			});

		} else {
			myFocus.set({
				id: 'myfocus-video',
				pattern: 'hs-video', // 风格应用的名称
				width: 732, // 设置图片区域宽度(像素)
				height: 350, // 设置图片区域高度(像素)
				wrap: false,
				auto: true,
				txtHeight: 42
			});
		}
	}

	/*====================电视首页=====================*/
	var $myslider = $('#myslider-video');
	if ($myslider.length) {
		$myslider.find('.triggers-item:first').addClass('triggers-item-cur');
		$.getScript(JS_PATH + 'jquery.switchable-2.0.min.js', function() {
			// 通用单行焦点图
			var myslider_api = $myslider.find('.sliders').switchable({
				triggers: $myslider.find('.triggers-item'),
				//triggerType: 'click',
				panels: '.sliders-item',
				effect: 'fade',
				easing: 'ease-in-out',
				autoplay: true,
				loop: false,
				onSwitch: function(event, currentIndex) {
					this.triggers.removeClass('triggers-item-cur').eq(currentIndex).addClass('triggers-item-cur');
				}
			});

			// 鼠标移到触点上时停止自动动画
			$myslider.hover(function() {
				myslider_api.pause();
			}, function() {
				myslider_api.play();
			});
		});
	}

	/*====================电影首页=====================*/
	// 滚动图片
	$('.jcarousel-skin-movie').jcarousel({
		scroll: 5,
		//auto: 3,
		animation: 800
		//wrap: 'both'
	});

	/*====================热门综艺=====================*/
	// 图片滚动动画
	//if ($body.hasClass('jcarousel')) {
		// 不能在这里引入，不然下面的语句获取不到样式里设置的宽度
		//$.loadCSS(CSS_PATH + 'jcarousel-skins/video/skin.css');
	//}
	$('.jcarousel-skin-video').jcarousel({
		scroll: 4,
		auto: 3,
		wrap: 'both',
		animation: 800,
		itemLoadCallback: {onBeforeAnimation: jcarousel_video_itemLoadCallback},
		initCallback: jcarousel_video_initCallback,
		buttonNextHTML: null,
		buttonPrevHTML: null
	});

	// 综艺资讯排版
	var $ui_list_news = $('.ui-box .ui-list-news');
	$ui_list_news.filter(':odd').addClass('ui-list-news-odd');
	$ui_list_news.filter(':gt(' + ($ui_list_news.length - 3) + ')').addClass('ui-list-news-lastline');

	/*====================影视详细页=====================*/
	// Jiathis 分享到
	$content.on('click', '.v-show .jt-ico', function(){
		var $ths = $(this),
			pic = $ths.parents('.v-poster').find('img')[0].src;
		$ths.jtShare({pic: pic});
	});

	// 记录上次播放位置
	var $tvlist = $('.ui-tvlist');
	$tvlist.on('click', '.ui-tvlist-item', function() {
		var $ths = $(this),
			i = $ths.index(),
			$parent = $ths.parent(),
			$siblings_tvlist = $parent.siblings('.ui-tvlist').andSelf(),
			tvid = $parent.attr('data-tvid');
		$siblings_tvlist.each(function() {
			$(this).find('.ui-tvlist-item').removeClass('ui-tvlist-item-cur')
				.eq(i).addClass('ui-tvlist-item-cur');
		});
		$siblings_tvlist.find('.tips').remove();
		//Cookie.set('tvid' + tvid, tvid, {expires: 15});
		Cookie.set('playno' + tvid, i, {expires: 15});
	}).on('click', '.tips a', function(e) {
		$(e.delegateTarget).siblings('.ui-tvlist').andSelf().find('.tips').remove();
	});

	// 设置上次播放位置
	//var playno = Cookie.get('playno'),
		//playtv = Cookie.get('playtv');
	$tvlist.each(function() {
		var $ths = $(this),
			tvid = $ths.attr('data-tvid'),
			playno = Cookie.get('playno' + tvid);
		if (!playno) return;
		$ths.find('.ui-tvlist-item').removeClass('ui-tvlist-item-cur')
			.eq(playno).addClass('ui-tvlist-item-cur').append('<span class="tips">您上次观看至此<a href="javascript:;"></a></span>');
	});

	// 收起/展开简介
	$content.on('click', '.v-info-item-intro .intro a', function(){
		$(this).parent().hide().siblings('.intro').show();
	});

	/*====================影视新闻详细页=====================*/
	// 投票
	$('#main').find('.article-status .face').click(function(e, stat) {
		var $ths = $(this),
			$progress = $ths.prev(),
			$num = $progress.prev(),
			progress_height = +$num.text(),
			url = $ths.attr('data-url');
		//if (progress_height < 100 && !stat){
		if (!stat){
			$num.text(++progress_height);
			//$.post('url' + progress_height);// 状态写入数据库
			$progress.height(progress_height).css('display', 'inline-block');
		} else if (progress_height > 0) {
			$progress.height(progress_height).css('display', 'inline-block');
		}
		return false;
	}).trigger('click', [true]);// 页面初始化时触发一次，且数字不加 1

	// 我要评论
	$('#main.article').on('click', 'a.comment', function() {
		var $comment = $('#comment textarea'), oftop = $comment.offset().top;
		$comment.trigger('focus');
		$('html, body').stop().animate({scrollTop: oftop - 75});
		return false;
	});

	// 返回顶部
	if ($body.hasClass('js-scroll-top')) {
		var $back_to_top = $('<div class="back-to-top" title="返回顶部"></div>').appendTo("body");
		backToTop($back_to_top);
		$(window).scroll(function() {
			backToTop($back_to_top);
		});
		$back_to_top.click(function() {
			$('html, body').stop().animate({scrollTop: 0}, 400);
		});
	}

	/*====================函数定义=====================*/
	// jcarousel initCallback
	function jcarousel_video_initCallback(carousel) {
		var container = carousel.container;
		container.find('.jcarousel-control a').on('click mouseover', function() {
			$(this).addClass('cur').siblings().removeClass('cur');
			// 移到下一组的第一个元素
			carousel.scroll($(this).index() * 4 + 1);
		}).eq(0).addClass('cur');

		container.find('.jcarousel-item, .jcarousel-control a').hover(function() {
			carousel.pauseAuto();
		}, function() {
			carousel.startAuto();
		});
	}

	// jcarousel itemLoadCallback
	function jcarousel_video_itemLoadCallback(carousel) {
		carousel.container.find('.jcarousel-control a').removeClass('cur').eq(carousel.first / 4).addClass('cur');
	}

	// 返回顶部
	function backToTop($elem) {
		var st = $(document).scrollTop(), winh = $(window).height();
		st > 200 ? $elem.show() : $elem.hide();
		// IE6 下的定位
		if ($.isIE6) $elem.css('top', st + winh - 166);
	}

	/*====================浏览器兼容性解决方案=====================*/
	if ($.isIE6) {
		// 常用方法
		$.fn.extend({// 要放在全局变量下面，因为有用到其中的变量
			// 最大宽度
			maxWidth: function(value){
				if(!value){
					return this.css('max-width');
				}else{
					return this.each(function(){
						this.style.width = (this.clientWidth > value - 1) ? value + 'px' : 'auto';
					});
				}
			},
			// 最小宽度
			minWidth: function(value){
				if(!value){
					return this.css('min-width');
				}else{
					return this.each(function(){
						this.style.width = (this.clientWidth < value) ? value + "px" : "auto";
					});
				}
			},
			// 最大高度
			maxHeight: function(value){
				if(!value){
					return this.css('max-height');
				}else{
					return this.each(function(){
						this.style.height = (this.scrollHeight > value - 1) ? value + "px" : "auto";
					});
				}
			}
		});

		// 解决 IE6 hover Bug
		$('.ui-game-list-item').hover(function() { $(this).toggleClass('ui-game-list-item-hover'); });
		$('.ui-content-item').hover(function() { $(this).toggleClass('ui-content-item-hover'); });
		$('.ui-img-list-item').hover(function() { $(this).toggleClass('ui-img-list-item-hover'); });

		// 新闻详细页图片最大宽度
		$('#main.article .content p img').maxWidth(600);

		// 页面加载完执行
		//$(window).load(function() {// 操蛋 load 现在IE中不执行
		// ie6 png 图片透明
		// 将单引号中的内容修改为你使用了png图片的样式，与 CSS 文件中一样即可
		// 如果要直接插入 png 图片，在单引号内加入 img 即可
		$.getScript(JS_PATH + 'DD_belatedPNG.js', function() {
			//DD_belatedPNG.fix('.ui-img-list-item .img .icon-play, .hs-video .txt li a');
		});

		// 让IE6 缓存背景图片
		/* TredoSoft Multiple IE doesn't like this, so try{} it */
		try {
			document.execCommand("BackgroundImageCache", false, true);
		} catch (e) {}
		//});
	}
});