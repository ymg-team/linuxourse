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
          <li role="menuitem" class="current"><a href="#">Comments</a></li>
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
          <dd id="all"><a href="<?php echo site_url('manage/comments')?>">All</a></dd>
          <dd id="locked"><a href="<?php echo site_url('manage/comments/sort/locked')?>">Locked</a></dd>
        </dl>
        <div class="admin-content-white">
          <form style="float:tiny" method="get" name="q">
            <span class="row collapse" style="min-width:100%">
              <span class="large-11 columns">
                <input type="text" placeholder="searching level"></span>
                <span class="large-1 columns"><button type="submit" class="tiny">search</button>
                </span>
              </span>
            </form>

            <center class="pagination"><?php echo $link;?></center>
            <table>
              <thead>
                <tr>
                 <th>discuss</th>
                 <th>username</th>
                 <th>update</th>
                 <th>comment</th>
                 <th>status</th>
                 <th>action</th>
               </tr>
             </thead>
             <tbody>
              <?php foreach($view as $v):?>
                <tr>
                <td><a target="_blank" href="<?php echo site_url('discussion/open/'.str_replace('=', '', base64_encode(base64_encode($v['id_discuss']))))?>"><?php echo $v['title'];?></a></td>
                  <td><a target="_blank" href="<?php echo site_url('student/v/'.$v['username'])?>"><?php echo $v['username'];?></a></td>
                  <td><?php echo $v['comment'];?></td>
                  <td><?php echo $v['updatedate'];?></td>
                  <td><?php echo $v['status'];?></td>
                  <td>
                    <?php switch ($v['status']) {
                      case 'posted':
                      echo '<a href="'.site_url('manage/comments/setup/locked/'.$v['id_comment']).'"><span class="fi-lock"></span> lock</a>';
                      break;
                      case 'locked':
                      echo '<a href="'.site_url('manage/comments/setup/posted/'.$v['id_comment']).'"><span class="fi-unlock"></span> unlock</a>';
                      break;
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