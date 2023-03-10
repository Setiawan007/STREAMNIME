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
						<button class="btn btn-primary" type="submit"><i class="uil-enter"></i> Add</button>
					</div>
					<div class="mb-3">
						<label class="form-label">Type Content</label>
						<input type="text" class="form-control" name="title" placeholder="Type Content" required autocomplete="off">
					</div>
					<div class="mb-3">
						<label class="form-label">SEO Slug</label>
						<input type="text" class="form-control" name="slug" placeholder="seo-slug" required autocomplete="off">
					</div>
					<div class="mb-3">
						<label class="form-label">Icon</label>
						<input type="text" class="form-control" name="icon" placeholder="uil-home" required autocomplete="off">
						<small><i class="uil-comment-notes-"></i> To see the icons code, <a href="<?= base_url("admin/icons") ?>" target="_blank">Click Here</a></small>
					</div>
					<hr>
					<div class="form-check form-switch mb-2">
						<input type="checkbox" class="form-check-input" checked disabled id="customSwitch1">
						<label class="form-check-label" for="customSwitch1">Input Title</label>
					</div>
					<div class="form-check form-switch mb-2">
						<input type="checkbox" class="form-check-input" name="input_content" id="customSwitch1">
						<label class="form-check-label" for="customSwitch1">Input Text Editor (Content)</label>
					</div>
					<div class="form-check form-switch mb-2">
						<input type="checkbox" class="form-check-input" name="input_video" id="customSwitch1">
						<label class="form-check-label" for="customSwitch1">Input Video</label>
					</div>
					<div class="form-check form-switch mb-2">
						<input type="checkbox" class="form-check-input" name="input_gallery" id="customSwitch1">
						<label class="form-check-label" for="customSwitch1">Input Galerry</label>
					</div>
					<div class="form-check form-switch mb-2">
						<input type="checkbox" class="form-check-input" name="input_price" id="customSwitch1">
						<label class="form-check-label" for="customSwitch1">Input Price</label>
					</div>
					<div class="form-check form-switch mb-2">
						<input type="checkbox" class="form-check-input" name="btn_download" id="customSwitch1">
						<label class="form-check-label" for="customSwitch1">Button Download</label>
					</div>
					<div class="form-check form-switch mb-2">
						<input type="checkbox" class="form-check-input" name="btn_demo" id="customSwitch1">
						<label class="form-check-label" for="customSwitch1">Button Demo</label>
					</div>
					<div class="form-check form-switch mb-2">
						<input type="checkbox" class="form-check-input" name="btn_wabuy" id="customSwitch1">
						<label class="form-check-label" for="customSwitch1">Button Buy Direct Whatsapp</label>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?= _backEnd() ?>js/vendor.min.js"></script>
<script src="<?= _backEnd() ?>js/app.min.js"></script>
