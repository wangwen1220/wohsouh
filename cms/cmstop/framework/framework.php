<?php
define('TIME', time());
defined('FW_PATH') or define('FW_PATH', dirname(__FILE__).DS);

set_include_path(get_include_path().PATH_SEPARATOR.FW_PATH);

require(FW_PATH.'loader.php');

import('core.object');
import('core.exception');
import('core.function');
import('core.config');
import('core.setting');
import('core.log');
import('core.tag');
import('core.observer');

import('core.model');
import('core.view');
import('core.controller');

import('factory');
import('env.request');
import('env.response');
import('filter.input');
import('filter.output');
import('form.form_element');
import('form.element');
import('helper.folder');
if (!class_exists('ZipArchive',false))
{
	import('helper.ZipArchive');
}

define('IP', request::get_clientip());
define('URL', request::get_url());

if (function_exists('set_magic_quotes_runtime'))
{
	set_magic_quotes_runtime(0);
}

if (function_exists('date_default_timezone_set'))
{
	$timezone = 'UTC';
	try {
		$timezone = config('config', 'timezone');
	}
	catch (Exception $e){}
	date_default_timezone_set($timezone);
}

filter::input();