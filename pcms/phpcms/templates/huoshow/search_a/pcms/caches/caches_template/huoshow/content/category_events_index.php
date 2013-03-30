<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><?php include template("content","events_header"); ?>
<!--Main Body-->
<div class="main_body">
	<div class="body_left">
		<div class="top_news">
			<div class="bk_w300">
				<div class="music_banner">
					<div class="common-roll-slide" id="huoshow_events_saishi_index_image">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=4eb2b4d6ddfe88fb96c14a8e914d70b2&action=position&posid=14&catid=%24catid&thumb=1&order=listorder+DESC&num=5\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'14','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'5',));}?>
						<div class="common-roll-slide-body">
							<div class="common-roll-slide-pages">
								<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
								<div class="common-roll-slide-page">
									<div>
										<a href="<?php echo $r['url'];?>" target="_blank">
										<img alt="<?php echo $r['title'];?>" src="<?php echo thumb($r[thumb],300,421);?>" /></a>
									</div>
									<div class="common-roll-slide-page-info">
										<div class="common-roll-slide-page-info-text">
											<h3>
												<a href="<?php echo $r['url'];?>" target="_blank"><?php echo $r['title'];?></a>
											</h3>
											<p>
												<a href="<?php echo $r['url'];?>" target="_blank"></a>
											</p>
										</div>
									</div>
								</div>
								<?php $n++;}unset($n); ?>
							</div>
							<div class="common-roll-slide-nav">
								<span class="common-roll-slide-nav-right">
									<a href="#"	class="common-roll-slide-prev">&nbsp;</a>
									<a href="#" class="common-roll-slide-next">&nbsp;</a>
								</span>
								<span class="common-roll-slide-nav-links">
									<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
									<a href="<?php echo $r['url'];?>"><?php echo $n;?></a>
									<?php $n++;}unset($n); ?>
								</span>
							</div>
						</div>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
					</div>
					<script>
						window.slide_huoshow_events_saishi_index_image = make_pagebox(
								'huoshow_events_saishi_index_image',
								{
									links_selector : '.common-roll-slide-nav-links a',
									pages_selector : '.common-roll-slide-page',
									prev_selector : '.common-roll-slide-prev',
									next_selector : '.common-roll-slide-next',
									current_class : 'common-roll-slide-curr',
									interval : 5,
									effect : 1
								});
					</script>
				</div>
				<div class="events_W300">
					<div class="events_title_300">
						<span class="game_right_title_bz"></span>
						<h2 class="Purple_Black">魅力之星专区</h2>
					</div>
					<div class="Happy_girl_list">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=8fb11fb5bd2c65d62f398adf84905c84&action=position&posid=21&catid=%24catid&thumb=1&order=listorder+DESC&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'21','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'1',));}?>
						<div class="Happy_girl_list_tw">
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<a target="_blank" href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>">
								<img alt="<?php echo $r['title'];?>" src="<?php echo thumb($r[thumb],120,85);?>" width="120" height="85" />
							</a>
							<div class="intro">
								<h4><a target="_blank" href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><?php echo str_cut($r[title], 34,'');?></a></h4>
								<p><?php echo str_cut($r[description],150,'');?></p>
							</div>
							<?php $n++;}unset($n); ?>
						</div>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<div class="clear"></div>
						<div class="Happy_girl_newslist">
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a9d734af3ac482d7d48be94ea198731b&action=position&posid=22&catid=%24catid&order=listorder+DESC&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'22','catid'=>$catid,'order'=>'listorder DESC','limit'=>'6',));}?>
							<ul>
								<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
								<li>
									<span class="Point"><a target="_blank" href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><?php echo str_cut($r[title], 54,'');?></a></span>
								</li>
								<?php $n++;}unset($n); ?>
							</ul>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>
					</div>
				</div>
				<div class="events_W300">
					<div class="events_title_300">
						<span class="game_right_title_bz"></span>
						<h2 class="Purple_Black">达人秀专区</h2>
					</div>
					<div class="Happy_girl_list">
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=6c23080ce64f827c0910772f370c0ec5&action=position&posid=24&catid=%24catid&thumb=1&order=listorder+DESC&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'24','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'1',));}?>
						<div class="Happy_girl_list_tw">
							<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
							<a target="_blank" href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>">
							<img alt="<?php echo $r['title'];?>" src="<?php echo thumb($r[thumb],120,85);?>" width="120" height="85" /></a>
							<p class="Happy_girl_list_wenzi">
								<a target="_blank" href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><?php echo str_cut($r[title], 34,'');?></a>
							</p>
							<p><?php echo str_cut($r[description],110,'');?></p>
							<?php $n++;}unset($n); ?>
						</div>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						<div class="clear"></div>
						<div class="Happy_girl_newslist">
							<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=5948fba5f0f27901114dbbe479c821b5&action=position&posid=25&catid=%24catid&order=listorder+DESC&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'25','catid'=>$catid,'order'=>'listorder DESC','limit'=>'6',));}?>
							<ul>
								<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
								<li><span class="Point"><a href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><?php echo str_cut($r[title], 58,'');?></a></span>
								</li>
								<?php $n++;}unset($n); ?>
							</ul>
							<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
						</div>
					</div>
				</div>
			</div>
			<div class="biankuang_w394">
				<div class="hot"></div>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=16ec139f9ea1de2833d1e775c4599520&action=position&posid=15&catid=%24catid&order=listorder+DESC&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'15','catid'=>$catid,'order'=>'listorder DESC','limit'=>'1',));}?>
				<h3 class="Purple">
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<a target="_blank" href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><?php echo str_cut($r[title], 64,'');?></a>
					<?php $n++;}unset($n); ?>
				</h3>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				<div class="clear"></div>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=3e61871d1913f1a7af4ed7d0b919b938&action=position&posid=16&catid=%24catid&order=listorder+DESC&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'16','catid'=>$catid,'order'=>'listorder DESC','limit'=>'2',));}?>
				<div class="s_top_news">
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<p>
						<strong class="text_gray">独家：</strong>
						<span>[<a target="_blank" href="<?php echo $r['url'];?>" title="<?php echo $r['title'];?>"><?php echo str_cut($r[title], 80,'');?> </a>]</span>
					</p>
					<?php $n++;}unset($n); ?>
				</div>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				<div class="newslist">
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7c1523adacb2ad01564f86e0cb1487db&action=position&posid=17&catid=%24catid&order=listorder+DESC&num=9\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'17','catid'=>$catid,'order'=>'listorder DESC','limit'=>'9',));}?>
					<ul class="liston">
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li>
							<span class="Purple_icon">
							<a title="<?php echo $r['title'];?>" target="_blank" href="<?php echo $r['url'];?>"><?php echo str_cut($r[title], 80,'');?></a>
							</span>
						</li>
						<?php $n++;}unset($n); ?>
					</ul>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
				<div class="nd_newslist">
					<div class="nd_newslist_bt">
						<span class="Purple_icon_01"></span><span class="Purple_wenzi">内地赛事</span><span
							class="xixian"></span>
					</div>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=726b0064d869c7e306ecb980e670c7c2&action=position&posid=18&catid=%24catid&order=listorder+DESC&num=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'18','catid'=>$catid,'order'=>'listorder DESC','limit'=>'7',));}?>
					<ul>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li>
							<span class="Purple_icon">
								<a title="<?php echo $r['title'];?>" target="_blank" href="<?php echo $r['url'];?>"><?php echo str_cut($r[title], 80,'');?></a>
							</span>
						</li>
						<?php $n++;}unset($n); ?>
					</ul>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
				<div class="nd_newslist">
					<div class="nd_newslist_bt">
						<span class="Purple_icon_01"></span><span class="Purple_wenzi">港台赛事</span><span
							class="xixian"></span>
					</div>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=c9630a2d0a4bae0d57813888033bacd6&action=position&posid=19&catid=%24catid&order=listorder+DESC&num=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'19','catid'=>$catid,'order'=>'listorder DESC','limit'=>'7',));}?>
					<ul>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li>
							<span class="Purple_icon">
								<a title="<?php echo $r['title'];?>" target="_blank" href="<?php echo $r['url'];?>"><?php echo str_cut($r[title], 80,'');?></a>
							</span>
						</li>
						<?php $n++;}unset($n); ?>
					</ul>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
				<div class="nd_newslist">
					<div class="nd_newslist_bt">
						<span class="Purple_icon_01"></span><span class="Purple_wenzi">海外赛事</span><span
							class="xixian"></span>
					</div>
					<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7af4f359f3afb75530d55837edd1bdff&action=position&posid=20&catid=%24catid&order=listorder+DESC&num=7\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'20','catid'=>$catid,'order'=>'listorder DESC','limit'=>'7',));}?>
					<ul>
						<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li>
							<span class="Purple_icon">
								<a title="<?php echo $r['title'];?>" target="_blank" href="<?php echo $r['url'];?>"><?php echo str_cut($r[title], 80,'');?></a>
							</span>
						</li>
						<?php $n++;}unset($n); ?>
					</ul>
					<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<!--Right-->
	<div class="body_right">
		<div class="clear"></div>

		<!--赛事专题开始-->
