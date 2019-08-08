<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeCtrl extends CI_Controller {
	function __construct() {
        parent::__construct();
        AdminAuthenticator();
    }
	public function index()
	{
		$data = array();
		$this->load->model('CommonModel');
		$status = $this->CommonModel->getSingleData(['id <>' => 1], 'user_mst', 'count(*) as count');
		if ($status) {
			$data['user_count'] = $status['count'];
		}
		$status = $this->CommonModel->getSingleData(['book_id <>' => 0], 'book_mst', 'count(*) as count');
		if ($status) {
			$data['book_count'] = $status['count'];
		}
		$status = $this->CommonModel->getSingleData(['series_id <>' => 0], 'series_mst', 'count(*) as count');
		if ($status) {
			$data['series_count'] = $status['count'];
		}
		$status = $this->CommonModel->getSingleData(['author_id <>' => 0], 'author_mst', 'count(*) as count');
		if ($status) {
			$data['author_count'] = $status['count'];
		}
		$layoutData['page'] = 'dashboard/dashboard';
		$layoutData['pageTitle'] = WEBSITE_TITLE.'- Admin Panel';
		$layoutData['pageData'] = $data;
		$this->load->view('layout',$layoutData);
	}
}
