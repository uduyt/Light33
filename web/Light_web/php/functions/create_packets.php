
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

		$num_packets= $_GET['num'];

		for ($i=0;$i<$num_packets;$i++){
			
			$packet_code=rand(1,9999);
			
			$result = $mysqli->query("SELECT * FROM paquetes WHERE packetID='{$packet_code}'");
			
			if ($result->num_rows == 0) {
				$sql = "INSERT INTO paquetes (packetID) VALUES ('{$packet_code}')";
				
				$mysqli->query($sql);
				
				echo $sql;
			}else{
				$i--;
				
				echo "1__________1";
			}
			
			
		}
		
		?>