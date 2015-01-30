<script type="text/javascript">
  function addDir(){
    $('#addDir').toggle('fast');
    $('#addFile').hide('fast');
  }
  function addFile(){
    $('#addFile').toggle('fast');
    $('#addDir').hide('fast');
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
        <form style="float:tiny" method="get" name="q">
          <span class="row collapse" style="min-width:100%">
            <span class="large-10 columns">
              <input id="location" type="text" placeholder="location"></span>
              <span class="large-2 columns"><button type="submit" class="tiny">jump to location</button>
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
          <a style="width:100px;" onclick="addDir()"><span style="font-size:30px;padding:5px;background-color:#008cba;color:#fff" class="fi-folder-add"></span></a>
          <a style="width:100px;" onclick="addFile()"><span style="font-size:30px;padding:5px;background-color:#008cba;color:#fff" class="fi-page-add"></span></a>
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
            <center class="pagination"><?php echo $link;?></center>
            <div class="row">
              <div class="small-1 columns"><span style="font-size:20px" class="fi-folder"></span></div>
              <div class="small-8 columns">name</div>
              <div clas="small-2 columns"><a href="#">rename</a><a href="#">delete</a></div>
            </div>
            <div class="row">
              <div class="small-1 columns"><span style="font-size:20px" class="fi-page-copy"></span></div>
              <div class="small-8 columns">name</div>
              <div clas="small-2 columns"><a href="#">rename</a><a href="#">delete</a></div>
            </div>
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