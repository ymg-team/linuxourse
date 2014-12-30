<section id="title">
	<center>		
		<h2 style="margin:0">linuXourse Discussion</h2>
		<p>have problem, stuck, something not working, discuss it</p>
	</center>
</section>
<br/>
<div class="row">	
			<?php $this->load->view('discussion/order')?>
			<br/><br/>
			<?php foreach($view as $v):?>
				<div style="float:left;padding:0.9375rem" class="discuss-item large-4 columns">
					<div class="title">
						<?php
						$id_discuss = base64_encode(base64_encode($v['id_discuss']));
						$id_discuss = str_replace('=', '', $id_discuss);
						?>
						<a class="linktitle" href="<?php echo site_url('discussion/open/'.$id_discuss)?>"><?php echo $v['title']?></a><br/>
					</div>
					<hr/>
					<?php
					//regular expression

					//$content = $v['content'];
					$start = array('[',']');
					$replace = array('<','>');
					$content = str_replace($start, $replace, $v['comment']);
					$content = strip_tags($content);
					?>
					<small>post <?php echo $v['commentdate']?> | update <?php echo $v['updatedate']?></small><br/>
					<p><a title="edit answer" href="#"> <span class="fi-pencil"> </span></a><strong>my answer : </strong><?php echo $content;?></p>	
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