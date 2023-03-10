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

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<form action="" method="post">
					<input type="hidden" name="id" value="<?= $row->id ?>">
					<div class="mb-3">
						<label class="form-label">Title Menu</label>
						<input type="text" class="form-control" name="title" value="<?= $row->title ?>" placeholder="Title Menus" required>
					</div>
					<div class="mb-3">
						<label for="example-select" class="form-label">Type Menus</label>
						<select class="form-select type_menu" name="type">
							<option value="direct" <?= ($row->type == 'direct') ? "selected" : "" ?>>Direct Link</option>
							<option value="dropdown" <?= ($row->type == 'dropdown') ? "selected" : "" ?>>Drop Down</option>
						</select>
					</div>
					<div class="mb-3 linkurl" style="display: block;">
						<label class="form-label">Link URL</label>
						<input type="text" class="form-control" name="link" value="<?= $row->link ?>" placeholder="Enter link">
					</div>
					<div class="mb-3">
						<label for="example-select" class="form-label">Status</label>
						<select class="form-select" name="status">
							<option value="1" <?= ($row->status == 1) ? "selected" : "" ?>>Active</option>
							<option value="0" <?= ($row->status == 0) ? "selected" : "" ?>>Disable</option>
						</select>
					</div>
					<div class="d-flex justify-content-center">
						<button type="submit" class="btn btn-primary">Save Change</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script src="<?= _backEnd() ?>js/vendor.min.js"></script>
<script src="<?= _backEnd() ?>js/app.min.js"></script>
<script>
	$(document).ready(function() {
		if ('<?= $row->type ?>' == 'dropdown') {
			$(".linkurl").css("display", "none");
		}
	})

	$(".type_menu").change(function() {
		if ($(this).val() == 'dropdown') {
			$(".linkurl").css("display", "none");
		} else if ($(this).val() == 'direct') {
			$(".linkurl").css("display", "block");
		}
	});
</script>
