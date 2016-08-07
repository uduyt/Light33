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
	
	$city_id= $_GET['city'];
		
	$sql= "SELECT name FROM cities WHERE {$city_id}=id";
	
	$result = $mysqli->query($sql);
	$row = mysqli_fetch_array($result);
	$city_name=$row['name'];
			
	$sql="SELECT * FROM events INNER JOIN clubs ON events.club_id=clubs.club_id WHERE clubs.city_id = {$city_id} AND events.datetime_close>= DATE_ADD(NOW(), INTERVAL 2 HOUR) ORDER BY events.datetime_close";
	$result = $mysqli->query($sql);
	$cities=array();
	$cities["city_name"]=$city_name;
	$cities["city_id"]=$city_id;
	
	while($r = mysqli_fetch_assoc($result)) {
				 $cities["data"][]= $r;
			   }
	echo json_encode(utf8ize($cities));
	
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