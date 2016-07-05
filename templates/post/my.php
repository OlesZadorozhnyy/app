<!DOCTYPE html>
<html>
<head>
	<title>My Posts</title>
</head>
<body>

	<?php if (count($posts) > 0) : ?>
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th colspan="2">Actions</th>
				</tr>
			</thead>

			<tbody>
				
				<?php foreach($posts as $key => $post) : ?>	
					<tr>
						<td><?=$key+1?></td>
						<td><?=$post['title']?></td>
						<td><a href="/post/update/<?=$post['id']?>">Update</a></td>	
						<td><a href="/post/delete/<?=$post['id']?>">Delete</a></td>
					</tr>
				<?php endforeach; ?>		
				
			</tbody>
			
		</table>
	<?php endif; ?>
	<a href="/post">Go Back</a>
</body>
</html>