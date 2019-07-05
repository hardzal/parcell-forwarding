<div class="container marketing">
	<div class='content'>
		<h2>Auction List</h2>
		<?= $this->session->flashdata('message'); ?>

		<div class='row'>
			<div class='col-md-6'>
				<form method="POST" action="<?= base_url('auction/index'); ?>">
					<div class="input-group mb-3">
						<input type="text" name="keyword" class="form-control" placeholder="Search keyword..." autocomplete="off" autofocus>
						<div class="input-group-append">
							<input class="btn btn-primary" type="submit" name="search" id="search" value="Search" />
						</div>
					</div>
				</form>
			</div>
		</div>

		<?php if (empty($auctions)) : ?>
			<div class='alert alert-danger'>
				Data not found!
			</div>
		<?php endif; ?>
		<?php if ($this->input->post('search') && !empty($auctions)) : ?>
			<p>Result : <?= $result_total_rows; ?></p>
		<?php endif; ?>

		<?php if (!isset($auctions) && empty($auctions)) : ?>
			<p>Empty Auctions List</p>
		<?php else : ?>
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
							<td><?= ++$start; ?></td>
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
		<?php endif; ?>
		<?= $this->pagination->create_links(); ?>
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
