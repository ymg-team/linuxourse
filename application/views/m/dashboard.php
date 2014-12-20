<section id="afterlogin">
	<center>
		<div class="row">
			<div class="large-3 columns"><p></p></div>
			<div class="large-6 columns">
				<div class="level">
					<h1>Recent Course</h1>
					<hr/>
					<p>
						<?php 
						echo $recentCourse['materi_title'];?> :: Level <?php echo $recentCourse['level'];
						$id = base64_encode(base64_encode($recentCourse['id_materi']));
						$id = str_replace('=', '', $id);
						?></p>
						<br>
						<p style="font-size:30px;"><strong> <?php echo $percentage;?>%</strong></p>
						<small style="color:gray">Recent : <?php echo $recentCourse['lastdate']?></small>
						<p><div style="height:10px" class="radius progress success">
							<span style="float:left;color:#fff;width:<?php echo $percentage;?>%;" class="meter"></span>
						</div></p>
						<p><a class="button" href="<?php echo site_url('course/review/'.$id)?>">Review</a></p>
					</div>
				</div>
				<div class="large-3 columns"><p></p></div>
			</div>
		</center>
	</section>
	<section id="completion">
		<center>		
			<div class="row">			
				<div class="large-8 collapse" columns>
					<!-- skill completion -->
					<div class="row">
						<dl style="border-top:1px solid #E8E8E8" class="tabs" data-tab>
							<dd style="width:50%" class="active"><a href="#mycourse">My Course</a></dd>
							<dd style="width:50%"><a href="#finishedcourse">Finished Course</a></dd>
						</dl>
						<div class="tabs-content">
							<div class="content active" id="mycourse">
								<!-- start of my course -->
								<?php foreach($userCourse as $uc):
								$totalnow = $this->m_course->countCourseStepByMateri($uc['id_course'],$uc['id_materi']);
								$totalCourse = $this->m_course->countCourseByMateri($uc['id_materi']);
								$recentPercentage = number_format(($totalnow*100/$totalCourse),1);
								$id = base64_encode(base64_encode($uc['id_materi']));
								$id = str_replace('=', '', $id);
								?>
								<a id="btn_course_item" href="<?php echo site_url('course/review/'.$id)?>">
									<div style="float:left;padding: 0.9375rem;" class="large-4 columns">						
										<div class="materi-item">
											<div class="materi-title">
												<h5><?php echo $uc['title']?></h5>								
											</div>
											<hr/>
											<h2><strong><?php echo $recentPercentage;?>%</strong></h2>
											<small>recent : <?php echo $uc['lastdate']?></small>
											<p><div style="height:10px" class="radius progress success">
												<span style="float:left;color:#fff;width:<?php echo $recentPercentage?>%;" class="meter"></span>
											</div></p> 
										</div>
									</div>					
								</a>
							<?php endforeach;?>						
							<!-- end of my course -->
						</div>
						<div class="content" id="finishedcourse">
							<!-- start of finished course -->
							<?php foreach($userCourse as $uc):
							$totalnow = $this->m_course->countCourseStepByLevel($uc['id_course'],$uc['id_level']);
							$totalCourse = $this->m_course->countCourseByLevel($uc['id_level']);
							$percentage = number_format(($totalnow*100)/$totalCourse);
							if($percentage == 100){
								?>
								<a id="btn_course_item" href="#btn_resume">
									<div style="float:left;padding: 0.9375rem;" class="large-4 columns">						
										<div class="materi-item">
											<div class="materi-title">
												<h5><?php echo $uc['title']?></h5>								
											</div>
											<hr/>
											<h2><strong><?php echo $percentage;?>%</strong></h2>
											<small>recent : <?php echo $uc['lastdate']?></small>
											<p><div style="height:10px" class="radius progress success">
												<span style="float:left;color:#fff;width:<?php echo $percentage?>%;" class="meter"></span>
											</div></p> 
										</div>
									</div>					
								</a>
								<?php } else {
									echo '<center><p><strong>you don\'t have</strong></p></center>';
								}
								endforeach;?>
								<!-- end of finished course -->
							</div>					  
						</div>
					</div>				
					<br/>
					<br/>
					<div id="completion">
						<h1><?php echo $recentCourse['materi_title'];?> / <?php echo $recentPercentage;?>%</h1>
						<hr/>
						<?php 
						foreach($recentCompletion as $rc):
							$nowLevelCompletion = $this->m_course->countCourseStepByLevel($recentCourse['id_course'],$rc['id_level']);
						$rencentLevelCompletion = $this->m_course->countCourseByLevel($rc['id_level']);
						$levelPercentage = ($nowLevelCompletion * 100) / $rencentLevelCompletion;
						$levelPercentage = number_format($levelPercentage,1);						
						?>
						<h5 style="margin:10px">Level <?php echo $rc['level']?> : <?php echo $rc['title']?> (<?php echo $levelPercentage;?>%)</h5>
						<div style="height:10px" class="radius progress success">
							<span style="float:left;color:#fff;width:<?php if($levelPercentage == 0){
								$levelPercentage = 0.1;
							}echo $levelPercentage?>%;" class="meter"></span>
						</div>
						<table>						
							<tr>
								<th style="width:80%" scope="column">Activity</th>
								<th style="width:20%" scope="column">Status</th>
							</tr>
							<?php 
						$recentCourseStep = $this->m_course->getMyRecentCourseStep($this->session->userdata['student_login']['id_user'],$recentCourse['id_materi']);//get recent id course by id_user n id_materi
						$course = $this->m_course->courseByLevel($rc['id_level']);//show course by level
						foreach($course as $c):?>
						<tr>
							<td><?php echo $c['title'];?><br/><small style="color:gray"><?php echo $c['description']?></small></td>
							<td><?php 
								if($c['step'] <= $recentCourseStep){
									echo '<span style="color:green" class="fi-check"> completed</span>';
								} else {
									echo '<span style="color:red" class="fi-x"> waiting</span>';
								}
								?></td>
							</tr>
							<?php
							endforeach;
							?>
						</table>
						<br/><br/>
					<?php endforeach ?>
					<?php
		//show recent course id
					$idRecentCourse = base64_encode(base64_encode($recentCourse['id_user_course']));
					$idRecentCourse = str_replace('=', '', $idRecentCourse);
					?>
					<a href="<?php echo site_url('course/start/'.$idRecentCourse)?>" class="button large">resume</a>
					<br/>
				</div>
				<!-- badge completion -->
				<h1>Badge Collection</h1>
				<hr/>
				<p><strong>you don't have</strong></p>
				<br/>
			</div>
		</div>
	</center>
