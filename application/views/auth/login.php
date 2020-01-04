<div class="container">

	<!-- Outer Row -->
	<div class="row justify-content-center">

		<div class="col-lg-8">

			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Login Form</h1>
								</div>

								<?= $this->session->flashdata('message'); ?>

								<form class="user" method="POST" action="">
									<div class="form-group">
										<input type="text" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email" value="<?= set_value('email'); ?>" />
										<?= form_error('email', "<small class='text-danger pl-3'>", "</small>"); ?>
									</div>
									<div class="form-group">
										<input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password" />
										<?= form_error('password', "<small class='text-danger pl-3'>", "</small>"); ?>
									</div>
									<button type='submit' href="index.html" class="btn btn-primary btn-user btn-block">
										Login
									</button>
									<hr>
								</form>
								<div class="text-center">
									<!-- <a class="small" href="<?= base_url('auth/'); ?>forgotPassword">Forgot Password?</a> -->
								</div>
								<div class="text-center">
									<a class="small" href="<?= base_url('auth/'); ?>signup">Create an Account!</a>
								</div>
								<div class='text-center'>
									<a href='<?= base_url(); ?>' class='badge badge-primary'>Homepage</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>
