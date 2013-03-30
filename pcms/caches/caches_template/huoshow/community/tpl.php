<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><script type="tpl" id="tpl">
	<div class="pin ks-waterfall" data-id="{{id}}">
		<a href="{{pin_url}}" class="image" target='_blank'><img src="{{image_url}}" alt="{{description}}" width="{{image_width}}" height="{{image_height}}" />{{image_meta}}</a>
		<div class='tag{{#if isgoods}} goods{{%if}}'>
		{{#each tags as tag}}
			<a href='/tag-{{tag.id}}.html' target='_blank'>#{{tag.name}}</a>
		{{%each}}
		</div>
		<div class='user fn-clear' data-uid="{{owner_id}}">
			<a class='user-photo' href='{{owner_url}}' target='_blank'><img src="{{owner_avatar}}" width="28" height="28" /></a>
			<a class="user-name" href="{{owner_url}}" target='_blank'>{{owner_name}}</a>
			<p class="user-msg">发布于专辑 <a href="{{album_url}}" target='_blank'>《{{album_name}}》</a></p>
		</div>
		<p class="description">{{description}}</p>
		<div class="actions">
			<div class="actions-wrapper">
				{{#if admin}}<button class='del-pin'>删除</button>{{%if}}
				<a class="like" href="javascript:;"><span>{{#if like}}取消喜欢{{#else}}喜欢{{%if}}</span><strong>{{like_num}}</strong></a>
				<a class="repin" href="javascript:;"><span>转藏</span><strong>{{repin_num}}</strong></a>
				<a class="comment" href="javascript:void(0)" title='点击打开评论'><span>评论</span><strong>{{comment_num}}</strong></a>
			</div>
		</div>
		<form class="comment-form fn-hide" name="comment-form" method="post" action="{{comment_action}}">
			<textarea name='comment-content'></textarea>
			<button type="submit" name="comment-submit"></button>
		</form>
		<div class="action fn-hide">
			{{#if action_top_text}}<a href="{{action_top_url}}" class="btn btn-top"><span>{{action_top_text}}</span></a>{{%if}}
			{{#if action_shield_text}}<a href="{{action_shield_url}}" class="btn btn-shield"><span>{{action_shield_text}}</span></a>{{%if}}
		</div>
	</div>
</script>
<script type="tpl" id="albumtpl">
	<div class='pin album ks-waterfall' data-id='{{id}}'>
		<div class='ui-album'>
			{{#if image_url && image_url.constructor == Array}}
			<a class='img' href='{{album_url}}' target='_blank'>{{#each image_url as url}}<img src='{{url}}' width='60' height='60' />{{%each}}</a>
			{{#else}}
			<a class='img img-single' href='{{album_url}}' target='_blank'><img src='{{image_url}}' width='165' height='165' /></a>
			{{%if}}
			<div class='intro'>
				<h3><a href='#'>{{album_name}}</a></h3>
				<p class='fn-hide'>{{description}}</p>
			</div>
			<div class='pinner'>
				<a class='avatar' href='{{owner_url}}' target='_blank'><img src='{{owner_avatar}}' width='28' height='28' /></a>
				<a class='name' href='{{owner_url}}' target='_blank'>{{owner_name}}</a>
				<p class='stats'>创建于：{{input_time}}</p>
			</div>
			<div class='action fn-hide'>
				{{#if edit}}
				<a class='edit edit-album' href='{{edit_url}}'>编辑</a>
				{{#else}}
				<a class='follow follow-album{{#if follow}} followed{{%if}}' href='{{follow_url}}'>{{#if follow}}取消关注{{#else}}关注{{%if}}</a>
				{{%if}}
				<a class='share jt-share' href='javascript:;'>分享</a>
			</div>
			<div class="jt-box">
				<h3 class='jt-box-title'>分享到</h3>
				<ul class="jt-box-list">
					<li><a class="jt-ico jt-ico-tsina" data-i='tsina' href='javascript:;'>新浪微博</a></li>
					<li><a class="jt-ico jt-ico-tqq" data-i='tqq' href='javascript:;'>腾讯微博</a></li>
					<li><a class="jt-ico jt-ico-qzone" data-i='qzone' href='javascript:;'>QQ空间</a></li>
					<li><a class="jt-ico jt-ico-renren" data-i='renren' href='javascript:;'>人人网</a></li>
					<li><a class="jt-ico jt-ico-kaixin" data-i='kaixin' href='javascript:;'>开心网</a></li>
				</ul>
				<div class="jt-box-footer"></div>
			</div>
		</div>
	</div>
</script>
<script type="tpl" id="pinnertpl">
	<div class='pin pinner ks-waterfall' data-id='{{id}}'>
		<div class="pinner-info">
			<a class="avatar" href="{{url}}"><img src="{{avatar}}" alt='{{name}}' width='208' height='208' /></a>
			<h3 class="name"><a href="{{url}}">{{name}}</a></h3>
			<div class='action-btns fn-clear' data-uid='{{id}}'>
				{{#if owner}}
				<span class="follow-user disabled btn">关注Ta</span>
				<span class='send-msg disabled btn'>发私信</span>
				{{#else}}
				<a class="follow-user btn{{#if follow}} followed{{%if}}" href='javascript:;' data-uid='{{id}}'>{{#if follow}}取消关注{{#else}}关注Ta{{%if}}</a>
				<a class='send-msg btn' href='{{letter_url}}'>发私信</a>
				{{%if}}
			</div>
		</div>
	</div>
</script>
<script src="<?php echo JS_PATH;?>kissy/kissy-min.js"></script>
<script src="<?php echo JS_PATH;?>kissy/waterfall-min.js"></script>
<script src="<?php echo JS_PATH;?>myshow_kissy.js" title='为了兼容IE6必须放底部'></script>