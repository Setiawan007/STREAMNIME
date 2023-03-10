<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('stats_model', 'stats');
	}

	public function index()
	{
		$data = [
			'title' => 'Home Admin',
			'anime_count' =>  $this->db->get('anime_list')->num_rows(),
			'users_count' => $this->db->get('users')->num_rows(),
			'pages_count' => $this->db->get('site_pages')->num_rows(),
			'stats' => $this->stats->countDays_byPage('page_master'),
			'visitor_page' => $this->stats->countAll_by('page_master')->num_rows()
		];
		backEnd_view('home', $data);
	}

	// public function set_theme()
	// {
	// 	$id = $this->session->userdata('id_login');
	// 	$this->db->update('users', ['theme_dark' => $get], ['id' => $id]);
	// }

	public function icons()
	{

		$data = [
			'title' => 'Icons'
		];
		backEnd_view('icons', $data);
	}
}


/* End of file Admin/Home.php */
/* Location: ./application/controllers/Admin/Home.php */
