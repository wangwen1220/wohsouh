<?php
//zhangchengjun 2010.11.02

if (!empty($_GET['id'])) {
	$_GET['myshowid'] = $_GET['id'];
}
$myshowid = empty($_GET['myshowid'])?0:intval($_GET['myshowid']);

$op = empty($_G['gp_op']) ? 'upload' : $_G['gp_op'];

set_time_limit(0);

if ($op == 'upload') {
		require DISCUZ_ROOT.'/config/config_other.php';
		require DISCUZ_ROOT.'/source/class/class_cftp.php';
		
		$dos = array('index', 'finish', 'info');
		$do = (!empty($_GET['do']) && in_array($_GET['do'], $dos))?$_GET['do']:'index';
	
		if ($do == 'finish') {
			$errNo = ! empty($_G['gp_err']) ? $_G['gp_err'] : 0;
			include template("home/spacecp_myshow");
		} elseif ($do == 'info') {
			if (isset($_POST['submitinfo'])) {
				$id = intval($_POST['myshowid']);
				$rs = DB::fetch_first("SELECT * FROM ".DB::table('video_list')." WHERE myshowid=$id");
				if (!empty($rs) && $rs['uid'] == $_G['uid']) {
					$data = $rs;
					$data['title'] = $_POST['title'];
					$data['classify'] = $_POST['classify'];
					$data['language'] = $_POST['language'];
					$data['lyricist'] = $_POST['lyricist'];
					$data['compose'] = $_POST['compose'];
					$data['singer'] = $_POST['singer'];
					$data['lyrics'] = $_POST['lyrics'];
					$data['content'] = $_POST['content'];
					$data['isfanart'] = empty($_POST['isfanart']) ? 0 : 1;
					
					DB::update('video_list', $data, "myshowid=$id");
				}
				header("location:home.php?mod=spacecp&ac=myshow&op=upload&do=finish");
			} else {
				$rs = DB::fetch_first("SELECT * FROM ".DB::table('video_list')." WHERE myshowid=$myshowid");
				if (!empty($rs)) {
					#分类
					$htmlType = '';
					$query = DB::query("SELECT * FROM ".DB::table('video_classify')." WHERE type_id=".$rs['type']);
					while ($type = DB::fetch($query)) {
						$htmlType .= '<option value="'.$type['id'].'">'.$type['name'].'</option>';
					}
					include template("home/spacecp_myshow");
				}
			}
		} else {
			if (isset($_POST['submitupload'])) {
				$from = isset($_POST['from']) ? $_POST['from'] : '';
				
				if (isset($_FILES['upload']) && $_FILES['upload']['error']==0) {
				
					$videoFormat = array('mpeg','avi','mp4','3gp','rm','rmvb','mov','flv','wmv');
					$audioFormat = $from=='admin' ? array() : array('mp3');
					
					$temp = explode('.', $_FILES['upload']['name']);
					$insert_format = strtolower(array_pop($temp));
					$insert_title = implode('.', $temp);
				
					$insert_type = 1;
					if (array_search($insert_format, $videoFormat) !== false) {
						$insert_type = 2;
					} elseif (array_search($insert_format, $audioFormat) !== false) {
						$insert_type = 1;
					} else {
						header("location:home.php?mod=spacecp&ac=myshow&op=upload&do=finish&err=1");//文件格式不正确！
					}
					
					$insert_uid = $_G['uid'];
					$insert_author = $_G['username'];
					$time = time();
					$insert_saveName = $time.'.'.$insert_format;
					$insert_videourl = $insert_uid.'/'.$insert_saveName;
				
				
					//--保存数据--------------------
					$source = $_FILES['upload']['tmp_name'];
					$target = $ftpConvertConfig['uploadDir'].$insert_videourl;
					$ftp = new cftp($ftpConvertConfig);
					
					$info = $ftp->upload($source, $target);#上传文件
					//--end
					
					$isrecord = $from=='admin' ? 3 : 2;
					if ($info) {	
						$data = array(
							'type'=>$insert_type,
							'videourl'=>$insert_videourl,
							'title'=>$insert_title,
							'classify'=>0,
							'language'=>1,
							'content'=>'',
							'lyricist'=>'',
							'compose'=>'',
							'singer'=>'',
							'lyrics'=>'',
							'isfanart'=>0,
							'uid'=>$insert_uid,
							'ip'=>$_SERVER['REMOTE_ADDR'],
							'author'=>$insert_author,
							'status'=>0,
							'dateline'=>$time,
							'format'=>$insert_format,
							'isrecord'=>$isrecord,
							'auditstatus'=>1
						);
				
						DB::insert('video_list', $data);
						$insertID = DB::insert_id();
						if ($from == 'admin') {
							echo '上传成功！<a href="admin.php?action=articlevideo">继续上传</a>   <a href="admin.php?action=articlevideo&operation=threads">查看上传列表</a>';
							die;
						} else {
							header("location:home.php?mod=spacecp&ac=myshow&op=upload&do=info&id=$insertID");
						}
					} else {
						header("location:home.php?mod=spacecp&ac=myshow&op=upload&do=finish&err=2");//上传转换服务器失败!
					}
				} else {
					switch($_FILES['upload']['error']) {
						case 1:
							header("location:home.php?mod=spacecp&ac=myshow&op=upload&do=finish&err=3");//上传的文件太大了，超过了允许的范围！
							break;
						case 2:
							header("location:home.php?mod=spacecp&ac=myshow&op=upload&do=finish&err=4");//要上传的文件大小超出浏览器限制！
							break;
						case 3:
							header("location:home.php?mod=spacecp&ac=myshow&op=upload&do=finish&err=5");//文件仅部分被上传！
							break;
						case 4:
							header("location:home.php?mod=spacecp&ac=myshow&op=upload&do=finish&err=6");//没有找到要上传的文件！
							break;
						case 5:
							header("location:home.php?mod=spacecp&ac=myshow&op=upload&do=finish&err=7");//服务器临时文件夹丢失！
							break;
						case 6:
							header("location:home.php?mod=spacecp&ac=myshow&op=upload&do=finish&err=8");//文件写入到临时文件夹出错！
						default:
							header("location:home.php?mod=spacecp&ac=myshow&op=upload&do=finish&err=9");//其他原因导致上传失败！
							break;
				    }
				}		
			} else {
				include template("home/spacecp_myshow");
			}
		}
} elseif ($op == 'record') {
		$dos = array('info', 'finish', 'audio', 'video');
		$do = (!empty($_GET['do']) && in_array($_GET['do'], $dos))?$_GET['do']:'info';
		
		if ($do == 'info') {//填写资料
			if (empty($_GET['type']) || empty($_GET['file'])) {
				header("location:home.php?mod=spacecp&ac=myshow&op=upload");
			}
			if (isset($_POST['submitinfo'])) {
				if (empty($_POST['clause'])) {
					showmessage(lang('home/template', 'myshow_clause_failed'), 'home.php?mod=spacecp&ac=myshow&op=record&do=info&type='.$_POST['typename'].'&file='.$_POST['file']);
				}
				
				$ip = $_SERVER["REMOTE_ADDR"];
				$time = time();
				$format = "flv";
				$filename = substr($_POST['file'], 5).".flv";
				
				$data = array(
					'type'=>$_POST['type'],
					'videourl'=>$filename,
					'title'=>$_POST['title'],
					'classify'=>$_POST['classify'],
					'language'=>$_POST['language'],
					'content'=>$_POST['content'],
					'lyricist'=>$_POST['lyricist'],
					'compose'=>$_POST['compose'],
					'singer'=>$_POST['singer'],
					'lyrics'=>$_POST['lyrics'],
					'isfanart'=>$_POST['isfanart'],
					'uid'=>$_G['uid'],
					'ip'=>$ip,
					'author'=>$_G['username'],
					'status'=>4,
					'dateline'=>$time,
					'format'=>$format,
					'isrecord'=>1,
					'auditstatus'=>1
				);
				DB::insert('video_list',$data);
				
				require DISCUZ_ROOT.'config/config_other.php';
				require DISCUZ_ROOT.'source/class/class_cftp.php';
				
				$ftp = new cftp($ftpResourceConfig[1]);
				$r = $ftp->connect();
				if ($r) {
					$ftp->ftp_mkdir($ftpResourceConfig[1]['recordDir'].$_G['uid']);
					$ftp->ftp_rename($ftpResourceConfig[1]['recordTempDir'].$filename, $ftpResourceConfig[1]['recordDir'].$_G['uid'].'/'.$filename);
					$ftp->ftp_close();
				}	
				header("location:home.php?mod=spacecp&ac=myshow&op=record&do=finish");		
			} else {
				$type = $_G['gp_type'];
				$file = $_G['gp_file'];
				
				//类型
				$typeId = ($type == 'video') ? 2 : 1;
				$classify = array();
				$query = DB::query("SELECT * FROM ".DB::table('video_classify')." WHERE type_id=$typeId");
				while ($rs = DB::fetch($query)) {
					$classify[] = $rs;
				}
				include template("home/spacecp_myshow");
			}	
		} elseif ($do == 'finish') {
			include template("home/spacecp_myshow");
		} elseif ($do == 'audio') {
			include template("home/spacecp_myshow");
		} elseif ($do == 'video') {
			include template("home/spacecp_myshow");
		}		
} elseif ($op == 'edit') {
	if (isset($_POST['editsubmit'])) {
		$data = array();
		$id = intval($_POST['myshowid']);
		if($_POST['title']){
			$data['title'] = $_POST['title'];
		}
		if($_POST['classify']){
			$data['classify'] = $_POST['classify'];
		}
		if($_POST['language']){
			$data['language'] = $_POST['language'];
		}
		if($_POST['content']){
			$data['content'] = $_POST['content'];
		}
		if($_POST['lyricist']){
			$data['lyricist'] = $_POST['lyricist'];
		}
		if($_POST['compose']){
			$data['compose'] = $_POST['compose'];
		}
		if($_POST['singer']){
			$data['singer'] = $_POST['singer'];
		}
		if($_POST['lyrics']){
			$data['lyrics'] = $_POST['lyrics'];
		}
		if($_POST['isfanart']){
			$data['isfanart'] = $_POST['isfanart'];
		}
		DB::update('video_list', $data, array('myshowid' => $_POST['myshowid'], 'uid'=>$_G['uid']));
		showmessage(lang('home/template', 'myshow_update_success'), 'home.php?mod=space&do=myshow&view=me');
	} else {
		$id = intval($_GET['id']);
		$myshowInfo = DB::fetch_first("SELECT * FROM ".DB::table('video_list')." WHERE myshowid=$id");
		if (!empty($myshowInfo)) {
			if (empty($myshowInfo['type'])) {
				$myshowInfo['type'] = 1;
			}
			$query = DB::query("SELECT * FROM ".DB::table('video_classify')." where type_id=".$myshowInfo['type']);
			while ($rs = DB::fetch($query)) {
				$classify[] = $rs;
			}
			include template("home/spacecp_myshow");
		} else {
			showmessage(lang("home/template",'myshow_no_exist'), '');
		}
	}
} elseif ($op == 'delete') {
	$id = intval($_GET['id']);
	$myshowInfo = DB::fetch_first("SELECT * FROM ".DB::table('video_list')." WHERE myshowid=".$id);

	if (!empty($myshowInfo)) {
		if ($_G['uid'] == $myshowInfo['uid'] || ($_G['group']['radminid'] == 1 || $_G['member']['allowadmincp'])) {//本人或者管理员
			DB::delete('video_list', array('myshowid'=>$id));
			#删除积分
			if ($myshowInfo['auditstatus']==2) {
				updatecreditbyaction('delmyshow', $myshowInfo['uid']);
			}
			
			require DISCUZ_ROOT.'config/config_other.php';
			require DISCUZ_ROOT.'source/class/class_cftp.php';
			
			$ftp = new cftp($ftpResourceConfig[1]);
			$r = $ftp->connect();
			if ($r) {
				if ($myshowInfo['isrecord']==1) {
					$ftp->ftp_delete($ftpResourceConfig[1]['recordDir'].$myshowInfo['videourl']);
				} else {
					$ftp->ftp_delete($ftpResourceConfig[1]['uploadDir'].$myshowInfo['videourl']);
				}
				$ftp->ftp_close();
			}			
			showmessage(lang('home/template', 'myshow_delete_success'), 'home.php?mod=space&do=myshow&view=me');
		}
	} else {
		showmessage(lang("home/template",'myshow_no_exist'), '');
	}
}
?>