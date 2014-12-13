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
}