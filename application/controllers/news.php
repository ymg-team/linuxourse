<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('application/controllers/base.php');//load base class
class news extends base { //class for public

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('m_news'));
		$this->load->library(array('pagination','user_agent'));
	}
	//index is not found
	public function index(){
		//setup pagination
		$config['per_page'] = 6;
		$config['uri_segment'] = 4;
		$config['num_link'] = 4;
		$config['page_query_string'] = TRUE;
		$config['base_url'] = site_url().'/news?'.$this->input->get('', TRUE);
		$config['total_rows'] = $this->db->count_all('news');
		$this->pagination->initialize($config);
		if(!empty($_GET['per_page'])) {
			$uri = $_GET['per_page'];
		} else {
			$uri = 0;
		}
		$data = array(
			'title'=>'News',
			'view'=>$this->m_news->news_list($config['per_page'],$uri),
			);
		$this->baseView('news/list',$data);
	}

	public function read(){
		$id = $this->uri->segment(3);
		$id = str_replace('', '=', $id);
		$id = base64_decode(base64_decode($id));
		$title = str_replace('-', ' ', $this->uri->segment(4));
		//get data by id news
		$data = array(
			'view'=>$this->m_news->news_item($id),//get news item
			'title'=>$title
			);
		$this->baseView('news/item',$data);
	}
}