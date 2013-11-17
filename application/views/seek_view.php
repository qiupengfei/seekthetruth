<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎到哈工大读研读博，困难不怕，哈工大是家-邱朋飞</title>
<style text="text/css">
	.main
	{
		width: 60%;
		height: 100%;
		border: 1px solid red;
		border-radius: 5px;
		margin-top: 1px;
		margin-right: 20%;
		margin-bottom: 1;
		margin-left: 20%;
		background-color: #CC9900;
		background-image: url(original_jelS_0d0800036c7c1190.jpg);
	}
	.first
	{
		width: 90%;
		height: 200px;
		border: 1px solid blue;
		border-radius: 5px;
		margin-top: 0;
		margin-right: 5%;
		margin-bottom: 0;
		margin-left: 5%;
		background-color: #CCCC99;
	}
	#form1
	{
	background-color: #090;
	margin-top: 1%;
	margin-right: 5%;
	margin-bottom: 1%;
	margin-left: 5%;
	}
</style>

</head>
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

		$ms  = $c->home_timeline();
		$fq=$c->get_uid();
		$uid= $fq['uid'];
?>
<body>
<?=anchor('', 'HOME')?><br/>


<?php if( is_array( $ms['statuses'] ) ): ?>
<div class="main">
<?php foreach( $ms['statuses'] as $item ): ?>
<?php $qiu=array('id'=>$item['id'],'uid'=>$uid); ?>
<?=form_open('question_controller/add','',$qiu)?>
    <div class="first">
	 	<div align="center">
            <form action="" method="get" enctype="multipart/form-data" name="要提交判断真假的微博显示框" id="form1">
             	<div align="center">
          			<textarea name="显示要提交的微博内容" cols="48" rows="11" readonly="readonly" id="weiboinfo1">
<?=$item['text'];?>                     
                    </textarea>
        		</div>
         	</form>
        </div> 	
		<div align="center">
            <select name="type">
                <option value="joy">娱乐</option>
                <option value="electric">电子科技</option>
                <option value="food">美食</option>
                <option value="clothes">服装</option>
                <option value="book">图书</option>
                <option value="pe">体育</option>
                <option value="study">教育</option>
                <option value="international">国际</option>
            
            </select>
            <?=form_submit('submit', '提交')?>
		</div>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>
</body>
</html>