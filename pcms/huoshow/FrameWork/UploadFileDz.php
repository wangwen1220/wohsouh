<?
		define('IN_INTER', true);
		define('SYSTEM_PATH', dirname(__FILE__). 'upload_dz/Lib');
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/configs/config.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/upload_dz/Lib/common.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/upload_dz/Lib/config.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/upload_dz/Lib/Controller/Base.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/upload_dz/Lib/Controller/AvatarFlashUpload.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/upload_dz/Lib/Inter/Error.php");
/**
 * 从dz中抽出来的flash上传类，支持摄像头拍照上传
 * 必须关联uid(用户ID)
 *
 */
class UploadFileDz
{
	private $mConfig;
	private $mAvatardir;
	private $mBasePath = null;
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $avatardir	上传的文件存放的目录
	 * @param unknown_type $uid			用户ID
	 */
	public function __construct($avatardir,$uid)
	{
		global $SYSCONFIG;

		$this->mBasePath = realpath(dirname(__FILE__)."/../upload_files/upload_dzflash/");
		$this->mConfig = array(
			    'tmpdir' => $this->mBasePath.'tempUpload',           //临时文件夹（相对于本文件的位置而言）。开头和结尾请不要加反斜杆
			    'avatardir' => $this->mBasePath.$avatardir,        //存储头像的文件夹（相对于本文件的位置而言），开头和结尾请不要加反斜杆
				//'tmpdir' => 'tempUpload',           //临时文件夹（相对于本文件的位置而言）。开头和结尾请不要加反斜杆
			    //'avatardir' => 'customavatars',        //存储头像的文件夹（相对于本文件的位置而言），开头和结尾请不要加反斜杆
				
			    'authkey' => 'huoshowwer',          //通讯密钥，必须填写，否则脚本无法运行！
			    'uid'=>$uid,
			    'debug' => true,    //开启debug记录？
			    'uploadsize' => 1024,   //上传图片文件的最大值，单位是KB
			    'uc_api' => "http://".$SYSCONFIG["SpaceSiteRoot"].'/huoshow',          //运行该脚本的网址，末尾请不要加反斜杠（比如http://www.aaa.com/uc_avatar_upload）。详情请看说明
			    'imgtype' => array(1 => '.gif', 2 => '.jpg', 3 => '.png'),        //允许上传的类型，请勿修改此处设置，否则会引起安全隐患问题！
			);
		//错误调试区
		if( true === $this->mConfig['debug'] ){
			//var_dump("sdfsfd");
		    set_exception_handler(array('Inter_Error', 'exception_handler'));
		    set_error_handler(array('Inter_Error', 'error_handler'), E_ALL);
		    Inter_Error::$conf['debugMode'] = true;
		    Inter_Error::$conf['logType'] = 'simple';
		    Inter_Error::$conf['logDir'] = $this->mBasePath.'Log';
		    //Inter_Error::$conf['logDir'] = 'R:\TEMP';
		}else{
		    error_reporting(0);
		}
		$this->mAvatardir = $this->mBasePath.$avatardir;
	}
	
	public function process()
	{
		
		if( !isset($_GET['a']) || empty($_GET['a']) || !is_string($_GET['a']) )
		{
		    $action = 'showuploadAction';
		}else
		{
		    $action = $_GET['a']. 'Action';
		    
		}
		
		$controller = new Controller_AvatarFlashUpload();
		//var_dump($controller);
		$controller->config->set($this->mConfig);
		
		//如果没有设置则自动生成运行该脚本的网址（不含脚本名称）
		if( empty($controller->config->uc_api) )
		{
		    $controller->config->uc_api = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http' ). 
		                                  '://'. 
		                                  /* $_SERVER['HTTP_HOST'].  */
		                                  ( isset($_SERVER['HTTP_X_FORWARDED_HOST']) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') ). 
		                                  substr( $_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/') );
		}
		//var_dump($controller->config->uc_api);
		if(method_exists($controller, $action))
		{
		    $result = $controller->$action();
		    if(is_array($result)){
		        echo json_encode($result);
		    }else{
		        echo $result;
		    }
		}else{
		    exit('NO ACTION FOUND!');
		}
	}
}
?>