<div class="row">
	<div class="base-content" class="large-12 columns">
		<div class="large-5 columns">
		<br/><br/>
			<h4>Edit Profile</h4>
			<p>complete your profile, and share your skill to the world</p>
			<?php
			if(!empty($_GET['note'])){
				echo 
				'<div data-alert class="alert-box success radius">
				'.$_GET['note'].'
				<a href="#" class="close">&times;</a>
			</div>';
		}
		?>
		<div class="row">
			<div class="large-12 columns">
				<?php if(!empty(validation_errors())){?>
				<small class="error"><?php echo validation_errors();?></small>
				<?php } ?>
			</div>
		</div>
		<hr/>
		<form method="POST" action="<?php echo site_url('m/updateprofile');?>" enctype="multipart/form-data">
			<div class="row">
				<div class="large-12 columns">
					<?php
					if(!empty($profile['pp'])){
						$src = base_url('assets/img/avatar/'.$profile['pp']);
					} else {
						$src = base_url('assets/img/avatar.png');
					}
					?>
					<div class="small-4 columns">
						<img style="border-radius:80px;width:80px;height:80px" src="<?php echo $src;?>">
					</div>
					<div class="small-8 columns">
						<br/>
						<input name="input_pp" style="height:40px" type="file">
						<span>max 200kb :: only support 200px*200px image</span>
					</div>
				</div>								
			</div>
			<br/>
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
					<textarea style="height:100px" name="input_about" placeholder="about me"><?php echo $profile['about'];?></textarea>
				</div>								
			</div>
			<br/>
			<div class="row">
				<div class="large-12 columns">
					<input name="input_newpassword" style="height:40px" type="password" placeholder="new password" value="">
				</div>								
			</div>
			<div class="row">
				<div class="large-12 columns">
					<input name="input_newpassconf" style="height:40px" type="password" placeholder="again new password " value="">
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
					<input class="button" type="submit" value="Save">
				</div>
			</div>
		</form>		
	</div>
</div>
</div>