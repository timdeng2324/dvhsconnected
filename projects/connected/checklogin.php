<?php
	session_start();
	ob_start();
	$host = "localhost"; // $host = "sql.dvhsconnect.com";
	$username = "";
	$password = "";
	$db_name = "test"; // $db_name = "dvhsconnectedusers";
	$tbl_name = "members"; // tbl_name = "users";

	mysql_connect("$host", "$username", "$password") or die ("cannot connect");
	mysql_select_db("$db_name") or die ("cannot select DB");

	$myusername = $_POST['myusername'];
	$mypassword = $_POST['mypassword'];

	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysql_real_escape_string($myusername);
	$mypassword = mysql_real_escape_string($mypassword);
	$mypassword = md5($mypassword);
	$sql = "SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
	$result = mysql_query($sql);

	$count = mysql_num_rows($result);

	if ($count == 1) {
		$_SESSION['username'] = $myusername;
		$_SESSION['password'] = $mypassword;
		// echo $_SESSION['username'];
		header("location:login_success.php");
	} else {
		echo "Wrong Username or Password";
	}
	ob_end_flush();
?>