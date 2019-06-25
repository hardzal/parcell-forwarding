			<!-- Begin Page Content -->
			<div class="container-fluid">

				<!-- Page Heading -->
				<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
				<?= $this->session->flashdata('message'); ?>
				<div class="row">
					<div class="col-lg-8">
						<?php echo form_open_multipart('user/editprofile'); ?>

						<div class="form-group row">
							<label for="email" class="col-lg-4 col-form-label">Email</label>
							<div class="col-lg-8">
								<input type="text" class="form-control" id="email" placeholder="Email" name="email" value="<?= $user['email']; ?>" readonly />
							</div>
						</div>

						<div class="form-group row">
							<label for="name" class="col-lg-4 col-form-label">Full Name</label>
							<div class="col-lg-8">
								<input type="text" class="form-control" id="name" placeholder="Name" name="name" value="<?= $user['name']; ?>" />
								<?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-lg-4">Avatar</div>
							<div class="col-lg-8">
								<div class="row">
									<div class="col-lg-3">
										<img src='<?= base_url("assets/img/profile/") . $user['avatar']; ?>' class=' img-thumbnail' />
									</div>
									<div class='col-lg-9'>
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="image" name="avatar" />
											<label class="custom-file-label" for="image">Choose file</label>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="form-group row">
							<label for="phone_number" class="col-lg-4 col-form-label">Phone Number</label>
							<div class="col-lg-8">
								<input type="text" class="form-control" id="phone_number" placeholder="Phone Number" name="phone_number" value="<?= $user['phone_number']; ?>" />
							</div>
						</div>

						<div class="form-group row">
							<label for="gender" class="col-lg-4 col-form-label">Gender</label>
							<div class="col-lg-8">
								<select name="gender" class="form-control" id="gender">
									<option value="Male" <?= $user['gender'] == "Male" ? "selected" : ""; ?>>Male</option>
									<option value="Female" <?= $user['gender'] == "Female" ? "selected" : ""; ?>>Female</option>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label for="birth_date" class="col-lg-4 col-form-label">Birth date</label>
							<div class="col-lg-8">
								<input type="date" class="form-control" id="birth_date" name="birth_date" value="<?= $user['birth_date']; ?>" />
							</div>
						</div>

						<div class="form-group row">
							<label for="address" class="col-lg-4 col-form-label">Address</label>
							<div class="col-lg-8">
								<input type="text" class="form-control" id="address" placeholder="Address" name="address" value="<?= $user['address']; ?>" />
							</div>
						</div>
						<div class="form-group row">
							<label for="inputCity" class="col-lg-4 col-form-label">City</label>
							<div class="col-lg-8">
								<input type="text" class="form-control" id="inputCity" name="city" value="<?= $user['city']; ?>" />
								<?= form_error('city', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="inputState" class="col-lg-4 col-form-label">State</label>
							<div class="col-lg-8">
								<select name="state" id="inputState" class="form-control">
									<option>Choose...</option>
									<?php foreach ($states as $state) : ?>
										<?php if ($state == $user['state']) : ?>
											<option value="<?= $state; ?>" selected><?= $state; ?></option>
										<?php else : ?>
											<option value="<?= $state; ?>"><?= $state; ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
									<?= form_error('state', '<small class="text-danger pl-3">', '</small>'); ?>
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label for="postcode" class="col-lg-4 col-form-label">Zip</label>
							<div class="col-lg-8">
								<input type="text" class="form-control" id="postcode" name="postcode" value="<?= $user['postcode']; ?>" />
								<?= form_error('postcode', '<small class="text-danger pl-3">', '</small>'); ?>
							</div>
						</div>

						<div class="form-group row justify-content-end">
							<div class="col-lg-10">
								<input type='hidden' name='user_id' value='<?= $user['user_id']; ?>' />
								<button type="submit" class="btn btn-primary">Edit</button>
							</div>
						</div>

						</form>
					</div>
				</div>

			</div>
			<!-- /.container-fluid -->

			</div>
			<!-- End of Main Content -->
