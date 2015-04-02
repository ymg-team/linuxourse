<style type="text/css">
	#terminal pre{display: block;}
</style>
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
		command=$('#linuxCommand').val().toString();
		$.ajax({
			url:'<?php echo site_url("regex/execcommand");?>',
			data:{command:command},
			type:'POST',
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
	//striptags
	function strip_tags(str, allow) {
		// making sure the allow arg is a string containing only tags in lowercase (<a><b><c>)
		allow = (((allow || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('');

		var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi;
		var commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
		return str.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
			return allow.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
		});
	}
	//check result for rewind mode
	function check(){
		$('#loadercheck').show();//show loader
		terminal = $('#terminal').html();
		//remove html tags
		terminal = strip_tags(terminal,'');
		//find and replace
		terminal = terminal.replace("student@linux-ecourse:", "");
		idcourse = '<?php echo $this->uri->segment(3)?>';//get id course
		<?php if(!empty($course['custom_controller'])){ //if use custom controller?>
			url='<?php echo site_url("regex/".$course["custom_controller"]);?>';
			<?php }else{//use default controller?>
				url='<?php echo site_url("regex/checkrewind");?>';
				<?php }	?>
				$.ajax({
					url:url,
					type:'POST',
					data:{terminal:terminal,idcourse:idcourse},
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

			//full height
			function handleResize() {
				var h = $(window).height();
				$('.full-height-80').css({'height':h-80+'px'});
				$('.full-height').css({'height':h+'px'});
			}
			$(function(){
				handleResize();

				$(window).resize(function(){
					handleResize();
				});
			});
		</script>
		<section id="livecommand">
			<div style="min-width:100%" class="row collapse">
				<!-- sidebar -->
				<div style="background-color:#F5F5F5" class="full-height large-3 columns">
					<ul style="/*background-color:#e7e7e7*/" class="button-group">
						<li style="width:20%"><a href="<?php echo site_url('course/review/'.$this->uri->segment(4))?>" class="small secondary button"><strong>Back</strong></a></li>
						<li style="width:80%"><a style="width:100%" href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="false" class="small button secondary dropdown">Level <?php echo $detCourse['level']?></a><br>
							<ul style="max-width:none" id="drop1" data-dropdown-content class="dropdownme f-dropdown" aria-hidden="true" tabindex="-1">
								<?php foreach($courseList as $cl):?>
									<li>
										<?php 
										//get id materi
										$completedstep = $this->m_course->getCompletedStep(base64_decode(base64_decode(str_replace('', '=', $this->uri->segment(4)))));
										//course detail
										$step = $detCourse['step'];
										$course = $this->m_course->detCourse($step,$detCourse['id_materi']);//sow detail course by id materi and step
										//check if completed course
										if($cl['step'] <= $completedstep){
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
						<div style="overflow:auto" class="learn_sidebar row">
							<p><strong>Case : <?php echo $course['title']?></strong><p>
								<div class="full-height-80">
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
							<div style="padding:0 10px" class="row collapse">
								<!-- command -->
								<div style="background-color:#000;overflow:auto" class="command large-12 columns full-height-80">
									<div id="terminal" class="item" style="">
										<div id="result"></div>
										<div id="commandarea" class="small-12 columns" style="padding:0;font-family:monospace;font-size:12px"><span style="float:left">student@linux-ecourse:<?php echo $this->session->userdata('dir')?>$</span> <span style="padding-left:10px;width:70%;float:left"><input type="text" style="font-family:monospace" onkeyup="inputKeyUp(event)" id="linuxCommand" autofocus/></span></div>
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