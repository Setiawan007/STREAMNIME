<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Anime extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
		$this->load->model('anime_model', 'anime');
	}

	public function index()
	{
		$data = [
			'title' => 'Anime List',
			'content' => $this->anime->get_new()->result()
		];
		backEnd_view('anime/list', $data);
	}

	public function create()
	{
		if ($this->input->post()) {
			$title = $this->input->post('title');
			$type = $this->input->post('type');
			$description = $this->input->post('description');
			$genre = $this->input->post('genre');
			$status = $this->input->post('status');
			$trailer = $this->input->post('trailer');
			$temp = '';
			foreach ($genre as $c) {
				if ($temp == '') {
					$temp = $c;
				} else {
					$temp = "$temp,$c";
				}
			}
			$genre = $temp;
			$img = uploadimg([
				'path' => 'thumbnails',
				'name' => 'thumb',
				'compress' => false
			]);
			if ($img['result'] == 'success') {
				$gambar = $img['nama_file'];
			} else {
				$gambar = 'default.jpg';
			}
			$this->db->insert('anime_list', [
				'title' => $title,
				'thumb' => $gambar,
				'description' => $description,
				'type' => $type,
				'genre' => $genre,
				'status' => $status,
				'trailer' => $trailer,
				'uploader' => $this->session->userdata('id_login'),
				'seo_slug' => sluggenerate(_POST('title')),
				'seo_description' => strip_tags(word_limiter($this->input->post('description'), 160)),
				'seo_keywords' => '',
				'created_at' => date("Y-m-d h:i:sa"),
				'updated_at' => date("Y-m-d h:i:sa")
			]);
			$this->session->set_flashdata('success', 'Anime was successfully Publish.');
			redirect(base_url("admin/anime"));
		} else {
			$data = [
				'title' => 'New Anime',
				'genre' => $this->db->get('anime_genre')->result(),
				'type' => $this->db->get('anime_type')->result()
			];
			backEnd_view('anime/create', $data);
		}
	}

	public function edit()
	{
		$id = $this->uri->segment(4);
		if ($this->input->post()) {
			$title = $this->input->post('title');
			$type = $this->input->post('type');
			$description = $this->input->post('description');
			$genre = $this->input->post('genre');
			$status = $this->input->post('status');
			$trailer = $this->input->post('trailer');
			$seo_slug = $this->input->post('seo_slug');
			$seo_keywords = $this->input->post('seo_keywords');
			$seo_description = $this->input->post('seo_description');
			$temp = '';
			foreach ($genre as $c) {
				if ($temp == '') {
					$temp = $c;
				} else {
					$temp = "$temp,$c";
				}
			}
			$genre = $temp;
			$img = uploadimg([
				'path' => 'thumbnails',
				'name' => 'thumb',
				'compress' => false
			]);
			if ($img['result'] == 'success') {
				$gambar = $img['nama_file'];
				$this->db->update('anime_list', [
					'title' => $title,
					'thumb' => $gambar,
					'description' => $description,
					'type' => $type,
					'genre' => $genre,
					'status' => $status,
					'trailer' => $trailer,
					'uploader' => $this->session->userdata('id_login'),
					'seo_slug' => sluggenerate($seo_slug),
					'seo_description' => strip_tags(word_limiter($seo_description, 160)),
					'seo_keywords' => $seo_keywords,
					'updated_at' => date("Y-m-d h:i:sa")
				], ['id' => $id]);
			} else {
				$this->db->update('anime_list', [
					'title' => $title,
					'description' => $description,
					'type' => $type,
					'genre' => $genre,
					'status' => $status,
					'trailer' => $trailer,
					'uploader' => $this->session->userdata('id_login'),
					'seo_slug' => sluggenerate($seo_slug),
					'seo_description' => strip_tags(word_limiter($seo_description, 160)),
					'seo_keywords' => $seo_keywords,
					'updated_at' => date("Y-m-d h:i:sa")
				], ['id' => $id]);
			}
			$this->session->set_flashdata('success', 'Anime was successfully Update.');
			redirect(base_url("admin/anime"));
		} else {
			$data = [
				'title' => 'Edit Anime',
				'genre' => $this->db->get('anime_genre')->result(),
				'type' => $this->db->get('anime_type')->result(),
				'row' => $this->db->get_where('anime_list', ['id' => $id])->row()
			];
			backEnd_view('anime/edit', $data);
		}
	}

	public function delete()
	{
		$id = $this->uri->segment(4);
		$this->db->delete('anime_list', ['id' => $id]);
		$this->db->delete('anime_video', ['id_anime' => $id]);
		$this->session->set_flashdata('success', 'Anime was successfully Delete.');
		redirect(base_url("admin/anime"));
	}

	public function video_add()
	{
		if ($this->input->post()) {
			$id_anime = $this->input->post('id_anime');
			$type = $this->input->post('type');
			$videos = $this->input->post('videos');
			$downloads = $this->input->post('downloads');
			$temp = '';
			foreach ($videos as $c) {
				if ($temp == '') {
					$temp = $c;
				} else {
					$temp = "$temp{{==}}$c";
				}
			}
			$videos = $temp;
			$temp = '';
			foreach ($downloads as $c) {
				if ($temp == '') {
					$temp = $c;
				} else {
					$temp = "$temp{{==}}$c";
				}
			}
			$downloads = $temp;
			if ($type == 'series') {
				$series = $this->input->post('series');
			} else {
				$series = '';
			}
			$this->db->insert('anime_video', [
				'id_anime' => $id_anime,
				'type' => $type,
				'eps' => $series,
				'video' => $videos,
				'download' => $downloads,
				'created_at' => date("Y-m-d h:i:sa")
			]);
			$this->db->update('anime_list', [
				'updated_at' => date("Y-m-d h:i:sa")
			], ['id' => $id_anime]);
			if ($this->input->post('btn') != 'eps') {
				$this->session->set_flashdata('success', 'successfully added video in anime..');
				redirect(base_url("admin/anime"));
			} else {
				$id = $this->uri->segment(5);
				$this->session->set_flashdata('success', 'successfully added video in anime..');
				redirect(base_url("admin/anime/video/$id"));
			}
		} else {
			$id = $this->uri->segment(5);
			$data = [
				'title' => 'New Video',
				'row' => $this->db->get_where('anime_list', ['id' => $id])->row()
			];
			backEnd_view('anime/video_create', $data);
		}
	}

	public function video_list()
	{
		$id = $this->uri->segment(4);
		$data = [
			'title' => 'List Anime',
			'content' => $this->db->get_where('anime_video', ['id_anime' => $id])->result(),
			'row' => $this->db->get_where('anime_list', ['id' => $id])->row()
		];
		backEnd_view('anime/video_list', $data);
	}

	public function video_edit()
	{
		$id = $this->uri->segment(5);
		$id_video = $this->uri->segment(6);
		if ($this->input->post()) {
			$id_anime = $id;
			$type = $this->input->post('type');
			$videos = $this->input->post('videos');
			$downloads = $this->input->post('downloads');
			$temp = '';
			foreach ($videos as $c) {
				if ($temp == '') {
					$temp = $c;
				} else {
					$temp = "$temp{{==}}$c";
				}
			}
			$videos = $temp;
			$temp = '';
			foreach ($downloads as $c) {
				if ($temp == '') {
					$temp = $c;
				} else {
					$temp = "$temp{{==}}$c";
				}
			}
			$downloads = $temp;
			if ($type == 'series') {
				$series = $this->input->post('series');
			} else {
				$series = '';
			}
			$this->db->update('anime_video', [
				'id_anime' => $id_anime,
				'type' => $type,
				'eps' => $series,
				'video' => $videos,
				'download' => $downloads,
				'created_at' => date("Y-m-d h:i:sa")
			], ['id' => $id_video]);
			$this->session->set_flashdata('success', 'successfully update video in anime..');
			redirect(base_url("admin/anime/video/$id"));
		} else {
			$data = [
				'title' => 'Edit Video',
				'row' => $this->db->get_where('anime_list', ['id' => $id])->row(),
				'rws' => $this->db->get_where('anime_video', ['id' => $id_video])->row()
			];
			backEnd_view('anime/video_edit', $data);
		}
	}

	public function video_delete()
	{
		$id = $this->uri->segment(5);
		$id_video = $this->uri->segment(6);
		$this->db->delete('anime_video', ['id' => $id_video]);
		$this->session->set_flashdata('success', 'Video was successfully Delete.');
		redirect(base_url("admin/anime/video/$id"));
	}

	public function type_list()
	{
		if ($this->input->post()) {
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			$this->db->insert('anime_type', [
				'title' => $title,
				'seo_slug' => sluggenerate($slug),
				'created_at' => date("Y-m-d h:i:sa")
			]);
			$this->session->set_flashdata('success', 'Type was successfully added.');
			redirect(base_url("admin/anime/type"));
		} else {
			$data = [
				'title' => 'Type Anime',
				'content' => $this->db->get('anime_type')->result()
			];
			backEnd_view('anime/type', $data);
		}
	}

	public function type_edit()
	{
		if ($this->input->post()) {
			$id = $this->input->post('id');
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			$this->db->update('anime_type', [
				'title' => $title,
				'seo_slug' => sluggenerate($slug),
				'created_at' => date("Y-m-d h:i:sa")
			], ['id' => $id]);
			$this->session->set_flashdata('success', 'Type was successfully Update.');
			redirect(base_url("admin/anime/type"));
		} else {
			$id = $this->uri->segment(5);
			$get = $this->db->get_where('anime_type', ['id' => $id])->row();
			$data[] = [
				'id' => $get->id,
				'title' => $get->title,
				'slug' => sluggenerate($get->seo_slug)
			];
			echo json_encode($data);
		}
	}

	public function type_delete()
	{
		$id = $this->uri->segment(5);
		$this->db->delete('anime_type', ['id' => $id]);
		$this->session->set_flashdata('success', 'Type was successfully Delete.');
		redirect(base_url("admin/anime/type"));
	}

	public function genre_list()
	{
		if ($this->input->post()) {
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			$this->db->insert('anime_genre', [
				'title' => $title,
				'seo_slug' => sluggenerate($slug),
				'created_at' => date("Y-m-d h:i:sa")
			]);
			$this->session->set_flashdata('success', 'Genre was successfully added.');
			redirect(base_url("admin/anime/genre"));
		} else {
			$data = [
				'title' => 'Genre Anime',
				'content' => $this->db->get('anime_genre')->result()
			];
			backEnd_view('anime/genre', $data);
		}
	}

	public function genre_edit()
	{
		if ($this->input->post()) {
			$id = $this->input->post('id');
			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			$this->db->update('anime_genre', [
				'title' => $title,
				'seo_slug' => sluggenerate($slug),
				'created_at' => date("Y-m-d h:i:sa")
			], ['id' => $id]);
			$this->session->set_flashdata('success', 'Genre was successfully Update.');
			redirect(base_url("admin/anime/genre"));
		} else {
			$id = $this->uri->segment(5);
			$get = $this->db->get_where('anime_genre', ['id' => $id])->row();
			$data[] = [
				'id' => $get->id,
				'title' => $get->title,
				'slug' => sluggenerate($get->seo_slug)
			];
			echo json_encode($data);
		}
	}

	public function genre_delete()
	{
		$id = $this->uri->segment(5);
		$this->db->delete('anime_genre', ['id' => $id]);
		$this->session->set_flashdata('success', 'Genre was successfully Delete.');
		redirect(base_url("admin/anime/genre"));
	}
}
