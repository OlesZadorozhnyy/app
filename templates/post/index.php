<script type="text/template" id="infoWindowPostTemplate">
	<div>
		<div class="header"><h2>{{title}}</h2></div>

		<div>
			<label>Creator:</label>
			<span>{{user}}</span>
		</div>
		<div class="content">
			{{body}}
		</div>
	</div>
</script>

<div class="row">
	<div id="message-row">
		<?php if(Session::exists('message')) : ?>
			<div class="message"><?=Session::flash('message')?></div>
		<?php endif; ?>
	</div>
	
	<a class="btn btn-primary" href="/post/create">Create Post</a>

	<a class="btn btn-primary" href="/post/my">My posts</a>

	<div id="map" class="map-lrg"></div>
</div>
<script data-main="/webroot/js/indexPosts.js" src="/webroot/js/libs/require.js"></script>