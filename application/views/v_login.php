<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Login Page</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?= base_url('assets') ?>/plugins/iCheck/square/blue.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<h4><b>CIBOGO KURNIA BERSAMA</b</h4>
		</div>
		<div class="login-box-body">
			<br />
			<center>
				<img src="<?= base_url('assets') ?>/dist/img/logo_pt.png" width="100px" />
			</center>
			<br>
			<p class="login-box-msg">Sign in to start your session</p>
			<?= $this->session->flashdata('message'); ?>
			<form action="" method="POST">
				<div class="form-group has-feedback <?= form_error('email') != NULL ? 'has-error' : null ?>">
					<input type="text" name="email" class="form-control" placeholder="Email" autocomplete="off" autofocus>
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					<?= form_error('email', '<div class="text-danger">', '</div>'); ?>
				</div>
				<div class="form-group has-feedback <?= form_error('password') != NULL ? 'has-error' : null ?>">
					<input type="password" name="password" class="form-control" placeholder="Password">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					<?= form_error('password', '<div class="text-danger">', '</div>'); ?>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<button type="submit" class="btn btn-primary btn-block btn-flat" style="width: 100%;">Sign In</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script src="<?= base_url('assets') ?>/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?= base_url('assets') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?= base_url('assets') ?>/plugins/iCheck/icheck.min.js"></script>
	<script>
		$(function() {
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' /* optional */
			});
		});
	</script>
</body>

</html>
