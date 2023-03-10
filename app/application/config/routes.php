<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'anime/index';
$route['404_override'] = '';
$route['maintenance'] = 'home/maintenance';
$route['translate_uri_dashes'] = FALSE;

//ADMIn routes
$route['admin'] = 'admin/home/index';
$route['admin/storage/upload'] = 'admin/storage/upload';
$route['admin/storage/(:any)'] = 'admin/storage';
$route['admin/storage'] = 'admin/storage/cmd';
$route['admin/files'] = 'admin/storage/manager';

//-----------------auth-------------------
$route['admin/auth/login'] = 'admin/auth/index';
$route['admin/auth/logout'] = 'admin/auth/logout';

//-----------------anime-------------------

$route['admin/anime'] = "admin/anime/index";
$route['admin/anime/create'] = "admin/anime/create";
$route['admin/anime/edit/(:num)'] = "admin/anime/edit";
$route['admin/anime/delete/(:num)'] = "admin/anime/delete";

$route['admin/anime/video/(:num)'] = "admin/anime/video_list";
$route['admin/anime/video/add'] = "admin/anime/video_add";
$route['admin/anime/video/add/(:num)'] = "admin/anime/video_add";
$route['admin/anime/video/edit/(:num)/(:num)'] = "admin/anime/video_edit";
$route['admin/anime/video/delete/(:num)/(:num)'] = "admin/anime/video_delete";

$route['admin/anime/type'] = "admin/anime/type_list";
$route['admin/anime/type/edit'] = "admin/anime/type_edit";
$route['admin/anime/type/edit/(:num)'] = "admin/anime/type_edit";
$route['admin/anime/type/delete/(:num)'] = "admin/anime/type_delete";

$route['admin/anime/genre'] = "admin/anime/genre_list";
$route['admin/anime/genre/edit'] = "admin/anime/genre_edit";
$route['admin/anime/genre/edit/(:num)'] = "admin/anime/genre_edit";
$route['admin/anime/genre/delete/(:num)'] = "admin/anime/genre_delete";

//-----------------req-------------------

$route['admin/request/view/(:num)'] = "admin/request/view";
$route['admin/request/delete/(:num)'] = "admin/request/delete";

//----------------webmaster-------------------
$route['admin/webmaster'] = 'admin/webmaster/index';
$route['admin/webmaster/sitec'] = 'admin/webmaster/site_list';
$route['admin/webmaster/sitec/create'] = 'admin/webmaster/site_create';
$route['admin/webmaster/sitec/edit/(:num)'] = 'admin/webmaster/site_edit';
$route['admin/webmaster/sitec/delete/(:num)'] = 'admin/webmaster/site_delete';

//----------------Websettings------------------
$route['admin/websettings'] = 'admin/websettings/index';
$route['admin/websettings/menus'] = 'admin/websettings/menus_list';
$route['admin/websettings/menus_edit/(:num)'] = 'admin/websettings/menus_edit';
$route['admin/websettings/menus_delete/(:num)'] = 'admin/websettings/menus_delete';
$route['admin/websettings/menus/sub/(:num)'] = 'admin/websettings/submenu';
$route['admin/websettings/menus/sub/(:num)/edit/(:num)'] = 'admin/websettings/submenu_edit';
$route['admin/websettings/menus/sub/(:num)/delete/(:num)'] = 'admin/websettings/submenu_delete';


//-----------------Users Manager-----------------
$route['admin/users'] = 'admin/users/index';
$route['admin/users/create'] = 'admin/users/create';
$route['admin/users/edit/(:num)'] = 'admin/users/users_edit';
$route['admin/users/delete/(:num)'] = 'admin/users/users_delete';

//------------------Site Page--------------------
$route['admin/pages'] = 'admin/pages/index';
$route['admin/pages/create'] = 'admin/pages/create';
$route['admin/pages/edit/(:num)'] = 'admin/pages/edit';
$route['admin/pages/delete/(:num)'] = 'admin/pages/delete';

$route['admin/themes'] = 'admin/themes/index';
$route['admin/themes/set/(:any)'] = 'admin/themes/set_theme';
$route['admin/themes/custom'] = 'admin/themes/custom';

$route['admin/themes/highlight'] = 'admin/themes/highlight';
$route['admin/themes/highlight/(:any)'] = 'admin/themes/highlight_preview';

$route['admin/subscriber'] = 'admin/subscriber/index';
$route['admin/subscriber/delete/(:num)'] = 'admin/subscriber/delete';

$route['admin/icons'] = 'admin/home/icons';


//FrontEnd routes
$route['sitemap.xml'] = 'sitemap/index';
$route['list'] = 'anime/list';
$route['request'] = 'anime/request';
$route['(:any)'] = 'anime/get_slug';
$route['(:any)/(:num)'] = 'anime/get_video';
