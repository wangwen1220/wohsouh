<?php
/**
 *  几率类
 *	0 礼物ID
 *	1 礼物对应的概率
**/
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/DataBase.php");
require_once($_SERVER['DOCUMENT_ROOT']."/huoshow/FrameWork/HuoshowSys.class.php");
class Chance
{
	private $probability_arr;
	private $m_arr = array();
	private $current_count = 0;
	/**
	 * 构造函数传入概率的数组,形如：
	 * array(
	 * 		 0 => array(1,12,232),
	 *       1 => array(0.25,0.45,0.3)
	 *    )
	 */
	public function __construct($arr)
	{
		$this->probability_arr = $arr;
		for($i=0;$i<count($arr[1]);$i++)
		{
			for($j=0;$j<$arr[1][$i]*100;$j++)
			{
				$this->m_arr[$this->current_count+$j]=$arr[0][$i];
			}
			$this->current_count += $arr[1][$i]*100;
		}
	}
	
	/**
	 * 随机 
	 */
	public function GiftsChance()
	{
		$giftchance = rand(0,99);
		return $this->m_arr[$giftchance];
	}
	
}