<script src='https://www.google.com/recaptcha/api.js'></script>
<section id="title">
	<center>		
		<h1 style="margin:0">linuXourse Discussion</h1>
		<p>have problem, stuck, something not working, join the club and discuss it</p>
	</center>
</section>
<br/>
<div class="row">	
	<?php $this->load->view('discussion/order')?>
	<br/><br/>
	<div class="large-8 columns">
		<br/>
		<!-- new discuss form -->
		<div class="row">
			<?php 
			$error = validation_errors();
			if(!empty($error)){
				echo '
				<div data-alert class="alert-box alert radius">
					'.validation_errors().'<a href="'.site_url().'" class="close">&times;</a>
				</div>
				';
			}
			?>
			<h3>Edit Answer</h3>
			<form method="POST" action="<?php echo site_url('discussion/procEditAnswer/'.$id_answer)?>">
				<div class="large-12 columns">
					<div class="large-2 columns"><label><strong>Content</strong></label></div>
					<div class="large-10 columns"><small><a href="#">how to create content</a></small><br/>
						<textarea style="width:100%;min-height:300px" name="input_content"><?php if(!empty($view['comment'])){echo $view['comment'];}?></textarea>
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
						<input type="hidden" name="id_discuss" value="<?php echo $view['id_discussion']?>">
						<!-- recaptcha -->
						<div class="g-recaptcha" data-sitekey="6LcaGAQTAAAAAKRuyz9v_cGuKD4i-IzCbPIQgGlQ"></div>
						<!-- end of recaptcha -->
						<br/>
						<button class="button" type="submit">Edit Answer</button>
						<a href="<?php echo site_url('discussion/deleteanswer?id='.$this->uri->segment(3))?>" class="button alert medium">Delete</a>
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