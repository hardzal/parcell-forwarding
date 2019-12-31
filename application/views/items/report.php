<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Item Report</title>
	<style type='text/css'>
		body {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}

		table,
		tr,
		th,
		td {
			border: 1px solid #000;
			border-collapse: border-collapse;
			padding: 5px;
		}

		th {
			text-align: left;
		}

		.header {
			overflow: hidden;
		}

		div.title {
			overflow: hidden;
			text-align: center;
		}

		h1.title {
			margin-bottom: 3px;
		}

		.deadline {
			font-size: 20px;
		}

		.logo {
			width: 10%;
			margin: 5px;
			float: left;
			text-align: left;
		}

		img {
			width: 100%;
		}

		.footnote {
			text-align: center;
		}
	</style>
</head>

<body>
	<div class='header'>

		<div class='logo'>
			<img src='<?= base_url(); ?>/assets/img/logo-nobg.png' alt='logo' title='logo' />
		</div>
		<div class='title'>
			<h1 class='title'>Parcell-Forwarding</h1>
			<p>Email: ParcelForwading@gmail.com - Customer service : 557830028<br />
				Website :parcell-forwading.com</p>
		</div>
	</div>
	<hr />
	<?php if (count($items)) : ?>
		<table width="100%">
			<tr style="background-color: skyblue;">
				<th>No</th>
				<th>Item Name</th>
				<th>Price</th>
				<th>Stock</th>
				<th>Weight</th>
				<th>Fragile</th>
				<th>Category</th>
			</tr>
			<?php $i = 1;
			foreach ($items as $item) : ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= $item['name']; ?></td>
					<td><?= number_format($item['price']); ?></td>
					<td><?= $item['stock']; ?></td>
					<td><?= $item['weight']; ?></td>
					<td><?= $item['is_broken'] == 1 ? "Yes" : "No"; ?></td>
					<td><?= $item['category_name']; ?></td>
				</tr>
			<?php
			endforeach; ?>
		</table>

		<div class='footnote'>
			<p>Item total : <?= $i - 1; ?></p>
			<p>Tercatat terakhir : <?= date('H:i:s d F Y', time()); ?></p>
		</div>

	<?php else : ?>
		<p>Belum ada Transaksi yang tercatat</p>
	<?php endif; ?>
</body>

</html>
