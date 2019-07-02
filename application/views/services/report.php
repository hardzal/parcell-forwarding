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

		.title {
			margin-bottom: 3px;
		}

		.deadline {
			font-size: 20px;
		}
	</style>
</head>

<body>
	<h1 class='title'>Parcell-Forwarding</h1>
	<p>Created at <em><?= date('H:i:s d F Y', $item['created_at']); ?></em></p>
	<hr />
	<table width="100%">
		<tr>
			<th>Item Code</th>
			<td><?= $item['item_code']; ?></td>
		</tr>
		<tr>
			<th>Item Name</th>
			<td><?= $item['item_name']; ?></td>
		</tr>
		<tr>
			<th>Item Category</th>
			<td><?= $item['item_category']; ?></td>
		</tr>
		<tr>
			<th>Email</th>
			<td><?= $item['email']; ?></td>
		</tr>
		<tr>
			<th>Name</th>
			<td><?= $item['name']; ?></td>
		</tr>
		<tr>
			<th>No Telepon</th>
			<td><?= $item['phone_number']; ?></td>
		</tr>
		<tr>
			<th>Alamat</th>
			<td><?= $item['address']; ?></td>
		</tr>
		<tr>
			<th>Price Item @ </th>
			<td>$ <?= number_format($item['item_price']); ?></td>
		</tr>
		<tr>
			<th>Postal Fee</th>
			<td>$ <?= number_format($item['delivery_cost']); ?></td>
		</tr>
		<tr>
			<th>Tax Cost</th>
			<td>$ <?= number_format($item['tax_cost']); ?></td>
		</tr>
		<tr>
			<th>Total Cost</th>
			<td>$ <?= number_format($item['total_cost']); ?></td>
		</tr>
	</table>

	<div>
		<p>Transfer via Rekening<br />
			Bank BCA a/n Parcell-Forwarding 12301-3021-2013<br />
			Bank BRI a/n Parcell-Forwarding 12401-3421-2213<br />
			Bank BNI a/n Parcell-Forwarding 12401-3421-2213<br />
		</p>
		<p class='deadline'><strong>Deadline Transfer : <?= date('H:i:s d F Y', $item['deadline_at']); ?></strong></p>
		<p>Don't forget to send picture proof to our system :)</p>
	</div>
</body>

</html>
