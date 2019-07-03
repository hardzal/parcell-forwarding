			<!-- Begin Page Content -->
			<div class="container-fluid">

				<!-- Page Heading -->
				<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

				<div class="row">
					<div class="col-lg">

						<?= $this->session->flashdata('message'); ?>

						<?php if (!isset($auctions) && empty($auctions)) : ?>
							<p>Empty Auctions List</p>
						<?php else : ?>
							<table class="table table-hover">
								<thead>
									<tr>
										<th scope="col">id</th>
										<th scope="col">Item Name</th>
										<th scope="col">Price</th>
										<th scope="col">Deadline</th>
										<th scope="col">Status</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($auctions as $auction) : ?>
										<tr>
											<th scope="row"><?= $auction['id']; ?></th>
											<td><?= $auction['item_name']; ?></td>
											<td>$ <?= number_format($auction['price']); ?></td>
											<td><?= Date('H:i:s d F y', $auction['deadline']); ?></td>
											<td><?= is_auction_expired($auction['id']); ?></td>
											<td>
												<a href="<?= base_url('auction/edit/') . $auction['id']; ?>" class="badge badge-success mr-2 editDataAuction" data-toggle="modal" data-target="#modalAuction" data-id="<?= $auction['id']; ?>">Edit</a>
												<a href="<?= base_url('auction/delete/') . $auction['id']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure to delete this ?')">Delete</a> </td>
										</tr> <?php endforeach; ?>
								</tbody>
							</table>
						<?php endif; ?>
					</div>
				</div>
			</div> <!-- /.container-fluid -->

			</div>
			<!-- End of Main Content -->
			<!-- Modal -->
			<div class="modal fade" id="modalAuction" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="judulModalAuction">Add New Menu</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="POST" action="<?= base_url('admin/items'); ?>">
							<div class="modal-body">
								<div class='form-group'>
									<label for="item_name">Item Name</label>
									<input type='text' class='form-control' id='item_name' name='item_name' placeholder='Item Name' readonly />
								</div>
								<div class='form-group'>
									<label for='price'>Item Price</label>
									<input type='text' class='form-control' id='price' name='price' placeholder='Item Price' />
								</div>
								<div class='form-group'>
									<label for='stock'>Item Stock</label>
									<input type='text' class='form-control' id='stock' name='stock' placeholder='Item Stock' />
								</div>
								<div class='form-group'>
									<label for='status'>Status</label>
									<select name='status' class='form-control' id='status'>
										<option value='1'>Aktif</option>
										<option value='0'>Tidak aktif</option>
									</select>
								</div>
								<input type='hidden' value='' name='auction_id' id='auction_id' />
								<input type='hidden' value='' name='item_id' id='item_id' />
							</div>
							<div class='modal-footer'>
								<button type='submit' class='btn btn-secondary' data-dismiss='modal'>Close</button>
								<button type='submit' class='btn btn-primary submitButton'>Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
