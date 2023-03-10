<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Websettings extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('admin_model', 'am');
	}

	public function index()
	{
		if ($this->input->post()) {
			$row = $this->db->get_where('websettings', ['id' => 1])->row();
			$title = $this->input->post('title');
			$description = $this->input->post('description');
			$keywords = $this->input->post('keywords');
			$facebook = $this->input->post('facebook');
			$twitter = $this->input->post('twitter');
			$linkedin = $this->input->post('linkedin');
			$instagram = $this->input->post('instagram');
			$whatsapp = $this->input->post('whatsapp');
			$youtube = $this->input->post('youtube');
			$github = $this->input->post('github');
			$perpage = $this->input->post('content_perpage');
			$main = $this->input->post('maintenance');
			$img = $this->upimg([
				'name' => 'site_logo',
				'compress' => true,
				'height' => 190,
				'width' => 312
			]);
			if ($img['result'] == 'success') {
				$site_logo = $img['nama_file'];
				unlink("./public/storage/$row->site_logo");
			} else {
				$site_logo = $row->site_logo;
			}
			$img = $this->upimg([
				'name' => 'favicon',
				'compress' => true,
				'height' => 190,
				'width' => 312
			]);
			if ($img['result'] == 'success') {
				$favicon = $img['nama_file'];
				unlink("./public/storage/$row->seo_favicon");
			} else {
				$favicon = $row->seo_favicon;
			}
			$img = $this->upimg([
				'name' => 'site_thumb',
				'compress' => true,
				'height' => 190,
				'width' => 312
			]);
			if ($img['result'] == 'success') {
				$site_thumb = $img['nama_file'];
				unlink("./public/storage/$row->seo_thumbnail");
			} else {
				$site_thumb = $row->seo_thumbnail;
			}
			$this->am->update_websettings($title, $description, $keywords, $facebook, $twitter, $linkedin, $instagram, $whatsapp, $youtube, $github, $site_logo, $favicon, $site_thumb, '', $main, $perpage);
			$this->session->set_flashdata("success", "Successfully updated Web Settings.");
			redirect(base_url("admin/websettings"));
		} else {
			$data = [
				'title' => 'Web Settings',
				'row' => $this->db->get_where('websettings', ['id' => 1])->row()
			];
			backEnd_view('websettings/index', $data);
		}
	}

	public function menus_list()
	{
		if ($this->input->post()) {
			$title = $this->input->post('title');
			$type = $this->input->post('type_menu');
			if ($type == 'direct' || $type == 'submenu') {
				$link = $this->input->post('link_url');
			} else {
				$link = 'javascript:void(0)';
			}
			if ($type == 'submenu') {
				$subid = $this->input->post('subid');
			} else {
				$subid = 0;
			}
			$this->db->insert('site_menus', [
				'title' => $title,
				'type' => $type,
				'link' => $link,
				'sub_id' => $subid,
				'status' => 1
			]);
			$this->session->set_flashdata("success", "Successfully added menu.");
			redirect(base_url("admin/websettings/menus"));
		} else {
			$data = [
				'title' => 'Site Menus',
				'menus' => $this->am->get_menus()
			];
			backEnd_view('websettings/menus_list', $data);
		}
	}

	public function menus_edit()
	{
		$id = $this->uri->segment(4);
		if ($id) {
			if ($this->input->post()) {
				$id = $this->input->post('id');
				$title = $this->input->post('title');
				$type = $this->input->post('type');
				$link = $this->input->post('link');
				$status = $this->input->post('status');
				$this->db->update('site_menus', [
					'title' => $title,
					'type' => $type,
					'link' => $link,
					'sub_id' => 0,
					'status' => $status
				], ['id' => $id]);
				$this->session->set_flashdata("success", "Successfully update menu.");
				redirect(base_url("admin/websettings/menus"));
			} else {
				$row = $this->db->get_where('site_menus', ['id' => $id])->row();
				$data = [
					'title' => 'Edit Menus',
					'row' => $row
				];
				backEnd_view('websettings/menus_edit', $data);
			}
		}
	}

	public function menus_delete()
	{
		$id = $this->uri->segment(4);
		if ($id) {
			$this->db->delete('site_menus', ['id' => $id]);
			$this->session->set_flashdata("success", "Successfully deleted menus.");
			redirect(base_url("admin/websettings/menus"));
		}
	}



	public function submenu()
	{
		$id = $this->uri->segment(5);
		$row = $this->db->get_where('site_menus', ['id' => $id]);
		if ($row->num_rows() == 1) {
			$row = $row->row();
			if ($this->input->post()) {
				$title = $this->input->post('title');
				$link = $this->input->post('link');
				$this->db->insert('site_menus', [
					'title' => $title,
					'type' => 'submenu',
					'link' => $link,
					'sub_id' => $row->id,
					'status' => 1
				]);
				$this->session->set_flashdata("success", "Successfully added a sub menu.");
				redirect(base_url("admin/websettings/menus/sub/$row->id"));
			} else {
				$row1 = $this->db->get_where('site_menus', ['sub_id' => $id]);
				$data = [
					'title' => "Sub Menu For $row->title",
					'menus' => $row1->result(),
					'for' => $row->title,
					'sub_id' => $row->id
				];
				backEnd_view('websettings/submenu', $data);
			}
		} else {
			show_404();
		}
	}

	public function submenu_edit()
	{
		$id = $this->uri->segment(5);
		$subid = $this->uri->segment(7);
		$row = $this->db->get_where('site_menus', ['id' => $id]);
		if ($row->num_rows() == 1) {
			$row = $row->row();
			if ($this->input->post()) {
				$title = $this->input->post('title');
				$link = $this->input->post('link');
				$this->db->update('site_menus', [
					'title' => $title,
					'type' => 'submenu',
					'link' => $link,
					'sub_id' => $row->id,
					'status' => 1
				], ['id' => $subid]);
				$this->session->set_flashdata("success", "Successfully update a sub menu.");
				redirect(base_url("admin/websettings/menus/sub/$row->id"));
			} else {
				$row1 = $this->db->get_where('site_menus', ['id' => $subid]);
				$data = [
					'title' => "Edit Sub Menu For $row->title",
					'row' => $row1->row(),
					'sub_id' => $row->id
				];
				backEnd_view('websettings/submenu_edit', $data);
			}
		} else {
			show_404();
		}
	}

	public function submenu_delete()
	{
		$subid = $this->uri->segment(7);
		$id = $this->uri->segment(5);
		if ($id) {
			$this->db->delete('site_menus', ['id' => $subid]);
			$this->session->set_flashdata("success", "Successfully deleted sub menus.");
			redirect(base_url("admin/websettings/menus/sub/$id"));
		}
	}


	function upimg($par = [])
	{
		$this->load->library('upload');
		$config['upload_path'] = "./public/storage/";
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|svg';
		$config['encrypt_name'] = TRUE;
		$this->upload->initialize($config);
		if (!empty($_FILES["$par[name]"]['name'])) {
			if ($this->upload->do_upload("$par[name]")) {
				$img = $this->upload->data();
				$image = $img['file_name'];
				return array('result' => 'success', 'nama_file' => $image, 'error' => '');
			} else {
				return array('result' => 'error', 'file' => '', 'error' => $this->upload->display_errors());
			}
		} else {
			return array('result' => 'noimg');
		}
	}
}
