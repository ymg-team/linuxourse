<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('application/controllers/base.php');//load base class
class p extends base { //class for public

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->library('form_validation');
	}

	public function notfound(){
		$data['title'] = "ERROR 404";
		$this->baseView('base/404',$data);
	}

	public function index() //homepage
	{
		$this->load->model(array('m_course','m_user'));
		//if logged in
		if(!empty($this->session->userdata['student_login'])){
			redirect(site_url('m/dashboard'));//back to dashboard
		}
		$data = array(
			'title'=>'',//will print LINUXOURSE
			'allMateri'=>$this->m_course->showAllMateri(),
			);
		if(!empty($_GET['error'])){
			$data['script'] = '<script>$(document).ready(function(){$("#home").addClass("activemenu");$("#showError").foundation("reveal", "open");});</script>';
		}else if(!empty($_GET['success'])){
			$data['script'] = '<script>$(document).ready(function(){$("#home").addClass("activemenu");$("#showSuccess").foundation("reveal", "open");});</script>';
		}else {
			$data['script'] = '<script>$(document).ready(function(){$("#home").addClass("activemenu")});</script>';
		}
		$this->load->view('home-inaicta');
		$this->load->view('base/baseFooter');
		// $this->baseView('p/home',$data);
	}

	/////////////////////////////////////
	// ALL ABOUT REGISTER AND LOGIN
	/////////////////////////////////////

	//register new user
	public function register(){
		if(!empty($_POST)){//register process
			$this->load->library('form_validation');
		//set rules
		$this->form_validation->set_rules('input_username', 'Username', 'required|is_unique[user.username]');//is unique
		$this->form_validation->set_message('input_username', 'this username is exist, try another one');
		$this->form_validation->set_rules('input_fullname', 'Fullname', 'required');//is unique
		$this->form_validation->set_rules('input_email', 'Email', 'required|valid_email|is_unique[user.email]');//is unique
		$this->form_validation->set_rules('input_password', 'Password', 'required|matches[input_passconf]');//password 1 matched with passconf
		$this->form_validation->set_rules('input_passconf', 'Password Confirmation', 'required');//password confirmation
		//validation check
		if ($this->form_validation->run()){//if validation is true
			//insert to database
			$now = date('Y-m-d h:i:s');
			if(!empty($this->session->userdata['registerdata']['oauthProvider'])){$oauthprov=$this->session->userdata['registerdata']['oauthProvider'];}else{$oauthprov='';}
			if(!empty($this->session->userdata['registerdata']['oauthId'])){$oauthid=$this->session->userdata['registerdata']['oauthId'];}else{$oauthid='';}
			$datauser = array(
				'username'=>$_POST['input_username'],
				'email'=>$_POST['input_email'],
				'fullname'=>$_POST['input_fullname'],
				'password'=>md5(md5($_POST['input_password'])),//double md5
				'status'=>'active',
				'register_date'=>$now,
				'verified'=>0,
				'oauthProvider'=>$oauthprov,
				'oauthId'=>$oauthid,
				);
			//verification code
			$verificationCode = base64_encode(base64_encode($datauser['email'])).'linux'.base64_encode(base64_encode($datauser['username']));
			$verificationCode = str_replace('=', '', $verificationCode);
			if($this->db->insert('user',$datauser)){
				//send email
				$body = '<a href="http://www.linuxourse.me/doverification/'.$verificationCode.'">http://www.linuxourse.me/p/doverification/'.$verificationCode.'</a>';
				$this->sendgridSend($datauser['email'],'Account Verification','To continue learning on Linuxourse click link bellow',$body);
				$this->session->sess_destroy();
				redirect(site_url('p/redirect/registersuccess'));
			}else{//failed insert to db
				$data = array(
					'title'=>'Register Failed',
					);
				$this->baseView('p/registererror',$data);
			}
		} else { //if validation is false
			$data = array(
				'title'=>'Register Failed',
				);
			$this->baseView('p/registererror',$data);
		}
	}else{//register view
		$data = array(
			'title'=>'Register',
			);
		$this->baseView('p/register',$data);
	}
}

	//do verification
public function doverification(){
	$this->load->model('M_user');
	$verificationcode = $this->uri->segment(3);
	$vc = explode('linux',$verificationcode);
	$email = base64_decode(base64_decode($vc[0]));//WORKED
	$username = base64_decode(base64_decode($vc[1]));//WORKED
	// is user found
	$userdata = $this->m_user->checkUser($username,'',$email);
	if($userdata==TRUE)//user found
	{
		$this->db->where('email',$email);
		$this->db->update('user',array('verified'=>1));
		echo '<script>window.setTimeout(function(){window.location.href = "'.site_url().'";}, 2);</script>';
		echo '<h1>Confirmation Success</h1><p>You will be automatic redirect to <a href="'.site_url().'">Linuxourse</a></p>';
	}else//user not found
	{
		echo 'User data not found <a href="'.site_url().'">menuju Linuxourse</a>';
	}
}
	//user login
