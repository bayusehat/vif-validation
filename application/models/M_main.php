<?php if(!defined('BASEPATH')) exit('No direct script allowed');
use \Firebase\JWT\JWT;
class M_main extends CI_Model{

	function get_user($q) {
		return $this->db->get_where('m_user',$q);
	}

	public function get_row($email,$password)
	{
		return $this->db->select('user.*,emlployee.*')
						->from('user')
						->join('emlployee','emlployee.emplooyeeid=user.emplooyeeid')
						->where('email', $email)
						->where('password',$password)
						->get();
	}

	public function decoded_token_for_session($token)
	{
		$kunci = $this->config->item('thekey');
		$decoded = JWT::decode($token, $kunci, array('HS256'));

		return $decoded;
	}

	public function login($email,$password)
	{
		$apiKey = 'apikey-validation';

		$apiUser = "admin";
		$apiPass = "1234";

		$url = base_url().'api/auth/login';

		$userData = array(
		    'email' => $email,
		    'password' => $password
		);

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"X-API-KEY: " . $apiKey,
			"Content-type: application/x-www-form-urlencoded"
		));
		curl_setopt($ch, CURLOPT_USERPWD, "$apiUser:$apiPass");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $userData);

		$result = curl_exec($ch);

		curl_close($ch);

		$data = json_decode($result,true);
		print_r($userData);
		echo json_encode($data);

		// if($data['token'] != ""){
		// 	$userdata = array(
		// 		'email' => $email,
		// 		'login' => TRUE,
		// 		'token' =>  $data['token'],
		// 		'exp' => $data['exp']
		// 	);
		// 	$this->session->set_userdata($userdata);
		// 	return TRUE;
		// }else{
		// 	return FALSE;
		// }

	}
	
}