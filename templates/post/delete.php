<!DOCTYPE html>
<html>
<head>
	<title>Delete Post</title>
</head>
<body>
	<h3>Do you want to delete post?</h3>

	<form method="POST" action="/post/delete/<?=$id?>">
		<input type="submit" value="Yes!">
	</form>
	<a href="/post">No!</a>
</body>
</html>