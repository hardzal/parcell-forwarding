			<!-- Begin Page Content -->
			<div class="container-fluid">

				<!-- Page Heading -->
				<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

				<div class="row">
					<div class="col-lg">
						<?= form_error('menu', '<div class="alert alert-danger">', '</div>'); ?>

						<?= $this->session->flashdata('message'); ?>

						<a href="" class=" btn btn-primary mb-3 tambahDataMenu" data-toggle="modal" data-target="#modalMenu">Add New User</a>
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col">id</th>
									<th scope="col">Email</th>
									<th scope="col">Name</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($users as $user) : ?>
									<tr>
										<td scope="row"><?= $user['id']; ?></td>
										<td scope="row"><?= $user['email']; ?></td>
										<td scope="row"><?= $user['name']; ?></td>
										<td scope="row">
											<a href="<?= base_url('user/edit/') . $user['id']; ?>" class="badge badge-success mr-2 editDataMenu" data-toggle="modal" data-target="#modalMenu" data-id="<?= $user['id']; ?>">Edit</a>
											<a href="<?= base_url('user/delete/') . $user['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus user ini?')">Delete</a> </td>
									</tr> <?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div> <!-- /.container-fluid -->

			</div>
			<!-- End of Main Content -->
			<!-- Modal -->
			<div class="modal fade" id="modalMenu" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="judulModalMenu">Add New Menu</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="POST" action="<?= base_url('admin/users'); ?>" enctype="multipart/form-data">
							<div class="modal-body">
								<div class='form-group'>
									<input type='text' class='form-control' id='menu' name='menu' placeholder='Menu name' />
									<input type="hidden" name="id" id="id" />
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary submitButton">Save changes</button>
							</div>
						</form>
					</div>
				</div>
			</div>
