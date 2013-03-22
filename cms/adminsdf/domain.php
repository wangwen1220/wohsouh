<?php

header('Content-Type:text/html;charset=utf-8');
set_time_limit(0);

define('CMSTOP_START_TIME', microtime(true));
define('RUN_CMSTOP', true);

if (file_exists('../cmstop/cmstop.php'))
{
    require '../cmstop/cmstop.php';
}
else
{
    die('请将该文件放在 ./admin/ 目录（后台）下');
}

// 要处理的文件
$files = array(
    IMG_PATH . 'js/config.js',
    CMSTOP_PATH . 'config/define.php'
);

// 要处理的数据库表和字段
$tables = array(
    'activity' => array('content'),
    'article' => array('content'),
    'category' => array('url'),
    'content' => array('url'),
    'psn' => array('url'),
    'related' => array('url'),
    'search' => array('content'),
    'section' => array('data'),
    'section_data' => array('url'),
    'setting' => array('value'),
    'template_clip' => array('code'),
    'video' => array('description'),
);

// 表前缀
$table_prefix = config('db', 'prefix');

// 删除自己
if (isset($_GET['action']) && $_GET['action'] == 'delete')
{
    @unlink(__FILE__);
    die('删除成功');
}

// 处理替换
if (isset($_POST['dosubmit']))
{
    $old = mysql_escape_string(trim($_POST['old']));
    $new = mysql_escape_string(trim($_POST['new']));
    
    $errors = array();

    if (_url($old) && _url($new))
    {
        foreach ($files as $file)
        {
            if (is_writable($file))
            {
                file_put_contents($file, str_replace($old, $new, @file_get_contents($file)));
            }
            else
            {
                $errors[] = '文件：' . $file . ' 不可写入，无法替换';
            }
        }

        $db = & factory::db();
        foreach ($tables as $table => $fields)
        {
            if (!$db->query("UPDATE `#table_$table` SET " . _sql($old, $new, $fields)))
            {
                $errors[] = "表：{$table_prefix}{$table} 替换失败，请手动替换";
            }
        }

        $db_cache = & factory::db_cache();
        $db_cache->set();

		import('helper.folder');
        folder::clear(CACHE_PATH.'templates'.DS);

        $setting = new setting();
	    $setting->cache();

        empty($errors) && $errors[] = '操作完成';
    }
    else
    {
        $errors[] = '旧域名和新域名都不能为空，且必须为有效的 URL';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>CmsTop 大众版域名更换工具</title>
    <style type="text/css">
	    html{background:#f9f9f9;}body{background:#fff;color:#333;font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;margin:2em auto;width:700px;padding:1em 2em;-moz-border-radius:11px;-khtml-border-radius:11px;-webkit-border-radius:11px;border-radius:11px;border:1px solid #dfdfdf;}a{color:#2583ad;text-decoration:none;}a:hover{color:#d54e21;}h1{border-bottom:1px solid #dadada;clear:both;color:#666;font:24px Georgia,"Times New Roman",Times,serif;margin:5px 0 0 -4px;padding:0;padding-bottom:7px;}h2{font-size:16px;}p,li,dd,dt{padding-bottom:2px;font-size:12px;line-height:18px;}code,.code{font-size:13px;}ul,ol,dl{padding:5px 5px 5px 22px;}a img{border:0;}abbr{border:0;font-variant:normal;}#logo{margin:6px 0 14px 0;border-bottom:none;text-align:center;}.step{margin:20px 0 15px;}.step,th{text-align:left;padding:0;}.submit input,.button,.button-secondary{font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif;text-decoration:none;font-size:14px!important;line-height:16px;padding:6px 12px;cursor:pointer;border:1px solid #bbb;color:#464646;-moz-border-radius:15px;-khtml-border-radius:15px;-webkit-border-radius:15px;border-radius:15px;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;-khtml-box-sizing:content-box;box-sizing:content-box;}.button:hover,.button-secondary:hover,.submit input:hover{color:#000;border-color:#666;}.button,.submit input,.button-secondary{background:#f2f2f2 url(../images/white-grad.png) repeat-x scroll left top;}.button:active,.submit input:active,.button-secondary:active{background:#eee url(../images/white-grad-active.png) repeat-x scroll left top;}textarea{border:1px solid #bbb;-moz-border-radius:4px;-khtml-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;}.form-table{border-collapse:collapse;margin-top:1em;width:100%;}.form-table td{margin-bottom:9px;padding:10px;border-bottom:8px solid #fff;font-size:12px;}.form-table th{font-size:13px;text-align:left;padding:16px 10px 10px 10px;border-bottom:8px solid #fff;width:130px;vertical-align:top;}.form-table tr{background:#f3f3f3;}.form-table code{line-height:18px;font-size:18px;}.form-table p{margin:4px 0 0 0;font-size:11px;}.form-table input{line-height:20px;font-size:15px;padding:2px;}.form-table th p{font-weight:normal;}#error-page{margin-top:50px;}#error-page p{font-size:12px;line-height:18px;margin:25px 0 20px;}#error-page code,.code{font-family:Consolas,Monaco,Courier,monospace;}#pass-strength-result{background-color:#eee;border-color:#ddd!important;border-style:solid;border-width:1px;margin:5px 5px 5px 1px;padding:5px;text-align:center;width:200px;}#pass-strength-result.bad{background-color:#ffb78c;border-color:#ff853c!important;}#pass-strength-result.good{background-color:#ffec8b;border-color:#fc0!important;}#pass-strength-result.short{background-color:#ffa0a0;border-color:#f04040!important;}#pass-strength-result.strong{background-color:#c3ff88;border-color:#8dff1c!important;}.message{border:1px solid #e6db55;padding:.3em .6em;margin:5px 0 15px;background-color:#ffffe0;}
        p.right {text-align:right;}
        input.text {font-size: 24px; width: 97%; padding: 3px; margin-top: 2px; margin-right: 6px; margin-bottom: 16px; border: 1px solid #e5e5e5; background: #fbfbfb;}
        .button {-moz-border-radius:11px 11px 11px 11px; border:1px solid; cursor:pointer; font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif; font-size:12px; margin-top:-3px; padding:3px 10px; text-decoration:none; background:url("../images/button-grad.png") repeat-x scroll left top #21759B; border-color:#298CBA; color:#FFFFFF; font-weight:bold; text-shadow:0 -1px 0 rgba(0, 0, 0, 0.3);}
    </style>
</head>
<body>
    <h1>CmsTop 大众版域名更换工具</h1>
    <br />
    <p>本工具用于帮助站长完成网站更换域名后的一系列工作，<span style="color:red;">如果数据库里面已有数据，请务必在替换操作前备份程序和数据库</span></p>
    <p style="color:gray;">未做批处理，如果数据量过大，请考虑直接在 Shell 里面运行 SQL 语句。</p>
    <br />
    <h2>替换</h2>
    <?php if (!empty($errors)) { foreach ($errors as $error) { ?>
    <p class="message"><?php echo $error; ?></p>
    <?php } } ?>
    <form action="" method="POST" style="width:300px;">
        <div>
            <p><label>旧域名 <input class="text" type="text" name="old" value="<?php echo $_POST['old']; ?>" /></label></p>
            <p><label>新域名 <input class="text" type="text" name="new" value="<?php echo $_POST['new']; ?>" /></label></p>
            <p class="right"><input onclick="return confirm('开始替换吗？\n\n请确认填写了正确的信息\n如果数据量很大，替换可能需要较长时间，请耐心等待');" class="button" type="submit" name="dosubmit" value="开始" /></p>
            <p style="word-break:keep-all; word-wrap:break-word;">同时会替换数据库表：<br /><?php foreach ($tables as $table => $fields): echo $table_prefix . $table . ',&nbsp;'; endforeach; ?></p>
        </div>
    </form>
    <br />
    <p class="right"><a onclick="return confirm('确定要删除该文件吗？');" href="?action=delete" title="由于本文件未做权限验证，保留本文件将会有安全隐患，建议删除">删除该文件</a></p>

    <div style="margin-top:10px; text-align:center;">
        <p>&copy; <?php echo date('Y'); ?>, <a href="http://www.cmstop.com/">北京思拓合众科技有限公司</a></p>
    </div>
</body>
</html>
<?php

function _url($param)
{
    return preg_match('#^(?:http|https)://#', $param);
}

function _sql($old, $new, $fields)
{
    $sql = '';
    foreach ($fields as $field)
    {
        $sql .= "`$field` = REPLACE(`$field`, '$old', '$new'), ";
    }
    return rtrim($sql, ' ,');
}
?>