<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>User Report</title>
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
	<?php if (count($users)) : ?>
		<table width="100%">
			<tr style="background-color: skyblue;">
				<th>No</th>
				<th>Fullname</th>
				<th>Email</th>
				<th>Birth Date</th>
				<th>Phone Number</th>
				<th>Gender</th>
				<th>Address</th>
				<th>Avatar</th>
			</tr>
			<?php $i = 1;
			foreach ($users as $user) : ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= $user['name']; ?></td>
					<td><?= $user['email']; ?></td>
					<td><?= $user['birth_date']; ?></td>
					<td><?= $user['phone_number']; ?></td>
					<td><?= $user['gender']; ?></td>
					<td><?= $user['address']; ?></td>
					<td><img src='<?= base_url(); ?>assets/img/profile/<?= $user['avatar']; ?>' /></td>
				</tr>
			<?php
			endforeach; ?>
		</table>

		<div class=' footnote'>
			<p>User Total : <?= $i - 1; ?></p>
			<p>Tercatat terakhir : <?= date('H:i:s d F Y', time()); ?></p>
		</div>

	<?php else : ?>
		<p>Belum ada User yang tercatat</p>
	<?php endif; ?>
</body>

</html>
