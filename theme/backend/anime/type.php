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
						<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modal-add" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle me-2"></i> New Type</a>
					</div>
					<div class="col-sm-8">
						<div class="text-sm-end">
							<button type="button" class="btn btn-primary mb-2 me-1">Import</button>
							<button type="button" class="btn btn-primary mb-2">Export</button>
						</div>
					</div><!-- end col-->
				</div>
				<div class="table-responsive">
					<table class="table table-centered w-100 dt-responsive nowrap" id="basic-datatable">
						<thead>
							<tr>
								<th class="all">Title</th>
								<th>Seo Slug</th>
								<th>Created</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($content as $c) :
							?>
								<tr>
									<td>
										<?= $c->title ?>
									</td>
									<td><?= $c->seo_slug ?></td>
									<td><?= '<span class="badge bg-primary">' . $c->created_at . '</span>' ?></td>
									<td class="table-action">
										<button type="button" class="btn btn-light btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="uil-arrow-circle-down"></i></button>
										<div class="dropdown-menu">
											<a href="javascript:void(0)" onclick='editype("<?= $c->id ?>")' class="dropdown-item"><i class="mdi mdi-square-edit-outline"></i> Edit</a>
											<a href="<?= base_url("admin/anime/type/delete/$c->id") ?>" class="delete-confirm dropdown-item"><i class="mdi mdi-delete"></i> Delete</a>
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

	function editype(id) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var data = JSON.parse(xhttp.responseText);
				data.forEach(function(element) {
					$("#eid").val(element.id)
					$("#etitle").val(element.title)
					$("#eslug").val(element.slug)
					$("#modal-edit").modal('show')
				});
			}
		};
		xhttp.open("GET", "<?= base_url("admin/anime/type/edit/") ?>" + id, true);
		xhttp.send();
	}
</script>

<div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="standard-modalLabel">New Type</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div>
			<form action="<?= base_url("admin/anime/type") ?>" method="post">
				<div class="modal-body">
					<div class="mb-3">
						<label for="simpleinput" class="form-label">Title</label>
						<input type="text" name="title" class="form-control" required>
					</div>
					<div class="mb-3">
						<label for="simpleinput" class="form-label">Seo Slug</label>
						<input type="text" name="slug" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="standard-modalLabel">Edit Type</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div>
			<form action="<?= base_url("admin/anime/type/edit") ?>" method="post">
				<div class="modal-body">
					<input type="hidden" name="id" id="eid">
					<div class="mb-3">
						<label for="simpleinput" class="form-label">Title</label>
						<input type="text" id="etitle" name="title" class="form-control" required>
					</div>
					<div class="mb-3">
						<label for="simpleinput" class="form-label">Seo Slug</label>
						<input type="text" id="eslug" name="slug" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Update</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->