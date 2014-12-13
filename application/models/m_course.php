<?php

class m_course extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	/******************
	ALL ABOUT LEVEL
	*******************/
	//show other course
	public function showOtherMateri($params){//array = id materi
		
	}

	/******************
	ALL ABOUT LEVEL
	*******************/

	//show level completion after click my course
	public function showLevelCompletion($idMateri,$idLevel){ //id materi + last id level
		$params = array($idMateri,$idLevel);
		$sql = "SELECT level.level AS level, level.title AS title, level.id_level AS id_level
		FROM level
		INNER JOIN materi ON level.id_materi = materi.id_materi
		WHERE level.id_materi = ? AND level.id_level >= ?";
		$query = $this->db->query($sql,$params);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}

	/******************
	ALL ABOUT COURSE
	*******************/

	//count course step by user
	public function countCourseStep($x,$y){//x = course y = id level
		$this->db->where('id_course <=',$x);
		$this->db->where('id_level',$y);
		return $this->db->count_all_results('course');//return total number result
	}
	//count course by level
	public function countCourseByLevel($x){//x = id level
		$this->db->where('id_level',$x);
		return $this->db->count_all_results('course');//return total number result
	}
	//is new student or not
	public function doFirstCourse($param){//idstudent
		$this->db->where('id_user',$param);
		$this->db->where('id_materi',1);
		$query = $this->db->get('user_course');
		if($query->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}	
	//start first course
	public function newCourse($param){//idstudent
		$data = array(
			'id_user'=>$param,
			'id_materi'=>1,
			'id_level'=>1,
			'id_course'=>1,
			'startdate'=>date('Y-m-d h:i:s'),
			'lastdate'=>date('Y-m-d h:i:s'),
			);
		$this->db->insert('user_course',$data);//insert course to database
	}
	//show recent course by user
	public function recentCourseByUser($param){//id student
		$sql = "SELECT user_course.id_user_course AS 'id_user_course',level.level AS 'level',level.title AS 'title', user_course.id_materi AS 'id_materi',user_course.lastdate AS 'lastdate',user_course.id_level AS 'id_level',user_course.id_course AS 'id_course'
		FROM user_course
		INNER JOIN course ON user_course.id_course = course.id_course
		INNER JOIN level ON level.id_level = course.id_level
		INNER JOIN  materi ON materi.id_materi = level.id_materi
		WHERE user_course.id_user = ? 
		ORDER BY user_course.lastdate DESC
		LIMIT 1 OFFSET 0";
		$query = $this->db->query($sql,$param);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	//show user course
	public function courseByUser($param){//iduser
		$sql = "SELECT user_course.id_user_course AS 'id_user_course',level.level AS 'level',level.title AS 'title', user_course.id_materi AS 'id_materi',user_course.lastdate AS 'lastdate',user_course.id_level AS 'id_level',user_course.id_course AS 'id_course'
		FROM user_course
		INNER JOIN course ON user_course.id_course = course.id_course
		INNER JOIN level ON level.id_level = course.id_level
		INNER JOIN  materi ON materi.id_materi = level.id_materi
		WHERE user_course.id_user = ? 
		ORDER BY user_course.lastdate DESC";
		$query = $this->db->query($sql,$param);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}

	//show completed course by id level
	public function completedCourseByLevel($idlevel,$idcourse){
		$params = array($idlevel,$idcourse);
		$sql = "SELECT id_course,title FROM course
		WHERE id_level = ? AND id_course <= ?";
		$query = $this->db->query($sql,$params);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	//show uncompleted course by id level
	public function unCompletedCourseByLevel($idlevel,$idcourse){
		$params = array($idlevel,$idcourse);
		$sql = "SELECT id_course,title FROM course
		WHERE id_level = ? AND id_course > ?";
		$query = $this->db->query($sql,$params);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}	
	}
}