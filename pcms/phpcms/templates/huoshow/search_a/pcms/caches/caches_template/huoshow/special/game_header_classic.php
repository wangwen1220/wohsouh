<?php defined('IN_PHPCMS') or exit('No permission resources.'); ?><!-- Header -->
<div id="header" class='fn-clear'>
	<div class='title'>
		<a class='logo' href="/" title="火秀网" target='_blank'></a>
		<h1><a >资料库</a></h1>
		<h2><a href='http://game.huoshow.com/' target='_blank'>火秀游戏</a> &gt; 资料库 &gt; <?php echo $title;?></h2>
	</div>

	<!--<form class="search" action=''>
		<fieldset><input type='text' name='q' class='search-wd' value='搜索关键字游戏名' /><button type='submit' class='search-submit'>搜索</button></fieldset>
		<fieldset class='search-hotspot'>热点：<a href='#'>《第九大陆》</a> <a href='#'>《天龙八部》</a></fieldset>
	</form>-->
	<form id="search" class='search' name="search" method="get" action="<?php echo APP_PATH;?>index.php" target="_blank">
			        <input type="hidden" value="search" name="app" />
					<input type="hidden" value="index" name="controller" />
					<input type="hidden" value="search" name="action" />
					<input type="hidden" name="m" value="search" />
					<input type="hidden" name="c" value="index" />
					<input type="hidden" name="a" value="init" />
					<input type="hidden" name="typeid" value="1" id="typeid" />
				    <input type="text" class="search-wd" name="q" value='请输入游戏名称...' />
					<!--<label for='search-wd'>站内搜索</label>
					<div id='jselect' class='jselect'>
						<cite class='selected'>全部</cite>
						<?php $search_model = getcache('search_model_'.$siteid,'search');?>
						<ul class='options'>
							<li><a class='option' hidefocus='true' href="javascript:;" selectid="1">全部</a></li>
							<?php $n=1;if(is_array($search_model)) foreach($search_model AS $k=>$v) { ?>
							<li><a class='option' hidefocus='true' href="javascript:;" selectid="<?php echo $v['typeid'];?>"><?php echo $v['name'];?></a></li>
							<?php $n++;}unset($n); ?>
						</ul>
					</div><input type="text" id="search-wd" name="q" />-->
				<button type="submit" id="search-submit">搜 索</button>
				<!-- <button type='button' class="search-advance">高级搜索</button> -->
			</form>
	<!-- Nav -->
	<?php if(count($nav_arr)>0) { ?>
	<!-- 导航 -->
	<ul id="nav" class='nav fn-cb fn-clear'>
	<?php $n=1; if(is_array($nav_arr)) foreach($nav_arr AS $r => $v) { ?>
		<li class='nav-item <?php if($NAV[id] == id) { ?>nav-item-cur<?php } ?>'><a target='_blank' class='nav-item-link' href='<?php echo $v['url'];?>'><?php echo $v['name'];?></a></li>
	<?php $n++;}unset($n); ?>
	</ul>
	<?php } ?>
</div>
<!-- Header End -->