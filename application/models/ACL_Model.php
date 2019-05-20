<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ACL_Model extends CI_Model {
	public function GetBranch()
	{
		return $this->db->get('branch')->result();
	}

	public function SaveData($table)
	{
		// $array;
		$data = $this->input->post("data");
		// foreach($data as $key=>$value) {
		// 	$array[$key] = $value;
		// }
		$this->db->insert($table, $data);
		if($this->db->affected_rows()>0){
			$id = $this->db->insert_id();
			helper_log('insert',true,'Send new '.$table.' success '.$id);
			return TRUE;
		}else{
			helper_log('insert',false,'Send new '.$table.' failed');
			return FALSE;
		}
	}
}

/* End of file ACL_Model.php */
/* Location: ./application/models/ACL_Model.php */