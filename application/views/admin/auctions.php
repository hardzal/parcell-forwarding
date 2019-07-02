			<!-- Begin Page Content -->
			<div class="container-fluid">

				<!-- Page Heading -->
				<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

				<div class="row">
					<div class="col-lg">

						<?= $this->session->flashdata('message'); ?>

						<a href="" class=" btn btn-primary mb-3 tambahDataItem" data-toggle="modal" data-target="#modalItem">Add New Item</a>

						<?php if (!isset($auctions) && empty($auctions)) : ?>
							<p>Empty Auctions List</p>
						<?php else : ?>
							<table class="table table-hover">
								<thead>
									<tr>
										<th scope="col">id</th>
										<th scope="col">Item Name</th>
										<th scope="col">Category</th>
										<th scope="col">Price</th>
										<th scope="col">Stock</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($auctions as $auction) : ?>
										<tr>
											<th scope="row"><?= $auction['id']; ?></th>
											<td><?= $auction['item_name']; ?></td>
											<td><?= $auction['item_category']; ?></td>
											<td><?= number_format($auction['price']); ?></td>
											<td><?= $auction['stock']; ?></td>
											<td>
												<a href="<?= base_url('item/edit/') . $auction['id']; ?>" class="badge badge-success mr-2 editDataItem" data-toggle="modal" data-target="#modalItem" data-id="<?= $auction['id']; ?>">Edit</a>
												<a href="<?= base_url('item/delete/') . $auction['id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus menu ini?')">Delete</a> </td>
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
			<div class="modal fade" id="modalItem" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="judulModalItem">Add New Menu</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form method="POST" action="<?= base_url('admin/items'); ?>">
							<div class="modal-body">
								<div class='form-group'>
									<label for="item_name">Item Name</label>
									<input type='text' class='form-control' id='item_name' name='item_name' placeholder='Item Name' />
								</div>
								<div class='form-group'>
									<label for="item_category">Item Category</label>
									<select name="item_category" class="form-control">
										<?php foreach ($item_categories as $category) : ?>
											<option value=" <?= $category['id']; ?>" "><?= $category['name']; ?></option>
											<?php endforeach; ?>
										</select>
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
										<input type='checkbox' id='fragile' name='fragile'/>
										<label for='fragile'>Fragile?</label>
									</div>
									<input type='hidden' value='' name='id' id='id' />
									</div>
									<div class='modal-footer'>
										<button type='submit' class='btn btn-secondary' data-dismiss='modal'>Close</button>
										<button type='submit' class='btn btn-primary submitButton'>Submit</button>
									</div>
							</form>
						</div>
					</div>
				</div>
