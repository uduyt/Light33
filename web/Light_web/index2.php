<!DOCTYPE html>
<html>
	<head>
		<?php 
		session_start();
		if(isset($_SESSION['username'])){
			header('Refresh:0; url=/profile/');
		}
		include $_SERVER['DOCUMENT_ROOT'] . '/php/imports.php'; 
		?>
		<title>Light</title>
	</head>
	

<body id="login_container">
<span></span>
		<div class="mdl-card mdl-shadow--16dp demo-card-wide login_card">
	  <div class="mdl-card__title login_card">
		<h2 class="mdl-card__title-text">Iniciar Sesión</h2>
	  </div>
	  
	  <?php if(isset($_GET['loginerror'])){
		  if ($_GET['loginerror']==true){
			  echo "<p style='color:red; position: absolute; margin-left: 40px; margin-top: 10px; font-weight: 700;'>Invalid username/password</p>";
			  $_GET['loginerror']=false;
		  }
	  }
		  ?>
	  
	  <form style="padding-bottom:0px" class="login_form" action="/php/login.php" method="post">
		  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
			<input class="mdl-textfield__input" type="text" name="username" />
			<label class="mdl-textfield__label" >Nombre de Usuario</label>
		  </div>

		  
		  <div style="top:13px" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
			<input class="mdl-textfield__input" type="password" name="password"/>
			<label class="mdl-textfield__label" >Contraseña</label>
		  </div>

		<input style="left:80px; top:50px;"class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" value="Iniciar Sesión"> 

</form>
	  
	  <div class="mdl-card__menu">
		<button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
		  <i class="material-icons">share</i>
		</button>
	  </div>
	</div>
			
</body>

</html>