<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		cek_login(true);
		if ($this->input->post()) {
			$email = _POST('email');
			$password = _POST('password');
			$rembemr = _POST('remember');
			$query = $this->db->get_where('users', ['email' => $email]);
			if ($query->num_rows() == 1) {
				$row = $query->row();
				if (password_verify($password, $row->password)) {
					if ($rembemr == 'on') {
						setcookie('sk4', $row->id, time() + (10 * 365 * 24 * 60 * 60), '/');
						setcookie('token', hash('ripemd160', $row->password), time() + (10 * 365 * 24 * 60 * 60), '/');
					}
					$this->session->set_userdata(array('id_login' => $row->id, 'status_login' => true, 'role_login' => $row->role));
					$this->session->set_flashdata('success', 'Welcome back ' . $row->name . '.');
					redirect(base_url("admin"));
				} else {
					$this->session->set_flashdata('error', 'Your password is wrong.');
					redirect(base_url("admin/auth/login"));
				}
			} else {
				$this->session->set_flashdata('error', 'Email is not registered.');
				redirect(base_url("admin/auth/login"));
			}
		} else {
			$this->load->view('backend/auth/login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		unset($_COOKIE['token']);
		unset($_COOKIE['sk4']);
		setcookie('sk4', NULL, -1, '/');
		setcookie('token', NULL, -1, '/');
		$this->session->set_flashdata('success', 'Account logged out successfully.');
		redirect(base_url("admin/auth/login"));
	}
}
