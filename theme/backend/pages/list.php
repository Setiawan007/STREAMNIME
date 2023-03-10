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
						<a href="<?= base_url("admin/pages/create") ?>" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle me-2"></i> New Page</a>
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
							<th>Page</th>
							<th>Status</th>
							<th>Visitor</th>
							<th style="width: 150px;">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($page as $p) : ?>
							<tr>
								<td>
									<div class="form-check">
										<input type="checkbox" class="form-check-input" id="customCheck2">
										<label class="form-check-label" for="customCheck2">&nbsp;</label>
									</div>
								</td>
								<td>
									<?= $p->title ?>
								</td>
								<td><?= ($p->status == 1) ? '<span class="badge bg-success">ON</span>' :  '<span class="badge bg-secondary">OFF</span>' ?></td>
								<td>
									<?= count_visitor('site_pages', $p->id) ?>
								</td>
								<td class="table-action">
									<a href="<?= base_url($p->seo_slug) ?>" target="_blank" class="action-icon"> <i class="mdi mdi-eye"></i></a>
									<a href="<?= base_url("admin/pages/edit/$p->id") ?>" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
									<a href="<?= base_url("admin/pages/delete/$p->id") ?>" class="action-icon delete-confirm"> <i class="mdi mdi-delete"></i></a>
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
