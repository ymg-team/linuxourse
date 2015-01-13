<?php

class m_course extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	/******************
	ALL ABOUT USER COURSE
	*******************/
	//usercourse data by id user course
	public function detUserCourse($idUserCourse){
		$sql = "SELECT course.step AS 'step',user_course.id_level AS 'id_level',level.level AS 'level',level.title AS 'leveltitle',user_course.id_materi as 'id_materi',
		user_course.id_user AS 'id_user',user_course.id_course AS 'id_course'
		FROM user_course
		INNER JOIN course ON user_course.id_course = course.id_course
		INNER JOIN level ON user_course.id_level = level.id_level
		WHERE user_course.id_user_course = ?";
		$query = $this->db->query($sql,$idUserCourse);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			redirect(site_url());
		}
	}
	//course list menu
	public function courseListMenu($step,$idlevel,$idmateri){
		//is step and level
		$params = array($step,$idlevel);
		$sql = "SELECT step FROM course WHERE step > ".$step." AND id_level = ".$idlevel;
		$query = $this->db->query($sql);
		if($query->num_rows>0){//is new level
			$sql = "SELECT id_level,level FROM level WHERE id_level = ?";
			$query = $this->db->query($sql,$idlevel);
			return $query->row_array();
		}else{//not new level
			$step = $step+1;
			$sql = "SELECT level.id_level AS 'id_level',level.level 
			FROM level INNER JOIN course 
			ON course.id_level = level.id_level
			WHERE course.step = ".$step." AND level.id_materi = ".$idmateri;
			$query = $this->db->query($sql);
			return $query->row_array();
		}
	}
	//usercourse data by id user n materi
	public function detUserCourseByMateriNUser($idmateri,$iduser){
		$params = array($idmateri,$iduser);
		$sql = "SELECT user_course.id_user_course AS 'id_user_course', course.step as 'step',user_course.id_level as 'id_level',user_course.id_materi as 'id_materi',
		user_course.id_user as 'id_user',user_course.id_course as 'id_course',level.level AS 'level'
		FROM user_course
		INNER JOIN course ON user_course.id_course = course.id_course
		INNER JOIN level ON user_course.id_level = level.id_level
		WHERE user_course.id_materi = ? AND user_course.id_user = ?";
		$query = $this->db->query($sql,$params);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			redirect(site_url());
		}
	}
	//check, is next step available
	public function isNextCourseAvailable($idcourse,$idlevel){
		$params = array($idlevel,$idcourse);
		$sql = 'SELECT id_course FROM course
		WHERE id_level = ? AND step > (SELECT step FROM course WHERE id_course = ?)';
		$query = $this->db->query($sql,$params);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	//check, is next level available
	public function isNextLevelAvailable($idlevel,$idmateri){
		$params = array($idlevel,$idmateri);
		$sql = "SELECT id_level FROM level 
		WHERE level > (SELECT level FROM level WHERE id_level = ?)";
		$query = $this->db->query($sql, $params);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	//get id course by id level
	public function getIdCourseByLevel($idlevel){
		$this->db->where('id_level',$idlevel);
		$this->db->select('id_course');
		$this->db->order_by('step','asc');
		$query = $this->db->get('course');
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	//get course detail by id_user_level
	public function detCourseByUserCourse($idusercourse){
		$sql = "SELECT course.step AS 'step',materi.id_materi AS 'idmateri' FROM course
		INNER JOIN user_course ON user_course.id_course = course.id_course
		INNER JOIN materi ON user_course.id_materi = materi.id_materi
		WHERE user_course.id_user_course = ?";
		$query = $this->db->query($sql,$idusercourse);
		$recentusercourse = $query->row_array();
		//get recent id_materi AND course step
		$rec_idmateri = $recentusercourse['idmateri'];//id materi
		$rec_step = $recentusercourse['step'];//course step
		$params = array($rec_step,$rec_idmateri);
		$sql = "SELECT course.step AS 'step',course.command AS 'command' FROM course 
		INNER JOIN level ON level.id_level = course.id_level
		INNER JOIN materi ON materi.id_materi = level.id_materi 
		WHERE course.step > ? AND materi.id_materi = ?";
		$query = $this->db->query($sql,$params);
		return $query->row_array();//get lattest course data
	}

	/******************
	ALL ABOUT MATERI
	*******************/
	//show all materi
	public function showAllMateri(){//id materi
		$query = $this->db->get('materi');//get all materi
		return $query->result_array();
	}
	//show all my id materi
	public function showMyIdMateri($id){
		$this->db->select('id_materi');
		$query = $this->db->get('user_course');
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	//show materi by id_materi
	public function detMateri($id){
		$this->db->where('id_materi',$id);
		$query = $this->db->get('materi');
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	//show course by materi
	public function showSyllabusByMateri($id){//id materi
		$sql = "SELECT course.id_course AS 'id_course',course.title AS 'title_course',course.description AS 'course_description',course.estimate AS 'course_estimate'
		FROM course
		INNER JOIN level ON course.id_level = level.id_level
		INNER JOIN materi ON level.id_materi = materi.id_materi
		WHERE materi.id_materi = ?";
		$query = $this->db->query($sql,$id);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	//cek is user have started course
	public function isStudentStarted($x,$y){//id user | id materi
		$this->db->where('id_user',$x);
		$this->db->where('id_materi',$y);
		$query = $this->db->get('user_course');
		if($query->num_rows()>0){
			return true;
		}else{
			return false;
		}

	}
	//show all id materi have user choose

	/******************
	ALL ABOUT LEVEL
	*******************/
	//get recent level
	public function getMyRecentLevel($x,$y){//x =course y = materi
		$params = array($x,$y);
		$sql = "SELECT level.level AS 'level' FROM level
		INNER JOIN user_course ON level.id_level = user_course.id_level
		WHERE user_course.id_user = ? AND user_course.id_materi = ?";
		$query = $this->db->query($sql,$params);
		$user_course = $query->row_array();
		return $user_course['level'];
	}
	//show level by id materi
	public function showLevelByMateri($id){
		$this->db->where('id_materi',$id);
		$this->db->order_by('level','ASC');
		$query = $this->db->get('level');
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	//show level completion after click my course
	public function showLevelCompletion($idMateri,$idLevel){ //id materi + last id level
		$params = array($idMateri,$idLevel);
		$sql = "SELECT level.level AS level, level.title AS title, level.id_level AS id_level
		FROM level
		INNER JOIN materi ON level.id_materi = materi.id_materi
		WHERE level.id_materi = ?";
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
	//count DateDiff
	public function countDiffCourse($iduser,$idmateri){
		$sql = "SELECT DATEDIFF(NOW(),startdate) AS 'starteddate' FROM user_course
		WHERE id_user = ".$iduser." AND id_materi = ".$idmateri;
		$query =$this->db->query($sql);
		$query = $query->row_array();
		return $query['starteddate'];
	}
	//get recent step
	public function getMyRecentCourseStep($x,$y){//x =course y = materi
		$params = array($x,$y);
		$sql = "SELECT course.step AS 'step' FROM course
		INNER JOIN user_course ON course.id_course = user_course.id_course
		WHERE user_course.id_user = ? AND user_course.id_materi = ?";
		$query = $this->db->query($sql,$params);
		$user_course = $query->row_array();
		return $user_course['step'];
	}
	//get recent course id
	public function getMyRecentCourseId($x,$y){//x =course y = materi
		$params = array($x,$y);
		$sql = "SELECT course.id_course AS 'id_course' FROM course
		INNER JOIN user_course ON course.id_course = user_course.id_course
		WHERE user_course.id_user = ? AND user_course.id_materi = ?";
		$query = $this->db->query($sql,$params);
		$user_course = $query->row_array();
		return $user_course['id_course'];
	}
	//count course step by user by id Materi
	public function countCourseStepByMateri($x,$y,$z){//x = materi y = level z = course
		//get all course where level < current level
		$params_f = array($y,$x);
		$sql_f = "SELECT course.id_course 
		FROM course 
		INNER JOIN level ON course.id_level = level.id_level
		INNER JOIN materi ON level.id_materi = materi.id_materi
		WHERE course.id_level < ? AND level.id_materi = ?";
		$count_f = $this->db->query($sql_f,$params_f);
		$count_f = $count_f->num_rows();
		if(empty($count_f)){$count_f = 0;}

		//get step by id_course
		$sql = "SELECT step FROM course WHERE id_course = ?";
		$query = $this->db->query($sql,$z);
		$query = $query->row_array();
		$step = $query['step'];
		//get level by id_level
		$sql = "SELECT level FROM level WHERE id_level = ?";
		$query = $this->db->query($sql,$y);
		$query = $query->row_array();
		$level = $query['level'];
		$params = array($step,$level,$x);
		$sql = "SELECT course.step AS 'step',level.level AS 'level' FROM course 
		INNER JOIN level ON course.id_level = level.id_level
		INNER JOIN materi ON level.id_materi = materi.id_materi
		WHERE course.step <= ? AND level = ? AND level.id_materi = ?";
		$count_s = $this->db->query($sql,$params);
		$count_s = $count_s->num_rows();
		return $count_f + $count_s;
	}
	//count course by id materi
	public function countCourseByMateri($x){//x = id level
		$sql = "SELECT course.id_course AS 'id_course' FROM course 
		INNER JOIN level ON course.id_level = level.id_level
		INNER JOIN materi ON level.id_materi = materi.id_materi
		WHERE level.id_materi = ?";
		$query = $this->db->query($sql,$x);
		return $query->num_rows();
	}
	//count course step by user by id level
	public function countCourseStepByLevel($x,$y){//x = course step y = id level
		$params = array($x,$y);
		$sql = "SELECT step FROM course WHERE step <= ? AND id_level = ?";
		$query = $this->db->query($sql,$params);
		return $query->num_rows();
	}
	//show course by level
	public function courseByLevel($x){//x = id level
		$sql = "SELECT id_course, step, course.id_level AS 'id_level',course.title AS 'title',course.description AS 'description',
		level.level AS 'level' 
		FROM course 
		INNER JOIN level ON level.id_level = course.id_level
		WHERE course.id_level = ?
		ORDER BY step ASC";
		$query =  $this->db->query($sql,$x);//return total number result
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	//show course by id_course
	public function detCourse($step,$idmateri){//get detail course by step and idmateri
		$params = array($step,$idmateri);
		$sql = "SELECT course.title AS 'title', course.description AS 'description',course.estimate AS 'estimate',
		course.course_case_en AS 'course_case_en', course.course_case_id AS 'course_case_id', course.hint_id AS 'hint_id',
		course.hint_en AS 'hint_en', course.custom_controller AS 'custom_controller' 
		FROM course 
		INNER JOIN level ON level.id_level = course.id_level
		INNER JOIN materi ON materi.id_materi = level.id_materi
		WHERE course.step = ? AND materi.id_materi = ?";
		$query = $this->db->query($sql,$params);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	//count estimate course by level
	public function countEstimateCourseByLevel($x){//id level
		$this->db->where('id_level',$x);
		$this->db->select_sum('estimate');
		$query = $this->db->get('course');
		if($query->num_rows()>0){
			return $query->row_array();//return to show estimate result
		}else{
			return $array();//return to empry array
		}
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
			'status'=>'incompeted',
			);
		$this->db->insert('user_course',$data);//insert course to database
	}
	//show recent course by user
	public function recentCourseByUser($param){//id student
		$sql = "SELECT course.step AS 'step',user_course.id_user_course AS 'id_user_course',materi.title AS 'materi_title',level.level AS 'level',level.title AS 'title', user_course.id_materi AS 'id_materi',user_course.lastdate AS 'lastdate',user_course.id_level AS 'id_level',user_course.id_course AS 'id_course'
		FROM user_course
		INNER JOIN course ON user_course.id_course = course.id_course
		INNER JOIN level ON level.id_level = course.id_level
		INNER JOIN  materi ON materi.id_materi = level.id_materi
		WHERE user_course.id_user = ? 
		ORDER BY user_course.lastdate DESC";
		$query = $this->db->query($sql,$param);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	//show user course
	public function courseByUser($param){//iduser
		$sql = "SELECT user_course.id_user_course AS 'id_user_course',level.level AS 'level',materi.title AS 'title', user_course.id_materi AS 'id_materi',user_course.lastdate AS 'lastdate',user_course.id_level AS 'id_level',user_course.id_course AS 'id_course'
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
	//show user course bu username
	public function courseByUsername($param){//iduser
		$sql = "SELECT user_course.id_user_course AS 'id_user_course',level.level AS 'level',materi.title AS 'title', user_course.id_materi AS 'id_materi',user_course.lastdate AS 'lastdate',user_course.id_level AS 'id_level',user_course.id_course AS 'id_course'
		FROM user_course
		INNER JOIN course ON user_course.id_course = course.id_course
		INNER JOIN level ON level.id_level = course.id_level
		INNER JOIN  materi ON materi.id_materi = level.id_materi
		INNER JOIN user ON user.id_user = user_course.id_user
		WHERE user.username = ? 
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