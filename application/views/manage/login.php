<!--body-->
<section style="" id="welcome">
  <!--login form-->
  <div class=" login-form-block">
    <!--empty div-->
    <div class="row">
      <div class="large-4 columns"><p></p></div>
      <div class="large-4 columns">
        <center>
          <h3 style="color:#fff">Manage</h3>
          <hr/>
          <p style="color:#fff"><span class="fi-lock"></span> Login as admin or moderator</p>
          <small style="color:#fff" >make sure change your passwords periodically</small>
          <form class="manage-login" method="post" action="">
            <input name="input_username" type="text" placeholder="username" required>
            <input name="input_password" type="password" placeholder="password" required>
            <?php 
$errors = validation_errors();
            if(!empty($errors)):?>
              <div data-alert class="alert-box alert"><?php echo $errors;?><a href="#" class="close">&times;</a></div>
            <?php endif;?>
            <small><a href="#">lost your password</a></small><br/>
            <button type="submit" class="button">login</button>
          </form>
        </center>
      </div>
      <div class="large-4 columns"><p></p></div>
    </div>
  </div>
  <!--end login form -->
</section>
  <!--endof body-->