		<?php 
		session_start();
		session_destroy();
		header('Refresh:0; url=/login/');
	?>
<html>
<head>
<?php
		include $_SERVER['DOCUMENT_ROOT'] . '/php/imports.php';?>
		<title>Light</title>
	</head>
	
	<body id="login_container">
<span></span>

	<div class="mdl-spinner mdl-spinner--single-color mdl-js-spinner is-active spinner_centered"></div>
	<p class="p_spinner"> Logging out... please wait </p> 

	

	
</body>
</html>