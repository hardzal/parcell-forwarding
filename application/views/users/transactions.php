			<!-- Begin Page Content -->
			<div class="container-fluid">

				<!-- Page Heading -->
				<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

				<div class="row">
					<div class="col-lg">

						<?= $this->session->flashdata('message'); ?>

						<?php if (!isset($transactions) && empty($transactions)) : ?>
							<p>Empty transaction data</p>
						<?php else : ?>
							<table class="table table-hover">
								<thead>
									<tr>
										<th scope="col">id</th>
										<th scope="col">Item Name</th>
										<th scope="col">Item Code</th>
										<th scope="col">Cost</th>
										<th scope="col">Total</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($transactions as $transaction) : ?>
										<tr>
											<th scope="row"><?= $no; ?></th>
											<td><?= $transaction['item_name']; ?></td>
											<td><?= $transaction['item_code']; ?></td>
											<td><?= $transaction['cost']; ?></td>
											<td><?= $transaction['total']; ?></td>
											<td>
												<a href="<?= base_url('transaction/detail/') . $transaction['user_item_id']; ?>" class="badge badge-info mr-2 detailDataItem" data-toggle="modal" data-target="#modalTransaction" data-id="<?= $transaction['user_item_id']; ?>">Detail</a>
												<a href="<?= base_url('item/delete/') . $transaction['user_item_id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus item ini?')">Delete</a> </td>
										</tr>
										<?php
										$no = $no + 1;
									endforeach;
									?>
								</tbody>
							</table>
						<?php endif; ?>
					</div>
				</div>
			</div> <!-- /.container-fluid -->

			</div>
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
