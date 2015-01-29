 <div class="admin-menu">
  <h3>Manage</h3>
  <hr/>
  <ul class="side-nav">
    <li id="materi"><a href="<?php echo site_url('manage/materi')?>">Materi <span class="admin-label label"><?php echo $this->m_admin->countShowAllMateri()?></span></a></li>
    <li id="level"><a href="<?php echo site_url('manage/level')?>">Level <span class="admin-label label"><?php echo $this->m_admin->countShowAllLevel()?></span></a></li>
    <li id="course"><a href="<?php echo site_url('manage/course')?>">Course <span class="admin-label label"><?php echo $this->m_admin->countShowAllCourse()?></span></a></li>
    <li id="certivicate"><a href="<?php echo site_url('manage/certivicate')?>">Certivicate <span class="admin-label label">?</span></a></li>
    <hr/>
    <li id="storage"><a href="<?php echo site_url('manage/storage')?>">Directory|File <span class="admin-label label"><?php echo $this->m_admin->countAllDirectories()?>|<?php echo $this->m_admin->countAllFiles()?></span></a></li>
    <hr/>
    <li id="students"><a href="<?php echo site_url('manage/students')?>">Student <span class="admin-label label"><?php echo $this->m_admin->countAllStudents();?></span></a></li>
    <hr/>
    <li id="discussions"><a href="<?php echo site_url('manage/discussions')?>">Discussions <span class="admin-label label"><?php echo $this->m_admin->countAllDiscussion()?></span></a></li>
    <li id="comments"><a href="<?php echo site_url('manage/comments')?>">Comments <span class="admin-label label"><?php echo $this->m_admin->countAllComment()?></span></a></li>
    <hr/>
    <li id="admin"><a href="<?php echo site_url('manage/admin')?>">Admin <span class="admin-label label"><?php echo $this->m_admin->countAllAdmin();?></span></a></li>
    <li id="moderator"><a href="<?php echo site_url('manage/moderator')?>">Moderator <span class="admin-label label"><?php echo $this->m_admin->countAllModerator();?></span></a></li>
  </ul>
  <br/>
  <h3>Stats</h3>
  <hr/>
  <ul class="side-nav">
    <li id="coursestats"><a href="#">Course</a></li>
    <li id="studentstats"><a href="#">Students</a></li>
    <li id="discussionstats"><a href="#">Discussion</a></li>            
  </ul>
   <h3>Profile</h3>
  <hr/>
  <ul class="side-nav">
   <li id="coursestats"><a href="#">Edit</a></li>
  <li><a href="<?php echo site_url('manage/logout');?>">Logout</a></li>         
  </ul>
</div>