<?php
	session_start();

	if (!isset($_SESSION['email'])) {
		header("location:/login");
	}

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

		if ($suspended > 0) {
			header("location:/suspended");
		}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Me</title>

		<meta name="description" content="Log in to DVHS Connect:ed.">
		<meta name="keywords" content="Dougherty, Valley, High, School, Connected, Connect:ed, club, tutoring, volunteering, login">
		<meta charset="UTF-8">

		<link rel="stylesheet" href="/css/me.css" type="text/css">
		<link rel="stylesheet" href="/css/all.css" type="text/css">
		<script src="/js/track.js" type="text/javascript"></script>
	</head>
	<body>
		<header>
			<ul>
				<li><a href="/">HOME</a></li>
				<li><a href="/gallery">GALLERY</a></li>
				<?php
						// ...
						$hourssup = floor($hours);
						$hourspre = round($hours, 2, PHP_ROUND_HALF_UP);

						echo "<li><a href='/me' class='curlink'>ME";
						if ($suspended == 0) echo "<sup>$hourssup</sup>";
						echo "</a></li>";
						echo "<li><a href='/logout'>LOG OUT</a></li>";
					} else {
						echo "<li><a href='/login'>LOGIN</a></li>";
					}
				?>
			</ul>
		</header>

		<p id="moremargins">
			HI, <?php echo strtoupper($rows['firstname']); ?>!
		</p>

		<p>
			YOU'VE COMPLETED
		</p>
		<p id="hours">
			<?php
				echo $hourspre;
			?>
		</p>
		<p>
			HOURS THIS SEMESTER.
		</p>
		<p>
			<b><?php echo round(($hours + $hours2), 2, PHP_ROUND_HALF_UP); ?></b> HOURS THIS YEAR.
		</p>
	</body>
</html>