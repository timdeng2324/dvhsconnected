<?php
	session_start();

	if (!isset($_SESSION['email'])) {
		header("location:/login");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Account Suspended</title>
		<link rel="stylesheet" type="text/css" href="/css/suspended.css">
		<link rel="stylesheet" type="text/css" href="/css/all.css">

		<script src="/js/track.js" type="text/javascript"></script>
	</head>
	<body>
		<header>
			<ul>
				<li><a href="/">HOME</a></li>
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
						$suspended = 0;
						if ($count == 1) {
							$rows = mysql_fetch_array($result);
							$hours = $rows['hours'];
							$suspended = $rows['suspended'];
						}

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
			UH OH, <?php echo strtoupper($rows['firstname']); ?>!
		</p>
		<p>
			YOUR ACCOUNT HAS BEEN SUSPENDED.
		</p>
		<p>
			Annie is probably angry at you. <a href="mailto:dvhsconnected@gmail.com?subject=ANNIE%20Y%20U%20DO%20DIS">Email</a> us and get this fixed.
		</p>
	</body>
</html>