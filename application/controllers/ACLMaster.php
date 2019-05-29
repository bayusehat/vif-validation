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
		$insert = $this->ACL_Model->SaveData("branch","ID_BRANCH");
		if ($insert) {
			$id = $this->db->insert_id();
			$message = "Data Successfully Saved";
		}
		$result = setResultInfo($insert,$message, $data);
		echo json_encode($result);
	}

	public function DeleteBranch()
	{
		$message = "Delete Failed";
		$data = null;
		$id = $this->input->post("ID_BRANCH");

		$delete = $this->ACL_Model->DeleteData("branch","ID_BRANCH", $id);
		if ($delete) {
			$message = "Data branch with id ".$id." Deleted";
		}
		$result = setResultInfo($delete,$message, $data);
		echo json_encode($result);
	}
}

/* End of file ACLMaster.php */
/* Location: ./application/controllers/ACLMaster.php */