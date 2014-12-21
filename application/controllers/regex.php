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
		for($n=1;$n<count($this->session->userdata['command']);$n++){
			
		}
		$specialcommand = array(
			'history'=>'last command',
			'cls'=>'clear screen',
			);
		//command is special command or not
		if(array_key_exists(trim($command),$specialcommand)){//found
			echo '<pre>student@linux-ecourse:~$ '.$command.$specialcommand[trim($command)].'</pre>';
		} else {//not found
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