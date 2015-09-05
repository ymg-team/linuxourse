<!DOCTYPE html>
<html>
<head>
	<title>Linuxourse</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/foundation.css');?>" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/foundation-icons.css');?>" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/normalize.css')?>" media="screen">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/knowlinux.css')?>">
	<link rel="icon" href="<?php echo base_url('assets/img/linuxourse-logo-black.png')?>">
	<script type="text/javascript" src="<?php echo base_url('assets/js/linuxourse.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/vendor/modernizr.js')?>"></script>
	<script src="<?php echo base_url('assets/js/vendor/jquery.js')?>"></script>
</head>
<body>
<!-- navbar -->
<nav id="navbar" class="home-navbar top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="http://linuxourse.me">LINUXOURSE</a></h1>
    </li>
     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>

  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
      <li><a href="<?php echo base_url('p/login');?>"><span class="fi-key"></span> Login</a></li>
    </ul>

    <!-- Left Nav Section -->
    <ul class="left show-for-large-up">
      <li><a href="#">About</a></li>
      <li class="has-dropdown">
        <a href="#">Navigation</a>
        <ul class="dropdown">
          <li><a href="<?php echo base_url('discussion/all'); ?>">Discussion</a></li>
          <li><a href="#">Material</a></li>
          <li><a href="<?php echo base_url('news')?>">News</a></li>
          <li><a href="http://linuxourse.me/news/read/TWc9PQ/Help">Help</a></li>
          <li><a href="https://linuxourse.me/news/read/TVE9PQ/About">About</a></li>
        </ul>
      </li>
    </ul>
     <ul class="left hide-for-large-up">
      <li><a href="#">About</a></li>
      <li class="has-dropdown">
        <a href="#">Navigation</a>
        <ul class="dropdown">
          <li><a href="<?php echo base_url('discussion/all'); ?>">Discussion</a></li>
          <li><a href="#">Material</a></li>
          <li><a href="<?php echo base_url('news')?>">News</a></li>
          <li><a href="http://linuxourse.me/news/read/TWc9PQ/Help">Help</a></li>
          <li><a href="https://linuxourse.me/news/read/TVE9PQ/About">About</a></li>
        </ul>
      </li>
    </ul>
  </section>
</nav>
<!-- end of navbar -->
<!-- cover -->
<div style="background-size:cover;background-image: url('<?php echo base_url('assets/img/cover-blur.png');?>')" class="home-cover">
<nav style="display:block;height:30%"></nav>
	<div class="row">
		<center>
		<span class="super-center">
		<h2>Learning Linux Without Install Linux</h2>
		<h1>Linuxourse</h1>
		<p>For Free. For Everyone. Forever</p>
		<a style="border:2px solid #008CBA;font-weight:bold" href="<?php echo site_url('/p/register');?>" class="button button-cover">Getting Start</a><br/>
		<a href="http://linuxourse.me/news/read/TVE9PQ/About" class="button button-transparent button-cover">About</a>
		</span>
		</center>
	</div>
</div>
<!-- end of cover -->
<!-- materi -->
<section id="otherCourse">
	<div class="row">
	<center>
		<h2>What Will You Learn</h2>
		<br/><br/>
		<div class="small-3 columns">
			<a href="#" class="button button-transparent button-circle-home"><span class="fi-anchor"></a>
			<p>Linux Introduction</p>
		</div>
		<div class="medium-3 columns">
			<a href="#" class="button button-transparent button-circle-home"><span class="fi-lock"></a>
			<p>Linux Shell and Command</p>
		</div>
		<div class="medium-3 columns">
			<a href="#" class="button button-transparent button-circle-home"><span class="fi-torsos"></a>
			<p>Learning Linux Together</p>
		</div>
		<div class="medium-3 columns">
			<a href="#" class="button button-transparent button-circle-home"><span class="fi-plus"></a>
			<p>create your own linux test</p>
		</div>
	</center>
	</span>
</section>
<section id="home-quote">
	<div class="row">
	<div style="padding-top:50px;padding-bottom:25px" class="medium-12 columns">
		<div class="home-quote-item medium-6 columns">
		<center><br/><span style="font-size:20em" class="fi-comment-quotes"></span></center>
		</div>
		<div style="float:left" class="home-quote-item medium-6 columns">
			<h2>Why Learning Linux</h2>
			<br/><br/>
			<p>
				Whether you know it or not you are already using Linux every day. Every time you use Google or Facebook or any other major Internet site, you are communicating with servers running Linux. Most DVRs, airplane and automobile entertainment systems and recent TVs run on Linux. Most ubiquitously, if you are using an Android phone, you are using a flavor of Linux.

				At its core, Linux is software used to control hardware like desktop and laptop computers, supercomputers, mobile devices, networking equipment, airplanes, and automobiles; the list is endless. Linux is everywhere. <a style="color:lightgray" target="_blank" href="https://www.edx.org/blog/why-learn-linux#.VIZXq-qUfHw">-www.edx.org-</a>
			</p>
		</div>
	</div>
	<div style="padding-top:50px;padding-bottom:25px" class="medium-12 columns">
		<div style="float:left;text-align:right;" class="home-quote-item medium-6 columns">
			<h2 style="margin-top:35px">Why Using Linuxourse</h2>
			<br/>
			<br/>
			<p>
				You can learn directly through the shell provided Linuxourse. We use materials from the scientific division FOSSIL which uses a standard of CompTIA LINUX.
You can complete the courses which have not been resolved today to continue the following day. Get digital certificate and a profile page which can be inserted into your CV.
			</p>
		</div>
		<div style="float:left" class="home-quote-item medium-6 columns">
			<center><img width="100%" src="<?php echo base_url('assets/img/mockup.png');?>"></center>
		</div>
	</div>
	</div>
</section>
<!-- end of materi -->
<!-- stats -->
<section id="home_user" style="background-image:url('cover-blur.png');opacity:3">
		<div class="row">
			<div class="large-4 columns">
				<center>
					<h5>Total Student</h5>
					<strong><h3>31</h3></strong>
				</center>
			</div>
			<div class="large-4 columns">
				<center>
					<h5>Total Materi</h5>
					<strong><h3>4</h3></strong>
				</center>
			</div>
			<div class="large-4 columns">
				<center>
					<h5>Total Course</h5>
					<strong><h3>46</h3></strong>
				</center>
			</div>
		</div>
	</section>
<!-- end of stats -->
<!-- javascript -->
<script>
	$(document).foundation();
</script>
<script type="text/javascript">
	$(document).ready(function()
		{
			var height = $(document).height()-$('#home_user').height() - $('#home_quote').height() - $('#otherCourse').height() - $('#footer').height() - 500;
			$('.home-cover').css('height',height);
			//navbar style
			$("#navbar").mouseenter(function(){whiteDiv();});
			$("#navbar").mouseleave(function(){transparentDiv();});
			//scroll
			$(window).scroll(function () {
			    if( $(window).scrollTop() > height ) {
			      whiteDiv();
			    } else {
			    	transparentDiv();
			    }
			  })
		});
	function whiteDiv()
	{
		$("#navbar").css({'background-color':'rgb(51, 51, 51)'});
	}
	function transparentDiv()
	{
		 $("#navbar").css({'background-color':'transparent'});
	}
</script>
</body>
</html>
