<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('application/controllers/base.php');//load base class
class m extends base { //class for public

	public function __construct()
	{
		parent::__construct();
		//only for member
		$this->memberOnly();
	}
	//index is not found
	public function index(){
		echo '404';
	}

	/*dashboard page
	show recent course
	course have attended
	list of course
	*/
	public function dashboard(){
		//cek return member or not
		//if return member, start Introduce Linux Course
		$idStudent = $this->session->userdata['student_login']['id_user'];
		//check is id_course started?
		if($this->m_course->doFirstCourse($idStudent) == false){ //course is never started
			//create new course
			$this->m_course->newCourse($idStudent);
			redirect(site_url('m/dashboard'));
		}
		if(!empty($_GET['note'])){
			switch ($_GET['note']) {
				case 'loginsuccess':
					$data['script'] = '<script>$(document).ready(function(){
						$("#loginSuccess").foundation("reveal", "open");
					});</script>';
					break;
				
				default:
					# code...
					break;
			}
		}
		$data = array(
			'title'=>'Student Dashboard',
			'recentCourse'=>$this->m_course->recentCourseByUser($idStudent),
			'userCourse'=>$this->m_course->courseByUser($idStudent),
			);
		// count percentation course
		$totalnow = $this->m_course->countCourseStep($data['recentCourse']['id_course'],$data['recentCourse']['id_level']);
		$totalCourse = $this->m_course->countCourseByLevel($data['recentCourse']['id_level']);
		$data['percentage'] = number_format(($totalnow*100)/$totalCourse);
		$data['recentCompletion'] = $this->m_course->showLevelCompletion($data['recentCourse']['id_materi'],$data['recentCourse']['id_level']);
		$this->baseView('m/dashboard',$data);
	}
	//edit profile
	public function edit(){
		$this->load->library('form_validation');
		if(!empty($_POST)){//if do update profile
			$data['title'] = 'processing...';
		} else {
			$data['title'] = 'Edit Profile';
			$data['profile'] = $this->session->userdata['student_login'];
			$this->baseView('m/editprofile',$data);
		}
	}
	//logout
	public function logout(){
		$this->session->sess_destroy();
		redirect(site_url('p/logout'));
	}

}