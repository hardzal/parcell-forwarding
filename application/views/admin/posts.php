<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	<?= $this->session->flashdata('message'); ?>

	<div class='row'>
		<div class='col-lg'>
			<a href="" class=" btn btn-primary mb-3 tambahPost" data-toggle="modal" data-target="#modalPost">Add New Post</a>
			<?php
			$no = 1;
			if (sizeof($posts) === 0) :
				?>
				<p>Empty Data Posts</p>
			<?php else : ?>
				<table class="table table-hover">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Title</th>
							<th scope="col">Image</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($posts as $post) : ?>
							<tr>
								<td><?= $no; ?></td>
								<td><?= $post['title']; ?></td>
								<td><img src='<?= base_url("assets/img/posts/") . $post['image']; ?>' alt='<?= $post['title']; ?>' title='<?= $post['title']; ?>' width='50' /></td>
								<td>
									<a href="<?= base_url('post/edit/') . $post['id']; ?>" class="badge badge-success mr-2 editPost" data-toggle="modal" data-target="#modalPost" data-id="<?= $post['id']; ?>">Edit</a>
									<a href="<?= base_url('post/delete/') . $post['id']; ?>" class="badge badge-danger" onclick="return confirm(' Apakah kamu yakin ingin menghapus post ini?')">Delete</a>
								</td>
							</tr>
							<?php
							$no = $no + 1;
						endforeach; ?>
					</tbody>
				</table>
			<?php endif; ?>
		</div>

	</div>
	<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Modal -->
<div class="modal fade" id="modalPost" tabindex=" -1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="judulModalPost">Add New Post</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="<?= base_url('admin/posts'); ?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class='form-group'>
						<label for="title">Title</label>
						<input type='text' class='form-control' id='title' name='title' placeholder='Title' />
					</div>
					<div class='form-group'>
						<label for="image">Image</label>
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="customFile" name="image" />
							<label class="custom-file-label" for="customFile">Choose file</label>
						</div>
					</div>
					<div class='form-group'>
						<label for="description">Description</label>
						<textarea class='form-control' id='description' name='description' placeholder='description'>
						</textarea>
					</div>
				</div>
				<div class='modal-footer'>
					<button type='submit' class='btn btn-secondary' data-dismiss='modal'>Close</button>
					<button type='submit' class='btn btn-primary submitButton'>Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
