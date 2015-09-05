<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('application/controllers/base.php');//load base class
class test extends base { //class for public

	public function __construct()
	{
		parent::__construct();
		//only for member
		$this->load->library('user_agent');
		$this->load->model(array('m_test'));
	}
	//join test
	public function join()
	{
		$idtest = $this->uri->segment(3);
		$iduser = $this->session->userdata['student_login']['id_user'];
		$dotest = $this->m_test->getDatabaseSession($iduser,$idtest);
		$test = $this->m_test->detailTest($idtest);
		if($dotest['startDoTest'] == '0000-00-00 00:00:00')//never start test
		{
			$data = array(
				'title'=>'Join Test',
				'test'=>$test,
				'dotest'=>$dotest
				);
			$this->baseView('test/join',$data);
		}else
		{
			redirect('test/start/'.$idtest);
		}
	}
	//close test
	public function close()
	{
		$idtest = $this->uri->segment(3);
		$iduser = $this->session->userdata['student_login']['id_user'];
		$test = $this->m_test->detailTest($idtest);
		$dotest = $this->m_test->getDatabaseSession($iduser,$idtest);
		$finishingtest = $this->m_test->finishingTest($idtest,$iduser);
		if(!empty($test) AND $finishingtest):
		$data = array(
			'title'=>'Close Test',
			'test'=>$test,
			'dotest'=>$dotest
			);
		$this->baseView('test/close',$data);
		else:
			echo "you haven't (join/completed) this test or/ test is not exist";
		endif;
	}
	//start test
	public function start()
	{
		//is owner
		$idtest = $this->uri->segment(3);
		$iduser = $this->session->userdata['student_login']['id_user'];
		$finishingtest = $this->m_test->finishingTest($idtest,$iduser);
		if($finishingtest)redirect(site_url('test/close/'.$idtest));//only 1 time to join test
		$test = $this->m_test->detailTest($idtest);//get test detail
		$mytest = $this->m_test->isMyTest($iduser,$idtest);
		$case = $this->m_test->getCase($idtest);
		$data = array
		(
			'title'=>'Test Preview',
			'test'=>$test,
			'case'=>$case->result_array(),
			'casetotal'=>$case->row_array()
			);
		//create session on database
		$this->m_test->insertDoTest($iduser,$idtest);
		$this->baseView('test/start',$data);
	}
}
