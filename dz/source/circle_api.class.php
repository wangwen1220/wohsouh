<?
class Circle
{
	public function get_area($radius)
	{
		if(!is_numeric($radius))
			return -1;
		if($radius<0)
			return -1;
		$pi = 3.14;
		return 3.14*$radius*$radius;
	}
}
?>