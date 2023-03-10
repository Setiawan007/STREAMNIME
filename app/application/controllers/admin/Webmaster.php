<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Webmaster extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
	}

	public function index()
	{
		if ($this->input->post()) {
			$showathome = $this->input->post('showathome');
			$temp = '';
			foreach ($showathome as $sw) {
				if ($temp == '') {
					$temp = $sw;
				} else {
					$temp = "$temp,$sw";
				}
			}
			$showathome = $temp;
			$this->db->update('webmaster', [
				'script_head' => $this->input->post('ahead'),
				'script_body' => $this->input->post('abody'),
				'mail_driver' => $this->input->post('mail_driver'),
				'mail_host' => $this->input->post('mail_host'),
				'mail_port' => $this->input->post('mail_port'),
				'mail_username' => $this->input->post('mail_username'),
				'mail_password' => $this->input->post('mail_password'),
				'mail_encryption' => $this->input->post('mail_encryption'),
				'mail_from' => $this->input->post('mail_from'),
				'plugin_comment' => $this->input->post('plugin_comment'),
				'src_comment' => $this->input->post('plugin_src')
			], ['id' => 1]);
			$this->session->set_flashdata('success', 'Successfully updated webmaster.');
			redirect(base_url("admin/webmaster"));
		} else {
			$data = [
				'title' => 'General Webmaster',
				'row' => $this->db->get_where('webmaster', ['id' => 1])->row()
			];
			backEnd_view('webmaster/general', $data);
		}
	}

	public function site_list()
	{
		$data = [
			'title' => 'Site Content Webmaster',
			'type' => $this->db->get('content_type')->result()
		];
		backEnd_view('webmaster/sitec', $data);
	}

	public function site_create()
	{
		if ($this->input->post()) {
			$this->db->insert('content_type', [
				'type_title' => $this->input->post('title'),
				'type_slug' => sluggenerate($this->input->post('slug')),
				'type_status' => 1,
				'type_icon' => $this->input->post('icon'),
				'seo_description' => '',
				'created_at' => date("Y-m-d h:i:sa"),
				'input_content' => _getbox('input_content'),
				'input_video' => _getbox('input_video'),
				'input_gallery' => _getbox('input_gallery'),
				'input_price' => _getbox('input_price'),
				'btn_demo' => _getbox('btn_demo'),
				'btn_download' => _getbox('btn_download'),
				'btn_wabuy' => _getbox('btn_wabuy')
			]);
			$this->session->set_flashdata('success', 'Successfully added Type content');
			redirect(base_url('admin/webmaster/sitec'));
		} else {
			$data = [
				'title' => 'Site Content Create'
			];
			backEnd_view('webmaster/sitec_create', $data);
		}
	}

	public function site_edit()
	{
		$id = $this->uri->segment(5);
		if ($this->input->post()) {
			$this->db->update('content_type', [
				'type_title' => $this->input->post('title'),
				'type_slug' => sluggenerate($this->input->post('slug')),
				'type_status' => _getbox('type_status'),
				'type_icon' => $this->input->post('icon'),
				'seo_description' => $this->input->post('seo_description'),
				'created_at' => date("Y-m-d h:i:sa"),
				'input_content' => _getbox('input_content'),
				'input_video' => _getbox('input_video'),
				'input_gallery' => _getbox('input_gallery'),
				'input_price' => _getbox('input_price'),
				'btn_demo' => _getbox('btn_demo'),
				'btn_download' => _getbox('btn_download'),
				'btn_wabuy' => _getbox('btn_wabuy')
			], ['id' => $id]);
			$this->session->set_flashdata('success', 'Successfully updated Type content');
			redirect(base_url('admin/webmaster/sitec'));
		} else {
			$data = [
				'title' => 'Site Content Edit',
				'row' => $this->db->get_where('content_type', ['id' => $id])->row()
			];
			backEnd_view('webmaster/sitec_edit', $data);
		}
	}

	public function site_delete()
	{
		$id = $this->uri->segment(5);
		$this->db->delete('content_type', ['id' => $id]);
		$this->db->delete('content_item', ['type' => $id]);
		$this->db->delete('content_category', ['c_type' => $id]);
		$this->session->set_flashdata('success', 'Successfully delte Type content');
		redirect(base_url('admin/webmaster/sitec'));
	}
}


/* End of file Admin/Webmaster.php */
/* Location: ./application/controllers/Admin/Webmaster.php */
