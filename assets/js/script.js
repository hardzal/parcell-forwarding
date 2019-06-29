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

		let total_cost = +(price * item_total) + tax_cost + delivery_cost;

		$('.item-price').html('Rp ' + price);
		$('.item-tax').html('Rp ' + tax_cost);
		$('.item-delivery').html('Rp ' + delivery_cost);
		$('.total-price strong').html('Rp ' + total_cost);
	});
});
