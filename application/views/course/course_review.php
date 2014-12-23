<?php
//sount materi completion
$totalnow = $this->m_course->countCourseStepByMateri($detCourse['id_materi'],$detCourse['id_level'],$detCourse['id_course']);
$totalCourse = $this->m_course->countCourseByMateri($detCourse['id_materi']);
$recentPercentage = number_format(($totalnow*100/$totalCourse),1);
?>
<section id="title">
	<center>		
		<h1 style="margin:0"><?php echo $materi['title'];?> / <?php echo $recentPercentage;?>%</h1>
		<p><?php echo $materi['description'];?></p>
		<div style="height:10px;width:50%" class="radius progress success">
			<span style="float:left;color:#fff;width:<?php echo $recentPercentage;?>%;" class="meter"></span>
		</div>
		<hr/>
		<p style="margin:0">Active Student <strong><?php echo $this->m_user->countAciveUserOnCourse($materi['id_materi'])?></strong></p>
		<p style="margin:0">Completed Student <strong><?php echo $this->m_user->countCompletedUserOnCourse($materi['id_materi'])?></strong></p>
	</center>
</section>
<section id="completion">
	<center>		
		<div class="row">			
			<div class="large-8 collapse" columns>				
				<!-- skill completion -->
				<div class="row">
					<dl style="border-top:1px solid #E8E8E8" class="tabs" data-tab>
						<dd style="width:33.333333333%" class="active"><a href="#mycourse">Review</a></dd>
						<dd style="width:33.333333333%"><a href="">Badges</a></dd>
						<dd style="width:33.333333333%"><a href="#finishedcourse">Finished Student</a></dd>
					</dl>
					<br/>
					<div class="tabs-content">
						<div class="content active" id="mycourse">
							<!-- level and review list -->
							<p style="margin:0"><strong>Course Has Been Start <?php echo $this->m_course->countDiffCourse($this->session->userdata['student_login']['id_user'],$materi['id_materi'])?> Days Ago  </strong></p> 
							<hr/>
							<?php foreach ($level as $l):
							$totalnow = $this->m_course->countCourseStepByLevel($recentCourseId,$l['id_level']);
							$totalCourse = $this->m_course->countCourseByLevel($l['id_level']);
							$recentPercentage = number_format(($totalnow*100/$totalCourse),1);
							?>
							<p style="margin:0"><strong><?php echo 'Level '.$l['level'].'</strong> : '.$l['title']?> / <?php echo $recentPercentage;?>%</p>
							<p style="margin:0;color:gray"><?php echo $l['description']?></p>
							<div style="height:10px" class="radius progress success">
								<span style="float:left;color:#fff;width:<?php echo $recentPercentage;?>%;" class="meter"></span>
							</div>
							<br/><br/>
							<table>
								<tr>
									<th style="width:80%">Course</th>
									<th style="width:20%">Status</th>
								</tr>
								<?php
									$course = $this->m_course->courseByLevel($l['id_level']);//show course by level
									foreach($course as $c):?>
									<tr>
										<td><?php echo $c['title'];?><br/><small style="color:gray"><?php echo $c['description']?></small></td>
										<td><?php 
											if($c['id_level'] < $detCourse['id_level'] || ($c['step'] <= $recentCourseStep && $c['level'] <= $detCourse['level'])){//if level n course step <= now = completed
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
								<!-- end of review list-->
							</div>
							<div class="content" id="finishedcourse">
								<!-- start of completed user -->
								<a data-tooltip aria-haspopup="true" title="Username"  href=""><img src=""></a>
								<!-- end of completed user -->
							</div>					  
						</div>

					</div>
					<?php
					//encode id user course
					$encIdUserCourse = base64_encode(base64_encode($detCourse['id_user_course']));
					$encIdUserCourse = str_replace('=', '', $encIdUserCourse);
					?>
					<a href="<?php echo site_url('course/start/'.$encIdUserCourse)?>" class="button large">Resume Course</a>
				</div>
			</div>
		</center>
	</section>
<!-- end of syllabus list