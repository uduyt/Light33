<!DOCTYPE html>
<html>

<head>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/imports.php';
	
		session_start();
		$title='Admin';	
	?>
	
	<link href="/imports/style.css" rel="stylesheet" type="text/css" media="screen"  />
	
	<title>Light</title>
</head>
	
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
	
	<span class="mdl-layout-title" style="position:absolute; top:22px;"><?php echo $title ?></span>
      <!-- Add spacer, to align navigation to the right -->
	  <div class="spacer"></div>
	  <a href="/php/logout.php" class="mdl-navigation__link mdl-navigation__link--icon" style="padding:0px !important;"><i style="vertical-align:middle; margin-right:5px;" class="material-icons">exit_to_app</i><span>Cerrar sesión</span></a>
    </div>
  </header>
		
	<body>
	
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/navigation_drawer.php'; ?>
	
<main class="mdl-layout__content">
	<form>
</main>
	
	
	
<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php'; ?> 
  
	</body>
</html>
