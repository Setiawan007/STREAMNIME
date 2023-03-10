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
	<div class="col-xl-3 col-lg-3 col-12">
		<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			<a class="nav-link active show" id="frontend-tab" data-bs-toggle="pill" href="#frontend" role="tab" aria-controls="frontend" aria-selected="true">
				<span>Frontend</span>
			</a>
			<a class="nav-link" id="siteinfo-tab" data-bs-toggle="pill" href="#siteinfo" role="tab" aria-controls="siteinfo" aria-selected="true">
				<span>Site Info</span>
			</a>
			<a class="nav-link" id="style-tab" data-bs-toggle="pill" href="#style" role="tab" aria-controls="style" aria-selected="true">
				<span>Style Settings</span>
			</a>
			<a class="nav-link" id="mailsettings-tab" data-bs-toggle="pill" href="#mailsettings" role="tab" aria-controls="mailsettings" aria-selected="false">
				<span>Social Links</span>
			</a>
		</div>
	</div> <!-- end col-->

	<div class="col">
		<form action="" method="post" enctype="multipart/form-data">
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-end">
						<button class="btn btn-primary" type="submit">Save Changes</button>
					</div>
					<div class="tab-content" id="v-pills-tabContent">
						<div class="tab-pane fade active show" id="frontend" role="tabpanel" aria-labelledby="frontend-tab">
							<div class="mb-3">
								<label class="form-label">Content per page : </label>
								<input type="number" name="content_perpage" value="<?= $row->content_perpage ?>" class="form-control">
							</div>
							<div class="mb-3">
								<label class="form-label">Page Maintenance : </label><br>
								<input type="checkbox" name="maintenance" id="switch1" <?= "" . ($row->maintenance == 'on') ? 'checked' : '' . "" ?> data-switch="bool" />
								<label for="switch1" data-on-label="On" data-off-label="Off"></label>
							</div>
						</div>
						<div class="tab-pane fade" id="siteinfo" role="tabpanel" aria-labelledby="siteinfo-tab">
							<div class="mb-3">
								<label class="form-label">Website Title : </label>
								<input type="text" name="title" value="<?= $row->seo_title ?>" class="form-control">
							</div>
							<div class="mb-3">
								<label class="form-label">Website Description : </label>
								<textarea rows="6" name="description" class="form-control"><?= $row->seo_description ?></textarea>
							</div>
							<div class="mb-3">
								<label class="form-label">Website Keywords : </label>
								<input type="text" name="keywords" value="<?= $row->seo_keywords ?>" class="form-control">
							</div>
						</div>
						<div class="tab-pane fade" id="style" role="tabpanel" aria-labelledby="style-tab">
							<div class="row justify-content-center">
								<div class="col-xl-6 col-lg-6 col-12">
									<div class="mb-3">
										<label class="form-label">Site Logo : </label>
										<div class="card">
											<div class="text-center">
												<img id="output1" style="width: auto; max-width: 260px; max-height: 70px;" src="<?= _storage($row->site_logo) ?>" alt="">
											</div>
											<div class="card-body">
												<input class="form-control" name="site_logo" accept="image/*" onchange="loadFile(event,1)" type="file" id="formFile">
												<small><i class="uil-comment-notes"></i> ( 260x60 px ) Extensions: .png, .jpg, .jpeg, .gif, .svg</small>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-12">
									<div class="mb-3">
										<label class="form-label">Favicon : </label>
										<div class="card">
											<div class="text-center">
												<img id="output2" style="width: 100%; max-width: 60px; height: 60px;" src="<?= _storage($row->seo_favicon) ?>" alt="">
											</div>
											<div class="card-body">
												<input class="form-control" name="favicon" accept="image/*" onchange="loadFile(event,2)" type="file" id="formFile">
												<small><i class="uil-comment-notes"></i> ( 32x32 px ) Extensions: .png, .jpg, .jpeg, .gif, .svg</small>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6 col-12">
									<div class="mb-3">
										<label class="form-label">Site Thumbnail : </label>
										<div class="card" style="max-height: 100%; min-height: 100%">
											<img id="output3" class="shadow card-img" src="<?= _storage($row->seo_thumbnail) ?>" width="100%" alt="">
											<div class="card-body">
												<input class="form-control" name="site_thumb" accept="image/*" onchange="loadFile(event,3)" type="file" id="formFile">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="mailsettings" role="tabpanel" aria-labelledby="mailsettings-tab">
							<div class="mb-3">
								<label class="form-label"><i class="uil-facebook-f"></i> Facebook : </label>
								<input type="text" name="facebook" value="<?= $row->social_facebook ?>" class="form-control">
							</div>
							<div class="mb-3">
								<label class="form-label"><i class="uil-twitter"></i> Twitter : </label>
								<input type="text" name="twitter" value="<?= $row->social_twitter ?>" class="form-control">
							</div>
							<div class="mb-3">
								<label class="form-label"><i class="uil-linkedin"></i> Linkedin : </label>
								<input type="text" name="linkedin" value="<?= $row->social_linkedin ?>" class="form-control">
							</div>
							<div class="mb-3">
								<label class="form-label"><i class="uil-instagram"></i> Instagram : </label>
								<input type="text" name="instagram" value="<?= $row->social_instagram ?>" class="form-control">
							</div>
							<div class="mb-3">
								<label class="form-label"><i class="uil-whatsapp"></i> Whatsapp : </label>
								<input type="text" name="whatsapp" value="<?= $row->social_whatsapp ?>" class="form-control">
							</div>
							<div class="mb-3">
								<label class="form-label"><i class="uil-youtube"></i> YouTube : </label>
								<input type="text" name="youtube" value="<?= $row->social_youtube ?>" class="form-control">
							</div>
							<div class="mb-3">
								<label class="form-label"><i class="uil-github-alt"></i> Github : </label>
								<input type="text" name="github" value="<?= $row->social_github ?>" class="form-control">
							</div>
						</div>
					</div>
				</div>
			</div> <!-- end tab-content-->
		</form>
	</div> <!-- end col-->

</div>
<!-- end row-->

<script src="<?= _backEnd() ?>js/vendor.min.js"></script>
<script src="<?= _backEnd() ?>js/app.min.js"></script>
<script>
	var loadFile = function(event, id) {
		var output = document.getElementById('output' + id);
		output.src = URL.createObjectURL(event.target.files[0]);
	};
</script>