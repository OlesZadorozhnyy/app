<!DOCTYPE html>
<html>
<head>
	<title>Update Post</title>
</head>
<body>
	<form method="POST" action="/post/update/<?=$id?>">
		<div>
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'title');
			endif; ?>
			<label>Title:</label>
			<input type="text" name="title" value="<?=$data[0]['title']?>">
		</div>

		<div>
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'body');
			endif; ?>
			<label>Body:</label>
			<input type="text" name="body" value="<?=$data[0]['body']?>">
		</div>

		<div>
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'lat');
			endif; ?>
			<label>Lat:</label>
			<input type="text" name="lat" value="<?=$data[0]['lat']?>">
		</div>

		<div>
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'lng');
			endif; ?>
			<label>Lng:</label>
			<input type="text" name="lng" value="<?=$data[0]['lng']?>">
		</div>

		<div>
			<input type="submit" value="Update">
		</div>
	</form>

	<a href="/post">Go Back</a>
</body>
</html>