<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Request extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
	}

	public function index()
	{
		$data = [
			'title' => 'Request',
			'req' => $this->db->get('request')->result()
		];
		backEnd_view('request/list', $data);
	}

	public function view()
	{
		$id = $this->uri->segment(4);
		$data['req'] = $this->db->get_where('request', ['id' => $id])->row();
		if ($data['req']->status == 0) {
			$this->db->update('request', ['status' => 1], ['id' => $id]);
		}
		$data['title'] = 'VIEW REQ';
		backEnd_view('request/view', $data);
	}

	public function delete()
	{
		$id = $this->uri->segment(4);
		$this->db->delete('request', ['id' => $id]);
		$this->session->set_flashdata('success', 'Successfully delete msg.');
		redirect(base_url('admin/request'));
	}
}


/* End of file Admin/Pages.php */
/* Location: ./application/controllers/Admin/Pages.php */
