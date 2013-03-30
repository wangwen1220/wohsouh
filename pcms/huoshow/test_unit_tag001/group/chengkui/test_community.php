<?php
require_once("simpletest/autorun.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/community/community.php");

class TestCommnunity extends UnitTestCase
{

	private $m_dblink;
	public function __construct()
	{
		global $SYSCONFIG;
		parent::__construct();
		$SYSCONFIG["MYsqlDataBase"] = 'huoshow_beta_test';
		$this->m_dblink = new DataBase("");

		$this->m_dblink->query("DELETE FROM pre_community_album");
		$this->m_dblink->query("DELETE FROM pre_community_album_watch_map");
		$this->m_dblink->query("DELETE FROM pre_community_bind");
		$this->m_dblink->query("DELETE FROM pre_community_class");
		$this->m_dblink->query("DELETE FROM pre_community_class_tag_map");
		$this->m_dblink->query("DELETE FROM pre_community_file");
		$this->m_dblink->query("DELETE FROM pre_community_file_like");
		$this->m_dblink->query("DELETE FROM pre_community_file_reply");
		$this->m_dblink->query("DELETE FROM pre_community_file_tag");
		$this->m_dblink->query("DELETE FROM pre_community_file_tag_map");
		$this->m_dblink->query("DELETE FROM pre_community_file_verify_fail_log");
		$this->m_dblink->query("DELETE FROM pre_community_user_stat");

		$this->m_dblink->query("alter table pre_community_album AUTO_INCREMENT=1");
		$this->m_dblink->query("alter table pre_community_album_watch_map AUTO_INCREMENT=1");
		$this->m_dblink->query("alter table pre_community_bind AUTO_INCREMENT=1");
		$this->m_dblink->query("alter table pre_community_class AUTO_INCREMENT=1");
		$this->m_dblink->query("alter table pre_community_class_tag_map AUTO_INCREMENT=1");
		$this->m_dblink->query("alter table pre_community_file AUTO_INCREMENT=1");
		$this->m_dblink->query("alter table pre_community_file_like AUTO_INCREMENT=1");
		$this->m_dblink->query("alter table pre_community_file_reply AUTO_INCREMENT=1");
		$this->m_dblink->query("alter table pre_community_file_tag AUTO_INCREMENT=1");
		$this->m_dblink->query("alter table pre_community_file_tag_map AUTO_INCREMENT=1");
		$this->m_dblink->query("alter table pre_community_file_verify_fail_log AUTO_INCREMENT=1");
		$this->m_dblink->query("alter table pre_community_user_stat AUTO_INCREMENT=1");
	}
	
	public function test_main()
	{
		//创建类别
		$this->crete_class();
		//创建标签
		$this->crete_tag();
		//创建类别和标签之间的对应关系
		$this->create_class_tag_map();
		//创建三个专辑
		$this->create_album();
		//在专辑中添加分享
		$this->create_share();
		//对专辑评论
		$this->reply_album();
	}
	
	private  function crete_class()
	{
		$r = Community::createClass("酷玩", "css/kuwan.jpg");
		echoErr($r);
		$this->assertTrue($r["-retult-"]!==false);
		$this->assertTrue($r["-msg-"]==1);
		$r = Community::createClass("趣味", "css/quwan.jpg");
		$this->assertTrue($r["-msg-"]==2);
	}
	
	private function crete_tag()
	{
		$r = Community::createTag("数码",1);
		echoErr($r);
		$this->assertTrue($r["-retult-"]!==false);
		$this->assertTrue($r["-msg-"]==1);
		$r = Community::createTag("玩具",1);
		$r = Community::createTag("搞笑",1);
		$r = Community::createTag("恶搞",1);
		$r = Community::createTag("美女",1);
		$r = Community::createTag("帅哥",1);
	}
	
	private function create_class_tag_map()
	{
		$r = Community::createClassTagMap(1, 1);
		$r = Community::createClassTagMap(1, 2);
		
		$sql = "SELECT * FROM pre_community_class_tag_map WHERE classid=1";
		$dbarr = $this->m_dblink->getRow($sql);
		$this->assertTrue($dbarr[0][tagid]==1);
		$this->assertTrue($dbarr[1][tagid]==2);
		
		$r = Community::createClassTagMap(2,3);
		$r = Community::createClassTagMap(2,4);
	}
	
	private function create_album()
	{
		$r = Community::createAlbum(107321, "redwood9", "GEEK", "有趣的小产品", 1);
		echoErr($r);
		$this->assertTrue($r["-retult-"]!==false);
		//album应该有记录
		$this->assertTrue($r["-msg-"]==1);
		$r = Community::createAlbum(107321, "redwood9", "SEE", "美观的小产品", 1);
		$this->assertTrue($r["-msg-"]==2);
		//用户专辑统计应该是2
		$sql = "SELECT * FROM pre_community_user_stat WHERE uid='107321'";
		$dbarr = $this->m_dblink->getRow($sql);
		$this->assertTrue($dbarr[0][album_count]==2);
		
		$r = Community::createAlbum(1, "admin", "gril", "美女", 1);
	}
	
	private function create_share()
	{
		//网址采集一个图片
		$r = Community::createShare(107321, 'redwood9', '新款ThinkPad',
				 'product/thindpad.jpg', '', array(1,2), 1, "NB的新款thinkpad",
				 2, 0);
		echoErr($r);
		$this->assertTrue($r["-retult-"]!==false);
		$id = $r["-msg-"];
		$this->assertTrue($r["-msg-"]==1);
		
		//网址采集一个商品
		$r = Community::createShare(107321, 'redwood9', '戴尔新款服务器',
				'product/dell.jpg', 'http://dangdang.com/product/10000', 
				array(2), 1, "性能强大的戴尔服务器",
				2, 0,3,1,85);
		
		
		//另外一个用户转藏第一个图片
		$r = Community::collectShare(1, 'admin', 2,3);
		echoErr($r);
		$this->assertTrue($r["-retult-"]!==false);
		
		//检查专辑下文件数
		$sql = "SELECT file_count FROM pre_community_album WHERE id='1'";
		$dbarr = $this->m_dblink->getRow($sql);
		$this->assertTrue($dbarr[0][file_count]==2);

	}
	
	private function reply_album()
	{
		
	}
}
?>