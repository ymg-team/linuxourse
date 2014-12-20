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
		$this->db->where('status','completed');
		$this->db->where('id_materi',$idmateri);
		$query = $this->db->get('user_course');
		return $query->num_rows();
	}	
	//count active user in course
	public function countAciveUserOnCourse($idmateri){
		$this->db->where('status','incompleted');
		$this->db->where('id_materi',$idmateri);
		$query = $this->db->get('user_course');
		return $query->num_rows();
	}

	/*
	* ALL ABOUT ADMIN
	*/
}