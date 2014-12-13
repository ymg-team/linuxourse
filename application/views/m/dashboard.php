<section id="afterlogin">
	<center>
		<div class="row">
			<div class="large-3 columns"><p></p></div>
			<div class="large-6 columns">
				<div class="level">
					<h1>Recent Course</h1>
					<hr/>
					<p><?php echo $recentCourse['title'];?> :: Level <?php echo $recentCourse['level'];?></p>
					<br>
					<p style="font-size:30px;"><strong> <?php echo $percentage;?>%</strong></p>
					<small style="color:gray">Recent : <?php echo $recentCourse['lastdate']?></small>
					<p><div style="height:10px" class="radius progress success">
						<span style="float:left;color:#fff;width:<?php echo $percentage;?>%;" class="meter"></span>
					</div></p>
					<p><a class="button" href="#">Resume</a></p>
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
							$totalnow = $this->m_course->countCourseStep($uc['id_course'],$uc['id_level']);
							$totalCourse = $this->m_course->countCourseByLevel($uc['id_level']);
							$recentPercentage = number_format(($totalnow*100)/$totalCourse);
							?>
							<a id="btn_course_item" href="#btn_resume">
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
						$totalnow = $this->m_course->countCourseStep($uc['id_course'],$uc['id_level']);
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
								echo '<center><p><strong>not yet</strong></p></center>';
							}
							endforeach;?>
							<!-- end of finished course -->
						</div>					  
					</div>

				</div>				
				<br/>
				<br/>
				<div id="completion">
					<h1><?php echo $recentCourse['title'];?> / <?php echo $recentPercentage;?>%</h1>
					<hr/>
					<?php 
					foreach($recentCompletion as $rc):
						?>
					<table>
						<caption style="margin:10px">Level <?php echo $rc['level']?> : <?php echo $rc['title']?> (100%)</caption>
						<tr>
							<th style="width:80%" scope="column">Activity</th>
							<th style="width:20%" scope="column">Status</th>
						</tr>
						<?php 
						$courseItem = $this->m_course->completedCourseByLevel($rc['id_level'],$recentCourse['id_course']);
						foreach($courseItem as $ci):?>
						<tr>
							<td scope="row"><?php echo $ci['title']?></td>
							<td style="color:green" scope="row">Completed</td>
						</tr>
						<?php endforeach;?>
						<?php 
						$uncompletedCourseItem = $this->m_course->unCompletedCourseByLevel($rc['id_level'],$recentCourse['id_course']);
						foreach($uncompletedCourseItem as $uci):?>
						<tr>
							<td scope="row"><?php echo $uci['title']?></td>
							<td scope="row">Uncompleted</td>
						</tr>
						<?php endforeach;?>

					</table>
					<br/>
				<?php endforeach;?>
				<a id="btn_resume" href="#" class="button large">resume</a>
				<br/>
			</div>
			<!-- badge completion -->
			<h1>Badge Collection</h1>
			<hr/>
			<p>you don't have</p>
			<br/>
		</div>
	</div>
</center>
</section>
<!-- other course -->
<section id="otherCourse">
	<center>
		<div style="background-color:#fff" class="row">		
			<div class="large-8 collapse" columns>
				<h1>Start Other Course</h1>
				<hr/>
				<!-- skill completion -->
				<div class="row">
					<a id="btn_course_item" href="#btn_resume">
						<div style="float:left;padding: 0.9375rem;" class="large-4 columns">						
							<div class="materi-item">
								<div class="materi-title">
									<h5>Basic Networking</h5>								
								</div>
								<hr/>
								<div class="course-detail">
									Learn linux as basic networking
								</div>
								<a href="#" class="button small">start</a>
							</div>
						</div>					
					</a>
					<a id="btn_course_item" href="#btn_resume">
						<div style="float:left;padding: 0.9375rem;" class="large-4 columns">						
							<div class="materi-item">
								<div class="materi-title">
									<h5>Basic Networking</h5>								
								</div>
								<hr/>
								<div class="course-detail">
									Learn linux as basic networking
								</div>
								<a href="#" class="button small">start</a>
							</div>
						</div>					
					</a>
					<a id="btn_course_item" href="#btn_resume">
						<div style="float:left;padding: 0.9375rem;" class="large-4 columns">						
							<div class="materi-item">
								<div class="materi-title">
									<h5>Basic Networking</h5>								
								</div>
								<hr/>
								<div class="course-detail">
									Learn linux as basic networking
								</div>
								<a href="#" class="button small">start</a>
							</div>
						</div>					
					</a>
					<a id="btn_course_item" href="#btn_resume">
						<div style="float:left;padding: 0.9375rem;" class="large-4 columns">						
							<div class="materi-item">
								<div class="materi-title">
									<h5>Basic Networking</h5>								
								</div>
								<hr/>
								<div class="course-detail">
									Learn linux as basic networking
								</div>
								<a href="#" class="button small">start</a>
							</div>
						</div>					
					</a>
					<a id="btn_course_item" href="#btn_resume">
						<div style="float:left;padding: 0.9375rem;" class="large-4 columns">						
							<div class="materi-item">
								<div class="materi-title">
									<h5>Basic Networking</h5>								
								</div>
								<hr/>
								<div class="course-detail">
									Learn linux as basic networking
								</div>
								<a href="#" class="button small">start</a>
							</div>
						</div>					
					</a>
					<a id="btn_course_item" href="#btn_resume">
						<div style="float:left;padding: 0.9375rem;" class="large-4 columns">						
							<div class="materi-item">
								<div class="materi-title">
									<h5>Basic Networking</h5>								
								</div>
								<hr/>
								<div class="course-detail">
									Learn linux as basic networking
								</div>
								<a href="#" class="button small">start</a>
							</div>
						</div>					
					</a>
					<a id="btn_course_item" href="#btn_resume">
						<div style="float:left;padding: 0.9375rem;" class="large-4 columns">						
							<div class="materi-item">
								<div class="materi-title">
									<h5>Basic Networking</h5>								
								</div>
								<hr/>
								<div class="course-detail">
									Learn linux as basic networking
								</div>
								<a href="#" class="button small">start</a>
							</div>
						</div>					
					</a>
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