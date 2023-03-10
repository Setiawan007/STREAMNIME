<script src="<?= _backEnd() ?>tinymce/tinymce.min.js"></script>
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
		<div class="card">
			<div class="card-body">
				<form action="" method="POST">
					<div class="d-flex justify-content-end">
						<button class="btn btn-primary" type="submit"><i class="uil-postcard"></i> Save Changes</button>
					</div>
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-12">
							<div class="mb-3">
								<label class="form-label">Type Content</label>
								<input type="text" class="form-control" name="title" placeholder="Type Content" value="<?= $row->type_title ?>" required autocomplete="off">
							</div>
							<div class="mb-3">
								<label class="form-label">SEO Slug</label>
								<input type="text" class="form-control seo_input" name="slug" id="seo_slug" placeholder="seo-slug" value="<?= $row->type_slug ?>" required autocomplete="off">
							</div>
							<div class="mb-3">
								<label class="form-label">Icon</label>
								<input type="text" class="form-control" name="icon" placeholder="uil-home" value="<?= $row->type_icon ?>" required autocomplete="off">
								<small><i class="uil-comment-notes-"></i> To see the icons code, <a href="<?= base_url("admin/icons") ?>" target="_blank">Click Here</a></small>
							</div>
						</div>
						<div class="col">
							<div class="mb-3">
								<label for="">SEO Description</label>
								<textarea class="form-control seo_input" id="seo_description" name="seo_description" rows="6"><?= $row->seo_description ?></textarea>
							</div>
							<div class="card border" style="background: #f9f9f9;">
								<div class="card-body">
									<h4 class="m-0" style="color: #1a0cab;"><?= $row->type_title ?></h4>
									<div style="color: #006622;" id="slug_rev"><?= base_url($row->type_slug) ?></div>
									<small id="description_rev"><?= $row->seo_description ?></small>
								</div>
							</div>
							<small><i class="uil-comment-notes"></i> Mange your page title, meta description, keywords and unique friendly URL. This help you to manage how this topic shows up on search engines.</small>
						</div>
					</div>
					<hr>
					<div class="form-check form-switch mb-2">
						<input type="checkbox" class="form-check-input" checked disabled id="customSwitch1">
						<label class="form-check-label" for="customSwitch1">Input Title</label>
					</div>
					<div class="form-check form-switch mb-2">
						<input type="checkbox" class="form-check-input" name="input_content" <?= "" . ($row->input_content == 1) ? 'checked' : '' . "" ?> id="customSwitch1">
						<label class="form-check-label" for="customSwitch1">Input Text Editor (Content)</label>
					</div>
					<div class="form-check form-switch mb-2">
						<input type="checkbox" class="form-check-input" name="input_video" <?= "" . ($row->input_video == 1) ? 'checked' : '' . "" ?> id="customSwitch1">
						<label class="form-check-label" for="customSwitch1">Input Video</label>
					</div>
					<div class="form-check form-switch mb-2">
						<input type="checkbox" class="form-check-input" name="input_gallery" <?= "" . ($row->input_gallery == 1) ? 'checked' : '' . "" ?> id="customSwitch1">
						<label class="form-check-label" for="customSwitch1">Input Galerry</label>
					</div>
					<div class="form-check form-switch mb-2">
						<input type="checkbox" class="form-check-input" name="input_price" <?= "" . ($row->input_price == 1) ? 'checked' : '' . "" ?> id="customSwitch1">
						<label class="form-check-label" for="customSwitch1">Input Price</label>
					</div>
					<div class="form-check form-switch mb-2">
						<input type="checkbox" class="form-check-input" name="btn_download" <?= "" . ($row->btn_download == 1) ? 'checked' : '' . "" ?> id="customSwitch1">
						<label class="form-check-label" for="customSwitch1">Button Download</label>
					</div>
					<div class="form-check form-switch mb-2">
						<input type="checkbox" class="form-check-input" name="btn_demo" <?= "" . ($row->btn_demo == 1) ? 'checked' : '' . "" ?> id="customSwitch1">
						<label class="form-check-label" for="customSwitch1">Button Demo</label>
					</div>
					<div class="form-check form-switch mb-2">
						<input type="checkbox" class="form-check-input" name="btn_wabuy" <?= "" . ($row->btn_wabuy == 1) ? 'checked' : '' . "" ?> id="customSwitch1">
						<label class="form-check-label" for="customSwitch1">Button Buy Direct Whatsapp</label>
					</div>
					<div class="form-check form-switch mb-2">
						<input type="checkbox" class="form-check-input" name="type_status" <?= "" . ($row->type_status == 1) ? 'checked' : '' . "" ?> id="customSwitch1">
						<label class="form-check-label" for="customSwitch1">Active</label>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?= _backEnd() ?>js/vendor.min.js"></script>
<script src="<?= _backEnd() ?>js/app.min.js"></script>
<script>
	$(".seo_input").keyup(function() {
		$("#slug_rev").text("<?= base_url() ?>" + slugify($("#seo_slug").val()))
		$("#description_rev").text($("#seo_description").val())
	});

	function slugify(string) {
		return string
			.toString()
			.trim()
			.toLowerCase()
			.replace(/\s+/g, "-")
			.replace(/[^\w\-]+/g, "")
			.replace(/\-\-+/g, "-")
			.replace(/^-+/, "")
			.replace(/-+$/, "");
	}
</script>
