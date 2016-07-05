<header>
	<?php if(Session::exists(Config::get('session.userId'))) : ?>
		<form method="POST" action="../user/logout">
			<input type="submit" value="Log Out">
		</form>
	<?php endif; ?>
</header>