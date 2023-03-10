<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title><?= $title ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="IlhamGanz" name="author" />
	<!-- App favicon -->
	<link rel="shortcut icon" href="<?= _backEnd() ?>images/favicon.ico">

	<link href="<?= _backEnd() ?>css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
	<link href="<?= _backEnd() ?>css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?= _backEnd() ?>css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
	<link href="<?= _backEnd() ?>css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />
	<link href="<?= _backEnd() ?>toastr/toastr.min.css" rel="stylesheet" type="text/css" id="dark-style" />
</head>

<body class="loading" <?= "" . ($akun->theme_dark == 'false') ? 'style="background-color: #f0f0f0;"' : '' . "" ?> data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":<?= $akun->theme_dark ?>, "showRightSidebarOnStart": false}'>
	<!-- Begin page -->
	<div class="wrapper">
		<!-- =========== Left Sidebar Start ========== -->
		<div class="leftside-menu">

			<!-- LOGO -->
			<a href="index.html" class="logo text-center logo-light">
				<span class="logo-lg">
					<img src="<?= _backEnd() ?>images/logo-lg.png" alt="" height="20">
				</span>
				<span class="logo-sm">
					<img src="<?= _backEnd() ?>images/logo-sm.png" alt="" height="20">
				</span>
			</a>

			<!-- LOGO -->
			<a href="index.html" class="logo text-center logo-dark">
				<span class="logo-lg">
					<img src="<?= _backEnd() ?>images/logo-lg.png" alt="" height="20">
				</span>
				<span class="logo-sm">
					<img src="<?= _backEnd() ?>images/logo-sm.png" alt="" height="20">
				</span>
			</a>

			<div class="h-100" id="leftside-menu-container" data-simplebar>

				<!--- Sidemenu -->
				<ul class="side-nav">

					<li class="side-nav-title side-nav-item">Main</li>
					<li class="side-nav-item">
						<a href="<?= base_url("admin") ?>" class="side-nav-link">
							<i class="uil-home-alt"></i>
							<span> Dashboard </span>
						</a>
					</li>
					<li class="side-nav-item">
						<a href="<?= base_url("admin/request") ?>" class="side-nav-link">
							<i class="uil-envelope-star"></i>
							<span> Request </span>
							<span class="badge bg-primary float-end"><?= $count_req ?></span>
						</a>
					</li>
					<li class="side-nav-title side-nav-item">Page & Content</li>
					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="#anime" aria-expanded="false" aria-controls="anime" class="side-nav-link">
							<i class="uil-ticket"></i>
							<span> Anime Manager </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="anime">
							<ul class="side-nav-second-level">
								<li>
									<a href="<?= base_url("admin/anime/create") ?>">New Anime</a>
								</li>
								<li>
									<a href="<?= base_url("admin/anime") ?>">List Anime</a>
								</li>
								<li>
									<a href="<?= base_url("admin/anime/type") ?>">Type Anime</a>
								</li>
								<li>
									<a href="<?= base_url("admin/anime/genre") ?>">Genre</a>
								</li>
							</ul>
						</div>
					</li>
					<!-- <li class="side-nav-item">
						<a data-bs-toggle="collapse" href="#spage" aria-expanded="false" aria-controls="spage" class="side-nav-link">
							<i class="uil-layer-group"></i>
							<span> Site Pages </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="spage">
							<ul class="side-nav-second-level">
								<li>
									<a href="<?= base_url("admin/pages/create") ?>">New Page</a>
								</li>
								<li>
									<a href="<?= base_url("admin/pages") ?>">Pages Manager</a>
								</li>
							</ul>
						</div>
					</li> -->
					<li class="side-nav-item">
						<a href="<?= base_url("admin/files") ?>" class="side-nav-link">
							<i class="uil-folder-network"></i>
							<span> File Manager </span>
						</a>
					</li>
					<li class="side-nav-title side-nav-item">SEO & Settings</li>

					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="#theme" aria-expanded="false" aria-controls="theme" class="side-nav-link">
							<i class="uil-paint-tool"></i>
							<span> Custom Theme </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="theme">
							<ul class="side-nav-second-level">
								<li>
									<a href="<?= base_url("admin/themes") ?>">Themes</a>
								</li>
								<li>
									<a href="<?= base_url("admin/themes/custom") ?>">Custom Info</a>
								</li>
							</ul>
						</div>
					</li>
					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="#webs" aria-expanded="false" aria-controls="webs" class="side-nav-link">
							<i class="uil-bolt-alt"></i>
							<span> Web Settings </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="webs">
							<ul class="side-nav-second-level">
								<li>
									<a href="<?= base_url("admin/websettings") ?>">General Settings</a>
								</li>
								<li>
									<a href="<?= base_url("admin/websettings/menus") ?>">Site Menus</a>
								</li>
							</ul>
						</div>
					</li>
					<li class="side-nav-item">
						<a href="<?= base_url("admin/users") ?>" class="side-nav-link">
							<i class="uil-user-square"></i>
							<span> Users Manager </span>
						</a>
					</li>
					<li class="side-nav-item">
						<a data-bs-toggle="collapse" href="#sidebarLayouts" aria-expanded="false" aria-controls="sidebarLayouts" class="side-nav-link">
							<i class="uil-cog"></i>
							<span> Webmaster </span>
							<span class="menu-arrow"></span>
						</a>
						<div class="collapse" id="sidebarLayouts">
							<ul class="side-nav-second-level">
								<li>
									<a href="<?= base_url("admin/webmaster") ?>">General Settings</a>
								</li>
							</ul>
						</div>
					</li>
				</ul>
				<!-- Help Box -->
				<div class="help-box text-white text-center">
					<a href="javascript: void(0);" class="float-end close-btn text-white">
						<i class="mdi mdi-close"></i>
					</a>
					<h5 class="mt-3">STREAMNIME</h5>
					<p class="mb-3">Version 1.0</p>
				</div>
				<!-- end Help Box -->
				<!-- End Sidebar -->

				<div class="clearfix"></div>

			</div>
			<!-- Sidebar -left -->

		</div>


		<div class="content-page">
			<div class="content">
				<!-- Topbar Start -->
				<div class="navbar-custom">
					<ul class="list-unstyled topbar-menu float-end mb-0">

						<li class="dropdown notification-list">
							<a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
								<i class="dripicons-view-apps noti-icon"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">

								<div class="p-2">
									<div class="row g-0">
										<div class="col">
											<a class="dropdown-icon-item" href="<?= base_url("") ?>" target="_blank">
												<i class="uil-home text-success" style="font-size: 25px;"></i>
												<span>Front End</span>
											</a>
										</div>
										<div class="col">
											<a class="dropdown-icon-item" href="<?= base_url("admin/users/theme") ?>">
												<?= ($akun->theme_dark == 'false') ? '<i class="uil-moon" style="font-size: 25px;"></i><span>Dark</span>' : '<i class="uil-sun" style="font-size: 25px;"></i><span>Light</span>' ?>
											</a>
										</div>
										<div class="col">
											<a class="dropdown-icon-item" href="<?= base_url("admin/icons") ?>">
												<i class="uil-window-grid text-danger" style="font-size: 25px;"></i>
												<span>Gallery Icon</span>
											</a>
										</div>
									</div>
								</div>

							</div>
						</li>

						<li class="dropdown notification-list">
							<a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
								<span class="account-user-avatar">
									<img src="<?= _storage("avatar/$akun->avatar") ?>" class="rounded-circle">
								</span>
								<span>
									<span class="account-user-name"><?= $akun->name ?></span>
									<span class="account-position"><?= $akun->email ?></span>
								</span>
							</a>
							<div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
								<!-- item-->
								<div class=" dropdown-header noti-title">
									<h6 class="text-overflow m-0">Welcome !</h6>
								</div>

								<!-- item-->
								<a href="<?= base_url("admin/users/edit/$akun->id") ?>" class="dropdown-item notify-item">
									<i class="mdi mdi-account-circle me-1"></i>
									<span>My Account</span>
								</a>

								<!-- item-->
								<a href="<?= base_url("admin/auth/logout") ?>" class="dropdown-item notify-item">
									<i class="mdi mdi-logout me-1"></i>
									<span>Logout</span>
								</a>
							</div>
						</li>

					</ul>
					<button class="button-menu-mobile open-left">
						<i class="mdi mdi-menu"></i>
					</button>
				</div>
				<div class="container-fluid">
					<?php backEnd_content($sk4content) ?>
				</div>
			</div>


			<!-- Footer Start -->
			<footer class="footer">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-6">
							<script>
								document.write(new Date().getFullYear())
							</script> © AdminPanel by <a href="https://scodeku.my.id">SCodeKu</a>
						</div>
					</div>
				</div>
			</footer>
			<!-- end Footer -->

		</div>
	</div>

	<div class="rightbar-overlay"></div>
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