<div id="closeParentTime" style="display:none"></div>

<style type='text/css'>
@charset "utf-8";

/** 清除内外边距 **/
body, h1, h2, h3, h4, h5, h6, hr, p, blockquote, /* structural elements 结构元素 */
dl, dt, dd, ul, ol, li, /* list elements 列表元素 */
pre, /* text formatting elements 文本格式元素 */
form, fieldset, legend, button, input, textarea, /* form elements 表单元素 */
th, td /* table elements 表格元素 */ {
	margin: 0;
	padding: 0;
}

/** 设置默认字体 **/
body,
button, input, select, textarea /* for ie */ {
	font: 12px/1.5 tahoma, arial, \5b8b\4f53, sans-serif;
}
h1, h2, h3, h4, h5, h6 { font-size: 100%; }
address, cite, dfn, em, var { font-style: normal; } /* 将斜体扶正 */
code, kbd, pre, samp { font-family: courier new, courier, monospace; } /* 统一等宽字体 */
small { font-size: 12px; } /* 小于 12px 的中文很难阅读，让 small 正常化 */

/** 重置列表元素 **/
ul, ol { list-style: none; }

/** 重置文本格式元素 **/
a { color: #999; text-decoration: none; outline: none; }
a:hover {}

sup { vertical-align: text-top; } /* 重置，减少对行高的影响 */
sub { vertical-align: text-bottom; }

/** 重置表单元素 **/
legend { color: #000; } /* for ie6 */
fieldset, img { border: 0; } /* img 搭车：让链接里的 img 无边框 */
button, input, select, textarea { font-size: 100%; } /* 使得表单元素在 ie 下能继承字体大小 */
/* 注：optgroup 无法扶正 */

/** 重置表格元素 **/
table { border-collapse: collapse; border-spacing: 0; }

#report-audit-form {
	
}
#report-audit {
	width: 100%;
	font-size: 12px;
	margin: 0 0 10px;
}
#report-audit tbody td {
	padding: 12px 0;
	border-bottom: 1px dashed #CCCCCC;
}
#report-audit tbody td.input {
	width: 5%;
	text-align: center;
	vertical-align: middle;
}
#report-audit tbody td.content {
	width: 85%;
}
#report-audit tbody td.content ul {
	
}
#report-audit tbody td.content li {
	line-height: 2em;
}
#report-audit tbody td.content li strong {
	display: inline-block;
	width: 7em;
	text-align: right;
}
#report-audit tbody td.content li span {
	color: #444;
}
#report-audit tbody td.content li a.name {
	text-decoration: underline;
	color: #333;
}
#report-audit tbody td.content li a.name:hover {
	text-decoration: none;
}
#report-audit tbody td.content li a.site {
	color: #5ACCFF;
}
#report-audit tbody td.content li a.site:hover {
	text-decoration: underline;
}
#report-audit tbody td.content li p {
	margin-left: 1.5em;
	color: #555;
}
#report-audit tbody td.content li p .date {
	margin-right: 5px;
}
#report-audit tbody td.link {
	width: 10%;
	vertical-align: top;
	text-align: center;
}
#report-audit tbody td.link a {
	color: #333;
	font-weight: bold;
	text-decoration: underline;
}
#report-audit tbody td.link a:hover {
	text-decoration: none;
}

</style>

