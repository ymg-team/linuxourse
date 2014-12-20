<script type="text/javascript">
	function showhint(){
		$('#hint').toggle('fast');		
	}

</script>
<section id="livecommand">
	<div style="min-width:100%" class="row collapse">
		<!-- sidebar -->
		<div style="background-color:#F5F5F5" class="full-height large-3 columns">
			<ul style="/*background-color:#e7e7e7*/" class="button-group">
				<li style="width:20%"><a href="<?php echo site_url()?>" class="small secondary button"><strong>Back</strong></a></li>
				<li style="width:80%"><a style="width:100%" href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="false" class="small button secondary dropdown">Level 3</a><br>
					<ul style="max-width:none" id="drop1" data-dropdown-content class="dropdownme f-dropdown" aria-hidden="true" tabindex="-1">
						<?php foreach($courseList as $cl):?>
							<li>
								<?php 
							//check if completed course
								if($cl['step'] <= $detCourse['step']){
									$title = '<span style="color:gray">'.$cl['title'].'
									<span class="fi-check"></span></span>';
									$link = site_url('rewind');
								} else if($cl['step'] == $detCourse['step'] + 1){
									$title = '<strong>'.$cl['title'].'</strong>';
									$link = '#';
									$course = $this->m_course->detCourse($cl['id_course']);
								} else {
									$title = $cl['title'];
									$link = site_url('preview');
								}							
								?>
								<a href="<?php echo $link;?>"><?php echo $title;?></a></li>
							<?php endforeach;?>
						</ul>
					</li>
				</ul>
				<div class="learn_sidebar row">
					<p><strong>Case</strong><p>
						<div class="text">
							<p><?php echo $course['course_case_id'];?></p>
						</div>
						<hr/>
						<p><strong><a data-tooltip aria-haspopup="true" title="are you stuck?" onclick="showhint()">Hint !</a></strong><p>
							<div class="texthint">
								<p style="display:none" id="hint">
									<?php echo $course['hint_id'];?>
								</p>
							</div>
						</div>
					</div>
					<!-- content -->
					<div class="full-height terminal_view large-9 columns">
						<div style="padding:10px" class="row collapse">
							<!-- command -->
							<div style="background-color:#000" class="command large-12 columns">
								<div class="item" style="">
<pre>
user@knowlinux.com:~$ ls -l /opt
total 28
drwxr-xr-x  7 root  root   4096 Des 16 06:36 ./
drwxr-xr-x 24 root  root   4096 Des 15 11:17 ../
drwxr-xr-x  3 10490 floppy 4096 Des  6 14:01 Adobe/
drwxr-xr-x  3 root  root   4096 Nov  3 13:40 google/
drwxr-xr-x  3 root  root   4096 Des 14 08:41 kingsoft/
drwxr-xr-x 30 root  root   4096 Nov  2 22:02 lampp/
drwxr-xr-x  4 root  root   4096 Nov  3 13:51 sublime_text/
</pre>
<pre>
user@knowlinux.com:~$ guard my body
No command 'guard' found, did you mean:
Command 'geard' from package 'python-gear' (universe)
Command 'guacd' from package 'guacd' (universe)
Command 'guards' from package 'quilt' (main)
guard: command not found
</pre>

									<span class="small-2 columns" style="padding:0;font-size:13px">user@knowlinux.com:~$</span>
									<span class="small-10 columns"  style="padding:0;"><textarea id="linux-command" autofocus></textarea></span>							
								</div>
							</div>
							<!-- button excute -->
							<div class="row">
								<!-- command -->
								<div style="padding-top:10px" class="large-6 columns">
									<a href="#" class="small button">Check</a>  <a href="#" class="small alert button">X</a><span style="padding:5px;color:#fff" id="loader">checking...</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>