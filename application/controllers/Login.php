<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_main');
	}

	public function islogged()
	{
		if($this->session->userdata('login') == FALSE)
		redirect('/','refresh');
	}

	public function index()
	{
		if($this->session->userdata('login') == TRUE){
			$this->load->view('test');
		}else{
			$this->load->view('login');
		}
	}

	public function login_user()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			if($this->m_main->login($username,$password)){
				$data = array(
					'msg' => 'Success', 
				);
			}else{
				$data = array(
					'msg' => 'Failed', 
				);
			}
		} else {
			$data = array(
				'msg' => validation_errors(), 
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

		$this->session->sess_destroy($data);
		redirect('/','refresh');
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */