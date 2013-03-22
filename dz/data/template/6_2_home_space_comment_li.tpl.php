<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<a name="comment_anchor_<?=$value['cid']?>"></a>
<? if(empty($ajax_edit)) { ?><dl id="comment_<?=$value['cid']?>_li" class="bbda cl"><? } if($value['author']) { ?>
<dd class="m avt"><a href="home.php?mod=space&amp;uid=<?=$value['authorid']?>" c="1"><?php echo avatar($value[authorid],small); ?></a></dd>
<? } else { ?>
<dd class="m avt"><img src="<?=STATICURL?>image/magic/hidden.gif" alt="hidden" /></dd>
<? } ?>
<dt>
<span class="y xw0">
<? if($value['authorid'] != $_G['uid'] && $value['author'] == "" && $_G['magic']['reveal']) { ?>
<a id="a_magic_reveal_<?=$value['cid']?>" href="home.php?mod=magic&amp;mid=reveal&amp;idtype=cid&amp;id=<?=$value['cid']?>" onclick="ajaxmenu(event,this.id,1)"><img src="<?=STATICURL?>image/magic/reveal.small.gif" alt="reveal" /><?=$_G['magic']['reveal']?></a>
<span class="pipe">|</span>
<? } ?>

<?php if(!empty($_G['setting']['pluginhooks']['space_blog_comment_op'][$k])) echo $_G['setting']['pluginhooks']['space_blog_comment_op'][$k]; if($value['authorid']==$_G['uid']) { if($_G['magic']['anonymous']) { ?>
<img src="<?=STATICURL?>image/magic/anonymous.small.gif" alt="anonymous" class="vm" />
<a id="a_magic_anonymous_<?=$value['cid']?>" href="home.php?mod=magic&amp;mid=anonymous&amp;idtype=cid&amp;id=<?=$value['cid']?>" onclick="ajaxmenu(event,this.id, 1)"><?=$_G['magic']['anonymous']?></a>
<span class="pipe">|</span>
<? } if($_G['setting']['magicstatus'] && !empty($_G['setting']['magics']['flicker'])) { ?>
<img src="<?=STATICURL?>image/magic/flicker.small.gif" alt="flicker" class="vm" />
<? if($value['magicflicker']) { ?>
<a id="a_magic_flicker_<?=$value['cid']?>" href="home.php?mod=spacecp&amp;ac=magic&amp;op=cancelflicker&amp;idtype=cid&amp;id=<?=$value['cid']?>&amp;handlekey=cfhk_<?=$value['cid']?>" onclick="showWindow(this.id, this.href, 'get', 0)">取消<?=$_G['setting']['magics']['flicker']?></a>
<? } else { ?>
<a id="a_magic_flicker_<?=$value['cid']?>" href="home.php?mod=magic&amp;mid=flicker&amp;idtype=cid&amp;id=<?=$value['cid']?>" onclick="showWindow(this.id, this.href, 'get', 0)"><?=$_G['setting']['magics']['flicker']?></a>
<? } ?>
<span class="pipe">|</span>
<? } ?>

<a href="home.php?mod=spacecp&amp;ac=comment&amp;op=edit&amp;cid=<?=$value['cid']?>&amp;handlekey=editcommenthk_<?=$value['cid']?>" id="c_<?=$value['cid']?>_edit" onclick="showWindow(this.id, this.href, 'get', 0);">编辑</a>
<? } if($value['authorid']==$_G['uid'] || $value['uid']==$_G['uid'] || checkperm('managecomment')) { ?>
<a href="home.php?mod=spacecp&amp;ac=comment&amp;op=delete&amp;cid=<?=$value['cid']?>&amp;handlekey=delcommenthk_<?=$value['cid']?>" id="c_<?=$value['cid']?>_delete" onclick="showWindow(this.id, this.href, 'get', 0);">删除</a>
<? } if($value['authorid']!=$_G['uid'] && ($value['idtype'] != 'uid' || $space['self'])) { ?>
<a href="home.php?mod=spacecp&amp;ac=comment&amp;op=reply&amp;cid=<?=$value['cid']?>&amp;feedid=<?=$feedid?>&amp;handlekey=replycommenthk_<?=$value['cid']?>" id="c_<?=$value['cid']?>_reply" onclick="showWindow(this.id, this.href, 'get', 0);">回复</a>
<? } ?>
        <? if(checkperm('managecomment')) { ?>
<span class="xg1 xw0">IP: <?=$value['ip']?></span>
<? } ?>
<!--a href="home.php?mod=spacecp&amp;ac=common&amp;op=report&amp;idtype=comment&amp;id=<?=$value['cid']?>&amp;handlekey=reportcommenthk_<?=$value['cid']?>" id="a_report_<?=$value['cid']?>" onclick="showWindow(this.id, this.href, 'get', 0);">举报</a-->
</span>

