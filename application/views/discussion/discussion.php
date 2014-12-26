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
				<strong>order by : </strong><a href="<?php echo site_url('discussion')?>">Lattest</a> | <a href="<?php echo site_url('discussion/orderby/views')?>">Top Views</a> | <a href="#">Top Comment</a>
				<hr/>
			</div>
			<br/><br/>
			<?php foreach($view as $v):?>
				<div style="float:left;padding:0.9375rem" class="discuss-item large-4 columns">
					<div class="avatar"><img class="discuss-avatar" src="<?php echo base_url('assets/img/avatar.png')?>" /></div>
					<div class="detail">
						<?php 
						if($v['type']=='ask'){
							echo '<a class="linktaggreen" href="'.site_url('discussion/all?type=ask').'">ask?</a>';
						}else{
							echo '<a class="linktagblue" href="'.site_url('discussion/all?type=thread').'">thread</a>';
						}
						?>					
						<span class="fi-eye"></span> <?php echo $v['views'];?> <span class="fi-comment"></span> <?php echo $this->m_discussion->count_comment($v['id_discuss']);?><br/><small><?php echo $v['updatedate']?></small>
					</div>
					<br/>
					<div class="title">
						<?php
						$id_discuss = base64_encode(base64_encode($v['id_discuss']));
						$id_discuss = str_replace('=', '', $id_discuss);
						?>
						<a class="linktitle" href="<?php echo site_url('discussion/open/'.$id_discuss)?>"><?php echo $v['title']?></a><br/>
					</div>
					<hr/>
					<p><?php echo $v['content'];?></p>	
				</div>
			<?php endforeach;?>
		</div>
		<div class="large-12 columns">
			<br/><br/>
			<center><?php echo $page;?></center>
			<br/><br/>
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
		<?php
	//generate link
		if(!empty($this->session->userdata['student_login'])){
			$link = site_url('discussion/creatediscuss');
		} else {
			$link = site_url('p/login');
		}
		?>
		<div class="large-6 columns">
			<p><center><a style="width:100%" href="<?php echo $link.'?create=ask';?>" class="button large"><span class=""></span> Ask</a></center>
				Are you stuck? <br/>
				some command does not work <br/>
				ask here
			</p>
		</div>
		<div class="large-6 columns">
			<p><center><a style="width:100%" href="<?php echo $link.'?create=thread';?>" class="button large"><span class="fi-megaphone"></span> Thread</a></center>
				Do you have an interesting topic to discuss, post here</p>
			</div>
		</div>
		<a class="close-reveal-modal">&#215;</a>
	</div>