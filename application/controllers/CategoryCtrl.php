<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryCtrl extends CI_Controller {
	function __construct() {
        parent::__construct();
        AdminAuthenticator();
    }
	public function index()
	{

		$layoutData['page'] = 'category/category';
		$layoutData['pageTitle'] = 'Manage Categories - '.WEBSITE_TITLE;
		$layoutData['pageData'] = array();
		$this->load->view('layout',$layoutData);
	}
	public function show($id = '')
	{
		$data = [];
		if ($id != '' && $id != 0) {
			$this->load->model('CommonModel');
			$data['record'] = $this->CommonModel->getSingleData(['category_id' => $id],'category_mst');
		}
		$this->load->view('category/category_form',$data);
	}
	public function store()
	{
		$this->load->model('CommonModel');
		$categoryData = [];
		$categoryData['category_name'] = trim($this->input->post('category_name',TRUE));
		$categoryData['paramlink'] = trim($this->input->post('paramlink',TRUE));
		if (in_array('', $categoryData)) {
			echo json_encode([
				"status" => "fail",
				"msg" => "Category Name or Link can not be empty!"
			]);
			exit();
		}
		$categoryData['description'] = trim($this->input->post('description',TRUE));
		$categoryData['meta_title'] = trim($this->input->post('meta_title',TRUE));
		$categoryData['meta_description'] = trim($this->input->post('meta_description',TRUE));
		$categoryData['meta_keywords'] = trim($this->input->post('meta_keywords',TRUE));
		$id = trim($this->input->post('hdnID',TRUE));
		if ($id != '') {
			$categoryCondition['category_id'] = $id;
			$result = $this->CommonModel->updateData($categoryCondition,$categoryData,'category_mst');
		}else{
			$result = $this->CommonModel->InsertData($categoryData,'category_mst');
			$id = $this->db->insert_id();
		}
		if ($result) {
			echo json_encode([
				"status" => "success",
				"msg" => "Category Saved!",
				"data" => [
					'id' => $id,
					'value' => $categoryData['category_name']
				]
			]);
			exit();
		}else{
			echo json_encode([
				"status" => "fail",
				"msg" => "Something Went wrong!"
			]);
			exit();
		}
	}
	public function check() {
		$this->load->model('CommonModel');
		$id = $this->input->post('hdnID',TRUE) ? $this->input->post('hdnID',TRUE) : 0;
		$name = $this->input->post('category_name',TRUE);
		$link = $this->input->post('paramlink',TRUE);
		if ($name == '' && $link == '') {
			echo json_encode([
				"status" => "fail",
				"msg" => "Empty Data!"
			]);
			exit();
		}
		if ($name != '') {
			$checkCategory['category_id <>'] = $id;
			$checkCategory['category_name'] = $name;
			$count = $this->CommonModel->getDataCount($checkCategory,'category_mst');
			if ($count > 0) {
				echo json_encode([
					"status" => "fail",
					"msg" => "Duplicate Category Name!"
				]);
				exit();
			}
			$checkCategory = [];
			$checkCategory['category_id <>'] = $id;
			$checkCategory['paramlink'] = url_title($name,'-',TRUE);
		}
		if ($link != '') {
			$checkCategory['category_id <>'] = $id;
			$checkCategory['paramlink'] = url_title($link,'-',TRUE);
		}
		$count = $this->CommonModel->getDataCount($checkCategory,'category_mst');
		if ($count == 0) {
			echo json_encode([
				"status" => "success",
				"link" => $checkCategory['paramlink']
			]);
			exit();
		}else{
			echo json_encode([
				"status" => "fail",
				"msg" => "Duplicate paramlink!"
			]);
			exit();
		}
	}
	public function list()
	{
		$draw = intval($this->input->get('draw',true));
		$this->load->model('CommonModel');
		$this->load->helper('datatable');
		$data = datatable($this->input->get());
		$data['table'] = 'category_mst';
		$data['select'] = 'category_id,category_name,status,paramlink';
		$data['condition']['category_id <>'] = $condition['category_id <>'] = 0;
		$recordTotal = $this->CommonModel->getDataCount($condition,'category_mst');
		$records = $this->CommonModel->datatableQueryBuilder($data,'array');
		$filteredRecords = $this->CommonModel->datatableQueryBuilder($data,'count');
		$records = array_map(function($record){
			$status = $record['status'] == 'active' ? 'checked' : '';
			$id = $record['category_id'];
			$record['status'] = "<input type='checkbox' class='status-switch' $status data-id='$id' data-fouc>";
			$record['action'] = "
				<a href='javascript:void(0)' onclick='openModal(`Update Category`,`".base_url("/category/$id")."`,`lg`)' title='Edit'><i class='text-info icon-pencil7'></i></a>
				<a href='javascript:void(0)' onclick='deleteCategory(`$id`)' title='Delete'><i class='text-danger icon-eraser2'></i></a>
			";
			return $record;
		}, $records);
		$result = [
			'draw' => $draw,
			'recordsTotal' => $recordTotal,
			'recordsFiltered' => $filteredRecords,
			'data' => $records
		];
		echo json_encode($result);
		exit();
	}
	public function toggle()
	{
		$this->load->model('CommonModel');
		if ($this->input->post('delete_id',TRUE)) {
			$id = $this->input->post('delete_id',TRUE);
			$delete = $this->CommonModel->deleteData(['category_id' => $id],'category_mst');
			if ($delete) {
				echo json_encode([
					'status' => 'success',
					'msg' => 'Category deleted Successfully!',
					'title' => 'Deleted!'
				]);
			} else {
				echo json_encode([
					'status' => 'error',
					'msg' => 'Something Went Wrong!',
					'title' => 'Oops...'
				]);
			}
		} else {
			$id = $this->input->post('id',TRUE) ? $this->input->post('id',TRUE) : 0;
			$status = $this->input->post('status',TRUE) == 'true' ? 'active' : 'inactive';
			$result = $this->CommonModel->updateData(['category_id'=>$id],['status'=>$status],'category_mst');
			if ($result) {
				echo json_encode([
					'status' => true,
					'msg' => 'Data updated Successfully!'
				]);
			} else {
				echo json_encode([
					'status' => false,
					'msg' => 'Something Went Wrong!'
				]);
			}
		}
	}
}
