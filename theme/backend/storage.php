<link rel="stylesheet" href="<?= _backEnd() ?>dropzone/dropzone.min.css">
<style>
	.title {
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		-webkit-line-clamp: 1;
		/* number of lines to show */
		-webkit-box-orient: vertical;
	}

	.dropzone {
		background: unset;
	}

	.dropzone .dz-preview.dz-image-preview {
		background: unset;
	}
</style>

<div class="container-fluid">
	<div class="row">
		<div class="col-xl-3 col-lg-4 col-12">
			<div class="card card-body">
				<button type="button" class="mb-2 btn btn-success dropdown-toggle w-100" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-plus"></i> Create New </button>
				<div class="dropdown-menu">
					<a class="dropdown-item" id="mfolder" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addfolder"><i class="mdi mdi-folder-plus-outline me-1"></i> Folder</a>
					<a class="dropdown-item" id="addfiles" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#addfile"><i class="mdi mdi-upload me-1"></i> Upload File</a>
				</div>
				<button class="btn btn-secondary w-100 mb-1" id="btnbacks">Back</button>
				<?php if ($path != "/") {
					echo '<button class="btn btn-secondary w-100 mb-1" id="btnback">Back root</button>';
				} ?>
			</div>
		</div>
		<div class="col">
			<div>
				<small class="fw-bold title"><?= "storage/$path" ?></small>
				<?php if ($path == '/') {
					echo '<small class="text-danger">dont delete the folder in the root.</small>';
				} ?>
				<div class="row">
					<?php foreach ($scan as $d) :
						$ext = pathinfo($d, PATHINFO_EXTENSION);
						if ($ext == '') {
					?>
							<div class="col-6">
								<div class="card m-0 shadow-none border mb-1">
									<div class="p-2">
										<a data-bs-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false" href="javascript:void(0)">
											<div class="row align-items-center">
												<div class="col-auto">
													<div class="avatar-sm">
														<span class="avatar-title bg-light text-secondary rounded">
															<i class="mdi mdi-folder font-16"></i>
														</span>
													</div>
												</div>
												<div class="col ps-0">
													<div class="text-muted fw-bold title"><?= $d ?></div>
													<p class="mb-0 font-13">Folder</p>
												</div>
											</div> <!-- end row -->
										</a>
										<div class="dropdown-menu dropdown-menu-start dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
											<!-- item-->
											<a href="javascript:void(0)" data-folder="<?= "$oripath$d" ?>" class="dropdown-item notify-item inifolder">
												<i class="uil-folder-upload"></i>
												<span>Open Folder</span>
											</a>

											<!-- item-->
											<a href="javascript:void(0)" class="dropdown-item notify-item text-danger deletefolder" data-folder="<?= "$oripath$d" ?>">
												<i class="uil-folder-times"></i>
												<span>Delete Folder</span>
											</a>
										</div>
									</div> <!-- end .p-2-->
								</div>
							</div>
					<?php }
					endforeach ?>
				</div>
				<hr>
				<div class="row">
					<?php
					foreach ($scan as $d) :
						$ext = pathinfo($d, PATHINFO_EXTENSION);
						if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {
					?>
							<div class="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
								<a class="text-dark" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#preview">
									<div class="card mb-2">
										<img class="card-img img-cover detail" name-file="<?= $d ?>" data-file="<?= _storage("$path$d") ?>" style="object-fit: cover;" height="80" src="<?= _storage("$path$d") ?>">
										<div class="card-footer rounded p-0" style="background-color: unset;">
											<div class="text-center title">
												<small style="font-size: 5px;"><?= $d ?></small>
											</div>
										</div>
									</div>
								</a>
							</div>
					<?php
						}
					endforeach ?>
				</div>
			</div>
		</div>
	</div>

</div>
<div class="modal fade" id="addfolder" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content shadow-lg">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div>
			<div class="modal-body">
				<form id="addfolderfrm">
					<div class="mb-1">
						<label for="folder" class="form-label">Name Folder</label>
						<input class="form-control" name="folder" type="text" id="folder" required="">
					</div>
					<div class="text-end">
						<button class="btn btn-primary btn-sm" data-bs-dismiss="modal" aria-hidden="true" type="submit">Create</button>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="addfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content shadow-lg">
			<div class="modal-header">
				<button type="button" class="btn-close closeup" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div>
			<div class="modal-body">
				<div id="dropzone-storage" class="dropzone">
					<div class="dz-message">
						<h3>Drop file here</h3> or <strong>click</strong> to upload
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?= _backEnd() ?>dropzone/dropzone.min.js"></script>
<script>
	var folder = $(".inifolder")
	var btnback = $("#btnback")
	var btnbacks = $("#btnbacks")
	var mfolder = $("#mfolder")
	var detail = $(".detail")
	var delte_folder = $(".deletefolder")

	btnback.click(function() {
		loaddir("root")
	})

	btnbacks.click(function() {
		loaddir("files")
	})

	folder.click(function() {
		var getdata = $(this).attr("data-folder")
		loaddir(getdata)
	})

	delte_folder.click(function() {
		// alert($(this).attr("data-folder"))
		var result = confirm("Do you want to delete this?");
		if (result) {
			var name = $(this).attr("data-folder")
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {};
			xhttp.open("GET", "<?= base_url("admin/storage?cmd=delfolder&name=") ?>" + encodeURIComponent(name), true);
			xhttp.send();
			loaddir("<?= $oripath ?>")
		}
	})

	detail.click(function() {
		var files = $(this).attr("data-file")
		var name = $(this).attr("name-file")
		setitem(files)
		getdetail(name, "<?= $oripath ?>")
	})

	$("#addfolderfrm").submit(function(e) {
		e.preventDefault();
		$.ajax({
			url: '<?= base_url("admin/storage?cmd=mfolder&path=$oripath") ?>',
			type: 'post',
			data: $(this).serialize(),
			success: function(data) {
				loaddir("<?= $oripath ?>")
			}
		});
	});

	Dropzone.autoDiscover = false;
	var myDropzone = new Dropzone("#dropzone-storage", {
		url: "<?= base_url("admin/storage/upload?path=$oripath") ?>",
		acceptedFiles: "image/*",
	});

	$(".closeup").click(function() {
		loaddir("<?= $oripath ?>")
	});
</script>
