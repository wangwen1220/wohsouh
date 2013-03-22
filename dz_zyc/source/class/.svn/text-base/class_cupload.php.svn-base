<?php
/**
 * 文件上传
 * @author zhangcj
 */

class cupload {
	
	const DIR_SEP = DIRECTORY_SEPARATOR;
	
	public $allowTypes = '*';#允许上传的附件类型
	public $maxSize = 10240;#最大允许文件大小，单位KB
	public $baseDir;#附件存放基本物理目录
	public $dir;#附件存放详细物理目录
	
	private $thumbSize = array();#缩略图大小
	
	private $watermarkImage;#水印图片
	private $watermarkPos;#水印位置
	private $watermarkTrans;#水印透明度
	
	function __construct() {
		$this->baseDir = DISCUZ_ROOT."data".self::DIR_SEP;
	}
	
	/**
	 * 设置允许上传的附件类型，以“|”隔开，例如：'jpg|png'
	 * @param string $str
	 */
	public function setAllowTypes($str) {
		$this->allowTypes = $str;
	}
	
	/**
	 * 设置最大允许文件大小
	 * @param int $size
	 */
	public function setMaxSize($size) {
		$this->maxSize = $size;
	}
	
	/**
	 * 设置附件存放详细物理目录
	 * @param string $fileDir
	 */
	public function setDir($fileDir) {
		$fileDir = $this->trimPath($fileDir);
		$fileDir = rtrim($fileDir, self::DIR_SEP);
		$this->dir = $this->baseDir.$fileDir.self::DIR_SEP;
		if (!empty($fileDir)) {
	        $dirs = explode(self::DIR_SEP, $this->dir);
	        $tmp = '';
	        foreach ($dirs as $dir) {
	            $tmp .= $dir . self::DIR_SEP;
	            if (!file_exists($tmp) && !mkdir($tmp, 0777))
	                die('文件夹创建失败');
	        }
		}
        return true;
	}
	
	/**
	 * 设置缩略图大小
	 * @param array $thumbSize 例如：array(array(60,60),array(90,90),array(120,120))
	 */
	public function setThumb($thumbSize) {
		$this->thumbSize;
	}
	
	/**
	 * 设置水印
	 * @param string $image
	 * @param int $position
	 * @param int $trans
	 */
	public function setWatermark($image, $position=6, $trans=80) {
		$this->watermarkImage = $image;
		$this->watermarkPos = $position;
		$this->watermarkTrans = $trans;
	}
	
	/**
	 * 执行
	 * @param string $inputName
	 * @param array/string $fileName
	 */
	public function execute($inputName, $fileName='') {
		if (!isset($_FILES[$inputName]['name'])) {
			return false;
		}
		
		$files = array();#成功上传的文件信息
		$isMultiFile = is_array($_FILES[$inputName]['name']) ? TRUE : FALSE;
		if (!$isMultiFile) {
			$tmp['name'][0] = $_FILES[$inputName]['name'];
			$tmp['type'][0] = $_FILES[$inputName]['type'];
			$tmp['tmp_name'][0] = $_FILES[$inputName]['tmp_name'];
			$tmp['error'][0] = $_FILES[$inputName]['error'];
			$tmp['size'][0] = $_FILES[$inputName]['size'];
			
			$_FILES[$inputName] = $tmp;
			
			if (!is_array($fileName)) {
				$fileName = array($fileName);
			}
		}
		
		for ($i = 0; $i < count($_FILES[$inputName]['name']); $i++) {
			//获取文件扩展名
			$tmpFileExt = $this->fileExt($_FILES[$inputName]['name'][$i]);
			//生成文件名
			$tmpFileName = empty($fileName[$i]) ? date('Ymdhis',$this->time).mt_rand(10,99) : $fileName[$i];
			//文件大小
			$tmpFileSize = $_FILES[$inputName]['size'][$i];
			
			//允许的文件类型
			$types = explode('|', $this->allowTypes);
			
			//文件类型不允许
			if ($this->allowTypes != '*' && !in_array($tmpFileExt, $types)) {
				$files[$i]['name'] = $_FILES[$inputName]['name'][$i];
				$files[$i]['flag'] = -1;
				continue;
			}
			
			//文件大小超出
			if ($tmpFileSize > ($this->maxSize*1024)) {
				$files[$i]['name'] = $_FILES[$inputName]['name'][$i];
				$files[$i]['size'] = $tmpFileSize;
				$files[$i]['flag'] = -1;
				continue;
			}
			
			$files[$i]['name'] = $tmpFileName.'.'.$tmpFileExt;
			$files[$i]['dir'] = $this->dir;
			$files[$i]['size'] = $tmpFileSize;
			
			//保存上传文件并删除临时文件
			if (is_uploaded_file($_FILES[$inputName]['tmp_name'][$i])) {
				move_uploaded_file($_FILES[$inputName]['tmp_name'][$i], $this->dir.$tmpFileName.'.'.$tmpFileExt);
				@unlink($_FILES[$inputName]['tmp_name'][$i]);
				$files[$i]['flag'] = 1;
				
				//对图片进行加水印和生成缩略图
				
			}
		}
		return $files;
	}
	
    /**
     * 将路径修正为适合操作系统的形式
     * @param  string $path 路径名称
     * @return string
     */
    private function trimPath($path) {
        return str_replace(array('/', '\\', '//', '\\\\'), self::DIR_SEP, $path);
    }
    
    /**
     * 返回文件扩展名
     * @param string $fileName
     */
    private function fileExt($fileName) {
    	return strtolower(substr(strrchr($fileName,'.'),1,10));
    }
}