<?php
class Answermodel extends CI_Model {

	public function __construct(){

		$this->load->database();
	}
	
	function addAnswer($user_id, $twite_id, $question_id, $time, $result){

		$data = array(
		  'q_id' => $question_id,
		  't_id' => $twite_id,
		  'u_id' => $user_id,
		  'time' => $time,
		  'result' => $result
		);

		$query = $this->db->insert('answer', $data);
		return $query;
	}

	public function getAnswer($q_id, $t_id, $u_id){

		$this->db->select('*');
		$this->db->from('answer');
		$this->db->where('q_id', $q_id);
		$this->db->where('t_id', $t_id);
		$this->db->where('u_id', $u_id);
		return $this->db->get()->row();
	}

	public function updateAnswer(){

		$this->db->select('*');
		$this->db->from('answer');
		$this->db->order_by("q_id", "asc");
		$query = $this->db->get();
		return $query;
	}

};
