<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("community","myshow_header"); ?>

<div id='navbar' class="fn-clear">
	<ul class="nav">
		<li class='first'><a class="the-pins" hidefocus='true' title="热门采集" href="/index.php?m=community&c=index&a=json_share_list&list=2">热门<em></em></a><a class="the-albums" hidefocus='true' title="热门专辑" href="/index.php?m=community&c=index&a=json_album_list&list=2"><em></em></a></li>
		<li class="selected"><a class="the-pins nowat" hidefocus='true' title="最近采集" href="/index.php?m=community&c=index&a=json_share_list&list=1">最近<em></em></a><a class="the-albums" hidefocus='true' title="最近专辑" href="/index.php?m=community&c=index&a=json_album_list&list=1"><em></em></a></li>
		<li><a class="shopping" hidefocus='true' title="购物通道" href="/index.php?m=community&c=index&a=json_share_list&list=3">购物通道</a><span class='new'></span></li>
	</ul>
</div>

<div id="content">
	<div id='canvas' data-url='/index.php?m=community&c=index&a=json_share_list'>
		<!-- if !page.boards && page.filter.indexOf(':category') -->
		<div class='pin category ks-waterfall ks-waterfall-fixed-left'>
			<div class="cats cats-hot">
				<h3 class='cats-header'>热门分类</h3>
				<ul class='cats-list fn-clear'>
					<li><a class="selected all" title="全部" href="/" style="background-color: #D6383B; color: #FFFFFF;">全部</a></li>
					<?php $n=1;if(is_array($p_data_On)) foreach($p_data_On AS $r) { ?>
					<li><a target='_blank' title="<?php echo $r['name'];?>" href="/fl-<?php echo $r['classid'];?>.html"><?php echo $r['name'];?></a></li>
					<?php $n++;}unset($n); ?>
				</ul>
			</div>
			<div class='cats'>
				<ul class='cats-list fn-clear'>
					<!--li><a class="shopping" title="" href="/all/all/">购物</a></li-->
					<?php $n=1;if(is_array($p_data_In)) foreach($p_data_In AS $r) { ?>
					<li><a target='_blank' title="<?php echo $r['name'];?>" href="/fl-<?php echo $r['classid'];?>.html"><?php echo $r['name'];?></a></li>
					<?php $n++;}unset($n); ?>
				</ul>
			</div>
			<div class="cats cats-last">
				<ul class='cats-list fn-clear'>
					<?php $n=1;if(is_array($p_data_Un)) foreach($p_data_Un AS $r) { ?>
					<li><a target='_blank' title="<?php echo $r['name'];?>" href="/fl-<?php echo $r['classid'];?>.html"><?php echo $r['name'];?></a></li>
					<?php $n++;}unset($n); ?>
				</ul>
			</div>
		</div>

		<!----w><div class='pin ks-waterfall' data-id=''>
			<div class='ui-album'>
				<a class='img' href='#'>
					<img src='/statics/images/myshow/test6.jpg' alt='' width='60' height='60' />
					<img src='/statics/images/myshow/test6.jpg' alt='' width='60' height='60' />
					<img src='/statics/images/myshow/test6.jpg' alt='' width='60' height='60' />
					<img src='/statics/images/myshow/test6.jpg' alt='' width='60' height='60' />
					<img src='/statics/images/myshow/test6.jpg' alt='' width='60' height='60' />
					<img src='/statics/images/myshow/test6.jpg' alt='' width='60' height='60' />
					<img src='/statics/images/myshow/test6.jpg' alt='' width='60' height='60' />
					<img src='/statics/images/myshow/test6.jpg' alt='' width='60' height='60' />
					<img src='/statics/images/myshow/test6.jpg' alt='' width='60' height='60' />
				</a>
				<div  class='intro'>
					<h3><a href='#'>小姑娘小小年纪就学会</a></h3>
					<p class='fn-hide'>我Hold不住了：剩下的都特么过儿童节了</p>
				</div>
				<div class='pinner'>
					<a class='avatar' href='#'><img src='/statics/images/myshow/user1.jpg' alt='' width='28' height='28' /></a>
					<a class='name' href='#'>爱美丽0</a>
					<p class='stats'>创建于：2012/12/11 18:21</p>
				</div>
				<div class='action fn-hide'>
					<a class='follow' href='#'>关注</a>
					<a class='share' href='#'>分享</a>
				</div>
			</div>
		</div>
		<div class='pin ks-waterfall' data-id=''>
			<div class='ui-album'>
				<a class='img' href='#'>
					<img src='/statics/images/myshow/test6.jpg' alt='' width='60' height='60' />
					<img src='/statics/images/myshow/test6.jpg' alt='' width='60' height='60' />
					<img src='/statics/images/myshow/test6.jpg' alt='' width='60' height='60' />
					<img src='/statics/images/myshow/test6.jpg' alt='' width='60' height='60' />
					<img src='/statics/images/myshow/test6.jpg' alt='' width='60' height='60' />
					<img src='/statics/images/myshow/test6.jpg' alt='' width='60' height='60' />
					<img src='/statics/images/myshow/test6.jpg' alt='' width='60' height='60' />
					<img src='/statics/images/myshow/test6.jpg' alt='' width='60' height='60' />
					<img src='/statics/images/myshow/test6.jpg' alt='' width='60' height='60' />
				</a>
				<div  class='intro'>
					<h3><a href='#'>小姑娘小小年纪就学会</a></h3>
					<p class='fn-hide'>我Hold不住了：剩下的都特么过儿童节了</p>
				</div>
				<div class='pinner'>
					<a class='avatar' href='#'><img src='/statics/images/myshow/user1.jpg' alt='' width='28' height='28' /></a>
					<a class='name' href='#'>爱美丽0</a>
					<p class='stats'>创建于：2012/12/11 18:21</p>
				</div>
				<div class='action fn-hide'>
					<a class='follow' href='#'>关注</a>
					<a class='share' href='#'>分享</a>
				</div>
			</div>
		</div>

		<div class='pin ks-waterfall' data-id=''>
			<a class='image' href='#'><img src='/statics/images/myshow/test1.jpg' alt='' width='208' height='295' /><span class='meta price'>￥18</span></a>
			<div class='tag'><a href='#'>#日食</a> <a href='#'>#美少女</a> <a href='#'>#明星</a> <a href='#'>#真相</a></div>
			<div class='user fn-clear'>
				<a class='user-photo' href='#'><img src='/statics/images/myshow/user1.jpg' alt='' width='28' height='28' /></a>
				<a class='user-name' href='#'>爱美丽</a>
				<p class='user-msg'>发布于专辑<a href='#'>《图片墙中》</a></p>
				<div class='user-info'>
					<div class='user-details'>
						<a class='user-photo' href='#'><img src='/statics/images/myshow/user1.jpg' alt='' width='60' height='60' /></a>
						<a class='user-name' href='#'>爱美丽</a>
						<span class='user-msg'>分享 <em>3215</em> 粉丝 <em>325</em> 喜欢 <strong>555</strong></span>
						<p class='user-signature'>签名：等待就是浪费青春！</p>
					</div>
					<div class='follow-bar fn-clear'>
						<a class='send-msg btn' href='#'>发私信</a>
						<a class='follow-user btn' href='#'>关注Ta</a>
					</div>
				</div>
			</div>
			<p class='description'>小时候，总想睡在靠近窗台边，每天一睡醒来就能看到很美的景色...</p>
			<div class='actions notlogged'>
				<div class='actions-wrapper'>
					<a class='like' href='#'><span>喜欢</span><strong>22</strong></a>
					<a class='repin' href='#'><span>转藏</span><strong>222</strong></a>
					<a class='comment' href='javascript:void(0)'><span>评论</span><strong>122</strong></a>
				</div>
			</div>
			<form class='comment-form fn-hide' name='comment' method='post' action=''>
				<textarea></textarea>
				<button type="submit" name="comment-submit"></button>
			</form>
		</div>

		<div class='pin ks-waterfall' data-id=''>
			<a class='image' href='#'><img src='/statics/images/myshow/test2.jpg' alt='' width='208' height='300' /><span class='meta price'>￥18</span></a>
			<div class='tag tag_shopping'><a href='#'>#日食</a> <a href='#'>#美少女</a> <a href='#'>#明星</a> <a href='#'>#真相</a></div>
			<div class='user fn-clear'>
				<a class='user-photo' href='#'><img src='/statics/images/myshow/user1.jpg' alt='' width='28' height='28' /></a>
				<a class='user-name' href='#'>爱美丽1</a>
				<p class='user-msg'>发布于专辑<a href='#'>《图片墙中》</a></p>
				<div class='user-info'>
					<div class='user-details'>
						<a class='user-photo' href='#'><img src='/statics/images/myshow/user1.jpg' alt='' width='60' height='60' /></a>
						<a class='user-name' href='#'>爱美丽</a>
						<span class='user-msg'>分享 <em>3215</em> 粉丝 <em>325</em> 喜欢 <strong>555</strong></span>
						<p class='user-signature'>签名：等待就是浪费青春！</p>
					</div>
					<div class='follow-bar fn-clear'>
						<a class='send-msg btn' href='#'>发私信</a>
						<a class='follow-user btn' href='#'>关注Ta</a>
					</div>
				</div>
			</div>
			<p class='description'>小时候，总想睡在靠近窗台边，每天一睡醒来就能看到很美的景色...</p>
			<div class='actions'>
				<div class='actions-wrapper'>
					<a class='like' href='#'><span>喜欢</span><strong>22</strong></a>
					<a class='repin' href='#'><span>转藏</span><strong>222</strong></a>
					<a class='comment' href='javascript:void(0)'><span>评论</span><strong>122</strong></a>
				</div>
			</div>
			<form class='comment-form fn-hide' name='comment' method='post' action=''>
				<textarea></textarea>
				<button type="submit" name="comment-submit"></button>
			</form>
		</div>

		<div class='pin ks-waterfall' data-id=''>
			<a class='image' href='#'><img src='/statics/images/myshow/test3.jpg' alt='' width='208' height='278' /><span class='meta music'></span></a>
			<div class='tag'><a href='#'>#日食</a> <a href='#'>#美少女</a> <a href='#'>#明星</a> <a href='#'>#真相</a></div>
			<div class='user fn-clear'>
				<a class='user-photo' href='#'><img src='/statics/images/myshow/user1.jpg' alt='' width='28' height='28' /></a>
				<a class='user-name' href='#'>爱美丽2</a>
				<p class='user-msg'>发布于专辑<a href='#'>《图片墙中》</a></p>
				<div class='user-info'>
					<div class='user-details'>
						<a class='user-photo' href='#'><img src='/statics/images/myshow/user1.jpg' alt='' width='60' height='60' /></a>
						<a class='user-name' href='#'>爱美丽</a>
						<span class='user-msg'>分享 <em>3215</em> 粉丝 <em>325</em> 喜欢 <strong>555</strong></span>
						<p class='user-signature'>签名：等待就是浪费青春！</p>
					</div>
					<div class='follow-bar fn-clear'>
						<a class='send-msg btn' href='#'>发私信</a>
						<a class='follow-user btn' href='#'>关注Ta</a>
					</div>
				</div>
			</div>
			<p class='description'>小时候，总想睡在靠近窗台边，每天一睡醒来就能看到很美的景色...</p>
			<div class='actions'>
				<div class='actions-wrapper'>
					<a class='like' href='#'><span>喜欢</span><strong>22</strong></a>
					<a class='repin' href='#'><span>转藏</span><strong>222</strong></a>
					<a class='comment' href='javascript:void(0)'><span>评论</span><strong>122</strong></a>
				</div>
			</div>
			<form class='comment-form fn-hide' name='comment' method='post' action=''>
				<textarea></textarea>
				<button type="submit" name="comment-submit"></button>
			</form>
		</div>

		<div class='pin ks-waterfall' data-id=''>
			<a class='image' href='#'><img src='/statics/images/myshow/test4.jpg' alt='' width='208' height='400' /><span class='meta video'></span></a>
			<div class='tag'><a href='#'>#日食</a> <a href='#'>#美少女</a> <a href='#'>#明星</a> <a href='#'>#真相</a></div>
			<div class='user fn-clear'>
				<a class='user-photo' href='#'><img src='/statics/images/myshow/user1.jpg' alt='' width='28' height='28' /></a>
				<a class='user-name' href='#'>爱美丽3</a>
				<p class='user-msg'>发布于专辑<a href='#'>《图片墙中》</a></p>
				<div class='user-info'>
					<div class='user-details'>
						<a class='user-photo' href='#'><img src='/statics/images/myshow/user1.jpg' alt='' width='60' height='60' /></a>
						<a class='user-name' href='#'>爱美丽</a>
						<span class='user-msg'>分享 <em>3215</em> 粉丝 <em>325</em> 喜欢 <strong>555</strong></span>
						<p class='user-signature'>签名：等待就是浪费青春！</p>
					</div>
					<div class='follow-bar fn-clear'>
						<a class='send-msg btn' href='#'>发私信</a>
						<a class='follow-user btn' href='#'>关注Ta</a>
					</div>
				</div>
			</div>
			<p class='description'>小时候，总想睡在靠近窗台边，每天一睡醒来就能看到很美的景色...</p>
			<div class='actions'>
				<div class='actions-wrapper'>
					<a class='like' href='#'><span>喜欢</span><strong>22</strong></a>
					<a class='repin' href='#'><span>转藏</span><strong>222</strong></a>
					<a class='comment' href='javascript:void(0)'><span>评论</span><strong>122</strong></a>
				</div>
			</div>
			<form class='comment-form fn-hide' name='comment' method='post' action=''>
				<textarea></textarea>
				<button type="submit" name="comment-submit"></button>
			</form>
		</div>

		<div class='pin ks-waterfall' data-id=''>
			<a class='image' href='#'><img src='/statics/images/myshow/test8.jpg' alt='' width='208' height='5233' /><span class='meta video'></span><span class='image-overlay'></span></a>
			<div class='tag'><a href='#'>#日食</a> <a href='#'>#美少女</a> <a href='#'>#明星</a> <a href='#'>#真相</a></div>
			<div class='user fn-clear'>
				<a class='user-photo' href='#'><img src='/statics/images/myshow/user1.jpg' alt='' width='28' height='28' /></a>
				<a class='user-name' href='#'>爱美丽8</a>
				<p class='user-msg'>发布于专辑<a href='#'>《图片墙中》</a></p>
				<div class='user-info'>
					<div class='user-details'>
						<a class='user-photo' href='#'><img src='/statics/images/myshow/user1.jpg' alt='' width='60' height='60' /></a>
						<a class='user-name' href='#'>爱美丽</a>
						<span class='user-msg'>分享 <em>3215</em> 粉丝 <em>325</em> 喜欢 <strong>555</strong></span>
						<p class='user-signature'>签名：等待就是浪费青春！</p>
					</div>
					<div class='follow-bar fn-clear'>
						<a class='send-msg btn' href='#'>发私信</a>
						<a class='follow-user btn' href='#'>关注Ta</a>
					</div>
				</div>
			</div>
			<p class='description'>小时候，总想睡在靠近窗台边，每天一睡醒来就能看到很美的景色...</p>
			<div class='actions'>
				<div class='actions-wrapper'>
					<a class='like' href='#'><span>喜欢</span><strong>22</strong></a>
					<a class='repin' href='#'><span>转藏</span><strong>222</strong></a>
					<a class='comment' href='javascript:void(0)'><span>评论</span><strong>122</strong></a>
				</div>
			</div>
			<form class='comment-form fn-hide' name='comment' method='post' action=''>
				<textarea></textarea>
				<button type="submit" name="comment-submit"></button>
			</form>
		</div><!w---->
	</div>
	<div id="loading-pins"><img src="/statics/images/myshow/loading_pins.gif" alt="正在加载..." /> <span>正在加载 &hellip;</span></div>
	<div id="loading-end"><img src="/statics/images/myshow/loading-end.png" /></div>
</div>

<?php include template("community","tpl"); ?>
</body>
</html>