<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

	<title><?= $title; ?></title>

	<!-- Bootstrap core CSS -->
	<link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="<?= base_url(); ?>assets/css/carousel.css" rel="stylesheet">
</head>

<body>

	<header>
		<nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color:#4e73df">
			<a class="navbar-brand" href="<?= base_url(); ?>">Parcel-Forwarding</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url(); ?>">Home</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href='<?= base_url(); ?>service'>Service</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href='<?= base_url(); ?>auth/signup'>Sign Up</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href='<?= base_url(); ?>auth/login'>Login</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' href='<?= base_url(); ?>#about-us'>About Us</a>
					</li>
				</ul>
				<form class="form-inline mt-2 mt-md-0" method="GET" action="<?= base_url(); ?>">
					<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form>
			</div>
		</nav>
	</header>
