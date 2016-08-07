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
		
		$class = $_GET['class'];
		$id = $_GET['id'];
		
		$sql = "UPDATE usuarios SET times_in = times_in + 1, class='{$class}' WHERE id='{$id}'";
		$mysqli->query($sql);
		echo 'ok';

		
		
		?>