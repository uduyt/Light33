<!DOCTYPE html>
<html>
	<head>
		<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/imports.php';
		session_start();
		$title='Mi perfil'	;	?>
		<title>Light</title>
		<link href="/imports/style.css" rel="stylesheet" type="text/css" media="screen"  />
	</head>
	
	
		<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/headbar1.php'; ?>
		
	  
	<body>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/navigation_drawer.php'; ?>
	
	
	  <main class="mdl-layout__content">
	<div class="page_content_margins">
	
		<div class="page_content">
	
					<div class="mdl-card mdl-shadow--2dp demo-card-wide page_card">
					<div class="mdl-card__title login_card">
				<h2 class="mdl-card__title-text">Perfil</h2>
				</div>
	</div>
	</div>
	
	</div>
  </main>
</div>
	
	
	
<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php'; ?> 
  
	</body>
</html>
