<?php
//course detail
$step = $detCourse['step'] + 1;
$course = $this->m_course->detCourse($step,$detCourse['id_materi']);//sow detail course by id materi and step
?>
<script type="text/javascript">
	//when document ready
	$(document).ready(function(){
		$('#footer').hide();
		$('#terminal').click(function(){//when click terminal
			$('#linuxCommand').focus();//set autofocus textarea command
		});
	});
	//get command textarea
	function commandArea(){
		$.ajax({
			url:'<?php echo site_url("course/commandArea")?>',
			success:function(response){
				$('#commandarea').html(response);
				$('#linuxCommand').focus();//set autofocus textarea command
			},
			error:function(response){
				alert('something wrong, refresh page');
			}
		});
	}
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
		command = $('#linuxCommand').val();
		$.ajax({
			url:'<?php echo site_url("regex/execcommand");?>',
			data:{command:command},
			success:function(response){
				$('#result').append(response);//response is command result
				$('#linuxCommand').val('');
				//alert(response);
				commandArea();
				$('#loaderexe').hide();
			},
			error:function(){
				commandArea();
				alert('something error, try again');
				$('#loaderexe').hide();
			},
		});
	}
	//clear terminal
	function clearTerminal(){
		$.ajax({
			url:'<?php echo site_url("regex/deletehistory");?>',
		});
		html = '<div id="result"></div>'+
		'<div id="commandarea" class="small-12 columns" style="padding:0;font-family:monospace;font-size:12px"><span style="float:left">student@linux-ecourse:<?php echo $this->session->userdata("dir")?>$</span> <span style="padding-left:10px;width:50%;float:left"><textarea style="font-family:monospace" onkeyup="inputKeyUp(event)" id="linuxCommand" autofocus></textarea></span></div>';
		$('#terminal').html(html);
	}
	//check result
	function check(){
		$('#loadercheck').show();//show loader
		//$('#linuxCommand').attr('readonly','readonly');//readonly terminal
		terminal = $('#terminal').html();
		usercourseid = '<?php echo $this->uri->segment(3)?>';
		<?php if(!empty($course['custom_controller'])){ //if use custom controller?>
			url='<?php echo site_url("regex/".$course["custom_controller"]);?>';
			<?php }else{//use default controller?>
				url='<?php echo site_url("regex/check");?>';
				<?php }	?>
				$.ajax({
					url:url,
					type:'post',
					data:{terminal:terminal,usercourseid:usercourseid},
					success:function(data){
					$('#loadercheck').hide();//show loader
					// $('#test').html(data);
					$('#btnGroupAction').html(data);
				},
				error:function(data){
					$('#loadercheck').hide();//show loader
					alert('someting wrong, please refresh page');
				}
			});
			}
		</script>
		<section id="livecommand">
			<div style="min-width:100%" class="row collapse">
				<!-- sidebar -->
				<div style="background-color:#F5F5F5" class="full-height large-3 columns">
					<ul style="/*background-color:#e7e7e7*/" class="button-group">
						<li style="width:20%"><a href="<?php echo site_url()?>" class="small secondary button"><strong>Back</strong></a></li>
						<li style="width:80%"><a style="width:100%" href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="false" class="small button secondary dropdown">Level <?php echo $recentIdlevel['level']?></a><br>
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
							<p><strong>Case : <?php echo $course['title']?></strong><p>
								<div class="text">
									<p><?php 
										$case = nl2br($course['course_case_id']);
										$case = str_replace('[', '<', $case);
										$case = str_replace(']', '>', $case);
										echo $case;
										?>
									</p>
									<hr/>
									<h5><strong><a data-tooltip aria-haspopup="true" title="are you stuck?" onclick="showhint()">Hint !</a></strong></h5>
									<p style="display:none" id="hint">
										<?php
										$hint = nl2br($course['hint_id']);
										$hint = str_replace('[', '<', $hint);
										$hint = str_replace(']', '>', $hint);
										echo $hint;
										?>
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
											<div id="commandarea" class="small-12 columns" style="padding:0;font-family:monospace;font-size:12px"><span style="float:left">student@linux-ecourse:<?php echo $this->session->userdata('dir')?>$</span> <span style="padding-left:10px;width:50%;float:left"><textarea style="font-family:monospace" onkeyup="inputKeyUp(event)" id="linuxCommand" autofocus></textarea></span></div>
											<!-- <span class="small-8 columns"  style="padding:0;"><textarea style="font-family:monospace" onkeyup="inputKeyUp(event)" id="linuxCommand" autofocus></textarea></span>-->
										</div>
									</div>
									<!-- button excute -->
									<div class="row">
										<!-- command -->
										<div id="btnGroupAction" style="padding-top:10px" class="large-6 columns">
											<a onclick="check()" class="small button">Check</a>  <a onclick="clearTerminal()" title="clear terminal" href="#" class="small alert button">X</a><span style="padding:5px;color:#fff;display:none" id="loadercheck"><img style="width:30px;margin-right:5px;" src="<?php echo base_url('./assets/img/loader.gif')?>"/>checking..</span><span style="padding:5px;color:#fff;display:none" id="loaderexe"><img style="width:30px;margin-right:5px;" src="<?php echo base_url('./assets/img/loader.gif')?>"/>execute..</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
					<div id="test"></div>