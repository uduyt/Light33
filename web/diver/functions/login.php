<?php 
	
	//include $_SERVER['DOCUMENT_ROOT'] . '/php/db_connect'; 
	header("Content-Type: text/html;charset=utf-8");
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
	$acentos = $mysqli->query("SET NAMES 'utf8'");
	
	$fid	= $_GET['facebook_id'];
	$name	= $_GET['name'];
	$email	= $_GET['email'];
	$gender	= $_GET['gender'];
	$app_version	= $_GET['version'];

	$sql="SELECT id FROM users WHERE facebook_id={$fid}";
	$result = $mysqli->query($sql);
	
	if ($result->num_rows >=1) {

		if ($email!="nulo"){
			$sql="UPDATE users SET email = '{$email}' WHERE facebook_id={$fid}";
			$mysqli->query($sql);
		}
		if ($gender!="nulo"){
			$sql="UPDATE users SET gender='{$gender}' WHERE facebook_id={$fid}";
			$mysqli->query($sql);
		}
	}else{
		date_default_timezone_set("Europe/Madrid");
		$timestamp=date_default_timezone_get();
		$mydate = date('Y-m-d H:i:s', strtotime($timestamp));
		
		$sql="INSERT INTO users (name, email, facebook_id, gender,date_registered) VALUES ('{$name}','{$email}',{$fid},'{$gender}','{$mydate}')";
		$result = $mysqli->query($sql);
		
		$to = "carlos.rosety@gmail.com";
	$subject = "Nuevo registro";
	$txt =    "\nNuevo registro de " .$name ." con perfil de facebook: https://www.facebook.com/" . $fid;
			
	$headers = "From: registros@diverapp.es" ;

mail($to,$subject,$txt, $headers);

	}
	$sql="UPDATE users SET app_version = {$app_version} WHERE facebook_id={$fid}";
	$mysqli->query($sql);
	
	if($app_version<12){
		echo "update";
	}else{
		echo "ok";
	}
?>