</section>
<!-- other course -->
<section id="otherCourse">
	<center>
		<div class="row">		
			<div class="large-12 collapse" columns>
				<h1 style="margin:0">Start Other Course</h1>
				<small>improve the mastery of Linux by following other courses</small>
				<hr/>
				<!-- skill completion -->
				<div style="background-color:#fff" class="row">
					<?php $myIdMateri = array();
					foreach($myMateri as $mm):
					array_push($myIdMateri, $mm['id_materi']);
					endforeach;?>
					<?php 
					foreach($allMateri as $am):
							if(!in_array($am['id_materi'], $myIdMateri)) { 
								$idMateri = base64_encode(base64_encode($am['id_materi']));
								$idMateri = str_replace('=', '', $idMateri);
								$titleMateri = str_replace(' ', '-', $am['title']);
								?>
								<a id="btn_course_item" href="#btn_resume">
									<div style="float:left;padding: 0.9375rem;" class="large-4 columns">						
										<div class="materi-item">
											<div class="materi-title">
												<h5><?php echo $am['title'];?></h5>								
											</div>
											<hr/>
											<div class="course-detail">
												<?php echo $am['description'];?>
											</div>
											<a href="<?php echo site_url('course/syllabus/'.$idMateri.'/'.$titleMateri)?>" class="button small">start</a>
										</div>
									</div>					
								</a>
								<?php } ?>							
						<?php endforeach;?>				
					</div>
				</div>
			</div>
		</center>
	</section>

	<!-- success login modal -->
	<div id="loginSuccess" class="reveal-modal small" data-reveal>
		<h2>Login Success</h2>
		<p class="lead">welcome students</p>
		<p>Let's improve your level!</p>
		<a class="close-reveal-modal">&#215;</a>
	</div>