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
	$data=array(
		'title'=>'Manage Title',
		);	
	$this->baseManageView('manage/dashboard',$data);
}

////////////////////
// COURSE MANAGEMENT
////////////////////
//add new course
public function addcourse(){
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
			redirect($redirect);
		}else{//error insert db
			echo 'error insert database';
		}
	}

	if(empty($this->uri->segment(3))){
			//get lattest edited idcourse
		$idcourse = $this->m_course->lastEditCourse();
	}else{
		$idcourse = $this->uri->segment(3);
	}
	//echo $idcourse;
	$data = array(
		'idcourse'=>$idcourse,
		'title' => 'Edit Course Case',
		'script'=>'<script>function addForm(){$("#form-add").toggle("fast");}</script>',
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
		if(!empty($this->uri->segment(3)) AND !is_numeric($this->uri->segment(3))){//filtering via uri segement 3
			switch ($this->uri->segment(3)) {
				case 'active':
				break;
				case 'draft':
					# code...
				break;
				case 'search':
				$keyword = $this->uri->segment(4);
				$config['uri_segment']=5;
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

}
//manage materi
public function materi(){
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
		'script'=>'<script>$(document).ready(function(){$("#materi").addClass("active")});function addForm(){$("#form-add").toggle("fast");}</script>',
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
//logout
public function logout(){
	$this->session->sess_destroy();
	redirect(site_url('manage'));
}
	//
	// AJAX ONLY - ajax for admin manage
	//
}