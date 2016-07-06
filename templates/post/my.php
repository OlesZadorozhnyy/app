<?php if (count($posts) > 0) : ?>
	<table class="table">
		<thead>
			<tr>
				<th>#</th>
				<th>Title</th>
				<th colspan="2" class="text-center">Actions</th>
			</tr>
		</thead>

		<tbody>
			
			<?php foreach($posts as $key => $post) : ?>	
				<tr>
					<td><?=$key+1?></td>
					<td><?=$post['title']?></td>
					<td><a class="btn btn-primary" href="/post/update/<?=$post['id']?>">Update</a></td>	
					<td><a class="btn btn-primary" href="/post/delete/<?=$post['id']?>">Delete</a></td>
				</tr>
			<?php endforeach; ?>		
			
		</tbody>
		
	</table>
<?php endif; ?>
<a class="btn btn-primary" href="/post">Go Back</a>