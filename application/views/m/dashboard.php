<script type="text/javascript">
	$(document).ready(function(){
		$("#btnoverview").click(function() {
			$('html, body').animate({
				scrollTop: $("#overview").offset().top
			}, 500);
		});
		$(window).scroll(function(){
			if ($(this).scrollTop() > 100) {
				$("#btntop").fadeIn();
			} else {
				$("#btntop").fadeOut();
			}
		});

		$("#btntop").click(function(){
			$('html, body').animate({scrollTop : 0},800);
			return false;
		});
	});
	function showlast(x){
		id = 'last-'+x;
		if($('#'+id).hover()){
			$('#'+id).show();			
		}
		else {
			$('#'+id).hide();
		}
	}
	function hidelast(x){
		id = 'last-'+x;
		$('#'+id).hide();
	}
</script>
<a class="button" style="display:none;padding:10px;position: fixed;right: 0;bottom: 0;" id="btntop"><span style="font-size:2rem"; class="fi-arrow-up"></span></a>
<section id="afterlogin">
	<center>
		<?php
		if(!empty($_GET['note'])){
			echo '
			<div data-alert class="alert-box success radius">
				'.$_GET['note'].'.
				<a href="'.site_url().'" class="close">&times;</a>
			</div>
			';
		}
		?>
		<div class="row">
			<div class="large-2 columns"><p></p></div>
			<div class="large-8 columns">
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
						<p style="font-size:30px;"><strong> <?php echo $recentMateriPercentage;?>%</strong></p>
						<small style="color:gray">Recent : <?php echo $recentCourse['lastdate']?></small>
						<p><div id="progressanimate" style="height:10px" class="radius progress">
							<span style="float:left;color:#fff;width:<?php echo $recentMateriPercentage;?>%;" class="meter"></span>
						</div></p>
						<p><a style="width:30%" class="button" href="<?php echo site_url('course/start/'.$id)?>">Resume</a>
							<br/>
							<a id="btnoverview">Overview Recent Course</a>
						</p>

					</div>
				</div>
				<div class="large-3 columns"><p></p></div>
			</div>
		</center>
	</section>
	<section class="row" style="background-color:#fff">
		<center>
			<div class="large-8 large-offset-2 columns">
				<dl class="tabs" data-tab>
					<dd style="width:50%" class="active"><a href="#mycourse">On Progress Course (<?php echo $this->m_course->countMyCourse($this->session->userdata['student_login']['id_user'],'incomplete')?>)</a></dd>
					<dd style="width:50%"><a href="#finishedcourse">Completing Course (<?php echo $this->m_course->countMyCourse($this->session->userdata['student_login']['id_user'],'completed')?>)</a></dd>
				</dl>
			</div>
		</center>
	</section>
	<section id="completion">
		<center>		
			<div class="row">			
				<div class="large-10 collapse" columns>
					<!-- skill completion -->
					<div class="row">						
						<div class="tabs-content">
							<div class="content active" id="mycourse">
								<!-- start of my course -->
								<?php foreach($userCourse as $uc):
								if($uc['status']=='incomplete'):
									$listTotalnow = $this->m_course->countCourseStepByMateri($uc['id_materi'],$uc['id_level'],$uc['id_course']);
								$listTotalCourse = $this->m_course->countCourseByMateri($uc['id_materi']);
								$listRecentPercentage = number_format(($listTotalnow*100/$listTotalCourse),1);
								$id = base64_encode(base64_encode($uc['id_materi']));
								$id = str_replace('=', '', $id);
								//last course
								$today = date_create(date('Y-m-d'));
								$last = date_create(date('Y-m-d', strtotime($uc['lastdate'])));
								$diff=date_diff($last,$today);
								if($diff->y != 0){
									$log = $diff->y.' Years ago';
								}else if($diff->m != 0){
									$log = $diff->m.' Months ago';
								}else if($diff->d != 0){
									$log = $diff->d.' Days ago';
								}
								?>
								<a onmouseout="hidelast('<?php echo $id?>')" onmouseover="showlast('<?php echo $id?>')" href="<?php echo site_url('course/review/'.$id)?>">
									<div class="joinmateri row">									
										<div class="small-5 columns"><p><strong><?php echo $uc['title']?></strong></p></div>
										<div class="small-4 columns">
											<div style="height:10px;margin-top:5px" class="radius progress">
												<span style="float:left;color:#fff;width:<?php echo $listRecentPercentage;?>%;" class="meter"></span>
											</div>
										</div>
										<div style="float:left" class="small-1 columns"><p><?php echo $listRecentPercentage;?>%</p></div>
										<div class="small-2 columns"><small style="display:none" id="last-<?php echo $id?>"><?php echo $log;?></small><span class="fi-play-circle" style="float:right;font-size:25px"></span></div>									
									</div>
								</a>
								
							<?php endif;endforeach;?>						
							<!-- end of my course -->
						</div>
						<div class="content" id="finishedcourse">
							<!-- start finished my course -->
							<?php foreach($userCourse as $uc):
							if($uc['status']=='completed'):
								$listTotalnow = $this->m_course->countCourseStepByMateri($uc['id_materi'],$uc['id_level'],$uc['id_course']);
							$listTotalCourse = $this->m_course->countCourseByMateri($uc['id_materi']);
							$listRecentPercentage = number_format(($listTotalnow*100/$listTotalCourse),1);
							$id = base64_encode(base64_encode($uc['id_materi']));
							$id = str_replace('=', '', $id);
								//last course
							$today = date_create(date('Y-m-d'));
							$last = date_create(date('Y-m-d', strtotime($uc['lastdate'])));
							$diff=date_diff($last,$today);
							if($diff->y != 0){
								$log = $diff->y.' Years';
							}else if($diff->m != 0){
								$log = $diff->m.' Months';
							}else if($diff->d != 0){
								$log = $diff->d.' Days';
							}
							?>
							<a onmouseout="hidelast('<?php echo $id?>')" onmouseover="showlast('<?php echo $id?>')" href="<?php echo site_url('course/review/'.$id)?>">
								<div class="joinmateri row">									
									<div class="small-5 columns"><p><strong><?php echo $uc['title']?></strong></p></div>
									<div class="small-4 columns">
										<div style="height:10px;margin-top:5px" class="radius progress">
											<span style="float:left;color:#fff;width:<?php echo $listRecentPercentage;?>%;" class="meter"></span>
										</div>
									</div>
									<div style="float:left" class="small-1 columns"><p><?php echo $listRecentPercentage;?>%</p></div>
									<div class="small-2 columns"><small style="display:none" id="last-<?php echo $id?>"><?php echo $log;?> ago</small><span class="fi-play-circle" style="float:right;font-size:25px"></span></div>									
								</div>
							</a>

						<?php endif;endforeach;?>						
						<!-- end of my course -->
					</div>					  
				</div>
			</div>				
			<br/>
			<br/>			
			<!-- badge completion -->
			<h1>Badge Collection</h1>
			<hr/>
			<p><strong>you don't have</strong></p>
			<br/>
		</div>
	</div>
