<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class base extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//load all model
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('m_user');
		$this->load->model('m_course');
		//sendgrid
		$this->SendgridUrl = 'https://api.sendgrid.com/';//send grid API url
		$this->SendGridUser = 'yussanamikom';//sendgrid username + github for education package
		$this->SendGridPassword = 'Rahasia20';//sendgrid password [be careful]
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
	//base view
	public function baseManageView($x="",$data=""){ //x = view anak , y = data
		$data['childView'] = $x;
		$this->load->view('base/baseManageView',$data);
	}
	//empty base view
	public function emptyBaseView($x="",$data=""){ //x = view anak , y = data
		$data['childView'] = $x;
		$this->load->view('base/emptyBaseView',$data);
	}
	//member only
	public function memberOnly(){
		if(empty($this->session->userdata['student_login']['id_user'])){
			redirect(site_url('p/login'));
		}
	}
	//admin only
	public function adminOnly(){
		if(empty($this->session->userdata['manage_login']['id_user'])){
			redirect(site_url('manage'));
		}
	}
	//check special command
	public function checkSpecialCommand($command,$array){
		if(in_array($command, $array) && !in_array('man',$array)){//cd
			return true;//matched
		} else {
			return false;//not matched
		}
	}
	//check directory
	public function checkDir($x){//x = directory
		$dirList = array('/home/user/mydir','/var','/etc','/home','/home/user','/');
		if(in_array($x, $dirList)){
			return true;
		}else{return false;}
	}

	//special command
	public function specialCommand($command){//trim command
		//get all command have exec from session
		$history = array();
		//push to array recentcommand
		$recentcommand = $this->session->userdata['command'];
		if(!empty($recentcommand)){
			foreach($recentcommand as $rc):
				array_push($history,$rc);
			endforeach;
		}
		array_push($history, $command);
		$sessiondata['command'] = $history;
		//add history to season
		$this->session->set_userdata($sessiondata);
		//special command
		//get my history
		$myhistory = '';
		//get total history on session
		for($n=0;$n<count($this->session->userdata['command']);$n++){
			$myhistory = $myhistory.$this->session->userdata['command'][$n];
		}
		$specialcommand = array(
			'history'=>$myhistory,
			'cls'=>'clear screen',
			'ls-l'=>'drwxrwxrwx  4 user user  4096 Nov  3 21:50 mydirectory',
			'ls-a'=>'.hiddendirectory <br/>mydirectory',
			'ls'=>'mydirectory',
			'y'=>'confirmed',
		);
		//command is special command or not
		$trimcommand = preg_replace('#[ \r\n\t]+#','', $command);
		if(array_key_exists($trimcommand,$specialcommand)){//found
			echo '<pre>student@linux-ecourse:~$ '.$command.$specialcommand[$trimcommand].'</pre>';
		} else {//not found
			$result = shell_exec($command);
			// echo '<pre>student@linux-ecourse:~$ '.$command.
			// 	$result.'</pre>';
			if(!empty($result)){
				echo '<pre>student@linux-ecourse:~$ '.$command.$result.'</pre>';
			} else {
				echo '<pre>student@linux-ecourse:~$ '.$command.'No command "'.$command.'" found </pre>';
			}
		}
	}
	//check available file/directory on session :: /home/user
	public function searchAttributes($type,$name){
		$found = false;
		switch ($type){
			case 'dir':
			foreach($this->session->userdata('mydir') as $list):
				if(trim($list['name'])==trim($name)){
					$found = true;
				}
			endforeach;
			break;
			case 'file':
			foreach($this->session->userdata('myfile') as $list):
				if(trim($list['name'])==trim($name)){
					$found = true;
				}
			endforeach;
			break;
			default:
			$found = false;
			break;
		}
		return $found;
	}
	//rm file or directory
	public function rmAttributes($type,$name){
		$files = array();
		$directories = array();
		switch ($type) {
			case 'dir':
			$sessionDir = $this->session->userdata('mydir');
			foreach($sessionDir as $sd):
				if($sd['name'] != $name):
					array_push($directories, $sd);
				endif;
			endforeach;
			//set session
			$this->session->set_userdata('mydir',$directories);
			break;
			case 'file':
			$sessionFile = $this->session->userdata('myfile');
			foreach($sessionFile as $sf):
				if($sf['name'] != $name):
					array_push($files, $sf);
				endif;
			endforeach;
			//set session
			$this->session->set_userdata('myfile',$files);
			break;
			default:
			echo 'Something wrong, please refresh page';
			break;
		}
	}
	//is input output standart
	public function isIOStandart($commandArray){
		//standart input output
		$standartio = array('>','<','>>','1>','0<','2>');
		$status = false;
		foreach($standartio as $io):
			if(in_array($io,$commandArray)){
				$status = true;
			}
		endforeach;
		return $status;//found or not
	}
	//check redirection
	public function useIOStandart($command){
		$commandArray = explode(' ', $command);
		//standart input output
		$standartio = array('>','<','>>','1>','0<','2>');
		foreach($standartio as $io):
			if(in_array($io,$commandArray)){
				$redirection = $io;
			}
		endforeach;
		return $redirection;//found or not
	}
	//return to row array
	public function returnToRow($query){
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return array();
		}
	}
	//return to result array
	public function returnToResult($query){
		if($query->num_rows()>0){
			return $query->result_array();
		}else{
			return array();
		}
	}
	//chmod modification
	public function chmodModification($attr,$command){
		if(is_numeric($attr)){//using number
			if(strlen($attr) == 3){//total array index must 3
				for($x=0;$x<3;$x++){//looping for user group and else
					switch ($attr[$x]) {
						case 7://
						$per[$x] = 'rwx';
						break;
						case 6://
						$per[$x] = 'rw-';
						break;
						case 5://
						$per[$x] = 'r-x';
						break;
						case 4://
						$per[$x] = 'r--';
						break;
						case 3://
						$per[$x] = '-wx';
						break;
						case 2://
						$per[$x] = '-w-';
						break;
						case 1://
						$per[$x] = '--x';
						break;
						default:
						$per[$x] = 'rwx';
						break;
					}
				}
				$permissions = $per[0].$per[1].$per[2];
			}else{
				redirect(site_url('regex/errorMessage?command='.$command.'&error=wrong chmod attributes'));
			}
		}else{//using abajad
			//using addition or subtraction or else
			preg_match('#u(.*),#U', $attr,$pu);//get user permissions
			preg_match('#g(.*),#U', $attr,$pg);//get group permissions
			preg_match('#o(.*)#', $attr,$po);//get other permissions
			$permission[0] = $pu[1];//user
			$permission[1] = $pg[1];//group
			$permission[2] = $po[1];//other
			$permissions = '';//default
			for($x=0;$x<3;$x++){
				//use = / - / +
				if($permission[$x][0]=='='){//only for =
					$permswitch = trim(str_replace('=', '', $permission[$x]));
					switch($permswitch){
						case 'r':
						$perm = 'r--';
						break;
						case 'w':
						$perm = '-w-';
						break;
						case 'x':
						$perm = '--x';
						break;
						case 'rw':
						$perm = 'rw-';
						break;
						case 'rx':
						$perm = 'r-x';
						break;
						case 'wx':
						$perm = '-wx';
						break;
						case 'rwx':
						$perm = 'rwx';
						break;
						default:
						$perm = 'rwx';
						break;
					}
				} else {
					$perm = 'rwx';
				}
				//all permissions
				$permissions = $permissions.$perm;
			}
		}
		return $permissions;
	}
	//default file for user for start course
	public function defaultPublicFile(){
		$publicfile = array(
			array(
				'name'=>'publicfile',
				'type'=>'-',
				'permissions'=>'rwxrwxrwx',
				'create'=>date('dMY H:i'),
				'owner'=>$this->session->userdata['student_login']['username'],
				'content'=>'this is content inside public file',
			)
		);

		return $this->session->set_userdata('myfile',$publicfile);
	}
	//default directory for public for start course
	public function defaultPublicDirectory(){
		$publicdir = array(
			array(
				'name'=>'publicdirectory',
				'permissions'=>'rwxrwxrwx',
				'create'=>date('dMY H:i'),
				'owner'=>$this->session->userdata['student_login']['username'],
			)
		);
		return $this->session->set_userdata('mydir',$publicdir);
	}
	//default umask for start course
	public function defaultUmask(){
		//default umask = 002
		$umask = array(
			array('dir'=>'/home/user','umask'=>'000'),
		);
		return $this->session->set_userdata('umask',$umask);
	}
	//counting umask
	public function checkUmask($type,$umaskvalue){
		switch ($type) {
			case 'file':
			$u = 6-$umaskvalue[0];
			$g = 6-$umaskvalue[1];
			$o = 6-$umaskvalue[2];
			$chmod = $u.$g.$o;//get chmod value
			$permissions = $this->chmodModification($chmod,'');//get permissions
			break;

			case 'dir':
			$u = 7-$umaskvalue[0];
			$g = 7-$umaskvalue[1];
			$o = 7-$umaskvalue[2];
			$chmod = $u.$g.$o;//get chmod value
			$permissions = $this->chmodModification($chmod,'');//get permissions
			break;

			default:
			$permissions = 'rwxr-x-r-x';
			break;
		}
		return $permissions;
	}
	//default session
	public function defaultSession(){
		$sessiondata = array(
			'dir'=>'/home/user',//active directory
			'command'=>'',//command history
			'user'=>'',//created user
			'group'=>'',//created group
			'start'=>date('H:i:s'),//start course
		);
		return $this->session->set_userdata($sessiondata);
	}
	/*
	* ALL ABOUT SENDGRID
	*/
	public function sendEmail($subject,$to,$message)//this send email send from noreply@linuxourse.me
	{
		$params = array(
			'api_user'=>$this->SendGridUser,
			'api_key'=>$this->SendGridPassword,
			'to'=>$to,
			'subject'=>$subject,
			'from'=>'noreply@linuxourse.me',
			'html'=>$message,//html line
			'text'=>strip_tags($message),//convert html to text
		);
		$request =  $url.'api/mail.send.json';
		// Generate curl request
		$session = curl_init($request);
		// Tell curl to use HTTP POST
		curl_setopt ($session, CURLOPT_POST, true);
		// Tell curl that this is the body of the POST
		curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
		// Tell curl not to return headers, but do return the response
		curl_setopt($session, CURLOPT_HEADER, false);
		// Tell PHP not to use SSLv3 (instead opting for TLS)
		curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		// obtain response
		$response = curl_exec($session);//do send message
		curl_close($session);
		// print everything out
		// print_r($response);
	}

	//SENDGRID SEND EMAIL
	public function sendgridSend($destination,$subject,$topic,$body)
	{
		$url = 'https://api.sendgrid.com/';
		$user = 'yussanamikom';
		$pass = 'Rahasia26011993';
		$params = array(
		    'api_user'  => $user,
		    'api_key'   => $pass,
		    'to'        => $destination,
		    'subject'   => $subject,
		    'from'      => 'noreply@linuxourse.me',
		  );
		  $params['html'] =
		  '
		  <!DOCTYPE html "-//w3c//dtd xhtml 1.0 transitional //en" "http://www.w3.org/tr/xhtml1/dtd/xhtml1-transitional.dtd"><html lang="en" xmlns="http://www.w3.org/1999/xhtml"><head>
			<!--[if gte mso 9]><xml>
			<o:OfficeDocumentSettings>
			<o:AllowPNG/>
			<o:PixelsPerInch>96</o:PixelsPerInch>
			</o:OfficeDocumentSettings>
			</xml><![endif]-->
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta name="viewport" content="width=device-width">
			<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">

			<title>Template Base</title>

			</head>
			<body style="color:#fff;width: 100% !important;min-width: 100%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100% !important;margin: 0;padding: 0;background-color: #FFFFFF">
			<style id="media-query">
			/*  Media Queries */
			@media only screen and (max-width: 500px) {
			.prova {
			width: 500px; }
			table[class="body"] img {
			width: 100% !important;
			height: auto !important; }
			table[class="body"] center {
			min-width: 0 !important; }
			table[class="body"] .container {
			width: 95% !important; }
			table[class="body"] .row {
			width: 100% !important;
			display: block !important; }
			table[class="body"] .wrapper {
			display: block !important;
			padding-right: 0 !important; }
			table[class="body"] .columns, table[class="body"] .column {
			table-layout: fixed !important;
			float: none !important;
			width: 100% !important;
			padding-right: 0px !important;
			padding-left: 0px !important;
			display: block !important; }
			table[class="body"] .wrapper.first .columns, table[class="body"] .wrapper.first .column {
			display: table !important; }
			table[class="body"] table.columns td, table[class="body"] table.column td {
			width: 100% !important; }
			table[class="body"] table.columns td.expander {
			width: 1px !important; }
			table[class="body"] .right-text-pad, table[class="body"] .text-pad-right {
			padding-left: 10px !important; }
			table[class="body"] .left-text-pad, table[class="body"] .text-pad-left {
			padding-right: 10px !important; }
			table[class="body"] .hide-for-small, table[class="body"] .show-for-desktop {
			display: none !important; }
			table[class="body"] .show-for-small, table[class="body"] .hide-for-desktop {
			display: inherit !important; }
			table[class="icon-table"] {
			width: 100% !important; }
			table[class="icon-table"] table {
			display: block !important;
			width: 100% !important; }
			table[class="icon-table"] table td {
			padding-bottom: 10px !important; }
			.mixed-two-up .col {
			width: 100% !important; } }


			@media screen and (max-width: 500px) {
			div[class="col"] {
			width: 100% !important;
			}
			}

			@media screen and (min-width: 501px) {
			table[class="block-grid"] {
			width: 500px !important;
			}
			}
			</style>
			<table class="body" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;height: 100%;width: 100%;table-layout: fixed" cellpadding="0" cellspacing="0" width="100%" border="0">
			<tbody><tr style="vertical-align: top">
			<td class="center" style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;text-align: center;background-color: #FFFFFF" align="center" valign="top">

			<!--[if (gte mso 9)|(IE)]>
			<table width="500" class="ieCell" align="center" cellpadding="0" cellspacing="0" border="0">
			<tr>
			<td>
			<![endif]-->
			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top;background-color:#E8E8E8" cellpadding="0" cellspacing="0" align="center" width="100%" border="0">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top" width="100%">
			<table class="container" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;max-width: 500px;margin: 0 auto;text-align: inherit" cellpadding="0" cellspacing="0" align="center" width="100%" border="0">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top" width="100%">
			<table class="block-grid" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;width: 100%;max-width: 500px;color: #000000;background-color: transparent" cellpadding="0" cellspacing="0" width="100%" bgcolor="transparent">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;text-align: center;font-size: 0">
			<!--[if (gte mso 9)|(IE)]>
			<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
			<tr>
			<td valign="top">
			<![endif]-->
			<div class="col num12" style="display: inline-block;vertical-align: top;width: 100%">
			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top" cellpadding="0" cellspacing="0" align="center" width="100%" border="0">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;background-color: transparent;padding-top: 0px;padding-right: 0px;padding-bottom: 0px;padding-left: 0px;border-top: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-left: 0px solid transparent">
			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top" align="center" width="100%" border="0" cellspacing="0">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px" align="center">
			<div>
			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top;border-top: 10px solid transparent;width: 100%" align="center" border="0" cellspacing="0">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top" align="center">
			&nbsp;
			</td>
			</tr>
			</tbody></table>
			</div>
			</td>
			</tr>
			</tbody></table><table style="border-spacing: 0;border-collapse: collapse;vertical-align: top" cellpadding="0" cellspacing="0" width="100%">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;padding-top: 30px;padding-right: 0px;padding-bottom: 30px;padding-left: 0px">
			<div style="color:#ffffff;line-height:120%;font-family:Arial, "Helvetica Neue", Helvetica, sans-serif;">
			<div style="font-size: 14px; line-height: 16px; text-align: center;color: gray;font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;line-height: 17px" data-mce-style="font-size: 14px; line-height: 16px; text-align: center;"><strong><span style="font-size: 28px; line-height: 33px;" data-mce-style="font-size: 28px; line-height: 33px;">Linuxourse<br></span></strong></div>
			</div>
			</td>
			</tr>
			</tbody></table>
			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top" align="center" width="100%" border="0" cellspacing="0">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px" align="center">
			<div>
			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top;border-top: 10px solid transparent;width: 100%" align="center" border="0" cellspacing="0">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top" align="center">
			&nbsp;
			</td>
			</tr>
			</tbody></table>
			</div>
			</td>
			</tr>
			</tbody></table> </td>
			</tr>
			</tbody></table>
			</div>
			<!--[if (gte mso 9)|(IE)]>
			</td><td>
			<![endif]-->
			<!--[if (gte mso 9)|(IE)]>
			</td>
			</tr>
			</table>
			<![endif]-->
			</td>
			</tr>
			</tbody></table>
			</td>
			</tr>
			</tbody></table>
			</td>
			</tr>
			</tbody></table>
			<!--[if (gte mso 9)|(IE)]>
			</td>
			</tr>
			</table>
			<![endif]-->
			<!--[if (gte mso 9)|(IE)]>
			<table width="500" class="ieCell" align="center" cellpadding="0" cellspacing="0" border="0">
			<tr>
			<td>
			<![endif]-->
			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top;background-color: #FFF" cellpadding="0" cellspacing="0" align="center" width="100%" border="0">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top" width="100%">
			<table class="container" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;max-width: 500px;margin: 0 auto;text-align: inherit" cellpadding="0" cellspacing="0" align="center" width="100%" border="0">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top" width="100%">
			<table class="block-grid" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;width: 100%;max-width: 500px;color: #333;background-color: transparent" cellpadding="0" cellspacing="0" width="100%" bgcolor="transparent">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;text-align: center;font-size: 0">
			<!--[if (gte mso 9)|(IE)]>
			<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
			<tr>
			<td valign="top">
			<![endif]-->
			<div class="col num12" style="display: inline-block;vertical-align: top;width: 100%">
			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top" cellpadding="0" cellspacing="0" align="center" width="100%" border="0">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;background-color: transparent;padding-top: 30px;padding-right: 0px;padding-bottom: 30px;padding-left: 0px;border-top: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-left: 0px solid transparent">
			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top" cellpadding="0" cellspacing="0" width="100%">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;padding-top: 25px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px">
			<div style="color:#ffffff;line-height:120%;font-family:Arial, "Helvetica Neue", Helvetica, sans-serif;">
			<div style="font-size: 18px; line-height: 21px; text-align: center;color: #ffffff;font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;line-height: 22px" data-mce-style="font-size: 18px; line-height: 21px; text-align: center;"><span style="color:gray;font-size:24px; line-height:29px;" mce-data-marked="1"><strong>'.$topic.'</strong></span></div>
			</div>
			</td>
			</tr>
			</tbody></table>
			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top" cellpadding="0" cellspacing="0" width="100%">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;padding-top: 0px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px">
			<div style="color:#B8B8C0;line-height:150%;font-family:Arial, "Helvetica Neue", Helvetica, sans-serif;">
			<div style="font-size: 14px; line-height: 21px; text-align: center;color: #B8B8C0;font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;line-height: 21px" data-mce-style="font-size: 14px; line-height: 16px; text-align: center;"><span style="font-size:14px; line-height:21px;">'.$body.'</span></div>
			</div>
			</td>
			</tr>
			</tbody></table>
			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top" width="100%" border="0" cellspacing="0" cellpadding="0">
			<tbody><tr style="vertical-align: top">
			<td class="center" style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;text-align: center;padding-top: 15px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px" align="center">

			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top" width="100%" border="0" cellspacing="0" cellpadding="0">
			<tbody><tr style="vertical-align: top">
			<td class="button-container" style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top" align="center">
			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top" border="0" cellspacing="0" cellpadding="0" align="center">

			<tbody><tr style="vertical-align: top">
			<td class="button" style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: middle;text-align: center;-webkit-border-radius: 25px;-moz-border-radius: 25px;border-radius: 25px;height: 48px" bgcolor="gray" width="178" valign="middle">

			<a style="display: inline-block;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;line-height: 100%;padding-top: 5px;padding-right: 20px;padding-bottom: 5px;padding-left: 20px;text-align:;font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;-webkit-border-radius: 25px;-moz-border-radius: 25px;border-radius: 25px;border-top: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-left: 0px solid transparent;color: #ffffff" href="" target="_blank">

			<!--[if mso]>&nbsp;<![endif]-->
			<div style="text-align: center !important;line-height: 100% !important;font-family: inherit;font-size: 12px;color: #ffffff" data-mce-style="font-family: inherit; font-size: 16px; line-height: 32px;"><a href="http://linuxourse.me" style="color:#fff;text-decoration:none;line-height: 100% !important;font-size: 14px">ke Linuxourse</a></div>
			<!--[if mso]>&nbsp;<![endif]-->
			</a>

			</td>
			</tr>
			</tbody></table>
			</td>
			</tr>
			</tbody></table>

			</td>
			</tr>
			</tbody></table><table style="border-spacing: 0;border-collapse: collapse;vertical-align: top" align="center" width="100%" border="0" cellspacing="0">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px" align="center">
			<div>
			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top;border-top: 0px solid transparent;width: 100%" align="center" border="0" cellspacing="0">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top" align="center">
			&nbsp;
			</td>
			</tr>
			</tbody></table>
			</div>
			</td>
			</tr>
			</tbody></table> </td>
			</tr>
			</tbody></table>
			</div>
			<!--[if (gte mso 9)|(IE)]>
			</td><td>
			<![endif]-->
			<!--[if (gte mso 9)|(IE)]>
			</td>
			</tr>
			</table>
			<![endif]-->
			</td>
			</tr>
			</tbody></table>
			</td>
			</tr>
			</tbody></table>
			</td>
			</tr>
			</tbody></table>
			<!--[if (gte mso 9)|(IE)]>
			</td>
			</tr>
			</table>
			<![endif]-->
			<!--[if (gte mso 9)|(IE)]>
			<table width="500" class="ieCell" align="center" cellpadding="0" cellspacing="0" border="0">
			<tr>
			<td>
			<![endif]-->
			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top;background-color: #ffffff" cellpadding="0" cellspacing="0" align="center" width="100%" border="0">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top" width="100%">
			<table class="container" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;max-width: 500px;margin: 0 auto;text-align: inherit" cellpadding="0" cellspacing="0" align="center" width="100%" border="0">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top" width="100%">
			<table class="block-grid" style="border-spacing: 0;border-collapse: collapse;vertical-align: top;width: 100%;max-width: 500px;color: #333;background-color: transparent" cellpadding="0" cellspacing="0" width="100%" bgcolor="transparent">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;text-align: center;font-size: 0">
			<!--[if (gte mso 9)|(IE)]>
			<table width="100%" align="center" cellpadding="0" cellspacing="0" border="0">
			<tr>
			<td valign="top">
			<![endif]-->
			<div class="col num12" style="display: inline-block;vertical-align: top;width: 100%">
			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top" cellpadding="0" cellspacing="0" align="center" width="100%" border="0">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;background-color: transparent;padding-top: 30px;padding-right: 0px;padding-bottom: 30px;padding-left: 0px;border-top: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-left: 0px solid transparent">
			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top" border="0" cellspacing="0" cellpadding="0" width="100%">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;text-align: center;padding-top: 10px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px" align="center">
			<table class="icon-table" style="border-spacing: 0;border-collapse: collapse;vertical-align: top" border="0" cellspacing="0" cellpadding="0" width="114" align="center">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top">


			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top;padding: 0 5px 0 0" align="left" border="0" cellspacing="0" cellpadding="0" width="38">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top">
			<a href="https://www.facebook.com/linuxourse" title="Facebook" target="_blank">
			<img style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;width: 100%;clear: both;display: block;border: none;height: auto;line-height: 100%;max-width: 32px !important" src="http://i.imgur.com/DHxcb2m.png" alt="Facebook" title="Facebook" width="100%">
			</a>
			</td>
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top"></td>
			</tr>
			</tbody></table>
			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top;padding: 0 5px 0 0" align="left" border="0" cellspacing="0" cellpadding="0" width="38">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top">
			<a href="http://twitter.com/linuxourse" title="Twitter" target="_blank">
			<img style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;width: 100%;clear: both;display: block;border: none;height: auto;line-height: 100%;max-width: 32px !important" src="http://i.imgur.com/uYn565H.png" alt="Twitter" title="Twitter" width="100%">
			</a>
			</td>
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top"></td>
			</tr>
			</tbody></table>
			<table style="border-spacing: 0;border-collapse: collapse;vertical-align: top;padding: 0 5px 0 0" align="left" border="0" cellspacing="0" cellpadding="0" width="38">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top">
			<a href="https://plus.google.com/+linuxourse" title="Google+" target="_blank">
			<img style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;width: 100%;clear: both;display: block;border: none;height: auto;line-height: 100%;max-width: 32px !important" src="http://i.imgur.com/yb90ePk.png" alt="Google+" title="Google+" width="100%">
			</a>
			</td>
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top"></td>
			</tr>
			</tbody></table>
			</td>
			</tr>
			</tbody></table>
			</td>
			</tr>
			</tbody></table><table style="border-spacing: 0;border-collapse: collapse;vertical-align: top" cellpadding="0" cellspacing="0" width="100%">
			<tbody><tr style="vertical-align: top">
			<td style="word-break: break-word;-webkit-hyphens: auto;-moz-hyphens: auto;hyphens: auto;border-collapse: collapse !important;vertical-align: top;padding-top: 15px;padding-right: 10px;padding-bottom: 10px;padding-left: 10px">
			<div style="color:#959595;line-height:150%;font-family:Arial, "Helvetica Neue", Helvetica, sans-serif;">
			<div style="font-size: 14px; line-height: 21px; text-align: center;color: #959595;font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;line-height: 21px" data-mce-style="font-size: 14px; line-height: 16px; text-align: center;">www.linuxourse.me<br/>Linuxourse by ID+More Team</div>
			</div>
			</td>
			</tr>
			</tbody></table>
			</td>
			</tr>
			</tbody></table>
			</div>
			<!--[if (gte mso 9)|(IE)]>
			</td><td>
			<![endif]-->
			<!--[if (gte mso 9)|(IE)]>
			</td>
			</tr>
			</table>
			<![endif]-->
			</td>
			</tr>
			</tbody></table>
			</td>
			</tr>
			</tbody></table>
			</td>
			</tr>
			</tbody></table>
			<!--[if (gte mso 9)|(IE)]>
			</td>
			</tr>
			</table>
			<![endif]-->
			</td>
			</tr>
			</tbody></table>
			</body></html>
		  ';
		$params['text'] = $params['html'];
		$request =  $url.'api/mail.send.json';
		// Generate curl request
		$session = curl_init($request);
		// Tell curl to use HTTP POST
		curl_setopt ($session, CURLOPT_POST, true);
		// Tell curl that this is the body of the POST
		curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
		// Tell curl not to return headers, but do return the response
		curl_setopt($session, CURLOPT_HEADER, false);
		// Tell PHP not to use SSLv3 (instead opting for TLS)
		curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		// obtain response
		$response = curl_exec($session);
		curl_close($session);
		// print everything out
		// $reponse = json_decode($response);
		// echo $response;
	}

}
/* End of file base.php */
/* Location: ./application/controllers/base/base.php */
