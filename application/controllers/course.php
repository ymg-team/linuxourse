<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('application/controllers/base.php');//load base class
class course extends base { //class for public

	public function __construct()
	{
		parent::__construct();
		//only for member
		$this->load->library('user_agent');		
		
	}
	/*
	AJAX ONLY
	*/
	public function commandArea(){
		echo '<span style="float:left">student@linux-ecourse:'.$this->session->userdata('dir').'$</span> <span style="padding-left:10px;width:50%;float:left"><input type="text" style="font-family:monospace" onkeyup="inputKeyUp(event)" id="linuxCommand" autofocus/></span>';
	}

	// index page
	public function index(){
		echo '403 Forbidden';
	}
	//review to resume course
	public function review(){
		$id = $this->uri->segment(3);//get id materi
		$id = str_replace('', '=', $id);
		$id = base64_decode(base64_decode($id));//decoding id to get id_materi
		//cek is user have started
		if(!$this->m_course->isStudentStarted($this->session->userdata['student_login']['id_user'],$id)){
			redirect(site_url('course/syllabus/'.$this->uri->segment(3)));//redirect to syllabus view
		}
		//get detail user_course data
		$detMateri = $this->m_course->detMateri($id);//detail of materi
		$data = array(
			'title'=>$detMateri['title'],//show materi title
			'materi'=>$this->m_course->detMateri($id),//show materi detail
			'level'=>$this->m_course->showLevelByMateri($id),//show level by id materi
			'recentCourseStep'=>$this->m_course->getMyRecentCourseStep($this->session->userdata['student_login']['id_user'],$id),//get recent id course
			'recentCourseId'=>$this->m_course->getMyRecentCourseId($this->session->userdata['student_login']['id_user'],$id),
			);
		$data['detuserCourse'] = $this->m_course->detUserCourseByMateriNUser($id,$this->session->userdata['student_login']['id_user']);
		$data['materibadge'] = $this->m_course->getBadgeByMateriNStudent($id,$this->session->userdata['student_login']['id_user']);
		$data['allbadge'] = $this->m_course->getBadgeByStudent($id,$this->session->userdata['student_login']['id_user']);
		//get detail course by iduser n idlevel
		$data['detCourse'] = $this->m_course->detUserCourseByMateriNUser($id,$this->session->userdata['student_login']['id_user']);//get all user course data
		$this->baseView('course/course_review',$data);
	}
	//review other student
	public function studentreview(){
		$id = $this->uri->segment(3);//get id materi
		$id = str_replace('', '=', $id);
		$id = base64_decode(base64_decode($id));//decoding id to get id_materi
		//get student id user
		$this->db->where('username',$this->uri->segment(4));
		$query = $this->db->get('user');
		$result = $query->row_array();
		$idstudent = $result['id_user'];		
		//cek is user have started
		if(!$this->m_course->isStudentStarted($idstudent,$id)){
			redirect(site_url('course/syllabus/'.$this->uri->segment(3)));//redirect to syllabus view
		}
		//get detail user_course data
		$detMateri = $this->m_course->detMateri($id);//detail of materi
		$data = array(
			'title'=>$this->uri->segment(4).' '.$detMateri['title'].' review',//show materi title
			'student'=>$this->m_user-> getDataByUsername($this->uri->segment(4)),
			'materi'=>$this->m_course->detMateri($id),//show materi detail
			'level'=>$this->m_course->showLevelByMateri($id),//show level by id materi
			'recentCourseStep'=>$this->m_course->getMyRecentCourseStep($idstudent,$id),//get recent id course
			'recentCourseId'=>$this->m_course->getMyRecentCourseId($idstudent,$id),
			);
		$data['materibadge'] = $this->m_course->getBadgeByMateriNStudent($id,$idstudent);
		$data['allbadge'] = $this->m_course->getBadgeByStudent($id,$idstudent);
		$data['detuserCourse'] = $this->m_course->detUserCourseByMateriNUser($id,$idstudent);
		//get detail course by iduser n idlevel
		$data['detCourse'] = $this->m_course->detUserCourseByMateriNUser($id,$idstudent);//get all user course data
		$this->baseView('course/student_course_review',$data);
	}
	//materi -> syllabus detail
	public function syllabus(){//show all syllabus by id_materi
		//$this->memberOnly();
		$id = $this->uri->segment(3);//get id materi
		$id = str_replace('', '=', $id);
		$id = base64_decode(base64_decode($id));//decoding id to get id_materi
		//cek is user have started
		$session = $this->session->userdata['student_login'];
		if(!empty($session)){
			if($this->m_course->isStudentStarted($this->session->userdata['student_login']['id_user'],$id)){
			redirect(site_url('course/review/'.$this->uri->segment(3)));//redirect to syllabus view
		}
	}
		$detMateri = $this->m_course->detMateri($id);//detail of materi
		$data = array(
			'title'=>$detMateri['title'],//show materi title
			'materi'=>$this->m_course->detMateri($id),//show materi detail
			'level'=>$this->m_course->showLevelByMateri($id),//show level by id materi
			);
		$data['activeUser'] = $this->m_user->countAciveUserOnCourse($data['materi']['id_materi']);//total active user
		$data['completedUser'] = $this->m_user->countCompletedUserOnCourse($data['materi']['id_materi']);//total completed user
		$this->baseView('course/course_syllabus',$data);
	}
	//start new course
	public function start(){
		//error_reporting(0);
		//set session
		$this->defaultPublicFile();//set default public file on session
		$this->defaultPublicDirectory();//set default public directory on session
		$this->defaultUmask();//set default umask
		$this->defaultSession();//set default session
		//end of set session
		//end of set default directory
		$this->memberOnly();
		$id = $this->uri->segment(3);//id_user_course
		$id = str_replace('', '=', $id);
		$id = base64_decode(base64_decode($id));
		$data['detCourse'] = $this->m_course->detUserCourse($id);//get all user course data
		$data['title'] = $data['detCourse']['leveltitle'];
		$data['script'] = '<script>$(document).ready($("body").css("background-color","#282828"));</script>';
		//recent idlevel
		$data['recentIdlevel'] = $this->m_course->courseListMenu($data['detCourse']['step'],$data['detCourse']['id_level'],$data['detCourse']['id_materi']);
		$data['courseList']=$this->m_course->courseByLevel($data['recentIdlevel']['id_level']);//show course b y id level
		//is course completed
		if(empty($data['recentIdlevel']) && empty($data['courseList'])){
			//change course status
			$data['title'] = 'Materi Completed';
			$this->db->where('id_user_course',$id);
			$this->db->update('user_course',array('status'=>'completed'));
			$data['materi'] = $this->m_course->detMateri($data['detCourse']['id_materi']);
			$this->emptyBaseView('course/complete',$data);
		}else{
			//change course status
			$this->db->where('id_user_course',$id);
			$this->db->update('user_course',array('status'=>'incomplete'));
			$this->emptyBaseView('course/start',$data);
		}
	}
	//rewind course
	public function rewind(){
		//error_reporting(0);
		//set session
		$this->defaultPublicFile();//set default public file on session
		$this->defaultPublicDirectory();//set default public directory on session
		$this->defaultUmask();//set default umask
		$this->defaultSession();//set default session
		//end of set session
		$this->memberOnly();
		$id = $this->uri->segment(3);//id_course
		$id = str_replace('', '=', $id);
		$id = base64_decode(base64_decode($id));
		$data['detCourse'] = $this->m_course->detCourseByIdCourse($id);//get all user course data
		$data['title'] = $data['detCourse']['leveltitle'];
		//recent idlevel
		$data['recentIdlevel'] = $data['detCourse']['id_level'];
		$data['courseList']=$this->m_course->courseByLevel($data['recentIdlevel']);//show course b y id level
		//get last course step

		//is course completed
		$this->emptyBaseView('course/rewind',$data);
	}

