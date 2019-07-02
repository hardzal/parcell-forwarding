			<!-- Begin Page Content -->
			<div class="container-fluid">

				<!-- Page Heading -->
				<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

				<div class="row">
					<div class="col-lg">
						<?= form_error('menu', '<div class="alert alert-danger">', '</div>'); ?>

						<?= $this->session->flashdata('message'); ?>

						<a href="" class=" btn btn-primary mb-3 tambahDataMenu" data-toggle="modal" data-target="#modalMenu">Add New Transaction</a>
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col">id</th>
									<th scope="col">Email</th>
									<th scope="col">Item Name</th>
									<th scope="col">Cost</th>
									<th scope="col">Status</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($transactions as $transaction) : ?>
									<tr>
										<th scope="row"><?= $no; ?></th>
										<td scope="row"><?= $transaction['email']; ?></td>
										<td scope="row"><?= $transaction['item_name']; ?></td>
										<td scope="row"><?= '$ ' . number_format($transaction['cost']); ?></td>
										<td scope="row"><?= status_item($transaction['id'], $this->session->userdata('role_id')); ?></td>
										<td scope="row">
											<?= is_confirmed($transaction['id']); ?>
											<a href="<?= base_url('transaction/delete/') . $transaction['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus menu ini?')">Delete</a>
										</td>
									</tr> <?php $no = $no + 1;
										endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div> <!-- /.container-fluid -->

			</div>
			<!-- End of Main Content -->
			<!-- Modal -->
			<div class="modal fade" id="modalTransaction" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="judulModalTransaction">Add New Menu</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="POST" action="">
							<div class="modal-body">
								<div class='form-group'>
									<img src='' class='img-thumbnail' />
									<input type="hidden" name="user_item_id" id="user_item_id" />
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
