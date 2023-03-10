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

<div class="">
	<div id="skfinder">

	</div>
</div>

<div id="detail" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div>
			<div class="modal-body text-center">
				<a href="" id="linkdirect" target="_blank">
					<img src="" class="card-img" style="width: 200px;" id="preview-img">
				</a>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-pat="" id="detail_delete" data-de="" data-bs-dismiss="modal">Delete</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?= _backEnd() ?>js/vendor.min.js"></script>
<script src="<?= _backEnd() ?>js/app.min.js"></script>
<script>
	var content = $("#skfinder")
	loaddir("files")

	function loaddir(cmd) {
		content.append('<div style="background-color: #0000008c; position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 9999;"><div id="status"><div class="bouncing-loader"><div></div><div></div><div></div></div></div></div>')
		content.load('<?= base_url('admin/storage/') ?>' + encodeURIComponent(cmd))
	}

	function setitem(files) {
		$("#detail").modal("show")
		$("#preview-img").attr("src", files)
		$("#linkdirect").attr("href", files)
	}

	function getdetail(name, path) {
		$("#detail_delete").attr("data-de", path + name)
		$("#detail_delete").attr("data-pat", path)
	}

	$("#detail_delete").click(function() {
		var result = confirm("Do you want to delete this?");
		if (result) {
			var name = $(this).attr("data-de")
			var path = $(this).attr("data-pat")
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {};
			xhttp.open("GET", "<?= base_url("admin/storage?cmd=delfile&name=") ?>" + encodeURIComponent(name), true);
			xhttp.send();
			loaddir(path)
		}
	})
</script>
