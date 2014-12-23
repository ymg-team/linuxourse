<?php

class m_user extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
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
	//count active student on 1 materi

	/*
	* ALL ABOUT ADMIN
	*/
}