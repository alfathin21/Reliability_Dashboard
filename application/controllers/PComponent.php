<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PComponent extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Techlog_model');
		
	}
	public function index()
	{
		$data['title'] = 'Pareto Component Removal';
		$data['actype'] = $this->Techlog_model->getactype();
		$this->load->view('template/head',$data);
		$this->load->view('template/side');
		$this->load->view('page/removal');
		$this->load->view('template/fo2');
	}
	public function search()
	{
	    //Mendapatkan Value yang di passing
		if(empty($_POST["actype"])){
			$ACType = "";
			$where_actype = "";
		}
		else{
				$ACType = "'%".$_POST["actype"]."%'";
			$where_actype = "AND Aircraft LIKE ".$ACType;
		}
		if(!empty($_POST["date_from"])){
			$DateStart = $_POST["date_from"];
		}
		else{
			$DateStart = "";
		}
		if(!empty($_POST["date_to"])){
		   $DateEnd = $_POST["date_to"];
		}
		else{
			$DateEnd = "";
		}

		if (!empty($_POST["s"]) && $_POST['s'] == 'S' && !empty($_POST["u"]) && $_POST['u'] == 'U') {
				$s = $_POST["s"];
				$u = $_POST["u"];
				$s_jadi = "'".$s."'";
				$u_jadi = "'".$u."'";;
				$data  = $s_jadi.','.$u_jadi;
				$where_remcode = "AND RemCode IN ($data)";
		}
		else if(!empty($_POST["u"]) && $_POST['u'] == 'U'){
			$data = "'%".$_POST["u"]."%'";
			$where_remcode = "AND RemCode LIKE".$data;
		} else if (!empty($_POST["s"]) && $_POST['s'] == 'S') {
			$data = "'%".$_POST["s"]."%'";
			$where_remcode = "AND RemCode LIKE".$data;
		} 
		else {
			$where_remcode = "";
		}

		 $sql_graph_comp = "SELECT PartNo, PartName, COUNT(PartNo) AS number_of_part
          FROM tblcompremoval WHERE DateRem BETWEEN '".$DateStart."' AND '".$DateEnd."'".$where_actype."".$where_remcode." GROUP BY PartNo ORDER BY number_of_part DESC LIMIT 10";
       

         $result = $this->db->query($sql_graph_comp)->result_array();
         $jumlah = count($result);
         $response = [];
         $graph = [];
         $no = 1;
         foreach ($result as $key) {
         	$h['no'] = $no;
         	$h['PartNo'] = $key["PartNo"];
         	$h['PartName'] = $key["PartName"];
         	$h['number_of_part'] = $key['number_of_part']; 
            $b['name'] = $key["PartNo"];
            $b['y'] = strval($key['number_of_part']); 
         	$no++;
         	array_push($response, $h);
         	array_push($graph, $b);
         }

         $newresponse = array(
         	'data' => $response,
         	'jumlah' => $jumlah,
         	'graph'	=> $graph
         );
         echo json_encode($newresponse);



	}

}

/* End of file PComponent.php */
/* Location: ./application/controllers/PComponent.php */