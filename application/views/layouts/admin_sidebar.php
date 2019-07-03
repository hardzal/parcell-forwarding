<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url(); ?>user">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="sidebar-brand-text mx-3">PF Admin</div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider mb-3">

	<?php if ($this->session->userdata('role_id') == 1) : ?>
		<li class="nav-item">
			<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>admin">
				<i class="fas fa-fw fa-tachometer-alt"></i>
				<span>Dashboard</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>admin/items">
				<i class="fas fa-fw fa-shopping-cart"></i>
				<span>Items</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>admin/auctions">
				<i class="fas fa-fw fa-dolly"></i>
				<span>Auctions</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>admin/users">
				<i class="fas fa-fw fa-users"></i>
				<span>Users</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>admin/transactions">
				<i class="fas fa-fw fa-history"></i>
				<span>Transactions</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>admin/settings">
				<i class="fas fa-fw fa-user-cog"></i>
				<span>Settings</span>
			</a>
		</li>
	<?php elseif ($this->session->userdata('role_id') == 2) : ?>
		<li class="nav-item">
			<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>user">
				<i class="fas fa-fw fa-tachometer-alt"></i>
				<span>Dashboard</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>user/items">
				<i class="fas fa-fw fa-shopping-cart"></i>
				<span>My Items</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>user/auctions">
				<i class="fas fa-fw fa-dolly"></i>
				<span>My Auctions</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>user/transactions">
				<i class="fas fa-fw fa-history"></i>
				<span>My Transactions</span>
			</a>
		</li>
	<?php endif; ?>
	<hr class="sidebar-divider mt-3">

	<li class="nav-item">
		<a class="nav-link py-0" href=" <?= base_url(); ?>user/profile">
			<i class="fas fa-fw fa-user"></i>
			<span>My Profile</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>user/editprofile">
			<i class="fas fa-fw fa-user-edit"></i>
			<span>Edit Profile</span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>user/changepassword">
			<i class="fas fa-fw fa-key"></i>
			<span>Change Password</span>
		</a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider mt-3 d-none d-md-block">

	<li class='nav-item'>
		<a class='nav-link pb-0 pt-0' href='<?= base_url(); ?>'>
			<i class="fas fa-home"></i>
			<span>Back to home</span></a>
		</a>
	</li>

	<li class='nav-item'>
		<a class='nav-link' href='<?= base_url(); ?>auth/logout'>
			<i class="fas fa-fw fa-sign-out-alt"></i>
			<span>Logout</span></a>
		</a>
	</li>

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>
<!-- End of Sidebar -->