<div class="top10_news">
	<div class="events_title_250">
		<span class="game_right_title_bz"></span>
		<h2 class="Purple_Black">赛事专题</h2>
	</div>
	<div class="top10_news_list">
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=157eb2b89d41b636d2a698ddbb69eb35&action=position&posid=23&catid=%24catid&order=listorder+DESC&num=2\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'23','catid'=>$catid,'order'=>'listorder DESC','limit'=>'2',));}?>
		<ul class='ui_img_list'>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<li class='ui_img_list_item'>
				<a class='ui_img_list_item_img' href='<?php echo $r['url'];?>' title="<?php echo $r['title'];?>"><img src='<?php echo thumb($r[thumb],109,83);?>' width='109' height='83' alt='myalt' /></a>
				<a class='ui_img_list_item_text' href='<?php echo $r['url'];?>' title="<?php echo $r['title'];?>"><?php echo str_cut($r[title],28,'');?></a>
			</li>
			<?php $n++;}unset($n); ?>
		</ul>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=dcdc1664cb2a2292afcdf7ae7e735551&action=position&posid=30&catid=%24catid&order=listorder+DESC&num=6\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'30','catid'=>$catid,'order'=>'listorder DESC','limit'=>'6',));}?>
		<ul class='ui_list'>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<li class='ui_list_item'><a class='ui_list_item_link' href='<?php echo $r['url'];?>' title="<?php echo $r['title'];?>"><?php echo str_cut($r[title], 52,'');?></a></li>
			<?php $n++;}unset($n); ?>
		</ul>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	</div>
