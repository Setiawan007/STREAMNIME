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
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="d-flex justify-content-end mb-3">
						<button class="btn btn-primary mx-1" type="submit">Update</button>
					</div>
					<ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
						<li class="nav-item">
							<a href="#general" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
								<i class="uil-home d-md-none d-block"></i>
								<span class="d-none d-md-block">General</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#seo" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 ">
								<i class="uil-arrow-growth d-md-none d-block"></i>
								<span class="d-none d-md-block">SEO</span>
							</a>
						</li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane show active" id="general">
							<div class="row">
								<div class="col-xl-8">
									<div class="mb-3">
										<label class="form-label">Title</label>
										<input type="text" class="form-control" name="title" placeholder="Judul Anime" value="<?= $row->title ?>" required>
									</div>
									<div class="mb-3">
										<label for="example-select" class="form-label">Type</label>
										<select class="form-select" id="example-select" name="type" required>
											<?php foreach ($type as $type) : ?>
												<option <?= ($row->type == $type->id) ? "selected" : "" ?> value="<?= $type->id ?>"><?= $type->title ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="mb-3">
										<label class="form-label">Genre</label>
										<select class="max-length select2 form-control select2-multiple" name="genre[]" data-toggle="select2" multiple="multiple" data-placeholder="Choose ...">
											<?php
											$gen = explode(',', $row->genre);
											foreach ($genre as $genre) :
												$c = "";
												foreach ($gen as $gens) {
													if ($genre->seo_slug == $gens) {
														$c = "selected";
													}
												}
											?>
												<option value="<?= $genre->seo_slug ?>" <?= $c ?>><?= $genre->title ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="row">
										<div class="col-12 col-xl-6 col-lg-6">
											<div class="mb-3">
												<label class="form-label">Status</label>
												<select class="form-select" id="example-select" name="status" required>
													<option value="selesai" <?= ($row->status == "selesai") ? "selected" : "" ?>>Selesai Tayang</option>
													<option value="sedang" <?= ($row->status == "sedang") ? "selected" : "" ?>>Sedang Tayang</option>
													<option value="segera" <?= ($row->status == "segera") ? "selected" : "" ?>>Segera Tayang</option>
												</select>
											</div>
										</div>
										<div class="col-12 col-xl-6 col-lg-6">
											<div class="mb-3">
												<label class="form-label">Trailer</label>
												<input type="text" class="form-control" name="trailer" value="<?= $row->trailer ?>" placeholder="Embed Code Youtube">
												<small>youtube.com/watch?v=<span class="text-danger">F-Cm-bmdLEY</span></small>
											</div>
										</div>
									</div>

								</div>
								<div class="col">
									<div class="mb-1" align="center">
										<label for="formFile" class="form-label">Preview</label>
										<div class="d-flex justify-content-center">
											<div class="card mb-0" style="width: 160px;">
												<img id="output" class="shadow card-img" src="<?= _storage("thumbnails/$row->thumb") ?>" width="100%" alt="">
											</div>
										</div>
										<small>225x319</small>
									</div>
									<div class="mb-3">
										<label for="formFile" class="form-label">Thumbnail</label>
										<input class="form-control" name="thumb" accept="image/*" onchange="loadFile(event)" type="file" id="formFile">
									</div>
								</div>
							</div>
							<div class="mb-3">
								<label class="form-label">Description</label>
								<textarea name="description" class="form-control" rows="10"><?= $row->description ?></textarea>
							</div>
						</div>
						<div class="tab-pane" id="seo">
							<div class="mb-3">
								<label class="form-label">Seo Slug</label>
								<input type="text" class="form-control" name="seo_slug" placeholder="Slug" value="<?= $row->seo_slug ?>" required>
							</div>
							<div class="mb-3">
								<label class="form-label">Seo Keywords</label>
								<input type="text" class="form-control" name="seo_keywords" placeholder="Keywords" value="<?= $row->seo_keywords ?>">
							</div>
							<div class="mb-3">
								<label class="form-label">Seo Description</label>
								<textarea name="seo_description" class="form-control" rows="10"><?= $row->seo_description ?></textarea>
							</div>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?= _backEnd() ?>js/vendor.min.js"></script>
<script src="<?= _backEnd() ?>js/app.min.js"></script>

<script>
	var loadFile = function(event) {
		var output = document.getElementById('output');
		output.src = URL.createObjectURL(event.target.files[0]);
	};

	maxLength = $('.max-length')
	maxLength.wrap('<div class="position-relative"></div>').select2({
		dropdownAutoWidth: true,
		width: '100%',
		maximumSelectionLength: false,
		dropdownParent: maxLength.parent(),
		placeholder: ''
	});
</script>