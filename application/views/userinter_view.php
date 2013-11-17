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

<?php
	if($user[0]->joy==1)
		echo "娱乐";
	echo "</br>";
	
	if($user[0]->electric==1)
		echo "电子科技";
	echo "</br>";
	
	if($user[0]->food==1)
		echo "美食";
	
	if($user[0]->clothes==1)
		echo "服装";
	if($user[0]->book==1)
		echo "书籍";
		
	if($user[0]->pe==1)
		echo "体育";
	if($user[0]->study==1)
		echo "教育";
	if($user[0]->international==1)
		echo "国际";
	echo "</br>";
?>