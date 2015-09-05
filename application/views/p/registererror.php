<div class="row">
	<div class="base-content" class="large-12 columns">
		<div class="large-5 columns">
			<h4>Register</h4>
			<p>you got an error data insert</p>
			<hr/>
			<form method="POST" action="">
				<div class="row">
					<div class="large-12 columns">
						<input name="input_username" style="height:40px" type="text" placeholder="username" value="<?php echo $_POST['input_username']?>" required>
					</div>								
				</div>
				<div class="row">
					<div class="large-12 columns">
						<input name="input_fullname" style="height:40px" type="text" placeholder="fullname" value="<?php echo $_POST['input_fullname']?>" required>
					</div>								
				</div>
				<div class="row">
					<div class="large-12 columns">
						<input name="input_email" style="height:40px" type="email" placeholder="email" value="<?php echo $_POST['input_email']?>" required>
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
				<div class="row">
					<div class="large-12 columns">
						<small class="error"><?php echo validation_errors();?></small>
						<input class="button" type="submit" value="Register">
					</div>
				</div>
			</form>		
		</div>
		<div class="large-2 column"><p></p></div>
		<div class="large-5 columns">
			<h4>Or Register Via</h4>
			<hr/>
			<!-- alternate register -->
			<a style="background-color:rgb(77, 117, 202);display:block" href="http://linuxourse.me/oauth/facebook/facebook.php" class="button"><i style="font-size:20px;vertical-align:middle" class="fi-social-facebook"></i> Facebook</a>
			<a style="background-color:rgb(202, 77, 77);display:block" href="http://linuxourse.me/oauth/googleplinfus" class="button"><i style="font-size:20px;vertical-align:middle" class="fi-social-google-plus"></i> Google+</a>
		</div>
	</div>
</div>