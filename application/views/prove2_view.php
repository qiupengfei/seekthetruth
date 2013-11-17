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

<?=form_open('evidence_controller/add')?>
<table>
		<?=form_input('uid')?>
		<?=form_input('id')?>是否为真相
		<?=form_input('boolx')?>
		<?=form_submit('submit', '提交证据')?>
	
</table>
</form>


<?php foreach( $sb as $item ): ?>
<?php
echo $item->weiboid;
$x= $c->show_status($item->weiboid);
echo $x['text'];

echo "</br>";
?>
<?php endforeach; ?>

