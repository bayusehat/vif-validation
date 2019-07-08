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
		$result = (object) ['status' => $status, 'message' => $message, 'data' => $data];
		return $result;
	}
}

if (! function_exists('setResultInfoDb')) {
	function setResultInfoDb($status,$message, $id)
	{
		$result = (object) ['status' => $status, 'message' => $message, 'id' => $id];
		return $result;
	}
}

if(! function_exists('setHistoryForm')) {
	function setHistoryForm($id,$status,$notes,$forward_to)
	{
		$CI =& get_instance();
		$data['FORM_ID']	 = $id;
		$data['HISTORY_STATUS']	= $status;
		$data['HISTORY_NOTES']	 = $notes;
		$data['APPROVER']	 = $CI->session->userdata('id');
		$data['FORWARD_TO']	 = $forward_to;

		$CI->load->model('Form_model');
		$CI->Form_model->setHistory($data);

	}
}
?>