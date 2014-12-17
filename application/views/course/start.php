<script type="text/javascript">
	function showhint(){
		$('#hint').toggle('fast');		
	}

</script>
<section id="livecommand">
	<div style="min-width:100%" class="row collapse">
		<!-- sidebar -->
		<div style="background-color:#F5F5F5" class="full-height large-3 columns">
			<ul style="/*background-color:#e7e7e7*/" class="button-group">
				<li style="width:20%"><a href="<?php echo site_url()?>" class="small secondary button"><strong>Back</strong></a></li>
				<li style="width:80%"><a style="width:100%" href="#" data-dropdown="drop1" aria-controls="drop1" aria-expanded="false" class="small button secondary dropdown">Level 3</a><br>
					<ul style="max-width:none" id="drop1" data-dropdown-content class="dropdownme f-dropdown" aria-hidden="true" tabindex="-1">
						<li><a href="#">ls to show directory structure [completed]</a></li>
						<li><a href="#">ls and option to directory structure [completed]</a></li>
						<li><a href="#">Activity 3</a></li>
						<li><a href="#">Activity 3</a></li>
						<li><a href="#">Activity 3</a></li>
						<li><a href="#">Activity 3</a></li>
						<li><a href="#">Activity 3</a></li>
					</ul>
				</li>
			</ul>
			<div class="learn_sidebar row">
				<p><strong>Case</strong><p>
					<div class="text">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin viverra urna ac metus consequat, nec consequat ipsum hendrerit. Donec in venenatis augue. Vestibulum ac elit magna. Fusce id sem eu erat dictum sagittis vitae at ligula. Vestibulum cursus sit amet odio sed dictum. Donec neque mauris,<br/> mattis id eleifend vitae, ullamcorper eget felis. Sed et tempus justo. Nam varius sed velit sed gravida. Sed feugiat elit augue, ultrices porttitor nulla commodo non. Fusce mattis, leo vitae viverra mollis, libero nibh ullamcorper velit, eu porttitor lorem sapien quis sem. Nam interdum dapibus interdum. Quisque semper tincidunt risus, sit amet viverra sapien sollicitudin nec. Mauris non turpis nisl. In ut tempor ligula.</p>
					</div>
					<hr/>
					<p><strong><a data-tooltip aria-haspopup="true" title="are you stuck?" onclick="showhint()">Hint !</a></strong><p>
						<div class="texthint">
							<p style="display:none" id="hint">
								use this to show all directory <code>ls</code><br/>
								use this to show all directory with permission <code>ls -l</code><br/>
								use this to show all directory include hidden directory <code>ls -a</code><br/>	
							</p></div>
						</div>
					</div>
					<!-- content -->
					<div class="full-height terminal_view large-9 columns">
						<div style="padding:10px" class="row collapse">
							<!-- command -->
							<div style="background-color:#000" class="command large-12 columns">
								<div class="item" style="overflow-x:auto">
<pre>
user@knowlinux.com:~$ ls -l /opt
total 28
drwxr-xr-x  7 root  root   4096 Des 16 06:36 ./
drwxr-xr-x 24 root  root   4096 Des 15 11:17 ../
drwxr-xr-x  3 10490 floppy 4096 Des  6 14:01 Adobe/
drwxr-xr-x  3 root  root   4096 Nov  3 13:40 google/
drwxr-xr-x  3 root  root   4096 Des 14 08:41 kingsoft/
drwxr-xr-x 30 root  root   4096 Nov  2 22:02 lampp/
drwxr-xr-x  4 root  root   4096 Nov  3 13:51 sublime_text/
</pre>
<pre>
user@knowlinux.com:~$ guard my body
No command 'guard' found, did you mean:
Command 'geard' from package 'python-gear' (universe)
Command 'guacd' from package 'guacd' (universe)
Command 'guards' from package 'quilt' (main)
guard: command not found
</pre>
									
									<span class="small-2 columns" style="padding:0;font-size:13px">user@knowlinux.com:~$</span>
									<span class="small-10 columns"  style="padding:0;"><textarea id="linux-command" autofocus></textarea></span>							
								</div>
							</div>
							<!-- button excute -->
							<div class="row">
								<!-- command -->
								<div style="padding-top:10px" class="large-6 columns">
									<a href="#" class="small button">Check</a>  <a href="#" class="small alert button">X</a><span style="padding:5px;color:#fff" id="loader">checking...</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>