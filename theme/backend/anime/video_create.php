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
				<form action="<?= base_url("admin/anime/video/add/$row->id") ?>" method="post">
					<ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
						<li class="nav-item">
							<a href="#genereal" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
								<i class="uil-puzzle-piece d-md-none d-block"></i>
								<span class="d-none d-md-block">Genereal</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#videos" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
								<i class="uil-video d-md-none d-block"></i>
								<span class="d-none d-md-block">Videos</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#downloads" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
								<i class="uil-down-arrow d-md-none d-block"></i>
								<span class="d-none d-md-block">Downloads</span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane show active" id="genereal">
							<input type="hidden" id="av_id" value="<?= $row->id ?>" name="id_anime">
							<div class="mb-3">
								<label for="simpleinput" class="form-label">Video For</label>
								<input type="text" id="av_title" name="title" value="<?= $row->title ?>" class="form-control" disabled>
							</div>
							<div class="mb-3">
								<label for="example-select" class="form-label">Type</label>
								<select class="form-select" name="type" id="av_type" onchange="typeav()">
									<option value="series">Series</option>
									<option value="movie">Movie</option>
								</select>
							</div>
							<div class="mb-3" id="series">
								<label for="simpleinput" class="form-label">Episode</label>
								<input type="number" name="series" class="form-control">
							</div>
						</div>
						<div class="tab-pane" id="videos">
							<div class="d-flex justify-content-end mb-2">
								<a href="javascript:void(0)" class="btn btn-success btn-sm" id="add_videos"><i class="uil-plus"></i> Add More</a>
							</div>
							<div id="dynamic_videos">
								<div class="mb-3">
									<label class="form-label">Server 1</label>
									<textarea name="videos[]" class="form-control" placeholder="embed"></textarea>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="downloads">
							<div class="d-flex justify-content-end mb-2">
								<a href="javascript:void(0)" class="btn btn-success btn-sm" id="add_downloads"><i class="uil-plus"></i> Add More</a>
							</div>
							<div id="dynamic_downloads">
								<div class="mb-3">
									<label class="form-label">Server 1</label>
									<textarea name="downloads[]" class="form-control" placeholder="embed"></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="d-flex">
						<button type="submit" name="btn" value="eps" class="btn btn-success">Publish</button>
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

	function typeav() {
		var ty = $("#av_type").val()
		var tys = $("#series")
		if (ty == 'series') {
			tys.attr("style", "display:block")
		} else {
			tys.attr("style", "display:none")
		}
	}
	$(document).ready(function() {
		var i = 1;
		var ii = 1;
		$('#add_videos').click(function() {
			i++;
			$('#dynamic_videos').append('<div class="mb-3" id="videos' + i + '"><label class="form-label">Server ' + i + ' <a class="remove_videos" id="' + i + '" href="javascript:void(0)"><i class="uil-trash-alt"></i></a></label><textarea name="videos[]" class="form-control" placeholder="embed"></textarea></div>');
		});
		$(document).on('click', '.remove_videos', function() {
			var button_id = $(this).attr("id");
			$('#videos' + button_id + '').remove();
			i--;
		});

		$('#add_downloads').click(function() {
			ii++;
			$('#dynamic_downloads').append('<div class="mb-3" id="downloads' + ii + '"><label class="form-label">Server ' + ii + ' <a class="remove_downloads" id="' + ii + '" href="javascript:void(0)"><i class="uil-trash-alt"></i></a></label><textarea name="downloads[]" class="form-control" placeholder="embed"></textarea></div>');
		});

		$(document).on('click', '.remove_downloads', function() {
			var button_id = $(this).attr("id");
			$('#downloads' + button_id + '').remove();
			ii--;
		});
	});
</script>