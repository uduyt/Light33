<!DOCTYPE html>
<html>

<head>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/imports.php';
		session_start();
		if($_SESSION['type']=="admin"){
			$url="/admin/";
			header("Refresh:0; url= /admin/");
		}else if($_SESSION['type']=="school"){
			$url="/manage/";
			header("Refresh:0; url= /manage/");
		}else if($_SESSION['type']=="usuario"){
			//todavía no está operativa, no hay cierre de sesión en usuarios
			//$url="/profile/";
			//header("Refresh:0; url= /profile/");
		}else{
			//header("Refresh:0; url= /login/");
		}

	?>
	<title>Light->Log in</title>
	<link href="style_index.css" rel="stylesheet" type="text/css" media="screen"  />
	<script type="text/javascript">
	
	$(document).ready(function(){
		$("#submit").click(function(){
			$("#sub").click();
		});
	});
	
	
	</script>
</head>
	
<body style="background:#039BE5;">

	<div class="form">
		<form style="max-width: 330px;padding: 20px;" action="/php/login.php" method="post">

			<div style="width:100px; height:100px; margin: 0 auto; background-size: cover; background-image: url('/images/logo.png');"></div>
			<p style="color:red;margin-bottom: -10px;"><?php if($_GET["loginerror"]==true){echo "El usuario o contraseña introducidos no son correctos";}?></p>
			<input style="display:none" type="text" id="url2" name="url2" value="/login/">
			
			<div style="margin-top: 15px;" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					<input class="mdl-textfield__input" type="text" name="username" id="sample3">
					<label class="mdl-textfield__label" for="sample3">Usuario</label>
				</div>	
			
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="password" name="password" id="sample4">
				<label class="mdl-textfield__label" for="sample4">Contraseña</label>
			</div>
			
			<input style="display:none" id="sub"type="submit">	
			</input>
				
		</form>
		<button id="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
			<i class="material-icons">arrow_forward</i>
		</button>
	</div>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php'; ?> 
  
</body>
</html>
