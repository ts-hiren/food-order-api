<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function AdminAuthenticator(){
	$CI =& get_instance();
	$adminData = $CI->session->userdata('auth_admin_data');
	// $userData = $CI->session->userdata('auth_user_data');
	if (!is_array($adminData) || $adminData['role'] != 'admin') {
		redirect(base_url('login'));
	}
}
function my_404()
{
	$CI =& get_instance();
	$layoutData['page'] = 'pages/404';
	$layoutData['pageTitle'] = 'Opps.. Page Not Found';
	$layoutData['pageData'] = [];
	echo $CI->load->view('layout',$layoutData,true);
	exit();
}