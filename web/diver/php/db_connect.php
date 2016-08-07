<?php	
	# mysql db constants DB_HOST, DB_USER, DB_PASS, DB_NAME
		const DB_HOST = 'diverapp.es.mysql';		 
		const DB_USER = "diverapp_es";				 
		const DB_PASS = 'Ruh6dGBv';
		const DB_NAME = 'diverapp_es';

		
		# connect mysql server
		$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		
		# check connection
		if ($mysqli->connet_errno) {
			//echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
			echo 'error in db connection';
			exit();
		}
		
		?>