</center>
</section>
<!-- recent course completion -->
<br/><br/>
<section id="overview" class="row" style="background-color:#fff;padding:30px 0">
	<div class="large-8 large-offset-2 columns">
		<center>
			<div>
				<h1><?php echo $recentCourse['materi_title'];?> / <?php echo $recentMateriPercentage;?>%</h1>
				<hr/>
				<?php 
				foreach($recentCompletion as $rc):
					$nowLevelCompletion = $this->m_course->countCourseStepByLevel($recentCourse['step'],$rc['id_level']);
				$rencentLevelCompletion = $this->m_course->countCourseByLevel($rc['id_level']);
				$levelPercentage = ($nowLevelCompletion * 100) / $rencentLevelCompletion;
				$levelPercentage = number_format($levelPercentage,1);						
				?>
				<h5 style="margin:10px">Level <?php echo $rc['level']?> : <?php echo $rc['title']?> (<?php echo $levelPercentage;?>%)</h5>
				<div style="height:10px" class="radius progress ">
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
						//get recent id level  by id_user n id_materi
					$recentLevel = $this->m_course->getMyRecentLevel($this->session->userdata['student_login']['id_user'],$recentCourse['id_materi']);
						//get recent id course by id_user n id_materi
					$recentCourseStep = $this->m_course->getMyRecentCourseStep($this->session->userdata['student_login']['id_user'],$recentCourse['id_materi']);
						$course = $this->m_course->courseByLevel($rc['id_level']);//show course by level
						foreach($course as $c):?>
						<tr>
							<td><?php echo $c['title'];?><br/><small style="color:gray"><?php echo $c['description']?></small></td>
							<td><?php 
								if($c['id_level'] < $recentCourse['id_level'] || ($c['step'] <= $recentCourseStep && $c['level'] <= $recentLevel)){//if level n course step <= now = completed
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
			</center>
		</div>
	</section>
	<!-- other course -->
	<section id="otherCourse">
		<center>
			<div class="row">		
				<div class="large-12 collapse" columns>
					<h1 style="margin:0">Available Course Materi</h1>
					<p>improve the mastery of Linux by following other courses</p>
					<!-- skill completion -->
					<div style="background-color:#fff" class="row">
						<?php $myIdMateri = array();
						foreach($myMateri as $mm):
							array_push($myIdMateri, $mm['id_materi']);
						endforeach;?>
						<?php 
						foreach($allMateri as $am):
							if(!in_array($am['id_materi'], $myIdMateri)){
								$progress = 0;
							}else{
								foreach($userCourse as $uc):
									if($uc['id_materi']== $am['id_materi']):
										$listTotalnow = $this->m_course->countCourseStepByMateri($uc['id_materi'],$uc['id_level'],$uc['id_course']);
									$listTotalCourse = $this->m_course->countCourseByMateri($uc['id_materi']);
									$progress = number_format(($listTotalnow*100/$listTotalCourse),1);
									endif;
									endforeach;								
								}
								$idMateri = base64_encode(base64_encode($am['id_materi']));
								$idMateri = str_replace('=', '', $idMateri);
								$titleMateri = str_replace(' ', '-', $am['title']);
								if(!empty($am['logo'])){$logo = base_url('assets/img/logo/'.$am['logo']);}
								else{$logo = base_url('assets/img/logo/other logo.png'); }
								?>
								<a id="btn_course_item" href="#btn_resume">
									<div style="float:left;padding: 0.9375rem;" class="large-4 columns">						
										<div class="materi-item">
											<center>
												<img src="<?php echo $logo?>"/>
											</center>
											<div class="materi-title">
												<h4><?php echo $am['title'];?></h4>								
											</div>
											<div class="course-detail">
												<?php echo $am['description'];?>
											</div>
											<div class="thumb-progress row">
												<div class="small-12 columns">
													<div class="small-10 columns collapse">
														<div style="height:10px;margin-top:5px" class="radius progress">
															<span style="float:left;color:#fff;width:<?php echo $progress;?>%;" class="meter"></span>
														</div>
													</div>
													<div class="small-2 columns">
														<?php echo $progress;?>%
													</div>
												</div>
											</div>
											<a href="<?php echo site_url('course/syllabus/'.$idMateri.'/'.$titleMateri)?>" class="button">start</a>
										</div>
									</div>					
								</a>						
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