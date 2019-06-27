<div class="container mb-5">
	<div class="py-5 text-center">
		<h2>Item Form</h2>
		<?= $this->session->flashdata('message'); ?>
	</div>

	<div class="row">
		<div class="col-md-4 order-md-2 mb-4">
			<h4 class="d-flex justify-content-between align-items-center mb-3">
				<span class="text-muted">Your item</span>
			</h4>
			<ul class="list-group mb-3">
				<li class="list-group-item d-flex justify-content-between lh-condensed">
					<div>
						<h6 class="my-0">Product name</h6>
					</div>
					<span class="text-muted">Rp 0</span>
				</li>
				<li class="list-group-item d-flex justify-content-between lh-condensed">
					<div>
						<h6 class="my-0">Biaya Pajak</h6>
					</div>
					<span class="text-muted">Rp 0</span>
				</li>
				<li class="list-group-item d-flex justify-content-between lh-condensed">
					<div>
						<h6 class="my-0">Biaya Ongkir</h6>
					</div>
					<span class="text-muted">Rp 0</span>
				</li>
				<li class="list-group-item d-flex justify-content-between">
					<span>Total (Rp)</span>
					<strong>Rp 0</strong>
				</li>
			</ul>
			<button class="btn btn-primary btn-md btn-block" type="submit">Continue to checkout</button>
		</div>

		<div class="col-md-8 order-md-1">
			<form method="POST" action="<?= base_url('service'); ?>" class="needs-validation">
				<div class="mb-3">
					<label for="email">Email</label>
					<input type="email" class="form-control" value="<?= $user['email']; ?>" name="email" id="email" readonly />
				</div>

				<div class="mb-3">
					<label for="item_name">Item Name</label>
					<input type="text" name="item_name" class="form-control" id="item_name" placeholder="Item Name">
					<div class="invalid-feedback">
						<?= form_error('item_name', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
				</div>

				<div class="mb-3">
					<label for="item_price">Item Price</label>
					<input type="text" name="item_price" class="form-control" id="item_price" placeholder="Item Price" />
					<div class="invalid-feedback">
						<?= form_error('item_price', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
				</div>

				<div class="mb-3">
					<label for="item_total">Item Total</label>
					<input type="text" name="item_total" class="form-control" id="item_total" placeholder="Item Total" />
					<div class="invalid-feedback">
						<?= form_error('item_total', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
				</div>

				<div class="mb-3">
					<label for="address">Item Category</label>
					<select name="item_category" class="form-control">
						<?php foreach ($item_categories as $category) : ?>
							<option value="<?= $category['name']; ?>"><?= $category['name']; ?></option>
						<?php endforeach; ?>
					</select>
					<div class="invalid-feedback">
						<?= form_error('item_category', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
				</div>

				<div class="mb-3">
					<label for="address_from">Address From</label>
					<input type="text" name="address_from" class="form-control" id="address_from" placeholder="Address From">
					<div class="invalid-feedback">
						<?= form_error('address_from', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
				</div>

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
						<input type="number" class="form-control" id="weight" name="weight" min=0 />
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

				<hr class="mb-4">
				<div class="custom-control custom-checkbox">
					<input name="fragile" type="checkbox" class="custom-control-input" id="fragile" />
					<label class="custom-control-label" for="fragile">Fragile?</label>
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="same-address">
					<label class="custom-control-label" for="same-address">Shipping address is the same as my account address</label>
				</div>
				<div class="custom-control custom-checkbox">
					<input type="checkbox" class="custom-control-input" id="save-info">
					<label class="custom-control-label" for="save-info">Save this information for next time</label>
				</div>
				<hr class="mb-4">
				<button class="btn btn-primary btn-lg btn-block" type="submit" id="calculate">Calculate</button>
			</form>
		</div>
	</div>

</div>

<script>
	// Example starter JavaScript for disabling form submissions if there are invalid fields
	(function() {
		'use strict';

		window.addEventListener('load', function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.getElementsByClassName('needs-validation');

			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		}, false);
	})();
</script>
