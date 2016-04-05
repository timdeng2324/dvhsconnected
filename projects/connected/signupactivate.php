<?php
	
	$host = "localhost";
	$username = "";
	$password = "";
	$db_name = "test";
	$tbl_name = "members";
	$temp_name = "temp";

	mysql_connect("$host", "$username", "$password") or die ("cannot connect");
	mysql_select_db("$db_name") or die ("cannot select DB");

	$myusername = $_POST['myusername'];
	$mypassword1 = $_POST['mypassword1'];
	$mypassword2 = $_POST['mypassword2'];

	$myusername = stripslashes($myusername);
	$mypassword1 = stripslashes($mypassword1);
	$mypassword2 = stripslashes($mypassword2);
	$myusername = mysql_real_escape_string($myusername);
	$mypassword1 = mysql_real_escape_string($mypassword1);
	$mypassword2 = mysql_real_escape_string($mypassword2);

	$sql = "SELECT * FROM $tbl_name WHERE username='$myusername'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	if ($count >= 1) {
		echo "Uh oh, that username is taken.";
		echo "<br />";
		echo "<a href='signup.php'>Try a different one.</a>";
	} else {
		if ($mypassword1 != $mypassword2) {
			echo "Uh oh, your passwords don't match.";
			echo "<br />";
			echo "<a href='signup.php'>Try again.</a>";
		} else {
			$sql = "SELECT * FROM $temp_name WHERE email='$myusername'";
			$result = mysql_query($sql);
			$count = mysql_num_rows($result);
			if ($count == 1) {
				echo "Uh oh. Check your email, we should have already sent you a link.";
			} else {
				$mypassword1 = md5($mypassword1);
				$confirm = md5(uniqid(rand()));
				$sql = "INSERT INTO $temp_name(email, password, confirm) VALUES ('$myusername', '$mypassword1', '$confirm')";
				$result = mysql_query($sql);
				$message = "localhost/connected/confirmation.php?confirm=$confirm";
				$sendmail = mail($myusername, "Hi", $message);
				if ($sendmail) {
					echo "Yay, sent!";
				} else {
					"Merp. Can't send your confirmation link. Check your email?";
				}
			}
			/*
			$mypassword1 = md5($mypassword1);
			$sql = "INSERT INTO $tbl_name(username, password) VALUES ('$myusername', '$mypassword1')";
			$result = mysql_query($sql);

			if ($result) {
				echo "successful";
				echo "<br />";
				echo "<a href='main_login.php'>Log in</a>";
			} else {
				echo "ERROR";
			}
			*/
		}
	}
?>