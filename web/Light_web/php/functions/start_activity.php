<?php 
		const DB_HOST = 'mysql.hostinger.es';		 
		const DB_USER = "u739882124_roset";				 
		const DB_PASS = 'fertdgcv';
		const DB_NAME = 'u739882124_dbuse';
		
		$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		
		if ($mysqli->connet_errno) {
			//echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
			echo 'error in db connection';
			exit();
		}
		
		$user_id	= $_GET['user_id'];
		$millis	= $_GET['millis'];
		$type	= $_GET['type'];
		
		date_default_timezone_set("Europe/Madrid");
		$timestamp=date_default_timezone_get();
		$mydate = date('Y-m-d H:i:s', strtotime($timestamp));

		//insert in the analytics
		$sql = "INSERT INTO analytics_basic (user_id, type,value_int,datetime) VALUES ({$user_id}, '{$type}',{$millis},'{$mydate}') ";
		$result = $mysqli->query($sql);
		echo $sql;
		
		if($type=="recycliot"){
			$sql = "UPDATE usuarios SET lights=lights+5 WHERE id={$user_id}";
		}else{
			$sql = "UPDATE usuarios SET lights=lights+2 WHERE id={$user_id}";
		}
		
		$result = $mysqli->query($sql);
		echo 'ok';
		
		?>