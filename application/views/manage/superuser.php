<script type="text/javascript">
  function formadd(){
    $('.form-add').toggle('fast');
  }
</script>
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
          <li role="menuitem" class="current"><a href="#">Student</a></li>
        </nav>
        <br/>
        <?php if(!empty($_GET['success'])){//if add note ?>
        <div data-alert class="alert-box success">
          <?php echo $_GET['success'];?>
          <a href="#" class="close">&times;</a>
        </div>
        <?php }else if(!empty($_GET['error'])){?>
        <div data-alert class="alert-box error">
          <?php echo $_GET['error'];?>
          <a href="#" class="close">&times;</a>
        </div>
        <?php }?>
        <br/>
        <dl class="sub-nav">
          <dt>Filter:</dt>
          <dd id="all"><a href="<?php echo site_url('manage/superuser')?>">All</a></dd>
          <!-- <dd id="bycountry"><a href="#">By Country</a></dd> -->
          <dd id="admin"><a href="<?php echo site_url('manage/superuser/sort/admin');?>">Admin</a></dd>
          <dd id="moderator"><a href="<?php echo site_url('manage/superuser/sort/moderator');?>">Moderator</a></dd>
          <dd id="moderator"><a href="<?php echo site_url('manage/superuser/sort/banned');?>">Banned</a></dd>
        </dl>
        <div class="admin-content-white">
          <form style="float:tiny" metdod="get" name="q">
            <span class="row collapse" style="min-width:100%">
              <span class="large-11 columns">
                <input type="text" placeholder="search super user"></span>
                <span class="large-1 columns"><button type="submit" class="button tiny">search</button>
                </span>
              </span>
            </form>
            <!-- data from db -->
            <center class="pagination"><?php echo $link;?></center>
             <a onclick="formadd()" class="button small">+ Super user</a>
              <div class="large-12 columns">
                <div class="form-add large-6 columns">
                <h5><strong>Add Super User</strong></h5>
                <form method="POST" action="">
                <label>Username :
                <input type="text" name="input_username" required/></label>
                <label>Fullname :
                <input type="text" name="input_username" required/></label>
                <label>Email :
                <input type="email" name="input_username" required/></label>
                <button class="button small">Set As Moderator</button>
                <button onclick="return confirm('are you sure')" class="button small">Set As Admin</button>
                </form>
                </div>
              </div>
            <table style="widtd:900px">
              <tdead>
                <tr>
                  <th>username</th>
                  <th>fullname</th>
                  <th>email</th>
                  <th style="width:80px">register</th>
                  <th style="width:70px">level</th>
                  <th style="width:50px">status</th>
                  <th <th style="width:90px">action</th>
                </tr>
              </tdead>
              <tbody>
               <?php foreach($view as $v):?>
                  <tr>
                    <td><?php echo $v['username'];?></td>
                    <td><?php echo $v['fullname'];?></td>
                    <td><?php echo $v['email']?></td>
                    <td><?php echo $v['registerdate']?></td>
                    <td><?php echo $v['level']?></td>
                    <td><?php echo $v['status']?></td>
                    <td>
                      <?php if($v['status']=='active'){
                        echo '<a href="'.site_url('manage/superuser/action/banned/'.$v["id_user_manage"]).'">set banned</a>';
                        }else{
                        echo '<a href="'.site_url('manage/superuser/action/active/'.$v["id_user_manage"]).'">set active</a>';
                        }?> |
                        <?php if($v['level']=='admin'){
                         echo '<a href="'.site_url('manage/superuser/action/moderator/'.$v["id_user_manage"]).'">set as moderator</a>';
                        }else{
                         echo '<a href="'.site_url('manage/superuser/action/admin/'.$v["id_user_manage"]).'">set as admin</a>';
                         }?> 
                    </td>
                  </tr>
                <?php endforeach;?>
             </tbody>
           </table>
           <center class="pagination"><?php echo $link;?></center>
           <!-- data from db -->
         </div>
       </div>
       <!-- end of content -->
     </div>
   </div>
   <!--end login form -->
 </section>
<!--endof body-->