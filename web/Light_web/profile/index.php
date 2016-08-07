<!DOCTYPE html>
<html>
	<head>
		<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/imports.php';
			session_start();
			$title='Mi perfil'	;	
			session_start();
			if($_SESSION['type']=="admin"){
				$url="/admin/";
				header("Refresh:0; url= /admin/");
			}else if($_SESSION['type']=="school"){
				$url="/manage/";
				header("Refresh:0; url= /manage/");
			}else if($_SESSION['type']=="usuario"){
				//rightly logged in
				//$url="/profile/";
				//header("Refresh:0; url= /profile/");
			}else{
				header("Refresh:0; url= /login/");
			}

		
		
		?>
		<title>Light</title>
		<link href="/imports/style.css" rel="stylesheet" type="text/css" media="screen"  />
	</head>
	
	
		<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/headbar1.php'; ?>
		
	  
	<body>
	
	<?php 
	//temporarily down
	//include $_SERVER['DOCUMENT_ROOT'] . '/php/navigation_drawer.php'; ?>
	
	
	  <main class="mdl-layout__content">
	<div class="page_content_margins">
	
		<div class="page_content">
	
					<div class="mdl-card mdl-shadow--2dp demo-card-wide page_card">
					<div class="mdl-card__title login_card">
				
				<p> La página web de light todavía no está operativa para los usuarios, ¡llegaremos dentro de poco! :)
				</div>
	</div>
	</div>
	
	</div>
  </main>
</div>
	
	
	
<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php'; ?> 
  
	</body>
</html>
