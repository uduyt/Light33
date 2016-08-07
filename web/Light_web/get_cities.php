
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
		
	$sql="SELECT id,name from cities ORDER BY ATAN2(SQRT(SIN((Lat-({$lat}))/2) * SIN((Lat-({$lat}))/2) + COS(({$lat})) * COS(Lat) * SIN((Longg-({$long}))/2) * SIN((Longg-({$long}))/2)), SQRT(1-SIN((Lat-({$lat}))/2) * SIN((Lat-({$lat}))/2) + COS(({$lat})) * COS(Lat) * SIN((Longg-({$long}))/2) * SIN((Longg-({$long}))/2))) LIMIT 10";
	
	$result = $mysqli->query($sql);
	$cities=array();
	while($r = mysqli_fetch_assoc($result)) {
				 $cities[]= $r;
			   }
	echo json_encode($cities);
	
	
?>
