<!DOCTYPE html>
<html>
	<head>
		<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/imports.php';
		session_start();
		$title='Ajustes'	;	?>
		<title>Light</title>
	</head>
	
		<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/headbar1.php'; ?>
		
	<body>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/navigation_drawer.php'; ?>
	
  <main class="mdl-layout__content">
    <div class="page_content_margins">
	
		<div class="page_content">
	
					<div class="mdl-card mdl-shadow--2dp demo-card-wide page_card">
			  <div class="mdl-card__title login_card">
				<h2 class="mdl-card__title-text">Cambiar contraseña</h2>
			  </div>
			  
			<?php if(isset($_GET['error'])){
			if ($_GET['error']=='none'){
			  echo "<p style='color:green; position: absolute; margin-left: 40px; margin-top: 10px; font-weight: 700;'>La contraseña ha sido cambiada con éxito</p>";
			  $_GET['error']='';	
			  
		  }else{
			  if ($_GET['error']=='oldpass'){
				 echo "<p style='color:red; position: absolute; margin-left: 40px; margin-top: 10px; font-weight: 700;'>La antigua contraseña no es correcta</p>";
				$_GET['error']='';				 
			  }else{
				  if ($_GET['error']=='newpass'){
				 echo "<p style='color:red; position: absolute; margin-left: 40px; margin-top: 10px; font-weight: 700;'>Los dos últimos campos deben ser iguales</p>";
				$_GET['error']='';	
			  }
			  
		  }
			}}?>
	  
			
			  
			<form style="padding-bottom:10px;" class="login_form" action="/profile/change_password.php" method="post">
				<div style="display:inline-block;">
				  <div style="display:block" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
					<input class="mdl-textfield__input" type="password" name="old_pass" />
					<label class="mdl-textfield__label" >Contraseña antigua</label>
				  </div>
				
				  <div style="display:block" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
					<input class="mdl-textfield__input" type="password" name="new_pass"/>
					<label class="mdl-textfield__label" >Nueva contraseña</label>
				  </div>

				  <div style="display:block" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label textfield-demo">
					<input class="mdl-textfield__input" type="password" name="new_pass_confirmed"/>
					<label class="mdl-textfield__label" >Confirmar nueva contraseña</label>
				  </div>
				 </div>
				<div style="display: inline; position: relative; left: 195px;">
				<input class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" value="Cambiar contraseña"> 
				</div>
			</form>
	</div>
  </main>
</div>
		
<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php'; ?> 
  
	</body>
</html>
