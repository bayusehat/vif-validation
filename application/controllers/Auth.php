<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Base_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function index()
	{
		// $this->islogged()
		// if($this->session->userdata('login') == TRUE){
			$this->load->view('test');
		// }else{
		// 	$this->load->view('login');
		// }
		
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */