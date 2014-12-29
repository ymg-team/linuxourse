<?php

class m_discussion extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	/*
	* ALL ABOUT DISCUSSION
	*/
	//show all discussion by id
	public function showDiscussionById($id_discuss){
		$sql = "SELECT user.username AS 'username',user.pp AS 'pp',discussion.id_discuss AS 'id_discuss',
		discussion.title AS 'title',discussion.content AS 'content',discussion.updatedate AS 'updatedate',
		discussion.type AS 'type',discussion.views AS 'views'
		FROM discussion
		INNER JOIN user ON user.id_user = discussion.id_user
		WHERE discussion.id_discuss = ?";
		$query = $this->db->query($sql,$id_discuss);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	//show all discussion no filter
	public function show_discussion($limit,$offset){
		$sql = "SELECT user.username AS 'username',user.pp AS 'pp',discussion.id_discuss AS 'id_discuss',
		discussion.title AS 'title',discussion.content AS 'content',discussion.updatedate AS 'updatedate',
		discussion.type AS 'type',discussion.views AS 'views'
		FROM discussion
		INNER JOIN user ON user.id_user = discussion.id_user
		ORDER BY discussion.id_discuss DESC
		LIMIT ".$offset." , ".$limit;
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	//show all discussion order by views
	public function showDiscussionByViews($limit,$offset){
		$sql = "SELECT user.username AS 'username',user.pp AS 'pp',discussion.id_discuss AS 'id_discuss',
		discussion.title AS 'title',discussion.content AS 'content',discussion.updatedate AS 'updatedate',
		discussion.type AS 'type',discussion.views AS 'views'
		FROM discussion
		INNER JOIN user ON user.id_user = discussion.id_user
		ORDER BY discussion.views DESC
		LIMIT ".$offset." , ".$limit;
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	//show all discussion filter by type
	public function show_discussion_by_type($limit,$offset,$type){
		$sql = "SELECT user.username AS 'username',user.pp AS 'pp',discussion.id_discuss AS 'id_discuss',
		discussion.title AS 'title',discussion.content AS 'content',discussion.updatedate AS 'updatedate',
		discussion.type AS 'type',discussion.views AS 'views'
		FROM discussion
		INNER JOIN user ON user.id_user = discussion.id_user
		WHERE discussion.type = '".$type."' 
		LIMIT ".$offset." , ".$limit;
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	//sort discussion by views
	public function show_discussion_by_views($limit,$offset){
		$sql = "SELECT user.username AS 'username',user.pp AS 'pp',discussion.id_discuss AS 'id_discuss',
		discussion.title AS 'title',discussion.content AS 'content',discussion.updatedate AS 'updatedate',
		discussion.type AS 'type',discussion.views AS 'views'
		FROM discussion
		INNER JOIN user ON user.id_user = discussion.id_user
		ORDER BY discussion.views DESC
		LIMIT ".$offset." , ".$limit;
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	//cek owner
	public function checkOwner($id_discuss,$id_user){
		$this->db->where('id_user',$id_user);
		$this->db->where('id_discuss',$id_discuss);
		$query = $this->db->get('discussion');
		if($query->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	/*
	* ALL ABOUT COMMENT
	*/

	//count comment
	public function count_comment($id_discussion){
		$this->db->where('id_discussion',$id_discussion);
		return $count =  $this->db->count_all_results('discussion_comment');
	}
	public function showCommentByIdDiscusion($id_discuss,$limit,$offset){
		$sql = "SELECT user.username AS 'username',user.pp AS 'pp',discussion_comment.id_comment AS 'id_comment',
		discussion_comment.commentdate AS 'commentdate',discussion_comment.updatedate AS 'commentupdatedate',
		discussion_comment.comment AS 'comment'
		FROM discussion_comment
		INNER JOIN user ON discussion_comment.id_user = user.id_user
		WHERE discussion_comment.id_discussion = ?";
		$query = $this->db->query($sql,$id_discuss);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	/*
	* ALL about show data after login
	*/
	//get my topics
	public function myTopics($limit,$offset){
		$myid = $this->session->userdata['student_login']['id_user'];
		$sql = "SELECT user.username AS 'username',user.pp AS 'pp',discussion.id_discuss AS 'id_discuss',
		discussion.title AS 'title',discussion.content AS 'content',discussion.updatedate AS 'updatedate',
		discussion.type AS 'type',discussion.views AS 'views'
		FROM discussion
		INNER JOIN user ON user.id_user = discussion.id_user
		WHERE discussion.id_user = ?
		LIMIT ".$offset." , ".$limit;
		$query = $this->db->query($sql,$myid);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	//count my topics
	public function countMyTopics(){
		$myid = $this->session->userdata['student_login']['id_user'];
		$this->db->where('id_user',$myid);
		$query = $this->db->get('discussion');
		return $query->num_rows();
	}
	//get my comments
	public function myAnswers($limit,$offset){
		$myid = $this->session->userdata['student_login']['id_user'];
		$sql = "SELECT discussion.type AS 'type',discussion.title AS 'title',user.username AS 'username', discussion_comment.id_discussion AS 'id_discuss', discussion_comment.updatedate AS 'updatedate',
		discussion_comment.commentdate AS 'commentdate',discussion_comment.comment AS 'comment', discussion_comment.id_comment AS 'id_comment',user.pp AS 'pp'
		FROM discussion_comment 
		INNER JOIN user ON discussion_comment.id_user = user.id_user
		INNER JOIN discussion ON discussion.id_discuss = discussion_comment.id_discussion
		WHERE discussion_comment.id_user = ?";
		$query = $this->db->query($sql,$myid);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	//count my comments
	public function countMyAnswer(){
		$myid = $this->session->userdata['student_login']['id_user'];
		$this->db->where('id_user',$myid);
		$query = $this->db->get('discussion_comment');
		return $query->num_rows();
	}
}