<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<li class="cl <?=$value['magic_class']?>" id="feed_<?=$value['feedid']?>_li" onmouseover="feed_menu(<?=$value['feedid']?>,1);" onmouseout="feed_menu(<?=$value['feedid']?>,0);">
<? if($value['uid'] && empty($_G['home']['tpl']['hidden_more'])) { ?>
<a href="home.php?mod=spacecp&amp;ac=feed&amp;op=menu&amp;feedid=<?=$value['feedid']?>" class="o<? if($_G['uid'] == $value['uid']) { ?> del<? } ?>" id="a_feed_menu_<?=$value['feedid']?>" onclick="showWindow(this.id, this.href, 'get', 0);doane(event);" title="<? if($_G['uid'] != $value['uid']) { ?>显示更多选项<? } else { ?>删除动态<? } ?>" style="display:none;">菜单</a>
<? } ?>
<div class="cl" <?=$value['style']?>>
<a class="t" href="home.php?mod=space&amp;uid=<?=$_GET['uid']?>&amp;do=home&amp;view=<?=$_GET['view']?>&amp;appid=<?=$value['appid']?>&amp;icon=<?=$value['icon']?>" title="只看此类动态"><img src="<?=$value['icon_image']?>" /></a>
<?=$value['title_template']?> 
<? if($value['new']) { ?>
<span style="color:red;">New</span> 
<? } ?>
<span class="xg1"><?php echo dgmdate($value[dateline], 'u'); ?></span>

<? if(empty($_G['home']['tpl']['hidden_menu'])) { ?><?php $_G[gp_key] = $key = random(8); if($value['idtype']=='doid') { ?>
(<a href="javascript:;" <? if($_G['uid']) { ?>onclick="docomment_get('<?=$value['id']?>', '<?=$key?>');"<? } else { ?>onclick="showWindow(this.id, 'home.php?mod=spacecp&ac=feed', 'get', 0);doane(event);"<? } ?> id="<?=$_G['gp_key']?>_do_a_op_<?=$value['id']?>">回复</a>)
<? } elseif(in_array($value['idtype'], array('blogid','picid','sid','pid','eventid','myshowid'))) { ?>
(<a href="javascript:;" <? if($_G['uid']) { ?>onclick="feedcomment_get(<?=$value['feedid']?>);"<? } else { ?>onclick="showWindow(this.id, 'home.php?mod=spacecp&ac=feed', 'get', 0);doane(event);"<? } ?> id="feedcomment_a_op_<?=$value['feedid']?>">评论</a>)
<? } } ?>

<div class="ec">

<? if(empty($_G['home']['tpl']['hidden_hot']) && $value['hot']) { ?>
<div class="hot"><a href="home.php?mod=spacecp&amp;ac=feed&amp;feedid=<?=$value['feedid']?>"><em><?=$value['hot']?></em>马上参与</a></div>
<? } if($value['image_1']) { ?>
<a href="<?=$value['image_1_link']?>"<?=$value['target']?>><img src="<?=$value['image_1']?>" alt="" class="tn" /></a>
<? } if($value['image_2']) { ?>
<a href="<?=$value['image_2_link']?>"<?=$value['target']?>><img src="<?=$value['image_2']?>" alt="" class="tn" /></a>
<? } if($value['image_3']) { ?>
<a href="<?=$value['image_3_link']?>"<?=$value['target']?>><img src="<?=$value['image_3']?>" alt="" class="tn" /></a>
<? } if($value['image_4']) { ?>
<a href="<?=$value['image_4_link']?>"<?=$value['target']?>><img src="<?=$value['image_4']?>" alt="" class="tn" /></a>
<? } if($value['body_template']) { ?>
<div class="d"<? if($value['image_3']) { ?> style="clear: both; zoom: 1;"<? } ?>>
<?=$value['body_template']?>
</div>
<? } if(!empty($value['body_data']['flashvar'])) { if(!empty($value['body_data']['imgurl'])) { ?>
<table class="mtm" title="点击播放" onclick="javascript:showFlash('<?=$value['body_data']['host']?>', '<?=$value['body_data']['flashvar']?>', this, '<?=$value['feedid']?>');"><tr><td class="vdtn hm" style="background: url(<?=$value['body_data']['imgurl']?>) no-repeat">
<img src="<?=IMGDIR?>/vds.png" alt="点击播放" />
</td></tr></table>
<? } else { ?>
<img src="<?=IMGDIR?>/vd.gif" alt="点击播放" onclick="javascript:showFlash('<?=$value['body_data']['host']?>', '<?=$value['body_data']['flashvar']?>', this, '<?=$value['feedid']?>');" class="tn" />
<? } } elseif(!empty($value['body_data']['musicvar'])) { ?>
<img src="<?=IMGDIR?>/music.gif" alt="点击播放" onclick="javascript:showFlash('music', '<?=$value['body_data']['musicvar']?>', this, '<?=$value['feedid']?>');" class="tn" />
<? } elseif(!empty($value['body_data']['flashaddr'])) { ?>
<img src="<?=IMGDIR?>/flash.gif" alt="点击查看" onclick="javascript:showFlash('flash', '<?=$value['body_data']['flashaddr']?>', this, '<?=$value['feedid']?>');" class="tn" />
<? } if($user_list[$value['hash_data']]) { ?>
<p>其他参与者:<?php echo implode(', ', $user_list[$value['hash_data']]); ?></p>
<? } if($value['body_general']) { ?>
<div class="quote<? if($value['image_1']) { ?> z<? } ?>"><blockquote><?=$value['body_general']?></blockquote></div>
<? } ?>
</div>
</div>

<? if($value['idtype']=='doid') { ?>
<div id="<?=$key?>_<?=$value['id']?>" style="display:none;"></div>
<? } elseif($value['idtype']) { ?>
<div id="feedcomment_<?=$value['feedid']?>" style="display:none;"></div>
<? } ?>
</li>