<section id="title">
	<center>
		<?php
		if(!empty($this->session->userdata['student_login']['pp'])){
			$src = base_url('assets/img/avatar/'.$this->session->userdata['student_login']['pp']);
		} else {
			$src = base_url('assets/img/avatar.png');
		}
		?>	
		<img style="width:100px;border-radius:200px" src="<?php echo $src;?>">	
		<h1><?php echo $student['fullname']?></h1>
		<p style="color:gray">Join Date : <?php echo date('d/m/Y', strtotime($student['register_date']));?> | Last Active <?php echo date('d/m/Y', strtotime($student['last_login']));?></p>
	</center>
</section>
<div class="row">
	<br/>
	<div class="base-content" class="large-10 columns">
		<div class="large-offset-1 large-10 columns">
			<center>
				<h4>Courses</h4>
				<div class="row">
					<?php foreach($userCourse as $uc):
					$totalnow = $this->m_course->countCourseStepByMateri($uc['id_materi'],$uc['id_level'],$uc['id_course']);
					$totalCourse = $this->m_course->countCourseByMateri($uc['id_materi']);
					$percentage = number_format(($totalnow*100)/$totalCourse,1);
					$id = base64_encode(base64_encode($uc['id_level']));
					$id = str_replace('=', '', $id);
					?>
					<a id="btn_course_item" href="<?php echo site_url('course/syllabus/'.$id);?>">
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
				<?php endforeach;?>
			</div>
			<hr/>
			<div class="row">
				<h4>Badge Collections</h4>
			</div>
		</center>
		<br/>
	</div>
</div>
</div>