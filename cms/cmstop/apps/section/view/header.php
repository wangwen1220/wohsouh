<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$head['title']?></title>
<link rel="stylesheet" type="text/css" href="css/admin.css"/>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/jquery.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/config.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/cmstop.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo IMG_URL?>js/lib/validator/style.css"/>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.validator.js"></script>

<link rel="stylesheet" type="text/css" href="<?=IMG_URL?>js/lib/jquery-ui/dialog.css" />
<script type="text/javascript" src="<?=IMG_URL?>js/lib/jquery.ui.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.dialog.js"></script>

<script type="text/javascript" src="<?=IMG_URL?>js/datepicker/WdatePicker.js"></script>

<script type="text/javascript" src="<?=IMG_URL?>js/lib/jquery.uploadify.js"></script>
<script type="text/javascript" src="<?=IMG_URL?>js/lib/cmstop.filemanager.js"></script>

<link rel="stylesheet" type="text/css" href="apps/section/css/section.css" />
<script type="text/javascript">
$.validate.setConfigs({
    xmlPath:'<?=ADMIN_URL?>apps/section/validators/'
});
$(ct.listenAjax);
</script>
</head>