
		<?php 
		
		# mysql db constants DB_HOST, DB_USER, DB_PASS, DB_NAME
		const DB_HOST = 'mysql.hostinger.es';		 
		const DB_USER = "u739882124_roset";				 
		const DB_PASS = 'fertdgcv';
		const DB_NAME = 'u739882124_dbuse';

		
		# connect mysql server
		$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		
		# check connection
		if ($mysqli->connet_errno) {
			//echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
			echo 'error in db connection';
			exit();
		}
		
		function generateRandomString($length) {
			$characters = 'abcdefghijklmnopqrstuvwxyz';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}

		$num_users	= $_GET['num'];
		$school	= $_GET['school'];
		$class= $_GET['class'];

		for ($i=0;$i<$num_users;$i++){
			$username= generateRandomString(4);
			$password = generateRandomString(4);
			
			$result = $mysqli->query("SELECT id FROM usuarios WHERE username='{$username}'");
			
			if ($result->num_rows == 0) {
				$sql = "INSERT INTO usuarios (username, password, school) VALUES ('{$username}', '{$password}', '{$school}')";
				
				$mysqli->query($sql);
				
				echo $sql;
			}else{
				$i--;
				
				echo "11111111111";
			}
			
			
		}
		
		?>