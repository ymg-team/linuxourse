<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class base extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//load all model
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('m_user');
		$this->load->model('m_course');
		// $this->load->model('m_admin');
	}

	public function index()
	{
		echo '404';	 
	}

	//base view
	public function baseView($x="",$data=""){ //x = view anak , y = data
		$data['childView'] = $x;
		$this->load->view('base/baseView',$data);
	}
	//base view
	public function baseManageView($x="",$data=""){ //x = view anak , y = data
		$data['childView'] = $x;
		$this->load->view('base/baseManageView',$data);
	}
	//empty base view
	public function emptyBaseView($x="",$data=""){ //x = view anak , y = data
		$data['childView'] = $x;
		$this->load->view('base/emptyBaseView',$data);
	}
	//member only
	public function memberOnly(){
		if(empty($this->session->userdata['student_login']['id_user'])){
			redirect(site_url('p/login'));
		}
	}
	//admin only
	public function adminOnly(){
		if(empty($this->session->userdata['admin_login']['id_user'])){
			redirect(site_url('manage'));
		}
	}
	//check directory
	public function checkDir($x){//x = directory
		$dirList = array('/home/user/mydir','/var','/etc','/home','/home/user','/');
		if(in_array($x, $dirList)){
			return true;
		}else{return false;}
	}

	//special command
	public function specialCommand($command){//trim command
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
			'ls'=>'mydirectory',
			'y'=>'confirmed',
			);
		//command is special command or not
		$trimcommand = preg_replace('#[ \r\n\t]+#','', $command);
		if(array_key_exists($trimcommand,$specialcommand)){//found
			echo '<pre>student@linux-ecourse:~$ '.$command.$specialcommand[$trimcommand].'</pre>';
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
	//check available file/directory on session :: /home/user
	public function searchAttributes($type,$name){
		$found = false;
		switch ($type){
			case 'dir':
			foreach($this->session->userdata('mydir') as $list):
				if($list['name']==$name){
					$found = true;
				}
				endforeach;					
				break;
				case 'file':
				foreach($this->session->userdata('myfile') as $list):
					if($list['name']==$name){
						$found = true;
					}
					endforeach;	
					break;
					default:
					$found = false;
					break;
				}
				if($found == true){
					return true;
				}else{
					return false;
				}
			}
	//rm file or directory
			public function rmAttributes($type,$name){
				$files = array();
				$directories = array();
				switch ($type) {
					case 'dir':
					$sessionDir = $this->session->userdata('mydir');
					foreach($sessionDir as $sd):
						if($sd['name'] != $name):
							array_push($directories, $sd);
						endif;
					endforeach;
					//set session
					$this->session->set_userdata('mydir',$directories);
					break;
					case 'file':
					$sessionFile = $this->session->userdata('myfile');
					foreach($sessionFile as $sf):
						if($sf['name'] != $name):
							array_push($files, $sf);
						endif;
					endforeach;
					//set session
					$this->session->set_userdata('myfile',$files);
					break;
					default:
					echo 'Something wrong, please refresh page';
					break;
				}
			}
	//return to row array
				public function returnToRow($query){
					if($query->num_rows()>0){
						return $query->row_array();
					}else{
						return array();
					}
				}
	//return to result array
				public function returnToResult($query){
					if($query->num_rows()>0){
						return $query->result_array();
					}else{
						return array();
					}
				}

			}

			/* End of file base.php */
/* Location: ./application/controllers/base/base.php */