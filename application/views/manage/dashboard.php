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
          <h4>Course</h4>
          <hr/>
          <div class="row">
            <div style="float:left" class="small-12 columns">
              <h5>Materi</h5><br/>
              total : ?<br/>
              ongoing : ?<br/>
              finished : ?
            </div>
            <div style="float:left" class="small-12 columns">
              <h5>Level</h5><br/>
              total : ?<br/>
              ongoing : ?<br/>
              finished : ?
            </div>
            <div style="float:left" class="small-12 columns">
              <h5>Course</h5><br/>
              total : ?<br/>
              ongoing : ?<br/>
              finished : ?
            </div>
          </div>
          <!-- end course stats -->
          <!-- start student stats -->
          <br/>
          <h4>Students</h4>
          <hr/>
          <div class="row">
            <div style="float:left" class="small-12 columns">
              <h5>Students</h5><br/>
              login : 33434<br/>
              total : ?<br/>
              ongoing : ?<br/>
              finished : ?
            </div>
          </div>
          <!-- end of student stats -->
          <!-- start error -->
          <br/>
          <h4>Students</h4>
          <hr/>
          <div class="row">
            <div style="float:left" class="small-12 columns">
              <h5>Students</h5><br/>
              total : ?<br/>
              ongoing : ?<br/>
              finished : ?
            </div>
          </div>
          <!-- enf of error -->
        </div>
      </div>
      <!-- end of content -->
    </div>
  </div>
  <!--end login form -->
</section>
<!--endof body-->