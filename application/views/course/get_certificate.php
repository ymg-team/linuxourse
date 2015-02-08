<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		@font-face {
			font-family: AftaSans;
			src: url("./assets/font/AftaSansThin-Regular.otf") format("opentype");
		}
		html{font-family: AftaSans;}
		h3,h1{line-height:0}
		h3{font-size: 45px;color:#848484;}
		h1{font-size: 70px;color:#666666;}
		.title{float:right;}
		.baseCertificate,.logo,.title{display:block;width:100%;}
		.baseCertificate{
			/*A4*/
			display: block;
			border:1px solid gray;
			width:100%;
			height:700px;
		}
		.logo{
			height:40px;
			float: left;
			padding:10px;
		}	
		.logo img{width:200px;}
		.title{
			height:180px;
			width: 100%;
			background-color: #f4f4f4;
		}
		.body{width:100%;margin-top:10px;padding:0 10px;font-size: 25px;color:#4d4d4d;line-height:2}
		.importand{font-weight: bold;font-size: 30px;color:#000;}
		.footer{
			width:100%;
			padding:10px;
		}
		.fotterleft{
			float:left;
			text-align: :left;
			width:50%;
		}
		.fotterright{
			float:right;
			width:250px;
		}
	</style>
	<title>Certificate</title>
</head>
<body>
	<div class="baseCertificate">
		<div class="logo">
			<img src="./assets/img/linuxourse-logo.png">
		</div>
		<div class="title">
			<span style="padding:10px;float:right;text-align:right">
				<h3>Certificate of</h3>
				<h1>Achievement</h1>
			</span>
		</div>
		<div class="body">
			<p>
				This certification accredits that<br>
				<span class="importand"><?php echo $detUserCourse['fullname']?></span><br/>
				has successfully completed the course materials<br>
				<span class="importand"><?php echo $detUserCourse['materititle']?></span><br/>
			</p>
		</div>
		<div class="footer">
			<div class="fotterleft">
				<p>Linuxourse Program<br/>Organized by</p>
				<img style="padding:5px;border:solid 1px gray" src="./assets/img/fossil-logo-landscape.png"/>
			</div>
			<div class="fotterright">
				<p><?php echo date('d M Y',strtotime($detUserCourse['lastdate']))?></p>
				<img style="height:85px;" src="./assets/img/signature/<?php echo $signature['signature']?>"/>
				<p style="width:90%;border-top:1px solid gray"><?php echo $signature['name']?><br/>FOSSIL <?php echo date('Y')?></p>
			</div>
		</div>
	</div>
</body>
</html>