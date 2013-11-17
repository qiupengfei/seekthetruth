<?php 

class Evidence_controller extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		
	}
	
	function add()
	{
		$this->load->model('user_evidence_model');
		$arr=array('userid'=>$_POST['uid'],'weiboid'=>$_POST['id'],'boolx'=>'真');
		$this->user_evidence_model->add($arr);
		
		//-----------------------------------------------
		$this->load->model('users_model');
		$re=$this->users_model->select($_POST['uid']);
		
		$this->load->model('question_model');
		$re1=$this->question_model->select($_POST['id']);
		$query=$re1[0]->type;
		if(count($re)==0)
		{
			$arr=array('userid'=>$_POST['uid'],'joy'=>0,'electric'=>0,'food'=>0,'clothes'=>0,'book'=>0,'pe'=>0,'study'=>0,'international'=>0);
			if($query=='joy')
				$arr['joy']=1;
			if($query=='electric')
				$arr['electric']=1;
			if($query=='food')
				$arr['food']=1;
			if($query=='clothes')
				$arr['clothes']=1;
			if($query=='book')
				$arr['book']=1;
			if($query=='pe')
				$arr['pe']=1;
			if($query=='study')
				$arr['study']=1;
			if($query=='international')
				$arr['international']=1;
			$this->users_model->add($arr);
		}
		else
		{
			if($query=='joy')
				$arr1['joy']=1;
			if($query=='electric')
				$arr1['electric']=1;
			if($query=='food')
				$arr1['food']=1;
			if($query=='clothes')
				$arr1['clothes']=1;
			if($query=='book')
				$arr1['book']=1;
			if($query=='pe')
				$arr1['pe']=1;
			if($query=='study')
				$arr1['study']=1;
			if($query=='international')
				$arr1['international']=1;
			$this->users_model->update($_POST['uid'],$arr1);
		}
		
		$this->load->view('upload_view');
	}
	
	function add2()
	{
		$this->load->model('user_evidence_model');
		$arr=array('userid'=>$_POST['uid'],'weiboid'=>$_POST['id'],'boolx'=>'假');
		$this->user_evidence_model->add($arr);
		
		//-----------------------------------------------
		$this->load->model('users_model');
		$re=$this->users_model->select($_POST['uid']);
		
		$this->load->model('question_model');
		$re1=$this->question_model->select($_POST['id']);
		$query=$re1[0]->type;
		if(count($re)==0)
		{
			$arr=array('userid'=>$_POST['uid'],'joy'=>0,'electric'=>0,'food'=>0,'clothes'=>0,'book'=>0,'pe'=>0,'study'=>0,'international'=>0);
			if($query=='joy')
				$arr['joy']=1;
			if($query=='electric')
				$arr['electric']=1;
			if($query=='food')
				$arr['food']=1;
			if($query=='clothes')
				$arr['clothes']=1;
			if($query=='book')
				$arr['book']=1;
			if($query=='pe')
				$arr['pe']=1;
			if($query=='study')
				$arr['study']=1;
			if($query=='international')
				$arr['international']=1;
			$this->users_model->add($arr);
		}
		else
		{
			if($query=='joy')
				$arr1['joy']=1;
			if($query=='electric')
				$arr1['electric']=1;
			if($query=='food')
				$arr1['food']=1;
			if($query=='clothes')
				$arr1['clothes']=1;
			if($query=='book')
				$arr1['book']=1;
			if($query=='pe')
				$arr1['pe']=1;
			if($query=='study')
				$arr1['study']=1;
			if($query=='international')
				$arr1['international']=1;
			$this->users_model->update($_POST['uid'],$arr1);
		}
		
		$this->load->view('upload_view');
	}
	function end()
	{
		$this->load->view('congratulation2');
	}

}
?>