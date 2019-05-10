<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Auth extends BD_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_main');
    }

    

    public function login_post()
    {
        $u = $this->post('username');
        $p = sha1($this->post('password'));
        $kunci = $this->config->item('thekey');
        $invalidLogins= [
            'token' => "",
            'status' => 'Username dan password tidak ditemukan'];
        $check = $this->M_main->get_row($u,$p);   
        if($check->num_rows() > 0){  
        	$token['id'] = $check->row()->id;  
            $token['username'] = $u;
            $token['password'] = $p;
            $date = new DateTime();
            $token['iat'] = $date->getTimestamp();
            $token['exp'] = $date->getTimestamp() + 60*60*5; 
            $output['token'] = JWT::encode($token,$kunci);
            $output['exp'] = $date->getTimestamp() + 60*60*5;
            $this->set_response($output, REST_Controller::HTTP_OK); 
        }
        else {
            $this->set_response($invalidLogins, REST_Controller::HTTP_NOT_FOUND); //This is the respon if failed
        }
    }

}
