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
        <dl class="sub-nav">
          <dt>Filter:</dt>
          <dd class="active"><a href="#">All</a></dd>
          <dd><a onclick="showMateri()">By Materi</a></dd>
          <dd><a href="#">Active</a></dd>
          <dd><a href="#">Draft</a></dd>
        </dl>
        <dl id="listMateri" style="display:none" class="sub-nav">
          <dt>Choose Materi:</dt>
          <?php foreach($viewMateri as $vm):?>
            <dd><a href="<?php echo site_url('manage/coursebymateri/'.$vm['title'])?>"><?php echo $vm['title']?></a></dd>
          <?php endforeach;?>
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
            <h5>Total : <?php echo $total?></h5>
            <center class="pagination"><?php echo $link;?></center>
            <table style="width:900px">
              <thead>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Materi</th>
                  <th>Level</th>
                  <th>Step</th>
                  <th>On Going</th>
                  <th>Finished</th>
                  <th>Error Report</th>
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
                    <td><?php echo $v['title']?></td>
                    <td><?php echo $v['materi']?></td>
                    <td><?php echo $v['level']?></td>
                    <td><?php echo $v['step']?></td>
                    <td><?php echo $this->m_admin->countStudentByCourse($v['id_course'],'incomplete');?></td>
                    <td><?php echo $this->m_admin->countStudentByCourse($v['id_course'],'completed');?></td>
                    <td><a href="#">u:34|p:23|s:245</a></td>
                    <td><a class="admin-action">edit</a><a class="admin-action">delete</a></td>
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