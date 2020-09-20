<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AdminLTE 2 | Blank Page</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/select2/dist/css/select2.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<header class="main-header">
			<a href="<?= base_url('assets') ?>/index2.html" class="logo">
				<span class="logo-mini"><b>A</b>LT</span>
				<span class="logo-lg"><b>Admin</b>LTE</span>
			</a>
			<nav class="navbar navbar-static-top">
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?= base_url('assets') ?>/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
								<span class="hidden-xs">Alexander Pierce</span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-header">
									<img src="<?= base_url('assets') ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
									<p>
										Alexander Pierce - Web Developer
										<small>Member since Nov. 2012</small>
									</p>
								</li>
								<li class="user-footer">
									<div class="pull-left">
										<a href="#" class="btn btn-default">Profile</a>
									</div>
									<div class="pull-right">
										<a href="<?= site_url('auth/logout') ?>" class="btn btn-danger">Sign out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>

		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<img src="<?= base_url('assets') ?>/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p>Alexander Pierce</p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>
				<form action="#" method="get" class="sidebar-form">
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</form>

				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">Main Menu</li>
					<!--  -->
					<li <?= $this->uri->segment(1) == 'Dashboard' ? 'class="active"' : null ?>>
						<a href="<?= site_url('Dashboard') ?>">
							<i class="fa fa-dashboard"></i> <span>Dashboard</span>
						</a>
					</li>
					<!--  -->
					<li class="treeview <?= $this->uri->segment(1) == 'items' || $this->uri->segment(1) == 'sub_categories' || $this->uri->segment(1) == 'customers' || $this->uri->segment(1) == 'categories' ? 'active' : null ?>">
						<a href="#">
							<i class="fa fa-users"></i> <span>Master</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li <?= $this->uri->segment(1) == 'customers' ? 'class="active"' : null ?>>
								<a href="<?= site_url('customers') ?>">
									<i class="fa fa-circle-o"></i> Customers
								</a>
							</li>
							<li <?= $this->uri->segment(1) == 'categories' ? 'class="active"' : null ?>>
								<a href="<?= site_url('categories') ?>">
									<i class="fa fa-circle-o"></i> Categories
								</a>
							</li>
							<li <?= $this->uri->segment(1) == 'sub_categories' ? 'class="active"' : null ?>>
								<a href="<?= site_url('sub_categories') ?>">
									<i class="fa fa-circle-o"></i> Sub Categories
								</a>
							</li>
							<li <?= $this->uri->segment(1) == 'items' ? 'class="active"' : null ?>>
								<a href="<?= site_url('items') ?>">
									<i class="fa fa-circle-o"></i> Items
								</a>
							</li>
						</ul>
					</li>
					<!--  -->
					<li class="treeview <?= $this->uri->segment(1) == 'stock_out' || $this->uri->segment(1) == 'stock_in' ? 'active' : null ?>">
						<a href="#">
							<i class="fa fa-shopping-cart"></i> <span>Transaksi</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="">
									<i class="fa fa-circle-o"></i> Pembayaran
								</a>
							</li>
							<li>
								<a href="">
									<i class="fa fa-circle-o"></i> Oprasional
								</a>
							</li>
							<li <?= $this->uri->segment(1) == 'stock_in' ? 'class="active"' : null ?>>
								<a href="<?= site_url('stock_in') ?>">
									<i class="fa fa-circle-o"></i> Stock In
								</a>
							</li>
							<li <?= $this->uri->segment(1) == 'stock_out' ? 'class="active"' : null ?>>
								<a href="<?= site_url('stock_out') ?>">
									<i class="fa fa-circle-o"></i> Stock Out
								</a>
							</li>

						</ul>
					</li>

					<li class="treeview">
						<a href="#">
							<i class="fa fa-line-chart"></i> <span>Laporan</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li>
								<a href="">
									<i class="fa fa-circle-o"></i> Invoice
								</a>
							</li>
						</ul>
					</li>

					<li class="header">Main User</li>
					<li><a href="#"><i class="fa fa-user text-red"></i> <span>User</span></a></li>
				</ul>
			</section>
		</aside>

		<div class="content-wrapper">
			<script src="<?= base_url('assets') ?>/bower_components/jquery/dist/jquery.min.js"></script>
			<?= $contents ?>
		</div>

		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 2.4.0
			</div>
			<strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
			reserved.
		</footer>

		<div class="control-sidebar-bg"></div>
	</div>

	<script src="<?= base_url('assets') ?>/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?= base_url('assets') ?>/bower_components/select2/dist/js/select2.full.min.js"></script>
	<script src="<?= base_url('assets') ?>/bower_components/select2/dist/js/select2.full.min.js"></script>
	<script src="<?= base_url('assets') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?= base_url('assets') ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('assets') ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="<?= base_url('assets') ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?= base_url('assets') ?>/bower_components/fastclick/lib/fastclick.js"></script>
	<script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js"></script>
	<script src="<?= base_url('assets') ?>/dist/js/demo.js"></script>
	<script>
		$(document).ready(function() {
			$('.sidebar-menu').tree()
		})
	</script>
	<script>
		$(document).ready(function() {
			$('.select2').select2();
		});
	</script>
	<script>
		$(document).ready(function() {
			$('#datatable').DataTable();
		});
	</script>
</body>

</html>
