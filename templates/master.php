<!DOCTYPE html>
<html lang="en">
<head>
	<title><?=$title?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/webroot/css/libs/bootstrap.min.css">
</head>
<body>
	<header class="page-header row">
		<?php if(Session::exists(Config::get('session.userId'))) : ?>
			<div class="col-md-3 col-md-offset-1">
				<form method="POST" action="../user/logout">
					<input class="btn btn-default" type="submit" value="Log Out">
				</form>
			</div>
		<?php endif; ?>
	</header>
	<div class="container">
		<?php include $content ?>
	</div>

	<footer class="navbar-fixed-bottom text-center">
		&copy;<?=date('Y')?>
	</footer>
</body>
</html>