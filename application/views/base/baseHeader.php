<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/foundation.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/foundation-icons.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/normalize.css')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/knowlinux.css')?>">
	<link rel="icon" href="<?php echo base_url('assets/img/favicon.png')?>">
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
		echo $title.' :: FOSSIL Linux Ecourse';
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
	<section id="home_header">
		<div style="min-width:100%" class="row header">
			<div class="small-12 large-10 large-push-1 columns">
				<div class="small-3 columns">
					<a href="<?php echo site_url()?>"><div class="logo"></div></a>
				</div>
				<div class="small-9 columns">
					<ul style="float:right;padding-top:10px" class="inline-list">
						<li><a style="margin-top: 4px;" href="<?php echo site_url()?>">Home</a></li>
						<li><a style="margin-top: 4px;" href="<?php echo site_url('news')?>">News</a></li>
						<li><a style="margin-top: 4px;" href="<?php echo site_url('news/read/TWc9PQ/Help')?>">Help</a></li>
						<li><a style="margin-top: 4px;" href="<?php echo site_url('news/read/TVE9PQ/About')?>">About</a></li>
						<?php if(!empty($this->session->userdata['student_login']['id_user'])){ 
							if(!empty($this->session->userdata['student_login']['pp'])){
								$src = base_url('assets/img/avatar/'.$this->session->userdata['student_login']['pp']);
							} else {
								$src = base_url('assets/img/avatar.png');
							}
							?>
							<li><a href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="false" class="secondary dropdown has-dropdown not-click"><img style="width:30px;border-radius:30px" src="<?php echo $src?>"/></a>
								<ul id="drop1" data-dropdown-content class="dropdownme f-dropdown" aria-hidden="true" tabindex="-1">
									<li><a href="<?php echo site_url('student/v/'.$this->session->userdata['student_login']['username']);?>"><strong><?php echo $this->session->userdata['student_login']['username'];?></strong><br/><small>my profile page</small></a></li>
									<li><a href="<?php echo site_url('m/edit')?>"><span class="fi-widget"></span>  update profile</a></li>
									<li><a href="<?php echo site_url('m/logout')?>"><span class="fi-x-circle"></span> logout</a></li>
								</ul>
							</li>
							<?php }	?>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<section class="divideroftopmenu"></section>