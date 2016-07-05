<!DOCTYPE html>
<html>
<head>
	<title>Create Post</title>
</head>
<body>
	<form method="POST" action="/post/create">
		<div>
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'title');
			endif; ?>
			<label>Title:</label>
			<input type="text" name="title" value="<?=Request::input('title')?>">
		</div>

		<div>
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'body');
			endif; ?>
			<label>Body:</label>
			<input type="text" name="body" value="<?=Request::input('body')?>">
		</div>

		<div>
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'lat');
			endif; ?>
			<label>Lat:</label>
			<input type="text" name="lat" value="<?=Request::input('lat')?>">
		</div>

		<div>
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'lng');
			endif; ?>
			<label>Lng:</label>
			<input type="text" name="lng" value="<?=Request::input('lng')?>">
		</div>

		<div>
			<input type="submit" value="Save">
		</div>
	</form>

	<a href="/post">Go Back</a>
</body>
</html>