public function login(){
	$this->load->library('user_agent');
		//set rules
		$this->form_validation->set_rules('input_username', 'Username', 'required|trim|callback_validate_credentials');//is required
		$this->form_validation->set_rules('input_password', 'Password', 'required|trim');//is required email
		//validation check
		if ($this->form_validation->run()){//if validation is true
			//redirect to login page
			$username = $_POST['input_username'];
			$password = md5(md5($_POST['input_password']));
			//get all user data
			$userdata = $this->m_user->can_login($username,$password);
			//cek data ditemukan
			if(!empty($userdata)){
				//verified or not
				if($userdata['verified']==0){//email not verified
					$data['title'] = 'Verified email first';
					$data['error'] = 'check your email to verification or resend verification code <a data-reveal-id="verificationModal" href="#">here</a>';
					$this->baseView('p/loginerror',$data);
				}else{//create session
					$loginuser['id_user'] = $userdata['id_user'];
					$loginuser['username'] = $userdata['username'];
					$loginuser['email'] = $userdata['email'];
					$loginuser['fullname'] = $userdata['fullname'];
					$loginuser['id_country'] = $userdata['id_country'];
					$loginuser['register_date'] = $userdata['register_date'];
					$loginuser['password'] = $userdata['password'];
					$loginuser['level'] = $userdata['level'];
					$loginuser['status'] = $userdata['status'];
					$loginuser['pp'] = $userdata['pp'];
					$loginuser['is_login'] = 1;
					$sessiondata['student_login'] = $loginuser;
				$sessiondata['command'] = array();//for course
				//set session
				$this->session->set_userdata($sessiondata);
				$this->session->set_userdata('dir','/home/user');
				if($this->session->userdata['student_login']['status'] == 'active'){ //jika statusnya aktif
					$this->db->where('id_user',$this->session->userdata['student_login']['id_user']);
					$data = array('last_login'=>date('Y-m-d h:i:s'));
					$this->db->update('user',$data);//update login terakhir
					redirect(site_url());
				} else { //jika statusnya banned
					echo 'gagal memasukan session';
				}
			}
			}else{ //username n password not matched
				$data['title'] = 'login failed';
				$this->baseView('p/loginerror',$data);
			}

		} else { //if validation is false
			$data['title'] = 'login failed';
			$this->baseView('p/loginerror',$data);
		}
	}
	//login validation
	public function validate_credentials(){
		$username = $this->input->post('input_username');
		$password = md5(md5($this->input->post('input_password')));
		//cek apakah tersedia di database
		if($this->m_user->can_login($username,$password)){
			return true;
		}else{
			$this->form_validation->set_message('validate_credentials','username/password not match');
			return false;
		}
	}
	//success action
	public function redirect(){
		//set uri segment 3
		$segment = $this->uri->segment(3);
		if(empty($segment)){
			echo '404';
		}
		//else
		$note = $this->uri->segment(3);
		switch ($note) {
			case 'registersuccess'://register success
			$data = array(
				'title'=>'Register Success',
				'allMateri'=>$this->m_course->showAllMateri(),
				'script'=>'<script>$(document).ready(function(){
					$("#registerSuccess").foundation("reveal", "open");
				});</script>',
			);
			$this->baseView('p/home',$data);
			break;

			default:
			echo '404';
			break;
		}
	}
	//logout
	public function logout(){
		$this->session->sess_destroy();
		redirect(site_url(),'refresh');
	}

	//
	// OTHER public feature
	//
	public function errorreport(){
		$data = array(
			'title'=>'Error Report');
		$this->baseView('p/errorreport',$data);
	}

	/////////////////////////
	//REGISTER STEP
	/////////////////////////

	//do verification
	public function verification(){
		$code = str_replace('', '=', $this->uri->segment(3));
		$explode = explode('linux', $code);
		$email = base64_decode(base64_decode($explode[0]));
		$username = base64_decode(base64_decode($explode[1]));
		//edit status
		$this->db->where('email',$email);
		$this->db->where('username',$username);
		$query = $this->db->get('user');
		if(!empty($user)){//change status
			redirect(site_url().'?error=<span style="color:rgb(229, 56, 56)">your verification code is not working</span>, get new verification code via menu on footer');
		}else{//username and email not found
			//update db
			$this->db->update('user',array('verified'=>1));
			redirect(site_url().'?success=<span style="color:rgba(13, 145, 85, 0.95)">email is verified</span>, you can login now');
		}
	}

	//get verification code
	public function sendVerification(){
		$email = $this->input->post('inputemail');
		$this->db->where('email',$email);
		$query = $this->db->get('user');
		if($query->num_rows()<0){
			//user email not found
			redirect(site_url().'?error=<span style="color:rgb(229, 56, 56)">email not found</span>, please register again');
		}else{
			$result = $query->row_array();
			$username = $result['username'];
			//send verification code
			$verificationCode = base64_encode(base64_encode($email)).'linux'.base64_encode(base64_encode($username));
			$verificationCode = str_replace('=', '', $verificationCode);
			$this->m_user->sendVerificationEmail($verificationCode,$email);
			redirect(site_url().'?success=<span style="color:rgba(13, 145, 85, 0.95)">new verification code is sent</span> check your email');
			//end of send verification code
		}
	}
}

/* End of file base.php */
/* Location: ./application/controllers/base/base.php */
