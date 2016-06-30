<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
</head>
<body>
	<form method="POST" action="/user/register">
		<div>
			<?php if(isset($errors['username'])) : ?>
				<span class="errors"><?=$errors['username'][0]?></span>
			<?php endif; ?>
			<label>Username:</label>
			<input type="text" name="username" value="<?=Request::input('username')?>">
		</div>

		<div>
			<?php if(isset($errors['email'])) : ?>
				<span class="errors"><?=$errors['email'][0]?></span>
			<?php endif; ?>
			<label>E-mail:</label>
			<input type="text" name="email" value="<?=Request::input('email')?>">
		</div>

		<div>
			<?php if(isset($errors['password'])) : ?>
				<span class="errors"><?=$errors['password'][0]?></span>
			<?php endif; ?>
			<label>Password:</label>
			<input type="password" name="password">
		</div>

		<div>
			<label>Confirm password:</label>
			<input type="password" name="confirm_password">
		</div>

		<div>
			<input type="submit" name="Register">
		</div>
	</form>

	<a href="/user/login">Go Back</a>
</body>
</html>