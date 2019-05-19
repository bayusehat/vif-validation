<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends Base_controller {



	public function index()
	{
		$data['main_view'] = 'test';
		$this->load->view('layout', $data);
	}

}

/* End of file Test.php */
/* Location: ./application/controllers/Test.php */