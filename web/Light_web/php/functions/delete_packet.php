<?php 
	const DB_HOST = 'mysql.hostinger.es';		 
	const DB_USER = "u739882124_roset";				 
	const DB_PASS = 'fertdgcv';
	const DB_NAME = 'u739882124_dbuse';
	
	$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	
	if ($mysqli->connet_errno) {
		//echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		echo 'error in db connection';
		exit();}
	
	$packet_code= $_GET['packet_code'];

	$sql = "UPDATE paquetes SET user_id=NULL, lids_num=0, state=NULL WHERE packetID='{$packet_code}'";

	if ($mysqli->query($sql) === TRUE) {
		echo "success";
	} else {
		echo "error with server";
	}
	
	?>