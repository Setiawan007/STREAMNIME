<!-- third party css -->
<link href="<?= _backEnd() ?>css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
<link href="<?= _backEnd() ?>css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />
<style>
	.title-two-line {
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		/* number of lines to show */
		-webkit-box-orient: vertical;
	}
</style>
<!-- third party css end -->

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
				<div class="row mb-2">
					<div class="col-sm-4">
						<a href="<?= base_url("admin/anime/create") ?>" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle me-2"></i> New Anime</a>
					</div>
					<div class="col-sm-8">
						<div class="text-sm-end">
							<button type="button" class="btn btn-primary mb-2 me-1">Import</button>
							<button type="button" class="btn btn-primary mb-2">Export</button>
						</div>
					</div><!-- end col-->
				</div>
				<div class="table-responsive">
					<table class="table table-centered w-100 dt-responsive " id="basic-datatable">
						<thead>
							<tr>
								<th class="all"></th>
								<th class="all">Title</th>
								<th>Type</th>
								<th>Status</th>
								<th>Last Eps</th>
								<th>Visit</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($content as $c) :
								$lasteps = $this->db->query("SELECT * FROM anime_video WHERE id_anime=$c->id ORDER BY eps DESC LIMIT 1")->row();
							?>
								<tr>
									<td>
										<img src="<?= _storage() ?>/thumbnails/<?= $c->thumb ?>" class="rounded me-3" height="48" />
									</td>
									<td>
										<?= $c->title ?>
									</td>
									<td><?= $c->title_type ?></td>
									<td><?= '<span class="badge bg-primary">' . animextype($c->status) . '</span>' ?></td>
									<td><?= ($lasteps != NULL) ? $lasteps->eps : "0" ?></td>
									<td><?= count_visitor('anime_list', $c->id) ?></td>
									<td class="table-action">
										<button type="button" class="btn btn-light btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="uil-arrow-circle-down"></i></button>
										<div class="dropdown-menu">
											<a href="<?= base_url($c->seo_slug) ?>" target="_blank" class="dropdown-item"><i class="mdi mdi-eye"></i> View</a>
											<a href="javascript:void(0)" onclick='addvideo("<?= $c->id ?>","<?= $c->title ?>")' class="dropdown-item"><i class="uil-folder-plus"></i> Add Video</a>
											<a href="<?= base_url("admin/anime/video/$c->id") ?>" class="dropdown-item"><i class="uil-folder"></i> List Video</a>
											<a href="<?= base_url("admin/anime/edit/$c->id") ?>" class="dropdown-item"><i class="mdi mdi-square-edit-outline"></i> Edit</a>
											<a href="<?= base_url("admin/anime/delete/$c->id") ?>" class="delete-confirm dropdown-item"><i class="mdi mdi-delete"></i> Delete</a>
										</div>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div> <!-- end card-body-->
		</div> <!-- end card-->
	</div> <!-- end col -->
</div>
<!-- end row -->

<div class="modal fade m-0 p-0" style="z-index: 999999999999;" id="broadcast" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Broadcast</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div> <!-- end modal header -->
			<div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="col-12 col-lg-3 col-xl-3 col-md-4">
							<div class="card shadow-lg">
								<div class="px-2 pt-1 fw-bold"><span class="text-primary">+62 8534-341-222</span> <small> ~Velixs</small></div>
								<img class="card-img rounded p-1" src="http://localhost/velixs/public/storage//default.jpg">
								<div class="card-body p-2 pt-0">
									<div class="title-two-line fw-normal text-dark" id="b_title">Cara Menampilkan Tanggal dan Waktu Sekarang di PHP</div>
									<small class="title-two-line" id="b_description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sequi odio provident deserunt illum numquam voluptatibus. Impedit, incidunt vel exercitationem quibusdam reiciendis corporis, laudantium, aliquid libero sit facere excepturi aut illo.</small>
									<small class="text-muted"><?= str_replace(array('https://', 'http://'), "", base_url()) ?></small>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="form-floating">
								<textarea class="form-control" id="b_pesan" placeholder="Pesan" name="pesan" style="height: 100px;"></textarea>
								<label for="floatingTextarea">Pesan</label>
							</div>
							<small>Don't delete the link you want to share.</small>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- end modal content-->
	</div> <!-- end modal dialog-->
</div> <!-- end modal-->

<script src="<?= _backEnd() ?>js/vendor.min.js"></script>
<script src="<?= _backEnd() ?>js/app.min.js"></script>
<!-- third party js -->
<script src="<?= _backEnd() ?>js/vendor/jquery.dataTables.min.js"></script>
<script src="<?= _backEnd() ?>js/vendor/dataTables.bootstrap5.js"></script>
<script src="<?= _backEnd() ?>js/vendor/dataTables.responsive.min.js"></script>
<script src="<?= _backEnd() ?>js/vendor/responsive.bootstrap5.min.js"></script>
<script src="<?= _backEnd() ?>js/vendor/dataTables.checkboxes.min.js"></script>
<!-- third party js ends -->
<script src="<?= _backEnd() ?>js/pages/demo.datatable-init.js"></script>
<script src="<?= _backEnd() ?>js/sweetalert.min.js"></script>
<script>
	$('.delete-confirm').on('click', function(event) {
		event.preventDefault();
		const url = $(this).attr('href');
		swal({
			title: 'Are you sure?',
			text: 'This record and it`s details will be permanantly deleted!',
			icon: 'warning',
			buttons: ["Cancel", "Yes!"],
		}).then(function(value) {
			if (value) {
				window.location.href = url;
			}
		});
	});

	function addvideo(id, title) {
		$("#av_id").val(id)
		$("#av_title").val(title)
		$("#addvideo").modal("show")
	}

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
<div class="modal fade" id="addvideo" tabindex="-1" aria-labelledby="scrollableModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Add Video</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div> <!-- end modal header -->
			<form action="<?= base_url("admin/anime/video/add") ?>" method="post">
				<div class="modal-body">
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
							<input type="hidden" id="av_id" name="id_anime">
							<div class="mb-3">
								<label for="simpleinput" class="form-label">Video For</label>
								<input type="text" id="av_title" name="title" class="form-control" disabled>
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
					<div class="d-flex justify-content-end">
						<button type="submit" class="btn btn-success">Publish</button>
					</div>
				</div>
			</form>
		</div> <!-- end modal content-->
	</div> <!-- end modal dialog-->
</div> <!-- end modal-->