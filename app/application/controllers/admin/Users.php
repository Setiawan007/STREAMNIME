<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
	}

	public function index()
	{
		$data = [
			'title' => 'Users Manager',
			'users' => $this->db->get('users')->result()
		];
		backEnd_view('users/users_list', $data);
	}

	public function create()
	{
		if ($this->input->post()) {
			$img = uploadimg([
				'path' => 'avatar',
				'name' => 'avatar',
				'compress' => false
			]);
			if ($img['result'] == 'success') {
				$gambar = $img['nama_file'];
			} else {
				$gambar = 'default.jpg';
			}
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$role = $this->input->post('role');
			$this->db->insert('users', [
				'name' => $name,
				'email' => $email,
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'theme_dark' => 'false',
				'avatar' => $gambar,
				'role' => $role
			]);
			$this->session->set_flashdata('success', 'Successfully added new users.');
			redirect(base_url('admin/users'));
		} else {
			$data = [
				'title' => 'Users Create'
			];
			backEnd_view('users/users_create', $data);
		}
	}

	public function users_edit()
	{
		$id = $this->uri->segment(4);
		if ($this->session->userdata('role_login') != 'admin') {
			if ($this->session->userdata('id_login') == $id) {
			} else {
				$this->session->set_flashdata('error', 'Access denied to your role.');
				redirect(base_url('admin'));
			}
		}
		if ($this->input->post()) {
			$row = $this->db->get_where('users', ['id' => $id])->row();
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$role = $this->input->post('role');
			$theme = $this->input->post('theme');
			if ($password == null) {
				$password = $row->password;
			} else {
				$password = password_hash($password, PASSWORD_DEFAULT);
			}
			$img = uploadimg([
				'path' => 'avatar',
				'name' => 'avatar',
				'compress' => false
			]);
			if ($img['result'] == 'success') {
				$gambar = $img['nama_file'];
			} else {
				$gambar = $row->avatar;
			}
			$this->db->update('users', [
				'name' => $name,
				'email' => $email,
				'password' => $password,
				'theme_dark' => $theme,
				'avatar' => $gambar,
				'role' => $role
			], ['id' => $id]);
			$this->session->set_flashdata('success', 'Successfully updated users.');
			redirect(base_url('admin/users'));
		} else {
			$data = [
				'title' => 'Users Edit',
				'row' => $this->db->get_where('users', ['id' => $id])->row()
			];
			backEnd_view('users/users_edit', $data);
		}
	}

	public function users_delete()
	{
		$id = $this->uri->segment(4);
		if ($id) {
			$this->db->delete('users', [
				'id' => $id
			]);
			$this->session->set_flashdata('success', 'Successfully delete users.');
			redirect(base_url('admin/users'));
		}
	}

	public function theme()
	{
		$row = $this->db->get_where('users', ['id' => $this->session->userdata('id_login')])->row();
		if ($row->theme_dark == 'true') {
			$th = 'false';
		} else if ($row->theme_dark == 'false') {
			$th = 'true';
		}
		$this->db->update('users', ['theme_dark' => $th], ['id' => $this->session->userdata('id_login')]);
		$this->session->set_flashdata('success', 'Successfully change theme.');
		redirect(base_url('admin'));
	}
}
