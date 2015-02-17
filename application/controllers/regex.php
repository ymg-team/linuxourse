<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('application/controllers/base.php');//load base class
class regex extends base { //class for public

	public function __construct()
	{
		parent::__construct();
		//only for member
		$this->memberOnly();
		$this->load->model('m_command');
	}

	public function index(){
		//redirect to 4040
		$data['title'] = "PAGE NOT FOUND";
		$this->baseView('base/404',$data);
	}

	public function execcommand(){
		$command = $_GET['command'];
		//remove new line with regex
		$commandclear = preg_replace('/[\n]/', '', $command);
		//history setup
		//get all command have exec from session
		$history = array();
		//push to array recentcommand
		$recentcommand = $this->session->userdata['command'];
		if(!empty($recentcommand)){
			foreach($recentcommand as $rc):
				array_push($history,$rc);
			endforeach;	
		}		
		array_push($history, $command);
		$sessiondata['command'] = $history;
		//add history to season
		$this->session->set_userdata($sessiondata);
		//special command
		//get my history
		$myhistory = '';
		//get total history on session
		for($n=0;$n<count($this->session->userdata['command']);$n++){
			$myhistory = $myhistory.$this->session->userdata['command'][$n];
		}
		//end of history setup
		$commandArray = explode(' ', $command);
		//if using special command
		if(in_array('cd', $commandArray)){//cd
			redirect(site_url('regex/cd?command='.$command));
		} else if(trim($command) == 'ls' || in_array('ls', $commandArray)){//ls
			redirect(site_url('regex/ls?command='.$command));
		} else if(in_array('init',$commandArray) && in_array(0, $commandArray)){//init 0
			redirect(site_url('m/dashboard'));
		} else if(in_array('cat',$commandArray)){//cat file
			redirect(site_url('regex/cat?command='.$command));
		} else if(in_array('touch',$commandArray)){//touch new file
			redirect(site_url('regex/touch?command='.$command));
		} else if(in_array('nano',$commandArray)){//nano -> edit file
			redirect(site_url('regex/nano?command='.$command));
		} else if(in_array('mkdir',$commandArray)){//mkdir : create new directory
			redirect(site_url('regex/mkdir?command='.$command));
		}
		$specialcommand = array(
			'history'=>$myhistory,
			'cat'=>'no file input',
			'cd'=>'no directory input',
			'cls'=>'clear screen',
			'ls-l'=>'drwxrwxrwx  4 user user  4096 Nov  3 21:50 mydirectory',
			'ls-a'=>'.hiddendirectory <br/>mydirectory',
			'pwd'=>$this->session->userdata('dir'),
			'y'=>'confirmed',
			);
		$docommand = array(
			);
		$forbiddencommand = array(
			'reboot','init0');
		//command is special command or not
		$trimcommand = preg_replace('#[ \r\n\t]+#','', $command);
		if(array_key_exists($trimcommand,$specialcommand)){//output
			echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ '.$command.':'.$specialcommand[$trimcommand].'</pre>';
		} else if(array_key_exists($trimcommand,$docommand)){//create input

		} else if(in_array($trimcommand,$forbiddencommand)){//forbidden command | preg_match
			echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ '.$command.':'.'FORBIDDEN command</pre>';
		}else {//not found
			$result = shell_exec($command);
		// echo '<pre>student@linux-ecourse:~$ '.$command.
		// 	$result.'</pre>';
			if(!empty($result)){
				echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ '.$command.':'.$result.'</pre>';			
			} else {
				echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ '.$command.':'.'No command "'.$commandclear.'" found </pre>';
			}
		}
	}
	//change directory
	public function cd(){
		$command = $_GET['command'];
		//echo $command;
		//get directory
		$commandArray = explode(' ', $command);
		$cdCommand = array_shift($commandArray);
		$find = '/';
		// check from root or not
		$pos = strpos($commandArray[0],$find);
		//if from root '/'
		if($pos === 0){
			$dir = $commandArray[0];
		}else{
			$dir = $this->session->userdata['dir'].'/'.$commandArray[0];
		}
		//directory is found or not
		if($this->m_command->cekAvailableDir($dir)){//directory found
			$this->session->set_userdata('dir',$dir);
			echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ '.$command.' <br/>:directory changed</pre>';	
		}else{//directory not found
			echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ '.$command.' <br/>:no such file or directory</pre>';	
		}
	}
	//list 'ls'
	public function ls(){
		$command = $_GET['command'];
		$commandArray = explode(' ', $command);
		// print_r($commandArray);
		$lsOptions = array('-l','-a','-la','-al');
		if(!empty($commandArray[0]) && empty($commandArray[1]) && empty($commandArray[2])){//only ls active directory
			$dir = $this->session->userdata('dir');//get directory
			// echo 'only ls';
			return $this->m_command->ls($dir,'',$command);
		} else if(!empty($commandArray[0]) && in_array($commandArray[1], $lsOptions) && empty($commandArray[2])) { //ls active directory + options
			$dir = $this->session->userdata('dir');//get directory
			$options = $commandArray[1];
			return $this->m_command->ls($dir,$options,$command);
		} else if(!empty($commandArray[0]) && in_array($commandArray[1], $lsOptions) && !empty($commandArray[2])){//use option + atributes
			$pos = strpos($commandArray[2],'/');
			//if from root '/'
			if($pos === 0){
				$dir = $commandArray[2];
			}else{
				$dir = $this->session->userdata('dir').'/'.$commandArray[2];
			}
			$options = $commandArray[1];
			//check available directory
			if($this->m_command->cekAvailableDir($dir)){//directory found
				return $this->m_command->ls($dir,$options,$command);
			}else{//directory not found
				echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ '.$command.'<br/>:no such file or directory</pre>';	
			}			
		} else if(!empty($commandArray[0]) && !in_array($commandArray[1], $lsOptions) && !empty($commandArray[1])){//command + atributes
			$pos = strpos($commandArray[1],'/');
			//if from root '/'
			if($pos === 0){
				$dir = $commandArray[1];
			}else{
				$dir = $this->session->userdata('dir').'/'.$commandArray[1];
			}
			//check available directory
			if($this->m_command->cekAvailableDir($dir)){//directory found
				return $this->m_command->ls($dir,'',$command);
			}else{//directory not found
				echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ '.$command.'<br/>:no such file or directory</pre>';	
			}
		} else{
			echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ '.$command.'<br/>:command incorect</pre>';	
		}
	}
	//cat
	public function cat(){
		$command = $_GET['command'];
		//cek is this folder or not
		$commandArray = explode(' ', $command);
		$cdCommand = array_shift($commandArray);
		$find = '/';
		// check from root or not
		$pos = strpos($commandArray[0],$find);
		//if from root '/'
		if($pos === 0){
			$dir = $commandArray[0];
		}else{
			$dir = $this->session->userdata['dir'].'/'.$commandArray[0];
		}
		//database check
		return $this->m_command->cat($dir);		
	}
	//nano
	public function nano(){
		$command = $_GET['command'];
		$commandarray = explode(' ', $command);
		$filename = $commandarray[1];//get filename
		//only ca use nano on /home/user
		if($this->session->userdata('dir')!='/home/user'){
			echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ '.$command.' <br/>location not allowed </pre>';
		}else{
			//is file on session
			$found = FALSE;
			foreach($this->session->userdata('myfile') as $mf):
				if($filename == $mf['name']):
					echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ '.$command.' <br/></pre>';
				echo '<textarea style="font-family:monospace" id="nano" autofocus>'.$mf['content'].'</textarea>';
				echo '<span style="font-family:monospace;color:#000;background-color:#fff">save = ^x</span>';
					$found = TRUE;//found file to be 'nano'
					endif;
					endforeach;
			//found or not
					if($found==FALSE){
						echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ '.$command.' <br/>:no file found</pre>';
					}
				}
			}
	//touch : create new empty file [WORK]
			public function touch(){
				$command = $_GET['command'];
				$commandarray = explode(' ', $command);
		$filename = $commandarray[1];//get filename
		//only ca use nano on /home/user
		//cek pwd
		//only /home/user can touch new file
		if($this->session->userdata('dir')!='/home/user'){
			echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ '.$command.' <br/>location not allowed </pre>';
		}else{
			//adding new file to session;
			$getfile = array();
			$newfile = array(
				'name'=>$filename,
				'permissions'=>'rwx------',
				'create'=>date('dMY H:i'),
				'owner'=>$this->session->userdata['student_login']['username'],
				'content'=>'',
				);
			foreach ($this->session->userdata('myfile') as $mf) {
				if($mf['name']==$filename){
					redirect(site_url('regex/errortouch/'.$filename));
				}else{
					array_push($getfile, $mf);
				}
			}
			array_push($getfile, $newfile);
			// print_r($getfile);
			$this->session->set_userdata('myfile',$getfile);
			echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ '.$command.' <br/>:new file created</pre>';
		}
	}
	//mkdir : create new empty directory
	public function mkdir(){
		$command = $_GET['command'];
		$commandarray = explode(' ', $command);
		$directoryname = $commandarray[1];//get directoryname
		if(empty($directoryname)){redirect(site_url('regex/errorMessage/?error= can\'t create new directory &command='.$command));}
		//cek location
		if($this->session->userdata('dir')!='/home/user'){//location not on /home/user = can't create new file
		echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ '.$command.' <br/>location not allowed </pre>';
		}else{//can create new file
			$getdir = array();
			$newdir = array(
				'name'=>$directoryname,
				'permissions'=>'rwx------',
				'create'=>date('dMY H:i'),
				'owner'=>$this->session->userdata['student_login']['username'],
				);
			//get all directory on session
			foreach ($this->session->userdata('mydir') as $md) {
				if($md['name']==$directoryname){
					redirect(site_url('regex/errorMessage/?error=can\'t create, directory is available&command='.$command));
				}else{
					array_push($getdir, $md);
				}
			}
			array_push($getdir,$newdir);
			// print_r($getfile);
			$this->session->set_userdata('mydir',$getdir);
			echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ '.$command.' <br/>:new directory created</pre>';
		}
	}
	//error  message for all
	public function errorMessage(){
		$command = $_GET['command'];//get error command from terminal
		$error = $_GET['error'];//get error message
		echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ '.$command.' <br/>:"'.$error.'"</pre>';
	}
	//error touch
	public function errorTouch(){
		$filename = $this->uri->segment(3);
		echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ touch '.$filename.' <br/>:"'.$filename.'" already available</pre>';
	}
	//delete history
	public function deletehistory(){
		$sessiondata['command'] = '';
		$this->session->set_userdata($sessiondata);
	}
	//command not found
	public function commandNotFound(){
		echo '<pre>student@linux-ecourse:'.$this->session->userdata['dir'].'$ No command found </pre>';
	}
	//ALL ABOUT COURSE CHECK
	//check result
	public function check(){
		$terminal = strip_tags($_POST['terminal']);//remove all html tag
		//replace space
		$updateterminal = preg_replace("/[\n\r\t]/", "", $terminal);;
		//get id user course
		$usercourseid = $_POST['usercourseid'];
		//decrypt id  usercourse
		$idusercourse = str_replace('','=',$usercourseid);
		$idusercourse = base64_decode(base64_decode($idusercourse));
		//get course data by id user course
		// echo $idusercourse;
		$course_data = $this->m_course->detCourseByUserCourse($idusercourse);
		//start regex, get command only from terminal
		preg_match_all('#\$(.*):#Us', $terminal,$reg_terminal,PREG_SET_ORDER);
		// print_r($reg_terminal);//show preg match result
		$reg_result = $reg_terminal;
		$command_list = array();
		$command_db = explode(':', $course_data['command']);
		//destroy command_db
		//create new array
		foreach($reg_result as $rs):
			array_push($command_list, trim($rs[1]));
		endforeach;
		// print_r($command_db);
		// echo '<br/>';
		// print_r($command_list);
		//cek command list and command db
		foreach($command_db as $cbase):
			if(in_array(trim($cbase),$command_list)){
				// echo $cbase.' in array </br>';
				$course = TRUE;
			}else{
				$course = FALSE;
				// echo $cbase.' not in array </br>';
				// echo '<a onclick="check()" class="small button">Check</a>  <a onclick="clearTerminal()" title="clear terminal" href="#" class="small alert button">X</a><span style="padding:5px;color:#fff;display:none" id="loadercheck"><img style="width:30px;margin-right:5px;" src="'.base_url('./assets/img/loader.gif').'"/>checking..</span><span style="padding:5px;color:#fff;display:none" id="loaderexe"><img style="width:30px;margin-right:5px;" src="'.base_url('./assets/img/loader.gif').'"/>execute..</span><span style="color:#fff"> oops, try again</span>';
				redirect(site_url('regex/check_fault'));
			}
			endforeach;
			//set session case = true
			if($course = TRUE){
				echo '<a style="border:1px solid #fff" href="'.site_url('course/next/'.$usercourseid).'" class="small button success"><strong><span class="fi-check"></span> Good, Next Step</strong></a> <a onclick="clearTerminal()" title="clear terminal" href="#" class="small alert button">X</a>';
				$sessiondata['coursestatus'] = $course;
				$this->session->set_userdata($sessiondata);	
			}			
		//matching input command and database command
		// echo '<hr/>';
		// echo $updateterminal; 
		}
		
