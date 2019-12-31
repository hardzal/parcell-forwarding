			<!-- Begin Page Content -->
			<div class="container-fluid">

				<!-- Page Heading -->
				<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

				<div class="row">
					<div class="col-lg">
						<?= form_error('image', '<div class="alert alert-danger">', '</div>'); ?>

						<?= $this->session->flashdata('message'); ?>
						<div class='row'>
							<div class='col-md-6'>
								<form method="POST" action="<?= base_url('user/items'); ?>">
									<div class="input-group mb-3">
										<input type="text" name="keyword" class="form-control" placeholder="Search keyword..." autocomplete="off" autofocus>
										<div class="input-group-append">
											<input class="btn btn-primary" type="submit" name="search" id="search" value="Search" />
										</div>
									</div>
								</form>
							</div>
						</div>

						<a href="" class=" btn btn-primary mb-3 tambahDataItem" data-toggle="modal" data-target="#modalItem">Add New Item</a>
						<a href="<?= base_url('item/report'); ?>" class=" btn btn-info mb-3 ml-3">Export</a>

						<?php if (empty($items)) : ?>
							<div class='alert alert-danger'>
								Data not found!
							</div>
						<?php endif; ?>
						<?php if ($this->input->post('search') && !empty($items)) : ?>
							<p>Result : <?= $result_total_rows; ?></p>
						<?php endif; ?>
						<table class="table table-hover">
							<thead>
								<tr>
									<th scope="col">id</th>
									<th scope="col">Item Name</th>
									<th scope="col">Item Code</th>
									<th scope="col">Cost</th>
									<th scope="col">Total</th>
									<th scope='col'>Deadline</th>
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
										<td>$ <?= number_format($item['cost_total']); ?></td>
										<td><?= $item['total']; ?></td>
										<td><?= date('H:i:s - d F y', $item['deadline']); ?></td>
										<td><?= status_item($item['user_item_id'], $this->session->userdata('role_id')); ?></td>
										<td>
											<?= is_verified($item['user_item_id']); ?>
											<a href="<?= base_url('item/report/') . $item['user_item_id']; ?>" class="badge badge-info mr-2">Export</a>
											<a href="<?= base_url('item/delete/') . $item['user_item_id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus menu ini?')">Delete</a>
										</td>
									</tr>
								<?php
									$no = $no + 1;
								endforeach;
								?>
							</tbody>
						</table>
						<?= $this->pagination->create_links(); ?>
					</div>
				</div>
			</div> <!-- /.container-fluid -->

			</div>
			<!-- End of Main Content -->
			<!-- Modal -->
			<div class="modal fade" id="modalItem" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="judulModalItem">Add New Item</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form id="formItem" method="POST" action="" enctype="multipart/form-data">
							<div class="modal-body">
								<div class='form-group'>
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="image" name="image" />
										<label class="custom-file-label" for="image" style="cursor:pointer;">Choose file</label>
									</div>
								</div>

								<input type="hidden" name="user_item_id" id="user_item_id" />
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary submitButton">Save changes</button>
							</div>
						</form>
					</div>
				</div>
			</div>
