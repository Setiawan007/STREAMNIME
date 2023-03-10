<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller Admin/Storage
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Storage extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		cek_login();
	}

	public function index()
	{
		$this->load->helper("file");
		$path = urldecode($this->uri->segment(3));
		if ($path == 'root') {
			$path = "";
			$oripath = "";
		} else {
			$oripath = "$path---";
			$path = str_replace("---", "/", $path);
		}
		$data['oripath'] = rtrim($oripath, '/');
		$data['path'] = rtrim($path, '/') . "/";
		$data['scan'] = array_diff(scandir("./public/storage/$path"), array('.', '..'));
		$this->load->view('backend/storage', $data);
	}

	public function cmd()
	{
		$cmd = $_GET['cmd'];
		if (isset($cmd)) {
			switch ($cmd) {
				case 'mfolder':
					$name = $this->input->post('folder');
					$path = str_replace("---", "/", $_GET['path']);
					if (isset($name)) {
						if (!is_dir("./public/storage/$path/$name")) {
							mkdir("./public/storage/$path/$name", 0777, TRUE);
						}
					}
					break;
				case 'delfolder':
					$name = urldecode($_GET['name']);
					if (isset($name)) {
						$path = str_replace("---", "/", $name);
						if (is_dir("./public/storage/$path/")) {
							$delall = array_diff(scandir("./public/storage/$path/"), array('.', '..'));
							foreach ($delall as $dl) {
								rmdir("./public/storage/$path/$dl");
								unlink("./public/storage/$path/$dl");
							}
							rmdir("./public/storage/$path");
						}
					}
					break;
				case 'delfile':
					$name = urldecode($_GET['name']);
					if (isset($name)) {
						$path = str_replace("---", "/", $name);
						unlink("./public/storage/$path");
					}
					break;
				default:
					# code...
					break;
			}
		} else {
			echo '404';
		}
	}

	public function upload()
	{
		if (!empty($_FILES)) {
			$path = str_replace("---", "/", $_GET['path']);
			if (!is_dir("./public/storage/$path/")) {
				mkdir("./public/storage/$path/", 0777, TRUE);
			}
			$config["upload_path"] = "./public/storage/$path/";
			$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload("file")) {
				echo "failed to upload file(s)";
			}
		}
	}

	public function manager()
	{
		$data = [
			'title' => 'File Manager'
		];
		backEnd_view('files', $data);
	}

	public function image()
	{
		if (isset($_GET['name'])) {
			$name = htmlspecialchars(str_replace("'", "", $_GET['name']));
			$remoteImage = "" . base_url("public/storage/$name") . "";
			$imginfo = getimagesize($remoteImage);
			header("Content-type: {$imginfo['mime']}");
			readfile($remoteImage);
		}
	}
}
