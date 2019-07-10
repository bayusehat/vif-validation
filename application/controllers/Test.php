<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends Base_controller {

	public function index()
	{
		$data['main_view'] = 'test';
		$this->load->view('layout', $data);
	}

	public function joinGr()
	{
		$this->load->model('M_main');
		$username = 'aryabayu23@gmail.com';
		$password = sha1('bayu123');

		$result = $this->M_main->get_row($username,$password)->result();
		// $data['branch'] = $result->BRACH_TITLE;
		// $data['groups'] = $result->GROUP_ID;
		print_r($result);
	}

}

/* End of file Test.php */
/* Location: ./application/controllers/Test.php */