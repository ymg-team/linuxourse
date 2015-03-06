<script>
	$(document).ready(function(){
		$("#btndown").click(function() {
			$('html, body').animate({
				scrollTop: $("#btndown").offset().top
			}, 800);
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
	function lattestCompletedStudents(idmateri){
		content = $('#completedstudent').html();
		// alert(content);
		if(content == ''){//if completed student no view
			$('#completedstudent').html('<center><img style="width:30px" src="<?php echo base_url("assets/img/loader.gif")?>"></center>');
			//alert('div is empty');
			url = '<?php echo ''?>';
		}else{
			//alert('div not empty');
			return false;//do no action
		}		
	}
</script>
<a class="button" style="display:none;padding:10px;position: fixed;right: 0;bottom: 0;" id="btntop"><span style="font-size:2rem"; class="fi-arrow-up"></span></a>

<section id="title">
	<center>
		<?php
		if(!empty($materi['logo'])){
			$logo = base_url('assets/img/logo/'.$materi['logo']);
		}else {
			$logo = base_url('assets/img/logo/other logo.png');
		}
		?>
		<img src="<?php echo $logo?>">
		<h1 style="margin:0"><?php echo $materi['title'];?></h1>
		<p><?php echo $materi['description'];?></p>
		<hr/>
		<p style="margin:0">Active Student <strong><?php echo $activeUser;?></strong></p>
		<p style="margin:0">Completed Student <strong><?php echo $completedUser;?></strong></p>
	</center>
</section>
<section id="completion">
	<center>		
		<div class="row">			
			<div class="large-8 collapse" columns>				
				<!-- skill completion -->
				<div class="row">
					<!-- <dl style="border-top:1px solid #E8E8E8" class="tabs" data-tab>
						<dd style="width:50%" class="active"><a href="#mycourse">Course Syllabus</a></dd>
						<dd style="width:50%"><a onclick="lattestCompletedStudents(<?php echo $materi['id_materi']?>)" href="#completedstudent">Student Has Completed</a></dd>
					</dl> -->
					<br/>
					<div class="tabs-content">
						<div class="content active" id="mycourse">
							<!-- level and syllabus list -->
							<?php foreach ($level as $l):
							$estimatetime = $this->m_course->countEstimateCourseByLevel($l['id_level']);
							$totalestimate = $estimatetime['estimate'];
							if($totalestimate >= 60){
								$totalestimate = number_format(($totalestimate / 60)).' Hours';
							}else if(empty($totalestimate)){
								$totalestimate = '0 Minutes';
							}else {
								$totalestimate = $totalestimate.' Minutes';
							}
							?>
							<p style="margin:0"><strong><?php echo 'Level '.$l['level'].'</strong> : '.$l['title']?> / estimate : <?php echo $totalestimate;?></p>
							<p style="margin:0;color:gray"><?php echo $l['description']?></p>
							<br/><br/>
							<table>
								<tr>
									<th style="width:80%">Course</th>
									<th style="width:20%">Estimate</th>
								</tr>
								<?php
									$course = $this->m_course->courseByLevel($l['id_level']);//show course by level
									foreach($course as $c):?>
									<tr>
										<td><?php echo $c['title'];?><br/><small style="color:gray"><?php echo $c['description']?></small></td>
										<td><?php echo $c['estimate'];?> minutes</td>
									</tr>
									<?php
									endforeach;
									?>
								</table>
								<br/><br/>
							<?php endforeach ?>
							<!-- end of syllabus list-->
						</div>
						<div class="content" id="completedstudent"></div>					  
					</div>

				</div>
				<form action="<?php echo site_url('course/newcourse')?>" method="POST">
					<label><input name="check_tnc" type="checkbox" required><a target="_blank" href="<?php echo site_url('news/read/TXc9PQ/Terms-And-Conditions');?>"> i agree terms and conditions</a></label>
					<input type="hidden" name="id_materi" value="<?php echo $this->uri->segment(3);?>">
					<button type="submit" id="btn_resume" href="#" class="button large">Start Course</button>
				</form>
			</div>
		</div>
	</center>
</section>
<!-- end of syllabus list