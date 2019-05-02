<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<form method="post" action="<?= base_url();?>login/login_user">
		<input type="text" name="username" placeholder="username">
		<input type="password" name="password" placeholder="password">
		<input type="submit" name="submit" value="Login">
	</form>
</body>
</html>