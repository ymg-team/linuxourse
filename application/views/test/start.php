<style type="text/css">
	#terminal pre{display: block;}
	#home_header,.divideroftopmenu{display:none;}
</style>
<?php
if(!empty($script)):echo $script;endif;
?>
<script type="text/javascript">
	//when document ready
	$(document).ready(function(){
		$('#footer').hide();
		<?php if(!empty($_GET['modal'])):?>
		$('#nextlevel').foundation('reveal', 'open');
	<?php endif;?>
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
		if(e.which == 13) {//press enter
			// execCommand();
		}else if(e.which == 38){//press up arrow
			x = $('#linuxCommand').val();
			history(x,'up');
		}else if(e.which == 40){//press down arrow
			x = $('#linuxCommand').val();
			history(x,'down');
		}    
	}
	//show hint text
	function showhint(){
		$('#hint').toggle('fast');		
	}	
	//exec command
	function execCommand(){
		$('#loaderexe').show();
		$.ajax({
			url:'<?php echo site_url("regex/execcommand");?>',
			data:{command:$('#linuxCommand').val()},
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
		'<div id="commandarea" class="small-12 columns" style="padding:0;font-family:monospace;font-size:12px"><span style="float:left">student@linux-ecourse:<?php echo $this->session->userdata("dir")?>$</span> <span style="padding-left:10px;width:70%;float:left"><input type="text" style="font-family:monospace" onkeyup="inputKeyUp(event)" id="linuxCommand" autofocus/></span></div>';
		$('#terminal').html(html);
		$('#linuxCommand').focus();//set autofocus textarea command	
	}
	//get history
	function history(x,y){ //x= on screen now
		$('#linuxCommand').val('loading..');
		$.ajax({
			url:'<?php echo site_url("regex/latestCommand");?>',
			data:{command:x,type:y},
			success:function(response){
				$('#linuxCommand').val(response);
			},
			error:function(){
				$('#linuxCommand').val(x);
				alert('something wrong');
			}
		});
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
	//check result
	function check(){
		$('#loadercheck').show();//show loader
		//$('#linuxCommand').attr('readonly','readonly');//readonly terminal
		terminal = $('#terminal').html();
		//remove html tags
		terminal = strip_tags(terminal,'');
		//find and replace
		terminal = terminal.replace("student@linux-ecourse:", "");
		usercourseid = '<?php echo $this->uri->segment(3)?>';
		<?php if(!empty($course['custom_controller'])){ //if use custom controller?>
			url='<?php echo site_url("regex/".$course["custom_controller"]);?>';
			<?php }else{//use default controller?>
				url='<?php echo site_url("regex/check");?>';
				<?php }	?>
				$.ajax({
					url:url,
					type:'POST',
					data:{terminal:terminal,usercourseid:usercourseid},
					success:function(data){
				$('#loadercheck').hide();//show loader
				$('#btnGroupAction').html(data);
			},
			error:function(){
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

	<span ng-controller="ctrlTestTerminal">
		<section id="livecommand">
			<div style="min-width:100%" class="row collapse">
				<!-- sidebar -->
				<div style="background-color:#F5F5F5" class="full-height large-3 columns">
					<ul style="/*background-color:#e7e7e7*/" class="button-group">
						<li style="width:20%"><a style="width:100%" href="<?php echo site_url();?>" class="small secondary button"><strong>Exit</strong></a></li>
						<li id="caselist" style="width:80%"><a style="width:100%" href="#" data-dropdown="step" aria-controls="step" aria-expanded="false" class="small button secondary dropdown">{{test.testName}}</a><br>
							<ul style="max-width:none" id="step" data-dropdown-content class="dropdownme f-dropdown" aria-hidden="true" tabindex="-1">
								<li ng-repeat="case in cases"><a ng-click="detailCase(case.testCaseStep)" href="#step-{{case.testCaseStep}}">Step : {{case.testCaseStep}}</a></li>
							</ul>
						</li>
					</ul>
					<div style="overflow:auto" class="learn_sidebar row">
						<div class="full-height-80">
							<p><strong>Step Number : </strong> {{case.testCaseStep}}<p>
								<p><strong>Estimate : </strong> {{case.estimate}} minutes<p>
									<p><strong>Case / Question : </strong><p>
										
										<p>{{case.testCaseQuestion}}</p>									
									</div>
								</div>
							</div>
							<!-- content -->
							<div class="full-height terminal_view large-9 columns">
								<div style="padding:0 10px;" class="row collapse full-height">
									<!-- command -->
									<div style="background-color:#000;overflow:auto" class="command large-12 columns full-height-80">
										<div id="terminal" class="item" style="">
											<div id="result" ng-bind-html="command.results">
											</div>
											<div id="commandarea" class="small-12 columns" style="padding:0;font-family:monospace;font-size:12px">
												<span style="float:left">student@linux-ecourse:<?php echo $this->session->userdata('dir')?>$</span>
												<span style="padding-left:10px;width:70%;float:left">
												<input ng-enter="execute()" ng-model="command.input" type="text" style="font-family:monospace" onkeyup="inputKeyUp(event)" id="linuxCommand" autofocus/>
												</span>
											</div>
										</div>
									</div>
									<!-- button excute -->
									<div class="row">
										<!-- command -->
										<div id="btnGroupAction" style="padding-top:10px" class="large-6 columns">
											<a id="btnSaveStep" ng-click="saveStep(case.testCaseStep)" data-tooltip aria-haspopup="true" title="Click after completing this step" class="tip-top small button">Save Answer</a>
											<a data-tooltip aria-haspopup="true" title="Click to reset terminal" ng-click="clearTerminal()" title="clear terminal" href="#" class="tip-top small alert button">X</a>
											<span ng-hide="loaderbox" style="padding:5px;color:#fff" id="loadercheck"><img style="width:30px;margin-right:5px;" src="<?php echo base_url('./assets/img/loader.gif')?>"/>{{loadertext}}..</span>
											<span style="padding:5px;color:#fff;display:none" id="loadercheck"><img style="width:30px;margin-right:5px;" src="<?php echo base_url('./assets/img/loader.gif')?>"/>checking..</span>
											<span style="padding:5px;color:#fff;display:none" id="loaderexe"><img style="width:30px;margin-right:5px;" src="<?php echo base_url('./assets/img/loader.gif')?>"/>execute..</span>
										</div>
										<div style="float:right;padding-top:10px" class="large-4 columns">
											<a id="btnSaveTest" ng-click="saveTest()" data-tooltip aria-haspopup="true" title="Click this button to end this test" class="tip-top small button success" href="#savetest"><strong>Submit Test (Click After Completing All Step)</strong></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
					<div id="test"></div>

					<!-- modal setup -->
					<div style="text-align:center" id="nextlevel" class="reveal-modal tiny" data-reveal>
						<h2 style="color:rgb(93, 176, 93);line-height:1;font-weight: bold;">
							<i style="font-size:60px" class="fi-trophy"></i><br/>
							Good Job
						</h2>
						<p style="color:#494949" class="lead"><?php if(!empty($_GET['modal'])):echo $_GET['modal'];endif;?></p>					
						<a class="close-reveal-modal">&#215;</a>
					</div>

					<!-- Joyride List -->
					<ol class="joyride-list" data-joyride>
						<li data-id="caselist" data-text="Next" data-options="tip_location: bottom; prev_button: false">
							<p>Finish all step<br>which are in this menu.<br/></p>
						</li>
						<li data-id="btnSaveStep" data-button="Next" data-prev-text="Prev" data-options="tip_location: top;">
							<p>After completing step<br>press this button<br/>and proceed to the next step.</p>
						</li>
						<li data-id="btnSaveTest" data-button="Next" data-prev-text="Prev" data-options="tip_location: top;">
							<p>Close this test<br/>and wait for the next news from organizer</p>
						</li>
						<li data-button="End" data-prev-text="Prev">
							<h4>Go Luck</h4>
							<p>Have a great time doing it</p>
						</li>
					</ol>
				</span>
				<script type="text/javascript">
					var idtest = <?php echo $this->uri->segment(3);?>;
					var firststep = <?php echo $case[0]['testCaseStep'];?>;

				</script>