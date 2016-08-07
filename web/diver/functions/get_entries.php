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
	
	$event_id	= $_GET['event_id'];
		
		//TODO: as long as datetime is not later than datetime_end
	$sql="SELECT * FROM entries WHERE event_id={$event_id}";
	
	$result = $mysqli->query($sql);
	
	$entries=array();
	
	while($r = mysqli_fetch_assoc($result)) {
				 $entries[]= $r;
			   }
	echo json_encode(utf8ize($entries));
	
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