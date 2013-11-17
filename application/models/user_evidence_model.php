<?php
class User_evidence_model extends CI_Model {



    function __construct()
    {
        parent::__construct();
    }
    
    function add($arr)
    {
        $this->db->insert('user_evidence', $arr);
	}
	function select($id)
	{
		$this->db->where('weiboid',$id);
		$this->db->select('*');
		$query=$this->db->get('user_evidence');
		return $query->result();
	}
	function selectfromboolx($weiboid,$boolx)
	{
		$this->db->where('weiboid',$weiboid,'boolx',$boolx);
		$this->db->select('*');
		$query=$this->db->get('user_evidence');
		return $query->result();
	}
}
?>