<? if($value['author']) { ?>
<a href="home.php?mod=space&amp;uid=<?=$value['authorid']?>" id="author_<?=$value['cid']?>"><?=$value['author']?></a>
<? } else { ?>
匿名
<? } ?>
<span class="xg1 xw0"><?php echo dgmdate($value[dateline]); ?></span>
<? if($value['status'] == 1) { ?><b>(待审核)</b><? } ?>
</dt>

<dd id="comment_<?=$value['cid']?>"<? if($value['magicflicker']) { ?> class="magicflicker"<? } ?>><? if($value['status'] == 0 || $value['authorid'] == $_G['uid'] || $_G['adminid'] == 1) { ?><?=$value['message']?><? } else { ?> 审核未通过 <? } ?></dd>
    
    <dd>
        <div class="mod_comment" style="width: 420px;" id="comment_reply_list_<?=$value['cid']?>">
            <? if(is_array($value['reply_arr'])) foreach($value['reply_arr'] as $reply) { ?>            <li class="bg2" id="comment_reply_li_<?=$reply['reply_id']?>">
                <div class="mod_comment_cont">
                    <p class="mod_comment_avatar">
                    <? if($reply['reply_user']) { ?>
                    <a class="q_namecard" href="home.php?mod=space&amp;uid=<?=$reply['reply_uid']?>" c="1" target="_blank"><?php echo avatar($reply[reply_uid],small); ?></a>
                    <? } else { ?>
                    <img src="<?=STATICURL?>image/magic/hidden.gif" alt="hidden" />
                    <? } ?>
                    </p>
                    <div class="bg2 comment_cont">
                        <p>
                            <span class="mod_comment_authorname">
                            <? if($reply['reply_user']) { ?>
                                <a href="home.php?mod=space&amp;uid=<?=$reply['reply_uid']?>" class="c_tx q_namecard" target="_blank"><?=$reply['nickname']?></a>
                            <? } else { ?>
                                匿名
                            <? } ?>
                            </span><?=$reply['reply_content']?>
                        </p>
                        <p class="mod_comment_last"><span class="c_tx3 mod_comment_time"><?php echo dgmdate($reply[reply_dateline]); ?> <? if($reply['reply_uid']==$_G['uid']||$value['uid']==$_G['uid']) { ?>
                        <a class="c_tx mod_comment_del" onclick="ajax.delelte_reply('<?=$reply['reply_id']?>');" style="cursor:pointer">删除</a><? } ?></span></p>
                    </div>    	
                </div>
            </li>
        <? } ?>
        </div>
        <? if($_G['uid']) { ?>
        <div class="bg2 mod_clear mod_comment_post" id="commentModule<?=$value['cid']?>_commentTip" style="width:420px">
            <p style="width: auto;" class="mod_comment_default_input textinput"  onclick="return comment_reply_hidden('commentModule<?=$value['cid']?>_commentTip','commentModule<?=$value['cid']?>_commentBox','<?=$value['cid']?>')"></p>
        </div>
        <div class="bg2 mod_comment_post" id="commentModule<?=$value['cid']?>_commentBox" style="width:420px;display: none;" >
            <p id="commentModule<?=$value['cid']?>_emoticonButtonWrapper"><span id="comment_face<?=$value['cid']?>" title="插入表情" onclick="showFace(this.id, 'comment_reply_<?=$value['cid']?>');return false;" style="cursor: pointer;"><img src="<?=IMGDIR?>/facelist.gif" alt="facelist" class="vm" /></span></p>
            
            <p class="mod_comment_textarea"><span><textarea class="textarea textinput input_focus" rows="5" cols="60" id="comment_reply_<?=$value['cid']?>"></textarea></span></p>
            <p style="display: none;" class="hint" id="commentModule1_hintBox"><span class="icon_hint"></span><span></span></p><p class="mod_comment_option"><span class="mod_comment_sub"><button class="bt_tx2" id="commentModule<?=$value['cid']?>_postButton" type="button" onclick="ajax.reply_ajax_submit('<?=$value['cid']?>')">提交</button> <a class="c_tx3" href="javascript:;" onclick="comment_reply_hidden('commentModule<?=$value['cid']?>_commentBox','commentModule<?=$value['cid']?>_commentTip','<?=$value['cid']?>')">取消</a><span class="mod_comment_extension" id="commentModule1_extension_bottom"></span></span>
            </p>
         </div>
         <? } ?>
    </dd>

<?php if(!empty($_G['setting']['pluginhooks']['space_blog_comment_bottom'])) echo $_G['setting']['pluginhooks']['space_blog_comment_bottom']; if(empty($ajax_edit)) { ?></dl><? } ?>