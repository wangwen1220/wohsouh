<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<a href="#" onclick="hideGiftBox();return false;" class='close-gift-box'>关闭</a>
<div class="lipin-tabs">
  <? if(is_array($giftType)) foreach($giftType as $key => $value) { ?>  <a href="javascript:;"><?=$value['name']?></a>
  <? } ?>
</div>
<div class="lipin"><? if(is_array($giftType)) foreach($giftType as $key => $value) { ?>  <ul class="lipin-b"><? if(is_array($giftList[$value['typeid']])) foreach($giftList[$value['typeid']] as $k => $v) { ?><li>
<a href="#" giftId="<?=$v['giftid']?>" giftName="<?=$v['name']?>" giftPrice="<?=$v['price']?>"><img src="static2/images/gift/<? echo $v['image']; ?>" width="48" height="48" /><?=$v['name']?></a>
</li>
<? } ?>
  </ul>
<? } ?>
</div>


