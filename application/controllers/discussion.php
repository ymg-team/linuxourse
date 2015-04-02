<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('application/controllers/base.php');//load base class
class discussion extends base { //class for public

	public function __construct()
	{
		parent::__construct();
		//only for member
		$this->load->model('m_discussion');
		$this->load->library('user_agent');
	}
	public function index(){
		echo 'empty';
	}
	// index page
	public function all(){
		//pagination setup
		$this->load->library('pagination');		
		$config['total_rows'] = $this->db->count_all('discussion');
		$config['per_page'] = 15; 
		$config['uri_segment'] = 3;
		$config['num_link'] = 5;
		$config['use_page_number'] = TRUE;
		$uri = $this->uri->segment(3);		
		//end of pagination setup
		$data['title'] = 'Discussion';
		$data['script'] = '<script>$(document).ready(function(){$("#discusion,#orderAll").addClass("activemenu")});</script>';
		if(!empty($_GET['type'])){//filter discussion by type
			$config['base_url'] = site_url('discussion/all?type='.$this->input->get('type',TRUE));
			$config['page_query_string'] = TRUE;
			$this->pagination->initialize($config);
			if(!$uri) {
				$uri = 0;
			}
			if($config['total_rows'] < 15) {
				$data['page'] = 1;
			} else {
				$data['page'] = $this->pagination->create_links();
			}			
			$data['view'] = $this->m_discussion->show_discussion_by_type($config['per_page'],$uri,$_GET['type']);
		} else{ //show all discussion			
			$config['base_url'] = site_url('discussion/all?type='.$this->input->get('type',TRUE));
			$config['page_query_string'] = TRUE;
			$this->pagination->initialize($config);
			if(!$uri) {
				$uri = 0;
			}
			if($config['total_rows'] < 15) {
				$data['page'] = 1;
			} else {
				$data['page'] = $this->pagination->create_links();
			}
			$data['view'] = $this->m_discussion->show_discussion($config['per_page'],$uri);
		}
		$data['result'] = $config['total_rows'];				
		$this->baseView('discussion/discussion',$data);
	}
	//show discussion order by
	public function orderby(){
		// pagination setup
		$this->load->library('pagination');		
		$config['total_rows'] = $this->db->count_all('discussion');
		$config['per_page'] = 15; 
		$config['uri_segment'] = 4;
		$config['num_link'] = 5;
		$config['use_page_number'] = TRUE;
		$uri = $this->uri->segment(4);
		$config['base_url'] = site_url('discussion/orderby/'.$this->uri->segment(3));
		$this->pagination->initialize($config);
		if(!$uri) {
			$uri = 0;
		}
		if($config['total_rows'] < 15) {
			$data['page'] = 1;
		} else {
			$data['page'] = $this->pagination->create_links();
		}
		// end of pagination setup
		//by views or top comment
		$uriact = $this->uri->segment(3);
		switch($uriact) {
			case 'views': //order by views
			$data['result'] = $config['total_rows'];
			$data['title'] = 'Order By Views';
			$data['script'] = '<script>$(document).ready(function(){$("#discusion,#orderViews").addClass("activemenu")});</script>';
			$data['view'] = $this->m_discussion->showDiscussionByViews($config['per_page'],$uri);
			break;			
			default:
			echo 'menu error';
			break;
		}		
		$this->baseView('discussion/discussion',$data);
	}
	//open discussion
	public function open(){
		if(!empty($_POST)){
			//Google Recaptcha Validation
			if(isset($_POST['g-recaptcha-response'])){
				$captcha=$_POST['g-recaptcha-response'];
			}
			$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcaGAQTAAAAANXY7MJQwxQXUK2ODKM0ZaO2Ij1K&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
			if($response.success==false || !$captcha){//not human
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Please check chaptcha form');
					parent.history.back();
				</SCRIPT>");
			}else{ //is human
			//add comment
				$session = $this->session->userdata['student_login'];
			if(empty($session)){//if not login
				redirect(site_url('p/login'));
			}
			$enc_id_discuss = $this->uri->segment(3);
			$id_discuss = str_replace('', '=', $enc_id_discuss);
			$id_discuss = base64_decode(base64_decode($id_discuss));
			$comment = $_POST['input_comment'];
			$id_user = $this->session->userdata['student_login']['id_user'];
			$now = date('Y-m-d h:i:s');
			$data = array(
				'id_discussion'=>$id_discuss,
				'id_user'=>$id_user,
				'commentdate'=>$now,
				'updatedate'=>$now,
				'comment'=>$comment
				);
			//print_r($data);
			$this->db->insert('discussion_comment',$data);
			redirect($this->agent->referrer());
		}
	}
		//else action form
	$id_discuss = $this->uri->segment(3);
	$id_discuss = base64_decode(base64_decode($id_discuss));
	$id_discuss = str_replace('', '=', $id_discuss);
	$data = array(
		'script'=>'<script>$(document).ready(function(){$("#discusion").addClass("activemenu")});</script>',
		'comments'=>$this->m_discussion->showCommentByIdDiscusion($id_discuss,10,0),
		'view'=>$this->m_discussion->showDiscussionById($id_discuss));
	$data['title'] = $data['view']['title'];
	$this->baseView('discussion/open.php',$data);
}
	//create new ask
public function creatediscuss(){
	$session = $this->session->userdata['student_login'];
		if(empty($session)){//if not login
			redirect(site_url('p/login'));
		}
		if(!empty($_POST)){ //is form submission
			$iduser = $this->session->userdata['student_login']['id_user'];
			$title = $_POST['input_title'];
			$content = $_POST['input_content'];
			$type = $_POST['input_type'];
			$postdate = '';
		}else{ //not form submission			
			$data = array(
				'title'=>'Create New Ask',
				'script'=>'<script>$(document).ready(function(){$("#discusion").addClass("activemenu")});</script>',
				);
			$this->baseView('discussion/newdiscuss',$data);
		}		
	}

