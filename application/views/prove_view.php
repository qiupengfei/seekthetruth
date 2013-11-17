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
<?=anchor('', 'HOME')?>

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
<body>


<?php foreach( $sb as $item ): ?>
<div class="main">
	<div class="first">
		<div align="center">
            <form action="" method="get" enctype="multipart/form-data" name="form1" id="form1">
         		<textarea name="要求证微博真假的微博信息列表" cols="48" rows="10" readonly="readonly" id="weiboinfoseek1">
<?php
$x= $c->show_status($item->weiboid);
echo $x['text'];
$arr=array('uid'=>$uid,'id'=>$item->weiboid);
?>
                </textarea>
            </form>
        </div>
		<div align="center">
			<?=form_open('evidence_controller/add','',$arr)?>
			<?=form_submit('submit1', '真')?>
            <?=form_open('evidence_controller/add2','',$arr)?>
            <?=form_submit('submit2', '假')?>
		</div>
    </div>
</div>
<?php endforeach; ?>

</body>
</html>