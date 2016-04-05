<?php
	session_start();
	ob_start();

	include($_SERVER['DOCUMENT_ROOT']."/snippets/db.php");

	mysql_connect("$host", "$username", "$password") or die ("Cannot connect");
	mysql_select_db("$db") or die ("Cannot select database");

	$myemail = $_POST['myemail'];
	$mypassword = $_POST['mypassword'];

	$myemail = mysql_real_escape_string(stripslashes($myemail));
	$mypassword = mysql_real_escape_string(stripslashes($mypassword));

	$mypassword = md5($mypassword);

	$sql = "SELECT * FROM $users WHERE email='$myemail' and password='$mypassword'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	if ($count == 1) {
		$_SESSION['email'] = $myemail;
		$_SESSION['password'] = $mypassword;

		header("location:/me");
	} else {
		header("location:/login/wrong.html");
	}
	ob_end_flush();
?>