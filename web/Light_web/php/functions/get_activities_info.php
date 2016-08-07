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
		
		$user_id	= $_GET['user_id'];
		
		$result1 = $mysqli->query("SELECT value_int FROM analytics_basic WHERE user_id={$user_id} AND type='recycliot' AND DAY(DATE(datetime)) = DAY(DATE_ADD(NOW(), INTERVAL 2 HOUR))  ORDER BY value_int DESC");
		$result2 = $mysqli->query("SELECT value_int FROM analytics_basic WHERE user_id={$user_id} AND type='mobility' AND DAY(DATE(datetime)) = DAY(DATE_ADD(NOW(), INTERVAL 2 HOUR)) ORDER BY value_int desc");
		
		if ($result1->num_rows >= 2) {
			$result['recycliot']['times']=2;
		}else if ($result1->num_rows ==0){
			$result['recycliot']['times']=0;
		}else{
			$result['recycliot']['times']=1;
			$row = mysqli_fetch_array($result1);
			$result['recycliot']['datetime']=$row['value_int'];
		}
		
		if ($result2->num_rows >= 2) {
			$result['mobility']['times']=2;
		}else if ($result2->num_rows ==0){
			$result['mobility']['times']=0;
		}else{
			$result['mobility']['times']=1;
			$row = mysqli_fetch_array($result2);
			$result['mobility']['datetime']=$row['value_int'];
		}
		
		echo json_encode($result);
		
		
		?>