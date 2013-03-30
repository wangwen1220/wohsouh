<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><div class="main_body">
<?php if((empty($img_attachment_mode) || $img_attachment_mode==1)) { ?>
	<!-- 图片详细页相册 -->
	<div class="Photo_Detailspage">
		<div class="Photo_Detailspage_top">
			<h1 class="Photo_Detailspage_top_bt"><?php echo $title;?></h1>
		</div>
		<div class="Photo_Detailspage_top_list"><span class="Photo_Detailspage_top_shijian"><?php echo $inputtime;?> <span>来源：<?php echo $copyfrom;?> </span> </span> <span class="Photo_Detailspage_top_tu03"><a href="http://www.huoshow.com/upload/2011/1216/1324011220623.jpg" target="_blank"></a></span> <a href="<?php echo $pictureurls[$current_imgno]['url'];?>" target="_blank">查看原图</a> | <span class="Photo_Detailspage_top_tu04"> <a></a></span> <a href="#reply">
			<?php $commentid_tmp = id_encode("content_$catid",$id,$siteid);?>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"comment\" data=\"op=comment&tag_md5=9795e75815a7a3dc206ad0de9320d0a0&action=get_comment&commentid=%24commentid_tmp\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$comment_tag = pc_base::load_app_class("comment_tag", "comment");if (method_exists($comment_tag, 'get_comment')) {$data = $comment_tag->get_comment(array('commentid'=>$commentid_tmp,'limit'=>'20',));}?>
				<?php $comment = $data;?>
				评论[<span class="comments"><?php if($comment[total]) { ?><?php echo $comment['total'];?><?php } else { ?>0<?php } ?></span>]</a>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>
		<p class='photo_summary'><strong>摘要：</strong><?php echo $description;?></p>
		<div class="Photo_Detailspage_c">
			<table>
				<tr>
					<td><?php if($pre_img!=-1) { ?><span class="Photo_Detailspage_left"> <a href="<?php echo $pageurls[$pre_img]['0'];?>"></a> </span> <?php } ?></td>
					<td width="100%"><div class="photo-view"> <img src="<?php echo thumb($pictureurls[$current_imgno][url],0,600);?>"/>
					</div></td>
					<td><?php if($next_img!=-1) { ?><span class="Photo_Detailspage_right"> <a href="<?php echo $pageurls[$next_img]['0'];?>"></a> <?php } ?></span> </td>
				</tr>
			</table>
		</div>
		<div class="Photo_Detailspage_bottom fn_clear"><span class="Photo_Detailspage_bottom_shuzi"><?php echo $page;?>/<span class="sanshi"><?php echo $pagenumber;?></span></span>
			<div class="photo_Detailspage_bottom_text">
				<p class="curr-summary">
				<?php if($id>300000) { ?>
				<?php echo $pictureurls[$current_imgno]['alt'];?>
				<?php } else { ?>
				<?php echo $pictureurls[$current_imgno]['note'];?>
				<?php } ?>
				</p>
			</div>
		</div>
		<div class="pic fn_clear">
			<div class="pic_left">
				<div class="pic_left_list">
					<div class="pic_left_list_pic">
						<table>
							<tr>
								<td class="imgre"><a href="<?php echo $previous_page['url'];?>"><img src="<?php echo thumb($previous_page[thumb],100,74);?>" width="100" height="74" /></a></td>
							</tr>
						</table>
					</div>
					<span class="pic_left_list_pic_text"><a href="<?php echo $previous_page['url'];?>" title="<?php echo $previous_page['title'];?>"><?php echo str_cut($previous_page[title],24,'');?></a></span><br />
					<span class="pic_left_list_pic_text_01"><a href="<?php echo $previous_page['url'];?>">< 上一图集</a></span>
				</div>
			</div>
			<div class="pic_right">
				<div class="pic_left_list">
					<!--#include virtual="/api.php?op=movie&p=get_next_album&catid=<?php echo $catid;?>&id=<?php echo $id;?>"-->
				</div>
			</div>
			<div class="pic_zhongjian" id="pbox111">
				<div class="pic_zhongjian_left"><a class="pic_zhongjian_left1" href="#">&nbsp;</a></div>
				<div class="pic_zhongjian_right"><a href="#" class="pic_zhongjian_right1">&nbsp;</a></div>
				<div class="pic_zhongjian_c">
					<div class="pic_zhongjian_c_1">
					<?php $n=1;if(is_array($pictureurls)) foreach($pictureurls AS $r) { ?>
						<?php if(($n-1)%4==0) { ?>
						<ul class="pic_zhongjian_tu">
						<?php } ?>
							<li style="">
								<table>
									<tr>
										<td class="imgre<?php if($n==$page) { ?> current_img<?php } ?>"><a href="<?php echo $pageurls[$n]['0'];?>"><img src="<?php echo thumb($r[url],110,72);?>" width="110" height="72"/></a></td>
									</tr>
								</table>
								<div class="pic_left_list_pic_block"><span class="hot_movie_text"><?php echo $n;?>/<?php echo $pagenumber;?></span></div>
							</li>
						 <?php if($n%4==0) { ?>
						</ul>
						<?php } ?>
						<?php $n++;}unset($n); ?>
					</div>
				</div>
			</div>
			<script>
				make_pagebox('pbox111', {
					pages_selector: '.pic_zhongjian_tu',
					prev_selector: '.pic_zhongjian_left1',
					next_selector: '.pic_zhongjian_right1',
					effect: 1
				}).to(Math.floor((<?php echo $page;?>-1)/4));
			</script>
		</div>
	</div>
	<div class='show_pic_xt show_pic_box'>
		<h2 class='show_pic_box_title'>相关图集</h2>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=b62ec8207b377fd86a1f25bd0f65fa16&action=relation_pic&relation=%24relation&id=%24id&catid=%24catid&num=8&keywords=%24rs%5Bkeywords%5D\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'relation_pic')) {$data = $content_tag->relation_pic(array('relation'=>$relation,'id'=>$id,'catid'=>$catid,'keywords'=>$rs[keywords],'limit'=>'8',));}?>
		<ul class='show_pic_box_img_list'>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<li>
				<a href='<?php echo $r['url'];?>'><img src='<?php echo thumb($r[thumb],105,140);?>' width='105' height='140' />
				<h4><a href='<?php echo $r['url'];?>'><?php echo str_cut($r[title],30,'');?></a></h4>
			</li>
			<?php $n++;}unset($n); ?>
		</ul>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
	</div>
	<div class='banner' style='margin-top: 8px'>
		<script type="text/javascript">
			// <![CDATA[
			OA_show(67);
			// ]]>
		</script>
		<noscript>
			<a target='_blank' href='http://misc.huoshow.com/www/delivery/ck.php?n=a4f20c5e'><img alt='' src='http://misc.huoshow.com/www/delivery/avw.php?zoneid=67&n=a4f20c5e' /></a>
		</noscript>
	</div>
	<div class='show_pic_box_wrapper fn_clear'>
		<div class='show_pic_cx show_pic_box fn_left'>
			<h2 class='show_pic_box_title'>猜你喜欢</h2>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=d27266e0d47052daf8669763b50c74e7&action=relation_pic&relation=%24relation&id=%24id&catid=%24CATEGORYS%5B%24arrparentid%5B1%5D%5D%5Bcatid%5D&num=10&keywords=%24rs%5Bkeywords%5D\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'relation_pic')) {$data = $content_tag->relation_pic(array('relation'=>$relation,'id'=>$id,'catid'=>$CATEGORYS[$arrparentid[1]][catid],'keywords'=>$rs[keywords],'limit'=>'10',));}?>
			<ul class='show_pic_box_img_list'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<li>
					<a href='<?php echo $r['url'];?>'><img src='<?php echo thumb($r[thumb],120,160);?>' width='120' height='160' />
					<h4><a href='<?php echo $r['url'];?>'><?php echo str_cut($r[title],30,'');?></a></h4>
				</li>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>
		<div class='show_pic_rp show_pic_box fn_right'>
			<h2 class='show_pic_box_title'>热图排行</h2>
			<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=462535957ae5c3548f9c0511923c86c1&action=hits&catid=%24catid&num=12&order=views+DESC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'hits')) {$data = $content_tag->hits(array('catid'=>$catid,'order'=>'views DESC','limit'=>'12',));}?>
			<div class='show_pic_box_artical fn_clear'>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<a href='<?php echo $r['url'];?>'><img src='<?php echo thumb($r[thumb],90,85);?>' width='90' height='85' /></a>
				<h3><a href='<?php echo $r['url'];?>'><?php echo str_cut($r[title],50,'');?></a></h3>
				<p><?php echo str_cut($r[description],100,'');?></p>
				<?php if($n==1)break;?>
				<?php $n++;}unset($n); ?>
			</div>
			<ul>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<?php if($n>1) { ?>
				<li><a href='<?php echo $r['url'];?>'><?php echo str_cut($r[title],60,'');?></a></li>
				<?php } ?>
				<?php $n++;}unset($n); ?>
			</ul>
			<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>
	</div>

	<!-- 评论 -->
	<div id='to_comment' class="comment">
		<?php if($allow_comment && module_exists('comment')) { ?>
		<iframe src="<?php echo APP_PATH;?>index.php?m=comment&c=index&a=init&commentid=<?php echo id_encode("content_$catid",$id,$siteid);?>&iframe=1" width="100%" height="100%" id="comment_iframe" frameborder="0" scrolling="no"></iframe>
		<?php } ?>
	</div>
	<!-- 评论结束 -->
