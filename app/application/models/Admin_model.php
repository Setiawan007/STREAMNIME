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

class Admin_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------


	// ------------------------------------------------------------------------
	public function update_websettings($title, $description, $keywords, $facebook, $twitter, $linkedin, $instagram, $whatsapp, $youtube, $github, $site_logo, $favicon, $thumbnail, $showathome, $main, $perpage)
	{
		$this->db->update("websettings", [
			'seo_title' => $title,
			'seo_description' => $description,
			'seo_keywords' => $keywords,
			'site_logo' => $site_logo,
			'seo_favicon' => $favicon,
			'seo_thumbnail' => $thumbnail,
			'social_facebook' => $facebook,
			'social_twitter' => $twitter,
			'social_linkedin' => $linkedin,
			'social_instagram' => $instagram,
			'social_whatsapp' => $whatsapp,
			'social_youtube' => $youtube,
			'social_github' => $github,
			'showathome' => $showathome,
			'content_perpage' => $perpage,
			'maintenance' =>  $main
		], ['id' => 1]);
	}

	public function get_menus()
	{
		return $this->db->query('SELECT * FROM site_menus WHERE type != "submenu"')->result();
	}

	// ------------------------------------------------------------------------

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */
