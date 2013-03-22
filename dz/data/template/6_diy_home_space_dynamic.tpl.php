<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<style>
.e {
}
.el li {
    border-bottom: 1px dashed #CDCDCD;
    min-height: 20px;
    padding: 10px 20px;
}
.el a {
    color: #336699;
}
.xg1, .xg1 a {
    color: #999999 !important;
}
.el .o {
    background: url("/huoshow/img/multi_live/op.png") no-repeat scroll -2px -62px transparent;
    float: right;
    height: 16px;
    margin: 4px -20px -4px 0;
    overflow: hidden;
    text-indent: 20px;
    width: 16px;
}
</style>
<div id="feed_div" class="e">
<? if($list) { if(is_array($list)) foreach($list as $day => $values) { ?><ul class="el"><? if(is_array($values)) foreach($values as $value) { include template('home/space_feed_li'); } ?>
</ul>
<? } } ?>
</div>