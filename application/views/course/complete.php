<section id="title">
	<center>
		<br/>
		<?php
		if(!empty($materi['logo'])){$logo = base_url('assets/img/logo/'.$materi['logo']);}
		else{$logo = base_url('assets/img/logo/other logo.png'); }
		echo '<img src="'.$logo.'"/>'
		?>
		<h1 style="margin:0;font-size:50px">CONGRATULATION</h1>
		<h2>You Have Completing <?php echo $materi['title']?></h2>
		<hr/>
		<?php
		echo 'Course Begin : '. date('d M Y H:i:s', strtotime($detCourse['startdate']));
		$today = date_create(date('Y-m-d'));
		$last = date_create(date('Y-m-d', strtotime($detCourse['lastdate'])));
		$diff=date_diff($last,$today);
		if($diff->y != 0){
			$log = $diff->y.' Years';
		}else if($diff->m != 0){
			$log = $diff->m.' Months';
		}else if($diff->d != 0){
			$log = $diff->d.' Days';
		}
		?>
		<p style="margin:0"><strong>Completing in <?php echo $log;?></strong></p> 
		<br/>
		<a href="<?php echo site_url()?>" class="button large secondary fi-home"></a>
		<a href="<?php echo site_url('course/review/'.str_replace('=', '', base64_encode(base64_encode($materi['id_materi']))));?>" class="button large secondary">Review</a>
		<a href="<?php echo site_url('course/certificate/'.$this->uri->segment(3))?>" class="button large">Get Certivicate</a>
	</center>
</section>
<section>
	<center>		
		<div class="row">			
			<div class="large-8 collapse" columns>				
				<!-- skill completion -->
				<div class="row">
					<dl style="border-top:1px solid #E8E8E8" class="tabs" data-tab>
						<dd class="active" style="width:50%"><a href="#mybadges">My Badges</a></dd>
						<dd style="width:50%"><a href="#finishedcourse">Finished Student</a></dd>
					</dl>
					<br/>
					<div class="tabs-content">
						<div class="content active" id="mybadges">
							
						</div>
						<div class="content" id="finishedcourse">
							<!-- start of completed user -->
							<a data-tooltip aria-haspopup="true" title="Username"  href=""><img src=""></a>
							<!-- end of completed user -->
						</div>					  
					</div>

				</div>				
			</div>
		</div>
	</center>
</section>
<!-- end of syllabus list