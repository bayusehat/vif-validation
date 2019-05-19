<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ACL_Model extends CI_Model {
	public function GetBranch()
	{
		return $this->db->get('branch')->result();
	}
}

/* End of file ACL_Model.php */
/* Location: ./application/models/ACL_Model.php */