	// //course completed
	// public function completed(){
	// 	$this->emptyBaseView('course/complete',$data);
	// }
	//next step
	public function next(){
		$this->memberOnly();
		$id_user_course = $this->uri->segment(3);
		$coursestatus =  $this->session->userdata['coursestatus'];
		//decrypt id_user_course
		$id_user_course = str_replace('', '=', $id_user_course);
		$id_user_course = base64_decode(base64_decode($id_user_course));//decoding id user course
		if($coursestatus == TRUE){ //course completed
			//get detail course
			$user_course = $this->m_course->detUserCourse($id_user_course);
			$idcourse = $user_course['id_course'];
			$ste = $user_course['step'];
			$idlevel = $user_course['id_level'];
			$idmateri = $user_course['id_materi'];
			//if next step available
			$nextcourse = $this->m_course->isNextCourseAvailable($idcourse,$idlevel);
			if(!empty($nextcourse)){//next course on same level available
				//get next step + get id + update db
				$this->db->where('id_user_course',$id_user_course);
				//count timing**********
				$mytime = $user_course['finishtime'];//get json time
				if(empty($mytime)){
					$mytime = '{"'.$idcourse.'":1}';
				}
				$mytime = json_decode($mytime,true);//json to array
				$start = date_create(date('H:i:s',strtotime($this->session->userdata('start'))));
				$now = date_create(date('H:i:s'));
				$diff=date_diff($start,$now);
				$minutes = $diff->i;//get minutes
				$idcoursenow = $nextcourse['id_course'];
				$mytime[$idcoursenow] = $minutes;
				$json = json_encode($mytime);
				//end of count timing************
				$data = array('id_course'=>$nextcourse['id_course'],'finishtime'=>$json);
				$this->db->update('user_course',$data);
				//is last course on this level
				if($this->m_course->lastCourse($nextcourse['step'],$nextcourse['id_level'])){
					redirect($this->agent->referrer().'?modal=Level '.$nextcourse['level'].' Completed');//modal : succes level completed
				}else{
					//remove get parameter on url
					$link = explode('?', $this->agent->referrer());
					redirect($link[0]);
				}				
			}else{//change to next level
				// next step not available -> change level
				$nextlevel = $this->m_course->isNextLevelAvailable($idlevel,$idmateri);
				//echo $nextlevel;
				// echo 'next course no available';
				print_r($nextlevel);
				if(!empty($nextlevel)){
					echo 'this materi not completed';
					$next_idlevel = $nextlevel['id_level'];
					//get next_idcourse 
					$next_idcourse = $this->m_course->getIdCourseByLevel($nextlevel['id_level']);
					$next_idcourse = $next_idcourse['id_course'];
					//count timing**********
					$mytime = $user_course['finishtime'];//get json time
					$mytime = json_decode($mytime,true);//json to array
					$start = date_create(date('H:i:s',strtotime($this->session->userdata('start'))));
					$now = date_create(date('H:i:s'));
					$diff=date_diff($start,$now);
					$minutes = $diff->i;//get minutes
					$idcoursenow = $next_idcourse;
					$mytime[$idcoursenow] = $minutes;
					$json = json_encode($mytime);
					//end of count timing************
					//update db
					$this->db->where('id_user_course',$id_user_course);
					$data = array('id_course'=>$next_idcourse,'id_level'=>$next_idlevel,'finishtime'=>$json);
					$this->db->update('user_course',$data);
					//remove get parameter on url
					$link = explode('?', $this->agent->referrer());
					redirect($link[0]);
				}else{
					echo 'this materi is completed';
				}
			}
		}else {//course incompleted
			redirect($this->agent->referrer());//back to start course
		}
	}
	//join new course materi
	public function newcourse(){
		$this->memberOnly();
		$session = $this->session->userdata('student_login');
		if(empty($_POST['id_materi']) && $_POST['check_tnc'] == 'off'){
			redirect(site_url());
			$session = $this->session->userdata;
		} else if(empty($session)){
			redirect(site_url());
		} else{
			$iduser = $this->session->userdata['student_login']['id_user'];
			//decode id materi
			$idmateri = base64_decode(base64_decode($_POST['id_materi']));
			$idmateri = str_replace('', '', $idmateri);
			//cek is user has joined the course materi
			if($this->m_user->hasJoinedMater($iduser,$idmateri)){//student has joined
				redirect(site_url());
			} else{ //new student
				//get the smallest id level
				$sqllevel = "SELECT id_level FROM level WHERE id_materi = ? ORDER BY level ASC";
				$querylevel = $this->db->query($sqllevel,$idmateri);
				$querylevel = $querylevel->row_array();
				$idlevel = $querylevel['id_level'];
				if(empty($idlevel)){$idlevel=0;}
				//get the smallest id course 
				$sqlcourse = "SELECT id_course FROM course WHERE id_level = ? ORDER BY step ASC";
				$querycourse = $this->db->query($sqlcourse,$idlevel);
				$querycourse = $querycourse->row_array();
				$idcourse = $querycourse['id_course'];
				if(empty($idcourse)){$idcourse=1;}
				//insert to database
				$data = array(
					'id_user'=>$iduser,
					'id_materi'=>$idmateri,
					'id_level'=>$idlevel,
					'id_course'=>$idcourse,
					'startdate'=>date('Y-m-d h:i:s'),
					'lastdate'=>date('Y-m-d h:i:s'),
					'status'=>'incomplete'
					);
				if($this->db->insert('user_course',$data)){//success join new course materi
					redirect(site_url('m/dashboard?note=success started new course materi'));
				}else{
					echo 'failed join course';
				}
			}			
		}
	}
	//get history via up arrow key
	public function history(){
		$command = $_GET['command'];

	}
	
