
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('application/controllers/base.php');//load base class
class course extends base { //class for public

	public function __construct()
	{
		parent::__construct();
		//only for member
		$this->memberOnly();
	}

	// index page
	public function index(){
		if(!empty($_GET['id'])){
			$idCourse = $_GET['id'];
		}else{
			echo '404';
		}	
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
			);
		$this->baseView('course/course_review',$data);
	}
	//materi -> syllabus detail
	public function syllabus(){//show all syllabus by id_materi
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
		$this->baseView('course/course_syllabus',$data);
	}
	//start new course
	public function start(){
		$id = $this->uri->segment(3);//id_user_course
		$data = array(
			'title'=>'Course',
			);
		$this->emptyBaseView('course/start',$data);
	}
}