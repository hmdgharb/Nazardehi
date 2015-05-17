<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loader extends CI_Controller {

	public function __construct(){

		parent::__construct();
	}

	public function loadHome()
	{
		$this->load->view('home');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
