<header>
	<?php if(Session::exists('user')) : ?>
		<form method="POST" action="../user/logout">
			<input type="submit" value="Log Out">
		</form>
	<?php endif; ?>
</header>