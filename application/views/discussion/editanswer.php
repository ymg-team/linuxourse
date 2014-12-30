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
				<form action="<?php echo site_url('discussion/pedittopic')?>">
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
				<strong>order by : </strong><a href="<?php echo site_url('discussion')?>">Lattest</a> | <a href="#">Top Views</a> | <a href="#">Top Comment</a>
				<hr/>
			</div>
			<br/><br/>
			<div class="large-8 columns">
				<br/>
				<!-- new discuss form -->
				<div class="row">
					<?php 
					if(!empty(validation_errors())){
						echo '
						<div data-alert class="alert-box alert radius">
							'.validation_errors().'<a href="'.site_url().'" class="close">&times;</a>
						</div>
						';
					}
					?>
					<h3>Edit Answer</h3>
					<form method="POST" action="<?php echo site_url('discussion/procEditTopic')?>">
						<div class="large-12 columns">
							<div class="large-2 columns"><label><strong>Title</strong></label></div>
							<div class="large-10 columns"><input type="text" value="<?php if(!empty($view['title'])){echo $view['title'];}?>" name="input_title"></div>
						</div>
						<div class="large-12 columns">
							<div class="large-2 columns"><label><strong>Content</strong></label></div>
							<div class="large-10 columns"><small><a href="#">how to create content</a></small><br/><textarea style="width:100%;min-height:300px" name="input_content"><?php if(!empty($view['comment'])){echo $view['comment'];}?></textarea>
								<br/>
								<?php 
								if(!empty($captcha) && $captcha != $this->session->userdata('mycaptcha')){
									echo '
									<div data-alert class="alert-box alert radius">
										security code not match <a href="'.site_url().'" class="close">&times;</a>
									</div>
									';
								}
								?>
								<span style="float:left"><?php echo $image;?></span><span><input placeholder="security code" style="width:200px" type="text" name="input_captcha"></span>
								<br/>
								<button class="button" type="submit">Edit Answer</button>
							</div>
							
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