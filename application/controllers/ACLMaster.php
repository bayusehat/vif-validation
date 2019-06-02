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
		$data = null;
		$insert = $this->ACL_Model->SaveData("branch","ID_BRANCH");
		// if ($insert->status) {
		// 	$message = "Data Successfully Saved";
		// }
		$result = setResultInfo($insert->status,$insert->message, $data);
		echo json_encode($result);
	}

	public function DeleteBranch()
	{
		$data = null;
		$id = $this->input->post("ID_BRANCH");

		$this->ACL_Model->UpdateAssosiationTable("ID_BRANCH", $id, "groups_branch", array());
		$delete = $this->ACL_Model->DeleteData("branch","ID_BRANCH", $id);
		$result = setResultInfo($delete->status,$delete->message, $data);
		echo json_encode($result);
	}

	public function GetDataGroups()
	{
		$data = $this->ACL_Model->GetGroups();
		echo json_encode($data);
	}

	public function SaveGroups()
	{
		$data = null;
		$insert = $this->ACL_Model->SaveGroup();
		$result = setResultInfo($insert->status,$insert->message, $data);
		echo json_encode($result);
	}

	public function DeleteGroups()
	{
		$data = null;
		$id = $this->input->post("GROUP_ID");

		$this->ACL_Model->UpdateAssosiationTable("GROUP_ID", $id, "groups_branch", array());
		$delete = $this->ACL_Model->DeleteData("groups","GROUP_ID", $id);
		$result = setResultInfo($delete->status,$delete->message, $data);
		echo json_encode($result);
	}
}

/* End of file ACLMaster.php */
/* Location: ./application/controllers/ACLMaster.php */