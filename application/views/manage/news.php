   <script type="text/javascript">
    function addForm(){$('.form-add').toggle('fast');};
  </script>
  <!--body-->
  <section  id="welcome">
    <!--login form-->
    <div class="login-form-block">
      <!--empty div-->
      <div class="row admin-content">
        <!-- sidebar -->
        <div class="large-2 columns">
         <?php $this->load->view('manage/sidebar');?>
       </div>
       <!-- end of sidebar -->
       <!-- content -->
       <div class="large-10 columns">
        <nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
          <li role="menuitem"><a href="#">Manage</a></li>
          <li role="menuitem" class="current"><a href="#">News</a></li>
        </nav>
        <br/>
        <?php if(!empty($_GET['success'])){//if add note ?>
        <div data-alert class="alert-box success">
          <?php echo $_GET['success'];?>
          <a href="#" class="close">&times;</a>
        </div>
        <?php }else if(!empty($_GET['error'])){?>
        <div data-alert class="alert-box error">
          <?php echo $_GET['error'];?>
          <a href="#" class="close">&times;</a>
        </div>
        <?php }?>
        <br/>
        <dl class="sub-nav">
          <dt>Filter:</dt>
          <dd id="published"><a href="<?php echo site_url('manage/news')?>">Published</a></dd>
          <dd id="draft"><a href="<?php echo site_url('manage/news/sort/draft')?>">Draft</a></dd>
        </dl>
        <div class="admin-content-white">
          <form style="float:tiny" method="get" name="q">
            <span class="row collapse" style="min-width:100%">
              <span class="large-11 columns">
                <input type="text" placeholder="searching level"></span>
                <span class="large-1 columns"><button type="submit" class="tiny">search</button>
                </span>
              </span>
            </form>            
            <center class="pagination"><?php echo $link;?></center>
            <a onclick="addForm()" class="button small">+ News</a>
            <!-- add news -->
            <div class="large-12 columns">
              <div class="form-add large-6 columns">
                <h5><strong>Add/Edit News</strong></h5>
                <form method="POST" action="">
                  <label>Title <input type="text" name="input_title" placeholder="title" value="<?php if(!empty($edit)){echo $edit['title'];}?>"></label>
                  <textarea name="input_content" style="min-height:300px" placeholder="content"><?php if(!empty($edit)){echo $edit['content'];}?></textarea>
                  <br/>
                  <?php if(empty($edit)){?>
                  <button name="btnpublish" type="submit"  class="button small">Publish</button> <button name="btndraft" type="submit"  class="button secondary small">Draft</button>
                  <?}else{?>
                  <button name="btnedit" type="submit"  class="button small">Save Changes</button> <button name="btneditdraft" type="submit"  class="button secondary small">Draft</button> <a onclick="return confirm('Are you sure!')" href="<?php echo site_url('manage/news/sort/delete/'.$edit['id_news'])?>" type="submit"  class="button alert small">Delete</a>
                  <?php } ?>
                </form>
              </div>
            </div>
            <!-- end of add news -->
            <?php if(!empty($view)):?>
              <table>
                <thead>
                  <tr>
                   <th>title</th>
                   <th style="width:150px">author</th>
                   <th style="width:100px">postdate</th>
                   <th style="width:100px">updatedate</th>
                   <th style="width:60px">status</th>
                   <th style="width:50px">action</th>
                 </tr>
               </thead>
               <tbody>
                <?php foreach($view as $v):?>
                  <tr>
                   <td><?php echo $v['title']?></td>
                   <td><?php echo $v['username']?></td>
                   <td><?php echo $v['postdate']?></td>
                   <td><?php echo $v['updatedate']?></td>
                   <td><?php echo $v['status']?></td>
                   <td><a href="<?php echo site_url('manage/news/sort/edit/'.$v['id_news'])?>">edit</a></td>
                 </tr>
               <?php endforeach;?>
             </tbody>
           </table>
         <?php endif;?>
         <center class="pagination"><?php echo $link;?></center>
         <!-- data from db -->
       </div>
     </div>
     <!-- end of content -->
   </div>
 </div>
 <!--end login form -->
</section>
<!--endof body-->