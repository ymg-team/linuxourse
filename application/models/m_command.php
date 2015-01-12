<?php

class m_command extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	//check available dir
	public function cekAvailableDir($dir){
		$this->db->where('directory',$dir);
		$query = $this->db->get('available_dir');
		if($query->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	//using ls 
	public function ls($directory,$options){
		//get all directory
		$sqldir = "SELECT directory FROM available_dir WHERE directory LIKE '".$directory."/%'";
		$querydir =  $this->db->query($sqldir);
		if($querydir->num_rows()>0){
			$lsdir = $querydir->result_array();
		}else{
			$lsdir = array();
		}
			//get all file and links
		$sqlfile = "SELECT name FROM ls_dir 
		INNER JOIN available_dir ON available_dir.id = ls_dir.id_available_dir
		WHERE available_dir.directory = ? AND name NOT LIKE '.%'";
		$queryfile = $this->db->query($sqlfile,$directory);
		if($queryfile->num_rows()>0){
			$lsfile = $queryfile->result_array();
		}else{
			$lsfile = array();
		}
		//ls type
		if(empty($options)) {
			//print result
			//print dir
			echo '<pre>student@linux-ecourse:'.$this->session->userdata('dir').'$ ls '.$directory.'<br/>';
			foreach($lsdir as $ld):
				echo str_replace($directory.'/', '', $ld['directory']).'/ ';
			endforeach;
			//print file
			foreach($lsfile as $lf):
				echo $lf['name'].' ';
			endforeach;
			echo '</pre>';
		}else{
			switch ($options) {
				case '-l':
				echo '<pre>student@linux-ecourse:'.$this->session->userdata('dir').'$ ls '.$options.' '.$directory.'<br/>';
				echo '</pre>';
				break;
				case '-a':
				echo '<pre>student@linux-ecourse:'.$this->session->userdata('dir').'$ ls '.$options.' '.$directory.'<br/>';
				echo '</pre>';
				break;
				case '-la'||'-al':
				echo '<pre>student@linux-ecourse:'.$this->session->userdata('dir').'$ ls '.$options.' '.$directory.'<br/>';
				echo '</pre>';
				break;
			}
		}
	}
}