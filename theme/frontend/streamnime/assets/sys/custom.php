<?php
if ($this->input->post()) {
	$data[0]['title'] = $this->input->post('title');
	$data[0]['description'] = $this->input->post('description');
	$data[0]['footer'] = $this->input->post('footer');
	$jsonfile = json_encode($data, JSON_PRETTY_PRINT);
	$anggota = file_put_contents("./theme/frontend/$websettings->theme_active/assets/sys/custom.json", $jsonfile);
	$this->session->set_flashdata('success', 'Successfully saved changes.');
	redirect(base_url("admin/themes/custom"));
}
?>


<form action="" method="post">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<small>Header</small>
					<hr>
					<div class="row">
						<div class="col-12">
							<div class="mb-3">
								<label for="simpleinput" class="form-label">Title</label>
								<input type="text" name="title" class="form-control" value="<?= $row['title'] ?>">
							</div>
						</div>
						<div class="col-12">
							<div class="mb-3">
								<label for="simpleinput" class="form-label">Description</label>
								<textarea name="description" class="form-control" rows="5"><?= $row['description'] ?></textarea>
							</div>
						</div>
					</div>
					<small>Footer</small>
					<hr>
					<div class="mb-3">
						<label for="simpleinput" class="form-label">Footer</label>
						<input type="text" name="footer" class="form-control" value="<?= $row['footer'] ?>">
					</div>
					<div class="text-end">
						<button class="btn btn-primary" type="submit">Save Change</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>