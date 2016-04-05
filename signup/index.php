<!DOCTYPE html>
<html>
	<head>
		<title>Sign Up</title>
		<link rel="stylesheet" href="../css/signup.css" type="text/css" />
		<link rel="stylesheet" href="../css/all.css" type="text/css" />
		<script src="/js/track.js" type="text/javascript"></script>
	</head>
	<body>
		<div>
			<form name="signup" method="post" action="check.php">
				<table>
					<tr>
						<td colspan="2" class="heading">
							Sign Up
						</td>
					</tr>
					<tr>
						<td>
							First name:
						</td>
						<td>
							<input name="firstname" type="text" maxlength="65" />
						</td>
					</tr>
					<tr>
						<td>
							Last name:
						</td>
						<td>
							<input name="lastname" type="text" maxlength="65" />
						</td>
					</tr>
					<tr>
						<td>
							Email:
						</td>
						<td>
							<input name="myemail" type="text" maxlength="65" />
						</td>
					</tr>
					<tr>
						<td>
							Password:
						</td>
						<td>
							<input name="mypassword1" type="password" maxlength="65" />
						</td>
					</tr>
					<tr>
						<td>
							Confirm password:
						</td>
						<td>
							<input name="mypassword2" type="password" maxlength="65" />
						</td>
					</tr>
					<tr>
						<td>
							Grade:
						</td>
						<td>
							<input name="grade" type="text" maxlength="65" />
						</td>
					</tr>
					<tr>
						<td colspan="2" class="right">
							<input name="submit" type="submit" value="Sign Up" />
						</td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>