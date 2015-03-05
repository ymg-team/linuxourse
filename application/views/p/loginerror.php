<div class="row">
	<div class="base-content" class="large-12 columns">
		<div style="height:450px" class="large-5 columns">
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
						<?php if(!empty(validation_errors())){?>
							<small class="error"><?php echo validation_errors();?></small>
						<?php }else if(!empty($error)){?>
							<small class="error"><?php echo $error;?></small>
						<?php }?>
						<input class="button" type="submit" value="Login">
					</div>
				</div>
			</form>	
		</div>
	</div>
</div>