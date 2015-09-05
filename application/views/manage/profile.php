<!--body-->
<section  id="welcome">
  <!--login form-->
  <div class="login-form-block">
    <!--empty div-->
    <div class="row admin-content">
      <!-- sidebar -->
      <div class="large-2 columns">
        <?php $this->load->view('manage/sidebar');?>
      </div>
      <!-- end of sidebar -->
      <!-- content -->
      <div class="large-10 columns">
        <nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
          <li role="menuitem"><a href="#">Manage</a></li>
          <li role="menuitem" class="current"><a href="#">Profile</a></li>
        </nav>
        <br/>
        <?php if(!empty($_GET['success'])){//if add note ?>
        <div data-alert class="alert-box success">
          <?php echo $_GET['success'];?>
          <a href="#" class="close">&times;</a>
        </div>
        <?php }else if(!empty($_GET['error'])){?>
        <div data-alert class="alert-box alert">
          <?php echo $_GET['error'];?>
          <a href="#" class="close">&times;</a>
        </div>
        <?php }?>
        <br/>
        <div class="admin-content-white">
          <?php //print_r($this->session->userdata('manage_login'))?>
          <div class="large-6 columns">
            <h4>My Profile</h4>
            <p>Level : <?php echo $profile['level']?></p>
            <hr/>
            <?php 
            $error = validation_errors();
            if(!empty($error)):?>
              <div data-alert class="alert-box alert"><?php echo $error;?><a href="#" class="close">&times;</a></div>
            <?php endif;?>
            <form action="" method="POST">
              <label>Username
                <input name="input_username" type="text" name="input_username" value="<?php echo $profile['username']?>"></label>
                <label>Email
                  <input name="input_email" type="email" name="input_username" value="<?php echo $profile['email']?>"></label>
                  <label>Fullname
                    <input type="hidden" name="id_user_manage" value="<?php echo $profile['id_user_manage']?>">
                    <input name="input_fullname" type="text" name="input_username" value="<?php echo $profile['fullname']?>"></label>
                    <hr/>
                    <label>change password
                    <input name="input_changepassword" type="password" name="input_username" value=""></label>
                    <label>confirm change password
                    <input name="input_changepasswordagain" type="password" name="input_username" value=""></label>
                    <hr/>
                    <label>recent password
                    <input name="input_recentpassword" type="password" name="input_username" value="" required></label>
                    <button class="button small" name="btnsave">Save Changes</button>
                  </form>
                </div>
              </div>
            </div>
            <!-- end of content -->
          </div>
        </div>
        <!--end login form -->
      </section>
<!--endof body-->