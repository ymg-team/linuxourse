<br/>
<dl class="sub-nav">
  <dt>Filter:</dt>
  <dd id="level-all"><a href="<?php echo site_url('manage/level')?>">All</a></dd>
  <dd id="level-bymateri"><a onclick="showMateri()">By Materi</a></dd>
</dl>
<dl id="listMateri" style="display:none" class="sub-nav">
  <dt>Choose Materi:</dt>
  <?php foreach($viewMateri as $vm):?>
    <dd id="by-materi-<?php echo $vm['id_materi']?>"><a href="<?php echo site_url('manage/level/bymateri/'.$vm['id_materi'])?>"><?php echo $vm['title']?></a></dd>
  <?php endforeach;?>
</dl>