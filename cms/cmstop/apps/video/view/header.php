<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$CONFIG['charset']?>" />
<title><?=$head['title']?></title>
<link rel="stylesheet" type="text/css" href="css/admin.css"/>
<link rel="stylesheet" type="text/css" href="<?=IMG_URL?>js/lib/jquery-ui/dialog.css" />
<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/validator/style.css"/>
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.js"></script>
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo IMG_URL?>js/config.js"></script>
<script type="text/javascript" src="<?php echo IMG_URL?>js/cmstop.js"></script>
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.validator.js"></script>
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/cmstop.dialog.js"></script>
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.cookie.js"></script>
<link href="<?=IMG_URL?>js/lib/treeview/treeview.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo IMG_URL?>js/lib/jquery.treeview.js"></script>

<script type="text/javascript" src="<?=IMG_URL?>js/datepicker/WdatePicker.js"></script>
<!--start 视频-->
<script type="text/javascript" src="apps/video/js/video.js"></script>

<!--end 视频-->
<!--start 上传缩略图 -->
<script type="text/javascript" src="<?=IMG_URL?>js/lib/jquery.uploadify.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.filemanager.js"></script>
<!--end 上传缩略图 -->

<script type="text/javascript">
var app = '<?=$app?>';
var controller = '<?=$controller?>';
var action = '<?=$action?>';
var catid = '<?=$catid?>';
var modelid = '<?=$modelid?>';
var contentid = '<?=$contentid?>';
</script>
<script type="text/javascript" src="apps/system/js/content.js"></script>

<script type="text/javascript">
$.validate.setConfigs({
    xmlPath:'apps/<?=$app?>/validators/'
});
$(function(){
    ct.listenAjax();
});

</script>
</head>
<body>