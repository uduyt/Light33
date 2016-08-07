
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
		
		$username	= $_POST['username'];
		$password	= $_POST['password'];
		$url2		= $_POST['url2'];
		
		$result = $mysqli->query("SELECT * from usuarios WHERE username LIKE '{$username}' AND password LIKE '{$password}' LIMIT 1");
		
		//echo $username . ", " . $password . ", " . $url;
		
		if (!$result->num_rows == 1) {
			#Invalid username/password combination
			header('Refresh:0; url= ' . $url2 . '?loginerror=true');
		} else {
			session_start();
			$_SESSION['username']=$username;
					
			$result = $mysqli->query("SELECT * from usuarios WHERE username LIKE '{$username}' LIMIT 1");
			$user = $result->fetch_array(MYSQLI_ASSOC);	  
			
			$_SESSION['id']=$user['id'] ;
			$_SESSION['password']=$user['password'] ;
			$_SESSION['name']=$user['name'] ;
			$_SESSION['email']=$user['email'] ;
			$_SESSION['lights']=$user['lights']; 
			$_SESSION['type']=$user['type'];
			//$_SESSION['experience']=$user['experience']; 
			$_SESSION['level']=$user['level']; 
			$_SESSION['date_in']=$user['date_in']; 
			//$_SESSION['location']=$user['location']; 
			$_SESSION['times_in']=$user['times_in']; 
			//$_SESSION['clearance']=$user['clearance']; 
			
			$_SESSION['times_in']+=1;
			
			if($_SESSION['type']=="admin"){
				$url="/admin/";
			}else if($_SESSION['type']=="school"){
				$url="/manage/";
			}else if($_SESSION['type']=="usuario"){
				$url="/profile/";
			}
		
			date_default_timezone_set("Europe/Madrid");
			$query="UPDATE usuarios SET times_in='" .$_SESSION['times_in']."', date_in='". date('Y-m-d')  ."', time_in='" . date('H:i:sO+0200')    ."' WHERE username='$username'";
			
			$result = $mysqli->query($query);
			header('Refresh:0; url=' . $url);
		}?>
		<html>
<head>
<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/php/imports.php'; 
					
		?>
		<title>Light</title>
	</head>
	
	<body id="login_container">
<span></span>

	<div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner is-active spinner_centered"></div>
	<p class="p_spinner"> Logging in... please wait </p> 

	

	
</body>
</html>