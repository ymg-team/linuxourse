   <script type="text/javascript">
    //show materi
    function showMateri(){
      $('#listMateri').toggle('fast');
    }
    //check level
    function checkLevel(){
      level = $('#input_level').val();
      materi = $('#input_materi').val();
      if(level==0 || level == '' || materi==0 || materi == ''){return $('#levelstatus').html('<i style="color:red">level not valid or materi not selected</i>');}
      url = '<?php echo site_url("manage/checkAvailableLevel")?>/'+level+'/'+materi;
      $.ajax({
        url:url,
        success:function(response){
          $('#levelstatus').html(response);
        },
        error:function(){
          alert('something wrong');
        }
      });
    }
    //review level
    function reviewLevel(){
      $('#reviewLevel').html('<i>loading...</i>');
      idmateri= $('#input_materi').val();
      url = '<?php echo site_url("manage/reviewlevel")?>/'+idmateri;
      $.ajax({
        url:url,
        success:function(response){
          $('#reviewLevel').html(response);
        },
        error:function(){
          alert('something wrong');
        }
      });
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
          <li role="menuitem" class="current"><a href="#">Level</a></li>
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
        <?php $this->load->view('manage/extentions/levelfilter')?>
        <div class="admin-content-white">
          <form style="float:tiny" method="get" name="q" action="">
            <span class="row collapse" style="min-width:100%">
              <span class="large-11 columns">
                <input type="text" name="q" placeholder="searching level"></span>
                <span class="large-1 columns"><button type="submit" class="tiny">search</button>
                </span>
              </span>
            </form>
            <!-- data from db -->
            <a onclick="addForm()" class="button small">+ Add Level</a><span> Total : <?php echo $total?></span>
            <div id="form-add" style="display:none">
             <div class="row">
              <div class="large-6 columns">
                <!-- add level -->
                <h4>Add Level</h4>
                <form action="" method="POST">
                  <label>Materi
                    <select onchange="reviewLevel()" id="input_materi" name="input_materi" required>
                      <option value="">Choose Materi</option>
                      <?php foreach($viewMateri as $vm):?>
                        <option value="<?php echo $vm['id_materi']?>"><?php echo $vm['title']?></option>
                      <?php endforeach;?>
                    </select>
                  </label>
                  <label>Level Title
                    <input type="text" name="input_title" required/>
                  </label>
                  <label>Level Step <span id="levelstatus"></span>
                    <input onkeyup="checkLevel()" type="number" id="input_level" name="input_level" required>
                  </label>
                  <label>Description
                    <textarea name="input_description" required></textarea>
                  </label>
                  <br/>
                  <button name="btnadd" class="button small">post</button>
                </form>
                <!-- end of add level      -->
              </div>
              <div class="large-6 columns">
              <!-- review level -->
              <h4>Review Level</h4>
              <div id="reviewLevel"></div>
              <!-- end of review level -->
              </div>
            </div>
            <strong>Choose Materi : </strong>
          </div>
          <center class="pagination"><?php echo $link;?></center>
          <table style="width:900px">
            <thead>
              <tr>
                <th></th>
                <th>Name</th>
                <th>Materi</th>
                <th>Level Step</th>
                <th>Description</th>
                <th>Total Course</th>
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
                  <td><?php echo $v['description']?></td>
                  <td><?php echo $this->m_admin->countCourseByLevel($v['id_level'])?></td>
                  <td><a href="<?php echo site_url('manage/level/editlevel/'.$v['id_level'])?>" class="admin-action">edit</a></td>
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