<?php } else { ?>
	<div class="Subpage_left">
		<div class="Subpage_left_xx_01">
			<div class="Subpage_left_xx">
				<div class="Subpage_left_bt">
					<h1 class="bt_cu"><?php echo $title;?></h1>
					<div class="titbar"> <span class="pubTime"><?php echo $inputtime;?></span> <span class="where">来源：<?php echo $copyfrom;?></span>
						<!-- <span class="views">查看数: <span id="pvnums">0</span></span> -->
						<span class="comment"><a href="#to_comment">我来说两句</a>
						<?php $commentid_tmp = id_encode("content_$catid",$id,$siteid);?>
						<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"comment\" data=\"op=comment&tag_md5=9795e75815a7a3dc206ad0de9320d0a0&action=get_comment&commentid=%24commentid_tmp\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$comment_tag = pc_base::load_app_class("comment_tag", "comment");if (method_exists($comment_tag, 'get_comment')) {$data = $comment_tag->get_comment(array('commentid'=>$commentid_tmp,'limit'=>'20',));}?>
						<?php $comment = $data;?>
						(<span class="commentnums"><?php if($comment[total]) { ?><?php echo $comment['total'];?><?php } else { ?>0<?php } ?></span>)</span> </div>
						<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				</div>
				<div class="Subpage_left_nr">摘要:<?php echo $description;?></div>
				<div class="Subpage_left_news" id = "ctrlfscont">
					<!-- 火秀相册 -->
					<div id="hsgallery" class="hsgallery fn_clear">
						<div class="hs_photo_view">
							<div id="photoView" class="hs_cnt"><span></span><img src="http://img1.cache.netease.com/cnews/img/gallery11/bg06.png" id="photo" /></div>
							<div class="hs_photo_prev"><a id="photoPrev" class="hs_btn_pphoto" target="_self" hidefocus="true" href="javascript:;"></a></div>
							<div class="hs_photo_next"><a id="photoNext" class="hs_btn_nphoto" target="_self" hidefocus="true" href="javascript:;"></a></div>
							<div id="photoDesc" class="hs_photo_desc fn_clear">
								<div id="photoType" class="hs_tips_num">(<span class="hs_c_lh" id="photoIndex">1</span>/<span id='hsg_page_num'></span>)</div>
								<p></p>
							</div>
							<!--<div id='hs_photo_loading'></div>-->
						</div>

						<div id="scrl" class="hs_photo_thumb fn_clear">
							<div class="hs_scrl">
								<div class="hs_scrl_thumb">
									<div class="hs_scrl_main" id="hs_scrl_main">
										<ul id="thumb" class="hs_list_thumb fn_clear">
										<?php $n=1;if(is_array($pictureurls)) foreach($pictureurls AS $r) { ?>
											<li>
												<a href="javascript:;" hidefocus="true"><img src="<?php echo thumb($r[url],110,72);?>" /></a>
												<p><?php echo $r['alt'];?></p>
												<span title="img"><?php echo $r['url'];?></span>
											</li>
										<?php } ?>
										</ul>
									</div>
									<div class="hs_scrl_bar fn_clear">
										<span class="hs_scrl_lt"></span>
										<span class="hs_scrl_rt"></span>
										<div class="hs_scrl_bd">
											<div class="hs_scrl_ct" id="hs_scrl_ct"><a id="bar" class="hs_btn_scrl"><strong class="hs_btn_lt"></strong><strong class="hs_btn_rt"></strong><span class="hs_btn_bd"><span><strong class="hs_btn_ct"></strong></span></span></a></div>
										</div>
									</div>
								</div>
							</div>
							<div class="hs_scrl_prev"><a id="scrlPrev" class="hs_btn_pscrl" hidefocus="true" href="javascript:void(0)"></a></div>
							<div class="hs_scrl_next"><a id="scrlNext" class="hs_btn_nscrl" hidefocus="true" href="javascript:void(0)"></a></div>
						</div>
					</div>
					<!-- 火秀相册结束 -->

					<div id='news_content'><?php echo $content;?></div>
					<!--- start related --->
					<!--- end related --->
				</div>
				<div id="pages" class="text-c"><?php echo $pages;?></div>
				<div class='artical_tags'>
					<div class='artical_tag'><em>标签</em>：&nbsp;&nbsp;&nbsp;
						<?php $n=1;if(is_array($keywords)) foreach($keywords AS $keyword) { ?> <a href="<?php echo APP_PATH;?>index.php?m=content&c=tag&catid=<?php echo $catid;?>&tag=<?php echo urlencode($keyword);?>" class="blue"><?php echo $keyword;?></a> <?php $n++;}unset($n); ?> </div><br />
					<div class='artical_share'> <span><em>分享到</em>： <a href="javascript:(function(){window.open('http://v.t.sina.com.cn/share/share.php?title='+encodeURIComponent('<?php echo $title;?>'+'<?php echo $description;?>')+'&url='+encodeURIComponent(location.href)+'&appkey='+SINA_APPKEY,'_blank','width=450,height=400');})()"><img src="http://www.huoshow.com/img/templates/default/images/sina.gif" title="新浪微博"/></a>
					 <a href="javascript:(function(){window.open('http://v.t.qq.com/share/share.php?title='+encodeURIComponent('<?php echo $title;?>'+'<?php echo $description;?>')+'&url='+encodeURIComponent(location.href)+'&source='+QQ_SOURCEID+'&pic=','转播到腾讯微博', 'width=700, height=580, top=320, left=180, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no'); })()"><img src="http://www.huoshow.com/img/templates/default/images/qq.png" title="腾讯微博"/></a>
					 <a href="javascript:u=location.href;t='<?php echo $title;?>';c = %22%22 + (window.getSelection ? window.getSelection() : document.getSelection ? document.getSelection() : document.selection.createRange().text);var url=%22http://cang.baidu.com/do/add?it=%22+encodeURIComponent(t)+%22&iu=%22+encodeURIComponent(u)+%22&dc=%22+encodeURIComponent('<?php echo $description;?>')+%22&fr=ien#nw=1%22;window.open(url,%22_blank%22,%22scrollbars=no,width=600,height=450,left=75,top=20,status=no,resizable=yes%22); void 0"><img src="http://www.huoshow.com/img/templates/default/images/baidu.gif" title="百度搜藏"/></a> <a href="javascript:u='http://share.xiaonei.com/share/buttonshare.do?link='+encodeURIComponent(location.href)+'&title='+encodeURIComponent('<?php echo $title;?>'.substring(0,76));window.open(u,'xiaonei','toolbar=0,resizable=1,scrollbars=yes,status=1,width=626,height=436');void(0)" title="人人网"/></a> <a href="javascript:window.open('http://shuqian.qq.com/post?from=3&title='+encodeURIComponent('<?php echo $title;?>'.substring(0,76))+'&uri='+encodeURIComponent(location.href)+'&jumpback=2&noui=1','favit','width=930,height=470,left=50,top=50,toolbar=no,menubar=no,location=no,scrollbars=yes,status=yes,resizable=yes');void(0)"><img src="http://www.huoshow.com/img/templates/default/images/qzone.gif" title="Qzone" /></a> <a href="javascript:d=document;t=d.selection?(d.selection.type!='None'?d.selection.createRange().text:''):(d.getSelection?d.getSelection():'');void(kaixin=window.open('http://www.kaixin001.com/~repaste/repaste.php?&rurl='+escape(d.location.href)+'&rtitle='+escape('<?php echo $title;?>')+'&rcontent='+escape('<?php echo $description;?>'),'kaixin'));kaixin.focus();"><img src="http://www.huoshow.com/img/templates/default/images/kaixin.gif" title="开心网"/></a> <a href="javascript:var%20u='http://www.douban.com/recommend/?url='+encodeURIComponent(location.href)+'&title='+encodeURIComponent('<?php echo $title;?>'.substring(0,76));window.open(u,'douban','toolbar=0,resizable=1,scrollbars=yes,status=1,width=450,height=330');void(0)"><img src="http://www.huoshow.com/img/templates/default/images/douban.gif" title="豆瓣网"/></a> <a title="分享到搜狐微博" href="javascript:void((function(s,d,e,r,l,p,t,z,c){var f='http://t.sohu.com/third/post.jsp?',u=z||d.location,p=['&url=',e(u),'&title=',e(t||d.title),'&content=',c||'gb2312','&pic=',e(p||'')].join('');function%20a(){if(!window.open([f,p].join(''),'mb',['toolbar=0,status=0,resizable=1,width=660,height=470,left=',(s.width-660)/2,',top=',(s.height-470)/2].join('')))u.href=[f,p].join('');};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else%20a();})(screen,document,encodeURIComponent,'','','','','','utf-8'));" ><img src="http://www.huoshow.com/img/templates/default/images/sohu.png" title="搜狐微博"/></span></a> <a href="javascript:var u=location.href;var t=document.title;t=t.substr(0,80)+'by:Addthis.org.cn';var c=''+(window.getSelection?window.getSelection():document.getSelection?document.getSelection():document.selection.createRange().text);c=c.substr(0,280);var e=encodeURIComponent;var url='http://share.renren.com/share/buttonshare.do?link='+e(u)+'&title='+e(t)+'';window.open(url,'addthis.org.cn','toolbar=0,resizable=1,scrollbars=yes,status=1,width=600,height=450');void(0)"><img src="http://www.huoshow.com/img/templates/default/images/rr.gif" title="人人网"/></span></a> </span> </div>
				</div>
			</div>
			<div class="clear"></div>
	</div>
		<div class="clear"></div>
		<div class="hr-h10"></div>

		<div class="related_article">
			<!--相关阅读-->
			<!--#include virtual="/api.php?op=movie&p=get_readings_article&relation=<?php echo $relation;?>&id=<?php echo $id;?>&catid=<?php echo $catid;?>&keywords=<?php echo $rs['keywords'];?>"-->
			<a id="to_comment"></a>
			<!--热点推荐-->
			<!--#include virtual="/api.php?op=movie&p=get_hot_recommend_content&catid=12&posidimg=76&posid=77"-->
		</div>

		<!-- 评论 -->
		<div id='to_comment' class="comment">
			<?php if($allow_comment && module_exists('comment')) { ?>
				<iframe src="<?php echo APP_PATH;?>index.php?m=comment&c=index&a=init&commentid=<?php echo id_encode("content_$catid",$id,$siteid);?>&iframe=1" width="100%" height="100%" id="comment_iframe" frameborder="0" scrolling="no"></iframe>
			<?php } ?>
		</div>
		<!-- 评论结束语 -->
	</div>
	<div class="Subpage_right">
		<!--Banner 300*250-->
		<div class="banner banner_300_250">
			<script type="text/javascript">
				// <![CDATA[
				OA_show(39);
				// ]]>
			</script>
			<noscript>
				<a target='_blank' href='http://misc.huoshow.com/www/delivery/ck.php?n=ac71073'><img alt='' src='http://misc.huoshow.com/www/delivery/avw.php?zoneid=39&n=ac71073' /></a>
			</noscript>
		</div>

		<!--#include virtual="/api.php?op=movie&p=get_recommend_day_news&siteid=<?php echo $siteid;?>&catid=12&other_catids=131|电视,14|游戏,109|超模"-->

		<!--#include virtual="/api.php?op=movie&p=get_site_hot_vedio&siteid=<?php echo $siteid;?>"-->

		<!--#include virtual="/api.php?op=movie&p=get_all_hot_news_rand&siteid=<?php echo $siteid;?>"-->

		<!--#include virtual="/api.php?op=movie&p=get_muchweibo_dynamic"-->

		<!--#include virtual="/api.php?op=movie&p=get_channel_hot_img&catids=69&num=6"-->
	</div>
	<div class="clear"></div>
<?php } ?>
</div>