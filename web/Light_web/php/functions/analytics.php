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
		
		$user_id = $_GET['user_id'];
		$type = $_GET['type'];
		$value = $_GET['value'];
		
		date_default_timezone_set("Europe/Madrid");
		$timestamp=date_default_timezone_get();
		$mydate = date('Y-m-d H:i:s', strtotime($timestamp));
		
		if($type=="time_in"){
			$sql = "INSERT INTO analytics_basic (user_id, type, datetime, value_int) VALUES ({$user_id}, '{$type}','{$mydate}','{$value}') ";
		}else{
			$sql = "INSERT INTO analytics_basic (user_id, type, datetime) VALUES ({$user_id}, '{$type}','{$mydate}') ";
		}
		
		$mysqli->query($sql);
		
		echo 'ok';

		
		
		?>