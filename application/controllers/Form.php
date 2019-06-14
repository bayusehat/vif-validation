<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include(APPPATH.'libraries/Fileuploader.php');

class Form extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
			$this->load->model(array('Form_Model','M_main'));
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
		$data['forms'] = $this->Form_Model->getForm();
		$this->load->view('layout', $data);
	}

	public function add_form()
	{
		$this->islogged();
		$data['title'] = 'New Form';
		$data['datacode'] = $this->M_main->getData('code');
		$data['main_view'] = 'form/add_form';
		$this->load->view('layout', $data);
	}

	public function add_form_run()
	{
		$this->islogged();
		$form_id = $this->Form_Model->add_form();
		if($form_id){
			$FileUploader = new FileUploader('files', array());
			$upload = $FileUploader->upload();
			$files = $upload['files'];
			$fileupload = [];
			if($files != 'null' || $files != '') {
				if($upload['isSuccess']) {
					foreach ($files as $file => $value) {
						array_push($fileupload, $value['file']);
					}
				}
				if($upload['hasWarnings']) {
					$warnings = $upload['warnings'];
					echo "<script>alert(".$warnings.");</script>";
				};
			};

			if (count($fileupload) > 0) {
					foreach ($fileupload as $file) {
						$getFileName = explode("/", $file);
						$insertFile = $this->db->insert('attachment', array(
							'FORM_ID' => $form_id,
							'FILE_NAME' => $getFileName[4]
					));
				}
			}

			$data = array(
				'msg' => 'Form sent',
				'valid' => true 
			);
		}else{
			$data = array(
				'msg' => 'Form failed to sent',
				'valid' => false 
			);
		}
		echo json_encode($data);
	}	

	public function getFormData()
	{
		$this->islogged();	
		$data = $this->Form_Model->getForm();
		echo json_encode($data);
	}

	public function getCodeData()
	{
		$this->islogged();
		$data = $this->M_main->getData('code');
		echo json_encode($data);
	}

	public function view_form($FORM_ID)
	{
		$this->islogged();
		$data['title'] = 'View Form';
		$data['main_view'] = 'form/view_form';
		$data['form'] = $this->Form_Model->getDataForm($FORM_ID);
		$data['detail'] = $this->Form_Model->getDetailForm($FORM_ID);
		$data['attachment'] = $this->Form_Model->getAttachment($FORM_ID);
		$this->load->view('layout', $data);
	}
}

/* End of file Form.php */
/* Location: ./application/controllers/Form.php */