<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_main');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function login_user()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			if($this->m_main->login($username,$password)){
				$this->load->view('test');
			}else{
				echo "Gagal";
			}
		} else {
			echo validation_errors();
		}
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */