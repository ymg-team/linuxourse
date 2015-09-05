<?php
//couting finishing time
$start = date_create($dotest['startDoTest']);
$end = date_create($dotest['endDoTest']);
$diff=date_diff($end,$start);
if($diff->h != 0 ){$h=$diff->h.' hours ';}else{$h='';}
if($diff->i != 0 ){$i=$diff->i.' minutes ';}else{$i='';}
if($diff->s != 0 ){$s=$diff->s.' seconds ';}else{$s='';}
$time = $h.$i.$s;
?>
<style type="text/css">body{background-color:#F4F4F4}</style>
<section class="row">
	<br/>
	<div style="padding:50px 0" class="small-6 small-offset-3 columns">
		<div style="padding:20px;background-color:#fff">
		<center>
		<h2  style="color:#000">Start Test</h2>
		<br/>
		<h5>Please Read This Message Before Starting Test !</h5>
		<br/>
		<p>
		<?php echo $test['testNotes'];?>
		</p>
		<hr/>
		<p>
		for further questions, please contact organizer<br/>
		(<?php echo $test['organization'];?>, <?php echo $test['testEmail'];?>)
		</p>
		<a class="button" href="<?php echo site_url('test/start/'.$test['idTest']);?>">Start Test</a>
		</center>
		</div>
	</div>
</section>
