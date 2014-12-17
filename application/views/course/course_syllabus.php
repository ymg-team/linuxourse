<section id="title">
	<center>
		<h1 style="margin:0"><?php echo $materi['title'];?></h1>
		<p><?php echo $materi['description'];?></p>
		<hr/>
		<p style="margin:0">Active Student <strong>345</strong></p>
		<p style="margin:0">Completing Student <strong>345</strong></p>
	</center>
</section>
<section id="completion">
	<center>		
		<div class="row">			
			<div class="large-8 collapse" columns>				
				<!-- skill completion -->
				<div class="row">
					<dl style="border-top:1px solid #E8E8E8" class="tabs" data-tab>
						<dd style="width:50%" class="active"><a href="#mycourse">Course Syllabus</a></dd>
						<dd style="width:50%"><a href="#finishedcourse">Student Has Completed</a></dd>
					</dl>
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
						<div class="content" id="finishedcourse">
							<!-- start of completed user -->
							<a data-tooltip aria-haspopup="true" title="Username"  href=""><img src=""></a>
							<!-- end of completed user -->
						</div>					  
					</div>

				</div>
				<form>
					<label><input type="checkbox" required><a href="#"> i agree terms and conditions</a></label>
					<button type="submit" id="btn_resume" href="#" class="button large">Start Course</button>
				</form>
			</div>
		</div>
	</center>
</section>
<!-- end of syllabus list