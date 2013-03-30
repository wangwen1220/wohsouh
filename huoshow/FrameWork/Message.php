<?php
	class CMessage
	{
		private $Memssage;
		
		function __construct()
		{
			$this->Memssage = "";
		}
		
		public function showMessage($messageLevel,$messagename,$massageValue,$isDie=true)
		{
			global $SYSCONFIG;
			switch ($messageLevel)
			{
				case 0:
					$this->Memssage = "错误:</br>";
					break;
				case 1:
					$this->Memssage = "警告:</br>";
					break;
				case 3:
					$this->Memssage = "通知:</br>";
					break;					
				default:
					$this->Memssage = "";
					break;
			}
			$this->Memssage .= $messagename."<br/><br/>";
			if($massageValue!=NULL && $SYSCONFIG["DEBUG"])
				$this->Memssage .= "错误详细信息:<br/>".$massageValue;
			if($isDie)
				die($this->Memssage);
		}
	}
//	$b = new CMessage();
//	$b->showMessage(0,"测试数据","这个错误很严重");
//	CMessage::showMessage(0,"测试数据","这个错误很严重");
?>