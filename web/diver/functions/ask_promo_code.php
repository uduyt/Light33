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
	
	$code	= $_GET['code'];
	$event_id	= $_GET['event_id'];
	
	$sql= "SELECT * FROM promotions WHERE name='{$code}' AND event_id ={$event_id} LIMIT 1" ;
	
	$result = $mysqli->query($sql);
	$row = mysqli_fetch_array($result);
			
	if ($result->num_rows >=1) {
		$sql= "UPDATE promotions SET times_used=times_used+1 WHERE name='{$code}' AND event_id ={$event_id}" ;
	$result = $mysqli->query($sql);
	}
			
	$promo=array();
	$promo["type"]=$row['type'];
	$promo["promotion_description"]=$row['promotion_description'];
	$promo["people"]=$row['people'];
	
	
	echo json_encode(utf8ize($promo));
	
	function utf8ize($d) {
		if (is_array($d)) {
			foreach ($d as $k => $v) {
				$d[$k] = utf8ize($v);
			}
		} else if (is_string ($d)) {
			return utf8_encode($d);
		}
		return $d;
	}
?>