<br/>
<dl class="sub-nav">
  <dt>Filter:</dt>
  <dd id="course-all"><a href="<?php echo site_url('manage/course')?>">All</a></dd>
  <dd id="course-bymateri"><a onclick="showMateri()">By Materi</a></dd>
  <dd id="course-active"><a href="#">Active</a></dd>
  <dd id="course-draft"><a href="#">Draft</a></dd>
</dl>
<dl id="listMateri" style="display:none" class="sub-nav">
  <dt>Choose Materi:</dt>
  <?php foreach($viewMateri as $vm):?>
    <dd id="by-materi-<?php echo $vm['id_materi']?>"><a href="<?php echo site_url('manage/coursebymateri/'.$vm['id_materi'])?>"><?php echo $vm['title']?></a></dd>
  <?php endforeach;?>
</dl>