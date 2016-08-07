<?php 
	
	//include $_SERVER['DOCUMENT_ROOT'] . '/php/db_connect'; 
	
	# mysql db constants DB_HOST, DB_USER, DB_PASS, DB_NAME
	const DB_HOST = 'diverapp.es.mysql';		 
	const DB_USER = "diverapp_es";				 
	const DB_PASS = 'Ruh6dGBv';
	const DB_NAME = 'diverapp_es';

	
	# connect mysql server
	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	
	# check connection
	if ($mysqli->connet_errno) {
		//echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		echo 'error in db connection';
		exit();
	}
	
	$fid	= $_GET['facebook_id'];
	$name	= $_GET['name'];
	$email	= $_GET['email'];
	$app_version	= $_GET['version'];

	$sql="SELECT id FROM users WHERE facebook_id={$fid}";
	$result = $mysqli->query($sql);
	
	if ($result->num_rows >=1) {

		if ($email!="nulo"){
			$sql="UPDATE users SET email = '{$email}' WHERE facebook_id={$fid}";
			$mysqli->query($sql);
		}
	}else{
		$sql="INSERT INTO users (name, email, facebook_id) VALUES ('{$name}','{$email}',{$fid})";
		$result = $mysqli->query($sql);
	}
	$sql="UPDATE users SET app_version = {$app_version} WHERE facebook_id={$fid}";
	$mysqli->query($sql);
	
	if($app_version<1){
		echo "update";
	}else{
		echo "ok";
	}
?>