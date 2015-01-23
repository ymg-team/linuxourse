<script type="text/javascript">
  function addForm(){
    $('#form-add').toggle('fast');
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
      <?php } ?>
    <br/>
    <dl class="sub-nav">
      <dt>Filter:</dt>
      <dd class="active"><a href="#">All</a></dd>
    </dl>
    <div class="admin-content-white">
      <form style="float:tiny" method="get" name="q">
        <span class="row collapse" style="min-width:100%">
          <span class="large-11 columns">
            <input type="text" placeholder="mater/level/course"></span>
            <span class="large-1 columns"><button type="submit" class="tiny">search</button>
            </span>
          </span>
        </form>
        <!-- data from db -->
        <?php
        $uri = $this->uri->segment(3)+1;
        if(!$uri){
          $uri = 1;
        }
        ?>
        <a onclick="addForm()" class="button small">+ Add Materi</a><span> <h5>Total : <?php echo $total;?></h5></span>
        <div id="form-add" class="form-add">
          <form method="post" action="<?php echo site_url('manage/addmateri');?>">
            <label>Title<input type="text" name="input_title"></label>
            <label>Description<textarea style="height:100px" name="input_description"></textarea></label>
            <br/>
            <button class="button small">add</button>
          </form>
        </div>
        <center class="pagination"><?php echo $link;?></center>
        <table style="width:900px">
          <thead>
            <tr>
              <th></th>
              <th>Title</th>
              <th>Description</th>
              <th>Tot Level</th>
              <th>Tot Course</th>
              <th>Joined</th>
              <th>Ongoing</th>
              <th>Finished</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($view as $v):?>
              <tr>
                <td><?php echo $uri;?></td>
                <td><?php echo $v['title'];?></td>
                <td><?php echo $v['description'];?></td>
                <td><?php echo $this->m_admin->countLevelByMateri($v['id_materi']);?></td>
                <td><?php echo $this->m_admin->countCourseByMateri($v['id_materi']);?></td>
                <td><?php echo $this->m_admin->countStudentByMateri($v['id_materi'],null);?></td>
                <td><?php echo $this->m_admin->countStudentByMateri($v['id_materi'],'incomplete');?></td>
                <td><?php echo $this->m_admin->countStudentByMateri($v['id_materi'],'completed');?></td>
                <td><a href="#">Publish</a></td>
                <td><a class="admin-action">edit</a><a href="<?php echo site_url('manage/materiaction?act=delete&id='.$v['id_materi'])?>" onclick="return confirm('Are You Sure')" class="admin-action">delete</a></td>
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