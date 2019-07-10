<?php if(!defined('BASEPATH')) exit('No direct script allowed');
use \Firebase\JWT\JWT;
class M_main extends CI_Model{

	function get_user($q) {
		return $this->db->get_where('m_user',$q);
	}

	public function get_row($username,$password)
	{
		return $this->db->select('*')
						->from('user')
						->join('employee','employee.EMPLOOYEEID=user.EMPLOOYEEID')
						->join('user_groups','user_groups.USER_ID=user.USER_ID')
						// ->join('groups','groups.GROUP_ID=user_groups.GROUP_ID')
						// ->join('groups_branch','groups_branch.GROUP_ID=groups.GROUP_ID')
						// ->join('branch','branch.ID_BRANCH=groups_branch.ID_BRANCH')
						->where('user.EMAIL',$username)
						->where('user.PASSWORD',$password)
						->get();
	}

	public function decoded_token_for_session($token)
	{
		$kunci = $this->config->item('thekey');
		$decoded = JWT::decode($token, $kunci, array('HS256'));

		return $decoded;
	}

	public function login($username,$password)
	{
		$apiKey = 'YXBpLWFwaWtleS12YWxpZGF0aW9u';

		$apiUser = "admin";
		$apiPass = "1234";

		$url = base_url().'api/auth/login';

		$userData = array(
		    'email' => $username,
		    'password' => $password
		);

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"X-API-KEY:".$apiKey,
		));
		curl_setopt($ch, CURLOPT_USERPWD, "$apiUser:$apiPass");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $userData);

		$result = curl_exec($ch);
		$err = curl_error($ch);

		curl_close($ch);

		$data = json_decode($result,true);

		if($data['token'] != ""){
			$userdata = array(
				'username' => $data['username'],
				'login' => TRUE,
				'token' =>  $data['token'],
				'exp' => $data['exp'],
				'ip_address' => $_SERVER['REMOTE_ADDR'],
				'id' => $data['id'],
				'branch' => $data['branch']
			);
			$this->session->set_userdata($userdata);
			$insert_session = array(
				'USER_ID' => $data['id'],
				'SESSION_USER' => $username,
				'SESSION_STATUS' => TRUE,
				'SESSION_MASSAGE' => 'SESSION',
				'SESSION_IPADDRESS' => $_SERVER['REMOTE_ADDR'],
				'SESSION_TOKEN' => $data['token'],
				'SESSION_EXPIRED' => date('Y-m-d H:i:s',$data['exp'])
			);
			$this->db->insert('session', $insert_session);
			return TRUE;
		}else{
			return FALSE;
		}

	}

	public function save_log($param)
	{
		$query = $this->db->insert_string('log', $param);
		$exec  = $this->db->query($query);
		return $this->db->affected_rows($exec);
	}

	public function getData($table)
	{
		return $this->db->get($table)->result();
	}

	public function qryCount($query)
	{
		return $this->db->query($query)->result();
	}
	
}