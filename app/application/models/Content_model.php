<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Content_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------


	// ------------------------------------------------------------------------
	public function get_all($type)
	{
		$this->db->select('content_item.*,users.name');
		$this->db->from('content_item');
		$this->db->where('type', $type);
		$this->db->join('users', 'users.id = content_item.author');
		return $this->db->get();
	}

	public function insert($record = [])
	{
		$this->db->insert('content_item', $record);
	}

	public function update($record = [], $id)
	{
		$this->db->update('content_item', $record, ['id' => $id]);
	}

	public function get_id($slug)
	{
		$this->db->select('id,seo_slug');
		$this->db->from('content_item');
		$this->db->where('seo_slug', $slug);
		$this->db->limit(1);
		$query = $this->db->get()->row();
		return $query->id;
	}

	public function category_type($id)
	{
		$this->db->select('*');
		$this->db->from('content_category');
		$this->db->where('c_type', $id);
		return $this->db->get()->result();
	}

	// ------------------------------------------------------------------------

}

/* End of file Content_model.php */
/* Location: ./application/models/Content_model.php */
