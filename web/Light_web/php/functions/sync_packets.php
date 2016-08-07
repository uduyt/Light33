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
		
		$user_id= $_GET['id'];

		//solicitar paquetes del usuario a la DB
		$packets_result = $mysqli->query("SELECT * from paquetes WHERE user_id={$user_id} ORDER BY date_created DESC" );
		
		if ($packets_result->num_rows <1) {
			//ningun paquete asociado
			$paquetes['error']="no packet associated";
		}else{
			$paquetes['error']="false";
			
			   while($r = $packets_result->fetch_assoc()) {
				 $paquetes['values'][] = $r;
			   }
		}
			
			echo json_encode($paquetes);
		
		?>