<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {
	public function index()
	{
		echo "in Page->index()";
	}
	public function contact(){

		echo 'i am here';	
		try{

			//$data["contact_form"] = $this->config->item("contact_rules");
			//return $this->load->view("contact", $data["contact_form"]);
			
		}
		catch(Exception $err){
			
			log_message("error", $err->getMessage());
			return show_error($err->getMessage());
		}
	}
}