	//delete topic
	public function deletetopic(){
		$idtopik = $_GET['id'];
		$idtopik = str_replace('','=',base64_decode(base64_decode($idtopik)));
		$this->db->where('id_discuss');
		$this->db->delete('discussion');
		redirect('discussion/mytopics');
	}

	//search discussion
	public function search(){
		if(!empty($_GET['q'])){
			$q = $_GET['q'];
			$change = array('+',' ');
			$q = str_replace($change, '-', $q);
			redirect(site_url('discussion/search/'.$q));
		}	else{
			$q = $this->uri->segment(3);
			$keyword = str_replace('-', ' ', $q);
		}

		//setup pagination
		$this->load->library('pagination');
		$config['total_rows'] = $this->m_discussion->count_search_discussion($keyword);//total row for search result
		$config['per_page'] = 15; 
		$config['uri_segment'] = 3;
		$config['num_link'] = 5;
		$config['use_page_number'] = TRUE;
		$config['base_url'] = site_url('discussion/search/'.$q);
		$this->pagination->initialize($config);
		if(empty($uri)) {
			$uri = 0;
		}
		//end of pagiation
		//jika melakukan pencarian
		$data = array(
			'result'=>$config['total_rows'],
			'recentq' => $keyword,
			'title'=>'Pencarian ',
			'page'=>$this->pagination->create_links(),
			'script'=>'<script>$(document).ready(function(){$("#discusion,#orderAll").addClass("activemenu")});</script>',
			'view'=>$this->m_discussion->search_discussion($config['per_page'],$uri,$keyword),//tampilan view
			);
		$this->baseView('discussion/discussion',$data);
	}

	/*
	* ALl ABOUT COMMENT
	*/


	/*
	* CREATE OR UPDATE
	*/

