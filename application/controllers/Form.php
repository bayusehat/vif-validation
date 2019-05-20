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
		$data['forms'] = $this->Form_Model->getForm();
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
		if($this->Form_Model->add_form()){
			$form_id = $this->Form_Model->add_form();
			if(!empty($_FILES['attachment']['name'])){
				$num = sizeof($_FILES['attachment']['tmp_name']);
				$files = $_FILES['attachment'];

				for($i=0;$i<$num;$i++){ 
					if($_FILES['attachment']['error'][$i] != 0){
						$this->form_validation->set_message('img_produk','Gagal');
						return false;
					}
				}

				$config['upload_path'] = './assets/uploads/files/';
				$config['allowed_types'] = 'gif|jpg|png|pdf';

				for($i=0;$i<$num;$i++){ 
					$_FILES['attachment']['name'] = $files['name'][$i];
					$_FILES['attachment']['type'] = $files['type'][$i];
					$_FILES['attachment']['tmp_name'] = $files['tmp_name'][$i];
					$_FILES['attachment']['error'] = $files['error'][$i];
					$_FILES['attachment']['size'] = $files['size'][$i];

						
					$this->upload->initialize($config);

					if($this->upload->do_upload('attachment')){
						$data = $this->upload->data();

						$insert[$i]['FILE_NAME'] = $data['file_name'];
					}
					$insert[$i]['FORM_ID'] = $form_id;
				}
			$this->db->insert_batch('attachment', $insert,array('FORM_ID' => $form_id));
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
		$data = $this->Form_Model->getForm();
		echo json_encode($data);
	}

}

/* End of file Form.php */
/* Location: ./application/controllers/Form.php */