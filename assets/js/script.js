$(function () {
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

		$('.modal-content form').attr('action', 'http://localhost/parcell-forwarding/item/edit');

		const id = $(this).data('id');

		$.ajax({
			url: 'http://localhost/parcell-forwarding/item/edit',
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
});
