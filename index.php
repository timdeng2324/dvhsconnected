<?php session_start() ?>

<!DOCTYPE html>

<html>
	<head>
		<title>DVHS Connect:ed</title>

		<meta name="description" content="Connect:ed is a Dougherty Valley club that helps elementary school students twice a week.">
		<meta name="keywords" content="Dougherty, Valley, High, School, Connected, Connect:ed, club, tutoring, volunteering">
		<meta charset="UTF-8">

		<link rel="stylesheet" href="css/all.css" type="text/css" />
		<link rel="stylesheet" href="css/home.css" type="text/css" />

		<script src="/js/jquery-1.10.2.min.js" type="text/javascript"></script>
		<!--<script src="/js/home.js" type="text/javascript"></script>-->
		<script src="/js/track.js" type="text/javascript"></script>
	</head>
	<body>
		<header>
			<ul>
				<li><a href="/" class="curlink">HOME</a></li>
				<li><a href="/gallery">GALLERY</a></li>
				<?php
					if (isset($_SESSION['email'])) {
						$myemail = $_SESSION['email'];

						include($_SERVER['DOCUMENT_ROOT']."/snippets/db.php");

						mysql_connect("$host", "$username", "$password") or die ("Cannot connect");
						mysql_select_db("$db") or die ("Cannot select database");

						$sql = "SELECT * FROM $users WHERE email='$myemail'";
						$result = mysql_query($sql);
						$count = mysql_num_rows($result);

						$hours = 0;
						$hours2 = 0;
						$suspended = 0;
						if ($count == 1) {
							$rows = mysql_fetch_array($result);
							$hours = $rows['hours'];
							$hours2 = $rows['hours2'];
							$suspended = $rows['suspended'];
							if ($usingSecond) {
								$temp = $hours2;
								$hours2 = $hours;
								$hours = $temp;
							}
						}

						$hourssup = floor($hours);

						echo "<li><a href='/me'>ME";
						if ($suspended == 0) echo "<sup>$hourssup</sup>";
						echo "</a></li>";
						echo "<li><a href='/logout'>LOG OUT</a></li>";
					} else {
						echo "<li><a href='/login'>LOGIN</a></li>";
					}
				?>
			</ul>
		</header>

		<section id="top">
			<img src="/imgs/logohome.png" />
		</section>

		<section class="story" id="first" data-speed="8" data-type="background">
			<div>
				<table><tr><td>TEACH</td></tr></table>
			</div>
		</section>

		<section class="story" id="second" data-speed="8" data-type="background">
			<div>
				<table><tr><td>LEARN</td></tr></table>
			</div>
		</section>
		
		<section class="story" id="third" data-speed="8" data-type="background">
			<div>
				<table><tr><td>CONNECT</td></tr></table>
			</div>
		</section>

		<section id="signup">
			<table>
				<tr>
					<td>
						<a href="/signup">
							<div>
								Sign Up
							</div>
						</a>
					</td>
				</tr>
			</table>
		</section>

		

		<footer>
			<div>
				<a href="mailto:dvhsconnected@gmail.com">Contact</a>
			</div>
			<div>
				<a href="http://dvhs.schoolloop.com/">Dougherty Valley High School</a>
			</div>
		</footer>

	</body>
</html>