<?php 
 
defined('BASEPATH') OR exit('No direct script access allowed');

if(! function_exists('helper_log'))
{

        function helper_log($log_action="",$log_status="",$log_message=""){

        $CI =& get_instance();

        $param['LOG_ACTION']        = $log_action;
        $param['LOG_STATUS']        = $log_status;
        $param['LOG_MESSAGE']       = $log_message;
        $param['LOG_IPADDRESS']     = $_SERVER['REMOTE_ADDR'];
        $param['LOG_USER']          = $CI->session->userdata('id');
     
        $CI->load->model('M_main');
        $CI->M_main->save_log($param);
     
    }
}

if (! function_exists('setResultInfo')) {
	function setResultInfo($status,$message, $data)
	{
		$result = (object) ['status' => $isError, 'message' => $message, 'data' => $data];
		return $result;
	}
}
?>