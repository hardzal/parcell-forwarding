<main role="main">
	<div class="container marketing">
		<div class='content'>
			<?php foreach ($posts as $post) : ?>
				<h2><a href='<?= base_url(); ?>' title='<?= $post['title']; ?>'><?= $post['title']; ?></a></h2>
				<p><?= $post['description']; ?></p>
				<hr class="featurette-divider my-3">
			<?php endforeach; ?>
		</div>
	</div>
