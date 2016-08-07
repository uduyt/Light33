<?php 
	
	include $_SERVER['DOCUMENT_ROOT'] . '/functions/send_to_stripe.php'; 
	
	//include $_SERVER['DOCUMENT_ROOT'] . '/php/db_connect'; 
	header("Content-Type: text/html;charset=utf-8");
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
	$acentos = $mysqli->query("SET NAMES 'utf8'");
	
	$fid= $_GET['facebook_id'];
	$entry_id= $_GET['entry_id'];
	$people= $_GET['people'];
	$contact_method= $_GET['contact_method'];
	$data= $_GET['data'];
	$contact_data= $_GET['contact_data'];
	$promo_code= $_GET['promo_code'];
	$payment_method= $_GET['payment_method'];
	$payment_token= $_GET['payment_token'];
	$payment_last4= $_GET['payment_last_4'];
	
	date_default_timezone_set("Europe/Madrid");
		$timestamp=date_default_timezone_get();
		$mydate = date('Y-m-d H:i:s', strtotime($timestamp));
		
	if($data!="none"){
		$data_array=json_decode($data,true);
		for($i=0;$i<$people;$i++){
				
			$sql="INSERT INTO orders(user_id,people,contact,contact_data,datetime,entry_id,order_name,order_second_name,order_dni,order_dob,promo_code,payment_method, payment_token, payment_last4) VALUES ((SELECT id
																	FROM users
																	WHERE facebook_id={$fid}
																	LIMIT 1) ,{$people},'{$contact_method}','{$contact_data}','{$mydate}',{$entry_id},'{$data_array[$i]["name"]}','{$data_array[$i]["second_name"]}','{$data_array[$i]["dni"]}','{$data_array[$i]["dob"]}','{$promo_code}','{$payment_method}','{$payment_token}','{$payment_last4}')";
			
			$result = $mysqli->query($sql);
					
		}
	}else{
		$sql="INSERT INTO orders(user_id,people,contact,contact_data,datetime,entry_id,order_name,order_dni,order_dob,promo_code,payment_method, payment_token, payment_last4) VALUES ((SELECT id
																	FROM users
																	WHERE facebook_id={$fid}
																	LIMIT 1) ,{$people},'{$contact_method}','{$contact_data}','{$mydate}',{$entry_id},'none','none','none','{$promo_code}','{$payment_method}','{$payment_token}','{$payment_last4}')";
																	
			
			$result = $mysqli->query($sql);
	}
	
	
	if($contact_method!="none"){
		$contact_method= "\nContacto: " . $contact_method;
		if($contact_method!="facebook"){
			$contact_data= "\nDatos de contacto: " . $contact_data;
		}else{
			$contact_data= "";
		}
	}else{
		$contact_method= "";
	}
	if($promo_code!="none"){
		$promo_code= "\nCódigo de promoción: " . $promo_code;
	}else{
		$promo_code= "";
	}
	
	
		
	
	
	$sql="SELECT event_id, price, name FROM entries WHERE entry_id={$entry_id}";
	$result = $mysqli->query($sql);										
	$row = mysqli_fetch_array($result);
	$event_id=$row['event_id'];
	$price=$row['price'];
	$price=$price*$people;
	$type=$row['name'];
	
	
	
	$sql="SELECT name FROM cities WHERE id IN (SELECT city_id 
												FROM clubs
												WHERE club_id IN (SELECT club_id
																	FROM events
																	WHERE event_id = {$event_id}
																	)
												)";
	$result = $mysqli->query($sql);										
	$row = mysqli_fetch_array($result);
	$city_name=$row['name'];
	
	$sql="SELECT club_name FROM clubs WHERE club_id IN (SELECT club_id
														FROM events
														WHERE event_id = {$event_id}
														)";
	$result = $mysqli->query($sql);										
	$row = mysqli_fetch_array($result);
	$club_name=$row['club_name'];
	
	$sql="SELECT event_name
			FROM events
			WHERE event_id = {$event_id}";
	$result = $mysqli->query($sql);										
	$row = mysqli_fetch_array($result);
	$event_name=$row['event_name'];
	
	$sql="SELECT name, email		
			FROM users
			WHERE facebook_id = '{$fid}'";
	$result = $mysqli->query($sql);										
	$row = mysqli_fetch_array($result);
	$user_name=$row['name'];
	$user_email=$row['email'];
	
	
	
	$to = "carlos.rosety@gmail.com";
	$subject = "Nueva reserva en " .$event_name . ", " . $city_name ;
	$txt =    "Nueva reserva en " .$event_name . ", " . $city_name
			. "\n\nNombre: " . $user_name
			. "\nPersonas: " . $people
			. "\nTipo de Reserva: " . $type
			. $contact_method
			. $promo_code
			. $contact_data
			. "\nPerfil de facebook: https://www.facebook.com/" . $fid
			. "\nPrecio: "  . $price . "€";
			
	$headers = "From: listas@diverapp.es" ;

	mail($to,$subject,$txt, $headers);

	if($payment_method=="credit_card"){
		ChargeStripe($price*100,"Reserva de " . $user_name . ", con perfil de facebook: https://www.facebook.com/" . $fid . " en " . $event_name. ", " . $city_name ,$payment_token);
	}else{
		echo "ok";
	}
	
?>