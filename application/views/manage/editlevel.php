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
    $(document).ready(function(){
      $('#input_materi').val(<?php echo $view['id_materi'];?>);
      reviewLevel();
    });
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
        <?php $this->load->view('manage/extentions/levelfilter')?>
        <div class="admin-content-white">
          <form style="float:tiny" method="get" name="q">
            <span class="row collapse" style="min-width:100%">
              <span class="large-11 columns">
                <input type="text" placeholder="searching level"></span>
                <span class="large-1 columns"><button type="submit" class="tiny">search</button>
                </span>
              </span>
            </form>
            <!-- data from db -->
            <div id="form-add">
             <div class="row">
              <div class="large-6 columns">
                <!-- add level -->
                <h4>Edit Level</h4>
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
                    <input type="text" name="input_title" value="<?php echo $view['title']?>" required/>
                  </label>
                  <label>Level Step <span id="levelstatus"></span>
                    <input onkeyup="checkLevel()" type="number" id="input_level" name="input_level" value="<?php echo $view['level']?>" required>
                  </label>
                  <label>Description
                    <textarea name="input_description" required><?php echo $view['description']?></textarea>
                  </label>
                  <br/>
                  <button name="btnsave" class="button small">save changes</button>
                  <button onclick="return confirm('are you sure')" name="btnadd" class="button alert small"><span class="fi-trash"></span></button>
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
          </div>
          <!-- data from db -->
        </div>
      </div>
      <!-- end of content -->
    </div>
  </div>
  <!--end login form -->
</section>
<!--endof body-->