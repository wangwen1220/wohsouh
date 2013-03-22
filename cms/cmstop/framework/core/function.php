<?php
function htmlspecialchars_deep($string)
{
	return is_array($string) ? array_map('htmlspecialchars_deep', $string) : htmlspecialchars($string, ENT_QUOTES);
}

function addslashes_deep($string)
{
	return is_array($string) ? array_map('addslashes_deep', $string) : addslashes($string);
}

function new_addslashes($string)
{
	if(!is_array($string)) return addslashes($string);
	foreach($string as $key => $val) $string[$key] = new_addslashes($val);
	return $string;
}

function addslashes_deep_obj($obj)
{
    if (is_object($obj))
    {
        foreach ($obj as $key => $val)
        {
            $obj->$key = addslashes_deep($val);
        }
    }
    else
    {
        $obj = addslashes_deep($obj);
    }
    return $obj;
}

function stripslashes_deep($string)
{
	return is_array($string) ? array_map('stripslashes_deep', $string) : stripslashes($string);
}

function js_format($string)
{ 
	return addslashes(str_replace(array("\r", "\n"), array('', ''), $string));
}

function text_format($string)
{
	return nl2br(str_replace(' ', '&nbsp;', htmlspecialchars($string)));
}

function id_format($id)
{
	if (is_numeric($id)) return $id;
	if (is_array($id)) return array_filter($id, 'is_numeric');
	if (strpos($id, ',') !== false) return preg_match("/^([\d]+,)+$/", $id.',') ? explode(',', $id) : false;
    return false;
}

function str_charset($in_charset, $out_charset, $str_or_arr)
{
	$lang = array(&$in_charset, &$out_charset);
	foreach ($lang as &$l)
	{
		switch (strtolower(substr($l, 0, 2)))
		{
			case 'gb': $l = 'gbk';
			break;
			case 'bi': $l = 'big5';
			break;
			case 'ut': $l = 'utf-8';
			break;
		}
	}
		
	if(is_array($str_or_arr))
	{
		foreach($str_or_arr as &$v)
		{
			$v = str_charset($in_charset, $out_charset, $v);
		}
	}
	else
	{
		$str_or_arr = iconv($in_charset, $out_charset, $str_or_arr);
	}
	return $str_or_arr;
}

if(!function_exists('fputcsv'))
{
	function fputcsv(&$fp, $array, $delimiter = ',', $enclosure = '"')
	{
		$data = $enclosure.implode($enclosure.$delimiter.$enclosure, $array).$enclosure."\n";
		return fwrite($fp, $data);
	}
}

function random($length, $chars = '0123456789')
{
	$hash = '';
	$max = strlen($chars) - 1;
	for($i = 0; $i < $length; $i++)
	{
		$hash .= $chars[mt_rand(0, $max)];
	}
	return $hash;
}

function fileext($filename)
{
	return pathinfo($filename, PATHINFO_EXTENSION);
}

function implode_ids($array, $s = ',')
{
	if(empty($array)) return '';
	return is_array($array) ? implode($s, $array) : $array;
}

function words_count($string, $charset = 'utf-8')
{
	$string = strip_tags($string);
	$en_count = preg_match_all("/([[:alnum:]]|[[:punct:]])+/", $string, $matches);
	$string = preg_replace("/([[:alnum:]]|[[:space:]]|[[:punct:]])+/", '', $string);
	$zh_count = mb_strlen($string, $charset);
	$count = $en_count + $zh_count;
	return $count;
}

