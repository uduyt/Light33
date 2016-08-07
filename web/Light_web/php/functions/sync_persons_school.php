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
		
		$user_id = $_GET['user_id'];

		//solicitar personas a la DB
		$persons_result = $mysqli->query("SELECT id, username, lights from usuarios WHERE times_in>0 AND school=(SELECT school FROM usuarios WHERE id = {$user_id}) order by lights desc" );
		
		if ($persons_result->num_rows <1) {
			//ninguna persona asociada
			$persons['error']="no hay usuarios en esa clase";
		}else{
			$persons['error']="false";
			
			   while($r = $persons_result->fetch_assoc()) {
				 $persons['values'][] = $r;
			   }
		}
			
			echo json_encode($persons);
		
		?>