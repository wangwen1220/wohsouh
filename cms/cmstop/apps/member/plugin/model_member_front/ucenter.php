<?php
class plugin_ucenter extends object
{
	private $m;
	
	public function __construct(& $model)
	{
		$this->m = $model;
		$this->ucenter = loader::model('ucenter', 'member');
		$this->member_detail = loader::model('member_detail', 'member');
	}
	
	public function before_login()
	{
		$this->login();
	}

	public function after_login()
	{
		$this->m->m['ucsynlogin'] = $this->ucenter->sysnlogin($this->m->m['userid']);
	}

	public function before_check_email()
	{
		$email = $this->m->email;
		$rs = $this->ucenter->validate($email, 'email');
		if(!$rs['state']) 
		{
			$this->m->error = $rs['message'];
		}
	}

	public function before_check_username()
	{
		$username = $this->m->username;
		$rs = $this->ucenter->validate($username, 'username');
		if(!$rs['state']) $this->m->error = $rs['message'];
	}

	public function before_get_photo()
	{
		$userid = $this->m->userid;
		$size = $this->m->size;
		$this->m->photo = $this->ucenter->get_photo($userid, $size);
	}

	public function after_password()
	{
		$username = $this->m->username;
		$password = $this->m->password;
		$last_password = $this->m->last_password;
		$return = $this->ucenter->edit($username,$last_password,$password,'',1);
		if($return !== true)
		{
			$this->error = $return['message'];
			return false;
		}
	}

	public function after_email()
	{
		$username = $this->m->username;
		$password = $this->m->password;
		$email = $this->m->email;
		$return = $this->ucenter->edit($username,$password,'',$email);
		if($return !== true)
		{
			$this->error = $return['message'];
			return false;
		}
	}

	public function after_getProfile()
	{
		$this->m->d['uc_avatar_upload'] = uc_avatar($this->m->_userid);
	}
	
	public function after_logout()
	{
		$this->m->synclogout = $this->ucenter->logout();
	}

	public function before_register()
	{
		$this->register();
	}

	private function register()
	{
		$data = $this->m->data;
		$user = $this->ucenter->register($data['username'], $data['password'], $data['email']);
		if(isset($user['state']) && !$user['state'])
		{
			$this->m->error = $user['message'];
			return false;
		}
		$user['password'] = md5($user['password']);
		$this->m->insert($user);
		$this->member_detail->add($user);
		$this->m->userid = $user['userid'];
	}

	private function login()
	{
		$this->m->error = null;
		$username = $this->m->username;
		$password = $this->m->password;
		$user = $this->ucenter->login($username, $password);
		if($user['userid'] < 0)
		{
			$this->m->error = $user['error'];
			return;
		}
		//如果cmstop中无此用户，则复制到cmstop中
		if(!$this->m->m)
		{
			$this->ucenter->get_ucdb();
			$ucdb = & $this->ucenter->ucdb;
			$ucuser = $ucdb->get("SELECT * FROM #table_members WHERE uid = ".$user['userid']);
			$ctuser = array(
				'userid'		=>	$ucuser['uid'],
				'username'		=>	$ucuser['username'],
				'name'			=>	$ucuser['username'],
				'password'		=>	$ucuser['password'],
				'salt'			=>	$ucuser['salt'],
				'email'			=>	$ucuser['email'],
				'regtime'		=>	$ucuser['regdate'],
				'lastloginip'	=>	$ucuser['lastloginip'],
				'lastlogintime'	=>	$ucuser['lastlogintime'],
			);
			$this->m->insert($ctuser);
			$this->member_detail->insert($ctuser);
			$this->m->m = $ctuser;
		}
	}
}