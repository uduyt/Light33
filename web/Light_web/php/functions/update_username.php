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
		
		$username = $_GET['username'];
		$password = $_GET['password'];
		$id = $_GET['id'];
		
		$sql = "SELECT * FROM usuarios WHERE username = '{$username}'";
		$result = $mysqli->query($sql);
		if ($result->num_rows != 0) {
			#User already exists
			echo "equal";
		}else{
			$sql = "UPDATE usuarios SET username='{$username}', password = '{$password}' WHERE id='{$id}'";
			$result = $mysqli->query($sql);
			echo 'ok';
		}
		
		
		?>