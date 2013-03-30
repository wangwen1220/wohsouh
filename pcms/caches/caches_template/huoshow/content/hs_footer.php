<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?>	<!-- 友情链接 -->
	<?php if($catid==246) { ?><div id="partners" class='fn-clear'>
		<h4 class="header">友情链接</h4>
		<div class="content">
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"link\" data=\"op=link&tag_md5=ac2035a5083619b890333589777bfa8f&action=type_list&typeid=256&siteid=%24siteid&linktype=0&order=listorder+asc&num=29\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$link_tag = pc_base::load_app_class("link_tag", "link");if (method_exists($link_tag, 'type_list')) {$data = $link_tag->type_list(array('typeid'=>'256','siteid'=>$siteid,'linktype'=>'0','order'=>'listorder asc','limit'=>'29',));}?>
			<p>
				<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
				<a href="<?php echo $r['url'];?>" target="_blank"><?php echo $r['name'];?></a><?php if($n<count($data)) { ?> |<?php } ?>
				<?php $n++;}unset($n); ?>
			</p>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</div>
	</div><?php } ?>
	<!-- 友情链接结束 -->

	<!-- Footer -->
	<div id="footer">
		<p>
		<?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo "<div class=\"admin_piao\" pc_action=\"content\" data=\"op=content&tag_md5=e3d146232857be4579899ac97dbd2f7c&action=category&catid=1&num=15&siteid=%24siteid&order=listorder+ASC\"><a href=\"javascript:void(0)\" class=\"admin_piao_edit\">编辑</a>";}$content_tag = pc_base::load_app_class("content_tag", "content");if (method_exists($content_tag, 'category')) {$data = $content_tag->category(array('catid'=>'1','siteid'=>$siteid,'order'=>'listorder ASC','limit'=>'15',));}?>
			<?php $n=1;if(is_array($data)) foreach($data AS $r) { ?>
			<a href="<?php echo $r['url'];?>" target="_blank"><?php echo $r['catname'];?></a><?php if($n<count($data)) { ?> |<?php } ?>
			<?php $n++;}unset($n); ?>
		<?php if(defined('IN_ADMIN') && !defined('HTML')) {echo '</div>';}?>
		</p>
		<p>HuoShow Copyright &copy; 1998 - 2013 All Rights Reserved.</p>
		<p>粤 ICP 备 06087881 号</p>
	</div>
	<!-- Footer End -->

	<script>
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

		(function(window) {
			var document = window.document;
			window.onload = function() {
				// 加载谷歌统计代码
				var ga = document.createElement('script'),
					head = document.getElementsByTagName('head')[0];
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				head.appendChild(ga);

				// 加载 CNZZ 统计代码
				var cnzz = document.createElement('script');
				cnzz.src = 'http://s16.cnzz.com/stat.php?id=2692090&web_id=2692090';
				//cnzz.style.display = 'none';
				head.appendChild(cnzz);

				// 加载百度统计代码
				/*var bd = document.createElement('script');
				bd.src = ('https:' == document.location.protocol ? 'https://' : 'http://') +  bai('hm.baidu.com/h.js%3F82b22a65dfbeae6f241edda7d3f322af');
				head.appendChild(bd);*/
			};
		})(window);
	</script>
	<script type="text/javascript">
		var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
		document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F82b22a65dfbeae6f241edda7d3f322af' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<!-- <div style='display:none;'><script src="http://s16.cnzz.com/stat.php?id=2692090&web_id=2692090"></script></div> -->