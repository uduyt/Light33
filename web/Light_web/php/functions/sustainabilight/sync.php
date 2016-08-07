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
		
		$username = $_GET['username'];
		
		
		$result = $mysqli->query("SELECT * from usuarios WHERE username LIKE '{$username}'");
		
		if (!$result->num_rows == 1) {
			#Invalid username/password combination
			header("Refresh:0; url='http://sustainabilight.com/unleash.php?error=el%20nombre%20de%20usuario%20introducido%20no%20esta%20en%20la%20base%20de%20datos'");
		}else{
			header("Refresh:0; url='http://sustainabilight.com/unleash_sync.php?username=" . $username . "'");
		}
	
		
		?>