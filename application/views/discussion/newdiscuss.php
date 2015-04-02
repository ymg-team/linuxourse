<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
	function showmarkdown(){
		$('#markdown').toggle('fast');
	}
</script>
<section id="title">
	<center>		
		<h1 style="margin:0">linuXourse Discussion</h1>
		<p>have problem, stuck, something not working, join the club and discuss it</p>
	</center>
</section>
<br/>
<div class="row">	
	<center>
		<div class="large-10 large-offset-1 columns">
			<div class="row">
				<br/>
				<form action="">
					<div class="large-12 columns">
						<div class="row collapse">
							<div class="small-11 columns">
								<input style="height:40px" type="text" placeholder="Hex Value">
							</div>
							<div class="small-1 columns">
								<a style="height:40px" href="#" class="button postfix"><h3 style="color:#fff"><span class="fi-magnifying-glass"></span></h3></a>
							</div>
						</div>
					</div>
					<p> or <a data-reveal-id="newtopic" href="#">create new topic</a></p>
				</form>
				<br/>
			</div>
		</div>
	</center>
	<div class="row">
		<div class="large-12 columns">
			<div class="large-12 columns">
				<strong>order by : </strong><strong><a href="<?php echo site_url('discussion')?>">Lattest</a></strong> | <a href="#">Top Views</a> | <a href="#">Top Comment</a>
				<hr/>
			</div>
			<br/><br/>
			<div class="large-8 columns">
				<?php
				switch ($_GET['create']) {
					case 'ask':
					echo '<h5><center>ASK | Create New Topic</center></h5>';
					break;
					case 'thread':
					echo '<h5><center>Thread | Create New Topic</center></h5>';
					break;
					default:
					//redirect(site_url('discussion'));
					break;
				}
				?>
				<br/>
				<!-- new discuss form -->
				<div class="row">
					<form method="POST" action="<?php echo site_url('discussion/addtopic')?>">
						<div class="large-12 columns">
							<div class="large-2 columns"><label><strong>Title</strong></label></div>
							<div class="large-10 columns"><input type="text" name="input_title"></div>
						</div>
						<div class="large-12 columns">
							<div class="large-2 columns"><label><strong>Content</strong></label></div>
							<div class="large-10 columns"><small><a onclick="showmarkdown()">how to create content</a>
								<div style=" font-size:13px;display:none;background-color:#f4f4f4;padding:5px" id="markdown">
									add command / code : <code>[code]...[/code]</code><br/>
									add link : <code>[url]link[/url]</code><br/>
									add image : <code>[image]image link[/image]</code><br/>
									heading style : <code>[h1]...[/h1] until [h6]...[/h6]</code>
								</div>
							</small><br/><textarea style="width:100%;min-height:300px" name="input_content"></textarea>
							<br/>
							<div class="g-recaptcha" data-sitekey="6LcaGAQTAAAAAKRuyz9v_cGuKD4i-IzCbPIQgGlQ"></div>
							<br/>
							<button class="button" type="submit">Create</button>
						</div>
						<input type="hidden" name="input_type" value="<?php echo $_GET['create']?>">

					</div>
				</form>
			</div>
			<br/>
			<br/>
			<!-- end of new discuss form -->
		</div>
		<div class="large-4 columns">
			<?php $this->load->view('discussion/top_discussion')?>
		</div>
	</div>

</div>

</div>			

</div>
</div>
<!-- modal -->
<div id="newtopic" class="reveal-modal small" data-reveal>
	<center><h3>What the topic type you want to start</h3></center>
	<hr/>
	<div class="row">
		<div class="large-6 columns">
			<p><center><a style="width:100%" href="<?php echo site_url('discussion?create=ask')?>" class="button large"><span class=""></span> Ask</a></center>
				Are you stuck? <br/>
				some command does not work <br/>
				ask here
			</p>
		</div>
		<div class="large-6 columns">
			<p><center><a style="width:100%" href="<?php echo site_url('discussion?create=thread')?>" class="button large"><span class="fi-megaphone"></span> Thread</a></center>
				Do you have an interesting topic to discuss, post here</p>
			</div>
		</div>
		<a class="close-reveal-modal">&#215;</a>
	</div>