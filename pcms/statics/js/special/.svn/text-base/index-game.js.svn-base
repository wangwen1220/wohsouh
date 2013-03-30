(function($) {
	$(function() {
		/*====================通用变量=====================*/
		var $body = $('body'),
			$login_bar = $('#login-bar'),
			$search = $('#search'),
			$nav = $('#nav');

		/*====================通用动作=====================*/
		// 操蛋的 logo
		$('#header .logo').append('<span />');
		// 登录后加载用户菜单
		$.getJSON($login_bar.attr('data-url'), function(d) {
			$login_bar.html(d.html);
		});

		// 文本框获得或失去焦点
		$(":input").focus(function() {
			$(this).addClass("focus");
			if ($(this).val() == this.defaultValue) {
				$(this).val("");
			}
		}).blur(function() {
			$(this).removeClass("focus");
			if ($(this).val() == '') {
				$(this).val(this.defaultValue);
			}
		});

		// 查找关键词不能为空
		$search.add('#game-search').submit(function() {
			var $search_wd = $(this).find('.search-wd'),
				wd = $search_wd.val();
			if ($.trim(wd) == '' || wd == $search_wd[0].defaultValue) {
				alert('请输入你要查找的关键词！');
				return false;
			}
		});

		// 设置图片列表项的宽度
		$('.ui-img-list-item').each(function() {
			var $ths = $(this),
				imgwraper_border_width = $ths.find('.img').outerWidth() - $ths.find('.img').innerWidth(),
				img_width = $ths.find('img').outerWidth();
			// 设置宽度为图片宽度加上边框的宽度
			$ths.width(img_width + imgwraper_border_width);
		});

		/*====================专题首页=====================*/
		// 导航菜单鼠标移上去效果
		var $nav_list_item_current = $nav.find('.nav-list-item-current');
		$nav.on({
			mouseenter: function() {
				$nav_list_item_current.removeClass('nav-list-item-current');
			},
			mouseleave: function() {
				$nav_list_item_current.addClass('nav-list-item-current');
			}
		}, '.nav-list-item');

		// 焦点图
		var $my_focus = $('#my-focus'),
			$desc_item = $my_focus.next().find('.desc-item');
		myFocus.set({
			id: 'my-focus',//焦点图盒子ID
			pattern: 'mF_classicHC',//风格应用的名称
			width: 320,//设置图片区域宽度(像素)
			height: 240,//设置图片区域高度(像素)
			wrap: false,
			//auto: false,
			txtHeight: 0,//文字层高度设置(像素),'default'为默认高度，0为隐藏
			onChange: function(i) {
				$desc_item.removeClass('desc-item-current');
				$desc_item.eq(i).fadeIn('slow').siblings().hide();
			}
		}, function() {
			//$my_focus.parent().css('float', 'left');
		});

		/*====================列表页=====================*/
		// 新资讯中加载并执行 jquery.kandytabs.js
		var $kandyTabs = $("#kandyTabs");
		if ($kandyTabs.length) {
			$.getScript("/statics/js/jquery.kandytabs.js", function() {
				$kandyTabs.KandyTabs();
			});
		}

		// 新资讯中热点排行展开与折叠效果
		$('.ui_fold_box_redian, .ui_fold_box_reyi').find('li').hover(function() {
			if(!$(this).hasClass('ui_fold_box_content_selected')) {
				$(this).addClass('ui_fold_box_content_selected').siblings().removeClass('ui_fold_box_content_selected');
				return false;
			}
		});

		/*====================浏览器兼容性解决方案=====================*/
		if (isIE6) { // if($.browser.msie && $.browser.version == '6.0'){
			// 解决 IE6 hover Bug
			//$('#add, .ui-album .intro').hover(function() { $(this).toggleClass('hover'); });
		}
	});

	/*====================页面加载完执行=====================*/
	$(window).load(function() {
		// ie6 png 图片透明
		// 将单引号中的内容修改为你使用了png图片的样式，与 CSS 文件中一样即可
		// 如果要直接插入 png 图片，在单引号内加入 img 即可
		if (isIE6) {
			$.getScript("/statics/js/DD_belatedPNG.js", function() {
				DD_belatedPNG.fix('.ui-img-list-item .img .icon, .ui_tab_box_title, .ui_list_box_title span, .ui_fold_box_title span');
			});
		}
	});
})(jQuery);