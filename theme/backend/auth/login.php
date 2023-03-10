<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Admin Panel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Coderthemes" name="author" />
	<!-- App favicon -->
	<link rel="shortcut icon" href="<?= _backEnd() ?>images/favicon.ico">
	<!-- App css -->
	<link href="<?= _backEnd() ?>css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= _backEnd() ?>css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
	<link href="<?= _backEnd() ?>css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />
	<link href="<?= _backEnd() ?>toastr/toastr.min.css" rel="stylesheet" type="text/css" id="dark-style" />
</head>

<body class="loading authentication-bg" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
	<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-xxl-4 col-lg-5">
					<div class="card">

						<div class="card-body p-4">

							<div class="text-center w-75 m-auto">
								<h4 class="text-dark-50 text-center pb-0 fw-bold">Sign In</h4>
								<p class="text-muted mb-4">Enter your email address and password to access admin panel.</p>
							</div>

							<form action="" method="POST">

								<div class="mb-3">
									<label for="emailaddress" class="form-label">Email address</label>
									<input class="form-control" name="email" type="email" id="emailaddress" required="" placeholder="Enter your email">
								</div>

								<div class="mb-3">
									<a href="javascript:void(0)" class="text-muted float-end"><small>Forgot your password?</small></a>
									<label for="password" class="form-label">Password</label>
									<div class="input-group input-group-merge">
										<input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
										<div class="input-group-text" data-password="false">
											<span class="password-eye"></span>
										</div>
									</div>
								</div>

								<div class="mb-3 mb-3">
									<div class="form-check">
										<input type="checkbox" class="form-check-input" name="remember" id="checkbox-signin" checked>
										<label class="form-check-label" for="checkbox-signin">Remember me</label>
									</div>
								</div>

								<div class="mb-3 mb-0 text-center">
									<button class="btn btn-primary" type="submit"> Log In </button>
								</div>

							</form>
						</div> <!-- end card-body -->
					</div>
					<!-- end card -->

				</div> <!-- end col -->
			</div>
			<!-- end row -->
		</div>
		<!-- end container -->
	</div>
	<!-- end page -->

	<footer class="footer footer-alt">
		<?= date('Y') ?> © Admin Panel by <a href="https://ilhamsk.my.id">ilhamsk</a>
	</footer>

	<!-- bundle -->
	<script src="<?= _backEnd() ?>js/vendor.min.js"></script>
	<script src="<?= _backEnd() ?>js/app.min.js"></script>
	<script src="<?= _backEnd() ?>toastr/toastr.min.js"></script>
	<script src="<?= _backEnd() ?>toastr/custom.js"></script>
	<script>
		<?php if ($this->session->flashdata('success')) { ?>
			toastr["success"]("<?= $this->session->flashdata('success') ?>")
		<?php } else if ($this->session->flashdata('error')) { ?>
			toastr["error"]("<?= $this->session->flashdata('error') ?>")
		<?php } ?>
	</script>

</body>

</html>
