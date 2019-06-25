<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="sidebar-brand-text mx-3">PF Admin</div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider my-0">

	<!-- Heading -->
	<div class="sidebar-heading mt-3">
		Admin
	</div>

	<!-- Nav Item - Dashboard -->
	<li class="nav-item">
		<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>admin">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>admin">
			<i class="fas fa-shopping-cart"></i>
			<span>Items</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>admin">
			<i class="fas fa-dolly"></i>
			<span>Auctions</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link pt-2" href="<?= base_url(); ?>admin">
			<i class="fas fa-users"></i>
			<span>Users</span></a>
	</li>

	<hr class="sidebar-divider mb-3">

	<div class='sidebar-heading'>
		User </div>

	<!-- Sub Heading Sesuai MENU -->

	<!-- Nav Item - Dashboard -->
	<li class="nav-item active">
		<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>">
			<i class="fas fa-fw fa-user"></i>
			<span>My Profile</span></a>
	</li>
	<!-- Nav Item - Dashboard -->
	<li class="nav-item">
		<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>/editprofile">
			<i class="fas fa-fw fa-user-edit"></i>
			<span>Edit Profile</span></a>
	</li>
	<!-- Nav Item - Dashboard -->
	<li class="nav-item">
		<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>/changepassword">
			<i class="fas fa-fw fa-key"></i>
			<span>Change Password</span></a>
	</li>

	<hr class="sidebar-divider mt-3">

	<li class="nav-item">
		<a class="nav-link pb-0 pt-2" href="<?= base_url(); ?>/logs">
			<i class="fas fa-history"></i>
			<span>Activity Logs</span></a>
	</li>
	<!-- Divider -->
	<hr class="sidebar-divider mt-3 d-none d-md-block">

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
