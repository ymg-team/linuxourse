<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('application/controllers/base.php');//load base class
class course extends base { //class for public

	public function __construct()
	{
		parent::__construct();
		//only for member
		$this->memberOnly();
	}

	// index page
	public function index(){
		if(!empty($_GET['id'])){
			$idCourse = $_GET['id'];
		}else{
			echo '404';
		}	
	}
}