<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
	}

	public function index()
	{
		$data = [
			'title' => 'Request List',
			'page' => $this->db->get('site_pages')->result()
		];
		backEnd_view('pages/list', $data);
	}

	public function create()
	{
		if ($this->input->post()) {
			$title = $this->input->post('title');
			$status = $this->input->post('status');
			$content = $this->input->post('content');
			$seo_slug = sluggenerate($this->input->post('seo_slug'));
			$seo_description = $this->input->post('seo_description');
			$seo_keywords = $this->input->post('seo_keywords');
			$this->db->insert('site_pages', [
				'title' => $title,
				'content' => $content,
				'status' => $status,
				'author' => $this->session->userdata('id_login'),
				'seo_slug' => $seo_slug,
				'seo_description' => $seo_description,
				'seo_keywords' => $seo_keywords,
				'created_at' => date("Y-m-d h:i:sa")
			]);
			$this->session->set_flashdata('success', 'Successfully added page.');
			redirect(base_url('admin/pages'));
		} else {
			$data = [
				'title' => 'Create Page'
			];
			backEnd_view('pages/create', $data);
		}
	}

	public function edit()
	{
		$id = $this->uri->segment(4);
		if ($this->input->post()) {
			$title = $this->input->post('title');
			$status = $this->input->post('status');
			$content = $this->input->post('content');
			$seo_slug = sluggenerate($this->input->post('seo_slug'));
			$seo_description = $this->input->post('seo_description');
			$seo_keywords = $this->input->post('seo_keywords');
			$this->db->update('site_pages', [
				'title' => $title,
				'content' => $content,
				'status' => $status,
				'author' => $this->session->userdata('id_login'),
				'seo_slug' => $seo_slug,
				'seo_description' => $seo_description,
				'seo_keywords' => $seo_keywords,
				'created_at' => date("Y-m-d h:i:sa")
			], ['id' => $id]);
			if ($this->input->post('save') == 'save') {
				$this->session->set_flashdata('success', 'Successfully update page.');
				redirect(base_url("admin/pages/edit/$id"));
			} else {
				$this->session->set_flashdata('success', 'Successfully update page.');
				redirect(base_url('admin/pages'));
			}
		} else {
			$data = [
				'title' => 'Edit Page',
				'row' => $this->db->get_where('site_pages', ['id' => $id])->row()
			];
			backEnd_view('pages/edit', $data);
		}
	}

	public function delete()
	{
		$id = $this->uri->segment(4);
		$this->db->delete('site_pages', ['id' => $id]);
		$this->db->delete('sk_stats', ['by_page' => 'site_pages', 'by_id' => $id]);
		$this->session->set_flashdata('success', 'Successfully delete page.');
		redirect(base_url('admin/pages'));
	}
}


/* End of file Admin/Pages.php */
/* Location: ./application/controllers/Admin/Pages.php */
