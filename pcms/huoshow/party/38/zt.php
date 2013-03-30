<!DOCTYPE html>
<html lang="zh-CN">
<head>
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
$dblink = new DataBase("");
$sql = "select b.uid,(select IF(a.nickname!='',a.nickname,a.username) AS nickname from pre_common_member a where b.uid=a.uid) as username,b.gift_id from pre_live_party_user_box_entity_gift_log b where b.gift_id = 1;";
$liwu1 = $dblink->getRow($sql);//获取实体礼物1
$sql = "select b.uid,(select IF(a.nickname!='',a.nickname,a.username) AS nickname from pre_common_member a where b.uid=a.uid) as username,b.gift_id from pre_live_party_user_box_entity_gift_log b where b.gift_id = 2;";
$liwu2 = $dblink->getRow($sql);//获取实体礼物2
$sql = "select b.uid,(select IF(a.nickname!='',a.nickname,a.username) AS nickname from pre_common_member a where b.uid=a.uid) as username,b.gift_id from pre_live_party_user_box_entity_gift_log b where b.gift_id = 3;";
$liwu3 = $dblink->getRow($sql);//获取实体礼物3
$sql = "select b.uid,(select IF(a.nickname!='',a.nickname,a.username) AS nickname from pre_common_member a where b.uid=a.uid) as username,b.gift_id from pre_live_party_user_box_entity_gift_log b where b.gift_id = 4;";
$liwu4 = $dblink->getRow($sql);//获取实体礼物4
$sql = "select b.uid,(select IF(a.nickname!='',a.nickname,a.username) AS nickname from pre_common_member a where b.uid=a.uid) as username,b.gift_id from pre_live_party_user_box_entity_gift_log b where b.gift_id = 5;";
$liwu5 = $dblink->getRow($sql);//获取实体礼物5
$sql = "select b.uid,(select IF(a.nickname!='',a.nickname,a.username) AS nickname from pre_common_member a where b.uid=a.uid) as username,b.gift_id from pre_live_party_user_box_entity_gift_log b where b.gift_id = 6;";
$liwu6 = $dblink->getRow($sql);//获取实体礼物6
$dblink->dbclose();
?>
<meta charset="utf-8" />
<title>关爱女性，做最美的自己！</title>
<!–[if IE]>
<script>//让IE支持HTML5的JS
// iepp v2.1pre @jon_neal & @aFarkas github.com/aFarkas/iepp
// html5shiv @rem remysharp.com/html5-enabling-script
// Dual licensed under the MIT or GPL Version 2 licenses
/*@cc_on(function(a,b){function r(a){var b=-1;while(++b<f)a.createElement(e[b])}if(!window.attachEvent||!b.createStyleSheet||!function(){var a=document.createElement("div");return a.innerHTML="<elem></elem>",a.childNodes.length!==1}())return;a.iepp=a.iepp||{};var c=a.iepp,d=c.html5elements||"abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|subline|summary|time|video",e=d.split("|"),f=e.length,g=new RegExp("(^|\\s)("+d+")","gi"),h=new RegExp("<(/*)("+d+")","gi"),i=/^\s*[\{\}]\s*$/,j=new RegExp("(^|[^\\n]*?\\s)("+d+")([^\\n]*)({[\\n\\w\\W]*?})","gi"),k=b.createDocumentFragment(),l=b.documentElement,m=b.getElementsByTagName("script")[0].parentNode,n=b.createElement("body"),o=b.createElement("style"),p=/print|all/,q;c.getCSS=function(a,b){try{if(a+""===undefined)return""}catch(d){return""}var e=-1,f=a.length,g,h=[];while(++e<f){g=a[e];if(g.disabled)continue;b=g.media||b,p.test(b)&&h.push(c.getCSS(g.imports,b),g.cssText),b="all"}return h.join("")},c.parseCSS=function(a){var b=[],c;while((c=j.exec(a))!=null)b.push(((i.exec(c[1])?"\n":c[1])+c[2]+c[3]).replace(g,"$1.iepp-$2")+c[4]);return b.join("\n")},c.writeHTML=function(){var a=-1;q=q||b.body;while(++a<f){var c=b.getElementsByTagName(e[a]),d=c.length,g=-1;while(++g<d)c[g].className.indexOf("iepp-")<0&&(c[g].className+=" iepp-"+e[a])}k.appendChild(q),l.appendChild(n),n.className=q.className,n.id=q.id,n.innerHTML=q.innerHTML.replace(h,"<$1font")},c._beforePrint=function(){if(c.disablePP)return;o.styleSheet.cssText=c.parseCSS(c.getCSS(b.styleSheets,"all")),c.writeHTML()},c.restoreHTML=function(){if(c.disablePP)return;n.swapNode(q)},c._afterPrint=function(){c.restoreHTML(),o.styleSheet.cssText=""},r(b),r(k);if(c.disablePP)return;m.insertBefore(o,m.firstChild),o.media="print",o.className="iepp-printshim",a.attachEvent("onbeforeprint",c._beforePrint),a.attachEvent("onafterprint",c._afterPrint)})(this,document)@*/
</script>	
<![endif]–>
<style>
*{margin:0; padding:0; border:0}
article,aside,dialog,footer,header,section,footer,nav,figure,menu,figcaption{display:block}
.clear{clear:both}
body{ background:url(images/bg.jpg) repeat center top; font-family:"微软雅黑"; font-size:14px;}
#container{width:960px; margin:0 auto; background:url(images/head2.jpg) no-repeat center top; padding-top:478px }
.bot_wd{width:960px; margin:0 auto;   height:100px; margin-top:18px;  margin-top:0\9; position:relative }
header{padding-top:130px; width:330px; height:196px; margin-left:20px; color:#FFF; font-size:18px}
header h1,header .noshow{text-indent:-20000px; height:0; _display:none; }
hgroup{_line-height:1.2em}
h3{color:#df4eff; font-size:20px; margin:10px 0}
h4{color:#FFF; font-size:18px; margin-left:24px; _margin-left:12px; }
.more{float:right; margin-right:8px; text-decoration:none; color:black}
.more:hover{color:#FFF}
.bar{line-height:28px; position:relative}
.wt{color:white;}
.bk{color:#2d2d2d}
.yl{color:#ffd67e}
.shad1{ text-shadow:1px 2px 1px #490a47}
.shad2{-moz-box-shadow:2px 2px 5px #ff7bbd; -webkit-box-shadow:2px 2px 5px #ff7bbd; box-shadow:2px 2px 5px #ff7bbd;}
.shad3{-moz-box-shadow:2px -2px 5px #e7b2ff; -webkit-box-shadow:2px -2px 5px #e7b2ff; box-shadow:2px -2px 5px #e7b2ff;}
#impPart{margin:0 auto;
width:936px;
-webkit-border-top-left-radius:0px;
-webkit-border-top-right-radius:0px;
-webkit-border-bottom-right-radius:20px;
-webkit-border-bottom-left-radius:20px;
-moz-border-radius-topleft:0px;
-moz-border-radius-topright:0px;
-moz-border-radius-bottomright:20px;
-moz-border-radius-bottomleft:20px;
border-top-left-radius:0px;
border-top-right-radius:0px;
border-bottom-right-radius:20px;
border-bottom-left-radius:20px;
-moz-box-shadow:1px 1px 1px #5d2568; 
-webkit-box-shadow:1px 1px 1px #5d2568;
box-shadow:1px 1px 1px #5d2568;
filter: progid:DXImageTransform.Microsoft.Shadow(color='#5d2568', Direction=135, Strength=2);/*for ie6,7,8*/
background-color:#fff;
border-left:10px solid #eec9ff;
border-right:10px solid #eec9ff;
border-bottom:10px solid #eec9ff;
}

.tit{background:url(images/title.png) no-repeat left top; width:150px; height:50px;
font-size:24px; color:#df4eff; line-height:42px; padding-left:18px; letter-spacing:3px; font-weight:normal;
 text-shadow:1px 1px 2px #fff; margin:10px 0 10px 0}
.tit1{
	margin-top:-60px;
	position:absolute;
	left: 487px;
	top: 558px;
}
ol,section{ line-height:2em}
section{width:400px; margin:2px; text-align:center; float:left; height:230px; border:1px solid #ccc}
section:hover{background:#f0f0f0}
pre{font-family:"微软雅黑"}
.mainArt, article{margin:10px 60px;}

footer{ background:rgba(255,255,255,0.4); background:#FFF\9; filter:alpha(opacity=40); margin-top:10px\9;}
.footer_txt {width:700px; color:#666; line-height:16px; padding-top:26px; margin-left: 136px; font-family: "宋体", arial;
font-size: 12px;
color: #414141;}
.footer_txt a {color:#d753be; text-decoration:none}
.footer_logo { width:90px; height:47px; float:left; margin-right:15px;margin:20px 0 0 36px; background:url(images/logo.gif) no-repeat;
-moz-border-radius:6px; -webkit-border-radius:6px; border-radius:6px;}

.topic {
background: url(images/topic_bg.gif) no-repeat;
width: 234px; height:256px;
display: inline-block;
float: left;
margin:0 20px;
padding:8px;
font:normal 12px/28px "宋体";
_line-height:29px;
_margin:0 16px
}
.topic ul{margin:0 8px 0 32px}
.topic ul li{list-style:none outside none;}
aside{padding:10px 30px}
.fr{float:right}
.topic img{height:28px; width:28px; float:left }
span img{width:282px; height:282px}
</style>
</head>

<body>
<div id="container">
  <div id="impPart">
    
  <article>
    	<h2 class="tit">活动规则</h2>
         <ol>
<li>直播间内收取3.8特属道具——女性礼包<img src="images/gift.png" width="48" height="48">，在收到的礼物栏内打开礼包会随机得到如下实物奖品：</li>
                 <li>收到女性礼包的选手可在自己的礼物后台点击兑换，每开一个礼包可固定获得一朵价值10火币的康乃馨；康乃馨在活动结束时系统会帮您兑换成火币。兑换成功后，每朵康乃馨的接收者可获10魅力值+5火币，送出者可获得10富豪值。
                  
           </li>
        </ol>
    </article>
    
    <article class="mainArt">
 <h2 class="tit">奖项设置</h2>
<section>
		
                <h3>1、4季彩吧 持久卷密睫毛膏  价值55元</h3>
        <img src="images/sb_1.jpg" width="80" height="140"> </section>
        
      <section>
                <h3>2、巧茜妮恒润甜睡免洗面膜80G  价值65元</h3>
        <img src="images/sb_2.jpg" width="77" height="148"> </section>
        
         <section>
         <h3>3、蜜乐兔重点去纹滚珠眼霜15G  价值128元</h3>
         <h3><img src="images/sb_3.jpg" width="77" height="148"></h3>
          </section>
           <section>
         <h3>4、蜜乐兔粉嫩保湿BB霜40G   价值98元</h3>
         <h3><img src="images/sb_4.jpg" width="79" height="138"></h3>
          </section>
           <section>
         <h3>5、蒙芭拉超细亲肤粉饼 18G   价值58元</h3>
         <h3><img src="images/sb_5.jpg" alt="" width="128" height="132"></h3>
          </section>
           <section>
         <h3>6、法国泊诗AquaBOSS全效BB霜35G  价值88元</h3>
         <h3><img src="images/sb_6.jpg" width="121" height="148"></h3>
          </section>
          <div class="clear"></div>
<h2 class="tit">注意事项</h2>	
        <ul>
        <li>主播收到礼包后需在自己的礼物后台手动兑换礼包，兑换方式为：登录后点击个人中心的礼物进入，点击兑换即可；<span><img src="images/sm.jpg" width="282" height="282"></span></li>
        <li>女性礼包价格为10火币，收者可获得10魅力值，送者可获10富豪值；</li>
        <li>活动结束时，如有礼包未兑换的，系统将于2012年3月9日00：00帮助用户自动兑换，自动兑换的无实物奖；</li>
        <li>最终获奖名单将于2012年3月10日前公布，用户也可在活动页面实时查询；</li>
		</ul>
    
        
    </article>
    
    <aside><h2 class="tit">中奖名单</h2>
    
      <p  class="mainArt">1.4季彩吧持久卷密睫毛膏获得者：<?php echo $liwu1[0]['username'] ?><br>
        2.巧茜妮恒润甜睡免洗面膜获得者：<?php echo $liwu2[0]['username'] ?><br>
        3.蜜乐兔重点去纹滚珠眼霜获得者：<?php echo $liwu3[0]['username'] ?><br>
        4.蜜乐兔粉嫩保湿BB霜获得者:<?php echo $liwu4[0]['username'] ?><br>
      5.蒙芭拉超细亲肤粉饼获得者：<?php echo $liwu5[0]['username'] ?><br>
      6.法国泊诗AquaBOSS全效BB霜获得者:<?php echo $liwu6[0]['username'] ?><br>
        
      </p>
      <div class="clear"></div>
    </aside>
</div>
</div>

<footer class="shad3">
<div class="bot_wd"><div><a href="www.huoshow.com"  class="footer_logo shad2"></a></div><div class="footer_txt"> <a href="http://www.huoshow.com/about/about.shtml">关于火秀</a> | <a href="http://www.huoshow.com/about/advertising.shtml">广告服务</a> | <a href="http://www.huoshow.com/about/contact.shtml">联系我们</a> | <a href="http://www.huoshow.com/about/partners.shtml">合作伙伴</a> | <a href="http://www.huoshow.com/about/joinus.shtml">诚聘英才</a>
			<p>www.huoshow.com 版权所有 粤ICP备06087881号</p>
		</div></div>	
</footer>

</body>
</html>
