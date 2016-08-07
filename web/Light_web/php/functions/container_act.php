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
		
		$container_id	= $_GET['container_id'];
		
		date_default_timezone_set("Europe/Madrid");
		$timestamp=date_default_timezone_get();
		$mydate = date('Y-m-d H:i:s', strtotime($timestamp));

		$sql="SELECT id FROM `acts_reciclaje` WHERE container_id=0 AND UNIX_TIMESTAMP('{$mydate}') - UNIX_TIMESTAMP(datetime_user)  <30";
		$result = $mysqli->query($sql);
		
		$sql="SELECT id FROM `acts_reciclaje` WHERE container_id={$container_id} AND user_id<>0 AND val_container=0";
		$result2 = $mysqli->query($sql);
		
		if ($result->num_rows >= 1 or $result2->num_rows >= 1) {
			if($result->num_rows >= 1){
				$row = mysqli_fetch_array($result);
				$id=$row['id'];
				$sql = "UPDATE `acts_reciclaje` SET container_id={$container_id}, datetime_container='{$mydate}', val_container=1 WHERE id={$id}";
			}else{
				$row = mysqli_fetch_array($result2);
				$id=$row['id'];
				$sql = "UPDATE `acts_reciclaje` SET container_id={$container_id}, val_container=1 WHERE id={$id}";
			}
			$result = $mysqli->query($sql);
			
			echo "ok";
			
			$sql="DELETE FROM `acts_reciclaje` WHERE container_id=0 OR user_id=0";
		$result = $mysqli->query($sql);
		}else{
				echo "sync";
				$sql="SELECT id FROM `acts_reciclaje` WHERE container_id ={$container_id} AND user_id =0 ";
				$result = $mysqli->query($sql);
				
				if (!$result->num_rows >= 1) {
					$sql = "INSERT INTO acts_reciclaje (container_id, datetime_container) VALUES ({$container_id},'{$mydate}') ";
					$result = $mysqli->query($sql);
				}
		}
		?>