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
		//check from database
		$query = $this->db->get('available_dir');
		if($query->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	//using ls 
	public function ls($directory,$options,$command){
		if(empty($directory)){$directory = '/';}
		//get all directory inside
		if($directory == '/'){//if ls root
			$sqldir = "SELECT directory FROM available_dir WHERE directory NOT LIKE '%.%'";
		}else{//if ls except root
			$sqldir = "SELECT directory FROM available_dir WHERE directory NOT LIKE '%.%' AND directory LIKE '".$directory."/%'";
		}
		$querydir =  $this->db->query($sqldir);
		if($querydir->num_rows()>0){
			$lsdir = $querydir->result_array();
		}else{
			$lsdir = array();
		}
		//end of get all directory inside
		//ls type
		$showdir = array();//first show empty directory
		if(empty($options)) {
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
			//print result
			//print dir
			echo '<pre>student@linux-ecourse:'.$this->session->userdata('dir').'$ '.$command.'<br/>:';
				foreach($lsdir as $ld)://worked
				if($directory == '/'){//only for root
					//only replace first match
					$dir = preg_replace('/\//', '', $ld['directory'],1).'/ ';//using
				}else{//except root
					$dir = str_replace($directory.'/', '', $ld['directory']).'/ ';
				}
				$insidedir = explode('/', $dir);
				if(!in_array($insidedir[0], $showdir)){
					echo '<span class="terminal-showdir">'.$insidedir[0].'/</span> ';
				}
				array_push($showdir, $insidedir[0]);
				endforeach;
				//print directory from session
				if($directory == '/home/user'):
					$sessiondir = $this->session->userdata('mydir');
				foreach($sessiondir as $sd):
					echo '<span class="terminal-showdir">'.$sd['name'].'/</span> ';
				endforeach;
				endif;
				//print file
				foreach($lsfile as $lf):
					echo $lf['name'].' ';
				endforeach;
				//if active directory is /home/user, show file on session
				if($directory == '/home/user'):
					$sessionfile = $this->session->userdata('myfile');
				foreach($sessionfile as $sf):
					echo $sf['name'].' ';
				endforeach;
				endif;
				//end if
				echo '</pre>';
			}else{
				switch ($options) {
				case '-l': //-l
					//get all file and links
				$sqlfile = "SELECT name,type,attributes FROM ls_dir
				INNER JOIN available_dir ON available_dir.id = ls_dir.id_available_dir
				WHERE available_dir.directory = ? AND name NOT LIKE '.%'";
				$queryfile = $this->db->query($sqlfile,$directory);
				if($queryfile->num_rows()>0){
					$lsfile = $queryfile->result_array();
				}else{
					$lsfile = array();
				}
				echo '<pre>student@linux-ecourse:'.$this->session->userdata('dir').'$ '.$command.'<br/>:';
				//print folder
				foreach($lsdir as $ld):
						if($directory == '/'){//only for root
							//only replace first match
							$dir = preg_replace('/\//', '', $ld['directory'],1).'/ ';//using
						}else{//except root
							$dir = str_replace($directory.'/', '', $ld['directory']).'/ ';
						}
						$insidedir = explode('/', $dir);
						if(!in_array($insidedir[0], $showdir)){
							echo 'drwx------:0 admin linuxourse 7000 1Jan2015 24:00 <span class="terminal-showdir">'.$insidedir[0].'/</span><br/>';
						}
						array_push($showdir, $insidedir[0]);
						endforeach;
						//print directory from session
						if($directory == '/home/user'):
							$sessiondir = $this->session->userdata('mydir');
						foreach($sessiondir as $sd):
							echo 'd'.$sd['permissions'].':0 '.$sd['owner'].'  '.$sd['owner'].' 7000 '.$sd['create'].' <span class="terminal-showdir">'.$sd['name'].'/</span><br/>';
						endforeach;
						endif;
						//print file
						foreach($lsfile as $lf):
							$attributes = str_replace('|',' ', $lf['attributes']);
						echo $lf['type'].$attributes.' '.$lf['name'];
						endforeach;
						//if active directory is /home/user, show file on session
						if($directory == '/home/user'):
							$sessionfile = $this->session->userdata('myfile');
						foreach($sessionfile as $sf):
							echo '<br/>'.$sf['type'].$sf['permissions'].':0 '.$sf['owner'].' '.$sf['owner'].' 7000 '.$sf['create'].' '.$sf['name'].' ';
						endforeach;
						endif;
						//end if
						echo '</pre>';
						break;
				case '-a': //-a
				//get all file and links
				$sqlfile = "SELECT name FROM ls_dir
				INNER JOIN available_dir ON available_dir.id = ls_dir.id_available_dir
				WHERE available_dir.directory = ?";
				$queryfile = $this->db->query($sqlfile,$directory);
				if($queryfile->num_rows()>0){
					$lsfile = $queryfile->result_array();
				}else{
					$lsfile = array();
				}
					//print dir
				echo '<pre>student@linux-ecourse:'.$this->session->userdata('dir').'$ '.$command.'<br/>:';
				foreach($lsdir as $ld):
						if($directory == '/'){//only for root
							//only replace first match
							$dir = preg_replace('/\//', '', $ld['directory'],1).'/ ';//using
						}else{//except root
							$dir = str_replace($directory.'/', '', $ld['directory']).'/ ';
						}
						$insidedir = explode('/', $dir);
						if(!in_array($insidedir[0], $showdir)){
							echo '<span class="terminal-showdir">'.$insidedir[0].'/</span> ';
						}
						array_push($showdir, $insidedir[0]);
						endforeach;
						//print directory from session
						if($directory == '/home/user'):
							$sessiondir = $this->session->userdata('mydir');
						foreach($sessiondir as $sd):
							echo '<span class="terminal-showdir">'.$sd['name'].'/</span> ';
						endforeach;
						endif;
					//print file
						foreach($lsfile as $lf):
							echo $lf['name'].' ';
						endforeach;
					//if active directory is /home/user, show file on session
						if($directory == '/home/user'):
							$sessionfile = $this->session->userdata('myfile');
						foreach($sessionfile as $sf):
							echo $sf['name'].' ';
						endforeach;
						endif;
					//end if
						echo '</pre>';
						break;
				case '-la'||'-al': //-la || -al
					//get all file and links
				$sqlfile = "SELECT name,type,attributes FROM ls_dir
				INNER JOIN available_dir ON available_dir.id = ls_dir.id_available_dir
				WHERE available_dir.directory = ?";
				$queryfile = $this->db->query($sqlfile,$directory);
				if($queryfile->num_rows()>0){
					$lsfile = $queryfile->result_array();
				}else{
					$lsfile = array();
				}
				echo '<pre>student@linux-ecourse:'.$this->session->userdata('dir').'$ ls '.$command.'<br/>:';
					//print folder
				foreach($lsdir as $ld):
						if($directory == '/'){//only for root
							//only replace first match
							$dir = preg_replace('/\//', '', $ld['directory'],1).'/ ';//using
						}else{//except root
							$dir = str_replace($directory.'/', '', $ld['directory']).'/ ';
						}
						$insidedir = explode('/', $dir);
						if(!in_array($insidedir[0], $showdir)){
							echo 'drwx------:0 admin linuxourse 7000 1Jan2015 24:00 <span class="terminal-showdir">'.$insidedir[0].'/</span><br/>';
						}
						array_push($showdir, $insidedir[0]);
						endforeach;
						//print directory from session
						if($directory == '/home/user'):
							$sessiondir = $this->session->userdata('mydir');
						foreach($sessiondir as $sd):
							echo 'd'.$sd['permissions'].':0 '.$sd['owner'].'  '.$sd['owner'].' 7000 '.$sd['create'].' <span class="terminal-showdir">'.$sd['name'].'/</span><br/>';
						endforeach;
						endif;
						//print file
						foreach($lsfile as $lf):
							$attributes = str_replace('|',' ', $lf['attributes']);
						echo $lf['type'].$attributes.' '.$lf['name'].'<br/>';
						endforeach;
						//if active directory is /home/user, show file on session
						if($directory == '/home/user'):
							$sessionfile = $this->session->userdata('myfile');
						foreach($sessionfile as $sf):
							echo $sf['type'].$sf['permissions'].':0 '.$sf['owner'].' '.$sf['owner'].' 7000 '.$sf['create'].' '.$sf['name'].'<br/>';
						endforeach;
						endif;
						//end if
						echo '</pre>';
						break;
					}
				}
			}
			//using cat
			public function cat($directory){
//get file name
				$dirArray = explode('/', $directory);
//file name is last index
				$filename = end($dirArray);
//get real directory name
				$directory = str_replace('/'.$filename,'',$directory);
//cek on database
				$params = array($filename,$directory);
				$sql = "SELECT content FROM ls_dir
				INNER JOIN available_dir ON ls_dir.id_available_dir = available_dir.id
				WHERE ls_dir.name = ? AND available_dir.directory = ? ";
				$query = $this->db->query($sql,$params);
		if($query->num_rows()>0){//print content k
			return $query->row_array();//get file content
		}else{//get file form home / session
			$found = FALSE;//default file not found on home session
			foreach($this->session->userdata('myfile') as $mv):
				if($mv['name']==$filename){
					$found = TRUE;
					$filecontent = $mv['content'];
				}
				endforeach;
			}
			//found or not
			if($found){
				$result = array(
					'content'=>$filecontent,
					);
				// echo '<pre>student@linux-ecourse:'.$this->session->userdata('dir').'$ cat '.$directory.'/'.$filename.'<br/>:'
				// .$filecontent.'</pre>';
				return $result;

			}else{
				// echo '<pre>student@linux-ecourse:'.$this->session->userdata('dir').'$ cat '.$directory.'/'.$filename.'<br/>:file not found</pre>';			
				return array();
			}
		}

		//update file content
		public function editFile($name,$params){
			$files = array();
			foreach($this->session->userdata('myfile') as $file):
				if($file['name'] == $name){
					$updatedFile = array();
					//update nama
					if(!empty($params['name'])){
						$updatedFile['name'] = $params['name'];//new name
					}else{
						$updatedFile['name'] = $file['name'];//old name
					}
					//update permission
					if(!empty($params['permissions'])){
						$updatedFile['permissions'] = $params['permissions'];//new permissions
					}else{
						$updatedFile['permissions'] = $file['permissions'];//old permissions
					}
					//update creation
					$updatedFile['create'] = date('dMY H:i');//new time
					//update owner
					if(!empty($params['owner'])){
						$updatedFile['owner'] = $params['owner'];//new owner
					}else{
						$updatedFile['owner'] = $file['owner'];//old owner
					}
					//update content
					if(!empty($params['content'])){
						$updatedFile['content'] = $params['content'];//new permissions
					}else{
						$updatedFile['content'] = $file['content'];//old permissions
					}
					//push data to array
					array_push($files,$updatedFile);//push data to array collection
				}else{
					array_push($files,$file);//push data to array colection
				}
				endforeach;
			//set session
				return $this->session->set_userdata('myfile',$files);//new session for file
			}

			//update file content
			public function editDirectory($name,$params){
				$dirs = array();
				foreach($this->session->userdata('mydir') as $dir):
					if($dir['name'] == $name){
						$updatedDir = array();
					//update nama
						if(!empty($params['name'])){
						$updateDir['name'] = $params['name'];//new name
					}else{
						$updateDir['name'] = $dir['name'];//old name
					}
					//update permission
					if(!empty($params['permissions'])){
						$updateDir['permissions'] = $params['permissions'];//new permissions
					}else{
						$updateDir['permissions'] = $dir['permissions'];//old permissions
					}
					//update creation
					$updateDir['create'] = date('dMY H:i');//new time
					//update owner
					if(!empty($params['owner'])){
						$updateDir['owner'] = $params['owner'];//new owner
					}else{
						$updateDir['owner'] = $dir['owner'];//old owner
					}
					//push data to array
					array_push($dirs,$updateDir);//push data to array collection
				}else{
					array_push($dirs,$dir);//push data to array colection
				}
				endforeach;
			//set session
				return $this->session->set_userdata('mydir',$dirs);//new session for file
			}

			//is user found on session
			public function administratorCheck($type,$param){
				$found = FALSE;
				switch ($type) {
					case 'user':
					foreach($this->session->userdata('user') as $u):
						if($u['name']==$param){$found=TRUE;}
					endforeach;
					break;
					case 'group':
					foreach($this->session->userdata('group') as $g):
						if($g['name']==$param){$found=TRUE;}
					endforeach;
					break;
				}
				return $found;
			}

		}