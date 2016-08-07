<!DOCTYPE html>
<html>

<head>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/php/imports.php';
	
		session_start();
		if($_SESSION['type']=="admin"){
			$url="/admin/";
			header("Refresh:0; url= /admin/");
		}else if($_SESSION['type']=="school"){
			//rightly logged in
			//$url="/manage/";
			//header("Refresh:0; url= /manage/");
		}else if($_SESSION['type']=="usuario"){
			$url="/profile/";
			header("Refresh:0; url= /profile/");
		}else{
			header("Refresh:0; url= /login/");
		}
		
	?>
	
	<link href="/imports/style.css" rel="stylesheet" type="text/css" media="screen"  />
	<link href="style_index.css" rel="stylesheet" type="text/css" media="screen"  />
	
	<title><?php echo $_SESSION['name'];?></title>
	
	<script type="text/javascript">
	
	ids= new Array();
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
	
	function search(view){
		var val=view.value;
		var entries = document.getElementById("entries").children;

		for(i=0;i<entries.length;i++){
			if(entries[i].id.substring(2).indexOf(val)>-1){
				if(!isInArray(entries[i].id.substring(2),ids)){
					entries[i].style.display="initial";
				}
			}else{
				entries[i].style.display="none";
			}
		}
	}
	
	function isInArray(value, array) {
		return array.indexOf(value) > -1;
	}

	function onfocused(view){
		var id=view.id.substring(2);
		var button=document.getElementById("bt" + id);
		if(view.value.length>0){
			button.style.visibility="visible";
		}else{
			button.style.visibility="hidden";
		}
	}
	
	function validate(view){
		var id=view.id.substring(2);
		sendToServer(id,"validado","-1");
		
		remove(id);
	}
	
	function cheat(view){
		var id=view.id.substring(2);
		var input=document.getElementById("in" + id);
		var lids=input.value;
		
		sendToServer(id,"cancelado",lids);
		remove(id);
	}
	
	function remove(id){
		var div=document.getElementById("dv" + id);
		div.style.opacity="0";
		setTimeout(function(){
			var div=document.getElementById("dv" + id);
			div.style.display="none";
			ids[ids.length]=id;
		}, 400);
	}
	
	function sendToServer(id,state,lids_num) {
		var url="http://lightbeta.esy.es/php/functions/validate_packet.php?id=" + id + "&state=" + state + "&lids_num=" + lids_num;
		var req = false;
		try{
			// most browsers
			req = new XMLHttpRequest();
		} catch (e){
			// IE
			try{
				req = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				// try an older version
				try{
					req = new ActiveXObject("Microsoft.XMLHTTP");
				} catch(e) {
					return false;
				}
			}
		}
		if (!req) return false;
		req.open("GET", url, true);
		req.send();
		return req;
	}
	</script>
	
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
		<div class="mdl-layout__content">
		<?php //include $_SERVER['DOCUMENT_ROOT'] . '/php/navigation_drawer.php'; ?>

			<div class="page_content_margins">
				<div class="page_content" style="width: 850px;">
					<div style="padding: 30px;overflow:initial;min-height: 300px;" class="mdl-card mdl-shadow--2dp demo-card-wide page_card">
						<div>
							<h2 style="color: #0189C7;align-self: initial;display: inline;" class="mdl-card__title-text">Validación de paquetes. Haz click para buscar: </h2>
							<!-- Expandable Textfield -->
							<form style="display: inline;" action="#">
							  <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
								<label class="mdl-button mdl-js-button mdl-button--icon" for="sample6">
								
									<i class="material-icons">search</i>
								</label>
								<div class="mdl-textfield__expandable-holder">
									
									<input class="mdl-textfield__input" onchange="search(this);" oninput="this.onchange();" onkeyup="this.onchange();" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="sample6">
									<label class="mdl-textfield__label" for="sample-expandable">Expandable Input</label>
									<span class="mdl-textfield__error">¡Tiene que ser un número!</span>
									
								</div>
							  </div>
							</form>
						</div>
						
						<hr>
						<div id="entries" style="padding-top:10px">
							
					
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
							
							$result = $mysqli->query("SELECT * from paquetes WHERE state='depositado' ORDER BY packetID asc");
							
							if ($result->num_rows < 1) {
								echo "todos los paquetes están validados :)";
							} else { 
								while($r = $result->fetch_assoc()){
									$id=$r['packetID'];
									if(strlen($id)<4){
										if(4-strlen($id)==1){
											$id="0".$id;
										}
										if(4-strlen($id)==2){
											$id="00".$id;
										}
										if(4-strlen($id)==3){
											$id="000".$id;
										}
									}
									$lids=$r['lids_num'];
									if(strlen($lids)<2){
										$lids="0".$lids;
									}
									echo '
												
									<div id="dv'. $id . '" class="entry" style="padding-left:20px;transition: opacity 0.4s ease-in-out;">
										<span style="font-size: 20px;color: #01579B;">RecyPackCode: </span>
										<span style="font-weight: bold; font-size: 20px;">'. $id . '</span>
										<span style="margin-left: 70px; font-size: 20px;color: #01579B;">Tapones: </span>
										<span style="font-size: 30px; font-weight: bold;">'. $lids . '</span>
										<span style="width: 30px; background-image: url(/images/tapon.png); height: 30px; background-size: cover;"></span>
										<!-- Mini FAB button -->
										<button id="vl'. $id . '" onclick="validate(this)" style="margin-left: 40px;background-color:#01579B;background: #0277BD; height: 30px; min-width: 30px; width: 30px;" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored validate">
											<i class="material-icons">done</i>
										</button>
										<form style="display: inline;" action="#">
											<div style="padding-bottom: 23px;" class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
												<label class="mdl-button mdl-js-button mdl-button--icon" for="in'. $id . '">
													<i class="material-icons">clear</i>
												</label>
												<div class="mdl-textfield__expandable-holder">
													<input class="mdl-textfield__input" onchange="onfocused(this);" oninput="this.onchange();" onkeyup="this.onchange();" placeholder="nº tapones" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="in'. $id . '">
													<label class="mdl-textfield__label" for="in'. $id . '">nº tapones que hay en realidad</label>
													<span class="mdl-textfield__error">¡Tiene que ser un número!</span>
													<button id="bt'. $id . '" onclick="cheat(this)" style="visibility:hidden; margin-bottom: -15px;margin-left: 175px;background-color:#01579B;background: #0277BD; height: 20px; min-width: 20px; width: 20px;" class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored">
														<i class="material-icons">done</i>
													</button>
												</div>
											</div>
										</form>
										<hr>
									</div>
									';
									
									
								}
							}
							?>
											
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php //include $_SERVER['DOCUMENT_ROOT'] . '/php/footer.php'; ?> 
  
	</body>
</html>
