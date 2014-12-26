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
				<strong>order by : </strong><a href="#">Lattest</a> | <a href="#">Top Views</a> | <a href="#">Top Comment</a>
				<hr/>
			</div>
			<br/><br/>
			<div class="large-8 columns">
				<div style="float:left;padding:0.9375rem" class="discuss-item large-12 columns">
					<div class="avatar"><img class="discuss-avatar" src="<?php echo base_url('assets/img/avatar.png')?>" /></div>
					<?php 
					if($view['type']=='ask'){
						echo '<a class="linktaggreen" href="'.site_url('discussion/all?type=ask').'">ask?</a>';
					}else{
						echo '<a class="linktagblue" href="'.site_url('discussion/all?type=thread').'">thread</a>';
					}
					?>					
					<span class="fi-eye"></span> <?php echo $view['views'];?> <span class="fi-comment"></span> <?php echo $this->m_discussion->count_comment($view['id_discuss']);?><br/><small><?php echo $view['updatedate']?></small>
					<br/>
					<br/>
					<div class="title">
						<h1><a style="font-size:20px" class="linktitle" href="<?php echo site_url('discussion/open')?>"><?php echo $view['title']?></a> <?php if(!empty($this->session->userdata['student_login'])){echo '<a class="button" href="'.site_url('discussion/edit').'">edit</a>';}?></h1><br/>
					</div>
					<hr/>
					<p><?php echo $view['content'];?></p>
					<br/><br/>
					<div class="col-md-12">
						<div class="comment-item row">
							<div class="small-10 columns">
								<div class="avatar"><img class="discuss-avatar" src="<?php echo base_url('assets/img/avatar.png')?>" /></div>
								<small>12/01/2014 </small>
								<br/><br/><br/>
								<p>sdsdsds</p>
							</div>
							<div style="float:left" class="small-2 columns">
								<p><a href="#"><span class="fi-arrow-up"></span></a> 4500
								<br/>
								<a href="#"><span class="fi-arrow-down"></span></a> 345</p>
							</div>
						</div>
						<br/>
						<div class="comment-item row">
							<div class="small-10 columns">
								<div class="avatar"><img class="discuss-avatar" src="<?php echo base_url('assets/img/avatar.png')?>" /></div>
							</div>
							<div class="small-2 columns">
								btn
							</div>
						</div>
					</div>
				</div>
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