		//rewind check
		public function checkrewind(){
			$terminal = strip_tags($_POST['terminal']);//remove all html tag
		//replace space
			$updateterminal = preg_replace("/[\n\r\t]/", "", $terminal);;
		//get id course
			$idcourse = $_POST['idcourse'];
		//decrypt id  usercourse
			$idcourse = str_replace('','=',$idcourse);
			$idcourse = base64_decode(base64_decode($idcourse));
		//get course data by id course
			$course_data = $this->m_course->detCourseByIdCourse($idcourse);
			print_r($course_data);
		//start regex, get command only from terminal
			preg_match_all('#\$(.*):#Us', $terminal,$reg_terminal,PREG_SET_ORDER);
		// print_r($reg_terminal);//show preg match result
			$reg_result = $reg_terminal;
			$command_list = array();
			$command_db = explode(':', $course_data['command']);
		//destroy command_db
		//create new array
			foreach($reg_result as $rs):
				array_push($command_list, trim($rs[1]));
			endforeach;
		// print_r($command_db);
		// echo '<br/>';
		// print_r($command_list);
		//cek command list and command db
			foreach($command_db as $cbase):
				if(in_array(trim($cbase),$command_list)){
				// echo $cbase.' in array </br>';
					$course = TRUE;
				}else{
					$course = FALSE;
				// echo $cbase.' not in array </br>';
				// echo '<a onclick="check()" class="small button">Check</a>  <a onclick="clearTerminal()" title="clear terminal" href="#" class="small alert button">X</a><span style="padding:5px;color:#fff;display:none" id="loadercheck"><img style="width:30px;margin-right:5px;" src="'.base_url('./assets/img/loader.gif').'"/>checking..</span><span style="padding:5px;color:#fff;display:none" id="loaderexe"><img style="width:30px;margin-right:5px;" src="'.base_url('./assets/img/loader.gif').'"/>execute..</span><span style="color:#fff"> oops, try again</span>';
					//redirect(site_url('regex/check_fault'));
				}
				endforeach;
			//set session case = true
				if($course = TRUE){
					echo '<a style="border:1px solid #fff" href="'.site_url('course/next/'.$usercourseid).'" class="small button success"><strong><span class="fi-check"></span> Good, Next Step</strong></a> <a onclick="clearTerminal()" title="clear terminal" href="#" class="small alert button">X</a>';
					$sessiondata['coursestatus'] = $course;
					$this->session->set_userdata($sessiondata);	
				}			
		//matching input command and database command
		// echo '<hr/>';
		// echo $updateterminal; 
			}

			public function check_fault(){
		//set session case = fault
				$course = FALSE;
				$sessiondata['coursestatus'] = $course;
				$this->session->set_userdata($sessiondata);
				echo '<a onclick="check()" class="small button">Check</a>  <a onclick="clearTerminal()" title="clear terminal" href="#" class="small alert button">X</a><span style="padding:5px;color:#fff;display:none" id="loadercheck"><img style="width:30px;margin-right:5px;" src="'.base_url('./assets/img/loader.gif').'"/>checking..</span><span style="padding:5px;color:#fff;display:none" id="loaderexe"><img style="width:30px;margin-right:5px;" src="'.base_url('./assets/img/loader.gif').'"/>execute..</span><span style="color:#fff"> oops, try again</span>';
			}
		}