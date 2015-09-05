<section id="title">
	<center>
		<?php
		if(!empty($student['pp'])){
			$src = base_url('assets/img/avatar/'.$student['pp']);
		} else {
			$src = base_url('assets/img/avatar.png');
		}
		?>	
		<img style="width:100px;border-radius:200px" src="<?php echo $src;?>">	
		<h1><a href="<?php echo site_url('student/v/'.$this->uri->segment(3))?>"><?php echo $student['fullname']?></a></h1>
		<p>Join Date : <?php echo date('d/m/Y', strtotime($student['register_date']));?> | Last Active <?php echo date('d/m/Y', strtotime($student['last_login']));?></p>
	</center>
</section>
<div class="row">
	<br/>
	<div class="base-content" class="large-10 columns">
		<div class="large-12 columns">
			<center>
				<h1>Joined Courses</h1>
				<div class="row">
					<?php foreach($userCourse as $uc):
					$totalnow = $this->m_course->countCourseStepByMateri($uc['id_materi'],$uc['id_level'],$uc['id_course']);
					$totalCourse = $this->m_course->countCourseByMateri($uc['id_materi']);
					$progress = number_format(($totalnow*100)/$totalCourse,1);
					$id = base64_encode(base64_encode($uc['id_materi']));
					$id = str_replace('=', '', $id);
					if(!empty($uc['logo'])){$logo = base_url('assets/img/logo/gray '.$uc['logo']);}
					else{$logo = base_url('assets/img/logo/gray other logo.png'); }
					?>
					<a id="btn_course_item" href="#btn_resume">
						<div style="float:left;padding: 0.9375rem;" class="large-4 columns">						
							<div class="materi-item">
								<center>
									<img src="<?php echo $logo?>"/>
								</center>
								<div class="materi-title">
									<h4><?php echo $uc['title'];?></h4>								
								</div>
								<div class="course-detail">
									<?php echo $uc['description'];?>
								</div>
								<div class="thumb-progress row">
									<div class="small-12 columns">
										<div class="small-10 columns">
											<div style="height:10px;margin-top:5px" class="radius progress">
												<span style="float:left;color:#fff;width:<?php echo $progress;?>%;" class="meter"></span>
											</div>
										</div>
										<div style="float:left" class="small-2 columns">
											<?php echo $progress;?>%
										</div>
									</div>
								</div>
								<a href="<?php echo site_url('course/syllabus/'.$id.'/'.str_replace(' ', '_', $uc['title']))?>" class="button">start</a>
								<a href="<?php echo site_url('course/studentreview/'.$id.'/'.$this->uri->segment(3))?>" class="button secondary">review</a>
							</div>
						</div>					
					</a>
					
				<?php endforeach;?>
			</div>
			<br/>
			<div class="row">
				<h1>Badge Collections</h1>
			</div>
		</center>
		<br/>
	</div>
</div>
</div>