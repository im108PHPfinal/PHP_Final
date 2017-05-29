<?php
/**
 *changken會員系統專用函數庫
 *簡介:為促進程式開發人員方便開發，changken特別製作專用函數庫。
 *作者:changken
 *使用方式:請將函數直接複製即可。注意！一定要引入此函數庫，不然不能使用！
 *函數:reg()、login()、update()、delete_u()、logout()、getUserinfoBn()
 *版本:v1.3
 */
require_once("dbconnect.php");

class member {
	
	public $version_value = "13";

	use DBconnect;

	public function __construct() 
	{
		$this->connect();
	}

	//函數庫版本顯示函數
	public function version_show() 
	{
		echo "版本:v1.3";
	}

	//註冊函數
	public function reg($username, $email, $password, $password2, $password_md5, $userphone, $bank, $bankaccount, $level) 
	{

		//判斷
		
		if (!preg_match("/^[.0-9a-zA-Z ]*$/",$username))
		{
			$return = 0;
		}
		elseif (!preg_match("/^[.0-9a-zA-Z ]*$/",$password)) //密碼名稱不為0-9或英文字母
		{
			$return = 1;
		}  
		elseif ($password != $password2) //兩次密碼不一致
		{
			$return = 3;
		}
		elseif (!preg_match('/^([.0-9a-z]+)@([0-9a-z]+).([.0-9a-z]+)$/i',$email)) //電子信箱格式不符
		{
			$return = 6;
		}
		elseif (!preg_match("/09[0-9]{2}[0-9]{6}/", $userphone)) //手機號碼格式不符
		{
			$return = 7;
		}  
		elseif ($bank != null && !preg_match("/^[0-9]*$/", $bank))//銀行代碼名稱不為空和0-9
		{
			$return = 8 ;	
		}
		elseif ($bankaccount != null && !preg_match("/^[0-9]*$/", $bankaccount))//銀行代碼名稱不為空和0-9
		{
			$return = 9 ;	
		}
		else {
			//sql語法
			$reg_sql = "INSERT INTO `user` (`username`, `email`, `password`, `userphone`, `bank`, `bankaccount`, `level`) VALUES (:username, :email, :password_md5, :userphone, :bank, :bankaccount, :level);";
			$reg = $this->db->prepare($reg_sql);
			
			//過濾資料
			$reg->bindParam(":username", $username);
			$reg->bindParam(":email", $email);
			$reg->bindParam(":password_md5", $password_md5);
			$reg->bindParam(":userphone", $userphone);
			$reg->bindParam(":bank", $bank);
			$reg->bindParam(":bankaccount", $bankaccount);
			$reg->bindParam(":level", $level);

			//執行
			if ($reg->execute()) 
			{
				$return = 4;
			} 
			else 
			{
				$return = 5;
			}
		}

		return $return;
	}
	
	//登入函數
	public function login($username, $password, $password_md5) 
	{

		//sql語法
		$login_sql = "SELECT * FROM `user` WHERE `username`=:username AND `password`=:password_md5;";
		$login = $this->db->prepare($login_sql);

		//過濾資料
		$login->bindParam(":username", $username);
		$login->bindParam(":password_md5", $password_md5);

		//執行
		$login->execute();

		//從資料庫撈取資料(1筆)
		$login_row = $login->fetch();

		//一連串的判斷
		if ($username == null) //使用者名稱為空
		{
			$return = 0;
		} 
		elseif ($password == null) //密碼為空
		{
			$return = 1;
		} 
		elseif ($username != $login_row['username'] or $password_md5 != $login_row['password']) //使用者名稱或密碼錯誤
		{
			$return = 2;
		} 
		else 
		{
			if ($login_row['level'] == "user") //權限user
			{
				$return = 3;
			} 
			elseif ($login_row['level'] == "admin") //權限admin
			{
				$return = 4;
			} 
			else 
			{
				$return = 5;
			}
		}
		return $return;
	}
	
	//更新帳號資訊函數
	function update($username, $email, $password_md5, $userphone, $bank, $bankaccount, $level) 
	{

		//sql語法
		$update_sql = "UPDATE `user` SET `email` = :email, `password` = :password_md5, `userphone` = :userphone, `bank` = :bank, `bankaccount` = :bankaccount, `level` = :level WHERE `username` = :username;";
		$update = $this->db->prepare($update_sql);

		//過濾資料
		$update->bindParam(":email", $email);
		$update->bindParam(":userphone", $userphone);
		$update->bindParam(":bank", $bank);
		$update->bindParam(":bankaccount", $bankaccount);
		$update->bindParam(":password_md5", $password_md5);
		$update->bindParam(":level", $level);
		$update->bindParam(":username", $username);

		//執行
		if (!preg_match("/^[.0-9a-zA-Z ]*$/",$password_md5)) //密碼名稱不為0-9或英文字母
		{
			$return = 2;
		}
		elseif (!preg_match('/^([.0-9a-z]+)@([0-9a-z]+).([.0-9a-z]+)$/i',$email)) //電子信箱格式不符
		{
			$return = 3;
		}

		elseif (!preg_match("/09[0-9]{2}[0-9]{6}/", $userphone)) //手機號碼格式不符
		{
			$return = 4;
		}
		if (!preg_match("/^[.0-9]*$/",$bank)) //銀行代碼名稱不為0-9
		{
			$return = 5;
		}
		if (!preg_match("/^[.0-9]*$/",$bankaccount)) //銀行帳號不為0-9
		{
			$return = 6;
		}
		elseif ($update->execute()) 
		{
			$return = 0;
		} 
		else 
		{
			$return = 1;
		}
		return $return;
	}
	
	//刪除會員函數(限管理員可使用)
	function delete_u($username) 
	{
		$row = $this->getUserinfoBn($username);

		if($username == null) //使用者名稱為空
		{
			$return = 0;
		}
		else if(!isset($row['username'])) //使用者不存在
		{
			$return = 1;
		}
		else
		{
			if ($_SESSION['level'] == "admin") 
			{
				//sql語法
				$delete_sql = "DELETE FROM user WHERE username = :username;";
				$delete_u = $this->db->prepare($delete_sql);
			
				//過濾資料
				$delete_u->bindParam(":username", $username);
			
				if ($delete_u->execute()) 
				{
					$return = 2;
				} 
				else 
				{
					$return = 3;
				}
			} 
			elseif ($_SESSION['level'] == "user") 
			{
				$return = 4;
			} 
			else 
			{
				$return = 5;
			}
		}
		return $return;
	}
	
	//登出函數
	public function logout() 
	{
		unset($_SESSION['username']);
		unset($_SESSION['level']);
		return true;
	}
	
	//取得使用者資訊函數
	public function getUserinfoBn($username) 
	{
		//sql語法
		$getuser_sql = "SELECT * FROM `user` WHERE `username`= :username;";
		$getuser = $this->db->prepare($getuser_sql);
		
		//過濾資料
		$getuser->bindParam(":username", $username);
		
		//執行
		$getuser->execute();
		
		//取得使用者資訊(1筆)
		$getuser_row = $getuser->fetch();
		
		return $getuser_row;
	}
}
