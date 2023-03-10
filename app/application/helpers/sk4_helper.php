<?php

//base url
function _backEnd($part = null)
{
	return base_url("public/assets/backend/$part");
}
function _frontEnd($theme)
{
	return base_url("theme/frontend/$theme/assets/");
}

function _storage($part = null)
{
	return base_url("public/storage/$part");
}

//view landing page


function backEnd_content($view)
{
	$ci = &get_instance();
	$ci->load->view("backend/$view");
}

function backEnd_view($view, $data = [])
{
	$ci = &get_instance();
	$data['sk4content'] = $view;
	$data['akun'] = $ci->db->get_where('users', ['id' => $ci->session->userdata('id_login')])->row();
	$data['count_req'] = $ci->db->get_where('request', ['status' => 0])->num_rows();
	$ci->load->view('backend/index', $data);
}

function frontEnd_view($view, $data = [])
{
	$ci = &get_instance();
	$websetinggs = $ci->db->get_where('websettings', ['id' => 1])->row();
	if ($websetinggs->maintenance == 'on') {
		redirect(base_url("maintenance"));
		exit;
	}
	$data['menus'] = $ci->db->get_where('site_menus', ['status' => 1])->result();
	$data['webmaster'] = $ci->db->get_where('webmaster', ['id' => 1])->row();
	$data['websettings'] = $websetinggs;
	$getcusomt = file_get_contents("./theme/frontend/$websetinggs->theme_active/assets/sys/custom.json");
	$getcustom = json_decode($getcusomt, TRUE);
	$data['custom_theme'] = $getcustom[0];
	$ci->load->view("frontend/$websetinggs->theme_active/" . $view, $data);
}
// functtion Other

function _POST($par)
{
	$ci = &get_instance();
	$par = $ci->input->post($par);
	$par = htmlspecialchars($par);
	$par = str_replace("'", "", $par);
	return $par;
}