	//create new topic
	public function addtopic(){
		//Google Recaptcha Validation
		if(isset($_POST['g-recaptcha-response'])){
			$captcha=$_POST['g-recaptcha-response'];
		}
		$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcaGAQTAAAAANXY7MJQwxQXUK2ODKM0ZaO2Ij1K&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
			if($response.success==false || !$captcha){//not human
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Please check chaptcha form');
					parent.history.back();
				</SCRIPT>");
			}else{ //is human
				$title = $_POST['input_title'];
				$content = $_POST['input_content'];
				$type = $_POST['input_type'];
				$this->load->library('form_validation');
				$this->form_validation->set_rules('input_title', 'title', 'required|min_length[5]|max_length[50]|xss_clean');
				$this->form_validation->set_rules('input_content', 'content', 'required|min_length[5]|max_length[500]|xss_clean');
		if($this->form_validation->run() && $captcha == $this->session->userdata('mycaptcha')){//is data valid
			$data = array(
				'title'=>$title,
				'content'=>strip_tags($content),
				'postdate'=>date('Y-m-d h:i:s'),
				'updatedate'=>date('Y-m-d h:i:s'),
				'id_user'=>$this->session->userdata['student_login']['id_user'],
				'type'=>$type,
				'views'=>0
				);
			if($this->db->insert('discussion',$data)){
				//get lattest id_discussion by id_user
				$this->db->where('id_user',$this->session->userdata['student_login']['id_user']);
				$this->db->order_by('updatedate','desc');
				$query = $this->db->get('discussion');
				$query = $query->row_array();
				$id_discussion = base64_encode(base64_encode($query['id_discuss']));
				$id_discussion = str_replace('=', '', $id_discussion);
				redirect(site_url('discussion/open/'.$id_discussion));//redirect to open mode
			}else{
				echo 'error add topic';
			}
		}else{//not valid
			// captcha
			$this->load->helper('captcha');
			$tgl = date('d');
			$minutes = date('m');
			$second = date('s');
			$key = $tgl * $minutes * $second ;
			$vals = array(
				'word' => $key,
				'img_path'   => './assets/img/captcha/',
				'img_url'    => base_url('assets/img/captcha').'/',
				'img_width'  => '200',
				'img_height' => 30,
				'border' => 0,
				'expiration' => 7200
				);
	  		// create captcha image
			$cap = create_captcha($vals);
			// store the captcha word in a session
			$this->session->set_userdata('mycaptcha', $cap['word']);
			// end of captcha config
			$data = array(
				'title'=>'Create New Ask',
				'image'=>$cap['image'],
				'type'=>$type,
				'captcha'=>$captcha,
				'isedit'=>false,
				'script'=>'<script>$(document).ready(function(){$("#discusion").addClass("activemenu")});</script>',
				);
			$this->baseView('discussion/editdiscuss',$data);
		}
	}
}
	//edit topic
public function edittopic(){
	$this->load->library('form_validation');
	$enc_id_discuss = $this->uri->segment(3);
		//descrypt
	$id_discuss = str_replace('', '=', $enc_id_discuss);
		$id_discuss = base64_decode(base64_decode($id_discuss));//get real id discuss
		if(!empty($_POST)){//submit data
			redirect($this->aggent->referrer());//back to last page
		}
		$session = $this->session->userdata['student_login'];
		if(empty($session)){//if not login
			redirect(site_url('p/login'));
		}
		//is this topic create by now login user
		if($this->m_discussion->checkOwner($id_discuss,$this->session->userdata['student_login']['id_user'])){
			//get discussion by id
			$data = array(
				'title'=>'Edit Topic',
				'view'=>$this->m_discussion->showDiscussionById($id_discuss),
				'isedit'=>true,
				'enc_id_discuss'=>$enc_id_discuss,
				);
			$data['type']=$data['view']['type'];
			$this->baseView('discussion/editdiscuss',$data);
		}else{
			echo 'you re no topic owner';
		}
	}
	//proc edit topic
	public function procEditTopic(){
		//Google Recaptcha Validation
		if(isset($_POST['g-recaptcha-response'])){
			$captcha=$_POST['g-recaptcha-response'];
		}
		$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcaGAQTAAAAANXY7MJQwxQXUK2ODKM0ZaO2Ij1K&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
			if($response.success==false || !$captcha){//not human
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Please check chaptcha form');
					parent.history.back();
				</SCRIPT>");
			}else{ //is human
				$content = $_POST['input_content'];
				$referrer = $this->agent->referrer();
		//form validation
				$this->load->library('form_validation');
				$this->form_validation->set_rules('input_content', 'content', 'required|min_length[5]|max_length[500]|xss_clean');
		//is chaptcha correct
		if(!empty($content)){//if captcha is correct
			if($this->form_validation->run()){//form validation is good
				//update database
				$this->db->where('id_discuss',$id_discuss);//where id discuss
				$data = array(
					'title'=>$title,
					'content'=>$content,
					'updatedate'=>date('Y-m-d h:i:s'),
					);
				if($this->db->update('discussion',$data)){
					//$enc_id_discuss;
					redirect(site_url('discussion/open/'.$enc_id_discuss));
				}else{
					echo 'gagal memasukan ke database';
				}
			}else{//form validation not work
				echo 'form validation not work';
			}
		}else{//captcha is wrong
			echo 'please type a content';
		}
	}
}
	//edit answer
public function editanswer(){
	$this->load->library('form_validation');
	//get id answer
	$dec_id_answer = $this->uri->segment(3);
	$dec_id_answer = str_replace('', '=', $dec_id_answer);
	$id_answer = base64_decode(base64_decode($dec_id_answer));
	$data = array(
		'id_answer'=>$this->uri->segment(3),
		'title'=>'edit comment',
		'view'=>$this->m_discussion->answerById($id_answer),
		);
	$this->baseView('discussion/editanswer',$data);
}
	//process edit answer
public function procEditAnswer(){
	//Google Recaptcha Validation
	if(isset($_POST['g-recaptcha-response'])){
		$captcha=$_POST['g-recaptcha-response'];
	}
	$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcaGAQTAAAAANXY7MJQwxQXUK2ODKM0ZaO2Ij1K&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
			if($response.success==false || !$captcha){//not human
				echo ("<SCRIPT LANGUAGE='JavaScript'>
					window.alert('Please check chaptcha form');
					parent.history.back();
				</SCRIPT>");
			}else{ //is human
				$id_discuss = $_POST['id_discuss'];
				$answer = $_POST['input_content'];
		//jika tidak login

		//get id answer
				$dec_id_answer = $this->uri->segment(3);
				$dec_id_answer = str_replace('', '=', $dec_id_answer);
				$id_answer = base64_decode(base64_decode($dec_id_answer));
		//encrypt id discuss
				$enc_id_discuss = base64_encode(base64_encode($id_discuss));
				$enc_id_discuss = str_replace('=', '', $enc_id_discuss);
		//cek apakah komentar milik user yang sedang login
		if($this->m_discussion->isMyAnswer($id_answer)==FALSE){ //not my answer
			echo 'it\'s not my answer';
		}
		//is my answer
		$data = array(
			'comment'=>$answer,
			'updatedate'=>date('Y-m-d h:i:s'));
		$this->db->where('id_comment',$id_answer);
		if($this->db->update('discussion_comment',$data)){
			// echo $enc_id_discuss;
			// echo $answer;
			redirect(site_url('discussion/open/'.$enc_id_discuss));
		}else{
			echo 'error save to database';
		}
	}
}
public function deleteAnswer(){
	$id = $_GET['id'];
	$id = str_replace('', '=', base64_decode(base64_decode($id)));
	$this->db->where('id_comment',$id);
	$this->db->delete('discussion_comment');
	redirect(site_url('discussion/myanswers'));
}
	/*
	* Action after login
	*/

	//show all topics added by me
	public function mytopics(){
		//if not login redirect to discussion
		$session = $this->session->userdata['student_login']['id_user'];
		if(empty($session)){
			redirect(site_url('discussion/all'));
		}
		//pagination setup
		$this->load->library('pagination');
		$config = array(
			'total_rows'=> $this->m_discussion->countMyTopics(),
			'per_page'=>15,
			'uri_segment'=>3,
			'num_link'=>5,
			'use_page_number'=>TRUE,
			);
		$uri = $this->uri->segment(3);
		$config['base_url'] = site_url('discussion/mytopics');
		$this->pagination->initialize($config);
		if(!$uri) {
			$uri = 0;
		}
		if($config['total_rows'] < 15) {
			$data['page'] = 1;
		} else {
			$data['page'] = $this->pagination->create_links();
		}
		//end of pagination setup
		$data['title']='My Topics';
		$data['view']=$this->m_discussion->myTopics($config['per_page'],$uri);
		$data['script']='<script>$(document).ready(function(){$("#discusion,#orderTopics").addClass("activemenu")});</script>';
		$this->baseView('discussion/mytopics',$data);
	}
	//show all answer added by me
	public function myanswers(){
		//if not login redirect to discussion
		$session = $this->session->userdata['student_login']['id_user'];
		if(empty($session)){
			redirect(site_url('discussion/all'));
		}
		//pagination setup
		$this->load->library('pagination');
		$config = array(
			'total_rows'=> $this->m_discussion->countMyAnswer(),
			'per_page'=>15,
			'uri_segment'=>3,
			'num_link'=>5,
			'use_page_number'=>TRUE,
			);
		$uri = $this->uri->segment(3);
		$config['base_url'] = site_url('discussion/myanswer');
		$this->pagination->initialize($config);
		if(!$uri) {
			$uri = 0;
		}
		if($config['total_rows'] < 15) {
			$data['page'] = 1;
		} else {
			$data['page'] = $this->pagination->create_links();
		}
		//end of pagination setup
		$data['title']='My Topics';
		$data['view']=$this->m_discussion->myAnswers($config['per_page'],$uri);
		$data['script']='<script>$(document).ready(function(){$("#discusion,#orderAnswers").addClass("activemenu")});</script>';
		$this->baseView('discussion/myanswers',$data);
	}

	/////////////////////////
	/// AJAX ONLY ////
	/////////////////////////
	//add like or dislike on comment
	public function commentAction(){
		$iduser = $_POST['iduser'];
		$idcomment = $_POST['idcomment'];
		$give = $_POST['give'];
		//if user has do action on same comment
		if($this->m_discussion->isUserAction($iduser,$idcomment)){
			//update
			$this->db->where('id_comment',$idcomment);
			$this->db->where('id_user',$iduser);
			$this->db->update('discussion_comment_action',array('give'=>$give));
		}else{
			//insert
			$data=array(
				'id_comment'=>$idcomment,
				'id_user'=>$iduser,
				'give'=>$give
				);
			$this->db->insert('discussion_comment_action',$data);
		}
		//ajax view response
		$sql = "SELECT * FROM discussion_comment_action WHERE give = '".$give."'";
		$query = $this->db->query($sql);
		echo $query->num_rows();
	}
	//update count
	public function updateCount(){
		$give = $_POST['give'];
		$idcomment = $_POST['idcomment'];
		echo $this->m_discussion->countCommentAction($give,$idcomment);
	}
}