	//get certificate
public function certificate(){
	$uri = $this->uri->segment(3);
	if(empty($uri)){
		redirect('site_url');
	}else{
		//get id user course
		$iduc = $this->uri->segment(3);
			//decoding
		$iduc = str_replace('', '=', $iduc);
		$iduc = base64_decode(base64_decode($iduc));
			//get detail course
		$data = array(
			'detUserCourse'=>$this->m_course->detUserCourse($iduc),
			);	
	}
	//couting scores**************
	$green = 0;
	$red = 0;
	$times = $data['detUserCourse']['finishtime'];
	$times = json_decode($times,true);//get all times
	$courses = $this->m_course->showSyllabusByMateri($data['detUserCourse']['id_materi']);//get all courses by materi
	foreach($courses as $c){
		if($c['course_estimate'] >= $times[$c['id_course']] ){
			$green++;
		}else{
			$red++;
		}
	}
	//red == 0 :: green = 100%
	$totalstep = $this->m_course->countCourseByMateri($data['detUserCourse']['id_materi']);
	$percgreen = ($green*100)/$totalstep; //5*100 /5 = 100%
	if($percgreen>80){
		$score = 'excellent';
	}else if($percgreen <= 79 && $percgreen >49){
		$score ='good';
	}else if($percgreen <= 49 && $percgreen !=0){
		$score ='usual';
	}else{
		$score ='fail';
	}
	
	//end of couting scores***************
	
		//if level not completed or user_course not found
	if($data['detUserCourse']['status'] != 'completed' || empty($data['detUserCourse'])){
		redirect(site_url());
	}else{
		$data['signature'] = $this->m_course->signature($data['detUserCourse']['lastdate']);
		$data['score'] = $score;
		$this->load->view('course/get_certificate',$data);
		$html = $this->output->get_output();
			// Load library
		$this->load->library('dompdf_gen');
			// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('a4', 'landscape');
		$this->dompdf->render();
		$title = 'Linuxourse Certificate '.$data['detUserCourse']['materi'];
		$this->dompdf->stream($title.".pdf");//pdf file name
		}		
	}
	//get student completed materi
	public function studentCompletingMateri(){
		$limit = $_POST['limit'];
		$offset = $_POST['offset'];
		$idmateri = $_POST['idmateri'];
		$users = $this->m_course->showAllCompletedUser($idmateri,$limit,$offset);//show all user
		foreach($users as $u):
			if(empty($u['pp'])){
				$pp = base_url('assets/img/avatar.png');
			}else{
				$pp = base_url('assets/img/avatar/'.$u['pp']);
			}
			$url = site_url('student/v/'.$u['username']);
			echo '<a style="height:100px;width:100px" href="'.$url.'"><img style="margin:10px;height:50px;width:50px;border-radius:200px" src="'.$pp.'"/><span>'.$u['username'].'</span></a>';
			endforeach;
		}
	}