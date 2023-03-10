<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function maintenance()
	{
		$data = $this->db->get_where('websettings', ['id' => 1])->row();
		if ($data->maintenance != 'on') {
			redirect(base_url());
		} else {
			$this->load->view('frontend/maintenance');
		}
	}

	public function subscriber()
	{
		if ($this->input->post()) {
			$email = $this->input->post('email');
			if ($this->db->get_where('subscriber', ['email' => $email])->num_rows() == 0) {
				$created = date("Y-m-d h:i:sa");
				$this->db->insert('subscriber', ['email' => $email, 'created_at' => $created]);
			}
		}
		$this->session->set_flashdata('success', 'thanks for subscribing.');
		redirect(base_url());
	}

	public function page_404()
	{
		$data = $this->db->get_where('websettings', ['id' => 1])->row();
		if ($data->maintenance != 'on') {
			redirect(base_url());
		} else {
			$this->load->view('frontend/maintenance');
		}
	}
}
