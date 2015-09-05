   <script type="text/javascript"
   src="https://www.google.com/jsapi?autoload={
    'modules':[{
      'name':'visualization',
      'version':'1',
      'packages':['corechart']
    }]
  }"></script>

  <script type="text/javascript">
    google.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Materi', 'Level', 'Step'],
        ['Introduce Linux',<?php echo $totallevelintro;?>,<?php echo $totalcourseintro;?>],
        ['Linux Shell',<?php echo $totallevelshell;?>,<?php echo $totalcourseshell;?>],
        ]);
      var options = {
        curveType: 'function',
        legend: { position: 'right' }
      };

      var chart = new google.visualization.LineChart(document.getElementById('materi_chart'));

      chart.draw(data, options);
    }
  </script>

  <script type="text/javascript">
    google.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Materi', 'Ongoing', 'Completed'],
        ['Introduce Linux',<?php echo $totalgoingintro; ?>,<?php echo $totalcompleteintro; ?>],
        ['Linux Shell',<?php echo $totalgoingshell; ?>,<?php echo $totalcompleteshell; ?>],
        ]);
      var options = {
        curveType: 'function',
        legend: { position: 'right' }
      };

      var chart = new google.visualization.LineChart(document.getElementById('students_chart'));

      chart.draw(data, options);
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
        </dl>
        <div class="admin-content-white">
          <!-- course stats -->
          <h4>Materi</h4>
          <span style="color:green">
            <h2 style="color:green"><?php echo $totallevel;?> / <?php echo $totalcourse;?></h2>
            Total : Level / Step</span>
            <hr/>
            <div class="row">
              <div style="float:left" class="small-12 columns">            
                <div class="large-12 columns">
                  <div id="materi_chart" style="width: 100%; height: 200px"></div>
                </div>
              </div>            
            </div>
            <!-- end course stats -->
            <!-- start student stats -->
            <br/>
            <h4>Student</h4>
            <span style="color:green">
             <h2 style="color:green"><?php echo $totalstudents; ?></h2>
             Total Students
             <hr/> 
             <div class="row">
              <div style="float:left" class="small-12 columns">            
                <div class="large-12 columns">
                  <div id="students_chart" style="width: 100%; height: 200px"></div>
                </div>
              </div>            
            </div>            
            <!-- end of student stats -->
            <br/>
            <h4>Users</h4>
            <hr/>
            <div class="row">
              <div class="large-6 columns">
                <h5>Last 10 Student Login <a href="#">more data</a></h5>
                <table>
                  <tr>
                    <th>username</th>
                    <th>time</th>
                  </tr>
                  <?php
                  $students = $this->m_user->showLastLogin(10,0);
                  foreach($students as $ss):
                    ?>
                  <tr>
                    <td><a target="_balnk" href="<?php echo site_url('student/v/'.$ss['username']);?>"><?php echo $ss['username'] ?></a></td>
                    <td><?php echo $ss['last_login']?></td>
                  </tr>
                <?php endforeach;?>
              </table>      
            </div>
            <div class="large-6 columns">
              <h5>Super User Login Log<a href="#"> more data</a></h5>
              <table>
                <tr>
                  <th>username</th>
                  <th>time</th>
                </tr>
                <?php
                $admins = $this->m_admin->showAdmin(10,0);
                foreach($admins as $as):
                  $loginlog = explode('|', $as['loginlog']);
                ?>
                <tr>
                  <td><?php echo $as['username'];?></td>
                  <td><?php echo $loginlog[1];?></td>
                </tr>
              <?php endforeach;?>
            </table>          
          </div>
        </div>
      </div>
    </div>
    <!-- end of content -->
  </div>
</div>
<!--end login form -->
</section>
<!--endof body-->