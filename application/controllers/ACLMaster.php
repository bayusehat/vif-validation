<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ACLMaster extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ACL_Model');
	}

	public function index()
	{
		$data["title"] = "Acl Master";
		$data['main_view'] = 'master/index';
		$this->load->view('layout', $data);
	}

	public function GetDataBranch()
	{
		$data = $this->ACL_Model->GetBranch();
		echo json_encode($data);
	}

	public function SaveBranch()
	{
		$message = "Cannot save data";
		$data = null;
		$insert = $this->ACL_Model->SaveData("branch");
		if ($insert) {
			$id = $this->db->insert_id();
		}
		$result = setResultInfo($insert,$message, $data);
		echo json_encode($result);
	}
}

/* End of file ACLMaster.php */
/* Location: ./application/controllers/ACLMaster.php */