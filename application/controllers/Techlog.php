<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Techlog extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Techlog_model');
		
	}
	public function index()
	{
		$data['title'] = 'Teclog / Delay';
		$data['actype'] = $this->Techlog_model->getactype();
		$this->load->view('template/head',$data);
		$this->load->view('template/side');
		$this->load->view('page/techlog');
		$this->load->view('template/fo2');
	}
	public function search()
	{
		
		$graf_actype = $_POST["actype"];

		$ACType = "'%".$_POST["actype"]."%'";
		if(empty($_POST["acreg"])){
			$ACReg = "";
		}
		else{
			$ACReg = " AND REG LIKE '%".$_POST['acreg']."%'";
		}
		if(empty($_POST["datefrom"])){
			$DateStart = "";
			$DateStart2 = "";
		}
		else{

			$temp_date =  $_POST['datefrom'];
			$graf_datefrom = $temp_date;
			$DateStart = " AND DATE BETWEEN '".$temp_date."'";
			$DateStart2 = " AND DATEEVENT BETWEEN '".$temp_date."'";
		}
		if(empty($_POST["dateto"])){
			$DateEnd = "";
		}
		else{
			$temp_date = $_POST['dateto'];
			$graf_dateto = $temp_date;
			$DateEnd = " AND '".$temp_date."'";
		}
		if(empty($_POST["ata"])){
			$ATA = "";
			$ATA2 = "";
		}
		else{
			$ATA = " AND ATA = '".$_POST['ata']."'";
			$ATA2 = " AND ATATDM = '".$_POST['ata']."'";
		}
		if(empty($_POST["subata"])){
			$Fault_code = "";
			$Fault_code2 = "";
		}
		else{
			$Fault_code = " AND SUBATA = '".$_POST['subata']."'";
			$Fault_code2 = " AND SUBATATDM = '".$_POST['subata']."'";
		}
		if(empty($_POST["keyword"])){
			$Keyword = "";
		}
		else{
			$Keyword = " AND (PROBLEM LIKE '%".$_POST['keyword']."%' OR RECTIFICATION LIKE '%".$_POST['keyword']."%')";
		}


			$cl_delay = $_POST['cl_delay'];
			$cl_cancel = $_POST['cl_cancel'];
			$cl_x = $_POST['cl_x'];
			$cl_rta = $_POST['cl_rta'];
			$cl_rtb = $_POST['cl_rtb'];

			if (!empty($cl_delay) && !empty($cl_cancel) && !empty($cl_x)) {
				$dcp = " AND (DCP LIKE '%".strtoupper($cl_delay)."%' OR DCP LIKE '%".strtoupper($cl_cancel)."%' OR DCP LIKE '%".strtoupper($cl_x)."%')";
			}
			else {
				if (!empty($cl_delay) && $cl_delay == 'd') {
				$graph_title = "Delay";
				$dcp = "AND DCP = '".strtoupper($cl_delay)."'";
			} else if (!empty($cl_cancel) && $cl_cancel == 'c') {
				$graph_title = "Cancel";
				$dcp = "AND DCP = '".strtoupper($cl_cancel)."'";
			} else if (!empty($cl_x) && $cl_x == 'x') {
				$graph_title = "Non Technical Delay";
				$dcp = "AND DCP = '".strtoupper($cl_x)."'";
			} 

			if (!empty($cl_rta)) {
				$rta =  "AND RtABO = '".strtoupper($cl_rta)."'";
			} else if (!empty($cl_rtb)) {
				$rta =  "AND RtABO = '".strtoupper($cl_rtb)."'";
			}
			} 
				




	


		$sql_delay = "SELECT DateEvent, ACtype, Reg, DepSta, ArivSta, FlightNo, HoursTot, ATAtdm, SubATAtdm, Problem, Rectification, DCP, RtABO, MinTot FROM mcdrnew WHERE ACtype LIKE ".$ACType."".$ACReg."".$ATA2."".$Fault_code2."".$Keyword."".$dcp."".$DateStart2."".$DateEnd."";



		$result = $this->db->query($sql_delay)->result_array();
		$response = [];
		$no = 1;
		foreach ($result as $key) {
			$h['no'] = $no;
			$h['ACtype'] = $key["ACtype"];
			$h['Reg'] = $key["Reg"];
			$h['FlightNo'] = $key["FlightNo"];
			$h['DepSta'] = $key["DepSta"];
			$h['DateEvent'] = date('d F Y', strtotime($key["DateEvent"]));
			$h['FlightNo'] = $key["FlightNo"];
			$h['ArivSta'] = $key["ArivSta"];
			$h['MinTot'] = $key["HoursTot"];
			$h['Problem'] = $key["Problem"];
			$h['Rectification'] = $key["Rectification"];
			$h['ATAtdm'] = $key["ATAtdm"];
			$h['SubATAtdm'] = $key["SubATAtdm"];
			$h['DCP'] = $key["DCP"];
			$h['RtABO'] = $key["RtABO"];
			
			$no++;
			array_push($response, $h);
		}
		$newresponse = array(
			'data' => $response
		);
		echo json_encode($newresponse);
		
	}

}
