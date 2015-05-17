<?php
class Questionmodel extends CI_Model {

	public function __construct(){

		$this->load->database();
	}
        
	public function getNewQuestion(){

                 return $this->db->get('question')->row();
        }

        public function getRow($num){

                $query = $this->db->get('question');
                return $query->row($num);
        }
};
