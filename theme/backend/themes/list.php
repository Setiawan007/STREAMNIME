<!-- start page title -->
<div class="row">
	<div class="col-12">
		<div class="page-title-box">
			<div class="page-title-right">
				<ol class="breadcrumb m-0">

				</ol>
			</div>
			<h4 class="page-title"><?= $title ?></h4>
		</div>
	</div>
</div>
<!-- end page title -->



<div class="row">
	<div class="col-12">
		<div class="row">
			<?php foreach ($scan as $item) :
				$ext = pathinfo($item, PATHINFO_EXTENSION);
				if ($ext == '') {
			?>
					<div class="col-12 col-xl-4 col-lg-6 col-md-6">
						<div class="card border-1 shadow-lg">
							<img class="card-img" src="<?= base_url("theme/frontend/$item/assets/sys/preview.jpg") ?>" alt="">
							<div class="card-body py-1 text-center">
								<div class="text-center">
									<?php if ($item == $websetinggs->theme_active) {
										echo '<button class="btn btn-success w-50 btn-sm">Active</button>';
									} else {
										echo '<a href="' . base_url("admin/themes/set/$item") . '" class="btn btn-primary w-50 btn-sm">Set Theme</a>';
									} ?>
								</div>
								<h5><?= $item ?></h5>
							</div>
						</div>
					</div>
			<?php }
			endforeach ?>
		</div> <!-- end col -->
	</div>
	<!-- end row -->
</div>

<script src="<?= _backEnd() ?>js/vendor.min.js"></script>
<script src="<?= _backEnd() ?>js/app.min.js"></script>

<script>
	var file = $("#filetheme")
	file.change(function() {
		toastr["info"]("Uploading the theme...")
		$("#submittheme").submit()
	})
</script>