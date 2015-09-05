<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('application/controllers/base.php');//load base class
class CourseAPI extends base { //class for public

	public function __construct()
	{
		parent::__construct();
		//only for member
		$this->load->library('user_agent');
		$this->load->model('m_test');
	}
	//get courselist
	public function getCourse()
	{
		$type = $this->uri->segment(3);
		$idStudent = $this->session->userdata['student_login']['id_user'];
		$results = array();
		switch ($type) {
			//ON PROGRESS || COMPLETED COURSE
			case 'incomplete' || 'completed':
			$userCourse = $this->m_course->courseByUser($idStudent);
			// print_r($userCourse);
			foreach($userCourse as $uc):
				if($uc['status']==$type):
					$listTotalnow = $this->m_course->countCourseStepByMateri($uc['id_materi'],$uc['id_level'],$uc['id_course']);
					$listTotalCourse = $this->m_course->countCourseByMateri($uc['id_materi']);
					$listRecentPercentage = number_format(($listTotalnow*100/$listTotalCourse),1);
					$id = base64_encode(base64_encode($uc['id_materi']));
					$id = str_replace('=', '', $id);
					//last course
					$today = date_create(date('Y-m-d'));
					$last = date_create(date('Y-m-d', strtotime($uc['lastdate'])));
					$diff=date_diff($last,$today);
					if($diff->y != 0){
						$log = $diff->y.' Years ago';
					}else if($diff->m != 0){
						$log = $diff->m.' Months ago';
					}else if($diff->d != 0){
						$log = $diff->d.' Days ago';
					}else{
						$log = 'today';
					}
					//setup results
					$materi = array(
						'idmateri'=>$uc['id_materi'],
						'encidmateri'=>$id,
						'title'=>$uc['title'],
						'percentage'=>$listRecentPercentage,
						'log'=>$log
					);
					array_push($results,$materi);
				endif;
			endforeach;
			break;

			case 'mytest':

			break;
		}
		// print_r($results);
		echo json_encode($results);
	}
	//UNIQUE LIST CHECKER
	public function checkUniqueLink()
	{
		$link=$_GET['q'];
		$this->db->like('testUniqueLink',$link);
		$query = $this->db->get('test');
		if($query->num_rows()>0){echo 'true';}//is exist
		else{echo 'false';}//ready to use
	}
	//NEW TEST
	public function newTest()
	{
		$data = file_get_contents("php://input");
		$data = json_decode($data,true);
		//get id user
		$iduser = $this->session->userdata['student_login']['id_user'];
		$data['id_user']=$iduser;
		$data['testUniqueLink'] = str_replace(' ','-',$data['testUniqueLink']);
		$data['testCreated']= date('Y-m-d H:i:s');
		$data['testUpdated']=date('Y-m-d H:i:s');
		// print_r($data);
		// insert to database
		$this->db->insert('test',$data);
	}
	//UPDATE TEST
	public function updateTest()
	{
		$data = file_get_contents("php://input");
		$data = json_decode($data,true);
		$data = $data['test'];
		$idtest = $data['idTest'];
		$data['testUpdated'] = date('Y-m-d H:i:s');
		unset($data['idTest']);
		$this->db->where('idTest',$idtest);
		return $this->db->update('test',$data);
	}
	//GET MY TEST
	public function getMyTest()
	{
		$data = file_get_contents("php://input");
		$data = json_decode($data);
		$status = $data->status;
		$results = array();
		$iduser = $this->session->userdata['student_login']['id_user'];
		$test = $this->m_test->myTest($iduser,$status)->result_array();
		$json = json_encode($test);
		echo $json;
	}
	//TEST DETAIL
	public function detailTest()
	{

		$data = file_get_contents("php://input");
		$data = json_decode($data);
		$idtest = $data->idtest;
		$result = $this->m_test->detailTest($idtest);
		echo json_encode($result);
	}
	//STEP DETAIL
	public function detailStep()
	{
		$data = file_get_contents("php://input");
		$data = json_decode($data);
		$idtest = $data->idtest;
		$step = $data->step;
		$this->db->where('idTest',$idtest);
		$this->db->where('testCaseStep',$step);
		$result = $this->db->get('testCase')->row_array();
		echo json_encode($result);
	}
	//NEW STEP ACTION
	public function newStepTest()
	{

		$data = file_get_contents("php://input");
		$data = json_decode($data,true);
		$idtest = $data['idtest'];
		$step = $data['newstep'];
		$step['idTest'] = $idtest;
		$step['addTestCase'] = date('Y-m-d H:i:s');
		$step['updatedTestCase'] = date('Y-m-d H:i:s');
		return $this->db->insert('testCase',$step);
	}
	//TEST CASE LIST
	public function getCase()
	{

		$data = file_get_contents("php://input");
		$data = json_decode($data);
		$idtest = $data->idtest;
		$this->db->where('idTest',$idtest);
		$this->db->order_by('testCaseStep','ASC');
		if(!empty($_GET['act'])):
			switch ($_GET['act']) {
				case 'latest':
				$laststep = $data->laststep;
				$this->db->where('testCaseStep >',$laststep);
				break;

				default:
				# code...
				break;
			}
			$results = $this->db->get('testCase')->row_array();
		else:
			$results = $this->db->get('testCase')->result_array();
		endif;
		echo json_encode($results);
	}
	//UPDATE CASE
	public function updateCase()
	{
		$data = file_get_contents("php://input");
		$data = json_decode($data,true);
		$case = $data['case'];
		$case['updatedTestCase'] = date('Y-m-d H:i:s');
		//remove primary key
		$this->db->where('idTestCase',$case['idTestCase']);
		unset($case['idTestCase']);
		return $this->db->update('testCase',$case);
	}
	//DELETE CASE
	public function deleteCase()
	{
		$data = file_get_contents("php://input");
		$data = json_decode($data);
		$idcase = $data->idcase;
		$this->db->where('idTestCase',$idcase);
		return $this->db->delete('testCase');
	}
	//CHECK TEST STEP BY ID TEST
	public function checkStep()
	{

		$data = file_get_contents("php://input");
		$data = json_decode($data);
		$idtest = $data->idtest;
		$step = $data->step;
		$this->db->where('idTest',$idtest);
		$this->db->where('testCaseStep',$step);
		$query = $this->db->get('testCase');
		if($query->num_rows()>0){echo 'true';}//step is exist
		else{echo 'false';}//step ready to use
	}
	/*****************************************/
	//TEST
	/*****************************************/
	public function submitTest()
	{
		$data = file_get_contents("php://input");
		$data = json_decode($data);
		$iduser = $this->session->userdata['student_login']['id_user'];
		$idtest = $data->idtest;
		//add end test date
		$this->db->where('idTest',$idtest);
		$this->db->where('id_user',$iduser);
		return $this->db->update('doTest',array('endDoTest'=>date('Y-m-d H:i:s')));
	}
	/*****************************************/
	//PARTICIPANT
	/*****************************************/
	//show test participant
	public function getParticipant()
	{
		$data = file_get_contents("php://input");
		$data = json_decode($data);
		$idtest = $data->idtest;
		$status = $data->status;//waiting - ready - finished participants
		switch ($status) {
			case 'waiting':
				$this->db->where('doTest.startDoTest','0000-00-00 00:00:00');
				break;
			case 'ongoing':
				$this->db->where('doTest.startDoTest <>','0000-00-00 00:00:00');
				break;
			case 'completed':
				$this->db->order_by('doTest.doTestScore','DESC');
				$this->db->where('doTest.startDoTest <>','0000-00-00 00:00:00');
				$this->db->where('doTest.endDoTest <>','0000-00-00 00:00:00');
				break;
			}
			$this->db->join('user','user.id_user = doTest.id_user');
			$this->db->where('doTest.idTest',$idtest);
			$results = $this->db->get('doTest')->result_array();
			$json = array();
			foreach($results as $r):
				if(empty($r['pp'])):
					$r['pp'] = base_url('assets/img/avatar.png');
				else:
					$r['pp'] = base_url('assets/img/avatar/'.$r['pp']);
				endif;
				array_push($json,$r);
			endforeach;
			//return as echo json
			echo json_encode($json);
	}
	//search member
	public function searchMember()
	{
		$data = file_get_contents("php://input");
		$data = json_decode($data);
		$idtest = $data->idtest;
		$key = $data->key;
		// $this->db->where('doTest.idTest <>',$idtest);
		$this->db->like('user.username',$key);
		// $this->db->join('doTest','doTest.id_user = user.id_user','left');
		$this->db->from('user');
		$results = $this->db->get()->result_array();
		$json = array();
		foreach($results as $r):
				if(empty($r['pp'])):
					$r['pp'] = base_url('assets/img/avatar.png');
				else:
					$r['pp'] = base_url('assets/img/avatar/'.$r['pp']);
				endif;
				array_push($json,$r);
			endforeach;
		echo json_encode($json);
	}
	//add participant
	public function addParticipant()
	{
		$data = file_get_contents("php://input");
		$data = json_decode($data);
		$idtest = $data->idtest;
		$iduser = $data->iduser;
		//is exist
		$this->db->where('idTest',$idtest);
		$this->db->where('id_user',$iduser);
		$querystatus = $this->db->get('doTest');
		if($querystatus->num_rows()>0){
			echo "Alert\nYou Have Added This User";
		}else{
			//add user to database
			$data = array(
				'idDoTest'=>$iduser.'-'.$idtest,
				'id_user'=>$iduser,
				'idTest'=>$idtest,
				'startDoTest'=>'0000-00-00 00:00:00',
				'endDoTest'=>'0000-00-00 00:00:00',
				'doTestAs'=>'participant',
				'doTestResult'=>''
			);
			$this->db->insert('doTest',$data);
			echo "Success\nSending Test Invitation";
		}
	}
	//get test results
	public function testResult()
	{
		$data = file_get_contents("php://input");
		$data = json_decode($data);
		$iduser = $data->iduser;
		$idtest = $data->idtest;
		//user and do test data
		$this->db->join('user','user.id_user = doTest.id_user');//do join
		$result = $this->db->get_where('doTest',
		array('doTest.id_user'=>$iduser,'idTest'=>$idtest))->row_array(); //get the results
		//generate json result
		//status do test
		if($result['startDoTest'] == '0000-00-00 00:00:00' AND $result['endDoTest'] == '0000-00-00 00:00:00')
		{
			$result['statusStart'] = 'waiting for approval';
		}else if($result['startDoTest'] != '0000-00-00 00:00:00' AND $result['endDoTest'] != '0000-00-00 00:00:00')
		{
			$result['statusStart'] = 'ongoing';
		}else{
			$result['statusStart'] = 'test is completed';
		}
		echo json_encode($result);
	}
	//get specifik test results
	public function specificTestResults()
	{
		$data = file_get_contents("php://input");
		$data = json_decode($data);
		$iduser = $data->iduser;
		$idtest = $data->idtest;
	}
	/*****************************************/
	//REGEX
	/*****************************************/
	public function saveStep()
	{
		$data = file_get_contents("php://input");
		$data = json_decode($data);
		$commands = $data->commands;
		$iduser = $this->session->userdata['student_login']['id_user'];
		$idtest = $data->idtest;
		$step = $data->step;
		$iddotest = $iduser.'-'.$idtest;
		//get step detail
		$casedetail = $this->m_test->getCase($idtest,$step)->row_array();
		$casecommand = trim($casedetail['command']);
		$casecommand = explode(':',$casecommand);//case commands as array
		$totalcasecommand = count($casecommand);//total case commands
		$totalcorrectanswer = 0;
		//get real commands
		preg_match_all('#\$(.*):#Us', $commands,$purecommands,PREG_SET_ORDER);
		//get total correct answer
		foreach($purecommands as $pc):
			$command = trim(strip_tags($pc[1]));
			if(in_array($command,$casecommand)):
				$totalcorrectanswer = $totalcorrectanswer + 1;
			endif;
		endforeach;
		// echo $totalcorrectanswer;
		//answer presentation
		$presentationcorrect = ($totalcorrectanswer*100) / $totalcasecommand;
		//database session modification
		$databasesession = $this->m_test->getDatabaseSession($iduser,$idtest);
		$resultdata = $databasesession['doTestResult'];
		//update result data
		$this->updateDoTestResult($iddotest,$resultdata,$step,$presentationcorrect,0);//[WORKED]
	}
	//update do test result data
	public function updateDoTestResult($iddotest,$resultdata,$step,$presentationcorrect,$totaltime)
	{
		$resultupdate = array();
		$resultdata = json_decode($resultdata,true);
		$resultdata[$step]['correct'] = $presentationcorrect;
		$resultdata[$step]['time'] = $totaltime;
		$resultupdatejson = json_encode($resultdata);
		//update database
		$this->db->where('idDotest',$iddotest);
		return $this->db->update('doTest',array('doTestResult'=>$resultupdatejson));
	}
	/*****************************************/
	//NOTIFICATION
	/*****************************************/
	public function countNotification()
	{
		$data = file_get_contents("php://input");
		$data = json_decode($data);
		$type = $data->type;
		switch ($type) {
			case 'invitation'://test invitation
			$iduser = $this->session->userdata['student_login']['id_user'];
			$this->db->where('id_user',$iduser);
			$this->db->where('startDotest','0000-00-00 00:00:00');
			$query = $this->db->get('doTest');
			$total = $query->num_rows();
			break;

			default:
			$total = 0;
			break;
		}
		echo $total;
	}
	//get notification
	public function getInvitation()
	{
		$data = file_get_contents("php://input");
		$data = json_decode($data);
		$type = $data->type;
		switch ($type) {
			case 'invitation'://test invitation
			$iduser = $this->session->userdata['student_login']['id_user'];
			$this->db->where('doTest.id_user',$iduser);
			$this->db->where('doTest.startDoTest','0000-00-00 00:00:00');
			$this->db->join('test','doTest.idTest = test.idTest');
			$this->db->order_by('test.idTest','DESC');
			$query = $this->db->get('doTest')->result_array();
			$json = json_encode($query);
			break;
			default:
			$json = [];
			break;
		}
		echo $json;
	}
	//action test invitation
	public function actionTestInvitation()
	{
		$data = file_get_contents("php://input");
		$data = json_decode($data);
		$action = $data->action;
		$idtest = $data->idtest;
		switch ($action) {
			case 'start':
				return true;
				break;
			case 'exit':
				$iduser = $this->session->userdata['student_login']['id_user'];
				$this->db->where('id_user',$iduser);
				$this->db->where('idTest',$idtest);
				return $this->db->delete('doTest');
				break;
		}
	}
}
