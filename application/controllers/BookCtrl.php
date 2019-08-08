<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BookCtrl extends CI_Controller {
	function __construct() {
        parent::__construct();
        AdminAuthenticator();
    }
	public function index()
	{

		$layoutData['page'] = 'books/books';
		$layoutData['pageTitle'] = WEBSITE_TITLE.'- Admin Panel';
		$layoutData['pageData'] = array();
		$this->load->view('layout',$layoutData);
	}
	public function booksForm($id = '',$copy = '')
	{
		$this->load->model('CommonModel');
		if ($this->input->method() == 'post') {
			$booksData = [];
			$booksData['book_name'] = trim($this->input->post('book_name',TRUE));
			$booksData['paramlink'] = trim($this->input->post('paramlink',TRUE));
			if (in_array('', $booksData)) {
				$data['error_msg'] = 'Book Name or Link can not be empty!';
				goto BookFormJump;
			}
			$booksData['description'] = trim($this->input->post('description',true));
			$booksData['best_seller'] = trim($this->input->post('best_seller',true)) ? 1 : 0;
			$booksData['series_id'] = trim($this->input->post('series_id',TRUE));
			$booksData['series_rank'] = trim($this->input->post('series_rank',TRUE));
			$booksData['search_keywords'] = trim($this->input->post('search_keywords',TRUE));
			$booksData['meta_title'] = trim($this->input->post('meta_title',TRUE));
			$booksData['meta_description'] = trim($this->input->post('meta_description',TRUE));
			$booksData['meta_keywords'] = trim($this->input->post('meta_keywords',TRUE));
			$hdnId = trim($this->input->post('hdnID',TRUE));
			if (!empty($_FILES['image']['name']) || $hdnId == '') {
				$this->load->library('upload',$this->config->item('book_img_upload'));
				if ($this->upload->do_upload('image')) {
					$booksData['image'] = $this->upload->data('file_name');
				}else{
					$data['error_msg'] = $this->upload->display_errors('','');
					goto BookFormJump;
				}
			}
			if ($hdnId != '') {
				$booksCondition['book_id'] = $hdnId;
				$result = $this->CommonModel->updateData($booksCondition,$booksData,'book_mst');
			}else{
				$result = $this->CommonModel->InsertData($booksData,'book_mst');
				$hdnId = $this->db->insert_id();
			}
			if ($result) {
				$categories = $this->input->post('categories',TRUE);
				$authors = $this->input->post('authors',TRUE);
				$links = $this->input->post('download_link',TRUE);
				$this->CommonModel->deleteData(['book_id'=> $hdnId],'category_book_meta');
				$this->CommonModel->deleteData(['book_id'=> $hdnId],'author_book_meta');
				$this->CommonModel->deleteData(['book_id'=> $hdnId],'book_link_meta');
				if (!empty($categories) && count($categories) > 0) {
					$category_batch = array_map(function($catId) use($hdnId){
						return [
							'category_id' => $catId,
							'book_id' => $hdnId
						];
					}, $categories);
					if (count($category_batch) > 0) {
						$this->CommonModel->batchInsert('category_book_meta',$category_batch);
					}
				}
				if (!empty($authors)) {
					$author_batch = array_map(function($catId) use($hdnId){
						return [
							'author_id' => $catId,
							'book_id' => $hdnId
						];
					}, $authors);
					if (count($author_batch) > 0) {
						$this->CommonModel->batchInsert('author_book_meta',$author_batch);
					}
				}
				if (!empty($links) && count($links) > 0) {
					$links = array_filter($links,function($link){
						return $link != '';
					});
					$links_batch = array_map(function($link) use ($hdnId){
						return [
							'link_text' => $link,
							'book_id' => $hdnId
						];
					}, $links);
					if (count($links_batch) > 0) {
						$this->CommonModel->batchInsert('book_link_meta',$links_batch);
					}
				}
				$data['success_msg'] = "Book Saved!";
			}else{
				$data['error_msg'] = "Something Went wrong!";
			}
		}

		BookFormJump:
		$data = [];

		if ($id != '' && $id != 0) {
			if ($copy != '') {
				$select = 'best_seller, series_id, series_rank, meta_description, meta_keywords, search_keywords';
			}else{
				$select = 'book_name, book_id, best_seller, paramlink, series_id, series_rank, meta_title, meta_description, meta_keywords, search_keywords, description';
			}
			$data['record'] = $this->CommonModel->getSingleData(['book_id' => $id],'book_mst',$select);
			$category_applied = $this->CommonModel->getSelData(
				'category_id',
				['book_id' => $id],
				'category_book_meta'
			);
			$data['category_applied'] = @array_column($category_applied, 'category_id');
			$author_applied = $this->CommonModel->getSelData(
				'author_id',
				['book_id' => $id],
				'author_book_meta'
			);
			$data['author_applied'] = @array_column($author_applied, 'author_id');
			if ($copy == '') {
				$links_applied = $this->CommonModel->getSelData(
					'link_text',
					['book_id' => $id],
					'book_link_meta'
				);
				$data['links_applied'] = @array_column($links_applied, 'link_text');
			}
		}
		$data['category_option'] = $this->CommonModel->getSelData(
			'category_id,category_name',
			['category_id <>' => 0],
			'category_mst'
		);
		$data['author_option'] = $this->CommonModel->getSelData(
			'author_id,author_name',
			['author_id <>' => 0],
			'author_mst'
		);
		$data['series_option'] = $this->CommonModel->getSelData(
			'series_id,series_name',
			['series_id <>' => 0],
			'series_mst'
		);
		$layoutData['page'] = 'books/book_form';
		$layoutData['pageTitle'] = WEBSITE_TITLE.'- Admin Panel';
		$layoutData['pageData'] = $data;
		$this->load->view('layout',$layoutData);
	}
	public function checkBooks(){
		$this->load->model('CommonModel');
		$id = $this->input->post('hdnID',TRUE) ? $this->input->post('hdnID',TRUE) : 0;
		$name = $this->input->post('book_name',TRUE);
		$link = $this->input->post('paramlink',TRUE);
		if ($name == '' && $link == '') {
			echo json_encode([
				"status" => "fail",
				"msg" => "Empty Data!"
			]);
			exit();
		}
		if ($name != '') {
			$checkBooks['book_id <>'] = $id;
			$checkBooks['book_name'] = $name;
			$count = $this->CommonModel->getDataCount($checkBooks,'book_mst');
			if ($count > 0) {
				echo json_encode([
					"status" => "fail",
					"msg" => "Duplicate Book Name!"
				]);
				exit();
			}
			$checkBooks = [];
			$checkBooks['book_id <>'] = $id;
			$checkBooks['paramlink'] = url_title($name,'-',TRUE);
		}
		if ($link != '') {
			$checkBooks['book_id <>'] = $id;
			$checkBooks['paramlink'] = url_title($link,'-',TRUE);
		}
		$count = $this->CommonModel->getDataCount($checkBooks,'book_mst');
		if ($count == 0) {
			echo json_encode([
				"status" => "success",
				"link" => $checkBooks['paramlink']
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
	public function getBooks()
	{
		$draw = intval($this->input->get('draw',true));
		$this->load->model('CommonModel');
		$this->load->helper('datatable');
		$data = datatable($this->input->get());
		$data['table'] = 'book_mst';
		$data['select'] = 'book_id,book_name,status,paramlink';
		$data['condition']['book_id <>'] = $condition['book_id <>'] = 0;
		$recordTotal = $this->CommonModel->getDataCount($condition,'book_mst');
		$records = $this->CommonModel->datatableQueryBuilder($data,'array');
		$filteredRecords = $this->CommonModel->datatableQueryBuilder($data,'count');
		$records = array_map(function($record){
			$status = $record['status'] == 'active' ? 'checked' : '';
			$id = $record['book_id'];
			$record['status'] = "<input type='checkbox' class='status-switch' $status data-id='$id' data-fouc>";
			$record['action'] = "
				<a href='".base_url("/book/$id")."' title='Edit'><i class='text-info icon-pencil7'></i></a>
				<a href='".base_url("/book/$id/copy")."' title='Copy'><i class='text-slate-800 icon-paste2'></i></a>
				<a href='javascript:void(0)' onclick='deleteBook(`$id`)' title='Delete'><i class='text-danger icon-eraser2'></i></a>
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
	public function bookStatus()
	{
		$this->load->model('CommonModel');
		if ($this->input->post('delete_id',TRUE)) {
			$id = $this->input->post('delete_id',TRUE);
			$delete = $this->CommonModel->deleteData(['book_id' => $id],'book_mst');
			if ($delete) {
				$this->CommonModel->deleteData(['book_id' => $id],'category_book_meta');
				$this->CommonModel->deleteData(['book_id' => $id],'author_book_meta');
				$this->CommonModel->deleteData(['book_id' => $id],'book_link_meta');
				echo json_encode([
					'status' => 'success',
					'msg' => 'Book deleted Successfully!',
					'title' => 'Deleted!'
				]);
			}else{
				echo json_encode([
					'status' => 'error',
					'msg' => 'Something Went Wrong!',
					'title' => 'Oops...'
				]);
			}
		}else{
			$id = $this->input->post('id',TRUE) ? $this->input->post('id',TRUE) : 0;
			$status = $this->input->post('status',TRUE) == 'true' ? 'active' : 'inactive';
			$result = $this->CommonModel->updateData(['book_id'=>$id],['status'=>$status],'book_mst');
			if ($result) {
				echo json_encode([
					'status' => true,
					'msg' => 'Book updated Successfully!'
				]);
			}else{
				echo json_encode([
					'status' => false,
					'msg' => 'Something Went Wrong!'
				]);
			}
		}
	}
	public function linkForm()
	{
		$this->load->view('books/link_form');
	}
	public function importLinks()
	{
		$this->load->library('upload',$this->config->item('csv_upload'));
		if ($this->upload->do_upload('csv_file')) {
			$csvFile = $this->upload->data('full_path');
		}else{
			$response = json_encode([
				"status" => "fail",
				"msg" => $this->upload->display_errors('','')
			]);
			goto LinkImportJump;
		}
		$this->load->model('CommonModel');
		$file = fopen($csvFile,"r");
		$row = 2;
		$fields = fgetcsv($file);
		while($bookArray = fgetcsv($file))
		{
		  $bookId = $bookArray[0];
		  $batch = [];
		  for ($i=1; $i < count($bookArray); $i++) { 
		  	if ($bookArray[$i] != '') {
		  		$batch[] = [
				  	'book_id' => $bookId,
				  	'link_text' => $bookArray[$i]
				  ];
		  	}
		  }
		  if (!is_numeric($bookId) && $bookId <= 0) {
		  	$response = json_encode([
					'status' => "fail",
					'msg' => 'Invalid Data Found on Row No:'.$row
				]);
				goto LinkImportJump;
		  }
		  if (count($batch) >= 1) {
		  	$result = $this->CommonModel->deleteData([
				'book_id' => $bookId
			],'book_link_meta');
			if (!$result) {
				$response = json_encode([
					'status' => "fail",
					'msg' => 'Something Went Wrong! Error Found on Row No:'.$row
				]);
				goto LinkImportJump;
			}
			$result2 = $this->CommonModel->batchInsert('book_link_meta',$batch);
			if (!$result2) {
				$response = json_encode([
					'status' => "fail",
					'msg' => 'Something Went Wrong! Error Found on Row No:'.$row
				]);
				goto LinkImportJump;
			}
		  }
		  $row++;
		}
		$response = json_encode([
			'status' => "success",
			'msg' => 'Links Imported Successfully!'
		]);
		LinkImportJump:

		fclose($file);
		@unlink($csvFile);
		echo $response;
		exit();
	}
}
