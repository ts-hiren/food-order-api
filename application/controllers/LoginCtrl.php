<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginCtrl extends CI_Controller {
	function __construct() {
        parent::__construct();
    }
	public function login()
	{
		$data = array();
		if ($this->input->post('username')) {
			$creds['username'] = $this->input->post('username',TRUE);
			$this->load->model('CommonModel');
			$user_info = $this->CommonModel->getSingleData($creds,'user_mst');
			if (!empty($user_info) && count($user_info)) {
				if ($user_info['password'] == sha1($this->input->post('password',TRUE))) {
					$user_info['role'] = $this->CommonModel->getSingleData(['role_id'=> $user_info['role']],'role_mst')['role_name'];
					$this->session->set_userdata('auth_admin_data',$user_info);
					$this->session->set_userdata('auth_user_data',$user_info);
					$this->session->set_flashdata('success_msg','Successfully Logged in!');
					redirect(base_url(''));
				}else{
					$data['errMsg'] = 'Invalid Username/Password!';
				}
			}else{
				$data['errMsg'] = 'Invalid Username/Password!';
			}
		}
		$this->load->view('login',$data);
	}
	public function logout()
	{
		$this->session->unset_userdata('auth_admin_data');
		$this->session->unset_userdata('auth_user_data');
		redirect(base_url(''));
	}
}
