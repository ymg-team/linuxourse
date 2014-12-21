<section id="afterlogin">
	<div class="row">
		<ul class="breadcrumbs">
			<li><a href="<?php echo site_url()?>">Home</a></li>
			<li><a href="<?php echo site_url('news')?>">News</a></li>
			<li class="current"><a href="#"><?php echo $view['title']?></a></li>
		</ul>
		<div style="padding:0.9375rem" class="large-6 columns">

			<div class="level">
				<h1 style="margin:0"><a href=""><?php echo $view['title']?></a></h1>
				<small style="color:gray"><?php echo $view['username']?> | <?php echo $view['updatedate']?></small>
				<hr/><p>
				<?php echo $view['content']?></p>
			</div>
		</div>
		<div style="padding:0 0.9375rem 0.9375rem 0.9375rem" class="large-6 columns">
			<?php
			$recentNews = $this->m_news->news_list(4,0);
			foreach($recentNews as $rn):
			$id = base64_encode(base64_encode($rn['id_news']));
			$id = str_replace('=', '', $id);
			$title = str_replace(' ', '-', $rn['title']);
			?>
			<div style="padding:0.9375rem" class="large-12 columns">
				<div class="level">
					<p style="margin:0"><a href="<?php echo site_url('news/read/'.$id.'/'.$title)?>"><?php echo $rn['title']?></a></p>
					<small style="color:gray"><?php echo $rn['username']?> | <?php echo $rn['updatedate']?></small>
				</div>
			</div>
		<?php endforeach;?>
	</div>		

</div>
</section>