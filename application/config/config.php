<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$request_type = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'?'https://':'http://';

$config['base_url'] = $request_type.$_SERVER['HTTP_HOST'].'/';

define('WEBSITE_TITLE', 'Food 101');
define('FRONT_WEBSITE_SUFFIX', 'Order Food in just 101');
define('ASSET_URL', $config['base_url'].'public/');
define('ADMIN_ASSET_URL', $config['base_url'].'admin_assets/');
define('IMG_UPLOAD_LOCATION', APPPATH.'../public/images/');

$config['index_page'] = 'index.php';
$config['uri_protocol']	= 'REQUEST_URI';
$config['url_suffix'] = '';
$config['language']	= 'english';
$config['charset'] = 'UTF-8';
$config['enable_hooks'] = FALSE;
$config['subclass_prefix'] = 'MY_';
$config['composer_autoload'] = FALSE;
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';
$config['allow_get_array'] = TRUE;
$config['log_threshold'] = 1;
$config['log_path'] = '';
$config['log_file_extension'] = '';
$config['log_file_permissions'] = 0644;
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['error_views_path'] = '';
$config['cache_path'] = '';
$config['cache_query_string'] = FALSE;
$config['encryption_key'] = '';
$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = NULL;
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;
$config['cookie_prefix']	= '';
$config['cookie_domain']	= '';
$config['cookie_path']		= '/';
$config['cookie_secure']	= FALSE;
$config['cookie_httponly'] 	= FALSE;
$config['standardize_newlines'] = FALSE;
$config['global_xss_filtering'] = TRUE;
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;
$config['csrf_exclude_uris'] = array();
$config['compress_output'] = FALSE;
$config['time_reference'] = 'local';
$config['rewrite_short_tags'] = FALSE;
$config['proxy_ips'] = '';

// custom configs
$config['series_img_upload'] = [
	'max_size' => '700',
	'upload_path' => IMG_UPLOAD_LOCATION.'series/',
	'allowed_types' => 'jpg|png|webp',
	'encrypt_name' => false
];

$config['pagination_setting'] = [
	'per_page' => 20,
	'num_links' => 2,
	'use_page_numbers' => TRUE,
	'reuse_query_string' => TRUE,
	'full_tag_open' => '<ul class="wn__pagination">',
	'full_tag_close' => '</ul>',
	'num_tag_open' => '<li>',
	'prev_tag_open' => '<li>',
	'next_tag_open' => '<li>',
	'num_tag_close' => '</li>',
	'next_tag_close' => '</li>',
	'prev_tag_close' => '</li>',
	'cur_tag_open' => '<li class="active"><a href="javascript:void(0)">',
	'cur_tag_close' => '</a></li>'
];