</div>
<!--赛事专题结束-->

		<div class="clear"></div>
		<div class="right_events_W250">
			<div class="events_title_250">
				<span class="canjia"><a target="_blank"
					href="http://space.huoshow.com/show.php"><img alt=""
						src="http://www.huoshow.com/img/templates/huoshow02/images/events/canjia.jpg"
						width="63" height="21" /></a></span> <span class="game_right_title_bz"></span>
				<h2 class="Purple_Black">火热进行中</h2>
			</div>
			<div class="Small_games_pic_01">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d8426e66bfcd8dfc535cdff5438c52a1&action=position&posid=31&catid=%24catid&thumb=1&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'31','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'4',));}?>
				<ul>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li>
						<a title="<?php echo $r['title'];?>" target="_blank" href="<?php echo $r['url'];?>">
							<img alt="<?php echo $r['title'];?>" src="<?php echo thumb($r[thumb],101,106);?>" width="101" height="106" />
							<?php echo str_cut($r[title], 26,'');?>
						</a>
					</li>
					<?php $n++;}unset($n); ?>
				</ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
		</div>
		<div class="clear"></div>
		<div id="showrc">
			<div class="showrqi">
				<p class="showtext2">
					<?php echo date(m);?><br>月
				</p>
				<p class="showtext1"><?php echo date(d);?></p>
			</div>
			<div id="showrqinr">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=a268c567f3f44962a3ee68dd52d886e5&action=position&posid=80&catid=%24catid&order=listorder+DESC&num=15\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'80','catid'=>$catid,'order'=>'listorder DESC','limit'=>'15',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<div class="showrqinrkuang">
					<!--<div class="showrqinrtext1"><?php echo date('Y-m-d 星期N',$r[inputtime]);?>&nbsp;</div>-->
					<?php if(($n+1)%2==0) { ?><div class="showrqinrtext1"><a target="_blank" href="<?php echo $r['url'];?>"><?php echo str_cut($r[title], 44,'');?></a></div><?php } else { ?>
					<div class="showrqinrtext1">
						<a target="_blank" href="<?php echo $r['url'];?>"><strong><?php echo str_cut($r[title], 44,'');?></strong></a>
					</div><?php } ?>
				</div>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="index_banner_W960_02">
		<script type="text/javascript">
				// <![CDATA[
				OA_show(44);
				// ]]>
			</script>
			<noscript>
				<a target='_blank' href='http://misc.huoshow.com/www/delivery/ck.php?n=a0255ec9'><img border='0' alt='' src='http://misc.huoshow.com/www/delivery/avw.php?zoneid=44&n=a0255ec9' /></a>
			</noscript>
	</div>
	<div class="clear"></div>

	<!--赛事推荐开始-->
