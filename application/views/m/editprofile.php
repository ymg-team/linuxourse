<div class="row">
	<div class="base-content" class="large-12 columns">
		<div class="large-5 columns">
			<h4>Edit Profile</h4>
			<p>complete your profile, and share your skill to the world</p>
			<hr/>
			<form method="POST" action="">
				<div class="row">
					<div class="large-12 columns">
						<input name="input_username" style="height:40px" type="text" placeholder="username" value="<?php echo $profile['username']?>" required>
					</div>								
				</div>
				<div class="row">
					<div class="large-12 columns">
						<input name="input_fullname" style="height:40px" type="text" placeholder="fullname" value="<?php echo $profile['fullname']?>" required>
					</div>								
				</div>
				<div class="row">
					<div class="large-12 columns">
						<input name="input_email" style="height:40px" type="email" placeholder="email" value="<?php echo $profile['email']?>" required>
					</div>								
				</div>
				<div class="row">
					<div class="large-12 columns">
						<select style="height:40px" name="input_nationality">
							<option>nationality 1</option>
							<option>nationality 2</option>
							<option>nationality 3</option>
						</select>
					</div>								
				</div>
				<br/>
				<div class="row">
					<div class="large-12 columns">
						<input name="input_newpassword1" style="height:40px" type="password" placeholder="new password" value="" required>
					</div>								
				</div>
				<div class="row">
					<div class="large-12 columns">
						<input name="input_newpassconf" style="height:40px" type="password" placeholder="again new password " value="" required>
					</div>								
				</div>
				<hr/>
				<strong>insert your recent password to save update</strong>
				<div class="row">
					<div class="large-12 columns">
						<input name="input_nowpassword" style="height:40px" type="password" placeholder="old password" value="" required>
					</div>								
				</div>
				<br/>
				<div class="row">
					<div class="large-12 columns">
						<?php if(!empty(validation_errors())){?>
						<small class="error"><?php echo validation_errors();?></small>
						<?php } ?>
						<input class="button" type="submit" value="Save">
					</div>
				</div>
			</form>		
		</div>
	</div>
</div>