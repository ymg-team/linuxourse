<?php

class m_news extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	//show all published news
	public function news_list($limit,$offset){
		$sql = "SELECT news.id_news,user_manage.username AS 'username', news.id_news AS 'id_news',news.title AS 'title',news.updatedate AS 'updatedate',news.content AS 'content',
		news.postdate,news.status
		FROM news INNER JOIN user_manage ON user_manage.id_user_manage = news.id_user
		WHERE news.status = 'published'
		ORDER BY news.updatedate DESC
		LIMIT ".$limit." OFFSET ".$offset;
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	//show all draft news
	public function draftNewsList($limit,$offset){
		$sql = "SELECT news.id_news,user_manage.username AS 'username', news.id_news AS 'id_news',news.title AS 'title',news.updatedate AS 'updatedate',news.content AS 'content',
		news.postdate,news.status
		FROM news INNER JOIN user_manage ON user_manage.id_user_manage = news.id_user
		WHERE news.status = 'draft'
		ORDER BY news.id_news DESC
		LIMIT ".$limit." OFFSET ".$offset;
		$query = $this->db->query($sql);
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	//menampilkan item berita
	public function news_item($id){
		$sql = "SELECT user_manage.username AS 'username', news.id_news AS 'id_news',news.title AS 'title',news.updatedate AS 'updatedate',news.content AS 'content'
		FROM news INNER JOIN user_manage ON user_manage.id_user_manage = news.id_user
		WHERE news.id_news = ?";
		$query = $this->db->query($sql,$id);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}

}