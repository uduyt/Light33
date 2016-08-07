<!DOCTYPE html>
<html>

<head>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/imports.php';
	
				session_start();
		if($_SESSION['type']=="admin"){
			//rightly logged in
			//$url="/admin/";
			//header("Refresh:0; url= /admin/");
			$title="Admin";
		}else if($_SESSION['type']=="school"){
			
			$url="/manage/";
			header("Refresh:0; url= /manage/");
		}else if($_SESSION['type']=="usuario"){
			$url="/profile/";
			header("Refresh:0; url= /profile/");
		}else{
			header("Refresh:0; url= /login/");
		}

	?>
	
	<link href="/imports/style.css" rel="stylesheet" type="text/css" media="screen"  />
	
	<title>Light</title>
	
	<script type="text/javascript">
	
	$(document).ready(function(){
		$("#submit").click(function(){
			$("#sub").click();
		});
	});
	
	$(document).ready(function(){
		$("#submit2").click(function(){
			$("#sub2").click();
		});
	});
	
	
	</script>
	
	<style>

		.form{
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		
		background: #ffffff;
		border-radius: 20px;
		padding-left: 10px;
		padding-right: 30px;
	}

	#submit, #submit2{
		position: absolute;
		background:#01579B;
		float: right;
		bottom: 10px;
		right: -28px;
	}
	</style>
	
	
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
	<main class="mdl-layout__content">
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/navigation_drawer.php'; ?>
	

	<div class="page_content_margins">
		<div class="page_content" style="width: 800px;">
			<div style="overflow:initial;min-height: 300px;" class="mdl-card mdl-shadow--2dp demo-card-wide page_card">
				<div style="padding-left: 20px;" class="mdl-card__title login_card">
					<h2 class="mdl-card__title-text">Notificaci&oacuten a topic</h2>
								
					
				</div>
				<form style="position: absolute;bottom: 10px; left:20px;" action="/php/functions/gcm_send.php" method="get">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" name="title">
						<label class="mdl-textfield__label" for="sample4">Titulo</label>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" name="text">
						<label class="mdl-textfield__label" for="sample4">Texto</label>
					</div>	
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" name="type">
						<label class="mdl-textfield__label" for="sample4">Tipo</label>
					</div>	
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" name="link">
						<label class="mdl-textfield__label" for="sample4">Link</label>
					</div>	
					
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" name="topic">
						<label class="mdl-textfield__label" for="sample3">Topic</label>
					</div>
						
						<input style="display:none" type="text" id="url" name="url" value="admin/admin.php">
						<input style="display:none" id="sub"type="submit">
							
						</input>
					
				</form>
				<button id="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
					<i class="material-icons">send</i>
				</button>
			</div>
			
			<div style="overflow:initial; margin-top: 50px;min-height: 300px;" class="mdl-card mdl-shadow--2dp demo-card-wide page_card">
				<div style="padding-left: 20px;" class="mdl-card__title login_card">
					<h2 class="mdl-card__title-text">Notificaci&oacuten a nombre de usuario</h2>
								
					
				</div>
				<form style="position: absolute; bottom: 10px; left:20px;" action="/php/functions/gcm_send_specific.php" method="get">
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" name="title">
						<label class="mdl-textfield__label" for="sample4">Titulo</label>
					</div>
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" name="text">
						<label class="mdl-textfield__label" for="sample4">Texto</label>
					</div>	
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" name="type">
						<label class="mdl-textfield__label" for="sample4">Tipo</label>
					</div>	
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" name="link">
						<label class="mdl-textfield__label" for="sample4">Link</label>
					</div>	
					
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" name="username">
						<label class="mdl-textfield__label" for="sample3">Nombre de usuario</label>
					</div>
						
						<input style="display:none" type="text" id="url" name="url" value="admin/admin.php">
						<input style="display:none" id="sub2"type="submit">
							
						</input>
					
				</form>
				<button id="submit2" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
					<i class="material-icons">send</i>
				</button>
			</div>
		</div>
	
	</div>
 </main>
	
	
	
<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php'; ?> 
  
	</body>
</html>
