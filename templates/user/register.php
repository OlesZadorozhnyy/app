<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
</head>
<body>
	<form method="POST" action="/user/register">
		<div>
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'username');
			endif; ?>
			<label>Username:</label>
			<input type="text" name="username" value="<?=Request::input('username')?>">
		</div>

		<div>
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'email');
			endif; ?>
			<label>E-mail:</label>
			<input type="text" name="email" value="<?=Request::input('email')?>">
		</div>

		<div>
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'password');
			endif; ?>
			<label>Password:</label>
			<input type="password" name="password">
		</div>

		<div>
			<label>Confirm password:</label>
			<input type="password" name="confirmPassword">
		</div>

		<div>
			<input type="submit" name="Register">
		</div>
	</form>

	<a href="/user/login">Go Back</a>
</body>
</html>