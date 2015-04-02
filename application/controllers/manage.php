<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('application/controllers/base.php');//load base class
class manage extends base { //class for public
	//konstruktor
	public function __construct()
	{
		parent::__construct();
		//only for member
		$this->load->model('m_admin');
		$this->load->model('m_course');
	}

	public function index(){//login view
		$this->load->library('form_validation');
		//if logged in
		if(!empty($this->session->userdata['manage_login'])){
			redirect(site_url('manage/dashboard'));
		}
		if(!empty($_POST)){//do login
		//start login process			
		//set rules
		$this->form_validation->set_rules('input_username', 'Username', 'required|trim|callback_validate_credentials');//is required
		$this->form_validation->set_rules('input_password', 'Password', 'required|trim');//is required email
		//validation check
		if($this->form_validation->run()){//if validation is true
			//redirect to login page
			$username = $_POST['input_username'];
			$password = md5(md5($_POST['input_password']));
			//get all user data
			$userdata = $this->m_admin->can_login($username,$password);
			//cek data ditemukan
			if(!empty($userdata)){
				$loginuser['id_user'] = $userdata['id_user_manage'];
				$loginuser['username'] = $userdata['username'];
				$loginuser['email'] = $userdata['email'];
				$loginuser['fullname'] = $userdata['fullname'];
				$loginuser['register_date'] = $userdata['registerdate'];
				$loginuser['register_date'] = $userdata['loginlog'];
				$loginuser['password'] = $userdata['password'];
				$loginuser['level'] = $userdata['level'];
				$loginuser['status'] = $userdata['status'];
				$loginuser['pp'] = $userdata['pp'];
				$loginuser['is_login'] = 1;
				$sessiondata['manage_login'] = $loginuser;
				$sessiondata['command'] = array();//for course
				//set session
				$this->session->set_userdata($sessiondata);
				$this->session->set_userdata('dir','/home/user');
				if($this->session->userdata['manage_login']['status'] == 'active'){ //jika statusnya aktif
					$this->db->where('id_user_manage',$userdata['id_user_manage']);
					$data = array('loginlog'=>$userdata['loginlog'].'|'.date('Y-m-d h:i:s'));
					$this->db->update('user_manage',$data);//update login terakhir
					redirect(site_url('manage'));					
				} else { //jika statusnya banned
					echo 'gagal memasukan session';
				}
			}else{ //username n password not matched
				$data['title'] = 'login failed';
				$this->baseManageView('manage/login',$data);
			}
			
			} else { //if validation is false
				$data['title'] = 'login failed';
				$this->baseManageView('manage/login',$data);
			}
				//end of login process
		}else{
			$data = array(
				'title'=>'Manage'
				);
			$this->baseManageView('manage/login',$data);	
		}		
	}
//validate login
//login validation
	public function validate_credentials(){
		$username = $this->input->post('input_username');
		$password = md5(md5($this->input->post('input_password')));
		//cek apakah tersedia di database
		if($this->m_admin->can_login($username,$password)){
			return true;
		}else{
			$this->form_validation->set_message('validate_credentials','username and password not match');
			return false;
		}
	}

//show dashboard after login
	public function dashboard(){
		$this->adminOnly();
		$data=array(
			'title'=>'Manage Title',
			'totallevel'=>$this->m_course->statscount('level'),//total level
			'totalcourse'=>$this->m_course->statscount('course'),//total course
			'totallevelintro'=>$this->m_course->statscount('level',1),//total level introduce linux
			'totalcourseintro'=>$this->m_course->statscount('course',1),//total course introduce linux
			'totallevelshell'=>$this->m_course->statscount('level',2),//total level linux shell
			'totalcourseshell'=>$this->m_course->statscount('course',2),//total course linux shell
			'totalstudents'=>$this->m_user->stats(),//total student
			'totalgoingintro'=>$this->m_user->stats(1,'incomplete'),//total student ongoing in introduce linux
			'totalcompleteintro'=>$this->m_user->stats(1,'completed'),//total student completed in introduce linux
			'totalgoingshell'=>$this->m_user->stats(2,'incomplete'),//total student ongoing in linux shell
			'totalcompleteshell'=>$this->m_user->stats(2,'completed'),//total student completed in linux shell
			);	
		$this->baseManageView('manage/dashboard',$data);
	}

////////////////////
// COURSE MANAGEMENT
////////////////////
//delete course
	public function deletecourse(){
		$this->adminOnly();
		$id = $this->uri->segment(3);
		$this->db->where('id_course',$id);
		$this->db->delete('course');
		redirect('manage/course');
	}
//add new course
	public function addcourse(){
		$this->adminOnly();
		if(!empty($_POST)){
		// echo '<pre>';
		// print_r($_POST);
		// echo '</pre>';
		//course data
			$title = $_POST['input_title'];
			$step = $_POST['input_step'];
			$description = $_POST['input_description'];
			$level = $_POST['input_level'];
			$estimate = $_POST['input_estimate'];
			$case_en = $_POST['input_caseen'];
			$case_id = $_POST['input_caseid'];
			$hint_en = $_POST['input_hinten'];
			$hint_id = $_POST['input_hintid'];
			$command = $_POST['input_command'];
			$controller = $_POST['input_controller'];
		if(isset($_POST['btnpost'])){//publish
			$status = 'posted';
			$redirect = site_url('manage/course?success=success add case');
		}else if(isset($_POST['btndraft'])){//draft
			$status = 'draft';
			$redirect = site_url('manage/editcourse');
		}else{
			echo 'no action button set';
		}
		//insert to database
		$data = array(
			'id_level'=>$level,
			'step'=>$step,
			'title'=>$title,
			'description'=>$description,
			'estimate'=>$estimate,
			'course_case_en'=>$case_en,
			'course_case_id'=>$case_id,
			'hint_en'=>$hint_en,
			'hint_id'=>$hint_id,
			'command'=>$command,
			'custom_controller'=>$controller,
			'status'=>$status,
			'editdate'=>date('Y-m-d h:i:s'),
			);
		if($this->db->insert('course',$data)){
			redirect($redirect);
		}else{//error insert db
			echo 'error insert database';
		}
	}	
	//get id materi
	$idmateri = $this->uri->segment(3);
	$materi = $this->m_course->detMateri($idmateri);
	$data = array(		
		'totalstep' =>'',
		'title' => 'Add Course Case : '.$materi['title'],
		'script'=>'<script>function addForm(){$("#form-add").toggle("fast");}</script>',
		'viewMateri'=>$this->m_admin->showAllMateri(10,0),
		'level'=>$this->m_course->showAllLevelByIdMateri($idmateri),
		'case'=>$this->m_course->getCourseByMateri($idmateri),
		);
	$this->baseManageView('manage/addcourse',$data);
	
}
//edit course
public function editcourse(){
	$this->adminOnly();
	//if submiting post
	if(!empty($_POST)){
		$idcourse = $_POST['input_idcourse'];
		$title = $_POST['input_title'];
		$step = $_POST['input_step'];
		$description = $_POST['input_description'];
		$level = $_POST['input_level'];
		$estimate = $_POST['input_estimate'];
		$case_en = $_POST['input_caseen'];
		$case_id = $_POST['input_caseid'];
		$hint_en = $_POST['input_hinten'];
		$hint_id = $_POST['input_hintid'];
		$command = $_POST['input_command'];
		$controller = $_POST['input_controller'];
		if(isset($_POST['btnpost'])){//publish
			$status = 'posted';
			$redirect = site_url('manage/course?success=success edit case');
		}else if(isset($_POST['btndraft'])){//draft
			$status = 'draft';
			$redirect = site_url('manage/editcourse');
		}else{
			echo 'no action button set';
		}
		//insert to database
		$this->db->where('id_course',$idcourse);
		$data = array(
			'id_level'=>$level,
			'step'=>$step,
			'title'=>$title,
			'description'=>$description,
			'estimate'=>$estimate,
			'course_case_en'=>$case_en,
			'course_case_id'=>$case_id,
			'hint_en'=>$hint_en,
			'hint_id'=>$hint_id,
			'command'=>$command,
			'custom_controller'=>$controller,
			'status'=>$status,
			'editdate'=>date('Y-m-d h:i:s'),
			);
		if($this->db->update('course',$data)){
			redirect($this->agent->referrer());
		}else{//error insert db
			echo 'error insert database';
		}
	}
	$urisegment = $this->uri->segment(3); 
	if(empty($urisegment)){
			//get lattest edited idcourse
		$idcourse = $this->m_course->lastEditCourse();
	}else{
		$idcourse = $this->uri->segment(3);
	}
	$data = array(
		'idcourse'=>$idcourse,
		'title' => 'Edit Course Case',
		'script'=>'<script>$(document).ready(function(){$("#course").addClass("active");}function addForm(){$("#form-add").toggle("fast");}</script>',
			'viewMateri'=>$this->m_admin->showAllMateri(10,0),
			'editcase'=>$this->m_course->getCourseByIdCourse($idcourse),
			);
	$data['level'] = $this->m_course->showAllLevelByIdMateri($data['editcase']['id_materi']);
	$data['case']= $this->m_course->getCourseByMateri($data['editcase']['id_materi']);
	$this->baseManageView('manage/editcourse',$data);
}
//delete course

//manage materi-level-course
public function course(){
	$this->adminOnly();
	//if using get post to search, redirect to uri segment
	if(!empty($_GET['q'])){
		redirect(site_url('manage/course/search/'.$_GET['q']));
	} else {
		//start public pagination setup
		$config = array(
			'per_page'=>13,
			'uri_segment'=>4,
			'num_link'=>7,
			);
		//end of public pagination setup
		$urisegment = $this->uri->segment(3);
		if(!empty($urisegment) AND !is_numeric($urisegment)){//filtering via uri segement 3
			switch ($this->uri->segment(3)) {
				case 'active':
				break;
				case 'draft':
					# code...
				break;
				case 'search':
				$keyword = $this->uri->segment(4);
				$config['uri_segment']=5;
				$config['total_rows']=$this->m_admin->countSearchCourse($keyword);
				$config['base_url']=site_url('manage/course');//get lattest location]
				$uri = $this->uri->segment(5);
				if(!$uri){
					$uri = 0;
				}
				//end of pagination setup
				$data = array(
					'title'=>'All Course',
					'total'=>$config['total_rows'],
					'script'=>'<script>$(document).ready(function(){$("#course").addClass("active");$("#course-all").addClass("active");});function addForm(){$("#form-add").toggle("fast");}</script>',
					'view'=>$this->m_admin->searchCourse($keyword,$config['per_page'],$uri),//return all course data
					);
				break;
				default:
				
				break;
			}
		}else{//default view
			//pagination setup
			$config['uri_segment']=3;
			$config['total_rows']=$this->m_admin->countShowAllCourse();
			$config['base_url']=site_url('manage/course');//get lattest location]
			$uri = $this->uri->segment(3);
			if(!$uri){
				$uri = 0;
			}
			//end of pagination setup
			$data = array(
				'title'=>'All Course',
				'total'=>$config['total_rows'],
				'script'=>'<script>$(document).ready(function(){$("#course").addClass("active");$("#course-all").addClass("active");});function addForm(){$("#form-add").toggle("fast");}</script>',
				'view'=>$this->m_admin->showAllCourse($config['per_page'],$uri),//return all course data
				);
		}
		//$this->load->library('pagination');
		$this->pagination->initialize($config);
		$data['link'] = $this->pagination->create_links();
		$data['viewMateri'] =$this->m_admin->showAllMateri(10,0);
		$this->baseManageView('manage/course',$data);		
	}
}
//get course by materi
public function courseByMateri(){
	$this->adminOnly();
	//pagination setup
	$config = array(
		'per_page'=>13,
		'uri_segment'=>4,
		'num_link'=>7,
		'total_rows'=>$this->m_admin->countCourseByMateri($this->uri->segment(3)),
		'base_url'=>site_url('manage/courseByMateri/'.$this->uri->segment(3)),
		);
	$uri = $this->uri->segment(4);
	if(!$uri){
		$uri = 0;
	}
	//end of pagination setup
	$data = array(
		'title'=>'Course By Materi',
		'total'=>$config['total_rows'],
		'script'=>'<script>$(document).ready(function(){$("#course").addClass("active");$("#listMateri").show();$("#course-bymateri").addClass("active");$("#by-materi-'.$this->uri->segment(3).'").addClass("active");});function addForm(){$("#form-add").toggle("fast");}</script>',
		'view'=>$this->m_admin->showAllCourseByMateri($config['per_page'],$uri,$this->uri->segment(3)),//show course by materi
		);
	$this->pagination->initialize($config);
	$data['link'] = $this->pagination->create_links();
	$data['viewMateri'] =$this->m_admin->showAllMateri(10,0);
	$this->baseManageView('manage/course',$data);
}
//check available step
public function ajaxAvailableStep(){
	$this->adminOnly();
	$idmateri = $this->uri->segment(3);
	$step = $this->uri->segment(4);
	$params = array($idmateri,$step);
	$sql = "SELECT step FROM course INNER JOIN level ON level.id_level=course.id_level INNER JOIN materi ON materi.id_materi = level.id_materi
	WHERE materi.id_materi = ? AND course.step = ?";
	$query = $this->db->query($sql,$params);
	if($query->num_rows()>0){
		echo '<strong style="color:red">Step is not available</strong>';
	}else{
		echo '<strong style="color:green">Step available</strong>';
	}
}
//////////////
//manage level
//////////////
public function level(){
	$this->adminOnly();
	//using form
	if(isset($_GET['q'])){
		redirect(site_url('manage/level/search/'.$_GET['q']));
	}
	if(!empty($_POST)){
		if(isset($_POST['btnadd'])){//new level
			$idmateri = $_POST['input_materi'];
			$title = $_POST['input_title'];
			$level = $_POST['input_level'];
			$description = $_POST['input_description'];
			$data = array(
				'id_materi'=>$idmateri,
				'title'=>$title,
				'level'=>$level,
				'description'=>$description,
				);
			//insert to db
			if($this->db->insert('level',$data)){
				redirect(site_url('manage/level/bymateri/'.$idmateri));
			}else{
				echo 'failed insert to database';
			}
		}else if(isset($_POST['btnsave'])){//update level
			$idlevel = $this->uri->segment(4);
			$idmateri = $_POST['input_materi'];
			$level = $_POST['input_level'];
			$title = $_POST['input_title'];
			$description = $_POST['input_description'];
			$this->db->where('id_level',$idlevel);
			$data = array(
				'title'=>$title,
				'level'=>$level,
				'id_materi'=>$idmateri,
				'description'=>$description,
				);
			if($this->db->update('level',$data)){
				redirect(site_url('manage/level/bymateri/'.$idmateri));
			}else{
				echo 'problem update level';
			}
		}
	}
	//start pagination
	$config = array(
		'per_page'=>13,
		'uri_segment'=>3,
		'num_link'=>7,
		);
	//suspend pagination
	$urisegment = $this->uri->segment(3); 
	if(!empty($urisegment)){
		switch ($urisegment) {
			case 'search':
			$keyword = $this->uri->segment(4);
			$data = array(
				'title'=>'Search Level',
				'total'=>'',
				'link'=>'',
				'viewMateri'=>$this->m_admin->showAllMateri(10,0),
				'script'=>'<script>$(document).ready(function(){$("#level").addClass("active")});</script>',
				'view'=>$this->m_admin->searchLevel($keyword),
				);
			$this->baseManageView('manage/level',$data);
			break;
			case 'bymateri':
			$idmateri = $this->uri->segment(4);
			$data = array(
				'title'=>'Level',
				'total'=>$this->m_admin-> countLevelByMateri($idmateri),
				'viewMateri'=>$this->m_admin->showAllMateri(10,0),
				'link'=>'',
				'script'=>'<script>$(document).ready(function(){$("#by-materi-'.$idmateri.'").addClass("active");$("#level").addClass("active");$("#level-bymateri").addClass("active");$("#listMateri").show();});function addForm(){$("#form-add").toggle("fast");}</script>',
				'view'=>$this->m_admin->showLevelByMateri($idmateri),
				);
			$this->baseManageView('manage/level',$data);
			break;
			case 'editlevel':
			$idlevel = $this->uri->segment(4);
			$data = array(
				'title'=>'Edit Level',
				'viewMateri'=>$this->m_admin->showAllMateri(10,0),
				'script'=>'<script>$(document).ready(function(){$("#level").addClass("active")});</script>',
				'view'=>$this->m_admin->detailLevel($idlevel),
				);
			$this->baseManageView('manage/editlevel',$data);
			break;
			default:

			echo 'something wrong';
			break;
		}
	}else{//show all course
		//resume pagination
		$uri = $this->uri->segment(3);
		if(!$uri){
			$uri = 0;
		}
		$config['total_rows'] = $this->m_admin->countShowAllLevel();
		$config['base_url'] = site_url('manage/level');
		$this->pagination->initialize($config);
		//end of pagination setup
		$data = array(
			'title'=>'Level',
			'total'=>$config['total_rows'],
			'viewMateri'=>$this->m_admin->showAllMateri(10,0),
			'script'=>'<script>$(document).ready(function(){$("#level").addClass("active");$("#level-all").addClass("active");});function addForm(){$("#form-add").toggle("fast");}</script>',
			'link'=>$this->pagination->create_links(),
			'view'=>$this->m_admin->showAllLevel($config['per_page'],$uri),//show all level
			);
		//view
		$this->baseManageView('manage/level',$data);
	}
}
//show level by materi
public function levelbymateri(){
	$this->adminOnly();
}
//delete level
public function deleteLevel(){//delete a level
	$this->adminOnly();
	$idlevel = $this->uri->segment(3);
	$this->db->where('id_level',$idlevel);
	$this->db->delete('level');
	redirect('manage/level');
}
//review level
public function reviewLevel(){
	$this->adminOnly();
	$idmateri = $this->uri->segment(3);
	$sql = "SELECT level.level, level.title AS 'title',materi.title AS 'materi',level.id_level 
	FROM level INNER JOIN materi ON materi.id_materi = level.id_materi
	WHERE materi.id_materi = ?
	ORDER BY materi.id_materi ASC";
	$query =$this->db->query($sql,$idmateri);
	if($query->num_rows()>0){
		$level = $query->result_array();
	}else{
		$level = array();
	}
	echo '<table>';
	echo '<thead><tr><td style="width:50px">Level</td><td>Name</td><td style="width:50px">Action</td></tr></thead>';
	echo '<tbody>';
	foreach($level as $l):
		echo '<tr><td>'.$l['level'].'</td><td>'.$l['title'].'</td><td><a href="'.site_url('manage/level/editlevel/'.$l['id_level']).'">edit</a></td></tr>';
	endforeach;
	echo '</tbody>';
}
//add new materi
public function addLevel(){
	$this->adminOnly();
	$idmateri = $_POST['input_materi'];
	$title = $_POST['input_title'];
	$level = $_POST['input_level'];
	$description = $_POST['input_description'];
}
//check available level
public function checkAvailableLevel(){
	$this->adminOnly();
	$level = $this->uri->segment(3);
	$materi = $this->uri->segment(4);
	$this->db->where('level',$level);
	$this->db->where('id_materi',$materi);
	$query = $this->db->get('level');
	if($query->num_rows()>0){
		echo '<strong style="color:red">Level not available</strong>';
	}else{
		echo '<strong style="color:green">Level available</strong>';
	}

}
////////////////////////////
///////////MATERI MANAGEMENT
////////////////////////////

//manage materi
public function materi(){
	$this->adminOnly();
//start pagination
	$config = array(
		'per_page'=>13,
		'uri_segment'=>3,
		'num_link'=>7,
		);

	//end of pagination
	$uri = $this->uri->segment(3);
	if(!$uri){
		$uri = 0;
	}
	//resume pagination
	$config['total_rows'] = $this->m_admin->countShowAllMateri();
	$config['base_url'] = site_url('manage/materi');
	$this->pagination->initialize($config);
	//enf of resume pagination
	//view only
	$data = array(
		'title'=>'All Materi',
		'script'=>'<script>$(document).ready(function(){$("#materi").addClass("active")});function addForm(){$("#form-add").toggle("fast");} </script>',
		'view'=>$this->m_admin->showAllMateri($config['per_page'],$uri),
		);
	if(!empty($_GET['id'])){//melakukan edit data
		$idmateri = $_GET['id'];
		$data['editidmateri'] = $this->m_admin->getMateriByIdMateri($idmateri);
	}
	$data['total'] = $config['total_rows'];
	$data['link'] = $this->pagination->create_links();
	$this->baseManageView('manage/materi',$data);	
}
//add new materi
public function addmateri(){
	$this->adminOnly();
	if(empty($_POST)){
		redirect('manage/materi');//back to maateri list
	}
	$this->load->library('form_validation');
	$this->form_validation->set_rules('input_title', 'title', 'required');//is required
	$this->form_validation->set_rules('input_description', 'description', 'required');//is required email
	if($this->form_validation->run()){//if form validation run
		//insert to database
		$data = array(
			'title'=>$_POST['input_title'],
			'description'=>$_POST['input_description'],
			'adddate'=>date('Y-m-d H:i:s'),
			);
		if($this->db->insert('materi',$data)){
			redirect(site_url('manage/materi?success=success add materi'));
		}else{
			redirect(site_url('manage/materi?error=error add materi'));
		}
	}else{//form validation not run
		echo 'data not valid';
	}		
}
//mater action
public function materiaction(){
	$this->adminOnly();
	switch ($_GET['act']) {
		case 'delete'://delete materi
			$id = $_GET['id'];//get materi id
			$this->db->where('id_materi',$id);
			if($this->db->delete('materi')){//success delete materi
				redirect(site_url('manage/materi?success=success remove materi'));
			}else{//error delete materi
				redirect(site_url('manage/materi?error=error remove materi'));
			}
			break;
		case 'edit'://delete 
			// print_r($_POST);
		$id = $_POST['id'];
		$title = $_POST['input_title'];
		$description = $_POST['input_description'];
			//update datebase
		$this->db->where('id_materi',$id);
		$data = array('title'=>$title,'description'=>$description);
			if($this->db->update('materi',$data)){//success edit data
				redirect(site_url('manage/materi?success=success, materi changed'));
			}else{//failed update data
				redirect(site_url('manage/materi?error=error, materi unchanged'));
			}
			break;
		}
	}
//change materi status
	public function changeMateriStatus(){
	$status = $this->uri->segment(4);//status
	$idmateri = $this->uri->segment(3);//get id materi
	$data = array('status'=>$status);
	$this->db->where('id_materi',$idmateri);
	//update database
	if($this->db->update('materi',$data)){
		redirect(site_url('manage/materi?success=success, status changed'));
	}else{
		redirect(site_url('manage/materi?error=error, status unchanged'));
	}
}
//////////
//students
//////////
//student management
public function students(){
	$this->adminOnly();
	// $this->load->model('m_user');
	//pagination start
	$config = array(
		'per_page'=>13,
		'uri_segment'=>3,
		'num_link'=>7,
		);
	//suspend pagination
	$urisegment = $this->uri->segment(3);
	if(!empty($urisegment)){
		switch ($urisegment) {
			case 'status':
			$status = $this->uri->segment(4);
			//start show student by status
			switch ($this->uri->segment(4)) {
				case 'unverified':
				$config['total_rows'] = $this->m_admin->countAllStudents();
				$config['base_url'] = site_url('manage/student');
				$this->pagination->initialize($config);
				$uri = $this->uri->segment(5);
				if(empty($uri)){$uri=0;}
				//end of pagination
				$data = array(
					'title'=>'Studens',
					'script'=>'<script>$(document).ready(function(){$("#students").addClass("active");$("#unverified").addClass("active")});</script>',
					'view'=>$this->m_user->allStudents($config['per_page'],$uri,0),
					'link'=> $this->pagination->create_links(),
					'total'=>$config['total_rows'],
					);
				break;				
				default:
				echo 'Something wrong';
				break;
			}
			//end of start show student by status
			break;
			case 'search':
			$keyword = $this->uri->segment(4);
			break;
			default:
			echo 'Something wrong';
			break;
		}
	}else{//all student
		//resume pagination
		$config['total_rows'] = $this->m_admin->countAllStudents();
		$config['base_url'] = site_url('manage/student');
		$this->pagination->initialize($config);
		$uri = $this->uri->segment(3);
		if(empty($uri)){$uri=0;}
		//end of pagination
		$data = array(
			'title'=>'Studens',
			'script'=>'<script>$(document).ready(function(){$("#students").addClass("active");$("#all").addClass("active")});</script>',
			'view'=>$this->m_user->allStudents($config['per_page'],$uri,1),
			'link'=> $this->pagination->create_links(),
			'total'=>$config['total_rows'],
			);
	}
	//view
	$this->baseManageView('manage/students',$data);
}
//student action
public function studentaction(){
	$this->adminOnly();
	$iduser = $this->uri->segment(4);
	$this->db->where('id_user',$iduser);
	switch ($this->uri->segment(3)) {
		case 'banned':
		$data = array('status'=>'banned');
		break;
		case 'active':
		$data = array('status'=>'active');
		break;		
	}
	$this->db->update('user',$data);
	//redirect
	redirect(site_url('manage/students'));
}
////////////////////////////
//File and Folder Management
////////////////////////////
public function storage(){
	$this->adminOnly();
	$data = array(
		'title'=>'Storage Management',
		'link'=>'',
		);
	$this->baseManageView('manage/storage',$data);
}

////////////
//DISCUSSION
////////////
public function discussions(){
	$this->adminOnly();
	$this->load->model('m_discussion');
	//start pagination
	$config = array(
		'per_page'=>13,
		'uri_segment'=>3,
		'num_link'=>7,
		);
	//suspend pagination
	if(!empty($_GET['q'])){
		//redirect 
		$q = $_GET['q'];//get keyword
		redirect(site_url('manage/discussions/action/search/'.$q));
	}
	$urisegment = $this->uri->segment(4);
	if(!empty($urisegment)){//manage/discussion/sort/locked
		switch ($this->uri->segment(4)) {
			case 'locked':
			//resume pagination
			$config['total_rows'] = $this->m_admin->countAllDiscussion();//count all lock discussion
			$config['base_url'] = site_url('manage/discussions/sort/locked');
			$this->pagination->initialize($config);
			$uri = $this->uri->segment(5);
			if(empty($uri)){$uri=0;}
			//end of pagination
			$data = array(
				'title'=>'Manage Discussion',
				'script'=>'<script>$(document).ready(function(){$("#discussions").addClass("active");$("#locked").addClass("active")});</script>',
				'link'=>$this->pagination->create_links(),
				'total'=>'',
				'view'=>$this->m_discussion->showLockDiscussion($config['per_page'],$uri),
				);
			break;
			case 'search'://searching berita
			//resume pagination
			$keyword = $this->uri->segment(5);//get keyword
			$uri = $this->uri->segment(6);
			if(empty($uri)){$uri=0;}
			$config['total_rows'] = $this->m_discussion->count_search_discussion($config['per_page'],$uri,$keyword);//count all lock discussion
			$config['base_url'] = site_url('manage/discussions/sort/search');
			$this->pagination->initialize($config);
			//end of pagination
			$data = array(
				'title'=>'Search '.$keyword,
				// 'script'=>'<script>$(document).ready(function(){$("#discussions").addClass("active");$("#locked").addClass("active")});</script>',
				'link'=>$this->pagination->create_links(),
				'total'=>'',
				'view'=>$this->m_discussion->search_discussion($config['per_page'],$uri,$keyword),
				);
			break;
			default:
			echo 'something wrong';
			break;
		}
	} else {
		//resume pagination
		$config['total_rows'] = $this->m_admin-> countAllDiscussion();
		$config['base_url'] = site_url('manage/discussion');
		$this->pagination->initialize($config);
		$uri = $this->uri->segment(3);
		if(empty($uri)){$uri=0;}
		//end of pagination
		$data = array(
			'title'=>'Manage Discussion',
			'script'=>'<script>$(document).ready(function(){$("#discussions").addClass("active");$("#all").addClass("active")});</script>',
			'link'=>$this->pagination->create_links(),
			'total'=>'',
			'view'=>$this->m_discussion->show_discussion($config['per_page'],$uri),
			);
	}
	$this->baseManageView('manage/discussions',$data);
}
//change discussion status
public function setdiscussion(){
	$this->adminOnly();
	$status = $this->uri->segment(3);
	$id = $this->uri->segment(4);
	//update db
	$this->db->where('id_discuss',$id);
	$data = array('status'=>$status);
	$this->db->update('discussion',$data);
	redirect($this->agent->referrer());
}
//////////
//COMMENTS
//////////
public function comments(){
	$this->adminOnly();
	$this->load->model('m_discussion');
	if(!empty($_GET['q'])){
		$q = $_GET['q'];//get keyword
		redirect(site_url('manage/comments/sort/search/'.$q));
	}
	//start pagination
	$config = array(
		'per_page'=>13,
		'uri_segment'=>3,
		'num_link'=>7,
		);
	$urisegment = $this->uri->segment(4);
	if(!empty($urisegment)){
		switch ($urisegment){		
			case 'locked'://show locked comments
			//resume pagination
			$config['total_rows'] = $this->m_admin->countAllComment('locked');//count all posted comment
			$config['base_url'] = site_url('manage/comments');
			$this->pagination->initialize($config);
			$uri = $this->uri->segment(5);
			if(empty($uri)){$uri=0;}
			//end of pagination
			$data = array(
				'title'=>'Manage Locked Discussion Comments',
				'script'=>'<script>$(document).ready(function(){$("#comments").addClass("active");$("#locked").addClass("active")});</script>',
				'link'=>$this->pagination->create_links(),
				'total'=>'',
				'view'=>$this->m_admin->allComments($config['per_page'],$uri,'locked'),
				);
			break;

			case 'lock' || 'unlock'://lock/unlock comment
			$status = $this->uri->segment(4);
			$id = $this->uri->segment(5);
			$this->db->where('id_comment',$id);
			$data = array('status'=>$status);
			$this->db->update('discussion_comment',$data);
			redirect($this->agent->referrer());
			break;

			case 'search'://do search
			$keyword = $this->uri->segment(5);//get kwyoi
			echo $keyword;
			// $config['total_rows'] = $this->m_admin->countSearchDiscussionComment($keyword);//count all posted comment
			// $config['base_url'] = site_url('manage/comments/sort/search/'.$keyword);
			// $this->pagination->initialize($config);
			// $uri = $this->uri->segment(6);
			// if(empty($uri)){$uri=0;}
			// //end of pagination
			// $data = array(
			// 	'title'=>'Search '.$keyword,
			// 	'link'=>$this->pagination->create_links(),
			// 	'total'=>'',
			// 	'view'=>$this->m_admin->searchDiscussionComment($keyword,$config['per_page'],$uri),
			// 	);
			break;

			default:
			echo 'something wrong';
			break;
		}
	}else{
		//show posted comments
		//resume pagination
		$config['total_rows'] = $this->m_admin->countAllComment('posted');//count all posted comment
		$config['base_url'] = site_url('manage/comments');
		$this->pagination->initialize($config);
		$uri = $this->uri->segment(3);
		if(empty($uri)){$uri=0;}
		//end of pagination
		$data = array(
			'title'=>'Manage Discussion Comments',
			'script'=>'<script>$(document).ready(function(){$("#comments").addClass("active");$("#all").addClass("active")});</script>',
			'link'=>$this->pagination->create_links(),
			'total'=>'',
			'view'=>$this->m_admin->allComments($config['per_page'],$uri,'posted'),
			);
	}
	$this->baseManageView('manage/comments',$data);

}

/////////////
//MANAGE NEWS
/////////////
public function news(){
	$this->adminOnly();
	$this->load->model('m_news');
	//if submit form
	if(!empty($_POST)){//add form
		if(isset($_POST['btnpublish']) || isset($_POST['btndraft'])){
			$now = date('Y-m-d h:i:s');//current time
			$title = $_POST['input_title'];
			$content = $_POST['input_content'];
			if(isset($_POST['btnpublish'])){
				$status = 'published';
			}else if(isset($_POST['btndraft'])){
				$status = 'draft';
			}
			$data = array(
				'id_user'=>$this->session->userdata['manage_login']['id_user'],
				'title'=>$title,
				'content'=>$content,
				'postdate'=>$now,
				'updatedate'=>$now,
				'status'=>$status,
				);
			$this->db->insert('news',$data);
			redirect(site_url('manage/news'));
		}else if(isset($_POST['btnedit']) || isset($_POST['btneditdraft'])){
			$this->db->where('id_news',$this->uri->segment(5));
			$now = date('Y-m-d h:i:s');//current time
			$title = $_POST['input_title'];
			$content = $_POST['input_content'];
			if(isset($_POST['btnedit'])){
				$status = 'published';
			}else if(isset($_POST['btneditdraft'])){
				$status = 'draft';
			}
			$data = array(
				'title'=>$title,
				'content'=>$content,
				'updatedate'=>$now,
				'id_user'=>$this->session->userdata['manage_login']['id_user'],
				'status'=>$status,
				);
			$this->db->update('news',$data);
			redirect(site_url('manage/news'));
		}
	}
	//start pagination
	$config = array(
		'per_page'=>13,
		'uri_segment'=>3,
		'num_link'=>7,
		);
	//suspend pagination
	$urisegment = $this->uri->segment(4); 
	if(!empty($urisegment)){
		switch ($urisegment) {
			case 'draft':
				$config['total_rows'] = $this->m_admin->countNews('draft');//count all posted comment
				$config['base_url'] = site_url('manage/news');
				$this->pagination->initialize($config);
				$uri = $this->uri->segment(5);
				if(empty($uri)){$uri=0;}
				//end of pagination
				$data = array(
					'title'=>'Manage News',
					'script'=>'<script>$(document).ready(function(){$("#news").addClass("active");$("#draft").addClass("active")});</script>',
					'link'=>$this->pagination->create_links(),
					'total'=>'',
					'view'=>$this->m_news->draftNewsList($config['per_page'],$uri,'posted'),
					);
				break;
				//edit news
				case 'edit':
				$id = $this->uri->segment(5);
				$data = array(
					'title'=>'edit news',
					'script'=>'<script>$(document).ready(function(){$("#news").addClass("active");$(".form-add").show()});</script>',
					'edit'=>$this->m_news->news_item($id),
					'link'=>'',
					);					
				break;
				//delete news
				case 'delete':
				$id = $this->uri->segment(5);
				$this->db->where('id_news',$id);
				$this->db->delete('news');
				redirect(site_url('manage/news'));
				break;
				default:
				# code...
				break;
			}
		}else{
	$config['total_rows'] = $this->m_admin->countNews('published');//count all posted comment
	$config['base_url'] = site_url('manage/news');
	$this->pagination->initialize($config);
	$uri = $this->uri->segment(3);
	if(empty($uri)){$uri=0;}
		//end of pagination
	$data = array(
		'title'=>'Manage News',
		'script'=>'<script>$(document).ready(function(){$("#news").addClass("active");$("#published").addClass("active")});</script>',
		'link'=>$this->pagination->create_links(),
		'total'=>'',
		'view'=>$this->m_news-> news_list($config['per_page'],$uri,'posted'),
		);
}
$this->baseManageView('manage/news',$data);
}
//////////////
//edit profile
//////////////
public function profile(){
	$this->adminOnly();
	//if do action woth form
	$data = array(
		'title'=>'myprofile',
		'script'=>'<script>$(document).ready(function(){$("#profile").addClass("active");});</script>',
		'profile'=>$this->m_admin->myProfile($this->session->userdata['manage_login']['id_user']),
		);
	if(!empty($_POST)){
		//validation
		if(md5(md5($_POST['input_recentpassword'])) != $this->session->userdata['manage_login']['password']){
			redirect(site_url('manage/profile?error=! Recent password not matched'));
		}
		$this->load->library('form_validation');
		//set rules
		$session = $this->session->userdata('manage_login');
		if($_POST['input_username'] != $session['username']){
			$this->form_validation->set_rules('input_username', 'Username', 'required|is_unique[user_manage.username]');//is unique
		}
		if($_POST['input_username'] != $session['email']){
			$this->form_validation->set_rules('input_email', 'Email', 'required|valid_email');//is unique
		}
		$this->form_validation->set_rules('input_fullname', 'Fullname', 'required');//is unique
		//is change password
		if(!empty($_POST['input_changepassword'])){
			$this->form_validation->set_rules('input_changepassword', 'New Password', 'required');//is unique
			$this->form_validation->set_rules('input_changepasswordagain', 'New Password Again', 'required|matches[input_changepassword]');//is unique
		}
		//end of validation
		if($this->form_validation->run()){//data valid
			$data = array(
				'username'=>$_POST['input_username'],
				'email'=>$_POST['input_email'],
				'fullname'=>$_POST['input_fullname'],
				);
			if(!empty($_POST['input_changepassword'])){
				$data['password'] = md5(md5($_POST['input_changepassword']));
			}
			$this->db->where('id_user_manage',$_POST['id_user_manage']);
			$this->db->update('user_manage',$data);
			redirect(site_url('manage/profile?success=data updated, please logout and login again'));
		}
	}
	$this->baseManageView('manage/profile',$data);
}
///////////////////
//Manage Super User
///////////////////
public function superuser(){
	$this->adminOnly();
	//start pagination
	$config = array(
		'per_page'=>13,
		'uri_segment'=>3,
		'num_link'=>7,
		);
	//suspend pagination
	if(!empty($_POST)){

	}
	$urisegment4 = $this->uri->segment(4);
	$urisegment3 = $this->uri->segment(3);
	if(!empty($urisegment4) && $urisegment3!= 'sort'){//chang status
		$action = $this->uri->segment(4);
		if($action == 'admin' || $action == 'moderator'){
			$level = $this->uri->segment(4);
			$this->db->where('id_user_manage',$this->uri->segment(5));
			$data = array('level'=>$level);
			$this->db->update('user_manage',$data);
		}else if($action == 'active' || $action == 'banned'){
			$status = $this->uri->segment(4);
			$this->db->where('id_user_manage',$this->uri->segment(5));
			$data = array('status'=>$status);
			$this->db->update('user_manage',$data);
		}
		redirect($this->agent->referrer());
	}else if($this->uri->segment(3)=='sort'){
		if($this->uri->segment(4) == 'banned'){//show banned user

		}else{ //show moderator and admin
			//resume pagination
		$config['total_rows'] =  $this->m_admin->countSuperUser($this->uri->segment(4));//count all posted comment
		$config['base_url'] = site_url('manage/superuser/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
		$this->pagination->initialize($config);
		$uri = $this->uri->segment(5);
		if(empty($uri)){$uri=0;}
		//end of pagination
		$data = array(
			'title'=>'Manage Super User',
			'script'=>'<script>$(document).ready(function(){$("#superuser").addClass("active");$("#'.$this->uri->segment(4).'").addClass("active")});</script>',
			'link'=>$this->pagination->create_links(),
			'view'=>$this->m_admin->showSuperUser($config['per_page'],$uri,$this->uri->segment(4)),
			);	 
	}
}else{
		//normal view
		//resume pagination
		$config['total_rows'] =  $this->m_admin->countSuperUser('all');//count all posted comment
		$config['base_url'] = site_url('manage/superuser');
		$this->pagination->initialize($config);
		$uri = $this->uri->segment(3);
		if(empty($uri)){$uri=0;}
		//end of pagination
		$data = array(
			'title'=>'Manage Super User',
			'script'=>'<script>$(document).ready(function(){$("#superuser").addClass("active");$("#all").addClass("active")});</script>',
			'link'=>$this->pagination->create_links(),
			'view'=>$this->m_admin->showSuperUser($config['per_page'],$uri,'all'),
			);	  
	}
	$this->baseManageView('manage/superuser',$data);
	
}
//add user manage
public function addusermanage(){
	if(isset($_POST['btn_admin'])){
			$level = 'admin';
		}else if(isset($_POST['btn_moderator'])){
			$level = 'moderator';
		}else{
			$level = 'modeartor';
		}
	$data = array(
		'username'=>$_POST['input_username'],
		'password'=>md5(md5($_POST['input_username'])),
		'email'=>$_POST['input_email'],
		'fullname'=>$_POST['input_fullname'],
		'level'=>$level,
		'pp'=>'',
		'status'=>'active',
		'registerdate'=>date('Y-m-d H:i:s'),
		);
	$this->db->insert('user_manage',$data);
	redirect($this->agent->referrer());
}


////////
//logout
////////
public function logout(){
	$this->adminOnly();
	$this->session->sess_destroy();
	redirect(site_url('manage'));
}
	//
	// AJAX ONLY - ajax for admin manage
	//
public function getDirectory(){
	$this->adminOnly();
	$directory = $_GET['dir'];
	$directory = str_replace('%2f', '/', $directory);
	$path = $directory;
	if($path == '/'){$path='';}
		////get directory
	$sqldir = "SELECT * FROM available_dir WHERE directory LIKE '".$directory."%'";
	$querydir = $this->db->query($sqldir);
	$mydir = array();
	$dir = $querydir->result_array();
	$showdir = array();
	foreach($dir as $md):
	if($directory == '/'){//if on root
		$dir = str_replace($directory.'/', '', $md['directory']);
	}else{//except root
		$dir = str_replace($directory, '', $md['directory']);
	}
	$dir = explode('/', $dir);
	// print_r($dir);
	if($md['directory'] != $directory && !in_array($dir[1], $showdir)){	
		echo '
		<div class="row">
			<div class="small-1 columns"><span style="font-size:20px" class="fi-folder"></span></div>
			<div class="small-8 columns"><a onclick="changeDirectory(\''.$path.'/'.$dir[1].'\')">'.$dir[1].'/ </a></div>
			<div class="small-2 columns"><a onclick="editDirectory(\''.$md['directory'].'\')">edit</a> | <a onclick="deleteDirectory(\''.$md['directory'].'\')">delete</a></div>
		</div>
		';
		array_push($showdir, $dir[1]);
	}
	endforeach;
	// print_r($mydir);
		//replace same folder

		////get file
	$sqlfile = "SELECT id_ls_dir,type,name,attributes,content FROM ls_dir
	INNER JOIN available_dir ON available_dir.id = ls_dir.id_available_dir
	WHERE available_dir.directory = '$directory'";
	$queryfile = $this->db->query($sqlfile);
	$myfile = array();
	$file = $queryfile->result_array();
	foreach($file as $f):
		$attributes = str_replace('|', ' ', $f['attributes']);
	echo '
	<div class="row">
		<div class="small-1 columns"><span style="font-size:20px" class="fi-page-copy"></span></div>
		<div class="small-8 columns"><a onclick="">'.$f['type'].$attributes.' '.$f['name'].'</a></div>
		<div class="small-2 columns"><a onclick="editFileView('.$f['id_ls_dir'].')">edit</a> | <a onclick="deleteFile('.$f['id_ls_dir'].')">delete</a></div>
	</div>
	';
	endforeach;

	if(empty($dir) && empty($file)){echo '<center>Empty Directory</center>';}
}
//add file / directory
public function crudStorage(){
	$this->adminOnly();
	switch ($_GET['act']) {
		case 'addfile':
		$dir = $_GET['dir'];
			//get directory id
		$sql = "SELECT id FROM available_dir WHERE directory = '".$dir."'";
		$query = $this->db->query($sql);
		$query = $query->row_array();
		$id_dir = $query['id'];
			//insert new file data
		$data = array(
			'id_available_dir'=>$id_dir,
			'type'=>$_GET['type'],
			'name'=>$_GET['name'],
			'attributes'=>$_GET['attributes'],
			'content'=>$_GET['content']
			);
		return $this->db->insert('ls_dir',$data);
		break;
		case 'adddir':
		$name = $_GET['name'];
		return $this->db->insert('available_dir',array('directory'=>$name));
		break;
		case 'vieweditfile':
		$id = $_GET['id'];
		$this->db->where('id_ls_dir',$id);
		$ls_dir = $this->db->get('ls_dir');
		$ls_dir = $ls_dir->row_array();
		echo '
		<a onclick="return  $(\'#editFile\').hide(\'fast\');">[X]</a><br/>
		<input type="hidden" id="editfileid" value="'.$ls_dir['id_ls_dir'].'">
		<label>File Name<input id="editfilename" type="text" value="'.$ls_dir['name'].'"></label>
		<label>Type
			<select id="editfiletype">
				<option value="-">file</option>
				<option value="s">softlink</option>
			</select>
		</label>
		<br/>
		<label>Attributes
			<input type="text" id="editfileattributes" value="'.$ls_dir['attributes'].'">
		</label>
		<label>Content
			<textarea id="editfilecontent">'.$ls_dir['content'].'</textarea>
		</label>
		<br/>
		<button onclick="processEditFile()" class="button small">save changes</button>
		';
		break;
		case 'proceditfile'://update database for ls_dir
		$this->db->where('id_ls_dir',$_GET['id']);
		$data = array(
			'name'=>$_GET['name'],
			'type'=>$_GET['type'],
			'attributes'=>$_GET['attributes'],
			'content'=>$_GET['content'],
			);
		return $this->db->update('ls_dir',$data);
		break;
		case 'editdir':
		$olddir = $_GET['olddir'];
		$newdir = $_GET['newdir'];
		$this->db->where('directory',$olddir);
		return $this->db->update('available_dir',array('directory'=>$newdir));
		break;
		case 'deletefile':		
		$id = $_GET['id'];
		$this->db->where('id_ls_dir',$id);
		return $this->db->delete('ls_dir');	
		break;
		case 'deletedir':
		$name = $_GET['dir'];
		echo $name;
		$this->db->where('directory',$name);
		return $this->db->delete('available_dir');
		break;
	}
}
}