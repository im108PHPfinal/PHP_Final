<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet" href="CSS/index.css">
	<link rel="stylesheet" href="CSS/all.css">
	<title>9453學生租車平台</title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type='text/javascript'>
		$(function(){
			var $menu = $('.menu'),
				_top = $menu.offset().top;
		 
			var $win = $(window).scroll(function(){
				if($win.scrollTop() >= _top){
					if($menu.css('position')!='fixed'){
						$menu.css({
							position: 'fixed',
							top: 0 
						});
					}
				}else{
					$menu.css({
						position: 'absolute',
						top: 150
					});
				}
			});
		});
	</script>
</head>

<body>
	<div class="wrap">
		<div class="header">
			<a href="index.html"><h1><img src="photo/icon.png" width="320px"></h1></a>
			<div class="user">
				<p>Hi! XXX</p>
				<p>歡迎回來!</p>
			</div>
			<div class="clear"></div>
		</div>
		<div class="menu">
			<ul>
				<a href="#"><li>關於我們</li></a>
				<a href="search.php"><li>找車子</li></a>
				<a href="#"><li>找委託</li></a>
				<a href="#"><li>我要出租!</li></a>
				<a href="#"><li>我要委託!</li></a>
				<div class="member"><a href="#"><img src="photo/boss.png" style="width: 35px;">會員專區</a></div>
			</ul>
		</div>
		<div class="content">
			<div class="search">
				<h2>搜尋 &nbsp </h2><img src="photo/car.png" style="width: 40px;">
				<form method="post" enctype="multipart/form-data">
					<li>車種廠牌 : <select name="brand">
										<option value="Toyota">Toyota</option>
	    								<option value="BMW">BMW</option>
	    								<option value="Mercedes-Benz">Mercedes-Benz</option>
	    								<option value="Honda">Honda</option>
	    								<option value="Ford">Ford</option>
	    								<option value="Nissan">Nissan</option>
										<option value="Mitsubishi">Mitsubishi</option>
										<option value="other">其他</option>
									</select>
					</li>
					<li>車型等級 ： <select name="brand">
										<option value="2">兩人座</option>
	    								<option value="4">四人座</option>
	    								<option value="5">五人座</option>
	    								<option value="6">六人座</option>
	    								<option value="7">七人座</option>
	    								<option value="9">九人座</option>
									</select></li>
					<li>租用起始日 : <input type="date" id="bookdate"></li>
					<li>可租用天數 : <input type="text" style="width:60px;"> 天</li>
					<li>價格 : <input type="text" style="width:60px;"> ~ <input type="text" style="width:60px;"></li>
					<a href="search.php"><input type="submit" id="btn" value="搜尋"></a>
				</form>
			</div>
			<div class="search">
				<h2>搜尋 &nbsp </h2><img src="photo/order.png" style="width: 30px;">
				<form method="post" enctype="multipart/form-data">
					<li>車種廠牌 : <select name="brand">
										<option value="Toyota">Toyota</option>
	    								<option value="BMW">BMW</option>
	    								<option value="Mercedes-Benz">Mercedes-Benz</option>
	    								<option value="Honda">Honda</option>
	    								<option value="Ford">Ford</option>
	    								<option value="Nissan">Nissan</option>
										<option value="Mitsubishi">Mitsubishi</option>
										<option value="other">其他</option>
									</select>
					</li>
					<li>車型等級 ： <select name="brand">
										<option value="2">兩人座</option>
	    								<option value="4">四人座</option>
	    								<option value="5">五人座</option>
	    								<option value="6">六人座</option>
	    								<option value="7">七人座</option>
	    								<option value="9">九人座</option>
									</select></li>
					<li>租用起始日 : <input type="date" id="bookdate_2"></li>
					<li>租用天數 : <input type="text" style="width:60px;"> 天</li>
					<li>價格 : <input type="text" style="width:60px;"> ~ <input type="text" style="width:60px;"></li>
					<a href="search.php"><input type="submit" id="btn" value="搜尋"></a>
				</form>
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

				function convertToISO(timebit) {
				  // remove GMT offset
				  timebit.setHours(0, -timebit.getTimezoneOffset(), 0, 0);
				  // format convert and take first 10 characters of result
				  var isodate = timebit.toISOString().slice(0,10);
				  return isodate;
				}

				var bookdate = document.getElementById('bookdate_2');
				var currentdate = new Date();
				bookdate.min = convertToISO(currentdate);
				bookdate.placeholder = bookdate.min;
				var futuredate = new Date();
				futuredate.setDate(futuredate.getDate() + 30);
				bookdate.max = convertToISO(futuredate);
			</script>

			<div class="clear"></div>
			<div class="news">
				<h3>最新租車資訊</h3>
				<a href=""><li>test</li></a>
				<a href=""><li>test</li></a>
			</div>
			<div class="news_2">
				<h3>最新委託資訊</h3>
				<a href=""><li>test</li></a>
				<a href=""><li>test</li></a>
			</div>
		</div>
		<div class="clear"></div>
		<footer>
			<p>9453學生租車平台</p>
			<p>© 2017 All rights reserved.</p>
			<p>NUKIM 2017 PHP</p>
		</footer>
	</div>
</body>
</html>
