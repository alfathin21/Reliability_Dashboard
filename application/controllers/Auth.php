<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		
		$this->load->view('page/login');
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */