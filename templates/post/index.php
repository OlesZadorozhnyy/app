<div class="row">
	<?php if(Session::exists('message')) : ?>
		<div class="message"><?=Session::flash('message')?></div>
	<?php endif; ?>
	<a class="btn btn-primary" href="/post/create">Create Post</a>

	<a class="btn btn-primary" href="/post/my">My posts</a>

	<?php if (count($posts) > 0) : ?>
		<ol>
			<?php foreach($posts as $post) : ?>		
				<li><?=$post['title']?></li>
			<?php endforeach; ?>
		</ol>
	<?php endif; ?>
</div>