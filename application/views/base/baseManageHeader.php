<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/foundation.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/foundation-icons.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/normalize.css')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/knowlinux.css')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/manage.css')?>">
	<link rel="icon" href="<?php echo base_url('assets/img/linuxourse-logo-black.png')?>">
	<script type="text/javascript" src="<?php echo base_url('assets/js/vendor/modernizr.js')?>"></script>
	<script src="<?php echo base_url('assets/js/vendor/jquery.js')?>"></script>
	<?php
	//custom js setup
	if(!empty($script)){
	echo $script;//if add custom js scrript
}
?>
<title>
	<?php
		//title setup
	if(!empty($title)){
		echo $title.' :: LINUXOURSE';
	} else {
		echo 'FOSSIL Linux Ecourse';
	}
	?>
</title>
</head>
<body>
	<!-- custom modal -->
	<div id="customModal" class="reveal-modal small" data-reveal>
		<h2>Linux Ecourse</h2>
		<p class="lead">You're now students</p>
		<p>you can login using email and password which you have made!</p>
		<a class="close-reveal-modal">&#215;</a>
	</div>
	<!-- header -->
	<section style="position:absolute" id="home_header">
		<div style="min-width:100%" class="row header">
			<div class="small-12 large-10 large-push-1 columns">
				<div class="small-12 columns">
					<center>
					<a href="<?php echo site_url('manage')?>"><div class="logo"></div></a>
					</center>
				</div>
			</div>
		</div>
	</section>
	<section class="divideroftopmenu"></section>