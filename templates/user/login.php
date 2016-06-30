<!DOCTYPE html>
<html>
<head>
	<title>Auth</title>
</head>
<body>
	<?php if(Session::exists('message')) : ?>
		<div class="message"><?=Session::flash('message')?></div>
	<?php endif; ?>

	<?php if(Session::exists('user')) : ?>
		<div>
			<span><?=Session::get('user.username')?></span>
			
			<form method="POST" action="../user/logout">
				<input type="submit" value="Log Out">
			</form>
		</div>
	<?php else : ?>
	
		<form method="POST" action="/user/login">
			<div>
				<?php if(isset($errors['login'])) : ?>
					<span class="errors"><?=$errors['login'][0]?></span>
				<?php endif; ?>
				<label>Username or E-mail:</label>
				<input type="text" name="login">
			</div>
			
			<div>
				<?php if(isset($errors['password'])) : ?>
					<span class="errors"><?=$errors['password'][0]?></span>
				<?php endif; ?>
				<label>Password:</label>
				<input type="password" name="password">
			</div>
			
			<div>
				<input type="submit" value="Log In">
			</div>
		</form>

		<a href="/user/register">Go to register!</a>
	<?php endif; ?>
</body>
</html>