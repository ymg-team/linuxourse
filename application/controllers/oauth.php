<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('application/controllers/base.php');//load base class
class Oauth extends base { //class for public

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_user'));		
	}
	//index url
	public function index(){echo '<h1>Forbidden Page</h1>';}
	//login via googleplus
	public function googleplus(){
		session_start();
		include_once "oauth/google/examples/templates/base.php";
		require_once('oauth/google/src/Google/autoload.php');
		require_once('oauth/google/src/Google/Service/Plus.php');
	/************************************************
	  ATTENTION: Fill in these values! Make sure
	  the redirect URI is to this page, e.g:
	  http://localhost:8080/user-example.php
	 ************************************************/
	  $client_id = '850390802439-iam46vt2ah1i291fs4bhr3r8lp43miau.apps.googleusercontent.com';
	  $client_secret = '-Fgv-YgBFMyPjjYDEztf3vWT';
	  $redirect_uri = 'https://linuxourse.me/oauth/googleplus';
	  $client = new Google_Client();
	  $client->setClientId($client_id);
	  $client->setClientSecret($client_secret);
	  $client->setRedirectUri($redirect_uri);
	  $client->setScopes(array('profile','email'));
	/************************************************
	  If we're logging out we just need to clear our
	  local access token in this case
	 ************************************************/
	  if (isset($_REQUEST['logout'])) {
	  	unset($_SESSION['access_token']);
	  }
	/************************************************
	  If we have a code back from the OAuth 2.0 flow,
	  we need to exchange that with the authenticate()
	  function. We store the resultant access token
	  bundle in the session, and redirect to ourself.
	 ************************************************/
	  if (isset($_GET['code'])) {
	  	$client->authenticate($_GET['code']);
	  	$_SESSION['access_token'] = $client->getAccessToken();
	  	$redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	  	header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
	  }
	/************************************************
	  If we have an access token, we can make
	  requests, else we generate an authentication URL.
	 ************************************************/
	  if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
	  	$client->setAccessToken($_SESSION['access_token']);
	  } else {
	  	$authUrl = $client->createAuthUrl();
	  }
	/************************************************
	  If we're signed in we can go ahead and retrieve
	  the ID token, which is part of the bundle of
	  data that is exchange in the authenticate step
	  - we only need to do a network call if we have
	  to retrieve the Google certificate to verify it,
	  and that can be cached.
	 ************************************************/
	  if ($client->getAccessToken()) {
	  	$_SESSION['access_token'] = $client->getAccessToken();
	  	$token_data = $client->verifyIdToken()->getAttributes();
	  }
	  // echo pageHeader("User Query - Retrieving An Id Token");
	  if (
	  	$client_id == '850390802439-iam46vt2ah1i291fs4bhr3r8lp43miau.apps.googleusercontent.com'
	  	|| $client_secret == '-Fgv-YgBFMyPjjYDEztf3vWT'
	  	|| $redirect_uri == site_url('oauth/googleplus')) {
	  	// echo missingClientSecretsWarning();
	  }
	if (isset($authUrl)){
		redirect($authUrl);
	} 
		//is data found
	if (isset($token_data)) {
		$payload = $token_data['payload'];
		$id = $payload['sub'];
		$email = $payload['email'];
		$oauthProvider = 'googleplus';
		// $nclient = new Google_Client();
		// $plus = new Google_PlusService($nclient);
		// $me = $plus->people->get('me');
		//is user registered
		$userdata = $this->m_user->isRegistered($oauthProvider,$id);
		if(!empty($userdata)){//user is registered
			//set session
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
					echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Login Success');
						window.location.href='".site_url()."';
					</SCRIPT>");				
				} else { //jika statusnya banned
					echo 'gagal memasukan session';
				}			
			}		
		}else{//user not registered
			//redirect to register form
			$explodeEmail = explode('@',$email);
			$registerdata = array(
				'oauthProvider'=>'googleplus',
				'oauthId'=>$id,
				'email'=>$email,
				'username'=>$explodeEmail[0],
				'fullname'=>'',
				);
			$params['registerdata'] = $registerdata;
			$this->session->set_userdata($params);
			redirect(site_url('p/register'));
		}
	}
	}//end of google plus oauth

	//facebook oauth
	public function facebooklogin(){
		//is user registred
		$userdata = $this->m_user->isRegistered('facebook',$_GET['id']);//is user available on database
		if(!empty($userdata)){//user is registered
			//set session
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
					echo ("<SCRIPT LANGUAGE='JavaScript'>
						window.alert('Login Success');
						window.location.href='".site_url()."';
					</SCRIPT>");				
				} else { //jika statusnya banned
					echo 'gagal memasukan session';
				}			
			}	
		}else{//user not registered
			//do registration
			$registerdata = array(
				'oauthId'=>$_GET['id'],
				'oauthProvider'=>'facebook',
				'email'=>$_GET['email'],
				'fullname'=>$_GET['name'],
				'gender'=>$_GET['gender'],
				'username'=>$_GET['id'],//username facebook is facebook id
				);
			$params['registerdata'] = $registerdata;
			$this->session->set_userdata($params);
			redirect(site_url('p/register'));
		}
	}

}