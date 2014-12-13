
<!-- body -->
<section id="welcome">
	<div class="row">
		<div class="large-7 columns">
			<img style="width:90%" src="<?php echo base_url('assets/img/home-view.png')?>">
			<br/><br/>
			<hr/>
			<div class="welcome_message">
				<h1 style="color:#fff">Easy to Learn Linux</h1>
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
					<dd class="small-6 columns active"><a class="tab-home" role="tab" href="#register">Register</a></dd>
					<dd class="small-6 columns"><a class="tab-home" role="tab" href="#login">Login</a></dd>
				</dl>
				<div style="padding:5px 5px 0 5px;background-color:#fff" class="tabs-content">
					<div class="content active" id="register">
						<form method="POST" action="<?php echo site_url('p/register')?>">
							<div class="row">
								<div class="large-12 columns">
									<input style="height:40px" name="input_username" type="text" placeholder="username" required>
								</div>								
							</div>
							<div class="row">
								<div class="large-12 columns">
									<input style="height:40px" name="input_fullname" type="text" placeholder="fullname" required>
								</div>								
							</div>
							<div class="row">
								<div class="large-12 columns">
									<input style="height:40px" name="input_email" type="email" placeholder="email" required>
								</div>								
							</div>
							<div class="row">
								<div class="large-12 columns">
									<input style="height:40px" name="input_password" type="password" placeholder="password" required>
								</div>								
							</div>
							<div class="row">
								<div class="large-12 columns">
									<input style="height:40px" name="input_passconf" type="password" placeholder="password again" required>
								</div>								
							</div>
							<div class="row">
								<div class="large-12 columns">
									<input class="button" type="submit" value="Register">
								</div>
							</div>
						</form>
					</div>
					<div style="padding:5px 5px 0 5px;background-color:#fff" class="content" id="login">
						<form method="POST" action="<?php echo site_url('p/login')?>">
							<div class="row">
								<div class="large-12 columns">

									<input name="input_username" style="height:40px" type="text" placeholder="username" required>
								</div>								
							</div>
							<div class="row">
								<div class="large-12 columns">
									<input name="input_password" style="height:40px" type="password" placeholder="password" required>
								</div>								
							</div>
							<div class="row">
								<div class="large-12 columns">
									<input class="button" type="submit" value="Login">
								</div>
							</div>
						</form>
					</div>						
				</div>
			</div>
		</div>
	</section>
	<section style="border-bottom:solid #C6C6C6 1px" id="btndown">
		<center><a href="#home_center"><img style="width:40px"  src="<?php echo base_url('assets/img/btn-down.png')?>"></a></center>
	</section>
	<section id="home_center">
		<div class="row">
			<div class="large-3 columns"><p></p></div>
			<div class="large-6 columns">
				<center>
					<h3>Linux is Everywhere!</h3>
					<p style="font-size:13px">Whether you know it or not you are already using Linux every day. Every time you use Google or Facebook or any other major Internet site, you are communicating with servers running Linux. Most DVRs, airplane and automobile entertainment systems and recent TVs run on Linux. Most ubiquitously, if you are using an Android phone, you are using a flavor of Linux.

						At its core, Linux is software used to control hardware like desktop and laptop computers, supercomputers, mobile devices, networking equipment, airplanes, and automobiles; the list is endless. Linux is everywhere. <a style="color:lightgray" target="_blank" href="https://www.edx.org/blog/why-learn-linux#.VIZXq-qUfHw">-www.edx.org-</a> </p>
					</center>
				</div>
				<div class="large-3 columns"><p></p></div>
			</div>
		</section>
		<section id="home_user">
			<div class="row">
				<div class="large-4 columns">
					<center>
						<h5>Total Student</h5>
						<strong><h3>4500K</h3></strong>
					</center>
				</div>
				<div class="large-4 columns">
					<center>
						<h5>Total Materi</h5>
						<strong><h3>235</h3></strong>
					</center>
				</div>
				<div class="large-4 columns">
					<center>
						<h5>Course This Week</h5>
						<strong><h3>4500K</h3></strong>
					</center>
				</div>			
			</div>
		</section>

		<!-- success register modal -->
		<div id="registerSuccess" class="reveal-modal small" data-reveal>
		<h2>Register Success</h2>
			<p class="lead">You're now students</p>
			<p>you can login using email/username and password which you have made!</p>
			<a class="close-reveal-modal">&#215;</a>
		</div>

