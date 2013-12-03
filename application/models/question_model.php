<?php
class Question_model extends CI_Model {



    function __construct()
    {
        parent::__construct();
		
    }
    
    function add($arr)
    {		
        $this->db->insert('question', $arr);
	}
	function select($id)
	{
		
		$this->db->where('weiboid',$id);
		$this->db->select('*');
		$query=$this->db->get('question');
		return $query->result();
		
	}
	function selectfromtype($type)
	{
		$this->db->where('type',$type);
		$this->db->select('*');
		$query=$this->db->get('question');
		return $query->result();
	}
	function update($id,$arr)
	{
		$this->db->where('weiboid',$id);
		$this->db->update('question',$arr);
	}
	function delete($id)
	{
		$this->db->where('weiboid',$id);	
		$this->db->delete('question');
	}
	
}
?>
