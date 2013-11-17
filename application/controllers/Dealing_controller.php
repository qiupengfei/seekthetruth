<?php 

class Dealing_controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
	}
	
	function seek()
	{
		$this->load->view('seek_view');
	}

	function prove()
	{
		$this->load->model('question_model');
		$data['sb']=$this->question_model->selectfromtype($_POST['type']);
		$this->load->view('prove_view',$data);
	}
	function prove2()
	{
		$this->load->model('users_model');
		
	}
	function check()
	{
		$this->load->model('truth_model');
		$data['s']=$this->truth_model->getall();
		$this->load->view('check_view',$data);
	}
	function userchenghao()
	{
		$this->load->model('users_model');
		$q=$this->users_model->select($_POST['id']);
		$arr=array('user'=>$q);
		$this->load->view('userchenghao_view',$arr);
	}
	function userxingqu()
	{
		$this->load->model('users_model');
		$q=$this->users_model->select($_POST['id']);
		$arr=array('user'=>$q);
		$this->load->view('userinter_view',$arr);
	}
}
?>