$(function () {
	const base_url = "http://localhost/parcell-forwarding/";

	$(".custom-file-input").on("change", function () {
		var fileName = $(this).val().split("\\").pop();
		$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});

	$('#calculate-item-cost').on('click', function () {
		let tax_cost = 0;
		let price = $('#item_price').val();
		let item_total = $('#item_total').val();
		let country_id = $('#country').val();
		let delivery_id = $('#delivery').val();
		let weight_item = $('#weight').val();
		let delivery_cost = 0;
		if (country_id != 3 && country_id != '') {
			// pajak = bea_masuk + ppn + pph
			tax_cost += (price * 0.075) + (price * 0.1) + (price * 0.1);
		}

		let deliveries_item = deliveries;
		for (let delivery of deliveries_item) {
			if (delivery.id == delivery_id) {
				delivery_cost += delivery.cost_weight * weight_item;
				break;
			}
		}

		let total_cost = +(price) + tax_cost + delivery_cost;
		total_cost = total_cost * item_total;

		$('.item-price').html('$ ' + price);
		$('.item-tax').html('$ ' + tax_cost);
		$('.item-delivery').html('$ ' + delivery_cost);
		$('.total-price strong').html('$ ' + total_cost);
	});

	$('.tambahDataItem').on('click', function () {
		$('#judulModalItem').html("Add New Item");
	});

	$('.editDataItem').on('click', function () {
		$('#judulModalItem').html("Update Item");
		$('.submitButton').html("Saved changes");

		$('.modal-content form').attr('action', base_url + 'item/edit');

		const id = $(this).data('id');

		$.ajax({
			url: base_url + 'item/edit',
			data: {
				id: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {
				$('#item_name').val(data.name);
				$('#item_category').val(data.category_id);
				$('#price').val(data.price);
				$('#stock').val(data.stock);
				$('#fragile').val(data.is_broken);
				if (data.is_broken == "1") {
					$('#fragile').prop('checked', true);
				} else {
					$('#fragile').prop('checked', false);
				}
				$('#id').val(data.id);
				console.log(data);
			}
		});
	});

	$('.verifyDataItem').on('click', function (e) {
		$('#judulModalItem').html("Verification Item Transaction");
		$('.submitButton').html("Confirm Transaction");

		const id = $(this).data('id');

		e.preventDefault();

		$('.modal-content form').attr('action', base_url + 'item/verify');

		$.ajax({
			url: base_url + 'item/verify',
			data: {
				id: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {
				$('#user_item_id').val(data.user_item_id);
				console.log(data);
			}
		});
	});

	$('.confirmationTransaction').on('click', function (e) {
		$('#judulModalTransaction').html("Confirmation Item Transaction");
		$('.submitButton').html("Confirm It");
		$('.img-thumbnail').removeAttr('src');
		const id = $(this).data('id');

		e.preventDefault();

		$('.modal-content form').attr('action', base_url + 'transaction/confirm');

		$.ajax({
			url: base_url + 'transaction/confirm',
			data: {
				id: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {
				$('#user_item_id').val(data.user_item_id);
				$('.img-thumbnail').attr('src', base_url + 'assets/img/screenshot/' + data.image);
				$('.submitButton').attr('onclick', function () {
					return "Are you sure to confirm?";
				})
				console.log(data);
			}
		});
	});

	$('.progressDataItem').on('click', function (e) {
		$('#judulModalItem').html("Confirm Item");
		$('.submitButton').html("Confirm");
		$('.status_item').remove();

		const id = $(this).data('id');

		e.preventDefault();

		$('.modal-content form').attr('action', base_url + 'item/confirm');

		$.ajax({
			url: base_url + 'item/confirm',
			data: {
				id: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {
				$('#user_item_id').val(data.id);
				$('.custom-file').remove();
				$('.form-group').append(`<div class='status_item'><input type='checkbox' id='status' name='status' value='1'/>
				<label for='status'>Has it been received??</label></div>`);
				console.log(data);
			}
		});
	});

	$('.progressTransaction').on('click', function (e) {
		$('#judulModalTransaction').html("Item Transaction");
		$('.submitButton').html("Save");
		$('.img-thumbnail').remove();
		$('h3.save').remove();

		const id = $(this).data('id');

		e.preventDefault();

		$('.modal-content form').attr('action', base_url + 'transaction/save');

		$.ajax({
			url: base_url + 'transaction/save',
			data: {
				id: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {
				$('#user_item_id').val(data.user);
				$('.form-group').append("<h3 class='save'>Terverifikasi</h3>");
				console.log(data);
			}
		});
	});

	$('.viewAuction').on('click', function (e) {
		$('#judulModalAuction').html("Auction Item");
		$('.form-group').remove();
		$('.submitButton').html("Save");

		const id = $(this).data('id');

		e.preventDefault();

		$('.modal-content form').attr('action', base_url + 'auction/view');

		$.ajax({
			url: base_url + 'auction/view',
			data: {
				id: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {
				let auction_id;
				let size = 0;
				let auction = `<div class="form-group">
				<table class="table table-bordered">
				<thead>
				  <tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Price</th>
				  </tr>
				</thead>
				<tbody>`;

				$.each(data, function (i, item) {
					auction += `<tr>
						<th scope="row">${i+1}</th>
						<td>${item.name}</td>
						<td>${item.price}</td>
					  </tr>`;
					size++;
				});

				auction += `</tbody>
				</table>
				  </div>`;

				if (size > 0) {
					$('.modal-body').append(auction);
				} else {
					$('.modal-body').append(`
						<strong>Belum ada yang mengajukan</strong>
					`);
				}

				$('.modal-body').append(`
					<div class='form-group'>
						<label for='auction_pricet'>Mengajukan nilai lelang</label>
						<input type='number' name='auction_price' id='auction_price' class='form-control'/>
					</div>
				`);

				$('#auction_id').val(id);
				console.log(data);
			}
		});
		$('.modal-body strong').html('');
	});
});
