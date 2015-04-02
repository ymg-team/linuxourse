<div class="row">
	<div class="base-content" class="large-12 columns">
		<div class="large-5 columns">
			<h4>Register</h4>
			<p>final step to register</p>
			<hr/>
			<?php
			$session = $this->session->userdata('registerdata'); 
			if(!empty($session)){
				$registerdata = $this->session->userdata('registerdata');
				$email = $registerdata['email'];
				$username = $registerdata['username'];
				$fullname = $registerdata['fullname'];
			}
			?>
			<form method="POST" action="">
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
				<div class="row">
					<div class="large-12 columns">
						<input class="button" type="submit" value="Register">
					</div>
				</div>
			</form>		
		</div>
	</div>
</div>