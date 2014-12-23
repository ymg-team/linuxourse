<script type="text/javascript">
	//when document ready
	$(document).ready(function(){
		
	});
	//if press enter
	function inputKeyUp(e) {
    e.which = e.which || e.keyCode;
	    if(e.which == 13) {
	       execCommand();
	    } 	    
	}
	//show hint text
	function showhint(){
		$('#hint').toggle('fast');		
	}	
	//exec command
	function execCommand(){
		$('#loaderexe').show();
		command = $('#linux-command').val();
		$.ajax({
			url:'<?php echo site_url("regex/execcommand");?>',
			data:{command:command},
			success:function(response){
				$('#result').append(response);//response is command result
				$('#linux-command').val('');
				//alert(response);
				$('#loaderexe').hide();
			},
			error:function(){
				alert('something error, try again');
				$('#loaderexe').hide();
			},
		});
	}
	//check command
	function checkCommand(){
		$('#loadercheck').show();
		$('#linux-command').attr('readonly','readonly');
		command = $('#linux-command').val();
	}
	//clear terminal
	function clearTerminal(){
		$.ajax({
			url:'<?php echo site_url("regex/deletehistory");?>',
		});
		html = '<div id="result"></div>'+
		'<span class="small-2 columns" style="padding:0;font-size:13px">student@linux-ecourse:~$</span>'+
		'<span class="small-10 columns"  style="padding:0;"><textarea style="font-family:monospace" onkeyup="inputKeyUp(event)" id="linux-command" autofocus></textarea></span>';
		$('#terminal').html(html);
	}
</script>
<section id="livecommand">
	<div style="min-width:100%" class="row collapse">
		<!-- sidebar -->
		<div style="background-color:#F5F5F5" class="full-height large-3 columns">
			<ul style="/*background-color:#e7e7e7*/" class="button-group">
				<li style="width:20%"><a href="<?php echo site_url()?>" class="small secondary button"><strong>Back</strong></a></li>
				<li style="width:80%"><a style="width:100%" href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="false" class="small button secondary dropdown">Level <?php echo $detCourse['level']?></a><br>
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
								<div id="terminal" class="item" style="">
									<div id="result"></div>
									<span class="small-2 columns" style="padding:0;font-size:13px">student@linux-ecourse:~$</span>
									<span class="small-10 columns"  style="padding:0;"><textarea style="font-family:monospace" onkeyup="inputKeyUp(event)" id="linux-command" autofocus></textarea></span>							
								</div>
							</div>
							<!-- button excute -->
							<div class="row">
								<!-- command -->
								<div style="padding-top:10px" class="large-6 columns">
									<a onclick="checkCommand()" href="#" class="small button">Check</a>  <a onclick="clearTerminal()" title="clear terminal" href="#" class="small alert button">X</a><span style="padding:5px;color:#fff;display:none" id="loadercheck"><img style="width:30px;margin-right:5px;" src="<?php echo base_url('./assets/img/loader.gif')?>"/>checking..</span><span style="padding:5px;color:#fff;display:none" id="loaderexe"><img style="width:30px;margin-right:5px;" src="<?php echo base_url('./assets/img/loader.gif')?>"/>execute..</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>