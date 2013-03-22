
/*
* 海量帖子净化插件的配置文件
* 可根据需要进行适当的配置
*/

<? if( !defined('IN_DISCUZ')) exit('Access Denied'); ?>

#本插件的版本号
$Purify_PLUGIN_VERSION = '2.1.0';

########-以下配置需要人工修改-########

#客户唯一标识，注册海量公司“保10洁”服务后系统分配，请谨慎更改
[$]Purify_APP_ID = <?php echo $Purify_CONFIG['APP_ID']?>; 

#客户序列号，注册海量公司“保10洁”服务后系统分配，请谨慎更改
[$]Purify_APP_KEY = '<?php echo $Purify_CONFIG['APP_KEY']?>';

#论坛访问web根目录全路径
[$]Purify_BBS_ROOT = '<?php echo $Purify_CONFIG['BBS_ROOT']?>';

#对接保10洁服务的客户端类型标识
[$]Purify_APP_TYPE = '<?php echo $Purify_CONFIG['APP_TYPE']?>';

#海量公司“保10洁”服务的净化接口地址，请谨慎更改
[$]Purify_PREDICT_API = '<?php echo $Purify_CONFIG['PREDICT_API']?>';

#海量公司“保10洁”服务的反馈接口地址，请谨慎更改
[$]Purify_FEEDBACK_API = '<?php echo $Purify_CONFIG['FEEDBACK_API']?>';


########-以下配置由系统默认设置，一般不需人工修改。修改前请理解每个配置项的含义-########

#该插件调用接口前的停留时间，不可以为0，单位：秒
[$]Purify_LAG_SHOWTIME = <?php echo $Purify_CONFIG['LAG_SHOWTIME']?>;

#该插件调用接口时的最大延迟时间，当大于这个时间时，插件放弃等待接口。一般为10秒钟，单位：秒
[$]Purify_HTTP_DELAYTIME = <?php echo $Purify_CONFIG['HTTP_DELAYTIME']?>;

#小于N个字符后，将不提交数据
[$]Purify_SEND_StrNum = <?php echo $Purify_CONFIG['SEND_StrNum']?>;

#设定的对失败的数据的重发次数,建议在5－99之间
[$]Purify_CRONTAB_TIMES = <?php echo $Purify_CONFIG['CRONTAB_TIMES']?>;

#是否更新论坛首页上，版块列表里显示的最新帖子内容
[$]Purify_UPDATE_INDEX = <?php echo $Purify_CONFIG['UPDATE_INDEX']?>;

#置顶贴是否发送
[$]Purify_SEND_TOP = <?php echo $Purify_CONFIG['SEND_TOP']?>;

#日志级别，0:关闭;1:正常;2:调试
[$]Purify_LOG_LEVEL = <?php echo $Purify_CONFIG['LOG_LEVEL']?>;

#该插件对垃圾帖子采用的过滤方式：invisible(前台帖子列表中直接删除)，status(前台帖子列表中显示‘屏蔽’字样)。两种方式，在数据库中都未进行物理删除
[$]Purify_PURIFY_FIELD = '<?php echo $Purify_CONFIG['PURIFY_FIELD']?>';

#单个处理脚本等待超时时间,单位:秒
[$]Purify_TIME_LIMIT = <?php echo $Purify_CONFIG['TIME_LIMIT']?>;

#每次查询抛出的标引处理脚本的数量
[$]Purify_CALL_NUM = <?php echo $Purify_CONFIG['CALL_NUM']?>;

#是否启用分表功能,默认为不启用
[$]Purify_MULTI_POST = <?php echo $Purify_CONFIG['MULTI_POST']?>;

#连接失败重试次数
[$]Purify_TRY_NUM = <?php echo $Purify_CONFIG['TRY_NUM']?>;

#审核页面分页方式,0:简单不统计方式;1:详细统计方式(针对7.x及以下版本使用)
[$]Purify_FEEDBACK_PAGE = <?php echo $Purify_CONFIG['FEEDBACK_PAGE']?>;

########-包含扩展配置项-########
if(file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config_ext.inc.php')){
	require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config_ext.inc.php';
}
