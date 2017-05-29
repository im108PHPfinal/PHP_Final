<!DOCTYPE html>
<html lang="zh-TW">

	<head>
		<meta charset="UTF8">
		<title>註冊</title>
		<style>
		.error {color: #FF0000;}
		</style>
	</head>

	<body>
		<h1>註冊</h1>
			<form method="post" action="regc.php" name="reg">
								
				<p><span class="error">* 必填的項目</span></p>
				使用者(不得超過20字):<input name="username" type="text">
				<span class="error">*</span><br>
				email:<input name="email" type="text">
				<span class="error">*</span><br>
				密碼:<input name="password" type="password">
				<span class="error">*</span><br>
				密碼(再輸入一次):<input name="password2" type="password">
				<span class="error">*</span><br>
				手機號碼:<input name="userphone" type="text">
				<span class="error">*</span><br>
				匯款銀行代碼:<input name="bank" type="text">
				<a href="http://web.thu.edu.tw/s932954/www/ruten/banklist.htm" target="_blank" title="銀行代碼一覽表">銀行代碼一覽表</a><br>
				匯款銀行帳號:<input name="bankaccount" type="text"><br>
				<input name="reg" value="註冊" type="submit"><br>
				已有帳號？<a href="login.php">登入</a>
							
			</form>
	</body>

</html>