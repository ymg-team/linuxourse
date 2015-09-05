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
<span ng-controller="ctrlDashboard">
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
							<?php
						//show recent course id
							$idRecentCourse = base64_encode(base64_encode($recentCourse['id_user_course']));
							$idRecentCourse = str_replace('=', '', $idRecentCourse);
							?>
							<p>
								<div class="row">
									<form class="large-12 columns" method="GET" action="<?php echo site_url('course/start/'.$idRecentCourse)?>" class="button large">
										<select style="height:45px;color:gray" class="large-6 columns" name="lang">
											<option value="en">English</option>
											<option value="id">Indonesia</option>
										</select>
										<button class="button button-lg large-6 columns" type="submit">Resume <i class="fi-arrow-right"></i></button>
									</form>
								</div>

							</p>

						</div>
					</div>
					<div class="large-3 columns"><p></p></div>
				</div>
			</center>
		</section>
		<section class="row" style="background-color:#fff">
			<center>
				<div class="large-12 columns">
					<dl class="tabs" data-tab>
						<dd style="width:25%;"><a href="#newtest" style="background-color:#fff;color:#008CBA" href="#">+ New Test</a></dd>
						<dd style="width:25%" class="active"><a ng-click="getList('incomplete')" href="#courseList">On Progress (<?php echo $this->m_course->countMyCourse($this->session->userdata['student_login']['id_user'],'incomplete')?>)</a></dd>
						<dd style="width:25%"><a ng-click="getList('completed')" href="#courseList">Completed (<?php echo $this->m_course->countMyCourse($this->session->userdata['student_login']['id_user'],'completed')?>)</a></dd>
						<dd style="width:25%"><a ng-click="getList('mytest')" href="#courseList">Join Test (<?php echo $this->m_course->countMyCourse($this->session->userdata['student_login']['id_user'],'completed')?>)</a></dd>
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
								<!-- new test -->
								<div class="content" id="newtest">
								<p>Completing Data</p>
								<form name="NewTest" ng-submit="newTest()">
								  <div class="row">
								    <div class="small-12 columns">
								      <div class="row">
								        <div class="small-2 columns">
								          <label for="testname" class="right inline">Test Name</label>
								        </div>
								        <div class="small-9 columns">
								          <input type="text" id="testname" ng-model="new.testName" required>
								        </div>
								      </div>
								       <div class="row">
								        <div class="small-2 columns">
								          <label for="notes" class="right inline">Notes To Participant</label>
								        </div>
								        <div class="small-9 columns">
								        	<div data-alert class="alert-box info">
											  Will show to participant before start a test.
											  <a href="#" class="close">&times;</a>
											</div>
								          <textarea style="min-height:200px" type="text" id="notes" row="4" ng-model="new.testNotes" required></textarea>
								        </div>
								      </div>
								      <br/>
								      <div class="row">
								        <div class="small-2 columns">
								          <label for="organization" class="right inline">Organization</label>
								        </div>
								        <div class="small-9 columns">
								          <input type="text" id="organization"  ng-model="new.organization">
								        </div>
								      </div>
								      <div class="row">
								        <div class="small-2 columns">
								          <label for="testemail" class="right inline">Email Contact</label>
								        </div>
								        <div class="small-9 columns">
								          <input type="email" id="testemail"  ng-model="new.testEmail">
								        </div>
								      </div>
								      <div class="row">
								        <div class="small-2 columns">
								          <label for="unique" class="right inline">Unique Name</label>
								        </div>
								        <div class="small-9 columns">
								        	<div data-alert class="alert-box info">
											   Make unik test link like "my-test" without space.
											  <a href="#" class="close">&times;</a>
											</div>
								          <input ng-keyup="checkUniqueLink()" type="text" id="unique" ng-model="new.testUniqueLink" placeholder="input custom unique name without space">
									        <small ng-hide="alertUniqueBox" class="error">{{alertUniqueText}}</small>
								        </div>
								      </div>
								      <div class="row">
								        <div class="small-2 columns">
								          <label for="open" class="right inline">Open Test</label>
								        </div>
								        <div class="small-9 columns">
								          <input type="datetime-local" id="open" ng-model="new.testOpen">
								        </div>
								      </div>
								       <div class="row">
								        <div class="small-2 columns">
								          <label for="close" class="right inline">Close Test</label>
								        </div>
								        <div class="small-9 columns">
								          <input type="datetime-local" id="close" ng-model="new.testClose">
								        </div>
								      </div>
								      <div class="row">
								        <div class="small-2 columns">
								          <label for="type" class="right inline">Test Type</label>
								        </div>
								        <div class="small-9 columns">
								        	<div data-alert class="alert-box info">
											   More options available soon.
											  <a href="#" class="close">&times;</a>
											</div>
								         	<select id="type" ng-model="new.testType='private'" required>
								         		<option value="public">Public</option>
								         		<option value="private">Private</option>
								         	</select>
								        </div>
								      </div>
								      <br/>
								      <div class="row">
								        <div class="small-2 columns">
								          <p></p>
								        </div>
								        <div class="small-9 columns">
								       		<label style="float:left"><input type="checkbox" required> i have read terms of use</label>
								         	<br/>
								         	<br/>
								         	<button ng-hide="btnSubmitBox" style="float:left" class="button" type="submit">Next Step</button>
								        </div>
								      </div>
								    </div>
								  </div>
								</form>
							</div>
								<!-- course list -->
								<div class="content active" id="courseList">
									<!-- loader -->
									<div ng-hide="listLoader" data-alert class="alert-box info">{{listLoaderText}}</div>
									<!-- list -->
									<a ng-repeat="list in courseList" onmouseout="hidelast(id)" onmouseover="showlast(id)" href="<?php echo site_url('course/review')?>/{{list.encidmateri}}">
										<div class="joinmateri row">
											<div class="small-5 columns"><p><strong>{{list.title}}</strong></p></div>
											<div class="small-4 columns">
												<div style="height:10px;margin-top:5px" class="radius progress">
													<span style="float:left;color:#fff;width:{{list.percentage}}%;" class="meter"></span>
												</div>
											</div>
											<div style="float:left" class="small-1 columns"><p>{{list.percentage}}%</p></div>
											<div class="small-2 columns"><small style="display:none" id="last-id"> {{list.log}}</small><span class="fi-play-circle" style="float:right;font-size:25px"></span></div>
										</div>
									</a>
								</div>
								<!-- end of course list -->
								<!-- start my test-->
								<div class="content" id="mytest">
								<p>my test</p>
								</div>
								<!-- end of my test -->
							</div>
						</div>
						<!-- badge completion -->
						<h1>Badge Collection</h1>
						<hr/>
						<?php if(empty($badge)){ ?>
						<p><strong>you don't have</strong></p>
						<?php }else{ ?>
						<?php foreach($badge as $b):?>
							<span><img data-tooltip aria-haspopup="true" title="<?php echo $b['description'];?>" style="width:50px" src="<?php echo base_url('assets/img/badge/'.$b['logo']) ?>"></span>
						<?php endforeach; ?>
						<?php } ?>
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
						<h1>Latest Joined Course : <?php echo $recentCourse['materi_title'];?> / <?php echo $recentMateriPercentage;?>%</h1>
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
								<th style="width:70%">Course</th>
								<th style="width:10%">Estimate</th>
								<th style="width:10%">Goal</th>
								<th style="width:10%">Status</th>
							</tr>
							<?php
						//get recent id level  by id_user n id_materi
							$recentLevel = $this->m_course->getMyRecentLevel($this->session->userdata['student_login']['id_user'],$recentCourse['id_materi']);
						//get recent id course by id_user n id_materi
							$recentCourseStep = $this->m_course->getMyRecentCourseStep($this->session->userdata['student_login']['id_user'],$recentCourse['id_materi']);
						$course = $this->m_course->courseByLevel($rc['id_level']);//show course by level
						//my completing time
						$mytime =  $detuserCourse['finishtime'];
						$mytime = json_decode($mytime,true);//json to array
						foreach($course as $c):?>
						<tr>
							<td><?php echo $c['title'];?><br/><small style="color:gray"><?php echo $c['description']?></small></td>
							<td><?php echo $c['estimate']?>m</td>
							<td>
								<?php
							if($c['id_level'] < $recentCourse['id_level'] || ($c['step'] <= $recentCourseStep && $c['level'] <= $recentLevel)){//if level n course step <= now = completed
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
							if($c['id_level'] < $recentCourse['id_level'] || ($c['step'] <= $recentCourseStep && $c['level'] <= $recentLevel)){//if level n course step <= now = completed
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
			<form class="" method="GET" action="<?php echo site_url('course/start/'.$idRecentCourse)?>" class="button large">
				<select style="height:45px" class="large-6 columns" name="lang">
					<option value="en">English</option>
					<option value="id">Indonesia</option>
				</select>
				<button class="button button-lg large-6 columns" type="submit">Resume <i class="fi-arrow-right"></i></button>
			</form>
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
				<div class="row">
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
							if(!empty($am['logo'])){$logo = base_url('assets/img/logo/gray '.$am['logo']);}
							else{$logo = base_url('assets/img/logo/gray other logo.png'); }
							?>
							<a id="btn_course_item" href="#btn_resume">
								<div style="float:left;padding: 0.9375rem;" class="large-4 columns">
									<div style="background-color:#FFF" class="materi-item">
										<center>
											<img src="<?php echo $logo?>"/>
										</center>
										<div class="materi-title">
											<h4><?php echo substr($am['title'],0,20);?></h4>
										</div>
										<div class="course-detail">
											<?php echo $am['description'];?>
										</div>
										<div class="thumb-progress row">
											<div class="small-12 columns">
												<div class="small-10 columns collapse">
													<div style="height:10px;margin-top:5px" class="radius progress">
														<span style="float:left;color:gray;width:<?php echo $progress;?>%;" class="meter"></span>
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
</span>
