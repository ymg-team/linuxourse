<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/foundation.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/foundation-icons.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/normalize.css')?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/knowlinux.css')?>">
	<link rel="icon" href="<?php echo base_url('assets/img/favicon.png')?>">
	<!--<script type="text/javascript" src="<?php echo base_url('assets/js/vendor/modernizr.js')?>"></script>-->
	<title>
		<?php
		//title setup
		if(!empty($title)){
			echo $title.' :: FOSSIL Linux Ecourse';
		} else {
			echo 'FOSSIL Linux Ecourse';
		}
		?>
	</title>
</head>
<body>
<?php
$this->load->view($childView);
$this->load->view('base/baseFooter');
?>
