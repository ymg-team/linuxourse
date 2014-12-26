<?php foreach($this->m_discussion->show_discussion_by_views(8,0) AS $v): ?>
	<div style="float:left;padding:0.9375rem" class="discuss-item large-12 columns">
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
			<a class="linktitle" href="<?php echo site_url('discussion/open')?>"><?php echo $v['title']?></a><br/>
		</div>
		<hr/>					
	</div>
<?php endforeach;?>