<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sitemap extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = [
			'page' => $this->db->query('SELECT * FROM site_pages WHERE status = 1 ORDER BY id DESC')->result(),
			'anime_list' => $this->db->query('SELECT * FROM anime_list ORDER BY id DESC')->result()
		];
		$this->load->view('sitemap.php', $data);
	}
}


/* End of file Sitemap.php */
/* Location: ./application/controllers/Sitemap.php */