<div class="events_W960" id="tiny_game_tabview1">
	<div class="events_title_960">
		<span class="game_right_title_bz"></span>
		<span class="Purple_Black_dong">
			<a class="Purple_Black_hover" href="javascript:;" title="推荐赛事">推荐赛事</a>
			<a href="javascript:;" title="内地赛事">内地赛事</a>
			<a href="javascript:;" title="港台赛事">港台赛事</a>
			<a href="javascript:;" title="海外赛事">海外赛事</a>
		</span>
	</div>
	<div id="box_tuijian" class="events_zt_list_pic_01 ">
		<div id="box_1">
			<div class="events_zt_list_left"></div>
			<div class="events_zt_list_right"></div>
			<div class="scrollbox-items-wrap scrollbox-items-current">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=8c5d923e9084abb86adfe3f23ea0e753&action=position&posid=32&catid=%24catid&thumb=1&order=listorder+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'32','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'10',));}?>
				<div class="scrollbox-items-wrap-body">
					<ul>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li>
							<a class='scrollbox-items-img' href="<?php echo $r['url'];?>"	target="_blank">
							<img width="120" height="160" src="<?php echo thumb($r[thumb],120,160);?>" alt="<?php echo $r['title'];?>"></a>
							<a class='scrollbox-items-title' href="<?php echo $r['url'];?>" target="_blank"><?php echo str_cut($r[title], 36,'');?></a>
						</li>
					<?php $n++;}unset($n); ?>
					</ul>
				</div>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>

			<div class="scrollbox-items-wrap">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=95dbd4a13c4462c8fcbc9f877a4caf89&action=position&posid=33&catid=%24catid&thumb=1&order=listorder+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'33','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'10',));}?>
				<div class="scrollbox-items-wrap-body">
					<ul>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li>
							<a class='scrollbox-items-img' href="<?php echo $r['url'];?>"	target="_blank">
							<img width="120" height="160" src="<?php echo thumb($r[thumb],120,160);?>" alt="<?php echo $r['title'];?>"></a>
							<a class='scrollbox-items-title' href="<?php echo $r['url'];?>" target="_blank"><?php echo str_cut($r[title], 36,'');?></a>
						</li>
					<?php $n++;}unset($n); ?>
					</ul>
				</div>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>

			<div class="scrollbox-items-wrap">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=912c52a6132f65e8df4204893ca08c35&action=position&posid=34&catid=%24catid&thumb=1&order=listorder+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'34','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'10',));}?>
				<div class="scrollbox-items-wrap-body">
					<ul>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li>
							<a class='scrollbox-items-img' href="<?php echo $r['url'];?>"	target="_blank">
							<img width="120" height="160" src="<?php echo thumb($r[thumb],120,160);?>" alt="<?php echo $r['title'];?>"></a>
							<a class='scrollbox-items-title' href="<?php echo $r['url'];?>" target="_blank"><?php echo str_cut($r[title], 36,'');?></a>
						</li>
					<?php $n++;}unset($n); ?>
					</ul>
				</div>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>

			<div class="scrollbox-items-wrap">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=c1285f2b2b4fa0d257533f9b61e223f8&action=position&posid=35&catid=%24catid&thumb=1&order=listorder+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'35','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'10',));}?>
				<div class="scrollbox-items-wrap-body">
					<ul>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
						<li>
							<a class='scrollbox-items-img' href="<?php echo $r['url'];?>"	target="_blank">
							<img width="120" height="160" src="<?php echo thumb($r[thumb],120,160);?>" alt="<?php echo $r['title'];?>"></a>
							<a class='scrollbox-items-title' href="<?php echo $r['url'];?>" target="_blank"><?php echo str_cut($r[title], 36,'');?></a>
						</li>
					<?php $n++;}unset($n); ?>
					</ul>
				</div>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
		</div>
	</div>
