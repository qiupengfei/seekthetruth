<?php
class User_question_model extends CI_Model {



    function __construct()
    {
        parent::__construct();
    }
    
    function add($arr)
    {		
        $this->db->insert('user_question', $arr);
	}
	
	
}
?>
