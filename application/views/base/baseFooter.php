<!-- footer -->
<section id="footer">
<div style="min-width:80%" class="row">
		<div class="large-3 medium-3 columns">
			<h3 class="menu-title">Navigation</h3>
			<p><a href="#">home</a></p>
			<p><a href="#">help</a></li><p/>
			<p><a href="#">about</a></li><p/>
			<p><a href="#">register</a></li><p/>
			<p><a href="#">login</a></li><p/>
			<p><a href="<?php echo site_url('news')?>">news</a></li><p/>
			<p><a href="#">error report</a></li><p/>
		</div>
		<div class="large-3 medium-3 columns">
			<h3 class="menu-title">Course Materi</h3>
			<?php
			$course = $this->m_course->showAllMateri();
			foreach($course as $c):
			$encid = base64_encode(base64_encode($c['id_materi']));
			$idmateri = str_replace('=', '', $encid);
			?>
			<p><a href="<?php echo site_url('course/review/'.$idmateri)?>"><?php echo $c['title'];?></a></p>
			<?php endforeach;?>
		</div>
		<div class="large-3 medium-3 columns">
			<h3 class="menu-title">Importand</h3>
			<p><a href="#" data-reveal-id="verificationModal">email verification</a></p>
			<p><a href="<?php echo site_url('news/read/TkE9PQ/Locked-Content')?>">faq</a></p>
			<p><a href="<?php echo site_url('news/read/TXc9PQ/Terms-And-Conditions')?>">terms and conditions</a></p>
			<p><a href="<?php echo site_url('news/read/TkE9PQ/Locked-Content')?>">locked content</a></p>			
		</div>
		<div class="large-3 medium-3 columns">
			<img style="height:100%px" src="<?php echo base_url('assets/img/linuxourse-logo-black.png')?>"/><br/>
			<strong>Linux e-Course</strong><br/>
			copyright &copy; 2014 Yussan<br/>
			Suported by FOSSIL
		</div>
	</div>
</section>
<!-- verification modal -->
<div id="verificationModal" class="reveal-modal tiny" data-reveal>
  <h2>Resend Email Verification Code</h2>
  <p class="lead">input your email used for registration below.</p>
  <form method="POST" action="<?php echo site_url('p/sendVerification');?> ">
  	<input type="text" name="inputemail" placeholder="input email">
  	<button class="tiny" style="color:#fff" type="submit">submit</button>
  </form>
 <a class="close-reveal-modal">&#215;</a>
</div>
<!-- end of verification modal -->
<script type="text/javascript">
	//by yussan
	
</script>
<script src="<?php echo base_url('assets/js/foundation.min.js')?>"></script>
	<script>
		$(document).foundation();
	</script>
<!--<script src="<?php echo base_url('assets/js/vendor/fastclick.js')?>"></script>-->
</body>
</html>