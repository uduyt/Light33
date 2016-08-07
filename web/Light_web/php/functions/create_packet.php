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
		
		$packet_code	= $_GET['packet_code'];
		$lids_number	= $_GET['lids_number'];
		$user_id	= $_GET['user_id'];
		
		$result = $mysqli->query("SELECT * from paquetes WHERE packetID LIKE '{$packet_code}' LIMIT 1");

		if (!$result->num_rows == 1) {
			#Invalid username/password combination
			echo "no code alike";
		}else{
			$row = mysqli_fetch_array($result);
			
			if ($row['user_id']!=null){
				echo "code already exists";
			}else{
				date_default_timezone_set("Europe/Madrid");
				$timestamp=date_default_timezone_get();
				$mydate = date('Y-m-d H:i:s', strtotime($timestamp));

				$sql = "UPDATE paquetes SET user_id='{$user_id}', lids_num='{$lids_number}', state='generado' , date_created='{$mydate}' WHERE packetID='{$packet_code}'";

				if ($mysqli->query($sql) === TRUE) {
					echo "success";
				} else {
					echo "error with server";
				}
			}
		}
		
		?>