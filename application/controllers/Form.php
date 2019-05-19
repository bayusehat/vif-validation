<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
			$this->load->model(array('Form_Model'));
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

	public function add_form_run()
	{
		$this->islogged();
		$data = $this->Form_Model->add_form();
		echo json_encode($data);
	}

}

/* End of file Form.php */
/* Location: ./application/controllers/Form.php */