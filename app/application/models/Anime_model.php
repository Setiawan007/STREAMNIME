<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Admin_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Anime_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}


	public function get_new()
	{
		$this->db->select('anime_list.*,users.name,anime_type.title as title_type');
		$this->db->from('anime_list');
		$this->db->join('users', 'users.id = anime_list.uploader');
		$this->db->join('anime_type', 'anime_type.id = anime_list.type');
		$this->db->order_by('users.id', 'DESC');
		return $this->db->get();
	}

	// ------------------------------------------------------------------------

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */
