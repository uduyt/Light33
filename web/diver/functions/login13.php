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
	
	$nothing	= $_POST['nothing'];
	$name	= $_POST['name'];
	$fid	= $_POST['fid'];
	$email	= $_POST['email'];
	$gender	= $_POST['gender'];
	$birthday	= $_POST['birthday'];
	$total_friends	= $_POST['total_friends'];
	$friends_data	= $_POST['friends_data'];
	$friends_length	= $_POST['friends_length'];
	$app_version	= $_POST['version'];

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
		if ($birthday!="nulo"){
			$sql="UPDATE users SET birthday='{$birthday}' WHERE facebook_id={$fid}";
			$mysqli->query($sql);
		}
		if ($total_friends!="nulo"){
			$sql="UPDATE users SET total_friends='{$total_friends}' WHERE facebook_id={$fid}";
			$mysqli->query($sql);
		}
		
		if($friends_length>=1){
			$data_array=json_decode($friends_data,true);
			for($i=0;$i<$friends_length;$i++){
				
				$sql="SELECT id FROM facebook_relations WHERE (user1='{$fid}' AND user2='{$data_array[$i]["id"]}') OR (user2='{$fid}' AND user1='{$data_array[$i]["id"]}') LIMIT 1";
				
				
				$result = $mysqli->query($sql);
				
				if ($result->num_rows !=1) {
					$sql="INSERT INTO facebook_relations(user1,user2) VALUES ('{$fid}','{$data_array[$i]["id"]}')";
					$result = $mysqli->query($sql);
				}
			}
		}
		
		
	}else{
		
		if($friends_length>=1){
			$data_array=json_decode($friends_data,true);
			for($i=0;$i<$friends_length;$i++){
				
				$sql="SELECT id FROM facebook_relations WHERE (user1='{$fid}' AND user2='{$data_array[$i]["id"]}') OR (user2='{$fid}' AND user1='{$data_array[$i]["id"]}') LIMIT 1";
				
				$result = $mysqli->query($sql);
				
				if ($result->num_rows !=1) {
					$sql="INSERT INTO facebook_relations(user1,user2) VALUES ('{$fid}','{$data_array[$i]["id"]}')";
			
					$result = $mysqli->query($sql);
				}
			}
		}
		
		date_default_timezone_set("Europe/Madrid");
		$timestamp=date_default_timezone_get();
		$mydate = date('Y-m-d H:i:s', strtotime($timestamp));
		
		$sql="INSERT INTO users (name, email, facebook_id, gender,date_registered,birthday,total_friends) VALUES ('{$name}','{$email}',{$fid},'{$gender}','{$mydate}','{$birthday}',{$total_friends})";
		$result = $mysqli->query($sql);
		
		$to = "carlos.rosety@gmail.com";
		$subject = "Nuevo registro";
		$txt =    "\nNuevo registro de " .$name ." con perfil de facebook: https://www.facebook.com/" . $fid;
				
		$headers = "From: registros@diverapp.es" ;

		mail($to,$subject,$txt, $headers);

	}
	$sql="UPDATE users SET app_version = {$app_version} WHERE facebook_id={$fid}";
	$mysqli->query($sql);
	
	if($app_version<13){
		echo "update";
	}else{
		echo "ok";
	}
?>