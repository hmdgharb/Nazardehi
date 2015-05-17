<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		
		parent::__construct();
		$this->load->model("usermodel");
	}	
	public function index()
	{
		$this->load->view('login_form');
	}
	
	public function registerUser(){

		$this->load->library('nativesession');
		if(empty($_POST)){

			$this->load->view("login_form");
		}else{

			$email = $this->input->post("email");
			$name = $this->input->post("name");
			$s_number = $this->input->post("s_number");
			$gender = $this->input->post("gender");
			$password = $this->input->post("password");
			$repassword = $this->input->post("re-password");
			$group = $this->input->post("group");
			$description = $this->input->post("description");
			echo $password ." ". $repassword;
			if($password == $repassword){
				echo "your password are equel\n";
				$checkUserExist = $this->usermodel->userExists($email);
				if($checkUserExist == True){
					echo "user exist\n";
				} else{
					 echo "user is not exist\n";
					$registerResult = $this->usermodel->addUser($email, $name, $s_number, $gender, $password, $group, $description);
					if($registerResult){
						
						$this->nativesession->set('email', $email);
						redirect('/user/home', 'refresh');
						home();
					}
					else echo "you cannot add.";
				}
			}else{
				echo "your password is not equal\n";
				
			}
		}
	}
	
	public function login(){

		$this->load->library('nativesession');

		if(!isset($_POST)){
			$this->load->view("login_form");
		}
		else{
			$this->load->helper('url');	
			

			$email = $this->input->post("email");
			$password = $this->input->post("password");
			$checkPassword = $this->usermodel->checkPassword($email, $password);
			echo $password . $email . $checkPassword;

			if($checkPassword){
			
				$this->nativesession->set('email', $email);
				redirect('/user/home', 'refresh');
			}else{
				redirect('/user/registerUser', 'refresh');
				echo "you are not logined, because email or password is wrong";
				echo "\n".$password . " " . $email;
			}

		}
	}

	public function home(){
		
		$this->load->library('nativesession');
		$email = $this->nativesession->get('email');
		if($email == null){

			$this->load->helper('url');	
			redirect('/user/registerUser', 'refresh');
		}

		$data["name"] = $this->usermodel->getName($email);
		$data["email"] = $email;
		$data["gender"] = $this->usermodel->getGender($email);
		$this->load->view("home", $data);

	}
	
	function logout(){

		$this->load->library('nativesession');
		if($this->nativesession->get('email') != null){
			$this->nativesession->delete('email');
		}
		if($this->nativesession->get('name') != null){
			$this->nativesession->delete('name');
		}
		if($this->nativesession->get('gender') != null){
			$this->nativesession->delete('gender');
		}
		$this->load->helper('url');	
		redirect('/user/registerUser', 'refresh');
	}
}
