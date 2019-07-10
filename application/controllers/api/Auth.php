<?php

defined('BASEPATH') OR exit('No direct script access allowed');
use \Firebase\JWT\JWT;

class Auth extends BD_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_main');
    }

    public function getBranchByGroup($id_group)
    {
        return $this->db->select('*')
                        ->from('groups_branch')
                        ->join('groups','groups.GROUP_ID=groups_branch.GROUP_ID')
                        ->join('branch','branch.ID_BRANCH=groups_branch.ID_BRANCH')
                        ->where('groups_branch.GROUP_ID',$id_group)
                        ->group_by('groups_branch.GROUP_ID')
                        ->get()
                        ->result();
    }

    public function login_post()
    {
        $u = $this->post('email');
        $p = sha1($this->post('password'));
        $kunci = $this->config->item('thekey');
        $invalidLogins= [
            'email' => $u,
            'password' => $p,
            'token' => "",
            'status' => 'Username dan password tidak ditemukan'];

        $check = $this->M_main->get_row($u,$p);   
        if($check->num_rows() > 0){
            $output['user']['id'] = $check->row()->USER_ID;
            $output['user']['email'] = $u;
            $output['user']['username'] = $check->row()->NAME;
        	// $token['id'] = $check->row()->USER_ID;  
         //    $token['email'] = $u;
         //    $token['password'] = $p;
         //    $date = new DateTime();
         //    $token['iat'] = $date->getTimestamp();
         //    $token['exp'] = $date->getTimestamp() + 60*60*5; 
         //    $output['token'] = JWT::encode($token,$kunci);
         //    $output['exp'] = $date->getTimestamp();
         //    $output['id'] = $check->row()->USER_ID;
         //    $output['username'] = $check->row()->NAME;
         //    $output['branch'] = $check->row()->ID_BRANCH;  
            $this->set_response($output, REST_Controller::HTTP_OK); 
        }
        else {
            $this->set_response($invalidLogins, REST_Controller::HTTP_NOT_FOUND); //This is the respon if failed
        }
    }

}
