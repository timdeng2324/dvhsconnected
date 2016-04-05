<?php
	$host = "localhost";
	$username = "";
	$password = "";
	$db_name = "test";
	$tbl_name = "members";
	$temp_name = "temp";

	$confirm = $_GET['confirm'];
	mysql_connect("$host", "$username", "$password") or die ("cannot connect");
	mysql_select_db("$db_name") or die ("cannot select DB");

	$sql = "SELECT * FROM $temp_name WHERE confirm='$confirm'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	if ($count == 1) {
		$rows = mysql_fetch_array($result);
		$email = $rows['email'];
		$password = $rows['password'];

		$sql = "INSERT INTO $tbl_name(username, password) VALUES ('$email', '$password')";
		$result = mysql_query($sql);
		if ($result) {
			echo "Account activated.";
			$sql = "DELETE FROM $temp_name WHERE confirm='$confirm'";
			$result = mysql_query($sql);
		} else {
			echo "Something went wrong.";
		}
	} else {
		echo "Something went wrong.";
	}
?>