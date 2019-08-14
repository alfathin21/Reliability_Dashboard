<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtbur extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Techlog_model');
		
	}
	public function index()
	{
		$data['title'] = 'MTBUR';
		$data['actype'] = $this->Techlog_model->getactype();
		$this->load->view('template/head',$data);
		$this->load->view('template/side');
		$this->load->view('page/mtbur');
		$this->load->view('template/fo2');
		
	}

	public function search()
	{
		
		$ACType = "'%".$_POST["actype"]."%'";
		if(empty($_POST["part"])){
			$PartNo = "";
		}
		else{
			$PartNo = " AND PartNo LIKE '%".$_POST['part']."%'";
		}
		if(empty($_POST["month_from"])){
			$MonthStart = "";
			$MonthStart2 = "";
		}
		else{
				$month = $_POST['month_from'];
				$months = explode("/", $month);
				$month = $months[0]."-".$months[1]."-"."01";
				$month1 = $months[0]."".$months[1];
				$MonthStart = " AND MonthEval BETWEEN '".$month."'";
				$MonthStart2 = " AND Month BETWEEN '".$month1."'";
		}
		if(empty($_POST["month_to"])){
			$MonthEnd = "";
			$MonthEnd2 = "";
		}
		else{
		$month = $_POST['month_to'];
		$months = explode("/", $month);
		$month = $months[0]."-".$months[1]."-"."01";
		$month1 = $months[0]."".$months[1];
		$MonthEnd = " AND '".$month."'";
		$MonthEnd2 = " AND '".$month1."'";
		}


	$sql_fh = "SELECT RevFHHours, RevFHMin FROM tbl_monthlyfhfc WHERE Actype LIKE ".$ACType."".$MonthStart."".$MonthEnd;

	
	$sql_rm = "SELECT COUNT(Aircraft) AS rem FROM tblcompremoval WHERE Aircraft LIKE ".$ACType."".$PartNo."".$MonthStart2."".$MonthEnd2." AND RemCode = 'U'";

		$sql_qty = "SELECT DateRem, PartNo, QTY FROM tblcompremoval WHERE Aircraft LIKE ".$ACType."".$PartNo."".$MonthStart2."".$MonthEnd2." AND RemCode = 'U' ORDER BY DateRem DESC LIMIT 1";

		$sql_tbl = "SELECT DateRem, PartNo, SerialNo, PartName, Reg, Month As bulan FROM tblcompremoval WHERE Aircraft LIKE ".$ACType."".$PartNo."".$MonthStart2."".$MonthEnd2." AND RemCode = 'U'";

		$fhours = 0;
		$result = $this->db->query($sql_tbl)->result_array();
		$res_fh = $this->db->query($sql_fh)->result_array();
		$res_qty = $this->db->query($sql_qty)->result_array();

$res_rm = $this->db->query($sql_rm)->result_array();
$rm = $res_rm[0]['rem'];

foreach ($res_fh as $key) {
	    $key['RevFHMin'] = $key['RevFHMin']/60;
	 	$fhours= $fhours+$key['RevFHHours']+$key['RevFHMin'];
}
$mtbur =  number_format($fhours, 2, '.', ',');

if($rm != 0){
	$qtys = $res_qty;
	$qty = $qtys[0]['QTY'];
	$mtr = $fhours*$qty/$rm;
	$hasil_mtbur =  number_format($mtr, 0, '.', ',');
}
else{
	$hasil_mtbur = "N\A";
}

	$response = [];
	$no = 1;
	foreach ($result as $key) {
		$h['no'] = $no;
		$h['DateRem'] = date('d F Y',strtotime($key["DateRem"]));
		$h['PartNo'] = $key["PartNo"];
		$h['SerialNo'] = $key["SerialNo"];
		$h['PartName'] = $key["PartName"];
		$h['Reg'] = $key["Reg"];
	
		$no++;
		array_push($response, $h);
	}

	$newresponse = array(
		'data' => $response,
		'fh' => $mtbur,
		'removal' => $rm,
		'hasil_mtbur' => $hasil_mtbur
	);
	echo json_encode($newresponse);
}

}

/* End of file Pareto.php */
/* Location: ./application/controllers/Pareto.php */