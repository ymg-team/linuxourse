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
			);
		$data['script'] = '<script>$(document).ready(function(){$("#home").addClass("activemenu")});</script>';
		$this->baseView('p/home',$data);
	}

	/////////////////////////////////////
	// ALL ABOUT REGISTER AND LOGIN
	/////////////////////////////////////

	//register new user
	public function register(){
		$this->load->library('form_validation');
		//set rules
		$this->form_validation->set_rules('input_username', 'Username', 'required|is_unique[user.username]');//is unique
		$this->form_validation->set_rules('input_fullname', 'Fullname', 'required');//is unique
		$this->form_validation->set_rules('input_email', 'Email', 'required|valid_email|is_unique[user.email]');//is unique
		$this->form_validation->set_rules('input_password', 'Password', 'required|matches[input_passconf]');//password 1 matched with passconf
		$this->form_validation->set_rules('input_passconf', 'Password Confirmation', 'required');//password confirmation
		//validation check
		if ($this->form_validation->run()){//if validation is true
			//insert to database
			$now = date('Y-m-d h:i:s');
			$datauser = array(
				'username'=>$_POST['input_username'],
				'email'=>$_POST['input_email'],
				'fullname'=>$_POST['input_fullname'],
				'password'=>md5(md5($_POST['input_password'])),//double md5
				'status'=>'active',
				'register_date'=>$now,
				);
			if($this->db->insert('user',$datauser)){
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
	}

	//sent verfication code to email
	public function sentemail(){
		//if not do verfication in 7 days, user data will delete
		$verficationcode = $this->uri->segment(3);
		$this->load->library('email');
		$this->email->from('nonreply-linuxourse@gmail.com', 'Non Reply Linuxourse');
		$this->email->to('someone@example.com'); 
		// $this->email->cc('another@another-example.com'); 
		// $this->email->bcc('them@their-example.com');
		$this->email->subject('Linuxourse Verfication');
		$this->email->message('ready to learn Linux, one more step to do it : click this url to verification your account
			 <a href="'.site_url('p/doverification/'.$verficationcode).'">http://linuxourse.com/p/doverification/'.$verficationcode.'</a>');
		$this->email->send();

		echo $this->email->print_debugger();
	}
	//do verification
	public function doverification(){
		$verficationcode = $this->uri->segment(3);
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
					$data = array('last_login'=>date('Y-m-d h:i:s'));
					$this->db->update('user',$data);//update login terakhir
					redirect(site_url());					
				} else { //jika statusnya banned
					echo 'gagal memasukan session';
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
		if(empty($this->uri->segment(3))){
			echo '404';
		}
		//else
		$note = $this->uri->segment(3);
		switch ($note) {
			case 'registersuccess'://register success
			$data = array(
				'title'=>'Register Success',
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
}

/* End of file base.php */
/* Location: ./application/controllers/base/base.php */