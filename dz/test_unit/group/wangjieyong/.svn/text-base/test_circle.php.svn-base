<?php
require_once("simpletest/autorun.php");
require_once(dirname(__FILE__)."/../../../source/circle_api.class.php");


class TestOfCircle_jieyong extends UnitTestCase
{
	private $m_circle;
	public function __construct()
	{
		parent::__construct();
	}
	
	//每个测试用例之前调用
	public function setUp() 
	{
		$this->m_circle = new Circle();
	}
	
	//每个测试用例之后调用
	public function tearDown() 
	{
		unset($this->m_circle);
	}
	
	//如果传字符串
	public function test_areastring()
	{
		$this->assertTrue($this->m_circle->get_area("abc")==-1);
	}
	
	//如果传负数
	public function test_areanegative()
	{
		$this->assertTrue($this->m_circle->get_area(-67)==-1);
	}
	
	//正数
	public function test_areaint()
	{
		$this->assertTrue($this->m_circle->get_area(1)==3.14);
	}
	
}

$test = &new TestOfCircle_jieyong();
$test->run(new HtmlReporter());
//$test->run(new TextReporter());
?>