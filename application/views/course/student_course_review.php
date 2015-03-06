<script type="text/javascript">
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
	//get completed students
	function completedStudent(idmateri,limit,offset){
		$('#finishedcourse').html('loading...');
		url = '<?php echo site_url("course/studentCompletingMateri");?>';
		$.ajax({
			url:url,
			type:'post',
			data:{limit:limit,offset:offset,idmateri:idmateri},
			success:function(response){
				//alert(response.length);
				if(response.length<10){
					$('#finishedcourse').html('<h4>student not found</h4>');
				}else{
					$('#finishedcourse').html(response);
					$('#studentloader').hide();
				}
				
			},
			error:function(){
				alert('something wrong, please refresh page');
				$('#finishedcourse').html('cannot show data');
			}
		});
	}
</script>
<a class="button" style="display:none;padding:10px;position: fixed;right: 0;bottom: 0;" id="btntop"><span style="font-size:2rem"; class="fi-arrow-up"></span></a>
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
		<h1><a href="<?php echo site_url('student/v/'.$this->uri->segment(4))?>"><?php echo $student['fullname']?></a></h1>
		<p style="color:gray">Join Date : <?php echo date('d/m/Y', strtotime($student['register_date']));?> | Last Active <?php echo date('d/m/Y', strtotime($student['last_login']));?></p>
	</center>
</section>
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
<section style="margin-top:0;border-top:1px solid #e4e4e4" id="title">
	<center>
		<br/>
		<h1 style="margin:0"><?php echo $materi['title'];?> / <?php echo $recentPercentage;?>%</h1>
		<p><?php echo $materi['description'];?></p>
		<div id="progressanimate" style="height:10px;width:50%" class="radius progress">
			<span style="float:left;color:#fff;width:<?php echo $recentPercentage;?>%;" class="meter"></span>
		</div>
		<hr/>
		<p style="margin:0">Active Student <strong><?php echo $this->m_course->countStudentByMateri($materi['id_materi'],'incomplete')?></strong></p>
		<p style="margin:0">Completed Student <strong><?php echo $this->m_course->countStudentByMateri($materi['id_materi'],'completed')?></strong></p>
		
	</center>
</section>
<?php 
$mytime =  $detuserCourse['finishtime'];
$mytime = json_decode($mytime,true);//json to array
?>
<section>
	<center>		
		<div class="row">			
			<div class="large-8 collapse" columns>				
				<!-- skill completion -->
				<div class="row">
					<dl style="border-top:1px solid #E8E8E8" class="tabs" data-tab>
						<dd style="width:33.333333333%" class="active"><a href="#mycourse">Review</a></dd>
						<dd style="width:33.333333333%"><a href="">Badges</a></dd>
						<dd style="width:33.333333333%"><a href="#finishedcourse" onclick="completedStudent(<?php echo $materi['id_materi'];?>,20,0)">Finished Student</a></dd>
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
									<th style="width:70%">Course</th>
									<th style="width:10%">Estimate</th>
									<th style="width:10%">Goal</th>
									<th style="width:10%">Status</th>
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
											<td><?php echo $c['estimate'].'m'; ?></td>
											<td>
												<?php 
											if($c['id_level'] < $detCourse['id_level'] || ($c['step'] <= $recentCourseStep && $c['level'] <= $detCourse['level'])){//if level n course step <= now = completed
												if($mytime[$c['id_course']] <= $c['estimate']){//green
													$time = $c['estimate']-$mytime[$c['id_course']];
													echo '<span style="font-weight:bold;color:green"> -'.$time.'m</span>';
												}else{//red
													$time = $mytime[$c['id_course']]-$c['estimate'];
													echo '<span style="font-weight:bold;color:red"> +'.$time.'m</span>';
												}
											} else {
												echo '';
											}
											?>
										</td>
										<td>
											<?php 
											if($c['id_level'] < $detCourse['id_level'] || ($c['step'] <= $recentCourseStep && $c['level'] <= $detCourse['level'])){//if level n course step <= now = completed
												echo '<span style="color:green" class="fi-check"></span>';
											} else {
												echo '<span style="color:red" class="fi-x"></span>';
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
						<div class="content" id="finishedcourse"></div>					  
					</div>
				</div>	
			</div>
		</div>
	</center>
</section>
<!-- end of syllabus list