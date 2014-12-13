<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class base extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//load all model
		$this->load->model(array('m_user','m_course'));//auto load model
	}

	public function index()
	{
		echo '404';	 
	}

	//base view
	public function baseView($x="",$data=""){ //x = view anak , y = data
		$data['childView'] = $x;
		$this->load->view('base/baseView',$data);
	}
	//member only
	public function memberOnly(){
		if(empty($this->session->userdata['student_login']['id_user'])){
			redirect(site_url());
		}
	}
	//admin only
	public function adminOnly(){
		if(empty($this->session->userdata['admin_login']['id_user'])){
			redirect(site_url('manage'));
		}
	}
}

/* End of file base.php */
/* Location: ./application/controllers/base/base.php */