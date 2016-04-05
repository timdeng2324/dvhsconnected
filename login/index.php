<?php
	session_start();
	if (isset($_SESSION['email'])) {
		header("location:/me");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="../css/login.css" type="text/css" />
		<link rel="stylesheet" href="../css/all.css" type="text/css" />
		<script src="/js/track.js" type="text/javascript"></script>
	</head>
	<body>
		<div>
			<form name="login" method="post" action="/login/check.php">
				<table>
					<tr>
						<td colspan="2" class="heading">
							Log In
						</td>
					</tr>
					<tr>
						<td>Email:</td>
						<td>
							<input name="myemail" type="text" autofocus />
						</td>
					</tr>
					<tr>
						<td>Password:</td>
						<td>
							<input name="mypassword" type="password" />
						</td>
					</tr>
					<tr>
						<td colspan="2" class="right">
							<input name="submit" type="submit" value="Log In" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							No account? <a href="/signup">Sign up</a>!
						</td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>