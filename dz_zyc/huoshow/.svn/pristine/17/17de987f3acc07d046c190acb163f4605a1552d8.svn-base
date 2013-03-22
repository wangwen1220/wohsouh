<?
/**
 * 火秀整体相关操作类
 *
 * @author badroom
 * @package defaultPackage
 */

require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/configs/config.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");

class HuoshowSys
{
	
	
	/**
	 * 当前的分站点 因为在系统初始化时有可能需要根据不同的站点
	 * 有不同的配置，比如在cmstop和dz中可能配置是不同的。
	 *
	 * @var unknown_type
	 */
	public  $mCurrentSite = false;
	public static $object = false;
	
	/**
	 * 构造函数
	 *
	 * @param unknown_type $currentSite 当前的站点
	 * 	dz: 在discuz中
	 * 	cmstop: 在cmstop中
	 */
	protected function __construct($currentSite=false)
	{
		/*
		$current_path = $_SERVER['SCRIPT_FILENAME'];
		if(strpos($current_path,"/dz/")!==false)
			$this->mCurrentSite = "dz";
		elseif (strpos($current_path,"/cms/")!==false)
			$this->mCurrentSite = "cmstop";
		$this->initInput();
		*/
		$this->mCurrentSite = (!$currentSite)?$this->getCurrentEmbedEnv():$currentSite;
		$this->initInput();
	}
	public function __destruct()
	{
		
	}
	
	
	/**
	 * 提供不用初始化类，可直接获得当前系统嵌入环境的方式
	 *
	 * @return unknown
	 */
	static public function getEmbedEnv()
	{
		if(defined('IN_DISCUZ'))
			return "dz";
		elseif (defined('cmstop'))
			return "cmstop";
		else 
			return "huoshow";
	}
	
	
	/**
	 * 判断系统是否已经初始化
	 *
	 * @return unknown
	 */
	static public function systemIsLoad()
	{
		if(!self::$object)
			return false;
		else 
			return true;
	}
	
	/*
		获得当前系统被嵌入的环境，dz cmstop 或者是独立出来的huoshow
	*/
	static public function getCurrentEmbedEnv()
	{
		if(defined('IN_DISCUZ'))
			return "dz";
		elseif (defined('cmstop'))
			return "cmstop";
		else 
			return "huoshow";
	}
	/**
	 * 初始化自身
	 *
	 * @return unknown
	 */
	static public function instance($currentSite=false)
	{
		if(!HuoshowSys::$object)
			HuoshowSys::$object = new HuoshowSys($currentSite);
		return HuoshowSys::$object;
	}
	
	/**
	 * 初始化输入，类似dz,通过统一的方式访问
	 * GET POST的数据
	 *
	 */
	private function initInput()
	{
		global $_G;
		foreach ($_GET as $key=>$value)
			$_G["gp_$key"] = ($value);
		foreach ($_POST as $key=>$value)
			$_G["gp_$key"] = ($value);
	}
	
	
	/**
	 * 输出系统管理员后台css
	 *
	 */
	public function echoAdminCss()
	{
		echo "<link href=\"/huoshow/css/admin/admin.css\" rel=\"stylesheet\" type=\"text/css\" />";
	}
	/**
	 * 初始化系统管理员页面
	 * 其中包括权限判断
	 *
	 */
	public function initAdminPage()
	{
		
	}
	
	/**
	 * 系统管理员权限检查
	 * 由于火秀的后台页面目前是嵌入在dz的后台，因此权限判断
	 * 等操作都是预先在dz中做的，这里留出一个接口，如果以后与dz分离，
	 * 则在这里做诸如权限判断等操作
	 */
	public function checkAdminLimit()
	{
		global $SYSCONFIG;
		//如果当前系统管理员后台使用的是dz
		if($SYSCONFIG["CurrentAdminSys"]=='dz')
		{
				if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP'))
					exit('Access Denied');
		}
		else 
		{
			die("没有权限");
		}
		return true;
	}
	
	/**
	 * 判断用户权限
	 * 当一个后台页面没有嵌入到任何页面中时，存在权限判断的问题，
	 * 如果系统管理后台为dz，则直接使用dz的权限判断。
	 *
	 * @return unknown
	 */
	public function checkAdminLimitNoEmbed()
	{
		global $SYSCONFIG;
		//如果当前系统管理员后台使用的是dz
		if($SYSCONFIG["CurrentAdminSys"]=='dz')
		{
			
		}
		else 
		{
			die("没有权限");
		}
		return true;		
	}
	
	/**
	 * 前台页面初始化
	 * 由于火秀目前有些页面是嵌入到dz页面中的，因此如果用户是否登录
	 * cookie/session判断等操作都是在dz中处理，这里留出接口，如果
	 * 以后与dz分离，则在这里做权限判断等操作
	 *
	 * @return unknown
	 */
	public function initFront()
	{
		if(!$SYSCONFIG["IsEmbed"])
		{
			//如果是嵌入别的页面，可以在这里进行一些初始化工作
			//比如 判断是否登录等
			die("未实现:".__FILE__.":".__LINE__);
		}
		return true;
	}
}
?>