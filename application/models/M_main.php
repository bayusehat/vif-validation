<?php if(!defined('BASEPATH')) exit('No direct script allowed');
use \Firebase\JWT\JWT;
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

	public function decoded_token_for_session($token)
	{
		$kunci = $this->config->item('thekey');
		$decoded = JWT::decode($token, $kunci, array('HS256'));

		return $decoded;
	}

	public function login($username,$password)
	{
		$apiKey = 'apikey-validation';

		$apiUser = "admin";
		$apiPass = "1234";

		$url = base_url().'api/auth/login';

		$userData = array(
		    'username' => $username,
		    'password' => $password
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

		if($data['token'] != ""){
			$userdata = array(
				'username' => $username,
				'login' => TRUE,
				'token' =>  $data['token'],
				'exp' => $data['exp']
			);
			$this->session->set_userdata($userdata);
			return TRUE;
		}else{
			return FALSE;
		}

	}

	
}