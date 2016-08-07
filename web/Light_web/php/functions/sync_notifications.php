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
	$notifications_result = $mysqli->query("SELECT * from notificaciones  WHERE user_id={$user_id} OR topic='global' ORDER BY date DESC");
	
	if ($notifications_result->num_rows <1) {
		//ningun paquete asociado
		$notifications['error']="no notification associated";
	}else{
		$notifications['error']="false";
		
		   while($r = $notifications_result->fetch_assoc()) {
			 $notifications['values'][] = $r;
		   }
	}
		
	echo json_encode($notifications);
	
?>