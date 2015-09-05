<?php

class m_test extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	//MY TEST
	public function myTest($iduser,$status)
	{
		switch ($status) {
			case 'open':
				$this->db->where('testClose >= CURTIME()');
				break;
			case 'clossed':
				$this->db->where('testClose < CURTIME()');
				break;
		}
		$this->db->where('id_user',$iduser);
		return $this->db->get('test');
	}
	//IS MY TEST
	public function isMyTest($iduser,$idtest)
	{
		$this->db->where('id_user',$iduser);
		$this->db->where('idtest',$idtest);
		$query = $this->db->get('test');
		if($query->num_rows()>0){return true;}
		else{return false;}
	}
	//DETAIL TEST
	public function detailTest($idtest)
	{
		$this->db->where('idTest',$idtest);
	    $result = $this->db->get('test')->row_array();
	    return $result;
	}
	//GET CASE
	public function getCase($idtest,$step="")
	{
		$this->db->where('idTest',$idtest);
		if(!empty($step)):
			$this->db->where('testCaseStep',$step);
		else:
			$this->db->order_by('testCaseStep','ASC');
		endif;
		return $this->db->get('testCase');
	}
	//STATUS WHEN DO TEST
	public function statusDoTest($iduser,$idtest)
	{
		$this->db->where('id_user',$iduser);
		$this->db->where('idTest',$idtest);
		$query = $this->db->get('test');
		if($query->num_rows()>0){$status="organizer";}
		else{$status="participant";}
		return $status;
	}
	//NEW DATABASE SESSION TO DO TEST
	public function insertDoTest($iduser,$idtest)
	{

		$sqlchecker = 'SELECT * FROM doTest WHERE id_user = ? AND idTest = ?';
		$querychecker = $this->db->query($sqlchecker,array($iduser,$idtest));
		$statusTest = $this->statusDoTest($iduser,$idtest);
		if($querychecker->num_rows()<1)//never
		{
			$data = array(
				'idDoTest' => $iduser.'-'.$idtest,
				'startDoTest' => date('Y-m-d H:i:s'),
				'endDoTest' => '',
				'idTest' => $idtest,
				'id_user' => $iduser,
				'doTestAs'=>$statusTest,
				'doTestResult'=>json_encode(array()),
				'doTestScore'=>''
				);
			return $this->db->insert('doTest',$data);
		}else{//have do test before, update coloumn (startDoTest)
			$data = array(
				'startDoTest' => date('Y-m-d H:i:s'),
				'endDoTest' => '',
				'idTest' => $idtest,
				'id_user' => $iduser,
				'doTestAs'=>$statusTest,
				'doTestResult'=>json_encode(array()),
				'doTestScore'=>''
				);
			$this->db->where('idDoTest',$iduser.'-'.$idtest);
			return $this->db->update('doTest',$data);
		}
	}
	//IS FINISHING TEST :: closed message
	public function finishingTest($idtest,$iduser)
	{
		$this->db->where('idTest',$idtest);
		$this->db->where('id_user',$iduser);
		$this->db->where('endDoTest <>','0000-00-00 00:00:00');
		$query = $this->db->get('doTest');
		if($query->num_rows()>0){return true;}
		else{return false;}
	}
	//GET DATABASE SESSION
	public function getDatabaseSession($iduser,$idtest)
	{
		$this->db->where('idTest',$idtest);
		$this->db->where('id_user',$iduser);
		return $this->db->get('doTest')->row_array();
	}
}