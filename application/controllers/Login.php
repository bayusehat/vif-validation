<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_main');
	}

	public function islogged()
	{
		if($this->session->userdata('login') == FALSE)
		redirect('/','refresh');
	}

	public function index()
	{
		if($this->session->userdata('login') == TRUE){
			$data['title'] = 'Dashboard';
			$data['main_view'] = 'dashboard';
			$data['all_form'] = count($this->m_main->qryCount("SELECT * FROM form"));
			$data['verified_form']= count($this->m_main->qryCount("SELECT * FROM form WHERE STATUS='Verified'"));
			$data['rejected_form']= count($this->m_main->qryCount("SELECT * FROM form WHERE STATUS='Rejected'"));
			$data['all_user'] = count($this->m_main->qryCount("SELECT * FROM user"));
			$this->load->view('layout', $data);
		}else{
			$this->load->view('logins');
		}
	}

	public function login_user()
	{
		$email = htmlspecialchars($this->input->post('email'));
		$password = htmlspecialchars($this->input->post('password'));

		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_error_delimiters('','');

		if ($this->form_validation->run() == TRUE) {
			if($this->M_main->login($email,$password)){
				$data = array(
					'msg' => 'Login Success, welcome!',
					'valid' =>  true 
				);
			}else{
				$data = array(
					'msg' => 'Combine e-mail and password not found', 
					'valid' => false
				);
			}
		} else {
			$data = array(
				'msg' => validation_errors(),
				'valid' => false 
			);
		}

		echo json_encode($data);
	}

	public function test()
	{
		$this->islogged();
		$this->load->view('test');
	}

	public function logout()
	{
		$data = array(
			'login' => FALSE,
			'username' => '',
			'token' => ''
		);

		$end = $this->session->sess_destroy($data);
		echo json_encode($end);
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */