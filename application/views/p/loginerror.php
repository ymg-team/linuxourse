<div class="row">
	<div style="height:450px" class="base-content" class="large-12 columns">
		<div class="large-5 columns">
			<br/><br/>
			<h4>Login</h4>
			<p><a href="<?php echo site_url()?>">i don't have account</a></p>
			<hr/>
			<form method="POST" action="">
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
						<input class="button" type="submit" value="Login">
					</div>
				</div>
			</form>	
		</div>
		<div class="large-5 columns">
		<br/><br/>
		<h4>Atau Login Via</h4>
		<hr/>
		<!-- <a style="background-color:rgb(77, 117, 202);display:block" href="#" class="button"><i style="font-size:20px;vertical-align:middle" class="fi-social-facebook"></i> Facebook</a> -->
		<a style="background-color:rgb(202, 77, 77);display:block" href="<?php echo site_url('oauth/googleplus')?>" class="button"><i style="font-size:20px;vertical-align:middle" class="fi-social-google-plus"></i> Google+</a>		
		</div>
	</div>
</div>