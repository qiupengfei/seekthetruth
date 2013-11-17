<?php 

class Question_controller extends CI_Controller {


	function __construct()
	{
		parent::__construct();		
	}
	
	function add()
	{
		$this->load->model('question_model');
		$re=$this->question_model->select($_POST['id']);
		if(count($re)==0)
		{
			$arr=array('weiboid'=>$_POST['id'],'value'=>1,'type'=>$_POST['type']);
			$this->question_model->add($arr);
		}
		else
		{
			$arr=array('value'=>($re[0]->value+1));
			$this->question_model->update($_POST['id'],$arr);
		}
		//------------------------------------------------------
		$this->load->model('user_question_model');
		$arr=array('weiboid'=>$_POST['id'],'userid'=>$_POST['uid']);
		$this->user_question_model->add($arr);
		//--------------------------------------------------
		$this->load->model('users_model');
		$re=$this->users_model->select($_POST['uid']);
		if(count($re)==0)
		{
			$arr=array('userid'=>$_POST['uid'],'joy'=>0,'electric'=>0,'food'=>0,'clothes'=>0,'book'=>0,'pe'=>0,'study'=>0,'international'=>0);
			if($_POST['type']=='joy')
				$arr['joy']=1;
			if($_POST['type']=='electric')
				$arr['electric']=1;
			if($_POST['type']=='food')
				$arr['food']=1;
			if($_POST['type']=='clothes')
				$arr['clothes']=1;
			if($_POST['type']=='book')
				$arr['book']=1;
			if($_POST['type']=='pe')
				$arr['pe']=1;
			if($_POST['type']=='study')
				$arr['study']=1;
			if($_POST['type']=='international')
				$arr['international']=1;
			$this->users_model->add($arr);
		}
		else
		{
			if($_POST['type']=='joy')
				$arr1['joy']=1;
			if($_POST['type']=='electric')
				$arr1['electric']=1;
			if($_POST['type']=='food')
				$arr1['food']=1;
			if($_POST['type']=='clothes')
				$arr1['clothes']=1;
			if($_POST['type']=='book')
				$arr1['book']=1;
			if($_POST['type']=='pe')
				$arr1['pe']=1;
			if($_POST['type']=='study')
				$arr1['study']=1;
			if($_POST['type']=='international')
				$arr1['international']=1;
			$this->users_model->update($_POST['uid'],$arr1);
		}
		
		//--------------------------------------
		$re=$this->question_model->select($_POST['id']);
		if($re[0]->value>=2)
		{
				session_start();

				include_once( 'config.php' );
				include_once( 'saetv2.ex.class.php' );

				//从POST过来的signed_request中提取oauth2信息
				if(!empty($_REQUEST["signed_request"]))
				{
						$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY  );
					$data=$o->parseSignedRequest($_REQUEST["signed_request"]);
					if($data=='-2')
					{
						die('签名错误!');
					}
					else
					{
						$_SESSION['oauth2']=$data;
					}
				}
				//判断用户是否授权
				if (empty($_SESSION['oauth2']["user_id"])) 
				{
				include "auth.php";
				exit;
				} 
				else 
				{
					$c = new SaeTClientV2( WB_AKEY , WB_SKEY ,$_SESSION['oauth2']['oauth_token'] ,'' );
				}		 

		
			//--------------------
			$this->question_model->delete($_POST['id']);
			//-----------------------
			$this->load->model('user_evidence_model');
			$arr2=$this->user_evidence_model->select($_POST['id']);
			$i=0;
			$j=0;
			foreach ($arr2 as $item):
			{
				if(($item->boolx)=='真')
					$i=$i+1;
				else
					$j=$j+1;
			}
			endforeach;
			if($j>=$i)
			{
			$arr3=array('weiboid'=>$_POST['id'],'boolx'=>'假');
			//-------------------------------
				$qw=$c->show_status($_POST['id']);
				$er=$qw['user']['id'];
				
				$re=$this->users_model->select($er);
				if(count($re)==0)
				{
					$arr=array('userid'=>$er,'joy'=>0,'electric'=>0,'food'=>0,'clothes'=>0,'book'=>0,'pe'=>0,'study'=>0,'international'=>0,'truthdaren'=>0,'zydaren'=>1,'bldaren'=>0);
					$this->users_model->add($arr);
				}
				else
				{
					$arr1=array('zydaren'=>1);
					$this->users_model->update($er,$arr1);
				}
			//------------------------------------
				$re3=$this->user_evidence_model->selectfromboolx($_POST['id'],'假');
				foreach ($re3 as $item):
				{
					$re4=$this->users_model->select($item->userid);	
					if(count($re4)==0)
					{
						$arr=array('userid'=>$item->userid,'joy'=>0,'electric'=>0,'food'=>0,'clothes'=>0,'book'=>0,'pe'=>0,'study'=>0,'international'=>0,'truthdaren'=>1,'zydaren'=>0,'bldaren'=>0);
						$this->users_model->add($arr);
					}
					else
					{
						$arr1=array('truthdaren'=>1);
						$this->users_model->update($item->userid,$arr1);
					}
				}
				endforeach;
			//----------------------------------------
			}
			else
			{
				$arr3=array('weiboid'=>$_POST['id'],'boolx'=>'真');
				//---------------------------------
				$qw=$c->show_status($_POST['id']);
				$er=$qw['user']['id'];
				
				$re=$this->users_model->select($er);
				if(count($re)==0)
				{
					$arr=array('userid'=>$er,'joy'=>0,'electric'=>0,'food'=>0,'clothes'=>0,'book'=>0,'pe'=>0,'study'=>0,'international'=>0,'truthdaren'=>0,'zydaren'=>0,'bldaren'=>1);
					$this->users_model->add($arr);
				}
				else
				{
					$arr1=array('bldaren'=>1);
					$this->users_model->update($er,$arr1);
				}
				//--------------------------
				$re3=$this->user_evidence_model->selectfromboolx($_POST['id'],'真');
				foreach ($re3 as $item):
				{
					$re4=$this->users_model->select($item->userid);	
					if(count($re4)==0)
					{
						$arr=array('userid'=>$item->userid,'joy'=>0,'electric'=>0,'food'=>0,'clothes'=>0,'book'=>0,'pe'=>0,'study'=>0,'international'=>0,'truthdaren'=>1,'zydaren'=>0,'bldaren'=>0);
						$this->users_model->add($arr);
					}
					else
					{
						$arr1=array('truthdaren'=>1);
						$this->users_model->update($item->userid,$arr1);
					}
				}
				endforeach;
				//------------------------
			}
			$this->load->model('truth_model');
			$this->truth_model->add($arr3);
			//---------------------------
			
			//-----------------------------
		}
		$this->load->view('congratulation');
	}

}
?>