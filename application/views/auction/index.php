<div class="container marketing">
	<div class='content'>
		<h2>Auction List</h2>
		<?= $this->session->flashdata('message'); ?>
		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Item Name</th>
					<th scope="col">Price</th>
					<th scope="col">Deadline</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1; ?>
				<?php foreach ($auctions as $auction) : ?>
					<tr>
						<td><?= $no; ?></td>
						<td><?= $auction['item_name']; ?></td>
						<td><?= number_format($auction['price']); ?></td>
						<td><?= Date('H:i:s - d F Y', $auction['deadline']); ?></td>
						<td>
							<?= is_auction_expired($auction['id']); ?>
						</td>
						<?php $no = $no + 1; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAuction" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="judulModalAuction">View Auction</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="formItem" method="POST" action="">
				<div class="modal-body">
					<input type="hidden" name="auction_id" id="auction_id" />
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary submitButton">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