</div>
<!--赛事推荐结束-->
<div class="clear"></div>

	<!--Top Video-->
	<div class="top_video">
		<div class="top_video_inner_bd">
			<div class="cross_title_bg">
				<h2 class="title_blue_big">精彩<!-- 视频 --></h2>
				<span class="more"><a href="/events/jingcaishipin/" class="more_bg">更多</a></span>
			</div>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=676d857de7f156f6cf2c4c0c55e0304a&action=position&posid=26&catid=%24catid&thumb=1&order=listorder+DESC&num=8\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'26','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'8',));}?>
			<ul class="top_video_list">
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li>
					<span class="top_video_pic_bg" style="background:none;">
						<a title="<?php echo $r['title'];?>" 	target="_blank" href="<?php echo $r['url'];?>">
							<img alt="<?php echo $r['title'];?>" src="<?php echo thumb($r[thumb],134,83);?>" width="134" height="83" />
						</a>
					</span>
					<span class="top_video_text">
						<a title="<?php echo $r['title'];?>" target="_blank" href="<?php echo $r['url'];?>"><?php echo str_cut($r[title], 36,'');?></a>
					</span>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>
	</div>
	<div class="events_W250_02">
		<div class="events_title_250_02">
			<span class="game_right_title_bz"></span>
			<h2 class="title_blue_big">精彩回顾</h2>
		</div>
		<div class="Small_games_pic_01">
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=cecf01b48df35818d6848bd767a75d88&action=position&posid=27&catid=%24catid&thumb=1&order=listorder+DESC&num=4\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'27','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'4',));}?>
			<ul>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li><a title="<?php echo $r['title'];?>" target="_blank" href="<?php echo $r['url'];?>">
					<img alt="<?php echo $r['title'];?>" src="<?php echo thumb($r[thumb],101,106);?>" width="101" height="106" /><?php echo str_cut($r[title], 26,'');?></a>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>
	</div>
	<div class="events_W250_03">
		<div class="events_title_250_03">
			<span class="game_right_title_bz"></span>
			<h2 class="title_blue_big">赛事论坛</h2>
		</div>
		<div class="Happy_girl_list">
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b2184695db1c738b9316943297ad6b66&action=get_events_bbs&img=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'get_events_bbs')) {$data = $content_tag->get_events_bbs(array('img'=>'1','limit'=>'20',));}?>
			<div class="Happy_girl_list_tw">
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<a title="<?php echo $r['subject'];?>" target="_blank" href="<?php echo $r['url'];?>">
				<img alt="<?php echo $r['subject'];?>" src="<?php echo thumb($r[img],120,85);?>" width="120" height="85" /></a>
				<p class="Happy_girl_list_wenzi"><?php echo str_cut($r['subject'],70,'');?></p>
				<?php $n++;}unset($n); ?>
			</div>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			<div class="clear"></div>
			<div class="Happy_girl_newslist">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=5494743066535fdce111e24b1912a48c&action=get_events_bbs&img=0\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'get_events_bbs')) {$data = $content_tag->get_events_bbs(array('img'=>'0','limit'=>'20',));}?>
				<ul>
					<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
					<li><span class="Point">
						<a title="<?php echo $r['subject'];?>" target="_blank" href="<?php echo $r['url'];?>"><?php echo str_cut($r['subject'],58,'');?></a></span>
					</li>
					<?php $n++;}unset($n); ?>
				</ul>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</div>
		</div>
	</div>
	<div class="events_W250_04">
		<div class="events_title_250_04">
			<span class="game_right_title_bz"></span>
			<h2 class="title_blue_big">赛事群组</h2>
		</div>
		<div class="events_quenzu">
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=96bd184a5cb3cea01c1acc0dfee2d478&action=get_events_group\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'get_events_group')) {$data = $content_tag->get_events_group(array('limit'=>'20',));}?>
			<ul>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li>
					<span class="events_quenzu_pic">
					<img src="<?php echo thumb($r[img],48,48);?>"
						onerror="this.onerror=null;this.src='http://space.huoshow.com/static/image/common/groupicon.gif'"
						width="48" height="48" />
					</span>
					<span class="events_quenzu_wz">
						<span class="events_quenzu_wz_c">
						<a href="<?php echo $r['url'];?>" target="_blank"><?php echo $r['name'];?></a>
						</span><br>
						<?php echo str_cut($r[description],50);?>
					</span>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>
	</div>
	<div class="events_banner_250">
		<script type="text/javascript">
				// <![CDATA[
				OA_show(45);
				// ]]>
			</script>
			<noscript>
				<a target='_blank' href='http://misc.huoshow.com/www/delivery/ck.php?n=a6268908'><img border='0' alt='' src='http://misc.huoshow.com/www/delivery/avw.php?zoneid=45&n=a6268908' /></a>
			</noscript>
	</div>
	<div class="clear"></div>
	<div class="events_tuj">
		<div class="pic_list">
			<ul>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7e3bddfbb33799815b1bfcaafc402fa1&action=position&posid=28&catid=%24catid&thumb=1&order=listorder+DESC&num=1\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'28','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'1',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li class="first"><a title="<?php echo $r['title'];?>" href="<?php echo $r['url'];?>" target="_blank">
					<img alt="<?php echo $r['title'];?>" src="<?php echo thumb($r[thumb],232,354);?>" width="232" height="354" /></a>
					<span class="pic_text_bg_first"><a title="<?php echo $r['title'];?>" href="<?php echo $r['url'];?>" target="_blank"><?php echo str_cut($r[title], 44,'');?></a>
					</span>
				</li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=7728a433d62896ab803e6aea975ac818&action=position&posid=29&catid=%24catid&thumb=1&order=listorder+DESC&num=10\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'position')) {$data = $content_tag->position(array('posid'=>'29','catid'=>$catid,'thumb'=>'1','order'=>'listorder DESC','limit'=>'10',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li>
					<a title="<?php echo $r['title'];?>" href="<?php echo $r['url'];?>" target="_blank"><img alt="<?php echo $r['title'];?>" alt="<?php echo $r['title'];?>" src="<?php echo thumb($r[thumb],119,160);?>" width="119" height="160" /></a>
		 			<span class="pic_txt_bg_red">
					<a title="<?php echo $r['title'];?>" href="<?php echo $r['url'];?>"><?php echo str_cut($r[title], 28,'');?></a></span>
				</li>
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
			</ul>
		</div>
	</div>
</div>
</div>

<!--Partners-->
<div class="main_body">
<div class="partners">
<div class="layer_one"><a>友情链接</a></div>
<div class="layer_content">
<p class="layer_content_txt"><a href="#">中影集团</a> | <a href="#">保利博纳</a> | <a href="#">华谊兄弟</a> | <a href="#">光线传媒</a> | <a href="#">激动娱乐</a> | <a href="#">橙天娱乐</a> | <a href="#">海润影视</a> | <a href="#">安乐传媒</a> | <a href="#">夏影业</a> | <a href="#">中北影视</a> | <a href="#">天娱传媒</a> | <a href="#">中圣春秋</a> | <a href="#">小马奔腾</a> <a href="#">金牌大风</a> | <a href="#">环球音乐</a> | <a href="#">Sony音乐</a> | <a href="#">华纳唱片</a> | <a href="#">华研音乐</a> | <a href="#">星光国际</a> | <a href="#">英皇星艺</a> | <a href="#">种子音乐</a> | <a href="#">海蝶音乐</a> | <a href="#">大国文化</a> | <a href="#">太合麦田</a> | <a href="#">福茂唱片</a> <a href="#">滚石唱片</a> <a href="#">麦特文化</a> | <a href="#">欢乐传媒</a> | <a href="#">星光UP传媒</a></p>
</div>
</div>
</div>
<div class="clear"></div>
<!--Main Body End-->
<?php include template("content","footer"); ?>
