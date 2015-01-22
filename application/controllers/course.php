
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
		echo '<span style="float:left">student@linux-ecourse:'.$this->session->userdata('dir').'$</span> <span style="padding-left:10px;width:50%;float:left"><textarea style="font-family:monospace" onkeyup="inputKeyUp(event)" id="linuxCommand" autofocus></textarea></span>';
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
		$detMateri = $this->m_course->detMateri($id);//detail of materi
		$data = array(
			'title'=>$detMateri['title'],//show materi title
			'materi'=>$this->m_course->detMateri($id),//show materi detail
			'level'=>$this->m_course->showLevelByMateri($id),//show level by id materi
			'recentCourseStep'=>$this->m_course->getMyRecentCourseStep($this->session->userdata['student_login']['id_user'],$id),//get recent id course
			'recentCourseId'=>$this->m_course->getMyRecentCourseId($this->session->userdata['student_login']['id_user'],$id),
			);
		//get detail course by iduser n idlevel
		$data['detCourse'] = $this->m_course->detUserCourseByMateriNUser($id,$this->session->userdata['student_login']['id_user']);//get all user course data
		$this->baseView('course/course_review',$data);
	}
	//materi -> syllabus detail
	public function syllabus(){//show all syllabus by id_materi
		$this->memberOnly();
		$id = $this->uri->segment(3);//get id materi
		$id = str_replace('', '=', $id);
		$id = base64_decode(base64_decode($id));//decoding id to get id_materi
		//cek is user have started
		if($this->m_course->isStudentStarted($this->session->userdata['student_login']['id_user'],$id)){
			redirect(site_url('course/review/'.$this->uri->segment(3)));//redirect to syllabus view
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
		//set default active directoru
		$this->session->set_userdata('dir','/home/user');
		$this->session->set_userdata('command','');
		$this->memberOnly();
		$id = $this->uri->segment(3);//id_user_course
		$id = str_replace('', '=', $id);
		$id = base64_decode(base64_decode($id));
		$data['detCourse'] = $this->m_course->detUserCourse($id);//get all user course data
		$data['title'] = $data['detCourse']['leveltitle'];
		//recent idlevel
		$data['recentIdlevel'] = $this->m_course->courseListMenu($data['detCourse']['step'],$data['detCourse']['id_level'],$data['detCourse']['id_materi']);
		$data['courseList']=$this->m_course->courseByLevel($data['recentIdlevel']['id_level']);//show course b y id level
		$this->emptyBaseView('course/start',$data);
	}
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
				$data = array('id_course'=>$nextcourse['id_course']);
				$this->db->update('user_course',$data);
				redirect($this->agent->referrer());//back to start course
			}else{//change to next level
				// next step not available -> change level
				$nextlevel = $this->m_course->isNextLevelAvailable($idlevel,$idmateri);
				// echo 'next course no available';
				if(!empty($nextlevel)){
					$next_idlevel = $nextlevel['id_level'];
					//get next_idcourse 
					$next_idcourse = $this->m_course->getIdCourseByLevel($nextlevel);
					$next_idcourse = $next_idcourse['id_course'];
					//update db
					$this->db->where('id_user_course',$id_user_course);
					$data = array('id_course'=>$next_idcourse,'id_level'=>$next_idlevel);
					$this->db->update('user_course',$data);
				redirect($this->agent->referrer());//back to start course
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
		if(empty($_POST['id_materi']) && $_POST['check_tnc'] == 'off'){
			redirect(site_url());
		} else if(empty($this->session->userdata)){
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
}