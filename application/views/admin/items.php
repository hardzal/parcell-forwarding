			<!-- Begin Page Content -->
			<div class="container-fluid">

				<!-- Page Heading -->
				<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
				<div class="row">
					<div class="col-lg">

						<?= $this->session->flashdata('message'); ?>
						<div class='row'>
							<div class='col-md-6'>
								<form method="POST" action="<?= base_url('admin/items'); ?>">
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
						<a href="<?= base_url('item/export'); ?>" class=" btn btn-info mb-3 ml-3">Export</a>

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
									<th scope="col">No</th>
									<th scope="col">Item Name</th>
									<th scope="col">Category</th>
									<th scope="col">Price</th>
									<th scope="col">Stock</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($items as $item) : ?>
									<tr>
										<th scope="row"><?= ++$start; ?></th>
										<td><?= $item['item_name']; ?></td>
										<td><?= $item['category_name']; ?></td>
										<td>$ <?= number_format($item['price']); ?></td>
										<td><?= $item['stock']; ?></td>
										<td>
											<a href="<?= base_url('item/edit/') . $item['item_id']; ?>" class="badge badge-primary mr-2 editDataItem" data-toggle="modal" data-target="#modalItem" data-id="<?= $item['item_id']; ?>">Edit</a>
											<a href="<?= base_url('item/export/') . $item['item_id']; ?>" class="badge badge-info mr-2" target="_blank">Export</a>
											<a href="<?= base_url('item/delete/') . $item['item_id']; ?>" class="badge badge-danger" onclick="return confirm('Apakah kamu yakin ingin menghapus item ini?')">Delete</a>
										</td>
									</tr> <?php endforeach; ?>
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
