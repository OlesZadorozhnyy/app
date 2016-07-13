<div class="row">
	<?php if(Session::exists('message')) : ?>
		<div class="message"><?=Session::flash('message')?></div>
	<?php endif; ?>
	<a class="btn btn-primary" href="/post/create">Create Post</a>

	<a class="btn btn-primary" href="/post/my">My posts</a>

	<div id="map" class="map-lrg"></div>
</div>
<script data-main="/webroot/js/indexPosts.js" src="/webroot/js/libs/require.js"></script>