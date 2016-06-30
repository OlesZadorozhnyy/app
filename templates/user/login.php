<form method="post" action="/user/login">
	<input type="text" name="username">
	<input type="text" name="username2">
	<input type="submit" name="go">
</form>

<?php if (isset($errors)) {
	var_dump($errors);
}