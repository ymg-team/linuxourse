<script type="text/javascript">
	$(document).ready(function(){
		$("#btndown").click(function() {
			$('html, body').animate({
				scrollTop: $("#btndown").offset().top
			}, 800);
		});
		$(window).scroll(function(){
			if ($(this).scrollTop() > 100) {
				$("#btntop").fadeIn();
			} else {
				$("#btntop").fadeOut();
			}
		});

		$("#btntop").click(function(){
			$('html, body').animate({scrollTop : 0},800);
			return false;
		});
	});
</script>
<a class="button" style="display:none;padding:10px;position: fixed;right: 0;bottom: 0;" id="btntop"><span style="font-size:2rem"; class="fi-arrow-up"></span></a>

<!-- body -->
<section id="welcome">
	<div class="row">
		<div class="large-7 columns">
			<img style="width:90%;margin-top:50px" src="<?php echo base_url('assets/img/home-view.png')?>">
			<br/><br/>
			<div class="welcome_message">
				<h1 style="color:#fff">LINUXOURSE (BETA)</h1>
				<h5 style="color:#fff">Learn Linux Without Install Linux</h5>
			<hr/>
				<p>
					<!-- Belajar Linux dengan cara berbeda, hadapi kasusnya pecahkan dengan live command linux, jika anda berhasil lanjut ke level selanjutnya, setelah finish sebarkan profil anda ke publik untuk menunjukan kemampuan penggunaan linux anda. -->
					Learning Linux in a different way, to solve the case dealing with a live linux command, if you managed to go to the next level, after finishing the public to spread your profile to show your ability to use linux.
				</p>
			</div>
		</div>
		<div class="large-1 columns"><p></p></div>
		<div class="large-4 columns">
			<div class="home_login">
				<br/>
				<dl style="padding:0;border:1px solid #fff" class="tabs" data-tab>
					<dd style="padding:0;text-align:center;}" class="small-6 columns active"><a class="tab-home" role="tab" href="#register">Register</a></dd>
					<dd style="padding:0;text-align:center;}" class="small-6 columns"><a class="tab-home" role="tab" href="#login">Login</a></dd>
				</dl>
				<div style="padding:10px 20px;background-color:#fff" class="tabs-content">
					<!-- register -->
					<div class="content active" id="register">
						<form method="POST" action="<?php echo site_url('p/register');?>">
							<div class="row">
								<div class="large-12 columns">
									<input name="input_username" style="height:40px" type="text" placeholder="username" value="<?php if(!empty($username)){echo $username;}?>" required>
								</div>
							</div>
							<div class="row">
								<div class="large-12 columns">
									<input name="input_fullname" style="height:40px" type="text" placeholder="fullname" value="<?php if(!empty($username)){echo $fullname;}?>" required>
								</div>
							</div>
							<div class="row">
								<div class="large-12 columns">
									<input name="input_email" style="height:40px" type="email" placeholder="email" value="<?php if(!empty($username)){echo $email;}?>" required>
								</div>
							</div>
							<div class="row">
								<div class="large-12 columns">
									<input name="input_password" style="height:40px" type="password" placeholder="password"  required>
								</div>
							</div>
							<div class="row">
								<div class="large-12 columns">
									<input name="input_passconf" style="height:40px" type="password" placeholder="password again" required>
								</div>
							</div>
							<div style="padding:0" class="row">
								<div class="large-12 columns">
									<input style="margin:0;width:100%" class="button" type="submit" value="Register">
								</div>
							</div>
						</form>
						<table style="border:0;margin:0">
							<tr>
								<td><hr/></td>
								<td style="width:100px"><center><small>login/register via</small></center></td>
								<td><hr/></td>
							</tr>
						</table>
						<div class="row"></div>
						<a class="small-6 columns button" style="margin:0;background-color:rgb(77, 117, 202);display:block" href="<?php echo site_url('oauth/facebook/facebook.php')?>"><i style="font-size:20px;vertical-align:middle" class="fi-social-facebook"></i></a>
						<a class="small-6 columns button" style="margin:0;background-color:rgb(202, 77, 77);display:block" href="<?php echo site_url('oauth/googleplus')?>"><i style="font-size:20px;vertical-align:middle" class="fi-social-google-plus"></i></a>
						</div>
						<!-- end of register -->
						<!-- login -->
						<div class="content" id="login">
							<form method="POST" action="<?php echo site_url('p/login') ?>">
								<div class="row">
									<div class="large-12 columns">
										<input name="input_username" style="height:40px" type="text" placeholder="username" value="<?php if(!empty($_POST['input_username'])){echo $_POST['input_username'];}?>" required>
									</div>
								</div>
								<div class="row">
									<div class="large-12 columns">
										<input name="input_password" style="height:40px" type="password" placeholder="password" required>
									</div>
								</div>
								<div class="row">
									<div class="large-12 columns">
										<?php
										$error = validation_errors();
										if(!empty($error)){?>
										<small class="error"><?php echo $error;?></small>
										<?php }else if(!empty($error)){?>
										<small class="error"><?php echo $error;?></small>
										<?php }?>
										<input style="width:100%" class="button" type="submit" value="Login">
									</div>
								</div>
							</form>
							<table style="border:0;margin:0">
								<tr>
									<td><hr/></td>
									<td style="width:100px"><center><small>login/register via</small></center></td>
									<td><hr/></td>
								</tr>
							</table>
							<div class="row"></div>
							<a class="small-6 columns button" style="margin:0;background-color:rgb(77, 117, 202);display:block" href="<?php echo site_url('oauth/facebook/facebook.php')?>"><i style="font-size:20px;vertical-align:middle" class="fi-social-facebook"></i></a>
							<a class="small-6 columns button" style="margin:0;background-color:rgb(202, 77, 77);display:block" href="<?php echo site_url('oauth/googleplus')?>"><i style="font-size:20px;vertical-align:middle" class="fi-social-google-plus"></i></a>
						</div>
						<!-- start of login -->
					</div>
			</div>
		</div>
	</section>
	<section style="border-bottom:solid #C6C6C6 1px" id="btndown">
		<center><a id="btndown"><img style="width:40px"  src="<?php echo base_url('assets/img/btn-down.png')?>"></a></center>
	</section>
	<section id="home_center">
		<div class="row">
			<div class="large-3 columns"><p></p></div>
			<div class="large-6 columns">
				<center>
					<h2>Linux is Everywhere!</h2>
					<p style="font-size:13px">Whether you know it or not you are already using Linux every day. Every time you use Google or Facebook or any other major Internet site, you are communicating with servers running Linux. Most DVRs, airplane and automobile entertainment systems and recent TVs run on Linux. Most ubiquitously, if you are using an Android phone, you are using a flavor of Linux.

						At its core, Linux is software used to control hardware like desktop and laptop computers, supercomputers, mobile devices, networking equipment, airplanes, and automobiles; the list is endless. Linux is everywhere. <a style="color:lightgray" target="_blank" href="https://www.edx.org/blog/why-learn-linux#.VIZXq-qUfHw">-www.edx.org-</a> </p>
					</center>
				</div>
				<div class="large-3 columns"><p></p></div>
			</div>
		</section>
		<!-- available course -->
		<section id="otherCourse">
			<center>
				<div class="row">
					<div class="large-12 collapse" columns>
						<h2 style="color:#fff;margin:0">Available Course Materi</h2>
						<p>improve the mastery of Linux by following other courses</p>
						<!-- skill completion -->
						<div class="row">
							<?php
							foreach($allMateri as $am):
								$idMateri = base64_encode(base64_encode($am['id_materi']));
							$idMateri = str_replace('=', '', $idMateri);
							$titleMateri = str_replace(' ', '-', $am['title']);
							if(!empty($am['logo'])){$logo = base_url('assets/img/logo/gray '.$am['logo']);}
							else{$logo = base_url('assets/img/logo/gray other logo.png'); }
							?>
							<a id="btn_course_item" href="#btn_resume">
								<div style="float:left;padding: 0.9375rem;" class="large-4 columns">
									<div style="background-color:#FFF" class="materi-item">
										<center>
											<img src="<?php echo $logo?>"/>
										</center>
										<div class="materi-title">
											<h4><?php echo $am['title'];?></h4>
										</div>
										<div class="course-detail">
											<?php echo $am['description'];?>
										</div>
										<a href="<?php echo site_url('course/syllabus/'.$idMateri.'/'.$titleMateri)?>" class="button">start</a>
									</div>
								</div>
							</a>
						<?php endforeach;?>
					</div>
				</div>
			</div>
		</center>
	</section>
	<!-- stats -->
	<section id="home_user">
		<div class="row">
			<div class="large-4 columns">
				<center>
					<h5>Total Student</h5>
					<strong><h3><?php echo $this->m_user->countActiveStudent();?></h3></strong>
				</center>
			</div>
			<div class="large-4 columns">
				<center>
					<h5>Total Materi</h5>
					<strong><h3><?php echo $this->db->count_all_results('materi');?></h3></strong>
				</center>
			</div>
			<div class="large-4 columns">
				<center>
					<h5>Total Course</h5>
					<strong><h3><?php echo $this->db->count_all_results('course');?></h3></strong>
				</center>
			</div>
		</div>
	</section>

	<!-- success register modal -->
	<div id="registerSuccess" class="reveal-modal small" data-reveal>
		<h2>Register Success</h2>
		<p class="lead">To become a students, check email for confirmation</p>
		<p>enjoy command!</p>
		<p></p>
		<a class="close-reveal-modal">&#215;</a>
	</div>

	<?php //get error message
	if(!empty($_GET['error'])): ?>
	<div id="showError" class="reveal-modal small" data-reveal>
		<h2>Something wrong</h2>
		<p class="lead"><?php echo $_GET['error']?></p>
		<a class="close-reveal-modal">&#215;</a>
	</div>
	<?php endif;?>

	<?php //get success message
	if(!empty($_GET['success'])): ?>
	<div id="showSuccess" class="reveal-modal small" data-reveal>
		<h2>Success</h2>
		<p class="lead"><?php echo $_GET['success']?></p>
		<a class="close-reveal-modal">&#215;</a>
	</div>
<?php endif;?>
