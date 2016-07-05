<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
</head>
<body>
	<?php if(Session::exists('message')) : ?>
		<div class="message"><?=Session::flash('message')?></div>
	<?php endif; ?>
	<a href="/post/create">Create Post</a>

	<a href="/post/my">My posts</a>
	
	<?php if (count($posts) > 0) : ?>
		<ul>
			<?php foreach($posts as $post) : ?>		
				<li><?=$post['title']?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	
</body>
</html>