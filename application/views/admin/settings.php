<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	<?= $this->session->flashdata('message'); ?>
	<div class="row">
		<div class="col-md-12 order-md-1">
			<form method="POST" action="<?= base_url('admin/settings'); ?>" id="item-input" class="needs-validation">
				<div class="mb-3">
					<label for="fb">Facebook</label>
					<input type="text" class="form-control" value="<?= $content[1]['content'];?>" name="fb" id="fb"  placeholder="Facebook"/>
					<?= form_error('fb', '<small class="text-danger pl-3">', '</small>'); ?>
				</div>

				<div class="mb-3">
					<label for="tw">Twitter</label>
					<input type="text" name="tw" class="form-control" value="<?= $content[2]['content'];?>"  id="tw" placeholder="Twitter">
					<div class="invalid-feedback">
						<?= form_error('tw', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
				</div>

				<div class="mb-3">
					<label for="ig">Instagram</label>
					<input type="text" name="ig" class="form-control" value="<?= $content[3]['content'];?>"  id="ig" placeholder="Instagram" />
					<div class="invalid-feedback">
						<?= form_error('ig', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
				</div>

				<div class="mb-3">
					<label for="email">Email</label>
					<input type="text" name="email" class="form-control"  value="<?= $content[4]['content'];?>"  id="email" placeholder="Email" /> 
					<div class="invalid-feedback">
						<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
				</div>

				<div class="mb-3">
					<label for="about">About</label>
					<textarea name="about" class="form-control" id="about" placeholder="About" ><?= $content[0]['content'];?></textarea>
					<div class="invalid-feedback">
						<?= form_error('about', '<small class="text-danger pl-3">', '</small>'); ?>
					</div>
				</div>
				<hr class="mb-4">
				<button class="btn btn-primary btn-lg" style="color:white;" type='submit'>Submit</button>
			</form>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
