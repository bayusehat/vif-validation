<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_Model extends CI_Model {

	public function getForm()
	{
		return $this->db->get('form')
						->result();
	}

	public function add_form()
	{
		$subject = $this->input->post('subject');
		$description = $this->input->post('description');
		$currency = $this->input->post('currency');
		$amount_in_word = $this->input->post('amount_in_word');
		$bank = $this->input->post('bank');
		$account_number = $this->input->post('account_number');
		$account_name = $this->input->get('account_name');

		$form = array(
			'SUBJECT' => $subject,
			'USER_ID' => $this->session->userdata('id'),
			'DESCRIPTION' => $description,
			'CURRENCY' => $currency,
			'AMOUNT_IN_WORD' => $amount_in_word,
			'BANK' => $bank,
			'ACCOUNT_NUMBER' => $account_number,
			'ACCOUNT_NAME' => $account_name,
			'STAGE' => '123' 
		);

		$this->db->insert('form', $form);
		$id  = $this->db->insert_id();
		$form_detail = array();

		$code = $this->input->post('code');
		$description_detail = $this->input->post('description_detail');
		$amount = $this->input->post('amount');

		foreach ($code as $i => $item) {
			$form_detail[] = array(
				'FORM_ID' => $id,
				'CODE' => $code[$i],
				'DESCRIPTON' => $description_detail[$i],
				'AMOUNT' => $amount[$i],
			);

			$total = array_sum($amount);
		}

		$this->db->insert_batch('detail', $form_detail);
		$this->db->update('form',array('TOTAL_AMOUNT' => $total),array('FORM_ID'=>$id));

		//helper_log($log_action="",$log_status="",$log_message="") TO USER HELPER LOG
		if($this->db->affected_rows()>0){
			helper_log('insert',true,'Send new form success '.$id);
			return $id;
		}else{
			helper_log('insert',false,'Send new form failed');
			return FALSE;
		}
	}	

}

/* End of file Form_Model.php */
/* Location: ./application/models/Form_Model.php */