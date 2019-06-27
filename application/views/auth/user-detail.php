<div class="container">

	<div class="card o-hidden border-0 shadow-lg my-5 col-lg-8 mx-auto">
		<div class="card-body p-0">
			<!-- Nested Row within Card Body -->
			<div class="row">
				<div class="col-lg">
					<div class="p-5">
						<div class="text-center">
							<h1 class="h4 text-gray-900 mb-4"><?= $title; ?></h1>
							<?= $this->session->userdata('verified_email'); ?>
						</div>

						<?= $this->session->flashdata('message'); ?>

						<?php echo form_open_multipart('auth/userdetail'); ?>
						<div class="form-group">
							<label for="name">Full Name</label>
							<input name="name" type="text" class="form-control" id="name" placeholder="Your Name" />
							<?= form_error('name', '<small class="text-danger pl-3">', '</small '); ?>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="gender">Gender</label>
								<select name="gender" class="form-control">
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
								<?= form_error('gender', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
							<div class="form-group col-md-6">
								<label for="phone_number">Phone Number</label>
								<input type="text" name="phone_number" class="form-control" id="phone_number" placeholder="Phone Number...">
								<?= form_error('phone_number', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group">
							<label for="birth_date">Birth date</label>
							<input type='date' name='birth_date' class='form-control' />
							<?= form_error('birth_date', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<div class="form-group mb-4">
							<label for="avatar">Avatar</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="customFile" name="avatar">
								<label class="custom-file-label" for="customFile">Choose file</label>
								<?= form_error('avatar', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group">
							<label for="inputAddress">Address</label>
							<input type="text" class="form-control" id="inputAddress" placeholder="Your Address" name="address" />
							<?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="inputState">Country</label>
								<select name="state" id="inputState" class="form-control">
									<option selected>Choose...</option>
									<?php foreach ($states as $state) : ?>
										<option value="<?= $state; ?>"><?= $state; ?></option>
									<?php endforeach; ?>
									<?= form_error('state', '<small class="text-danger pl-3">', '</small>'); ?>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="inputCity">City</label>
								<input type="text" class="form-control" id="inputCity" name="city" />
								<?= form_error('city', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
							<div class="form-group col-md-2">
								<label for="postcode">Zip</label>
								<input type="text" class="form-control" id="postcode" name="postcode" />
								<?= form_error('postcode', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<button type="submit" class="btn btn-primary">Saved</button>
						</form>
						<hr>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
