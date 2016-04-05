<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		header("location:main_login.php");
	}

	echo $_SESSION['username'];

?>

<html>
	<head>
		<title>Whee!</title>
	</head>
	<body>
		Login Successful
		<br />
		<a href="logout.php">Log out</a>
	</body>
</html>