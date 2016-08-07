<?php 
		# mysql db constants DB_HOST, DB_USER, DB_PASS, DB_NAME
	const DB_HOST = 'diverapp.es.mysql';		 
	const DB_USER = "diverapp_es";				 
	const DB_PASS = 'Ruh6dGBv';
	const DB_NAME = 'diverapp_es';
		
		header("Content-Type: text/html;charset=utf-8");
		
		$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		
		if ($mysqli->connet_errno) {
			//echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
			echo 'error in db connection';
			exit();}
		
		$fid_id = $_GET['facebook_id'];
		$type = $_GET['type'];
		$value_type = $_GET['value_type'];
		if($value_type!="none"){$value = $_GET['value'];}
		
		date_default_timezone_set("Europe/Madrid");
		$timestamp=date_default_timezone_get();
		$mydate = date('Y-m-d H:i:s', strtotime($timestamp));
		
		if($value_type=="none"){
			$sql = "INSERT INTO analytics (user_id, type, datetime) VALUES ({$fid_id}, '{$type}','{$mydate}') ";
		}else if($value_type=="text"){
			$sql = "INSERT INTO analytics (user_id, type, datetime,string_info) VALUES ({$fid_id}, '{$type}','{$mydate}','{$value}') ";
		}else if($value_type=="int"){
			$sql = "INSERT INTO analytics (user_id, type, datetime,int_info) VALUES ({$fid_id}, '{$type}','{$mydate}',{$value}) ";
		}
		
		$mysqli->query($sql);
		
		echo 'ok';

		
		
		?>