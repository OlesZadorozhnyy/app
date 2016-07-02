<!DOCTYPE html>
<html>
<head>
	<title>Auth</title>
</head>
<body>
	<?php if(Session::exists('message')) : ?>
		<div class="message"><?=Session::flash('message')?></div>
	<?php endif; ?>

	
	<form method="POST" action="/user/login">
		<div>
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'login');
			endif; ?>
			<label>Username or E-mail:</label>
			<input type="text" name="login">
		</div>
		
		<div>
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'password');
			endif; ?>
			<label>Password:</label>
			<input type="password" name="password">
		</div>
		
		<div>
			<input type="submit" value="Log In">
		</div>
	</form>

	<a href="/user/register">Go to register!</a>
</body>
</html>