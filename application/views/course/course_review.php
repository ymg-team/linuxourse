<?php
//sount materi completion
$totalnow = $this->m_course->countCourseStepByMateri($detCourse['id_materi'],$detCourse['id_level'],$detCourse['id_course']);
$totalCourse = $this->m_course->countCourseByMateri($detCourse['id_materi']);
$recentPercentage = number_format(($totalnow*100/$totalCourse),1);
?>
<?php
					//encode id user course
$encIdUserCourse = base64_encode(base64_encode($detCourse['id_user_course']));
$encIdUserCourse = str_replace('=', '', $encIdUserCourse);
?>
<section id="title">
	<center>
		<br/>
		<?php
		if(!empty($materi['logo'])){$logo = base_url('assets/img/logo/'.$materi['logo']);}
		else{$logo = base_url('assets/img/logo/other logo.png'); }
		echo '<img src="'.$logo.'"/>'
		?>
		<h1 style="margin:0"><?php echo $materi['title'];?> / <?php echo $recentPercentage;?>%</h1>
		<p><?php echo $materi['description'];?></p>
		<div id="progressanimate" style="height:10px;width:50%" class="radius progress">
			<span style="float:left;color:#fff;width:<?php echo $recentPercentage;?>%;" class="meter"></span>
		</div>
		<hr/>
		<p style="margin:0">Active Student <strong><?php echo $this->m_course->countStudentByMateri($materi['id_materi'],'incomplete')?></strong></p>
		<p style="margin:0">Completed Student <strong><?php echo $this->m_course->countStudentByMateri($materi['id_materi'],'completed')?></strong></p>
		<br/>
		<a href="<?php echo site_url('course/start/'.$encIdUserCourse)?>" class="button large">Resume Course</a>
	</center>
</section>
<section>
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
							<?php
							echo 'Course Begin : '. date('d M Y H:i:s', strtotime($detCourse['startdate']));
							$today = date_create(date('Y-m-d'));
							$last = date_create(date('Y-m-d', strtotime($detCourse['lastdate'])));
							$diff=date_diff($last,$today);
							if($diff->y != 0){
								$log = $diff->y.' Years Ago';
							}else if($diff->m != 0){
								$log = $diff->m.' Months Ago';
							}else if($diff->d != 0){
								$log = $diff->d.' Days Ago';
							} else {
								$log = 'Today';
							}
							?>
							<p style="margin:0"><strong>Course Has Been Start <?php echo $log;?>  </strong></p> 
							<hr/>
							<?php foreach ($level as $l):
							$totalnow = $this->m_course->countCourseStepByLevel($recentCourseStep,$l['id_level']);
							$totalCourse = $this->m_course->countCourseByLevel($l['id_level']);
							$recentPercentage = number_format(($totalnow*100/$totalCourse),1);
							?>
							<p style="margin:0"><strong><?php echo 'Level '.$l['level'].'</strong> : '.$l['title']?> / <?php echo $recentPercentage;?>%</p>
							<p style="margin:0;color:gray"><?php echo $l['description']?></p>
							<div  style="height:10px" class="radius progress">
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
										<td><?php echo $c['title'];?>
											<?php if($c['id_level'] < $detCourse['id_level'] || ($c['step'] <= $recentCourseStep && $c['level'] <= $detCourse['level'])){//if level n course step <= now = completed
												echo '<a href="'.site_url('course/rewind/'.str_replace('=', '', base64_encode(base64_encode($c['id_course']))).'/'.$this->uri->segment(3)).'" style="background-color:#008cba;color:#fff;padding:2px;font-size:9px">rewind</a>';
											}?>
											<br/><small style="color:gray"><?php echo $c['description']?></small></td>
											<td><?php 
											if($c['id_level'] < $detCourse['id_level'] || ($c['step'] <= $recentCourseStep && $c['level'] <= $detCourse['level'])){//if level n course step <= now = completed
												echo '<span style="color:green" class="fi-check"> completed</span>';
											} else {
												echo '<span style="color:red" class="fi-x"> waiting</span>';
											}
											?>
										</td>
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
				<a href="<?php echo site_url('course/start/'.$encIdUserCourse)?>" class="button large">Resume Course</a>
			</div>
		</div>
	</center>
</section>
<!-- end of syllabus list