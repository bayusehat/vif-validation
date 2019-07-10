<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ACLMaster extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ACL_Model');
		if($this->session->userdata('login') == FALSE)
		redirect('/','refresh');
	}

	// public function isLogged($value='')
	// {
	// 	if($this->session->userdata('login') == FALSE)
	// 	redirect('/','refresh');
	// }

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
		$insert = $this->ACL_Model->SaveData("branch","ID_BRANCH", null);
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

	public function ManageAccessForGroups()
	{
		$data = null;
		$insert = $this->ACL_Model->SaveAccessGroups();
		$result = setResultInfo($insert->status,$insert->message, $data);
		echo json_encode($result);
	}

	public function DeleteGroups()
	{
		$data = null;
		$id = $this->input->post("GROUP_ID");

		$this->ACL_Model->UpdateAssosiationTable("GROUP_ID", $id, "groups_branch", array());
		$this->ACL_Model->UpdateAssosiationTable("GROUP_ID", $id, "access_groups", array());
		$this->ACL_Model->UpdateAssosiationTable("GROUP_ID", $id, "user_groups", array());
		$delete = $this->ACL_Model->DeleteData("groups","GROUP_ID", $id);
		$result = setResultInfo($delete->status,$delete->message, $data);
		echo json_encode($result);
	}

	public function SaveAccess()
	{
		$data = $this->input->post('data');
		$data["PARENT_ID"] = ($data["PARENT_ID"]) ? $data["PARENT_ID"] : NULL ;
		$insert = $this->ACL_Model->SaveData("access","ACCESS_ID",$data);
		$result = setResultInfo($insert->status,$insert->message, null);
		echo json_encode($result);
	}
	
	public function GetDataAccess()
	{
		$data = $this->ACL_Model->GetAccess();
		echo json_encode($data);
	}

	public function DeleteAccess()
	{
		$data = null;
		$id = $this->input->post("ACCESS_ID");

		$this->ACL_Model->UpdateAssosiationTable("ACCESS_ID", $id, "access_groups", array());
		$delete = $this->ACL_Model->DeleteData("access","ACCESS_ID", $id);
		$result = setResultInfo($delete->status,$delete->message, $data);
		echo json_encode($result);
	}

	public function GetDataManageAccess()
	{
		$group_id = $this->input->post("GROUP_ID");
		$data = $this->ACL_Model->GetJoinAccessGroups($group_id);
		echo json_encode($data);
	}

	public function GetDataUsers()
	{
		$data = $this->ACL_Model->GetUsers();
		echo json_encode($data);
	}

	public function GetDataEmployee()
	{
		$data = $this->db->get('employee')->result();
		echo json_encode($data);
	}

	public function SaveUser()
	{
		$data = null;
		$insert = $this->ACL_Model->SaveUser();
		$result = setResultInfo($insert->status,$insert->message, $data);
		echo json_encode($result);
	}

	public function DeleteUser()
	{
		$data = null;
		$id = $this->input->post("USER_ID");

		$this->ACL_Model->UpdateAssosiationTable("USER_ID", $id, "user_groups", array());
		$delete = $this->ACL_Model->DeleteData("user","USER_ID", $id);
		$result = setResultInfo($delete->status,$delete->message, $data);
		echo json_encode($result);
	}
}

/* End of file ACLMaster.php */
/* Location: ./application/controllers/ACLMaster.php */