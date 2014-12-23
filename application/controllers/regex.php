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
		echo 'Error 404';
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
			echo '<pre>student@linux-ecourse:~$ '.$command.$specialcommand[$trimcommand].'</pre>';
		} else if(array_key_exists($trimcommand,$docommand)){//create input

		} else if(in_array($trimcommand,$forbiddencommand)){//forbidden command | preg_match
			echo '<pre>student@linux-ecourse:~$ '.$command.'FORBIDDEN command</pre>';
		}else {//not found
			$result = shell_exec($command);
		// echo '<pre>student@linux-ecourse:~$ '.$command.
		// 	$result.'</pre>';
			if(!empty($result)){
				echo '<pre>student@linux-ecourse:~$ '.$command.$result.'</pre>';			
			} else {
				echo '<pre>student@linux-ecourse:~$ '.$command.'No command "'.$command.'" found </pre>';
			}
		}
	}
	//delete history
	public function deletehistory(){
		$sessiondata['command'] = '';
		$this->session->set_userdata($sessiondata);
	}
}