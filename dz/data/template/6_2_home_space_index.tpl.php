<? if(!defined('IN_DISCUZ')) exit('Access Denied'); hookscriptoutput('space_index');?><? include template('home/space_header'); ?><div id="ct" class="wp w cl">
<div id="diypage" class="area">
<div id="frame1" class="frame cl" noedit="1">
<div id="frame1_left" style="width:<?=$widths['0']?>px" class="z column">
<? if(empty($leftlist)) { ?>
<div id="left_temp" class="move-span temp"></div>
<? } if(is_array($leftlist)) foreach($leftlist as $key => $value) { if(!empty($key)) { ?>
<div id="<?=$key?>" class="block move-span">
<?=$value?>
</div>
<? } } ?>
</div>

<div id="frame1_center" style="width:<?=$widths['1']?>px" class="z column">
<? if(empty($centerlist)) { ?>
<div id="center_temp" class="move-span temp"></div>
<? } if(is_array($centerlist)) foreach($centerlist as $key => $value) { if(!empty($key)) { ?>
<div id="<?=$key?>" class="block move-span">
<?=$value?>
</div>
<? } } ?>
</div>

<? if((strlen($userdiy['currentlayout']) > 3) ) { ?>
<div id="frame1_right" style="width:<?=$widths['2']?>px" class="z column">
<? if(empty($rightlist)) { ?>
<div id="right_temp" class="move-span temp"></div>
<? } if(is_array($rightlist)) foreach($rightlist as $key => $value) { if(!empty($key)) { ?>
<div id="<?=$key?>" class="block move-span">
<?=$value?>
</div>
<? } } ?>
</div>
<? } ?>
</div>
</div>
</div><? include template('common/footer_1_5'); ?>