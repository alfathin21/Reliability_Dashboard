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

}

/* End of file Pareto.php */
/* Location: ./application/controllers/Pareto.php */