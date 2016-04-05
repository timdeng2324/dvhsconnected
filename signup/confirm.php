<!DOCTYPE html>
<html>
	<head>
		<title>Verifying...</title>
		<link rel="stylesheet" href="/css/all.css" type="text/css" />
		<link rel="stylesheet" href="/css/generic.css" type="text/css" />
	</head>
	<body>
		<?php
			include($_SERVER['DOCUMENT_ROOT']."/snippets/db.php");

			$confirm = $_GET['confirm'];

			mysql_connect("$host", "$username", "$password") or die ("Cannot connect");
			mysql_select_db("$db") or die ("Cannot select database");

			$sql = "SELECT * FROM $temp WHERE confirm='$confirm'";
			$result = mysql_query($sql);
			$count = mysql_num_rows($result);

			if ($count == 1) {
				$rows = mysql_fetch_array($result);
				$myemail = $rows['email'];
				$mypassword = $rows['password'];
				$myfirstname = $rows['firstname'];
				$mylastname = $rows['lastname'];
				$mygrade = $rows['grade'];

				$sql = "INSERT INTO $users(email, password, firstname, lastname, grade) VALUES ('$myemail', '$mypassword', '$myfirstname', '$mylastname', '$mygrade')";
				$result = mysql_query($sql);
				if ($result) {
					echo "
						<div>Account activated!</div>
						<div><a href='/login'>Log in</a></div>
					";
					$sql = "DELETE FROM $temp WHERE confirm='$confirm'";
					$result = mysql_query($sql);
				} else {
					echo "
						<div>Something went wrong.</div>
						<div>Go <a href='/'>home</a>.</div>
					";
				}
			} else {
				echo "
					<div>Something went wrong.</div>
					<div>Go <a href='/'>home</a>.</div>
				";
			}
		?>
	</body>
</html>