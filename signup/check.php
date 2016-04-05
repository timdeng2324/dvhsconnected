<?php
	include($_SERVER['DOCUMENT_ROOT']."/snippets/db.php");

	mysql_connect("$host", "$username", "$password") or die ("Cannot connect");
	mysql_select_db("$db") or die ("Cannot select database");

	$myfirstname = $_POST['firstname'];
	$mylastname = $_POST['lastname'];
	$myemail = $_POST['myemail'];
	$mypassword1 = $_POST['mypassword1'];
	$mypassword2 = $_POST['mypassword2'];
	$mygrade = $_POST['grade'];

	$myfirstname = mysql_real_escape_string(stripslashes($myfirstname));
	$mylastname = mysql_real_escape_string(stripslashes($mylastname));
	$myemail = mysql_real_escape_string(stripslashes($myemail));
	$mypassword1 = mysql_real_escape_string(stripslashes($mypassword1));
	$mypassword2 = mysql_real_escape_string(stripslashes($mypassword2));
	$mygrade = mysql_real_escape_string(stripslashes($mygrade));

	$sql = "SELECT * FROM $users WHERE email='$myemail'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sign Up</title>
		<link rel="stylesheet" href="/css/all.css" type="text/css" />
		<link rel="stylesheet" href="/css/generic.css" type="text/css" />
	</head>
	<body>
		<?php
			if ($count >= 1) {
				echo "
					<div>It looks like you're already a member.</div>
					<div>Try <a href='/login'>logging in</a>.</div>
				";
			} elseif ($myfirstname == "" || $mylastname == "" || $myemail == "" || $mypassword1 == "" || $mypassword2 == "") {
				echo "
					<div>Don't leave anything blank.</div>
					<div><a href='/signup'>Try again</a>.</div>
				";
			} 
			elseif (!preg_match('/.*@.*\..*/', $myemail)) {
				echo "
					<div>Your email doesn't seem very legit.</div>
					<div><a href='/signup'>Try again</a>.</div>
				";
			} else {
				if ($mypassword1 != $mypassword2) {
					echo "
						<div>Uh oh, your passwords don't match.</div>
						<div><a href='/signup'>Try again</a>.</div>
					";
				} else {
					$sql = "SELECT * FROM $temp WHERE email='$myemail'";
					$result = mysql_query($sql);
					$count = mysql_num_rows($result);
					if ($count == 1) {
						echo "
							<div>Check your email, we should have already sent you a link.</div>
							<div>Not in your inbox? <a href='mailto:support@dvhsconnected.com'>Email</a> us and we'll fix things up.</div>
						";
					} else {
						$mypassword1 = md5($mypassword1);
						$confirm = md5(uniqid(rand()));
						$myfirstname = ucfirst($myfirstname);
						$mylastname = ucfirst($mylastname);
						$sql = "INSERT INTO $temp(email, password, firstname, lastname, grade, confirm) VALUES ('$myemail', '$mypassword1', '$myfirstname', '$mylastname', '$mygrade', '$confirm')";
						$result = mysql_query($sql);

						$to = $myemail;
						$subject = "Welcome to Connect:ed";
						$message = "
							<html>
								<head>
									<title>Welcome</title>
								</head>
								<body>
									<p>Hey, $myfirstname! Thanks for signing up for DVHS Connect:ed. We're sure you're going to have a wonderful year of tutoring and eating candy. Click the link to get your account verified and sign right on in!</p>
									<p><a href=\"http://www.dvhsconnected.com/signup/confirm.php?confirm=$confirm\">http://www.dvhsconnected.com/signup/confirm.php?confirm=$confirm</a></p>
									<p>See ya around town,
									<br />
									The DVHS Connect:ed Team</p>
								</body>
							</html>
						";
						$headers = "From:DVHS Connected <support@dvhsconnected.com>\r\n";
						$headers .= 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						if (mail($to, $subject, $message, $headers)) {
							echo "
								<div>Looks like it worked! Check your email!</div>
								<div><a href='/login'>Log in</a>.</div>
							";
						} else {
							echo "
								<div>Something went wrong.</div>
								<div><a href='/signup'>Try again</a>.</div>
							";
						}
					}
				}
			}
		?>
	</body>
</html>
