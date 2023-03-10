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
			<h4 class="page-title"><?= $row->title ?></h4>
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
						<a href="<?= base_url("admin/anime/video/add/$row->id") ?>" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle me-2"></i> New Video</a>
					</div>
					<div class="col-sm-8">
						<div class="text-sm-end">
							<button type="button" class="btn btn-primary mb-2 me-1">Import</button>
							<button type="button" class="btn btn-primary mb-2">Export</button>
						</div>
					</div><!-- end col-->
				</div>

				<table id="basic-datatable" class="table dt-responsive">
					<thead>
						<tr>
							<th class="all" style="width: 20px;">
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="customCheck1">
									<label class="form-check-label" for="customCheck1">&nbsp;</label>
								</div>
							</th>
							<th>Episode</th>
							<th>Type</th>
							<th>created</th>
							<th>Visit</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($content as $c) : ?>
							<tr>
								<td>
									<div class="form-check">
										<input type="checkbox" class="form-check-input" id="customCheck2">
										<label class="form-check-label" for="customCheck2">&nbsp;</label>
									</div>
								</td>
								<td>
									<?= "eps $c->eps" ?>
								</td>
								<td><?= $c->type ?></td>
								<td><?= '<span class="badge bg-primary">' . $c->created_at . '</span>' ?></td>
								<td><?= count_visitor('content_item', $c->id) ?></td>
								<td class="table-action">
									<button type="button" class="btn btn-light btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="uil-arrow-circle-down"></i></button>
									<div class="dropdown-menu">
										<a href="<?= base_url() ?>" target="_blank" class="dropdown-item"><i class="mdi mdi-eye"></i> View</a>
										<a href="<?= base_url("admin/anime/video/edit/$row->id/$c->id") ?>" class="dropdown-item"><i class="mdi mdi-square-edit-outline"></i> Edit</a>
										<a href="<?= base_url("admin/anime/video/delete/$row->id/$c->id") ?>" class="delete-confirm dropdown-item"><i class="mdi mdi-delete"></i> Delete</a>
									</div>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
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
</script>