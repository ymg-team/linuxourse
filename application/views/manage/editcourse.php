   <script type="text/javascript">
     function showMateri(){
      $('#listMateri').toggle('fast');
    }
    function checkStep(){
      $('#stepstatus').html('<i>checking step...</i>');
      idmateri = <?php echo $editcase['id_materi'];?>;
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
    //auto setup level
    $(document).ready(function(){
      $('#selectcat').val(<?php echo $editcase['id_level']?>);
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
            <input type="hidden" name="input_idcourse" value="<?php echo $idcourse;?>">
            <label>Title <small>max 50 character</small><input type="text" name="input_title" value="<?php echo $editcase['title']?>" required></label>
            <span class="row">
              <span class="small-6 column"><label>Step  <br/><span id="stepstatus"></span><?php //echo $this->m_course->getTheBiggestStep($this->uri->segment(3))?>
              <input onkeyup="checkStep()" type="number" id="input_step" name="input_step" value="<?php echo $editcase['step'];?>" required></label></span>
             </span>
            <label>Description <small>max 300 character</small>
            <textarea style="height:100px" name="input_description" required><?php echo $editcase['description']?></textarea></label>
            <br/>
            <label>Level <small>or <a target="blank" href="#">Generate New Level</a></small>
              <select id="selectcat" name="input_level" required>
                <option value="">choose level</option>
                <?php foreach($level as $l):
                echo "<option value=".$l['id_level'].">level : ".$l['level'].", ".$l['title']."</option>";
                endforeach;?>
              </select>
            </label>
            <br/>
            <label>Estimate <small>in minutes</small><input type="number" name="input_estimate" value="<?php echo $editcase['estimate'];?>" required></label>
            <label>Case EN<small>max 200 character</small>
            <textarea style="height:100px" name="input_caseen" required><?php echo $editcase['course_case_en']?></textarea></label>
            <br/>
            <label>Hint EN<small>max 200 character</small>
            <textarea style="height:100px" name="input_hinten" required><?php echo $editcase['hint_en']?></textarea></label>
            <br/>
            <label>Case ID<small>max 200 character<br/>separate with ":", ex : ls -l:ps -aux:ls / > grep user:</small>
            <textarea style="height:100px" name="input_caseid" required><?php echo $editcase['course_case_id']?></textarea></label>
            <br/>
            <label>Hint ID<small>max 200 character<br/>separate with ":", ex : ls -l:ps -aux:ls / > grep user:</small>
            <textarea style="height:100px" name="input_hintid" required><?php echo $editcase['hint_id']?></textarea></label>
            <br/>
            <label>Command<small>max 200 character<br/>separate with ":", ex : ls -l:ps -aux:ls / > grep user:</small>
            <textarea style="height:100px" name="input_command" required><?php echo $editcase['command']?></textarea></label>
            <br/>
            <label>Custom Controller <small>max 50 character</small><input type="text" name="input_controller" value="<?php echo $editcase['custom_controller']?>"></label>
            <button name="btnpost" class="button small">Save</button> <button name="btndraft" class="button secondary small">draft</button>
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