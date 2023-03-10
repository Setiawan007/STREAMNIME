<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Anime extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('front_model', 'front');
	}

	public function index()
	{
		$data = [
			'neweps' => $this->front->sedang_tayang(8)->result(),
			'justadded' => $this->front->just_added(8)->result(),
			'genres' => $this->db->get('anime_genre')->result(),
			'topnime' => $this->front->topnime(3)->result()
		];
		hit_visit('page_master');
		frontEnd_view('home', $data);
	}

	public function get_slug()
	{
		$slug = _getSlug(1);
		$content_type = $this->db->get_where('anime_list', ['seo_slug' => $slug]);
		if ($content_type->num_rows() == 1) {
			$row = $content_type->row();
			$video = $this->db->query("SELECT * FROM anime_video WHERE id_anime=$row->id AND type='movie' LIMIT 1");
			if ($video->num_rows() != 0) {
				$this->movie($row, $video->row());
			} else {
				$this->series($row);
			}
		} else {
			// show_404();
			echo '404';
		}
	}

	function movie($row, $video)
	{
		$type = $this->db->get_where('anime_type', ['id' => $row->type])->row();
		$data = [
			'title' => $row->title,
			'row' => $row,
			'video' => $video,
			'type' => $type->title,
			'genres' => $this->db->get('anime_genre')->result(),
			'topnime' => $this->front->topnime(3)->result()
		];
		hit_visit('anime_list', $row->id);
		frontEnd_view('movie', $data);
	}

	function series($row)
	{
		$data = [
			'title' => $row->title,
			'row' => $row,
			'genres' => $this->db->get('anime_genre')->result(),
			'topnime' => $this->front->topnime(3)->result(),
			'jenis' => $this->db->query("SELECT * FROM anime_type WHERE id=$row->type")->row(),
			'video' => $this->db->query("SELECT * FROM anime_video WHERE id_anime=$row->id AND type='series' ORDER BY eps ASC")->result()
		];
		hit_visit('anime_list', $row->id);
		frontEnd_view('series', $data);
	}

	public function get_video()
	{
		$slug = $this->uri->segment(1);
		$anime = $this->db->get_where('anime_list', ['seo_slug' => $slug]);
		if ($anime->num_rows() == 1) {
			$anime_row = $anime->row();
			$eps = $this->uri->segment(2);
			$video = $this->db->get_where('anime_video', ['id_anime' => $anime_row->id, 'eps' => $eps]);
			if ($video->num_rows()) {
				$list_eps = $this->db->query("SELECT * FROM anime_video WHERE id_anime=$anime_row->id AND type='series' ORDER BY eps ASC")->result();
				$data = [
					'title' => "$anime_row->title Episode $eps",
					'anime' => $anime_row,
					'video' => $video->row(),
					'genres' => $this->db->get('anime_genre')->result(),
					'topnime' => $this->front->topnime(3)->result(),
					'jenis' => $this->db->query("SELECT * FROM anime_type WHERE id=$anime_row->type")->row(),
					'list_eps' => $list_eps,
					'start_eps' => $list_eps[0],
					'end_eps' => end($list_eps)
				];
				hit_visit('anime_video', $data['video']->id);
				frontEnd_view('episode', $data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function list()
	{
		$this->load->library('pagination');
		$websettings = $this->db->select('content_perpage')->where('id', 1)->get('websettings')->row();
		$page = $this->input->get('per_page');
		$type = $this->input->get('type');
		$genre = $this->input->get('genre');
		$status = $this->input->get('status');
		$sort = $this->input->get('sort');
		$search = $this->input->get('search');
		$getAnime = $this->front->getAnime($websettings->content_perpage, $page, $type, $genre, $status, $sort, $search);
		$countAnime = $this->front->AnimeCount($type, $genre, $status, $sort, $search)->num_rows();
		$config = [
			'allow_get_array' => true,
			'page_query_string' => true,
			'base_url' => base_url("list?search=$search&type=$type&genre=$genre&status=$status&sort=$sort"),
			'total_rows' => $countAnime,
			'per_page' => $websettings->content_perpage,
			'use_page_numbers' => false,
			'full_tag_open' => '<ul class="pagination justify-content-center">',
			'full_tag_close' => '</ul>',
			'attributes' => ['class' => 'page-link'],
			'first_link' => false,
			'last_link' => false,
			'first_tag_open' => '<li class="page-item">',
			'first_tag_close' => '</li>',
			'prev_link' => '&laquo',
			'prev_tag_open' => '<li class="page-item">',
			'prev_tag_close' => '</li>',
			'next_link' => '&raquo',
			'next_tag_open' => '<li class="page-item">',
			'next_tag_close' => '</li>',
			'last_tag_open' => '<li class="page-item">',
			'last_tag_close' => '</li>',
			'cur_tag_open' => '<li class="page-item active"><a href="#" class="page-link">',
			'cur_tag_close' => '<span class="sr-only"></span></a></li>',
			'num_tag_open' => '<li class="page-item">',
			'num_tag_close' => '</li>'
		];
		$this->pagination->initialize($config);
		$data = [
			'list' => $getAnime->result(),
			'genres' => $this->db->get('anime_genre')->result(),
			'topnime' => $this->front->topnime(3)->result(),
			'anime_type' => $this->db->get('anime_type')->result()
		];
		frontEnd_view('list', $data);
	}

	public function request()
	{
		if ($this->input->post()) {
			$email = $this->input->post('email');
			$pesan = _POST('pesan');
			$query = $this->db->get_where('request', ['email' => $email, 'pesan' => $pesan]);
			if ($query->num_rows() == 0) {
				$this->db->insert('request', [
					'email' => $email,
					'pesan' => $pesan,
					'created_at' => date("Y-m-d h:i:sa")
				]);
			}
			$this->session->set_flashdata('success', 'Berhasil Mengirim pesan.');
			redirect(base_url('request'));
		} else {
			$data = [
				'genres' => $this->db->get('anime_genre')->result(),
				'topnime' => $this->front->topnime(3)->result()
			];
			frontEnd_view('request', $data);
		}
	}
}
