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
	'myMateri'=>$this->m_course->showMyIdMateri($this->session->userdata['student_login']['id_user']),
	'allMateri'=>$this->m_course->showAllMateri(),
	);
		// count percentation course
$totalnow = $this->m_course->countCourseStepByMateri($data['recentCourse']['id_course'],$data['recentCourse']['id_materi']);
$totalCourse = $this->m_course->countCourseByMateri($data['recentCourse']['id_materi']);
$data['percentage'] = number_format(($totalnow*100/$totalCourse),1);
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
			$data['profile'] = $this->m_user->getDataByUsername($this->session->userdata['student_login']['username']);
			$this->baseView('m/editprofile',$data);
		}
	}
	//update profle
	public function updateprofile(){
		$this->load->library('form_validation');
		//set rules
		//recent username != new username
		if($this->session->userdata['student_login']['username'] != $_POST['input_username'] ){
			$this->form_validation->set_rules('input_username', 'Username', 'required|is_unique[user.username]');//is unique
		}
		if($this->session->userdata['student_login']['email'] != $_POST['input_email'] ){
			$this->form_validation->set_rules('input_email', 'Email', 'required|valid_email|is_unique[user.email]');//input email
		}
		$this->form_validation->set_rules('input_fullname', 'Fullname', 'required');//is unique
		$this->form_validation->set_rules('input_newpassword', 'New Password', 'trim|matches[input_newpassconf]');//password 1 matched with passconf
		$this->form_validation->set_rules('input_newpassconf', 'New Password Confirmation', 'trim');//password confirmation
		if ($this->form_validation->run()){//if validation is true
			//manage profile picture
			if(isset($_FILES['input_pp'])){
				$config['upload_path'] = './assets/img/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '100';
				$config['max_width']  = '500';
				$config['max_height']  = '500';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('input_pp')){//gagal upload
					echo $this->upload->display_errors();
				} else { //berhasil upload
					$data = array('upload_data' => $this->upload->data());
					$this->load->view('upload_success', $data);
					$pp = $_FILES['input_pp']['name'];
				}
			}else{//not upload new profile picure
				if(!empty($this->session->userdata['student_login']['pp'])){
					$pp = $this->session->userdata['student_login']['pp'];
				} else {
					$pp = '';
				}

			}
			//manage password
			if(!empty($_POST['input_newpassword'])){				
				$newpassword = md5(md5($_POST['input_newpassword']));
			}else{
				$newpassword = $this->session->userdata['student_login']['password'];
			}
			//start insert to the db
			$this->db->where('username',$this->session->userdata['student_login']['username']);
			$data = array(
				'username'=>$_POST['input_username'],
				'fullname'=>$_POST['input_fullname'],
				'email'=>$_POST['input_email'],
				'pp'=>$pp,
				'password'=>$newpassword,
				'about'=>$_POST['input_about'],
				);
			$this->db->update('user',$data);
			redirect(site_url('m/edit?note=Update Success'));
		}else{
			$data = array('title'=>'Update Profile Failed');
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