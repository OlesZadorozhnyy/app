<div class="row">
	<form method="POST" class="form-horizontal" action="<?php echo (isset($data)) ? '/post/update/' . $data['id'] : '/post/create';?>">
		<div class="form-group">
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'title');
			endif; ?>
			<label for="title">Title:</label>
			<input type="text" class="form-control" id="title" name="title" value="<?php echo (isset($data)) ? $data['title'] : Request::input('title');?>">
		</div>

		<div class="form-group">
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'body');
			endif; ?>
			<label for="body">Body:</label>
			<input type="text" class="form-control" id="body" name="body" value="<?php echo (isset($data)) ? $data['body'] : Request::input('body');?>">
		</div>

		<div class="form-group">
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'lat');
			endif; ?>
			<label for="lat">Lat:</label>
			<input type="text" class="form-control" id="lat" name="lat" value="<?php echo (isset($data)) ? $data['lat'] : Request::input('lat');?>">
		</div>

		<div class="form-group">
			<?php if (isset($errors)) :
				echo Helper::showErrors($errors, 'lng');
			endif; ?>
			<label for="lng">Lng:</label>
			<input type="text" class="form-control" id="lng" name="lng" value="<?php echo (isset($data)) ? $data['lng'] : Request::input('lng');?>">
		</div>

		<div>
			<input class="btn btn-success" type="submit" value="Save">
		</div>
	</form>

	<a class="btn btn-primary" href="/post">Go Back</a>
</div>