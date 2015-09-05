   <script type="text/javascript">
     function showMateri(){
      $('#listMateri').toggle('fast');
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
          <li role="menuitem" class="current"><a href="#">Course</a></li>
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
        <?php $this->load->view('manage/extentions/coursefilter')?>
        <div class="admin-content-white">
          <form style="float:tiny" method="get" name="q" action="">
            <span class="row collapse" style="min-width:100%">
              <span class="large-11 columns">
                <input name="q" type="text" placeholder="searching course"></span>
                <span class="large-1 columns"><button type="submit" class="tiny">search</button>
                </span>
              </span>
            </form>
            <!-- data from db -->
            <a onclick="addForm()" class="button small">+ Add Case</a><span> Total : <?php echo $total?></span>
            <div id="form-add" style="display:none">
              <strong>Choose Materi : </strong>
              | <?php foreach($viewMateri as $vm):?>
              <a href="<?php echo site_url('manage/addcourse/'.$vm['id_materi'])?>"><?php echo $vm['title']?></a> |
            <?php endforeach;?>
          </div>
          <center class="pagination"><?php echo $link;?></center>
          <table style="width:900px">
            <thead>
              <tr>
                <th style="width:20px"></th>
                <th style="width:20px">id</th>
                <th>Name</th>
                <th>Materi</th>
                <th>Level</th>
                <th>Step</th>
                <th>On Going</th>
                <th>Finished</th>
                <th>Error Report</th>
                <th>Status</th>
                <th>action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $uri = $this->uri->segment(3);
              if(!$uri){
                $uri = 0;
              }
              $uri = $uri+1;
              ?>
              <?php foreach($view as $v):?>
                <tr>
                  <td><?php echo $uri;?></td>
                  <td><?php echo $v['id_course'] ?></td>
                  <td><?php echo $v['title']?></td>
                  <td><?php echo $v['materi']?></td>
                  <td><?php echo $v['level']?></td>
                  <td><?php echo $v['step']?></td>
                  <td><?php echo $this->m_admin->countStudentByCourse($v['id_course'],'incomplete');?></td>
                  <td><?php echo $this->m_admin->countStudentByCourse($v['id_course'],'completed');?></td>
                  <td><a href="#">u:34|p:23|s:245</a></td>
                  <td><?php echo $v['status'];?></td>
                  <td><a href="<?php echo site_url('manage/editcourse/'.$v['id_course'])?>" class="admin-action">edit</a></td>
                </tr>
                <?php $uri++;endforeach;?>
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