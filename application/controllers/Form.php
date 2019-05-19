<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function islogged()
	{
		if($this->session->userdata('login') == FALSE)
		redirect('/','refresh');
	}

	public function index()
	{
		$this->islogged();
		$data['title'] = 'Data Form';
		$data['main_view'] = 'form/data_form';
		$this->load->view('layout', $data);
	}

	public function add_form()
	{
		$this->islogged();
		$data['title'] = 'Add New Form';
		$data['main_view'] = 'form/add_form';
		$this->load->view('layout', $data);
	}

}

/* End of file Form.php */
/* Location: ./application/controllers/Form.php */