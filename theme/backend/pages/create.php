<script src="<?= _backEnd() ?>tinymce/tinymce.min.js"></script>
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
				<form action="" method="POST" enctype="multipart/form-data">
					<div class="d-flex justify-content-end mb-3">
						<button class="btn btn-primary mx-1" type="submit" name="save" value="save">Create</button>
						<!-- <button class="btn btn-secondary" type="submit" name="save" value="saveexit">Update & Exit</button> -->
					</div>
					<ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
						<li class="nav-item">
							<a href="#general" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 active">
								<i class="uil-window d-md-none d-block"></i>
								<span class="d-none d-md-block">General</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="#seo" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
								<i class="uil-arrow-growth d-md-none d-block"></i>
								<span class="d-none d-md-block">SEO Settings</span>
							</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane show active" id="general">
							<div class="row">
								<div class="col-12">
									<div class="mb-3">
										<label class="form-label">Title</label>
										<input type="text" class="form-control seo_input" name="title" id="i_title" value="" placeholder="Title Page" required>
									</div>
									<div class="mb-3">
										<label class="form-label">Status</label>
										<select class="form-control" name="status" required>
											<option value="1">On</option>
											<option value="0">Off</option>
										</select>
									</div>
								</div>
							</div>
							<div class="mb-3">
								<label class="form-label">Content</label>
								<textarea name="content" id="content"></textarea>
							</div>
						</div>

						<div class="tab-pane" id="seo">
							<div class="row">
								<div class="col-xl-6 col-lg-6 col-12">
									<div class="mb-3">
										<label class="form-label">SEO Url</label>
										<input type="text" class="form-control seo_input" name="seo_slug" id="seo_slug" value="" required>
									</div>
									<div class="mb-3">
										<label class="form-label">SEO Description</label>
										<textarea type="text" class="form-control seo_input" rows="6" name="seo_description" id="seo_description"></textarea>
									</div>
									<div class="mb-3">
										<label class="form-label">SEO Keywords</label>
										<input type="text" class="form-control" name="seo_keywords" id="seo_keywords" value="">
									</div>
								</div>
								<div class="col">
									<div class="card border" style="background: #f9f9f9;">
										<div class="card-body">
											<h4 class="m-0" style="color: #1a0cab;" id="title_rev">-</h4>
											<div style="color: #006622;" id="slug_rev">seo-url</div>
											<small id="description_rev">seo description</small>
										</div>
									</div>
									<small><i class="uil-comment-notes"></i> Mange your page title, meta description, keywords and unique friendly URL. This help you to manage how this topic shows up on search engines.</small>
								</div>
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

	$(".seo_input").keyup(function() {
		$("#slug_rev").text("<?= base_url() ?>" + slugify($("#seo_slug").val()))
		$("#description_rev").text($("#seo_description").val())
		$("#title_rev").text($("#i_title").val())
	});

	function slugify(string) {
		return string
			.toString()
			.trim()
			.toLowerCase()
			.replace(/\s+/g, "-")
			.replace(/[^\w\-]+/g, "")
			.replace(/\-\-+/g, "-")
			.replace(/^-+/, "")
			.replace(/-+$/, "");
	}

	tinymce.init({
		selector: '#content',
		plugins: 'link lists image advlist fullscreen media code table emoticons textcolor codesample hr preview mediaGallery',
		height: 400,
		menubar: false,
		relative_urls: false,
		remove_script_host: false,
		convert_urls: true,
		toolbar: [
			'undo redo | bold italic underline strikethrough forecolor backcolor bullist numlist | blockquote subscript superscript | alignleft aligncenter alignright alignjustify | mediaGallery media link',
			' formatselect | cut copy paste selectall | table emoticons hr | removeformat | preview code codesample | fullscreen',
		],
		codesample_languages: [{
				text: 'HTML/XML',
				value: 'html'
			},
			{
				text: 'JavaScript',
				value: 'javascript'
			},
			{
				text: 'CSS',
				value: 'css'
			},
			{
				text: 'PHP',
				value: 'php'
			},
			{
				text: 'Ruby',
				value: 'ruby'
			},
			{
				text: 'Python',
				value: 'python'
			},
			{
				text: 'Java',
				value: 'java'
			},
			{
				text: 'C',
				value: 'c'
			},
			{
				text: 'C#',
				value: 'csharp'
			},
			{
				text: 'C++',
				value: 'cpp'
			}
		],
	});
	tinymce.PluginManager.add('mediaGallery', function(editor, url) {
		var openDialog = function() {
			loaddir("files")
			$('#skfindershow').modal('show');
		};
		editor.ui.registry.addButton('mediaGallery', {
			icon: 'gallery',
			onAction: function() {
				// Open window
				openDialog();
			}
		});
	});
</script>
<!-- Modal -->
<div class="modal fade m-0 p-0" style="z-index: 999999999999;" id="skfindershow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-fullscreen">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">SKFinder</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div> <!-- end modal header -->
			<div class="modal-body" id="skfinder">

			</div>
		</div> <!-- end modal content-->
	</div> <!-- end modal dialog-->
</div> <!-- end modal-->

<script>
	var content = $("#skfinder")
	var start = $("#showskfinder")

	function loaddir(cmd) {
		content.append('<div style="background-color: #0000008c; position: fixed; top: 0; left: 0; right: 0; bottom: 0; z-index: 9999;"><div id="status"><div class="bouncing-loader"><div></div><div></div><div></div></div></div></div>')
		content.load('<?= base_url('admin/storage/') ?>' + encodeURIComponent(cmd))
	}

	function setitem(file) {
		var ed = tinymce.activeEditor;
		var img = '<img src="' + file + '" alt="ilhamsk" style="border-radius:.25rem;">';
		ed.selection.setContent(img);
		$('#skfindershow').modal('hide');
	}
</script>
