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
		
		$username	= $_GET['username'];
		$password	= $_GET['password'];
		$email	= $_GET['email'];
		$app_version= $_GET['app_version'];
		
		$result = $mysqli->query("SELECT * FROM usuarios WHERE username='{$username}'");
		
		if ($result->num_rows >= 1) {
			#Invalid username/password combination
			echo "username_exists";
		}else{
			
			$sql="INSERT INTO usuarios (username, password, email, version) VALUES ('{$username}','{$password}','{$email}',{$app_version})";
			$result = $mysqli->query($sql);
			
			echo "ok";
						
		}
		
		
		?>