function uploadimg($par = [])
{
	$ci = &get_instance();
	if (!is_dir("./public/storage/$par[path]/")) {
		mkdir("./public/storage/$par[path]/", 0777, TRUE);
	}
	$ci->load->library('upload');
	$config['upload_path'] = "./public/storage/$par[path]/";
	$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
	$config['encrypt_name'] = TRUE;
	$ci->upload->initialize($config);
	if (!empty($_FILES["$par[name]"]['name'])) {
		if ($ci->upload->do_upload("$par[name]")) {
			$img = $ci->upload->data();
			if ($par['compress'] == true) {
				$config['image_library'] = 'gd2';
				$config['source_image'] = "./public/storage/$par[path]/" . $img['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['quality'] = FALSE;
				$config['width'] = $par['width'];
				$config['height'] = $par['height'];
				$config['new_image'] = "./public/storage/thumbnails/" . $img['file_name'];
				$ci->load->library('image_lib', $config);
				$ci->image_lib->resize();
			}
			$image = $img['file_name'];
			return array('result' => 'success', 'nama_file' => $image, 'error' => '');
		} else {
			return array('result' => 'error', 'file' => '', 'error' => $ci->upload->display_errors());
		}
	} else {
		return array('result' => 'noimg');
	}
}

function sluggenerate($text, string $divider = '-')
{
	// replace non letter or digits by divider
	$text = preg_replace('~[^\pL\d]+~u', $divider, $text);

	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	// trim
	$text = trim($text, $divider);

	// remove duplicate divider
	$text = preg_replace('~-+~', $divider, $text);

	// lowercase
	$text = strtolower($text);

	if (empty($text)) {
		return 'n-a';
	}

	return $text;
}

function _getSlug($par)
{
	$ci = &get_instance();
	$string = $ci->uri->segment($par);
	$string = htmlspecialchars($string);
	$string = str_replace('.', '', $string);
	$string = urldecode($string);
	return $string;
}

function _getbox($get)
{
	$ci = &get_instance();
	$get = $ci->input->post($get);
	if ($get == 'on') {
		return 1;
	} else {
		return 0;
	}
}

function cek_login($cekcoke = false)
{
	$ci = &get_instance();
	if ($ci->session->userdata('status_login')) {
		if ($cekcoke == true) {
			$ci->session->set_flashdata("success", "Welcome Back.");
			redirect(base_url("admin"));
		}
	} else {
		if (isset($_COOKIE['sk4']) && isset($_COOKIE['token'])) {
			$id_users = $_COOKIE['sk4'];
			$password = $_COOKIE['token'];
			$query = $ci->db->get_where("users", array('id' => $id_users));
			if ($query->num_rows() == 1) {
				$row = $query->row();
				if ($password == hash('ripemd160', $row->password)) {
					$ci->session->set_userdata(array('status_login' => true, 'id_login' => $row->id, 'role_login' => $row->role));
					if ($cekcoke == true) {
						$ci->session->set_flashdata("success", "Welcome Back.");
						redirect(base_url("admin"));
					}
				} else {
					unset($_COOKIE['token']);
					unset($_COOKIE['sk4']);
					setcookie('sk4', NULL, -1, '/');
					setcookie('token', NULL, -1, '/');
					redirect(base_url("admin/auth/login"));
				}
			}
		} else {
			if ($cekcoke == false) {
				$ci->session->set_flashdata("error", "You must login first.");
				redirect(base_url("admin/auth/login"));
			}
		}
	}
}

function _menus($type, $link)
{
	if ($type == 'direct' || $type == 'submenu') {
		return base_url($link);
	} else {
		return 'javascript:void(0)';
	}
}

function filter_link($link)
{
	return str_replace("/image?name=", base_url("public/storage/"), $link);
}

function meta_tag($par = [])
{
	return '<title>' . $par['title'] . '</title>
	<meta name="robots" content="follow, index"/>
	<meta name="keywords" content="' . $par['keywords'] . '" />
	<link rel="shortcut icon" href="' . $par['favicon'] . '">
	<meta content="' . $par['description'] . '" name="description" />
	<meta content="' . $par['author'] . '" name="author" />
	<link rel="canonical" href="' . $par['url'] . '" />
	<meta property="og:locale" content="en_US" />
	<meta property="bb:client_area" content="' . $par['url'] . '">
	<meta property="og:url" content="' . $par['url'] . '" />
	<meta property="og:title" content="' . $par['title'] . '" />
	<meta property="og:image" content="' . $par['thumb'] . '" />
	<meta property="og:site_name" content="' . $par['title'] . '" />
	<meta property="og:type" content="website" />
	<meta property="og:description" content="' . $par['description'] . '" />
	<meta name="twitter:description" content="' . $par['description'] . '" />
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:site" content="@' . $par['title'] . '" />
	<meta name="twitter:title" content="' . $par['title'] . '" />
	<meta name="twitter:image" content="' . $par['thumb'] . '" />';
}


function re_url($urls, $path = '')
{
	$ci = &get_instance();
	$urls = base_url($urls);
	if ($path == '') {
		$url = base_url("$_SERVER[REQUEST_URI]");
	} else {
		$url = base_url($path);
	}

	$ci->session->set_userdata(array('sk4_url' => $url));
	return "$urls";
}

function _rupiah($angka)
{
	$hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
	return $hasil_rupiah;
}

function hit_visit($page, $by = 0)
{
	$ci = &get_instance();
	$ip = $ci->input->ip_address();
	if ($ci->db->get_where('sk_stats', ['by_page' => $page, 'by_id' => $by, 'ip' => $ip])->num_rows() == 0) {
		$ci->db->insert('sk_stats', [
			'by_page' => $page,
			'by_id' => $by,
			'ip' => $ip,
			'created_at' => date("Y-m-d h:i:sa")
		]);
	}
}

function count_visitor($page, $by = 0)
{
	$ci = &get_instance();
	return $ci->db->get_where('sk_stats', ['by_page' => $page, 'by_id' => $by])->num_rows();
}

function animextype($type)
{
	if ($type == 'sedang') {
		return 'Sedang Tayang <i class="las la-fire-alt" style="font-size: 14px; padding-top: 2px; padding-left: 5px"></i>';
	} else if ($type == 'selesai') {
		return 'Selesai Tayang <i class="las la-check" style="font-size: 14px; padding-top: 0px; padding-left: 5px"></i>';
	} else if ($type == 'segera') {
		return 'Segera Tayang <i class="las la-hourglass-half" style="font-size: 14px; padding-top: 3px; padding-left: 5px	"></i>';
	}
}
