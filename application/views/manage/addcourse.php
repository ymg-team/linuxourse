   <script type="text/javascript">
     function showMateri(){
      $('#listMateri').toggle('fast');
    }
    function checkStep(){
      $('#stepstatus').html('<i>checking step...</i>');
      idmateri = <?php echo $this->uri->segment(3);?>;
      step = $('#input_step').val();
      if(step == '' || step == 0){
        return  $('#stepstatus').html('<i style="color:red">input valid step</i>');
      }
      $.ajax({
        url:'<?php echo site_url("manage/ajaxavailablestep")?>'+'/'+idmateri+'/'+step,
        success:function(response){
          $('#stepstatus').html(response);
        },
        error:function(){
          alert('something wrong, refresh  the page');
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
          <li role="menuitem" class="current"><a href="#">Course</a></li>
        </nav>
        <?php $this->load->view('manage/extentions/coursefilter')?>
        <a onclick="addForm()" class="button small">+ Add Case</a>
        <div id="form-add" style="display:none">
          <strong>Choose Materi : </strong>
          | <?php foreach($viewMateri as $vm):?>
          <a href="<?php echo site_url('manage/addcourse/'.$vm['id_materi'])?>"><?php echo $vm['title']?></a> |
        <?php endforeach;?>
      </div>
      <div class="admin-content-white">
        <div class="large-6 columns">
          <h4><?php echo $title;?></h4>
          <form method="post" action="">
            <label>Title <small>max 50 character</small><input type="text" name="input_title" required></label>
            <span class="row">
              <span class="small-6 column"><label>Step  <br/><span id="stepstatus"></span><?php //echo $this->m_course->getTheBiggestStep($this->uri->segment(3))?>
              <input onkeyup="checkStep()" type="number" id="input_step" name="input_step" value="<?php echo $this->m_course->getTheBiggestStep($this->uri->segment(3))+1?>" required></label></span>
             </span>
            <label>Description <small>max 300 character</small>
            <textarea style="height:100px" name="input_description" required></textarea></label>
            <br/>
            <label>Level <small>or <a target="blank" href="#">Generate New Level</a></small>
              <select name="input_level" required>
                <option value="">choose level</option>
                <?php foreach($level as $l):
                echo "<option value=".$l['id_level'].">level : ".$l['level'].", ".$l['title']."</option>";
                endforeach;?>
              </select>
            </label>
            <br/>
            <label>Estimate <small>in minutes</small><input type="number" name="input_estimate" required></label>
            <label>Case EN<small>max 200 character</small>
            <textarea style="height:100px" name="input_caseen" required></textarea></label>
            <br/>
            <label>Hint EN<small>max 200 character</small>
            <textarea style="height:100px" name="input_hinten" required></textarea></label>
            <br/>
            <label>Case ID<small>max 200 character<br/>separate with ":", ex : ls -l:ps -aux:ls / > grep user:</small>
            <textarea style="height:100px" name="input_caseid" required></textarea></label>
            <br/>
            <label>Hint ID<small>max 200 character<br/>separate with ":", ex : ls -l:ps -aux:ls / > grep user:</small>
            <textarea style="height:100px" name="input_hintid" required></textarea></label>
            <br/>
            <label>Command<small>max 200 character<br/>separate with ":", ex : ls -l:ps -aux:ls / > grep user:</small>
            <textarea style="height:100px" name="input_command" required></textarea></label>
            <br/>
            <label>Custom Controller <small>max 50 character</small><input type="text" name="input_controller"></label>
            <button name="btnpost" class="button small">publish</button> <button name="btndraft" class="button secondary small">draft</button>
          </form>
        </div>

        <div class="large-6 columns">
          <h4>Case List</h4>
          <table>
            <thead><td width="50px">step</td><td width="50px">level</td><td>title</td><td width="50px"></td></thead>
            <tbody>
              <?php foreach($case as $c):?>
                <tr> 
                <td><strong><?php echo $c['step']?></strong></td>
                <td><?php echo $c['level']?></td>
                <td><?php echo $c['title']?></td>
                <td><a href="<?php echo site_url('manage/editcourse/'.$c['id_course'])?>">edit</td>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
  <!--end login form -->
</section>
<!--endof body-->