function size_format($size)
{
	$decimals = 0;
	$suffix = '';
	switch (true)
	{
	case $size >= 1073741824:
		$decimals = 2;
		$size = round($size / 1073741824 * 100) / 100;
		$suffix = 'GB';
		break;
	case $size >= 1048576:
		$decimals = 2;
		$size = round($size / 1048576 * 100) / 100;
		$suffix = 'MB';
		break;
	case $size >= 1024:
		$decimals = 2;
		$size = round($size / 1024 * 100) / 100;
		$suffix = 'KB';
		break;
	default:
		$decimals = 0;
		$suffix = 'B';
	}
	return number_format($size, $decimals) . $suffix;
}
function str_cutword($string,$length=80,$charset="utf-8",$etc='...')
{
		$start = 0;
		if (function_exists ("mb_substr" ))
			return mb_substr ( $string, $start, $length, $charset );
		$re ['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		$re ['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		$re ['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		$re ['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		preg_match_all ( $re [$charset], $string, $match );
		$slice = join ( "", array_slice ( $match [0], $start, $length ) );
		
		return $slice.$etc;
}

function time_format($time, $format = 'Y年n月j日 G:i:s', $second = false)
{
	$diff = TIME - $time;
	if ($diff < 60 && $second)
	{
		return $diff.'秒前';
	}
	$diff = ceil($diff/60);
	if ($diff < 60)
	{
		return $diff.'分钟前';
	}
	$d = date('Y,n,j', TIME);
	list($year, $month, $day) = explode(',', $d);
	$today = mktime(0, 0, 0, $month, $day, $year);
	$diff = ($time-$today) / 86400;
	switch (true)
	{
		case $diff < -2:
			break;
		case $diff < -1:
			$format = '前天 '.($second ? 'G:i:s' : 'G:i');
			break;
		case $diff < 0:
			$format = '昨天 '.($second ? 'G:i:s' : 'G:i');
			break;
		default:
			$format = '今天 '.($second ? 'G:i:s' : 'G:i');
	}
	return date($format, $time);
}
function str_cut($string, $length, $dot = '...', $charset = 'utf-8')
{
	$strlen = strlen($string);
	if($strlen <= $length) return $string;
	$specialchars = array('&amp;', '&quot;', '&#039;', '&lt;', '&gt;');
	$entities = array('&', '"', "'", '<', '>');
	$string = str_replace($specialchars, $entities, $string);
	$strcut = '';
	if(strtolower($charset) == 'utf-8')
	{
		$n = $tn = $noc = 0;
		while($n < $strlen)
		{
			$t = ord($string[$n]);
			if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
				$tn = 1; $n++; $noc++;
			} elseif(194 <= $t && $t <= 223) {
				$tn = 2; $n += 2; $noc += 2;
			} elseif(224 <= $t && $t < 239) {
				$tn = 3; $n += 3; $noc += 2;
			} elseif(240 <= $t && $t <= 247) {
				$tn = 4; $n += 4; $noc += 2;
			} elseif(248 <= $t && $t <= 251) {
				$tn = 5; $n += 5; $noc += 2;
			} elseif($t == 252 || $t == 253) {
				$tn = 6; $n += 6; $noc += 2;
			} else {
				$n++;
			}
			if($noc >= $length) break;
		}
		if($noc > $length) $n -= $tn;
		$strcut = substr($string, 0, $n);
	}
	else
	{
		$dotlen = strlen($dot);
		$maxi = $length - $dotlen - 1;
		for($i = 0; $i < $maxi; $i++)
		{
			$strcut .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
		}
	}
	return $strcut.$dot;
}

function thumb($img, $width, $height, $is_abs = 1, $default = null)
{
	if(empty($img)) return is_null($default) ? IMG_URL.'images/nopic.gif' : $default;
	if(!extension_loaded('gd')) return $img;
	if (preg_match("/^(".preg_quote(UPLOAD_URL, '/')."|".preg_quote(UPLOAD_PATH, '/').")(.*)$/", $img, $matches)) $img = $matches[2];
	if (strpos($img, '://') || !file_exists(UPLOAD_PATH.$img)) return $img;
	$newimg = dirname($img).'/thumb_'.$width.'_'.$height.'_'.basename($img);
	if(!file_exists(UPLOAD_PATH.$newimg))
	{
		$image = & factory::image();
		$image->set_thumb($width, $height, 100);
		$newimg = $image->thumb(UPLOAD_PATH.$img, UPLOAD_PATH.$newimg) ? $newimg : $img;
	}
	if ($is_abs) $newimg = UPLOAD_URL.$newimg;
	return $newimg;
}

function str_encode($string, $key)
{
	$code = '';
	$keylen = strlen($key);
	$strlen = strlen($string);
	for ($i=0; $i<$strlen; $i++) 
	{
		$k = $i % $keylen;
		$code .= $string[$i] ^ $key[$k];
	}
	return base64_encode($code);
}

function str_decode($string, $key)
{
	$string = base64_decode($string);
	$code = '';
	$keylen = strlen($key); 
	$strlen = strlen($string);
	for ($i=0; $i<$strlen; $i++)
	{
		$k = $i % $keylen;
		$code .= $string[$i] ^ $key[$k];
	}
	return $code;
}

function escape($str, $charset = 'utf-8')
{
	preg_match_all("/[\x80-\xff].|[\x01-\x7f]+/", $str, $r);
	$ar = $r[0];
	foreach($ar as $k=>$v)
	{
		$ar[$k] = ord($v[0]) < 128 ? rawurlencode($v) : '%u'.bin2hex(iconv($charset, 'UCS-2', $v));
	}
	return join('', $ar);
}

function unescape($str, $charset = 'utf-8')
{
	$str = rawurldecode($str);
	$str = preg_replace("/\%u([0-9A-Z]{4})/es", "iconv('UCS-2', '$charset', pack('H4', '$1'))", $str);
    return $str;
}

function format_dir($dir)
{
	return rtrim(str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $dir), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
}

function format_url($url)
{
	return str_replace("\\", "/", $url);
}
	
function output($data)
{
	$strlen = strlen($data);
	if (isset($_SERVER['HTTP_ACCEPT_ENCODING']) && $strlen > 255 && extension_loaded('zlib') && !ini_get('zlib.output_compression') && ini_get('output_handler') != 'ob_gzhandler')
	{
		$data = gzencode($data, 4);
		$strlen = strlen($data);
		header('Content-Encoding: gzip');
		header('Vary: Accept-Encoding');
	}
 	header('X-Powered-By: CMSTOP/1.0.0');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
	header('ETag: "'.$strlen.'-'.time().'"');
	header('Accept-Ranges: bytes');
	return $data;
}

function config($file, $key = null, $default = null)
{
	return config::get($file, $key, $default);
}

function setting($app, $var = null)
{
	return setting::get($app, $var);
}

function table($table, $id = null, $field = null)
{
	$db_cache = & factory::db_cache();
	
	if ($db_cache->is_cache($table))
	{
		if (strpos($field, ',') !== false) $field = null;
		return $db_cache->get($table, $id, $field);
	}
	else 
	{
		if (is_null($id))
		{
			static $result;
			if (!isset($result[$table]))
			{
				$array = array();
				$db = & factory::db();
				$primary = $db->get_primary('#table_'.$table);
				$fields = is_null($field) ? '*' : (strpos($field, $primary) === false ? $primary.','.$field : $field);
				
				$data = $db->select("SELECT $fields FROM `#table_$table` ORDER BY `$primary`");
				if (is_array($data))
				{
					foreach ($data as $k=>$v)
					{
						if (!isset($v[$primary])) break;
						$key = $v[$primary];
						$array[$key] = $v;
					}
				}
				$result[$table] = $array;
			}
			return $result[$table];
		}
		else 
		{
			static $row;
			$key = $table.'_'.$id;
			if (!isset($row[$key]))
			{
				$db = & factory::db();
				$primary = $db->get_primary('#table_'.$table);
				$row[$key] = $db->get("SELECT * FROM `#table_$table` WHERE `$primary`=?", array($id));
			}
			return (is_null($field) && !isset($row[$key][$field])) ? $row[$key] : $row[$key][$field];
		}
	}
}

function url($aca, $params = null, $is_full = false)
{
	$router = & factory::router();
	return $router->url($aca, $params, $is_full);
}

function url_query($url, $query = array(), $mode = false)
{
	if ($query)
	{
		$data = parse_url($url);
		if (!$data) return false;
		if (isset($data['query']))
		{
			parse_str($data['query'], $q);
			$query = array_merge($q, $query);
		}
		$data['query'] = http_build_query($query);
		$url = http_build_url($data, $mode);
	}
	return $url;
}

function http_build_url($data, $mode = false)
{
	if (!is_array($data)) return false;
	$url = isset($data['scheme']) ? $data['scheme'].'://' : '';
	if (isset($data['user'])) $url .= $data['user'];
	if (isset($data['pass'])) $url .= ':'.$data['pass'];
	if (isset($data['user'])) $url .= '@';
	if (isset($data['host'])) $url .= $data['host'];
	if (isset($data['port'])) $url .= ':'.$data['port'];
	if (isset($data['path'])) $url .= $data['path'];
	if (isset($data['query'])) $url .= '?'.($mode ? str_replace('&', '&amp;', $data['query']) : $data['query']);
	if (isset($data['fragment'])) $url .= '#'.$data['fragment'];
	return $url;
}

function pages($total, $page = 1, $pagesize = 20, $offset = 2, $url = null, $mode = false)
{
	if($total <= $pagesize) return '';
	$page = max(intval($page), 1);
	$pages = ceil($total/$pagesize);
	$page = min($pages, $page);
	$prepage = max($page-1, 1);
	$nextpage = min($page+1, $pages);
	$from = max($page - $offset, 2);
	if ($pages - $page - $offset < 1) $from = max($pages - $offset*2 - 1, 2);
	$to = min($page + $offset, $pages-1);
	if ($page - $offset < 2) $to = min($offset*2+2, $pages-1);
	$more = 1;
	if ($pages <= ($offset*2+5))
	{
		$from = 2;
		$to = $pages - 1;
		$more = 0;
	}
	$str = '';
	$str .= '<li><a href="'.pages_url($url, $prepage, $mode).'">上一页</a></li>';
	$str .= $page == 1 ? '<li><a href="'.pages_url($url, 1, $mode).'" class="now">1</a></li>' : '<li><a href="'.pages_url($url, 1, $mode).'">1'.($from > 2 && $more ? '...' : '').'</a></li>';
	if ($to >= $from)
	{
		for($i = $from; $i <= $to; $i++)
		{
			$str .= $i == $page ? '<li><a href="'.pages_url($url, $i, $mode).'" class="now">'.$i.'</a></li>' : '<li><a href="'.pages_url($url, $i, $mode).'">'.$i.'</a></li>';
		}
	}
	$str .= $page == $pages ? '<li><a href="'.pages_url($url, $pages, $mode).'" class="now">'.$pages.'</a></li>' : '<li><a href="'.pages_url($url, $pages, $mode).'">'.($to < $pages-1 && $more ? '...' : '').$pages.'</a></li>';
	$str .= '<li><a href="'.pages_url($url, $nextpage, $mode).'">下一页</a></li>';
	return $str;
}

function pages_url($url, $page, $mode = false)
{
	if (!$url) $url = URL;
	if (strpos($url, '$page') === false)
	{
		$url = url_query($url, array('page'=>$page), $mode);
	}
	else 
	{
		eval("\$url = \"$url\";");
	}
	return $url;
}

function where_mintime($field, $mintime)
{
	if (!$mintime) return ;
	$mintime = trim($mintime);
	if (!is_numeric($mintime))
	{
		if (strlen($mintime) == 10) $mintime .= ' 00:00:00';
		$mintime = strtotime($mintime);
	}
	$where = "$field>=$mintime";
	return $where;
}

function where_maxtime($field, $maxtime)
{
	if (!$maxtime) return ;
	$maxtime = trim($maxtime);
	if (!is_numeric($maxtime))
	{
		if (strlen($maxtime) == 10) $maxtime .= ' 23:59:59';
		$maxtime = strtotime($maxtime);
	}
	$where = "$field<=$maxtime";
	return $where;
}

function where_keywords($field, $keywords)
{
	$keywords = trim($keywords);
	if ($keywords === '') return ;
	$keywords = preg_replace("/\s+/", '%', $keywords);
	$where = "$field LIKE '%$keywords%'";
	return $where;
}

function cache_read($file, $path = null, $iscachevar = 0)
{
	if(!$path) $path = CACHE_PATH;
	$cachefile = $path.$file;
	if($iscachevar)
	{
		global $TEMP;
		$key = 'cache_'.substr($file, 0, -4);
		return isset($TEMP[$key]) ? $TEMP[$key] : $TEMP[$key] = @include $cachefile;
	}
	return @include $cachefile;
}

function cache_write($file, $array, $path = null)
{
	if(!is_array($array)) return false;
	$array = "<?php\nreturn ".var_export($array, true).";";
	$cachefile = ($path ? $path : CACHE_PATH).$file;
	$cachedir = dirname($cachefile);
	if (!is_dir($cachedir)) folder::create($cachedir);
	$strlen = file_put_contents($cachefile, $array);
	@chmod($cachefile, 0774);
	return $strlen;
}

function cache_delete($file, $path = '')
{
	$cachefile = ($path ? $path : CACHE_PATH).$file;
	return @unlink($cachefile);
}

function php_error_log($errno, $errmsg, $filename, $linenum, $vars)
{
	$filename = str_replace(ROOT_PATH, '.', $filename);
	$filename = str_replace("\\", '/', $filename);
	if(!defined('E_STRICT')) define('E_STRICT', 2048);
	$dt = date('Y-m-d H:i:s');
	$errortype = array (
	E_ERROR           => 'Error',
	E_WARNING         => 'Warning',
	E_PARSE           => 'Parsing Error',
	E_NOTICE          => 'Notice',
	E_CORE_ERROR      => 'Core Error',
	E_CORE_WARNING    => 'Core Warning',
	E_COMPILE_ERROR   => 'Compile Error',
	E_COMPILE_WARNING => 'Compile Warning',
	E_USER_ERROR      => 'User Error',
	E_USER_WARNING    => 'User Warning',
	E_USER_NOTICE     => 'User Notice',
	E_STRICT          => 'Runtime Notice'
	);
	$user_errors = array(E_USER_ERROR, E_USER_WARNING, E_USER_NOTICE);
	$err = "<errorentry>\n";
	$err .= "\t<datetime>" . $dt . "</datetime>\n";
	$err .= "\t<errornum>" . $errno . "</errornum>\n";
	$err .= "\t<errortype>" . $errortype[$errno] . "</errortype>\n";
	$err .= "\t<errormsg>" . $errmsg . "</errormsg>\n";
	$err .= "\t<scriptname>" . $filename . "</scriptname>\n";
	$err .= "\t<scriptlinenum>" . $linenum . "</scriptlinenum>\n";
	if (in_array($errno, $user_errors))
	{
		$err .= "\t<vartrace>" . wddx_serialize_value($vars, "Variables") . "</vartrace>\n";
	}
	$err .= "</errorentry>\n\n";
	$logfile = ROOT_PATH.'data/logs/'.date('Y-m-d').'.xml';
	@error_log($err, 3, $logfile);
	@chmod($logfile, 0777);
}

// for debug
function console($message)
{
	static $fb = null;
	if ($fb == null)
	{
		loader::import('helper.firephp');
		$fb = FirePHP::getInstance(true);
	}
    $fb->info($message);
}