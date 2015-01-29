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
          <dd id="all"><a href="<?php echo site_url('manage/students')?>">All</a></dd>
          <!-- <dd id="bycountry"><a href="#">By Country</a></dd> -->
          <dd id="unverified"><a href="<?php echo site_url('manage/students/status/unverified');?>">Unverified</a></dd>
        </dl>
        <div class="admin-content-white">
          <form style="float:tiny" metdod="get" name="q">
            <span class="row collapse" style="min-widtd:100%">
              <span class="large-11 columns">
                <input type="text" placeholder="searching materi"></span>
                <span class="large-1 columns"><button type="submit" class="tiny">search</button>
                </span>
              </span>
            </form>
            <!-- data from db -->
            <center class="pagination"><?php echo $link;?></center>
            <table style="widtd:900px">
              <tdead>
                <tr>
                  <th>username</th>
                  <th>fullname</th>
                  <th>country</th>
                  <th>register</th>
                  <th>lastlogin</th>
                  <th>status</th>
                  <th>action</th>
                </tr>
              </tdead>
              <tbody>
                <?php foreach($view as $v):?>
                 <tr>
                   <td><?php echo $v['username'];?></td>
                   <td><?php echo $v['fullname'];?></td>
                   <td><?php echo $v['country'];?></td>
                   <td><?php echo $v['register_date'];?></td>
                   <td><?php echo $v['last_login'];?></td>
                   <td><?php echo $v['status'];?></td>
                   <td>
                     <?php if($v['status']=='active'){?>
                     <a href="<?php echo site_url('manage/studentaction/banned/'.$v['id_user'])?>">set banned</a>
                     <?php } else if($v['status']=='banned'){?>
                     <a href="<?php echo site_url('manage/studentaction/active/'.$v['id_user'])?>">set active</a>
                     <?php }?>
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