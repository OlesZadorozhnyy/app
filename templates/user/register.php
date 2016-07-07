<div class="row">
	<form class="form-horizontal" method="POST" action="/user/register">
		<div class="form-group">
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'username');
			endif; ?>
			<label for="username">Username:</label>
			<input type="text" class="form-control" id="username" name="username" value="<?=Request::input('username')?>">
		</div>

		<div class="form-group">
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'email');
			endif; ?>
			<label for="email">E-mail:</label>
			<input type="text" class="form-control" id="email" name="email" value="<?=Request::input('email')?>">
		</div>

		<div class="form-group">
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'password');
			endif; ?>
			<label for="password">Password:</label>
			<input type="password" class="form-control" id="password" name="password">
		</div>

		<div class="form-group">
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'confirmPassword');
			endif; ?>
			<label for="confirmPassword">Confirm password:</label>
			<input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
		</div>

		<div class="form-group">
			<input class="btn btn-success" type="submit" value="Register">
		</div>
	</form>

	<a class="btn btn-primary" href="/user/login">Go Back</a>
</div>