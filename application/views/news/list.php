<section id="afterlogin">
	<div class="row">
		<div class="large-12 columns"><p></p></div>
		<ul class="breadcrumbs">
			<li><a href="<?php echo site_url()?>">Home</a></li>
			<li class="current"><a href="<?php echo site_url('news')?>">News</a></li>
		</ul>
		<?php foreach($view as $v):?>
			<div style="padding:0.9375rem" class="large-6 columns">
				<div class="level">
					<?php
					$id = base64_encode(base64_encode($v['id_news']));
					$id = str_replace('=', '', $id);
					$title = str_replace(' ', '-', $v['title']);
					$find = array('[',']');
					$replace = array('<','>');
					$content = substr(str_replace($find, $replace, $v['content']),0,100);
					$content = strip_tags($content);
					?>
					<h1 style="margin:0"><a href="<?php echo site_url('news/read/'.$id.'/'.$title)?>"><?php echo $v['title']?></a></h1>
					<small style="color:gray">yussan | <?php echo $v['updatedate']?></small>
					<hr/>				
					<p>
						<?php echo $content;?>...
					</p>
				</div>
			</div>
		<?php endforeach;?>
		<div class="large-12 columns">
			<center><?php echo $this->pagination->create_links();?></center>
		</div>
	</div>
</section>