<?php if(!defined('BASEPATH')) exit('No direct script allowed');

class M_main extends CI_Model{

	function get_user($q) {
		return $this->db->get_where('m_user',$q);
	}

	public function get_row($username,$password)
	{
		return $this->db->where('username', $username)
						->where('password',$password)
						->get('m_user');
	}

	public function login($username,$password)
	{
		$apiKey = 'apikey-validation';

		$apiUser = "admin";
		$apiPass = "1234";

		$url = base_url().'api/auth/login';

		$userData = array(
		    'username' => $username,
		    'password' => sha1($password)
		);

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY: " . $apiKey));
		curl_setopt($ch, CURLOPT_USERPWD, "$apiUser:$apiPass");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $userData);

		$result = curl_exec($ch);

		curl_close($ch);

		$data = json_decode($result,true);
		$u = $data['username'];
		$p = $data['password'];
		$t = $data['token'];
		$e = $data['exp'];
		$i = $data['id'];
		$query = $this->get_row($u,$p);
		if($query->num_rows() > 0){
			$sess = array(
				'id' => $i,
				'token' => $t,
				'exp' => date('d F Y H:i:s',$e)
			);
			$this->session->set_userdata($sess);
			return TRUE;
		}else{
			return FALSE;
		}
	}

	
}