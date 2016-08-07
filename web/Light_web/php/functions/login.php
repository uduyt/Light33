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
		
		$username	= $_GET['username'];
		$password	= $_GET['password'];
		$app_version= $_GET['app_version'];
		
		
		$result = $mysqli->query("SELECT * from usuarios WHERE username LIKE '{$username}' AND password LIKE '{$password}' LIMIT 1");
		
		if (!$result->num_rows == 1) {
			#Invalid username/password combination
			echo "nopass";
		}else{
			
			$row = mysqli_fetch_array($result);
			
			if($app_version<9){
				echo "update";
			}else{
				$sql = "UPDATE usuarios SET version='{$app_version}' WHERE username LIKE '{$username}'";
				$mysqli->query($sql);
				
				date_default_timezone_set("Europe/Madrid");
				$timestamp=date_default_timezone_get();
				$mydate = date('Y-m-d H:i:s', strtotime($timestamp));
				
				$row_array['id'] = $row['id'];
				$row_array['username'] = $row['username'];
				$row_array['password'] = $row['password'];
				$row_array['lights'] = $row['lights'];
				$row_array['part_openfuture'] = $row['part_openfuture'];
				$row_array['type'] = $row['type'];
				$row_array['part_schools'] = $row['part_schools'];
				
				$result = $mysqli->query("SELECT COUNT(*) AS times_in FROM analytics_basic WHERE type='logged_in' and user_id in (SELECT id FROM usuarios WHERE username='{$username}')");
				$row = mysqli_fetch_array($result);
				$row_array['times_in'] = $row['times_in'];
				
				$query="INSERT INTO analytics_basic (user_id, type,datetime) VALUES ((SELECT id FROM usuarios WHERE username='{$username}'), 'logged_in','{$mydate}') ";
				$mysqli->query($query);
				
				echo json_encode($row_array);
			}
			
		}
		
		?>