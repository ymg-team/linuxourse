<section id="title">
	<center>
		<h1 style="margin:0"><?php echo $materi['title'];?> / x%</h1>
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
						<dd style="width:33.333333333%" class="active"><a href="#mycourse">Review</a></dd>
						<dd style="width:33.333333333%"><a href="">Badges</a></dd>
						<dd style="width:33.333333333%"><a href="#finishedcourse">Finished Student</a></dd>
					</dl>
					<br/>
					<div class="tabs-content">
						<div class="content active" id="mycourse">
							<!-- level and review list -->
							<p style="margin:0"><strong>Course Has Been Start 45 Days Ago  </strong></p> 
							<hr/>
							<?php foreach ($level as $l):
							?>

							<p style="margin:0"><strong><?php echo 'Level '.$l['level'].'</strong> : '.$l['title']?> / x%</p>
							<p style="margin:0;color:gray"><?php echo $l['description']?></p>
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
								<!-- end of review list-->
							</div>
							<div class="content" id="finishedcourse">
								<!-- start of completed user -->
								<a data-tooltip aria-haspopup="true" title="Username"  href=""><img src=""></a>
								<!-- end of completed user -->
							</div>					  
						</div>

					</div>
					<form><button type="submit" id="btn_resume" href="#" class="button large">Resume Course</button>
					</form>
				</div>
			</div>
		</center>
	</section>
<!-- end of syllabus list