<?php

class m_news extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	//menampilkan semua berita
	public function news_list($limit,$offset){
		$sql = "SELECT user.username AS 'username', news.id_news AS 'id_news',news.title AS 'title',news.updatedate AS 'updatedate',news.content AS 'content'
		FROM news INNER JOIN user ON user.id_user = news.id_user
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
		$sql = "SELECT user.username AS 'username', news.id_news AS 'id_news',news.title AS 'title',news.updatedate AS 'updatedate',news.content AS 'content'
		FROM news INNER JOIN user ON user.id_user = news.id_user
		WHERE news.id_news = ?";
		$query = $this->db->query($sql,$id);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
}