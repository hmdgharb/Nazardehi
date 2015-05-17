<?php
class Usermodel extends CI_Model {

	public function __construct(){

		$this->load->database();
	}
	
	function userExists($email){

		$this->db->select("email");
		$this->db->from("user");
		$this->db->where("email", $email);
		$count = $this->db->count_all_results();
		if($count == 0)
			return False;
		else return True;
	}
	
	function addUser($email, $name, $s_number, $gender, $password, $group, $description, $time){

		$data = array(
		  'email' => $email,
		  'name' => $name,
		  's_number' => $s_number,
		  'gender' => $gender,
		  'password' => md5($password),
		  'group' => $group,
		  'description' => $description,
		  'time' => $time,
		  'isActive' => 0
		);

		$query = $this->db->insert('user', $data);
		return $query;
	}

	function checkPassword($email, $password){

		$this->db->select();
		$this->db->from('user');
		$this->db->where('email', $email);
		$this->db->where('password', md5($password));
		$count = $this->db->count_all_results();

		if($count == 0) return False;
		else return True;
	}

	function changePassword($email, $oldPassword, $newPassword){

		$check = $this->checkPassword($email, $oldPassword);

		if($check == FALSE) return FALSE;
		
		$data = array(
			'password', md5($newPassword)
		);
		
		$this->db->where('email', $email);
		$result = $this->db->update('user', $data);

		return $result;
	}

	public function getName($email){

		$this->db->select('name');
		$this->db->from('user');
		$this->db->where('email', $email);
		return  $this->db->get()->row(0, 'user')->name;
	}

	public function getUser($email){

		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email', $email);
		return $this->db->get()->row();
	}
	
	public function getGender($email){

		$this->db->select('gender');
		$this->db->from('user');
		$this->db->where('email', $email);
		return  $this->db->get()->row(0, 'user')->gender;
	}
	

	public function deleteUser($email){
		echo "this is your email " . $email . "\n "; 
		$this->db->delete('user', array('email' => $email)); 
	}

	function activateUser($email){// Checked
        	$data = array(
        	       'isActive' => 1,
        	);

        	$this->db->where('email', $email);
        	$this->db->update('user', $data);

    	}

	function checkVerified($email){
        
		$this->db->select();
        	$this->db->from('user');
        	$this->db->where('email', $email);
        	$this->db->where('isActive', 1);
        	$count = $this->db->count_all_results();

        	if($count == 0){
			echo $email . " is not actived";
        	    return FALSE;
        	}else{
			echo $email . " is actived";
        	    return TRUE;
        	}
    	}


	function confirmValidation($token, $email){//Checked
        
		$this->db->select();
        	$this->db->from("register_verf");
        	$this->db->where("email",$email);
        	$this->db->where("token",$token);
        	$count = $this->db->count_all_results();

		if($count == 0){
			return FALSE;
		}else{
            		$this->activateUser($email);
            		return TRUE;
        	}

    	}

    	function addVerificationToken($token, $email){//Checked
        	$data = array(
        		'email' => $email,
            		'token' => $token,
            		'timestamp' => round(microtime(true) * 1000)
            	);
        	$query = $this->db->insert('register_verf', $data);
        	
		return $query;
    	}
};
