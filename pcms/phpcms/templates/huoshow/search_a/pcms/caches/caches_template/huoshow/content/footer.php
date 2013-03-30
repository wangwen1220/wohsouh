<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?>	<!--Footer-->
	<div id="footer_bg">
		<div id="footer">
			<div class="footer_logo"></div>
			<div class="footer_txt">
				<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e3d146232857be4579899ac97dbd2f7c&action=category&catid=1&num=15&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">修改</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'1','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'15',));}?>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<a href="<?php echo $r['url'];?>" target="_blank"><?php echo $r['catname'];?></a> |
				<?php $n++;}unset($n); ?>
				<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
				<p>www.huoshow.com 版权所有 粤ICP备06087881号</p>
                <?php echo tjcode();?><?php echo runhook('glogal_footer')?>
			</div>
		</div>
	</div>
	<!--Footer End-->

	<script type="text/javascript">
		// 设置谷歌统计
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-19568132-1']);
		_gaq.push(['_setDomainName', '.huoshow.com']);

		_gaq.push(['_setAccount', 'UA-19568132-1']);
		_gaq.push(['_addOrganic', 'baidu', 'word']);
		_gaq.push(['_addOrganic', 'soso', 'w']);
		_gaq.push(['_addOrganic', '3721', 'name']);
		_gaq.push(['_addOrganic', 'yodao', 'q']);
		_gaq.push(['_addOrganic', 'vnet', 'kw']);
		_gaq.push(['_addOrganic', 'sogou', 'query']);
		_gaq.push(['_addIgnoredOrganic', '火秀']);
		_gaq.push(['_addIgnoredOrganic', '火秀网']);
		_gaq.push(['_addIgnoredOrganic', 'huoshow']);
		_gaq.push(['_addIgnoredOrganic', 'www.huoshow.com']);
		_gaq.push(['_setDomainName', '.huoshow.com']);
		_gaq.push(['_trackPageview']);

		(function() {
			// 引入谷歌统计
			var ga = document.createElement('script');
			ga.type = 'text/javascript';
			ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
		})();
	</script>
	<script type="text/javascript">
		// 引入百度统计
		var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
		document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F82b22a65dfbeae6f241edda7d3f322af' type='text/javascript'%3E%3C/script%3E"));
	</script>

	<div style="display:none;"><script src="http://s16.cnzz.com/stat.php?id=2692090&web_id=2692090"></script></div>
</body>
</html>