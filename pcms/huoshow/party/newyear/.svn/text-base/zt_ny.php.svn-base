<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>2012年春节到了！红红火火，热热闹闹的龙年春节，火秀为您准备了贴心的新年礼物哦！祝秀友们龙年健康，万事如意！</title>

<style>
.hover1 img{ display:block; position:relative; height:120px; width:120px; left:-130px; top:-130px;}
*{margin:0; padding:0}
ul li{list-style:none outside none}
body{background-color:#880000; font:normal 14px/36px "宋体";}
#top{background:url(images/bg_r.jpg) repeat-x; width:100%;}
h1{background:url(images/top.jpg) no-repeat; margin:0 auto; text-indent:-20000px; width:1034px; height:390px}
.con{background-color:#FFF; width:960px; margin:0 auto}
.bar{background:url(images/bar.jpg) no-repeat center top; width:965px; margin:0 auto; height:42px}
#bot{background:url(images/bot.jpg) no-repeat center top; height:151px; margin:0 auto}
#bot p{width:960px; margin:0 auto; text-align:center; color:#FFF; font-size:12px; padding:62px 0 0 0; line-height:28px;}
p, pre{padding:20px}
.pink{color:#ff5b5d}
.msyh{font-family:"微软雅黑","黑体"}
.tit1{font:bold 18px "微软雅黑"; color:#e40104}
.tit5{font:bold 16px/38px "微软雅黑"; color:#fff; padding-left:42px;}
.tit2{background:url(images/bar.jpg) no-repeat -53px -42px; width:123px; height:42px; display:block; margin-left:53px}
.tit3{background:url(images/bar.jpg) no-repeat -53px -84px; width:123px; height:42px; display:block; margin-left:53px}
.tit4{background:url(images/bar.jpg) no-repeat -53px -126px; width:123px; height:42px; display:block; margin-left:53px}
.gf{background:url(images/gift.jpg) no-repeat; width:600px; height:90px; margin:0 auto;}
.gf li{float:left; width:120px; text-align:center; padding-top:100px}
.f12b{font:bold 12px "宋体"; color:#e40104}
.f14b{font:bold 14px "宋体"; color:#e40104}
.f18{font-size:18px}
.icont{background:url(images/icon.jpg) no-repeat center top; text-indent:-20000px; height:45px; width:150px;  clear:both; display:block}
.rank{background:url(images/rank_bg.jpg) no-repeat; width:203px; height:330px; float:left; margin:10px 8px; color:#FFF; font-size:12px; line-height:28px; _margin:10px 6px}
.warp{margin:0 auto; width:876px}
.warp ul{padding:12px}
.warp ul li{padding-left:40px}
.fr{float:right}
.gf2{background:#FFF url(images/gift2.jpg) no-repeat right bottom}
/****************************/

</style>
</head>
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
$dblink = new DataBase("");
$sql = "select b.uid,(select IF(a.nickname!='',a.nickname,a.username) AS nickname from pre_common_member a where b.uid=a.uid) as username,sum(b.num) as num from pre_live_party_user_box_entity_gift_log b group by b.uid order by num desc ";
$gongzai = $dblink->getRow($sql);//获取实体公仔
$sql = "select (select IF(a.nickname!='',a.nickname,a.username) AS nickname from pre_common_member a where b.uid=a.uid) as username,sum(b.party_gift_num) as num from pre_live_party_user_box_gift_list b where b.party_gift_id=3 group by b.uid order by num desc ";
$fudao = $dblink->getRow($sql);//获取福到排行榜
$sql = "select (select IF(a.nickname!='',a.nickname,a.username) AS nickname from pre_common_member a where b.uid=a.uid) as username,sum(b.party_gift_num) as num from pre_live_party_user_box_gift_list b where b.party_gift_id=2 group by b.uid order by num desc ";
$hongbao = $dblink->getRow($sql);//获取红包排行榜
$sql = "select (select IF(a.nickname!='',a.nickname,a.username) AS nickname from pre_common_member a where b.uid=a.uid) as username,sum(b.party_gift_num) as num from pre_live_party_user_box_gift_list b where b.party_gift_id=1 group by b.uid order by num desc ";
$tangyuan = $dblink->getRow($sql);//获取汤圆排行榜
$dblink->dbclose();
?>
<body>
<div id="top"><h1>龙年跃欢腾，火秀来拜年！相聚火秀过大年，萌龙公仔抱回家！</h1></div>
<div class="con gf2">
<p class="pink msyh f18">
<span class="tit1">简介</span> ：2012年春节到了！红红火火，热热闹闹的龙年春节，火秀为您准备了贴心的新年礼物哦！祝秀友们龙年健康，万事如意！<br />
<span class="tit1">活动时间</span>：2012年1月22日（除夕）——2012年2月6日（元宵节）<br />
<span class="tit1">参与方式</span>：登录火秀直播，点击我要直播即可。 </p>
</div>
<div class="bar"><span class="tit2"></span></div>
<div class="con">

<pre>
1、收取火秀春节 礼包 ，在收到的礼物栏内打开礼包会随机福到 、红包 、汤圆 中的一种；更有机会获得实物大奖—<span class="f14b hover1">萌龙公仔</span> ！
2、<span class="f14b hover2">福到</span>—收者可获得20魅力值，送者可获20富豪值，该道具可卖给系统兑换10火币；
   <span class="f14b hover3">红包</span>—收者可获得10魅力值，送者可获10富豪值，该道具可卖给系统兑换5火币；
   <span class="f14b hover4">汤圆</span>—收者可获得5魅力值，送者可获5富豪值，该道具可卖给系统兑换2.0火币。
</pre>
<ul class="gf f12b">
	<li>礼包</li>
    <li>福到</li>
    <li>红包</li>
    <li>汤圆</li>
    <li>萌龙公仔</li>
</ul>
<span class="icont">奖项设置：</span>
<pre>
<span class="f14b">一重礼——神秘礼包送给你！</span>
活动期间积累<span class="f14b hover5">福到</span> 最多的用户，奖励30000火币；
活动期间积累<span class="f14b hover5">福到</span> 第二的用户，奖励10000火币；
活动期间积累<span class="f14b hover5">红包</span> 最多的用户，奖励30000火币；
活动期间积累<span class="f14b hover5">红包</span> 第二的用户，奖励10000火币；
活动期间积累<span class="f14b hover5">汤圆</span> 最多的用户，奖励30000火币；
活动期间积累<span class="f14b hover5">汤圆</span> 第二的用户，奖励10000火币。
<span class="f14b">二重礼——全员大放送，来者就有份！</span>
2012年1月22日（除夕））18：00——24：00之间，比赛满两小时的选手将获得官方送出的<span class="f14b hover5">33个神秘礼包</span> ！
2012年1月23日（春节）18：00——24：00之间，比赛满两小时的选手将获得官方送出的<span class="f14b hover5">33个神秘礼包 </span>！
2012年2月6日（元宵节）18：00——24：00之间，比赛满两小时的选手将获得官方送出的<span class="f14b hover5">33个神秘礼包 </span>！
</pre>
</div>
<div class="bar"><span class="tit3"></span></div>
<div class="con">
<pre>
1、主播收到礼包后需在自己的礼物后台手动兑换礼包，兑换方式为：登录后点击个人中心的礼物进入，点击兑换即可；
<img src="images/sm.jpg" />
2、神秘礼包、福到、红包、汤圆不可卖给系统，该活动专属道具将会在2012年2月7日00：00自动兑换成火币；
3、活动结束时，如有礼包未兑换的，系统将于2012年2月7日00：00帮助用户自动兑换成汤圆，同时兑换成火币；
4、实物龙公仔不限获奖次数；福到、红包、汤圆排名奖励每位秀友仅一次获奖机会，如有雷同取其最高名次；
5、二重礼于当日24：00之前发放；
6、获奖名单将于2012年2月8日公布。
</pre>
</div>
<div class="bar"><span class="tit4"></span></div>
<div class="con">
	<div class="warp">
	<div class="rank">
    <span class="tit5">实物公仔获奖名单</span>
<ul>
             <!--<li><span class="fr">34535</span><span>骑驴来看世界</span></li>-->
            <?php 
			for($i=0;$i<8;$i++) {
			  echo '<li><span class="fr"></span><span title="'.$gongzai[$i]['num'].'">'.$gongzai[$i]['username'].'</span></li>';
			}
			?> 
        </ul>
    </div>
    <div class="rank">
    <span class="tit5">福到排名</span>
<ul>
  <!--<li><span class="fr">34535</span><span>骑驴来看世界</span></li>-->
             <?php 
			for($i=0;$i<8;$i++) {
			  echo '<li><span class="fr"></span><span title="'.$fudao[$i]['num'].'">'.$fudao[$i]['username'].'</span></li>';
			}
			?>        
        </ul>
    </div>
    <div class="rank">
    <span class="tit5">红包排名</span>
<ul>
  <!--<li><span class="fr">34535</span><span>骑驴来看世界</span></li>-->
             <?php 
			for($i=0;$i<8;$i++) {
			  echo '<li><span class="fr"></span><span title="'.$hongbao[$i]['num'].'">'.$hongbao[$i]['username'].'</span></li>';
			}
			?>
        </ul>
    </div>
    <div class="rank">
    <span class="tit5">汤圆排名</span>
<ul>
  <!--<li><span class="fr">34535</span><span>骑驴来看世界</span></li>-->
  			<?php 
			for($i=0;$i<8;$i++) {
			  echo '<li><span class="fr"></span><span title="'.$tangyuan[$i]['num'].'">'.$tangyuan[$i]['username'].'</span></li>';
			}
			?>
              
        </ul>
    </div>
    <div style="clear:both"></div>
    </div>
</div>
<div id="bot">
 <p>温馨提示：请勿上传任何未经授权的作品，否则侵犯版权后果由上传者承担<br />
	本次活动最终解释权归火秀网所有<br />
	火秀网 版权所有 粤ICP备06087881号</p>
</div>
</body>
</html>
