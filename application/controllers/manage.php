<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('application/controllers/base.php');//load base class
class manage extends base { //class for public
	//konstruktor
	public function __construct()
	{
		parent::__construct();
		//only for member
		$this->load->model('m_admin');
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
				'script'=>'<script>$(document).ready(function(){$("#course").addClass("active")});</script>',
				'view'=>$this->m_admin->showAllCourse($config['per_page'],$uri),//return all course data
				);
		}
		//$this->load->library('pagination');
		$this->pagination->initialize($config);
		$data['link'] = $this->pagination->create_links();
		$this->baseManageView('manage/course',$data);		
	}
}
//manage level
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
		'script'=>'<script>$(document).ready(function(){$("#materi").addClass("active")});</script>',
		'view'=>$this->m_admin->showAllMateri($config['per_page'],$uri),
		);
	$data['total'] = $config['total_rows'];
	$data['link'] = $this->pagination->create_links();
	$this->baseManageView('manage/materi',$data);	
}
//add new materi
public function addMateri(){
	
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