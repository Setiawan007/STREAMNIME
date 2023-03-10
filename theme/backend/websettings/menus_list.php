<!-- third party css -->
<link href="<?= _backEnd() ?>css/vendor/dataTables.bootstrap5.css" rel="stylesheet" type="text/css" />
<link href="<?= _backEnd() ?>css/vendor/responsive.bootstrap5.css" rel="stylesheet" type="text/css" />

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
						<a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modaladd" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle me-2"></i> New Menus</a>
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
							<th>Menus</th>
							<th>Type</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($menus as $c) : ?>
							<tr>
								<td>
									<div class="form-check">
										<input type="checkbox" class="form-check-input" id="customCheck2">
										<label class="form-check-label" for="customCheck2">&nbsp;</label>
									</div>
								</td>
								<td>
									<?= $c->title ?>
								</td>
								<td><?= $c->type ?></td>
								<td><?= ($c->status == 1) ? '<span class="badge bg-success">ON</span>' :  '<span class="badge bg-secondary">OFF</span>' ?></td>
								<td class="table-action">
									<?php if ($c->type == 'dropdown') {
										echo '<a href="' . base_url("admin/websettings/menus/sub/$c->id") . '" class="action-icon"> <i class="uil-plus"></i></a>';
									} else {
										echo '<a href="#" class="action-icon"> <i class="uil-layers-slash"></i></a>';
									} ?>
									<a href="<?= base_url("admin/websettings/menus_edit/$c->id") ?>" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
									<a href="<?= base_url("admin/websettings/menus_delete/$c->id") ?>" class="action-icon delete-confirm"> <i class="mdi mdi-delete"></i></a>
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

<div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="mySmallModalLabel">Add New Menus.</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div>
			<form action="" method="POST">
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Title Menu</label>
						<input type="text" class="form-control" name="title" placeholder="Title Menus">
					</div>
					<div class="mb-3">
						<label for="example-select" class="form-label">Type Menus</label>
						<select class="form-select type_menu" name="type_menu">
							<option value="direct">Direct Link</option>
							<option value="dropdown">Drop Down</option>
						</select>
					</div>
					<div class="mb-3 linkurl" style="display: block;">
						<label class="form-label">Link URL</label>
						<input type="text" class="form-control linkurl" name="link_url" placeholder="Enter link">
					</div>
				</div>
				<div class="modal-footer">
					<div class="d-flex justify-content-end">
						<button class="btn btn-primary" type="submit"><i class="mdi mdi-plus-circle me-2"></i> Add</button>
					</div>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
	$(".type_menu").change(function() {
		if ($(this).val() == 'dropdown') {
			$(".linkurl").css("display", "none");
		} else if ($(this).val() == 'direct') {
			$(".linkurl").css("display", "block");
		}
	});

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
