<?php
class Twitemodel extends CI_Model {
	
	public function __construct(){

		$this->load->database();
	}
	
	function twitterExists($t_id){

		$this->db->from("twite");
		$this->db->where("t_id", $t_id);
		$count = $this->db->count_all_results();
		if($count == 0)
			return False;
		else return True;
	}
	
	function addTwitter($content){

		$data = array(
		  'content' => $content
		);

		$query = $this->db->insert('twite', $data);
		return $query;
	}

        public function getRow($num){

                $query = $this->db->get('twite');
                return $query->row($num);
        }

	public function getTwiteNumber(){
		
		return $this->db->get('twite')->num_rows();
	}
};
