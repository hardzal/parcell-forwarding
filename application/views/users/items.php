			<!-- Begin Page Content -->
			<div class="container-fluid">

				<!-- Page Heading -->
				<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

				<div class="row">
					<div class="col-lg">
						<?= form_error('menu', '<div class="alert alert-danger">', '</div>'); ?>

						<?= $this->session->flashdata('message'); ?>

						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col">id</th>
									<th scope="col">Item Name</th>
									<th scope="col">Item Code</th>
									<th scope="col">Cost</th>
									<th scope="col">Total</th>
									<th scope="col">Status</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($items as $item) : ?>
									<tr>
										<th scope="row"><?= $no; ?></th>
										<td><?= $item['item_name']; ?></td>
										<td><?= $item['item_code']; ?></td>
										<td><?= $item['cost']; ?></td>
										<td><?= $item['total']; ?></td>
										<td><?= status_item($item['status']); ?></td>
										<td>
											<a href="<?= base_url('item/detail/') . $item['user_item_id']; ?>" class="badge badge-info mr-2 detailDataMenu" data-toggle="modal" data-target="#modalMenu" data-id="<?= $item['user_item_id']; ?>">Detail</a>
											<a href="<?= base_url('item/verify/') . $item['user_item_id']; ?>" class="badge badge-success mr-2 editDataMenu" data-toggle="modal" data-target="#modalMenu" data-id="<?= $item['user_item_id']; ?>">Verification</a>
											<a href="<?= base_url('item/delete/') . $item['user_item_id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus menu ini?')">Delete</a> </td>
									</tr>
									<?php
									$no = $no + 1;
								endforeach;
								?>
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
						<form method="POST" action="<?= base_url('menu'); ?>">
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
