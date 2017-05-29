<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet" href="CSS/index.css">
	<link rel="stylesheet" href="CSS/all.css">
	<title>9453租車網</title>
</head>

<body>
	<div class="wrap">
		<div class="header">
			<div class="user">
				<?php 
				if(isset($_SESSION['username'])) //2016.5.21
				{
				?>
				<p><?php echo $_SESSION['username'];?>,歡迎回來!</p>
				<?php
				}
				else
				{
				?>
					<span style="color:red;"><a href="login.php">您尚未登入！</a></span>
				<?php
				}
				?>
			</div>
			<div class="clear"></div>
			<div class="menu">
				<ul>
					<a href="#"><li>我要出租!</li></a>
					<a href="#"><li>我要委託!</li></a>
					<a href="#"><li>關於我們</li></a>
					<div class="member"><a href="login.php"><img src="photo/boss.png" style="width: 35px;">會員專區</a></div>
				</ul>
			</div>
		</div>
		<div class="content">
			<div class="search">
				<h2>搜尋</h2><img src="photo/car.png" style="width: 40px;">
				<li>車種 : </li>
				<li>租用日期 : <input type="date" id="bookdate"></li>
				<li>租用天數 : </li>
				<li>價格 : <input type="text" style="width:60px;"> ~ <input type="text" style="width:60px;"></li>
			</div>
			<div class="search">
				<h2>搜尋</h2><img src="photo/order.png" style="width: 30px;">
			</div>

			<script>
				function convertToISO(timebit) {
				  // remove GMT offset
				  timebit.setHours(0, -timebit.getTimezoneOffset(), 0, 0);
				  // format convert and take first 10 characters of result
				  var isodate = timebit.toISOString().slice(0,10);
				  return isodate;
				}

				var bookdate = document.getElementById('bookdate');
				var currentdate = new Date();
				bookdate.min = convertToISO(currentdate);
				bookdate.placeholder = bookdate.min;
				var futuredate = new Date();
				futuredate.setDate(futuredate.getDate() + 30);
				bookdate.max = convertToISO(futuredate);
				</script>
		</div>
	</div>
</body>
</html>