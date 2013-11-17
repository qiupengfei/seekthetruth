<?php
class Users_model extends CI_Model {



    function __construct()
    {
        parent::__construct();
    }
    
    function add($arr)
    {		
        $this->db->insert('users', $arr);
	}
	function select($id)
	{
		$this->db->where('userid',$id);
		$this->db->select('*');
		$query=$this->db->get('users');
		return $query->result();
	}
	function update($id,$arr)
	{
		$this->db->where('userid',$id);
		$this->db->update('users',$arr);
	}
	
}
?>
