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
		$lights	= $_GET['lights'];
		
		$sql = "UPDATE usuarios SET lights=lights+{$lights} WHERE id={$user_id}";
		$result = $mysqli->query($sql);
		
		echo 'ok';
		
		?>