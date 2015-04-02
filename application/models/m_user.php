<?php

class m_user extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	//student stats
	public function stats($materi='',$status=''){
		if(!empty($materi)){
			$this->db->join('user_course','user_course.id_user=user.id_user');
			$this->db->join('materi','materi.id_materi=user_course.id_materi');
			$this->db->where('materi.id_materi',$materi);//by kategori
			if(!empty($status)){//by students status
				$this->db->where('user_course.status',$status);//by kategori
			}
		}//count all students
		$this->db->where('user.verified',1);
		$result = $this->db->count_all_results('user');
		return $result;
	}
	// verification
	public function sendVerificationEmail($code,$email){
		$this->load->library('email');
		$this->email->initialize(array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  // 'smtp_timeout' => 7,
		  'smtp_port' => 465,
		  'smtp_user' => 'fossilandamigos@gmail.com',
		  'smtp_pass' => 'fossilamikom1993',
		  'crlf' => "\r\n",
		  'newline' => "\r\n",
		  'mailtype' => 'html',
		  'charset'   => 'iso-8859-1'
		));
		$this->email->from('fossilandamigos@gmail.com', 'linuxourse');
		$this->email->to($email);
		// $this->email->cc('another@another-example.com');
		// $this->email->bcc('them@their-example.com');
		$this->email->subject('Linuxourse Email Verfication');
		$message = '
		<h1>Last Step, Email Verification</h1>
		<p>click this link to verification your account <a target="_blank" href="'.site_url().'p/verification/'.$code.'">'.site_url().'m/verification/'.$code.'</a></p>
		<p>if link not working, request againt your verification via this link <a href="#">request verification</a></p>
		<p>don\'r reply this message, your message where go no where</p>
		<hr/>
		Linuxourse By ID More And Fossil Colaboration
		';
		$this->email->message($message);
		$this->email->set_newline("\r\n");
		$this->email->send();
		echo $this->email->print_debugger();
	}

	//all students
	public function allStudents($limit,$offset,$verfied){
		$sql = "SELECT user.id_user,user.username, user.email,user.fullname,user.status,user.register_date,user.last_login,user.status,country.country
		FROM user 
		INNER JOIN country ON country.id_country = user.id_country
		WHERE user.verified = $verfied AND user.level = 'student'
		LIMIT $offset,$limit";
		$query = $this->db->query($sql);
		$student = $query->result_array();
		return $student;
	}
	//total active student
	public function countActiveStudent(){
		$this->db->where('verified',1);
		$query = $this->db->get('user');
		$total = $query->num_rows();
		if($total>1000){
			$total = $total/1000;
			$total = $total.'K';
		}
		return $total;
	}

	//cek login
	public function can_login($username,$password){
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$query = $this->db->get('user');
        //struktur kendali untuk cek apakah data ada atau tidak
		if($query->num_rows() > 0){
            //memasukkan hasil eksekusi query kedalam row_array
			return $query->row_array();
		}
	}
	/*
	* ALL ABOUT STUDENT
	*/
	//show user by last login
	public function showLastLogin($limit,$offset){
		$this->db->limit($limit,$offset);
		$this->db->where('status','active');
		$this->db->order_by('last_login','desc');
		$query = $this->db->get('user');
		return $query->result_array();
	}
	//get students completed materi
	public function getCompletedStudents($idmateri,$limit,$offset){
		$params = array($idmateri,$limit,$offset);
		//join user_course and user
		$sql = "SELECT user.username FROM user INNER JOIN user_course
		ON user_course.id_user  = user.id_user
		WHERE user_course.id_materi = ?
		LIMIT ?,?";
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();//get all completed students by ajax
		}else{
			return array();//show empty array
		}
	}
	//student data by username
	public function getDataByUsername($username){
		$this->db->where('username',$username);
		$query = $this->db->get('user');
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	//count completed user on course
	public function countCompletedUserOnCourse($idmateri){
		error_reporting(0);
		//get id_level with the bigest level
		$sqllevel = "SELECT id_level FROM level WHERE id_materi = ? ORDER BY level DESC";
		$querylevel = $this->db->query($sqllevel,$idmateri);
		$querylevel = $querylevel->row_array();
		$completed_idlevel = $querylevel['id_level'];
		if(empty($completed_idlevel)){$completed_idlevel=0;}
		//get id_course with the biggest step and completed_idlevel
		$sqlcourse = "SELECT id_course FROM course WHERE id_level = ? ORDER BY step DESC";
		$querycourse = $this->db->query($sqlcourse,$completed_idlevel);
		$querycourse = $querycourse->row_array();
		$completed_idcourse = $querycourse['id_course'];
		if(empty($completed_idcourse)){$completed_idcourse=0;}
		//check total completed user
		$params = array($completed_idlevel,$completed_idcourse);
		$sql = "SELECT * FROM user_course WHERE id_level = ? AND id_course = ?";
		$query = $this->db->query($sql,$params);
		return $query->num_rows();
	}	
	//count active user on course
	public function countAciveUserOnCourse($idmateri){
		$this->db->where('status','incompleted');
		$this->db->where('id_materi',$idmateri);
		$query = $this->db->get('user_course');
		return $query->num_rows();
	}
	//has joined course
	public function hasJoinedMater($iduser,$idmateri){
		$this->db->where('id_user',$iduser);
		$this->db->where('id_materi',$idmateri);
		$query = $this->db->get('user_course');
		if($query->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}

	/*
	*all ABOUT OAUTH
	*/

	public function isRegistered($provider,$id){
		$this->db->where('oauthProvider',$provider);
		$this->db->where('oauthId',$id);
		$query=$this->db->get('user');
		if($query->num_rows()>0){//is registered
			return $query->row_array();
		}else{//not registered
			return array();
		}
	}
}