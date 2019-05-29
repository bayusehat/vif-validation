<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ACL_Model extends CI_Model {
	public function GetBranch()
	{
		return $this->db->get('branch')->result();
	}

	public function SaveData($table,$field_id)
	{
		// $array;
		$data = $this->input->post("data");
		$action = "insert";
		$id = $data[$field_id];
		if ($id == "") {
			$this->db->insert($table, $data);
		}else{
			unset($data[$field_id]);
			$this->db->where($field_id, $id);
			$this->db->update($table, $data);
			$action = "update";
		}
		if($this->db->affected_rows()>0){
			$id = $this->db->insert_id();
			helper_log($action,true,$action.' '.$table.' success '.$id);
			return TRUE;
		}else{
			helper_log($action,false,$action.''.$table.' failed');
			return FALSE;
		}
	}

	public function DeleteData($table, $field_id, $id)
	{
		$this->db->where($field_id, $id);
		$this->db->delete($table);
		if($this->db->affected_rows()>0){
			helper_log('delete',true,'delete '.$table.' success '.$id);
			return TRUE;
		}else{
			helper_log('delete',false,'delete'.$table.' failed');
			return FALSE;
		}
	}
}

/* End of file ACL_Model.php */
/* Location: ./application/models/ACL_Model.php */