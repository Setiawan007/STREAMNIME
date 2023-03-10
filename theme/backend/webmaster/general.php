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
	<div class="col-xl-3 col-lg-3 col-12">
		<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			<a class="nav-link active show" id="mailsettings-tab" data-bs-toggle="pill" href="#mailsettings" role="tab" aria-controls="mailsettings" aria-selected="false">
				<span>Mail Settings</span>
			</a>
			<a class="nav-link" id="addonsc-tab" data-bs-toggle="pill" href="#addonsc" role="tab" aria-controls="addonsc" aria-selected="false">
				<span>Add-ons Script</span>
			</a>
			<a class="nav-link" id="plugincomment-tab" data-bs-toggle="pill" href="#plugincomment" role="tab" aria-controls="plugincomment" aria-selected="false">
				<span>Plugin Comment</span>
			</a>
		</div>
	</div> <!-- end col-->

	<div class="col">
		<form action="" method="post">
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-end">
						<button class="btn btn-primary" type="submit">Save Changes</button>
					</div>
					<div class="tab-content" id="v-pills-tabContent">
						<div class="tab-pane active show" id="mailsettings" role="tabpanel" aria-labelledby="mailsettings-tab">
							<div class="row mt-3">
								<div class="col-xl-5">
									<div class="mb-3">
										<label for="example-select" class="form-label">Mail Driver</label>
										<select class="form-select" id="mail_driver" name="mail_driver">
											<option value="smtp">SMTP Mail</option>
										</select>
									</div>
								</div>
								<div class="col-xl-4 col-lg-4">
									<div class="mb-3">
										<label class="form-label">Mail Host : </label>
										<input type="text" name="mail_host" id="mail_host" value="<?= $row->mail_host ?>" class="form-control">
									</div>
								</div>
								<div class="col-xl-3 col-lg-3">
									<div class="mb-3">
										<label class="form-label">Mail Port : </label>
										<input type="text" name="mail_port" id="mail_port" value="<?= $row->mail_port ?>" class="form-control">
									</div>
								</div>
								<div class="col-xl-5 col-lg-5">
									<div class="mb-3">
										<label class="form-label">Mail Username : </label>
										<input type="text" name="mail_username" id="mail_username" value="<?= $row->mail_username ?>" class="form-control">
									</div>
								</div>
								<div class="col-xl-6 col-lg-6">
									<div class="mb-3">
										<label for="example-select" class="form-label">Mail Password : </label>
										<input type="text" name="mail_password" id="mail_password" value="<?= $row->mail_password ?>" class="form-control">
									</div>
								</div>
								<div class="col-xl-5 col-lg-5">
									<div class="mb-3">
										<label class="form-label">Mail Encryption : </label>
										<select class="form-select" id="mail_encryption" name="mail_encryption">
											<option <?= "" . ($row->mail_encryption == 'ssl') ? 'selected' : '' . "" ?> value="ssl">ssl</option>
											<option <?= "" . ($row->mail_encryption == 'tls') ? 'selected' : '' . "" ?> value="tls">tls</option>
										</select>
									</div>
								</div>
								<div class="col-xl-6 col-lg-6">
									<div class="mb-3">
										<label for="example-select" class="form-label">Mail From : </label>
										<input type="text" value="<?= $row->mail_from ?>" name="mail_from" id="mail_from" class="form-control">
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="addonsc" role="tabpanel" aria-labelledby="addonsc-tab">
							<div class="mb-3">
								<label class="form-label">Head Add-ons : </label>
								<textarea name="ahead" class="form-control" rows="10"><?= $row->script_head ?></textarea>
							</div>
							<div class="mb-3">
								<label class="form-label">Body Add-ons : </label>
								<textarea name="abody" class="form-control" rows="10"><?= $row->script_body ?></textarea>
							</div>
						</div>
						<div class="tab-pane fade" id="plugincomment" role="tabpanel" aria-labelledby="plugincomment-tab">
							<div class="mb-3">
								<label for="example-select" class="form-label">Plugin</label>
								<select class="form-select" id="plugin_comment" name="plugin_comment" onchange="plugin()">
									<option value="off" <?= ($row->plugin_comment == 'off') ? "selected" : "" ?>>None</option>
									<option value="disqus" <?= ($row->plugin_comment == 'disqus') ? "selected" : "" ?>>Disqus Comment</option>
								</select>
							</div>
							<div class="mb-3 disqus">
								<label class="form-label">Src Disqus : </label>
								<textarea name="plugin_src" class="form-control" rows="10"><?= $row->src_comment ?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- end tab-content-->
		</form>
	</div> <!-- end col-->

</div>
<!-- end row-->

<script src="<?= _backEnd() ?>js/vendor.min.js"></script>
<script src="<?= _backEnd() ?>js/app.min.js"></script>

<script>
	if (document.getElementById('plugin_comment').value == 'off') {
		$('.disqus').css("display", "none");
	}

	function plugin() {
		status = document.getElementById('plugin_comment').value
		if (status == 'off') {
			$('.disqus').css("display", "none");
		} else {
			$('.disqus').css("display", "block");
		}
	}
</script>
