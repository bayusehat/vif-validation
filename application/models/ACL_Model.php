<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ACL_Model extends CI_Model {
	public function GetBranch()
	{
		return $this->db->get('branch')->result();
	}
	
	public function GetAccess()
	{
		$this->db->select('*, PARENT_ID as parentId, ACCESS_ID as id');
		
		return $this->db->get('access')->result();
	}

	public function GetGroups()
	{
		$this->db->select('groups.*,groups_branch.GROUP_ID as bgGROUP_ID, groups_branch.ID_BRANCH as bgID_BRANCH, branch.BRANCH_TITLE');		
		$this->db->join('groups_branch', 'groups_branch.GROUP_ID = groups.GROUP_ID', 'left');
		$this->db->join('branch', 'branch.ID_BRANCH = groups_branch.ID_BRANCH', 'left');

		$rawData = $this->db->get('groups')->result();
		$arrData = array();
		foreach ($rawData as $group) {
			$arrData[$group->GROUP_ID]["ENABLE_GROUP"] = $group->ENABLE_GROUP;
			$arrData[$group->GROUP_ID]["GROUP_ID"] = $group->GROUP_ID;
			$arrData[$group->GROUP_ID]["GROUP_INDEX"] = $group->GROUP_INDEX;
			$arrData[$group->GROUP_ID]["GROUP_TITLE"] = $group->GROUP_TITLE;
			if ($group->bgID_BRANCH) {
				$arrData[$group->GROUP_ID]["ID_BRANCH"][]= $group->bgID_BRANCH;
				$arrData[$group->GROUP_ID]["BRANCH_TITLE"][]= $group->BRANCH_TITLE;
			}else{
				$arrData[$group->GROUP_ID]["ID_BRANCH"] = [];
				$arrData[$group->GROUP_ID]["BRANCH_TITLE"] = [];
			}
			
		}
		$data;
		foreach ($arrData as $dt) {
			$data[] = $dt;
		}

		return $data;
	}

	public function GetJoinAccessGroups($group_id)
	{
		$this->db->select('*, PARENT_ID as parentId, ACCESS_ID as id');
		$dataAccess = $this->db->get('access')->result_array();
		
		$dataGroups = $this->db->where('GROUP_ID', $group_id)->get('access_groups')->result_array();
		foreach ($dataAccess as $k => $access) {
			$dataAccess[$k]["DO_VIEW"] = 0;
			$dataAccess[$k]["DO_ADD"] = 0;
			$dataAccess[$k]["DO_EDIT"] = 0;
			$dataAccess[$k]["DO_DELETE"] = 0;
			$dataAccess[$k]["DO_APPROVE"] = 0;
			$dataAccess[$k]["DO_PAYMENT"] = 0;
			foreach ($dataGroups as $group) {
				if ($group["ACCESS_ID"] == $group["ACCESS_ID"]) {
					$dataAccess[$k]["DO_VIEW"] = $group["DO_VIEW"];
					$dataAccess[$k]["DO_ADD"] = $group["DO_ADD"];
					$dataAccess[$k]["DO_EDIT"] = $group["DO_EDIT"];
					$dataAccess[$k]["DO_DELETE"] = $group["DO_DELETE"];
					$dataAccess[$k]["DO_APPROVE"] = $group["DO_APPROVE"];
					$dataAccess[$k]["DO_PAYMENT"] = $group["DO_PAYMENT"];
				}
			}
		}
		
		return $dataAccess;
	}

	public function SaveData($table,$field_id,$data)
	{
		// $result = (object) ['status' => false, 'message' => "", 'id' => ""];
		// $array;
		if (!$data) {
			$data = $this->input->post("data");
		}
		$action = "insert";
		$id = $data[$field_id];
		$errmess = "";
		if ($id == "") {
			$this->db->insert($table, $data);
			$errmess = $this->db->error();
			$id = $this->db->insert_id();
		}else{
			unset($data[$field_id]);
			$this->db->where($field_id, $id);
			$this->db->update($table, $data);
			$errmess = $this->db->error();
			$action = "update";
		}
		if($this->db->affected_rows()>0){
			helper_log($action,true,$action.' '.$table.' success '.$id);
			$result = setResultInfoDb(true,"Data Successfully Saved",$id);
		}else{
			helper_log($action,false,$action.' '.$table.' failed');
			$cond = ($errmess["message"]=="");
			$result = setResultInfoDb($cond,($cond) ? "Update Success" : $errmess["message"],$id);
		}
		return $result;
	}

	public function SaveGroup()
	{
		$data = $this->input->post("data");
		$data_join = $this->input->post("data_join");

		$insert = $this->SaveData("groups","GROUP_ID");
		$saveJoinData = array();
		if ($insert->status) {
			if ($data_join) {
				foreach ($data_join as $branch_id) {
					$saveJoinData[] = array(
						'ID_BRANCH' => $branch_id,
						'GROUP_ID' => $insert->id,
					);
				}
			}
			$this->UpdateAssosiationTable("GROUP_ID", $insert->id,"groups_branch",$saveJoinData);
		}

		return $insert;
	}

	public function UpdateAssosiationTable($init_id_field, $main_id, $table_name, $data)
	{
		$this->db->where($init_id_field, $main_id);
		$oldData = $this->db->get($table_name);
		
		$action = "insert";
		if ($oldData->num_rows() > 0) {
			$action = "update";
			$this->db->where($init_id_field, $main_id);
			$this->db->delete($table_name);
		}

		if (count($data)>0) {
			$this->db->insert_batch($table_name, $data);
			$status = ($this->db->affected_rows() > 0) ? true : false ;
			$changedData = ' '.$this->ConverDataJoinToArray($data);
			$statusString = ($status) ? " sucess" : " failed";
			helper_log($action,$status,$action.' '.$table_name.$changedData.$statusString);
		}else{
			$changedData = ' '.$this->ConverDataJoinToArray($oldData->row_array());
			helper_log("delete",true,'delete '.$table_name.$changedData);
		}
		
	}

	public function ConverDataJoinToArray($data)
	{
		$result = "";
		// $data = (array)$data;
		// var_dump($data);
		if ($data) {
			foreach ($data as $val) {
				// $result = $result."|";
					$val = (array)$val;
					foreach ($val as $key => $value) {
						$result = $result.$key.":".$value.", ";
					}
				$result = $result."|";
			}
		}

		return "|".$result;
	}

	public function DeleteData($table, $field_id, $id)
	{
		$this->db->where($field_id, $id);
		$this->db->delete($table);
		if($this->db->affected_rows()>0){
			helper_log('delete',true,'delete '.$table.' success '.$id);
			$result = setResultInfoDb(true,"Data ".$table." with id ".$id." deleted",$id);
		}else{
			helper_log('delete',false,'delete'.$table.' failed');
			$ermes = $this->db->error();
			$result = setResultInfoDb(false,$ermes["message"],$id);
		}

		return $result;
	}
}

/* End of file ACL_Model.php */
/* Location: ./application/models/ACL_Model.php */