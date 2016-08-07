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
	
	$lat	= $_GET['lat'];
	$long	= $_GET['long'];
		
	//TODO: as long as datetime is not later than datetime_end
	$sql= "SELECT id FROM cities ORDER BY ATAN2(SQRT(SIN(RADIANS(Lat-({$lat}))/2) * SIN(RADIANS(Lat-({$lat}))/2) + COS(RADIANS({$lat})) * COS(RADIANS(Lat)) * SIN(RADIANS(Longg-({$long}))/2) * SIN(RADIANS(Longg-({$long}))/2)), SQRT(1-SIN(RADIANS(Lat-({$lat}))/2) * SIN(RADIANS(Lat-({$lat}))/2) + COS(RADIANS({$lat})) * COS(RADIANS(Lat)) * SIN(RADIANS(Longg-({$long}))/2) * SIN(RADIANS(Longg-({$long}))/2))) LIMIT 1";
	$result = $mysqli->query($sql);
	$row = mysqli_fetch_array($result);
	$city_id=$row['id'];
	
	echo $city_id;
	
?>