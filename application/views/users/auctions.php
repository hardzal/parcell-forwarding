			<!-- Begin Page Content -->
			<div class="container-fluid">

				<!-- Page Heading -->
				<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

				<div class="row">
					<div class="col-lg">
						<?= form_error('image', '<div class="alert alert-danger">', '</div>'); ?>

						<?= $this->session->flashdata('message'); ?>
						<?php if (!isset($auctions) && empty($auctions)) : ?>
							<p>Empty auctions data</p>
						<?php else : ?>
							<table class="table table-hover">
								<thead>
									<tr>
										<th scope="col">id</th>
										<th scope="col">Item Name</th>
										<th scope="col">Price</th>
										<th scope="col">Status</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($auctions as $auction) : ?>
										<tr>
											<th scope="row"><?= $no; ?></th>
											<td><?= $auction['name']; ?></td>
											<td><?= number_format($auction['price']); ?></td>
											<td><?= status_auction($auction['id']); ?></td>
											<td>
												<?= is_user_auction($auction['id']); ?>
											</td>
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
			<!-- End of Main Content -->
			<!-- Modal -->
			<div class="modal fade" id="modalAuction" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="judulModalAuction">Add New Item</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form id="formItem" method="POST" action="">
							<div class="modal-body">
								<div class="mb-3">
									<label for="address_to">Address to</label>
									<input type="text" name="address_to" class="form-control" id="address_to" placeholder="Address To">
									<div class="invalid-feedback">
										<?= form_error('address_to', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
								</div>

								<div class="row">
									<div class="col-md-5 mb-3">
										<label for="country">Country</label>
										<select name="country" class="custom-select d-block w-100" id="country" />
										<option value="">Choose...</option>
										<?php foreach ($states as $state) : ?>
											<option value="<?= $state['id']; ?>"><?= $state['name']; ?></option>
										<?php endforeach; ?>
										</select>
										<div class="invalid-feedback">
											<?= form_error('country', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
									</div>
									<div class="col-md-4 mb-3">
										<label for="inputCity">City</label>
										<input type="text" class="form-control" id="inputCity" name="city" />
										<div class="invalid-feedback">
											<?= form_error('city', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
									</div>
									<div class="col-md-3 mb-3">
										<label for="zip">Zip</label>
										<input name="postcode" type="text" class="form-control" id="zip" />
										<div class="invalid-feedback">
											<?= form_error('postcode', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-8 mb-3">
										<label for="delivery">Delivery by</label>
										<select name="delivery" class="custom-select d-block w-100" id="delivery">
											<option value="">Choose...</option>
											<?php foreach ($deliveries as $delivery) : ?>
												<option value="<?= $delivery['id']; ?>"><?= $delivery['name']; ?></option>
											<?php endforeach; ?>
										</select>
										<div class="invalid-feedback">
											<?= form_error('delivery', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
									</div>
									<div class="col-md-4 mb-3">
										<label for="Weight">Weight (Kg)</label>
										<input type="text" class="form-control" id="weight" name="weight" min=0 />
										<div class="invalid-feedback">
											<?= form_error('weight', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
									</div>
								</div>

								<div class="mb-3">
									<label for="description">Description</label>
									<textarea name="description" class="form-control" id="description"></textarea>
									<div class="invalid-feedback">
										<?= form_error('address_to', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
								</div>

								<input type="hidden" name="item_id" id="item_id" />
								<input type="hidden" name="user_id" id="user_id" />
								<input type="hidden" name="price" id="price" />
								<input type="hidden" name="stock" id="stock" />
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary submitButton">Save changes</button>
							</div>
						</form>
					</div>
				</div>
			</div>
