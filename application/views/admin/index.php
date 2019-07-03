<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	<?= $this->session->flashdata('message'); ?>
	<p>Hello, Selamat datang kembali!</p><br/>
	<div class='row'>
		<div class='col-lg'>
			<p>Jumlah Member hingga saat ini : <?= $member['total_user'];?> member</p><br>
		</div>
	</div>
	<div class='row'>
	<div class='col-lg'>
			<p>Jumlah Transaksi hingga saat ini : <?= $transaksi['total_transaction'];?> Transaksi</p><br>
		</div>
	</div>
	<div class='row'>
	<div class='col-lg'>
			<p>Jumlah Pendapatan hingga saat ini : $ <?= number_format($pendapatan['total_cost']);?> </p><br>
		</div>
	</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
