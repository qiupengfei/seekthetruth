<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎到哈工大读研读博，困难不怕，哈工大是家-邱朋飞</title>
<style text="text/css">
	.main
	{
		width: 60%;
		height: 1200px;
		border: 1px solid red;
		border-radius: 5px;
		margin-top: 1px;
		margin-right: 20%;
		margin-bottom: 1px;
		margin-left: 20%;
		background-color: #3399FF;
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
		background-color: #6F0;
	}
	.second
	{
	width: 40%;
	height: 120px;
	border: 1px solid blue;
	border-radius: 5px;
	margin-top: 0;
	margin-right: 10%;
	margin-bottom: 0;
	margin-left: 10%;
	background-color: #3C6;
	}
	#form1
	{
	background-color: #090;
	margin-top: 1%;
	margin-right: 5%;
	margin-bottom: 10%;
	margin-left: 5%;
	}
</style>
    <link href="application/views/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="application/views/SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
</head>
<body>
<div class="main">
    <div class="first">
 	  	<div align="center">
          	<form action="" method="get" enctype="multipart/form-data" name="form1" id="form1">
              	<div align="center">
                	<textarea name="要提交证据的微博信息" cols="48" rows="11" readonly="readonly" id="weiboinfofortruth"></textarea>
              	</div>
       	  </form>
  		</div>
  	</div>
  	<div align="center">
    	你的理由
        <div class="second">
            <div id="TabbedPanels1" class="TabbedPanels">
              <ul class="TabbedPanelsTabGroup" >
                <li class="TabbedPanelsTab" tabindex="0">文字证据</li>
                <li class="TabbedPanelsTab" tabindex="0">图片证据</li>
                <li class="TabbedPanelsTab" tabindex="0">视频证据</li>
              </ul>
              <div class="TabbedPanelsContentGroup">
                <div class="TabbedPanelsContent">
                  <textarea name="文字证据" cols="32" rows="5" id="wordtruth"></textarea>
                </div>
                <div class="TabbedPanelsContent">
                  <input type="file" name="图片证据" id="phototruth" />
                </div>
                <div class="TabbedPanelsContent">
                  <input type="file" name="视频证据" id="videotruth" />
                </div>
              </div>
   	  		</div>
        </div>
  	</div>
  	<label for="wenzi"></label>
  	<div align="center"></div>
		<p align="center">
			<?=form_open('evidence_controller/end')?>
			<?=form_submit('submit', '提交')?>
  		</p>
	</div>
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
</script>
</body>
</html>
