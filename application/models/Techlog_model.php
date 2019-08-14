<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Techlog_model extends CI_Model {

	public function getactype()
	{
		return $this->db->query("SELECT ACType FROM tbl_master_actype")->result_array();
	}	

	


public function techlog_search(array $param = null)
	{
		
		$keyword 		= $param['keyword'];
		$acreg 		    = $param['acreg'];
		$actype 		= $param['actype'];
		$subata 		= $param['subata'];
		$ata	 		= $param['ata'];
		$date_to 		= $param['date_to'];
		$date_from 		= $param['date_from'];

		
		if (!empty($date_from) and !empty($date_to)) {
			$this->db->where("(DateEvent BETWEEN '$date_from' AND '$date_to') ");
		}



		
		$query = $this->db->get("mcdrnew");

		return $query->result_array();
	}


}

/* End of file Techlog_model.php */
/* Location: ./application/models/Techlog_model.php */