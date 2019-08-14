<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Components extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Techlog_model');
		
	}
	public function index()
	{
		$data['title'] = 'Components Removal';
		$data['actype'] = $this->Techlog_model->getactype();
		$this->load->view('template/head',$data);
		$this->load->view('template/side');
		$this->load->view('page/component');
		$this->load->view('template/fo2');
		
	}

	public function search()
	{
					//Mendapatkan Value yang di passing
			if(empty($_POST["actype"])){
			  $ACType = "";
			}
			else{
			  $ACType = "'".$_POST['actype']."%'";
			  $where_actype = "Aircraft LIKE ".$ACType;
			}
			if(empty($_POST["acreg"])){
			  $ACReg = "";
			}
			else{
			  $ACReg = $_POST['acreg'];
			}
			if(empty($_POST["part"])){
			  $PartNum = "";
			}
			else{
			  $PartNum = "".$_POST['part']."";
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

			if(isset($where_remcode)){
				$sql_comp = "SELECT DATE_FORMAT(DateRem, '%Y-%m') AS dates, COUNT(DATE_FORMAT(DateRem, '%Y-%m')) AS number_of_rem FROM tblcompremoval
				WHERE ".$where_actype." AND PartNo LIKE '%".$PartNum."%' AND Reg LIKE '%".$ACReg."%' AND DateRem BETWEEN '".$DateStart."' AND '".$DateEnd."' GROUP BY dates;";
			}
			else {
				$sql_comp = "SELECT DATE_FORMAT(DateRem, '%Y-%m') AS dates, COUNT(DATE_FORMAT(DateRem, '%Y-%m')) AS number_of_rem FROM tblcompremoval
				WHERE ".$where_actype." AND ".$where_remcode." AND PartNo LIKE '%".$PartNum."%' AND Reg LIKE '%".$ACReg."%' AND DateRem BETWEEN '".$DateStart."' AND '".$DateEnd."' GROUP BY dates;";
			}

			$sql_rem = "SELECT ID, ATA, AIN, PartNo, SerialNo, PartName, Reg, Aircraft, RemCode, `Real Reason` AS real_reason, DateRem, TSN, TSI, CSN, CSI
			FROM tblcompremoval WHERE ".$where_actype." AND PartNo LIKE '%".$PartNum."%' AND Reg LIKE '%".$ACReg.
			"%' AND DateRem BETWEEN '".$DateStart."' AND '".$DateEnd."' ".$where_remcode;


			


     	
             $result = $this->db->query($sql_rem)->result_array();
             $res_rem = $this->db->query($sql_comp)->result_array();
             $count_graph = $this->db->query($sql_comp)->num_rows();




        $temp_arr_comp = [];
        $before_temp = [];
        $i=0;


        if($count_graph > 0){
          // while ($rowes = $res_rem->result_array()) {
          //   $temp_arr_comp[$i]['dates'] = $rowes['dates'];
          //   $temp_arr_comp[$i]['number_of_rem'] = $rowes['number_of_rem'];
          //   $i++;
          // }



             foreach ($res_rem as $y) {
             	$b['dates'] = $y['dates'];
             	$b['number_of_rem'] = $y['number_of_rem'];
             	array_push($temp_arr_comp, $b);
             }


    $i = 0;
          $temp_arr = 0;
          $now = strtotime($DateStart);
          $end_date = strtotime($DateEnd);

          $end_date = strtotime("+1 Month", $end_date);

          while (date("Y-m" ,$now) != date("Y-m" ,$end_date)) {

              //Apabila Bulan dan tahun sekarang sama dengan bulan dan tahun pada tabel hasil query, maka hasilnya akan disimpan
              //dalam array
              if($temp_arr_comp[$temp_arr]['dates'] == date("Y-m", $now)){
                $arr_comp[$i]['dates'] = $temp_arr_comp[$temp_arr]['dates'];
                $arr_comp[$i]['number_of_rem'] = $temp_arr_comp[$temp_arr]['number_of_rem'];
                if($temp_arr < $count_graph-1)
                  $temp_arr++;
                $i++;
              }

              //Apabila masih tidak sama, berarti menyimpan jumlah kejadian 0 ke dalam array
              else {
                //Selama bulan dan tahun ke $now masih belum ada kejadian, maka akan diisi 0 hingga menemukan
                //tahun dan bulan selanjutnya
                $arr_comp[$i]['dates'] = date("Y-m", $now);
                $arr_comp[$i]['number_of_rem'] = 0;
                $i++;
              }

            $now = strtotime("+1 Month", $now);
          }
        }


























             $response = [];
             $response2 = [];
         	 $no = 1;
             foreach ($result as $key) {
             	$h['no'] = $no;
             	$h['notification'] = $key["ID"];
             	$h['ata'] = $key["ATA"];
             	$h['equipment'] = $key["AIN"];
             	$h['PartNo'] = $key["PartNo"];
             	$h['SerialNo'] = $key['SerialNo']; 
             	$h['PartName'] = $key['PartName']; 
             	$h['Reg'] = $key['Reg']; 
             	$h['Aircraft'] = $key['Aircraft']; 
             	$h['real_reason'] = $key['real_reason']; 
             	$h['DateRem'] = date('d F Y', strtotime($key['DateRem'])); 
             	$h['TSN'] = $key['TSN']; 
             	$h['TSI'] = $key['TSI']; 
             	$h['CSN'] = $key['CSN']; 
             	$h['CSI'] = $key['CSI']; 
             	$h['RemCode'] = $key['RemCode']; 
             	$no++;
             	array_push($response, $h);
             } 

             foreach ($arr_comp as $y) {
             	$b['dates'] = $y['dates'];
             	$b['number_of_rem'] = $y['number_of_rem'];
             	array_push($response2, $b);
             }


             $newresponse = array(
             	'data' => $response,
             	'graph' => $response2
             );
             echo json_encode($newresponse);


	}

}

/* End of file Pareto.php */
/* Location: ./application/controllers/Pareto.php */