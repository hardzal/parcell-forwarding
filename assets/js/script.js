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
				$('#user_item_id').val(data.id);
				console.log(data);
			}
		});
	});

	$('.confirmationTransaction').on('click', function (e) {
		$('#judulModalTransaction').html("Confirmation Item Transaction");
		$('.submitButton').html("Confirm It");
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
		$('img-thumbnail').attr('src', '');
	});

	$('.waitingTransaction').on('click', function (e) {
		$('#judulModalTransaction').html("Waiting Item Transaction");
		$('.submitButton').html("Ok");
		
		const id = $(this).data('id');

		e.preventDefault();

		// $('.modal-content form').attr('action', base_url + 'transaction/confirm');

		$.ajax({
			url: base_url + 'transaction/wait',
			data: {
				id: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {
				$('.modal-body').append(`<h3>Waiting user send verification</h3>`);
				console.log(data);
			}
		});
		$('.modal-body h3').remove();
		$('.img-thumbnail').remove();
	});

	$('.waitingAuction').on('click', function (e) {
		$('#judulModalAuction').html("Waiting Item Auction");
		$('.submitButton').html("Ok");
		
		const id = $(this).data('id');

		e.preventDefault();

		// $('.modal-content form').attr('action', base_url + 'transaction/confirm');

		$.ajax({
			url: base_url + 'auction/wait',
			data: {
				id: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {
				$('.modal-body').append(`<h3>Waiting user send verification</h3>`);
				console.log(data);
			}
		});
		$('.modal-body h3').remove();
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
				if (data.status == 1) {
					$('#status').attr('checked', true);
				}
				console.log(data);
			}
		});
		$('#status').attr('checked', false);
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
				$('#user_item_id').val(data.id);
				$('.form-group').append("<h3 class='save'>Terverifikasi</h3>");
				console.log(data);
			}
		});
		$('h3.save').html('');
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
						<th scope="row">${i + 1}</th>
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

				if(data.role_id == '' || data.role_id != 1) {
					$('.modal-body').append(`
						<div class='form-group'>
							<label for='auction_pricet'>Mengajukan nilai lelang</label>
							<input type='number' name='auction_price' id='auction_price' class='form-control'/>
						</div>
					`);
				}

				$('#auction_id').val(id);
				console.log(data);
			}
		});
		$('.modal-body strong').html('');
	});

	$('.confirmAuction').on('click', function (e) {
		$('#judulModalAuction').html("Confirm Auction");
		$('.submitButton').html("Confirm");

		const id = $(this).data('id');

		e.preventDefault();

		$('.modal-content form').attr('action', base_url + 'auction/confirm');

		$.ajax({
			url: base_url + 'auction/confirm',
			data: {
				id: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {
				$('#auction_id').val(id);
				$('#item_id').val(data.item_id);
				$('#user_id').val(data.user_id);
				$('#price').val(data.price);
				$('#stock').val(data.stock);

				console.log(data);
			}
		});
	});

	$('.editPost').on('click', function (e) {
		$('#judulModalPost').html("Update Post");
		$('.submitButton').html("Save changes");

		const id = $(this).data('id');

		e.preventDefault();
		$('.modal-content form').attr('action', base_url + 'post/edit');

		$.ajax({
			url: base_url + 'post/edit',
			data: {
				id: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {
				$('.modal-body').append(`<input type='hidden' name='post_id' id='post_id'/>`);
				$('#post_id').val(id);
				$('#title').val(data.title);
				$('#description').val(data.description);
				console.log(data);
			}
		});
	});

	$('.editDataAuction').on('click', function (e) {
		e.preventDefault();
		const id = $(this).data('id');

		$('.judulModalAuction').html("Update Auction");
		$('.submitButton').html("Save changes");

		$('.modal-content form').attr('action', base_url + 'auction/edit');

		$.ajax({
			url: base_url + 'auction/edit',
			data: {
				id: id
			},
			method: 'POST',
			dataType: 'json',
			success: function (data) {
				// let deadline = new Date(data.deadline * 1000);
				// let day = ("0" + deadline.getDate()).slice(-2);
				// let month = ("0" + (deadline.getMonth() + 1)).slice(-2);
				// let formatted_date = deadline.getFullYear() + "-" + (month) + "-" + (day);
				$('#auction_id').val(id);
				$('#item_id').val(data.item_id);
				$('#status').val(data.status);
				$('#item_name').val(data.item_name);
				$('#price').val(data.price);
				$('#stock').val(data.stock);
				$('#id').val(data.id);
				console.log(data);
			}
		});
		$('#status').val('');
	});
});
