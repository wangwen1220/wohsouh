<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<ul>
  <? if(is_array($giftpai)) foreach($giftpai as $key => $value) { ?>  <li>
  <img src="static2/images/gift/<? echo $value['image']; ?>" title="价格：<?=$value['giftprice']?>火币/个"/>                
  <span class="tming"> 
<?=$value['giftname']?></span><br>
  <span class="dming"><?=$value['num']?>(第<?=$value['top']?>名)</span>
  </li>
  <? } ?>
</ul>
