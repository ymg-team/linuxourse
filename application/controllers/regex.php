<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('application/controllers/base.php');//load base class
class regex extends base { //class for public

	public function __construct()
	{
		parent::__construct();
		//only for member
		$this->memberOnly();
	}

	public function index(){
		//redirect to 4040
		$data['title'] = "PAGE NOT FOUND";
		$this->baseView('base/404',$data);
	}

	public function execcommand(){
		$command = $_GET['command'];
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
		$specialcommand = array(
			'history'=>$myhistory,
			'cls'=>'clear screen',
			'ls-l'=>'drwxrwxrwx  4 user user  4096 Nov  3 21:50 mydirectory',
			'ls-a'=>'.hiddendirectory <br/>mydirectory',
			'pwd'=>'/home/user/',
			'ls'=>'mydirectory',
			'y'=>'confirmed',
			);
		$docommand = array(
			);
		$forbiddencommand = array(
			'reboot','init0');
		//command is special command or not
		$trimcommand = preg_replace('#[ \r\n\t]+#','', $command);
		if(array_key_exists($trimcommand,$specialcommand)){//output
			echo '<pre>student@linux-ecourse:~$ '.$command.':'.$specialcommand[$trimcommand].'</pre>';
		} else if(array_key_exists($trimcommand,$docommand)){//create input

		} else if(in_array($trimcommand,$forbiddencommand)){//forbidden command | preg_match
			echo '<pre>student@linux-ecourse:~$ '.$command.':'.'FORBIDDEN command</pre>';
		}else {//not found
			$result = shell_exec($command);
		// echo '<pre>student@linux-ecourse:~$ '.$command.
		// 	$result.'</pre>';
			if(!empty($result)){
				echo '<pre>student@linux-ecourse:~$ '.$command.':'.$result.'</pre>';			
			} else {
				echo '<pre>student@linux-ecourse:~$ '.$command.':'.'No command "'.$command.'" found </pre>';
			}
		}
	}
	//delete history
	public function deletehistory(){
		$sessiondata['command'] = '';
		$this->session->set_userdata($sessiondata);
	}


	//ALL ABOUT COURSE CHECK
	//check result
	public function check(){
		$terminal = strip_tags($_POST['terminal']);//remove all html tag
		//replace space
		$updateterminal = preg_replace("/[\n\r\t]/", "", $terminal);;
		//get id course
		$id = $_POST['id'];
		//decrypt id course
		$idcourse = str_replace('','=',$id);
		$idcourse = base64_decode(base64_decode($idcourse));
		//get course data
		$course_data = $this->m_course->detCourse($idcourse);
		//start regex
		preg_match_all('#\$(.*):#Us', $terminal,$reg_terminal,PREG_SET_ORDER);
		// print_r($reg_terminal);//show preg match result
		$reg_result = $reg_terminal;
		$command_list = array();
		$command_db = explode(':', $course_data['command']);
		//destroy command_db
		//create new array
		foreach($reg_result as $rs):
			array_push($command_list, $rs[1]);
		endforeach;
		print_r($command_db);echo '<br/>';
		print_r($command_list);echo '<br/>';
		//cek command list and command db
		foreach($command_db as $cbase):
			if(in_array($cbase,$command_list)){
				echo $cbase.' in array </br>';
			}else{
				echo $cbase.' not in array </br>';
				// redirect(site_url('regex/check_fault'));
			}
		endforeach;
		//matching input command and database command
		// echo '<hr/>';
		// echo $updateterminal; 
	}
	public function check_fault(){
		echo '<a onclick="check()" class="small button">Check</a>  <a onclick="clearTerminal()" title="clear terminal" href="#" class="small alert button">X</a><span style="padding:5px;color:#fff;display:none" id="loadercheck"><img style="width:30px;margin-right:5px;" src="'.base_url('./assets/img/loader.gif').'"/>checking..</span><span style="padding:5px;color:#fff;display:none" id="loaderexe"><img style="width:30px;margin-right:5px;" src="'.base_url('./assets/img/loader.gif').'"/>execute..</span><span style="color:#fff"> oops, try again</span>';
	}
}