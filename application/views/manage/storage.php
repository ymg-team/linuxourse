<script type="text/javascript">
  $(document).ready(function(){
    getDirectory();
  });

  function addDir(){
    $('#addDir').toggle('fast');
    $('#addFile').hide('fast');
  }
  function addFile(){
    $('#addFile').toggle('fast');
    $('#addDir').hide('fast');
  }
  //change directory
  function changeDirectory(dir){
    $('#location').val(dir);
    getDirectory(dir);
  }
  //get directory
  function getDirectory(){
    $('#listcontent').html('<center>loading content...</center>');
    directory = $('#location').val();
    url= '<?php echo site_url("manage/getdirectory")?>';
    $.ajax({
      url:url,
      data:{dir:directory},
      success:function(response){
        $('#listcontent').html(response);
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
        <li role="menuitem" class="current"><a href="#">Storage</a></li>
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
        <dd class="active"><a href="#">All</a></dd>
      </dl>
      <div class="admin-content-white">

        <span class="row collapse" style="min-width:100%">
          <span class="large-10 columns">
            <input id="location" type="text" placeholder="location" value="/"></span>
            <span class="large-2 columns"><button  onclick="getDirectory()" class="button tiny">jump to location</button>
            </span>
          </span>
          <!-- data from db -->
          <?php
          $uri = $this->uri->segment(3)+1;
          if(!$uri){
            $uri = 1;
          }
          ?>
          <a style="width:100px;" onclick="addDir()"><span style="font-size:15px;padding:5px;background-color:#008cba;color:#fff" class="fi-folder-add"> Add Directory</span></a>
          <a style="width:100px;" onclick="addFile()"><span style="font-size:15px;padding:5px;background-color:#008cba;color:#fff" class="fi-page-add"> Add File</span></a>
          <hr/>
          <?php if(!empty($editidmateri)){?>
          <div style="width:400px">
            <form method="POST" action="<?php echo site_url('manage/materiaction?act=edit')?>">
              <p>add date : <?php echo date('Y-M-d H:i:s',strtotime($editidmateri['adddate']))?><br/>
                status : <?php echo $editidmateri['status']?></p>
                <input name="id" type="hidden" value="<?php echo $editidmateri['id_materi']?>">
                <label>Title<input type="text" name="input_title" value="<?php echo $editidmateri['title']?>"></label>
                <label>Description<textarea style="height:100px" name="input_description"><?php echo $editidmateri['description']?></textarea></label>
                <br/>
                <button class="button small">save changes</button> <a href="<?php echo site_url('manage/materiaction?act=delete&id='.$editidmateri['id_materi'])?>" onclick="return confirm('are you sure')" name="btnadd" class="button alert small"><span class="fi-trash"></span></a>
              </form>
            </div>
            <?php } ?>
            <div id="addDir" class="form-add">
              <form method="post" action="<?php echo site_url('manage/addmateri');?>">
                <label>Directory Name<input type="text" name="input_title"></label>
                <br/>
                <button class="button small">add</button>
              </form>
            </div>
            <div id="addFile" class="form-add">
              <form method="post" action="<?php echo site_url('manage/addmateri');?>">
                <label>File Name<input type="text" name="input_title"></label>
                <label>Type
                  <select>
                    <option value="-">file</option>
                    <option value="s">softlink</option>
                  </select>
                </label>
                <br/>
                <button class="button small">add</button>
              </form>
            </div>
            <div class="row">
              <div class="large-12 columns">
              <a onclick="changeDirectory('/')">/</a>
              </div>
              <div class="large-12 columns">
                <a onclick="changeDirectory('/')">..</a>
              </div>
            </div>
            <div id="listcontent"></div>

            <!-- data from db -->
          </div>
        </div>
        <!-- end of content -->
      </div>
    </div>
    <!--end login form -->
  </section>
<!--endof body-->