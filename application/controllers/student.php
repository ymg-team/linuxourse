<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('application/controllers/base.php');//load base class
class student extends base { //class for public

	public function __construct()
	{
		parent::__construct();
		//only for member
		
	}
	//index url
	public function v(){
		$username =  $this->uri->segment(3);
		$data = array(
			'student'=>$this->m_user-> getDataByUsername($username),
			'userCourse'=>$this->m_course->courseByUsername($username),
			);
		$data['title'] = $data['student']['fullname'];
		$this->baseView('p/student',$data);
	}
	//students has completed materi
	public function completedmateri(){
		$limit=$_GET['limit'];
		$offset=$_GET['offset'];
	}
}