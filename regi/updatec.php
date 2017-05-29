<?php
session_start();

require_once("config.inc.php");

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$userphone = $_POST['userphone'];
$bank = $_POST['bank'];
$bankaccount = $_POST['bankaccount'];
$level = $_POST['level']; //會員等級不可更改

$row = $member->getUserinfoBn($username);

if ($password == null) 
{
	$password_md5 = $row['password'];
} 
else 
{
	$password_md5 = md5($password);
}

$code = $member->update($username, $email, $password_md5, $userphone, $bank, $bankaccount, $level); //使用更新帳號資訊函數

	switch ($code) 
	{
		case 0:
			echo "<span style=\"color:green;\">更新成功！</span>";
			echo '<meta http-equiv="refresh" content="2; url=member.php">';
		break;
		case 1:
			echo "<span style=\"color:red;\">更新失敗！</span>";
			echo '<meta http-equiv="refresh" content="2; url=update.php">';
		break;
		case 2:
			echo "<span style=\"color:red;\">密碼名稱不為0-9或英文字母!</span>";
			echo '<meta http-equiv="refresh" content="2; url=update.php">';
		break;
		case 3:
			echo "<span style=\"color:red;\">電子信箱格式不符!</span>";
			echo '<meta http-equiv="refresh" content="2; url=update.php">';
		break;
		case 4:
			echo "<span style=\"color:red;\">手機號碼格式不符!</span>";
			echo '<meta http-equiv="refresh" content="2; url=member.php">';
		break;
		case 5:
			echo "<span style=\"color:red;\">銀行代碼格式不符!</span>";
			echo '<meta http-equiv="refresh" content="2; url=member.php">';
		break;
		case 6:
			echo "<span style=\"color:red;\">銀行帳號格式不符!</span>";
			echo '<meta http-equiv="refresh" content="2; url=member.php">';
		break;
	}
