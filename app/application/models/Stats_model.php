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

class Stats_model extends CI_Model
{

	// ------------------------------------------------------------------------

	public function __construct()
	{
		parent::__construct();
	}

	// ------------------------------------------------------------------------


	// ------------------------------------------------------------------------

	public function countAll_by($page)
	{
		return $this->db->get_where('sk_stats', ['by_page' => $page]);
	}

	public function countMonth_byPage($page, $datenow = '')
	{
		$stats = array();
		if ($datenow == '') {
			$datenow = date('Y');
		} else {
			$datenow = $datenow;
		}
		for ($i = 1; $i <= 12; $i++) {
			$count = $this->db->query("SELECT * FROM sk_stats WHERE YEAR(created_at) = $datenow AND MONTH(created_at) = $i AND by_page='$page'")->num_rows();
			$stats[$i] = $count;
		}
		return $stats;
	}

	public function countDays_byPage($page, $year = '', $month = '')
	{
		if ($year == '' && $month == '') {
			$year = date("Y");
			$month = date("m");
		} else {
			$year = $year;
			$month = $month;
		}
		$data = '';
		$dates = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		for ($i = 1; $i < $dates + 1; $i++) {
			$count = $this->db->query("SELECT * FROM sk_stats WHERE YEAR(created_at) = $year AND MONTH(created_at) = $month AND DAY(created_at) = $i AND by_page='$page'")->num_rows();
			$data = "$data,$count";
		}
		return ltrim($data, ',');
	}

	// ------------------------------------------------------------------------

}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */
