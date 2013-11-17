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

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" class="no-js">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="IE=edge" http-equiv="X-UA-Compatible" />
<meta name="copyright" content="Copyright (c) AcFun" />
<!--style-->
<link id="sanae" rel="stylesheet" href="http://static.acfun.tv/dotnet/20130418/style/core.css?date=09150059" /><!--<link rel="stylesheet/less" href="/dotnet/date/style/member/style.less?date=﻿11151237" />
<script src="/dotnet/date/script/less.min.js"></script>-->
<link rel="stylesheet" href="/dotnet/date/style/member/style.css?date=﻿11151237" />
<!--style-->
</head>

<body>
<div id="stage" class="location-member"><!--Stage-->

    <div id="area-info"></div><!--Info Area-->
    <div id="area-window"><!--Window Area-->
        <div id="win-info" class="win"><div class="mainer"></div></div><!--Window Info-->
        <div id="win-hint" class="win win-hint"><div class="mainer"></div><div class="tail"></div></div><!--Window Hint-->
    </div><!--Window Area-->
    
    <div id="guide-space"></div>
    <span class="clearfix"></span>
    
    <div id="mainer"><!--Mainer-->
        <div id="mainer-inner"><!--Inner-->
        
        	<div id="block-main">
            	
                                                         
                                <span class="hint">
                            <?=form_open('Dealing_controller/seek')?>
<table>
	<tr>
		<td></td>
		<td><?=form_submit('submit', '查看好友的最新微博')?></td>
	</tr>
</table>
</form></span>
                            
                                
                                <span class="hint"><?=form_open('Dealing_controller/prove')?>
<table>
	<tr>
		<td></td>
		<td><?=form_submit('submit', '选择分类')?></td>
	</tr>
	<tr>
	<td></td>
	<td>
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
		</td>
		</tr>
</table>
</form></span>
                           
                           
                                
                                <span class="hint"><?=form_open('Dealing_controller/prove2')?>
<table>
	
	<tr>
		<td></td>
		<td><?=form_submit('submit', '系统推荐（根据用户兴趣）')?></td>
	</tr>
</table>
</form></span>
								
								 <span class="hint"><?=form_open('Dealing_controller/check')?>
<table>
	<tr>
		<td></td>
		<td><?=form_submit('submit', '已证实的问题')?></td>
	</tr>
</table>
</form></span>
								 
								  <span class="hint"><?php $user1=array('id'=>$uid);?>
<?=form_open('Dealing_controller/userchenghao','',$user1)?>
<table>

		
	<tr>
		<td></td>
		<td><?=form_submit('submit', '查看已获得的称号')?></td>
	</tr>
</table>
</form></span>
								  
								   <span class="hint"><?=form_open('Dealing_controller/userxingqu','',$user1)?>
<table>
	
	<tr>
		<td></td>
		<td><?=form_submit('submit', '兴趣信息（系统判定）')?></td>
	</tr>
</table>
</form></span>

<!--script-->
<!--[if lt IE 8]>
<script src="http://static.acfun.tv/dotnet/20130418/script/json2.js"></script>
<![endif]-->

</body>
</html>