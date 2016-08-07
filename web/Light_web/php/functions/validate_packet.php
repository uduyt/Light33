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
		
		$packet_code	= $_GET['id'];
		$lids_number	= $_GET['lids_num'];
		$state	= $_GET['state'];
		
		date_default_timezone_set("Europe/Madrid");
		$timestamp=date_default_timezone_get();
		$mydate = date('Y-m-d H:i:s', strtotime($timestamp));

		$sql = "UPDATE paquetes SET lids_val={$lids_number}, state='{$state}' , date_validated='{$mydate}' WHERE packetID={$packet_code}";	
			echo $sql;
		$mysqli->query($sql);
		?>