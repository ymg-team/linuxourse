<!-- footer -->
<section id="footer">
<div style="min-width:80%" class="row">
		<div class="large-3 columns">
			<img style="width:80px" src="<?php echo base_url('assets/img/second-logo.jpg')?>"/>		<br/>

		</div>
		<div class="large-2 medium-2 columns">
			<h3 class="menu-title">Navigation</h3>
			<p><a href="#">home</a></p>
			<p><a href="#">help</a></li><p/>
			<p><a href="#">about</a></li><p/>
			<p><a href="#">register</a></li><p/>
			<p><a href="#">login</a></li><p/>
			<p><a href="<?php echo site_url('news')?>">news</a></li><p/>
			<p><a href="#">error report</a></li><p/>
		</div>
		<div class="large-2 medium-2 columns">
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
		<div class="large-2 medium-2 columns">
			<h3 class="menu-title">Course Materi</h3>
			<p><a href="#">home</a></p>
			<p><a href="#">help</a></li><p/>
			<p><a href="#">about</a></li><p/>
			<p><a href="#">register</a></li><p/>
			<p><a href="#">login</a></li><p/>
			<p><a href="#">error report</a></li><p/>
		</div>
		<div class="large-3 medium-3 columns">
			<strong>Linux e-Course</strong><br/>
			copyright &copy; 2014 FOSSIL
		</div>
	</div>
</section>
<script src="<?php echo base_url('assets/js/foundation.min.js')?>"></script>
	<script>
		$(document).foundation();
	</script>
<!--<script src="<?php echo base_url('assets/js/vendor/fastclick.js')?>"></script>-->
</body>
</html>