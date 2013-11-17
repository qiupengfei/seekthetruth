<?php
class Truth_model extends CI_Model {



    function __construct()
    {
        parent::__construct();
    }
    
    function add($arr)
    {
        $this->db->insert('truth', $arr);
	}
	
	function getall()
	{
		
		$this->db->select('*');
		$query=$this->db->get('truth');
		return $query->result();
	}
}
?>