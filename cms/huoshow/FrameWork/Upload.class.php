<?php

class HUpload {
	public function __construct()
	{
		//保存目录
		$this->save_path='/huoshow/uploadfile/';
		//文件链接
		$this->save_url='/huoshow/uploadfile/';
		//允许大小 300k
		$this->allow_size=300000;
		//允许类型
		$this->allow_ext='jpg,jpeg,gif,png';
		//新文件名
		$this->new_name=date("YmdHis").rand(10,99);
		//初始化错误提示
		$this->err='';
	}
	//上传
	public function upload($arr,$path='')
	{
		$this->file=$arr;
		//设置一个自己的保存目录
		$this->path=$path;
		//初始化设置
		$this->allow_ext=explode(',',$this->allow_ext);
		$this->save_path=$_SERVER['DOCUMENT_ROOT'].$this->save_path.$this->path.'/'.date('Y-m').'/';
		$this->save_url=$this->save_url.$this->path.'/'.date('Y-m').'/';
		//获得扩展名
		$temp_arr = explode(".", $this->file['name']);
		$file_ext = array_pop($temp_arr);
		$file_ext = trim(strtolower($file_ext));
		//检查类型
		if(!in_array($file_ext,$this->allow_ext)){
			$this->err="上传图片类型错误";
		}
		//检查大小
		if($this->file['size']>$this->allow_size){
			$this->err="文件超出限制大小";
		}
		//递归建立目录
		$this->creatdir($this->save_path);
		//上传后的路径
		$this->new_path=$this->save_path.$this->new_name.'.'.$file_ext;
		$this->new_url =$this->save_url.$this->new_name.'.'.$file_ext;
		//检查错误
		if (!empty($this->err)){
			$this->show($this->err);
		}
		//上传
		if( !move_uploaded_file($this->file['tmp_name'],$this->new_path) ) {
			$this->err= "上传文件出错";
			$this->show($this->err);
		}
	}
	//建立目录
	public function creatdir($Dir)
	{
		if (is_dir($Dir))
			return true;
		if (@ mkdir($Dir,0777))
			return true;
		if (!$this->creatdir(dirname($Dir)))
			return false;
		return mkdir($Dir,0777);
	}
	//错误提示         
	function show($errorstr)
	{
		echo "<script language=javascript>alert('$errorstr');location='javascript:history.go(-1);';</script>";
		exit();
	}
}
?>