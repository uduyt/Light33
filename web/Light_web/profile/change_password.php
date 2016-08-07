
		<?php 
		session_start();

 include $_SERVER['DOCUMENT_ROOT'] . '/php/mysql_connect.php';   
	
		if (!($_POST['old_pass']==$_SESSION['password'])){
			
			header('Refresh:0; url=/profile/settings.php?error=oldpass');
			exit();
		}else{
			if(!($_POST['new_pass']==$_POST['new_pass_confirmed'])){
			header('Refresh:0; url=/profile/settings.php?error=newpass');	
			exit();
			}else{
				
				$query="UPDATE usuarios SET password='" .$_POST['new_pass'] ."'  WHERE username='" .$_SESSION['username']. "'";
	$result = $mysqli->query($query);
	$_SESSION['password']=$_POST['new_pass'];
				header('Refresh:0; url=/profile/settings.php?error=none');
				
			}
		}
		
	?>
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
	<p class="p_spinner"> Cambiando contraseña...por favor espere </p> 

	

	
</body>
</html>