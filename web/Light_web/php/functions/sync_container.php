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
		
		$user_id = $_GET['user_id'];
		$id = $_GET['id'];
		
		date_default_timezone_set("Europe/Madrid");
		$timestamp=date_default_timezone_get();
		$mydate = date('Y-m-d H:i:s', strtotime($timestamp));

		$sql="SELECT id FROM `acts_reciclaje` WHERE user_id =0 AND val_user=0 AND UNIX_TIMESTAMP('{$mydate}') - UNIX_TIMESTAMP(datetime_container)  <30";
		$result = $mysqli->query($sql);
		
		$sql="SELECT id FROM `acts_reciclaje` WHERE user_id={$user_id} AND container_id<>0 AND val_user=0";
		$result2 = $mysqli->query($sql);
		
		if ($result->num_rows >= 1 or $result2->num_rows >= 1) {
			$echo[0]="ok";
			
			$sql = "UPDATE usuarios SET lights=lights+10 WHERE id={$user_id}";
		$result = $mysqli->query($sql);
			
			if($result->num_rows >= 1){
				$row = mysqli_fetch_array($result);
				$echo[1]="solo container";
				$container_id=$row['id'];
				$sql = "UPDATE `acts_reciclaje` SET user_id={$user_id}, datetime_user='{$mydate}', val_user=1 WHERE id={$container_id}";
			$result = $mysqli->query($sql);
			}else{
				$row = mysqli_fetch_array($result2);
				$echo[1]="mi entrada";
				$container_id=$row['id'];
				$sql = "UPDATE `acts_reciclaje` SET user_id={$user_id}, val_user=1 WHERE id={$container_id}";
			$result = $mysqli->query($sql);
			}
			
			
			
			
			
			$sql="DELETE FROM `acts_reciclaje` WHERE container_id=0 OR user_id=0";
			$result = $mysqli->query($sql);
			
			
		}else{
			$echo[0]="sync";
				$sql="SELECT id FROM `acts_reciclaje` WHERE user_id ={$user_id} AND container_id =0 ";
				$result = $mysqli->query($sql);
				
				$sql="SELECT id FROM `acts_reciclaje` WHERE UNIX_TIMESTAMP('{$mydate}')- UNIX_TIMESTAMP(datetime_user)<3 ";
				$result2 = $mysqli->query($sql);
				
				if (!$result->num_rows >= 1 or !$result->num_rows >= 1) {
					$sql = "INSERT INTO acts_reciclaje (user_id, datetime_user) VALUES ({$user_id},'{$mydate}') ";
					$result = $mysqli->query($sql);
					
					$sql="SELECT id FROM `acts_reciclaje` WHERE user_id ={$user_id} AND container_id =0 ";
					$result = $mysqli->query($sql);
					
				}
				
				$row = mysqli_fetch_array($result);
				$container_id=$row['id'];
				$echo[1]=$container_id;
		}
		echo json_encode($echo);
	
		
		?>