<form id='report-audit-form' name="myform" action="?m=community&c=communitalbum&a=xx" method="post">
	<table id="report-audit">
		<tbody>
		 <?php foreach($datas as $r) { ?>
			<tr>
				<!--<td class='input'><input type='checkbox' /></td>-->
				<td class='content'>
					<ul class='fn-clear'>
						<li><strong>举报类别：</strong> <span>举报 <a class='name'  target="_blank" href='/index.php?m=community&c=myhuoshow&a=mylike&myuid=<?php echo $r[uid]?>'><?php echo $r[nickname];?></a> 的<?php if ($r[report_type]==1) {echo "用户";}elseif($r[report_type]==2){echo "分享";}elseif($r[report_type]==3){echo "评论";}elseif($r[report_type]==4){echo "私信";} ?></span></li>
						<li><strong>举报类型：</strong> <span><em><?php if($r[report_content] == "1"){echo "虚假广告(商品)";}elseif($r[report_content] == "2"){echo "虚假中奖信息";}elseif($r[report_content] == "3"){echo "其它";}?></em></span></li>
						<li><strong>证据：</strong> <span><a class='site' target="_blank" href='<?php echo $r[url];?>'><?php echo $r[url];?></a></span></li>
						<li>
							<strong>举报理由：</strong>
							<p><span class='date'><?php echo $r[report_time];?></span> <a class='name'  target="_blank" href='/index.php?m=community&c=myhuoshow&a=mylike&myuid=<?php echo $r[uid]?>'><?php echo $r[nickname];?></a>： <?php echo $r[report_reason];?></p>
							<!--<p><span class='date'>2012-07-24 17:00</span> <a class='name' href='#'>不会游泳的鱼</a>： 那么解决问题的理念才是支撑它的灵魂! 什么是微吧 7月24号微吧产品正式上线。 作为微博今年推出的一个重要产品，在起初接到这个品牌</p>
							<p>项目时，一连串的问题浮分点科技无线业务部高级总监，负责无线业务。电商行业正面临着前所未有的严峻考验!经济环境的恶化，资本市场的冷却。</p>-->
						</li>
					</ul>
				</td>
				<!--<td class='link'><a href='#'>查看详情</a></td>-->
			</tr>
			<?php }?>
			<!--<tr>
				<td class='input'><input type='checkbox' /></td>
				<td class='content'>
					<ul class='fn-clear'>
						<li><strong>举报类别：</strong> <span>举报 <a class='name' href='#'>美丽的小丫</a> 的分享</span></li>
						<li><strong>举报类型：</strong> <span><em>虚假广告（商品）</em></span></li>
						<li><strong>证据：</strong> <span><a class='site' href='#'>&huoshow.com/?88888</a></span></li>
						<li>
							<strong>举报理由：</strong>
							<p><span class='date'>2012-07-24 17:00</span> <a class='name' href='#'>美丽的小丫</a>： 该用户乱发广告</p>
							<p><span class='date'>2012-07-24 17:00</span> <a class='name' href='#'>不会游泳的鱼</a>： 那么解决问题的理念才是支撑它的灵魂! 什么是微吧 7月24号微吧产品正式上线。 作为微博今年推出的一个重要产品，在起初接到这个品牌</p>
							<p>项目时，一连串的问题浮分点科技无线业务部高级总监，负责无线业务。电商行业正面临着前所未有的严峻考验!经济环境的恶化，资本市场的冷却。</p>
						</li>
					</ul>
				</td>
				<td class='link'><a href='#'>查看详情</a></td>
			</tr>
			<tr>
				<td class='input'><input type='checkbox' /></td>
				<td class='content'>
					<ul class='fn-clear'>
						<li><strong>举报类别：</strong> <span>举报 <a class='name' href='#'>美丽的小丫</a> 的分享</span></li>
						<li><strong>举报类型：</strong> <span><em>虚假广告（商品）</em></span></li>
						<li><strong>证据：</strong> <span><a class='site' href='#'>&huoshow.com/?88888</a></span></li>
						<li>
							<strong>举报理由：</strong>
							<p><span class='date'>2012-07-24 17:00</span> <a class='name' href='#'>美丽的小丫</a>： 该用户乱发广告</p>
							<p><span class='date'>2012-07-24 17:00</span> <a class='name' href='#'>不会游泳的鱼</a>： 那么解决问题的理念才是支撑它的灵魂! 什么是微吧 7月24号微吧产品正式上线。 作为微博今年推出的一个重要产品，在起初接到这个品牌</p>
							<p>项目时，一连串的问题浮分点科技无线业务部高级总监，负责无线业务。电商行业正面临着前所未有的严峻考验!经济环境的恶化，资本市场的冷却。</p>
						</li>
					</ul>
				</td>
				<td class='link'><a href='#'>查看详情</a></td>
			</tr>
			<tr>
				<td class='input'><input type='checkbox' /></td>
				<td class='content'>
					<ul class='fn-clear'>
						<li><strong>举报类别：</strong> <span>举报 <a class='name' href='#'>美丽的小丫</a> 的分享</span></li>
						<li><strong>举报类型：</strong> <span><em>虚假广告（商品）</em></span></li>
						<li><strong>证据：</strong> <span><a class='site' href='#'>&huoshow.com/?88888</a></span></li>
						<li>
							<strong>举报理由：</strong>
							<p><span class='date'>2012-07-24 17:00</span> <a class='name' href='#'>美丽的小丫</a>： 该用户乱发广告</p>
							<p><span class='date'>2012-07-24 17:00</span> <a class='name' href='#'>不会游泳的鱼</a>： 那么解决问题的理念才是支撑它的灵魂! 什么是微吧 7月24号微吧产品正式上线。 作为微博今年推出的一个重要产品，在起初接到这个品牌</p>
							<p>项目时，一连串的问题浮分点科技无线业务部高级总监，负责无线业务。电商行业正面临着前所未有的严峻考验!经济环境的恶化，资本市场的冷却。</p>
						</li>
					</ul>
				</td>
				<td class='link'><a href='#'>查看详情</a></td>
			</tr>
			<tr>
				<td class='input'><input type='checkbox' /></td>
				<td class='content'>
					<ul class='fn-clear'>
						<li><strong>举报类别：</strong> <span>举报 <a class='name' href='#'>美丽的小丫</a> 的分享</span></li>
						<li><strong>举报类型：</strong> <span><em>虚假广告（商品）</em></span></li>
						<li><strong>证据：</strong> <span><a class='site' href='#'>&huoshow.com/?88888</a></span></li>
						<li>
							<strong>举报理由：</strong>
							<p><span class='date'>2012-07-24 17:00</span> <a class='name' href='#'>美丽的小丫</a>： 该用户乱发广告</p>
							<p><span class='date'>2012-07-24 17:00</span> <a class='name' href='#'>不会游泳的鱼</a>： 那么解决问题的理念才是支撑它的灵魂! 什么是微吧 7月24号微吧产品正式上线。 作为微博今年推出的一个重要产品，在起初接到这个品牌</p>
							<p>项目时，一连串的问题浮分点科技无线业务部高级总监，负责无线业务。电商行业正面临着前所未有的严峻考验!经济环境的恶化，资本市场的冷却。</p>
						</li>
					</ul>
				</td>
				<td class='link'><a href='#'>查看详情</a></td>
			</tr>
			<tr>
				<td class='input'><input type='checkbox' /></td>
				<td class='content'>
					<ul class='fn-clear'>
						<li><strong>举报类别：</strong> <span>举报 <a class='name' href='#'>美丽的小丫</a> 的分享</span></li>
						<li><strong>举报类型：</strong> <span><em>虚假广告（商品）</em></span></li>
						<li><strong>证据：</strong> <span><a class='site' href='#'>&huoshow.com/?88888</a></span></li>
						<li>
							<strong>举报理由：</strong>
							<p><span class='date'>2012-07-24 17:00</span> <a class='name' href='#'>美丽的小丫</a>： 该用户乱发广告</p>
							<p><span class='date'>2012-07-24 17:00</span> <a class='name' href='#'>不会游泳的鱼</a>： 那么解决问题的理念才是支撑它的灵魂! 什么是微吧 7月24号微吧产品正式上线。 作为微博今年推出的一个重要产品，在起初接到这个品牌</p>
							<p>项目时，一连串的问题浮分点科技无线业务部高级总监，负责无线业务。电商行业正面临着前所未有的严峻考验!经济环境的恶化，资本市场的冷却。</p>
						</li>
					</ul>
				</td>
				<td class='link'><a href='#'>查看详情</a></td>
			</tr>-->
		</tbody>
	<table>

	<div><?php echo $pages;?></div>
</form>