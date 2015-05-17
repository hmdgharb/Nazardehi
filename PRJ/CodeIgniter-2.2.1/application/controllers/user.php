<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		
		parent::__construct();
		$this->load->model("usermodel");
		$this->load->model("questionmodel");
		$this->load->model("twitemodel");
		$this->load->model("answermodel");
		$this->load->library("email");

		//$emailConfig = $this->config->load("email");
	}	
	public function index()
	{
		$this->load->view('login_form');
	}
	
	public function sendEmail($from,$to,$msg,$subject,$senderName){
		echo $from . " " . $to . " " . $subject . " " . $msg;
		return mail($to, $subject, $msg);
		
	}
/*
	public function sendEmail($from,$to,$msg,$subject,$senderName){
	echo "i am here in sendEmail";
        $this->load->library('email');
        $this->email->initialize(array(
          'protocol' => 'smtp',
          'smtp_host' => 'in-v3.mailjet.com',
          'smtp_user' => '9b3aab1bb2696a707c2de45d963b4434',
          'smtp_pass' => '4303ef1ebff24bf7955280bcea271426',
          'smtp_timeout' => '7',
          'smtp_port' => 587,
          'crlf' => "\r\n",
          'newline' => "\r\n"
        ));
	echo $from . " " . $senderName . " " . $to . " " . $subject . " " . $msg . " ";
        $this->email->from($from, $senderName);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($msg);
        $emailResult = $this->email->send();

        return $emailResult;
    }

*/
	public function registerUserMail(){
    
		if(empty($_POST)){
			$this->load->view("login_form");
		}else{


			$this->load->library('nativesession');
			$email = $this->input->post("email");
			$valid = filter_var($email, FILTER_VALIDATE_EMAIL);
			if(!$valid)
				echo "Email syntax is invalid";
		
			$name = $this->input->post("name");
			$s_number = $this->input->post("s_number");
			$gender = $this->input->post("gender");
			$password = $this->input->post("password");
			$repassword = $this->input->post("re-password");
			$group = $this->input->post("group");
			$description = $this->input->post("description");
			if($password == $repassword){
				$checkuserexist = $this->usermodel->userexists($email);
				if($checkuserexist == true){
						
				}else{
					$registerresult = $this->usermodel->adduser($email, $name, $s_number, $gender, $password, $group, $description, date('y-m-d'));
					if($registerresult){
						$user = $this->usermodel->getuser($email);
					//	$this->nativesession->set('user', $user);
					//	$this->nativesession->set('operation', '');
					//	redirect('/user/home', 'refresh');
					
                        			$hash = $this->generateValidationToken();
                        			$saveHash = $this->saveVerificationLink($email, $hash);

                        			$from = "hmd.gharb@gmail.com";
                        			$to = $email;
                        			$message = '

Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

------------------------
Username: '.$email.'
Password: '.$password.'
------------------------

Please click this link to activate your account:
http://localhost/PRJ/CodeIgniter-2.2.1/index.php/user/verifyUser?email='.$email.'&hash='.$hash.'

';//move email message to an html file and load it here;
                        			$subject = "Nazardehi - Confirm Your Registration";
                        			$senderName = "Nazardehi";
                        			$emailResult = $this->sendEmail($from, $to, $message, $subject, $senderName);
                        			if($emailResult){
                            				echo "Email sent successfuly";
							$usr = $this->usermodel->getUser($email);
							$this->nativesession->set('operation', 'checkMail');
							$this->nativesession->set('user', $usr);
							redirect('/user/recheckVerified');
                        			}else{
                            				echo "Email sending problem but user added successfully";
                        			}

					}
				}
			}
		}
	}
	
	public function generateValidationToken(){
    
        	return md5( rand(0,1000) );//Generate random 32 character hash and assign it to a local variable.
        	// Example output: f4552671f8909587cf485ea990207f3b
    
    	}

	public function saveVerificationLink($email,$hash){
	
		$result = $this->usermodel->addVerificationToken($hash,$email);

		if($result == TRUE){
			return $hash;
		}else{
			return false;
		}
    	}

	public function registerUser(){

		$this->load->library('nativesession');
		if(empty($_POST)){
			
			$data['message'] = $this->nativesession->get('operation');
			$this->load->view("login_form", $data);
		}else{

			$email = $this->input->post("email");
			$name = $this->input->post("name");
			$s_number = $this->input->post("s_number");
			$gender = $this->input->post("gender");
			$password = $this->input->post("password");
			$repassword = $this->input->post("re-password");
			$group = $this->input->post("group");
			$description = $this->input->post("description");
			if($password == $repassword){
				$checkuserexist = $this->usermodel->userexists($email);
				if($checkuserexist == true){
				
				} else{
					$registerresult = $this->usermodel->adduser($email, $name, $s_number, $gender, $password, $group, $description, date('y-m-d'));
					if($registerresult){
						$user = $this->usermodel->getuser($email);	
						$this->nativesession->set('user', $user);
						$this->nativesession->set('operation', '');
						redirect('/user/home', 'refresh');
					}
					else echo "you cannot add.";
				}
			}else{
				echo "your password is not equal\n";
				
			}
		}
	}
	public function verifyUser(){
		
		$url = parse_url($_SERVER['REQUEST_URI']);
		parse_str($url['query'], $params);
		$email = $params["email"];
		$hash = $params["hash"];
		$validationResult = $this->usermodel->confirmValidation($hash,$email);

		$this->load->library('nativesession');
        	
		$user = $this->usermodel->getUser($email);
		$this->nativesession->set('user', $user);
		
		if($validationResult == TRUE){
					
			
			$this->nativesession->set('operation', 'userActivated');
			redirect('/user/waitingPage', 'refresh');
		}else{
			$this->nativesession->set('operation', 'userNotActivated');
			redirect('/user/waitingPage', 'refresh');
        	}
	}

	public function waitingPage(){

		
		$this->load->library('nativesession');
		if( strcmp($this->nativesession->get('operation'), 'checkMail') == 0){

			$data['message'] = 'your registeration need to be activated, please check your mailbox!';
			$data["user"] = $this->nativesession->get('user');
			
			$this->load->view("waitingPage", $data);
		}
		else if( strcmp($this->nativesession->get('operation'), 'userActivated') == 0){

			$data['message'] = 'thank you for your registeration, in 5 second you will redirect to your home page, dear :)';
			$data["user"] = $this->nativesession->get('user');

			$path = $this->config->base_url() . "index.php/user/home";
			
			$this->load->view("waitingPage", $data);
			$this->nativesession->set('operation', '');
			header( "refresh:5;url=$path" );	
		}
		else if( strcmp($this->nativesession->get('operation'), 'userNotActivated') == 0){

			$data['message'] = 'sorry, we cannot register you in this time, please try this action in 1 hour later, dear :)';
			$data["user"] = $this->nativesession->get('user');
			
			$this->load->view("waitingPage", $data);

		}
		else {
			echo $this->nativesession->get('operation');
			redirect('/user/home', 'refresh');
		}
	}	

	function recheckVerified(){

		$this->load->library('nativesession');
		echo $this->nativesession->get('operation');
		if( strcmp($this->nativesession->get('operation'), 'checkMail') == 0){
			$usr =$this->nativesession->get('user'); 	
			$checkActivation = $this->usermodel->checkVerified($usr->email);
			
			if($checkActivation){
		
				$this->nativesession->set('operation', '');
				redirect('/user/home', 'refresh');
			}else{
				
				$this->nativesession->set('operation', 'checkMail');
				redirect('/user/waitingPage', 'refresh');
			}
		}
		else{

			$this->nativesession->set('operation', '');
			redirect('/user/home', 'refresh');
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
			$checkActivation = $this->usermodel->checkVerified($email);
			if($checkPassword && $checkActivation){
		
				$user = $this->usermodel->getUser($email);
			
				$this->nativesession->set('user', $user);
				$this->nativesession->set('operation', '');
				redirect('/user/home', 'refresh');
			}else if(!$checkActivation && $checkPassword){
				
				$user = $this->usermodel->getUser($email);
			
				$this->nativesession->set('user', $user);
				$this->nativesession->set('operation', 'checkMail');
				redirect('/user/waitingPage', 'refresh');
			}else{
				$this->nativesession->set('operation', 'wrongPass');
				redirect('/user/registerUser', 'refresh');
			}
		}
	}

	public function checkLogined(){

		$this->load->helper('url');	
		$this->load->library('nativesession');
		$user = $this->nativesession->get('user');
		if($user->email == null){

			$this->load->helper('url');	
			redirect('/user/registerUser', 'refresh');
		}
	}

	public function home(){
		
		$this->load->helper('url');	
		$this->checkLogined();	

		//information for user	
		$data["user"] = $this->nativesession->get('user');
		
		$operation = $this->nativesession->get('operation');
		//operation for first question of twitter message
		if($operation == null){

			
			$min = 0;
			$max = $this->twitemodel->getTwiteNumber() - 1;
			$data["twite"] = $this->twitemodel->getRow(rand($min, $max));
			$data["question"] = $this->questionmodel->getNewQuestion();
			$this->nativesession->set('twitter', $data["twite"]);
			$this->nativesession->set('question', $data["question"]);
			$this->load->view("home", $data);
		}//operation for second question of twitter message
		else if(strcmp($this->nativesession->get('operation'), 'question1') == 0){
			
			$data["twite"] = $this->nativesession->get('twitter');
			$data["question"] = $this->questionmodel->getRow(1);
			$this->nativesession->set('question', $data["question"]);
			$this->load->view("home", $data);
		}//operation for third question of twitter message
		else if(strcmp($this->nativesession->get('operation'), 'question2') == 0){
			$data["twite"] = $this->nativesession->get('twitter');
			$data["question"] = $this->questionmodel->getRow(2);
			$this->nativesession->set('question', $data["question"]);
			$this->load->view("home", $data);
		}//operation for forth question of twitter message
		else if(strcmp($this->nativesession->get('operation'), 'question3') == 0){
			$data["twite"] = $this->nativesession->get('twitter');
			$data["question"] = $this->questionmodel->getRow(3);
			$this->nativesession->set('question', $data["question"]);
			$this->load->view("home", $data);
		}else{
			redirect('/user/registerUser');
		}
	}
	function deleteUser(){

		$this->load->library('nativesession');
		$email = $this->nativesession->get('user')->email;
		if($email == null){

			$this->load->helper('url');	
			redirect('/user/registerUser', 'refresh');
		}
		
		$this->usermodel->deleteUser($email);
		$this->logout();
	}
	
	function logout(){
		
		$this->checkLogined();	
		$this->load->library('nativesession');
		if($this->nativesession->get('user') != null){
			$this->nativesession->delete('user');
		}
		if($this->nativesession->get('question') != null){
			$this->nativesession->delete('question');
		}
		if($this->nativesession->get('twite') != null){
			$this->nativesession->delete('twite');
		}
		if($this->nativesession->get('answer') != null){
			$this->nativesession->delete('answer');
		}
		$this->load->helper('url');	
		redirect('/user/registerUser', 'refresh');
	}

	function checkAnswer(){
		
		$this->load->library('nativesession');
		$this->checkLogined();	
		$result = $this->input->post("quest");
		if($result == null){
			redirect('/user/home', 'refresh');
		}
		else{	
			$result = $this->input->post("quest");
			$user = $this->nativesession->get("user");
			$twite = $this->nativesession->get("twitter");
			$question = $this->nativesession->get("question");
			$user_id = $user->u_id;
			$twite_id = $twite->t_id;
			$question_id = $question->q_id;
			$time = date('Y-m-d');
			$this->answermodel->addAnswer($user_id, $twite_id, $question_id, $time, $result);
			$this->updateQuestion();
			redirect('/user/home', 'refresh');
		}
	}

	public function updateQuestion(){

		if($this->nativesession->get('operation') == null)
			$this->nativesession->set('operation', 'question1');
		else if($this->nativesession->get('operation') == 'question1')
			$this->nativesession->set('operation', 'question2');
		else if($this->nativesession->get('operation') == 'question2')
			$this->nativesession->set('operation', 'question3');
		else if($this->nativesession->get('operation') == 'question3')
			$this->nativesession->set('operation', '');
	}

	function checkrow(){
		echo $this->twitemodel->getRow(0)->content;
		echo $this->twitemodel->getRow(1)->content;
		echo $this->twitemodel->getRow(2)->content;
		echo $this->twitemodel->getRow(3)->content;
	}

	function checkrand(){
		$this->load->helper('date');
		//echo  unix_to_human(time());
		//echo date('Y-m-d H:i:s');
		echo $numberOfRows = $this->twitemodel->getTwiteNumber();
		//echo "this is number of inserted twitter: ". $numberOfRows . " and this is random numbers: " . rand(1,$numberOfRows ). " " .rand(1, $numberOfRows) . " " . rand(1, $numberOfRows) . " " . rand(1, $numberOfRows) ." " ;	
	}
	function checktime(){
		$this->load->helper('date');
		echo date('Y-m-d');


	}



}
