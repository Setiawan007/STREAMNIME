<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Front_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------


	public function new_eps($limit)
	{
		$this->db->select('anime_video.*,anime_list.title,anime_list.thumb,anime_list.seo_slug,anime_type.title as type_title');
		$this->db->from('anime_video');
		$this->db->join('anime_list', 'anime_list.id = anime_video.id_anime');
		$this->db->join('anime_type', 'anime_type.id = anime_list.type');
		$this->db->where('anime_list.status', 'sedang');
		$this->db->order_by('anime_video.id', 'DESC');
		$this->db->limit($limit);
		return $this->db->get();
	}

	public function sedang_tayang($limit)
	{
		$this->db->select('anime_list.*,anime_type.title as type_title');
		$this->db->from('anime_list');
		$this->db->join('anime_type', 'anime_type.id = anime_list.type');
		$this->db->where('anime_list.status', 'sedang');
		$this->db->order_by('updated_at', 'DESC');
		$this->db->limit($limit);
		return $this->db->get();
	}

	public function just_added($limit)
	{
		$this->db->select('anime_list.*,anime_type.title as type_title');
		$this->db->from('anime_list');
		// $this->db->join('anime_list', 'anime_list.id = anime_video.id_anime');
		$this->db->join('anime_type', 'anime_type.id = anime_list.type');
		// $this->db->order_by('anime_video.eps', 'DESC');
		$this->db->order_by('anime_list.created_at', 'DESC');
		$this->db->limit($limit);
		return $this->db->get();
	}

	public function topnime($limit)
	{
		$this->db->select('anime_list.*, COUNT(DISTINCT sk_stats.id) AS visitor, sk_stats.by_page');
		$this->db->from('anime_list');
		$this->db->join('sk_stats', 'sk_stats.by_id = anime_list.id', 'left');
		$this->db->where('sk_stats.by_page', 'anime_list');
		$this->db->group_by('anime_list.id');
		$this->db->order_by('visitor', 'DESC');
		$this->db->limit($limit);
		return $this->db->get();
	}

	public function getAnime($limit, $start, $type, $genre, $status, $sort, $search)
	{
		$this->db->select('anime_list.*,anime_type.title as type_title');
		$this->db->from('anime_list');
		$this->db->join('anime_type', 'anime_type.id = anime_list.type');
		if ($type != '') {
			$this->db->where('anime_list.type', $type);
		}
		if ($status != '') {
			$this->db->where('anime_list.status', $status);
		}
		if ($genre != '') {
			$this->db->like('anime_list.genre', $genre);
		}
		if ($search != '') {
			$this->db->like('anime_list.title', $search);
		}
		if ($sort != '') {
			if ($sort == 'baru') {
				$this->db->order_by('anime_list.id', 'DESC');
			} else if ($sort == 'a') {
				$this->db->order_by('anime_list.title', 'ASC');
			} else if ($sort == 'z') {
				$this->db->order_by('anime_list.title', 'DESC');
			}
		}
		$this->db->limit($limit, $start);
		return $this->db->get();
	}

	public function AnimeCount($type, $genre, $status, $sort, $search)
	{
		$this->db->select('anime_list.*,anime_type.title as type_title');
		$this->db->from('anime_list');
		$this->db->join('anime_type', 'anime_type.id = anime_list.type');
		if ($type != '') {
			$this->db->where('anime_list.type', $type);
		}
		if ($status != '') {
			$this->db->where('anime_list.status', $status);
		}
		if ($genre != '') {
			$this->db->like('anime_list.genre', $genre);
		}
		if ($search != '') {
			$this->db->like('anime_list.title', $search);
		}
		if ($sort != '') {
			if ($sort == 'baru') {
				$this->db->order_by('anime_list.id', 'DESC');
			} else if ($sort == 'a') {
				$this->db->order_by('anime_list.title', 'ASC');
			} else if ($sort == 'z') {
				$this->db->order_by('anime_list.title', 'DESC');
			}
		}
		return $this->db->get();
	}
}

/* End of file Front_model.php */
/* Location: ./application/models/Front_model.php */
