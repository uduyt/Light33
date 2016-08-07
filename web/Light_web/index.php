<!DOCTYPE html>
<html id="myHTML">
	<head>
		<?php 
		session_start();
		if(isset($_SESSION['username'])){
			header('Refresh:0; url=/profile/');
		}
		include $_SERVER['DOCUMENT_ROOT'] . '/php/imports.php'; 
		?>
		<link href="imports/style.css" rel="stylesheet" type="text/css" media="screen"  />
		<title>Light</title>
	</head>
	

<body id="main_container">

<nav id="main_nav" class="main_header_1"> 
	<div id="main_header_all_content" class="main_header_all_content_1">
	<div id="main_head_logo" class="main_head_logo_1"><img style="max-height:50px;" src="/images/logo_white.png"></img></div>
		<div id="main_header_content" class="main_header_menu_1">
			<div> <a>¿Qué es?</a></div>
			<div> <a>Filosofía</a></div>
			<div> <a>About/Team</a></div>
			<div> <a>Contacto</a></div>
		</div>
		<span class="main_head_span"></span>
	</div>
</nav>

<div class="main_page_container">
	<div class="main_cover_container">
		<div class="main_cover_teUnes">
			<h5> ¿Te unes al reto Light?</h5>
			<p> monitoriza, ahorra, diviértete siendo eficiente y gana premios increíbles </p>
			<h5> ¡Nunca ser sostenible estuvo tan de moda! </h5>
			<div class="main_cover_video" onmouseover="moverVideo()" onmouseout="moutVideo()" >
				<div id="video_play"class="main_cover_video_play"></div>
			</div>
		</div>
	</div>
	<div class="main_que_es">
	<h5>¿Qué es?</h5>
	<p>Sostenibilidad</p>
	<p>Ahorro de energía en el hogar</p>
	<p>Ahorro de energía en movilidad</p>
	<p>Descarga la aplicación <a href="https://drive.google.com/file/d/0B1c5znDRlP1_VXNGLUF2ZWNvNjQ/view?usp=sharing">aquí</a> (link dedicado a MJ :) )</p>
	</div>
</div>

<script>

		function moverVideo(){
			element= document.getElementById("video_play");
			element.style.height="45px";
			element.style.width="45px";
		}
		function moutVideo(x){
			element= document.getElementById("video_play");
			element.style.height="35px";
			element.style.width="35px";
		}
		

window.onscroll = function() {myFunction()};

function myFunction() {
    if (document.body.scrollTop > 28) {
		var sc_width= document.getElementById("myHTML").clientWidth
        document.getElementById("main_nav").className = "main_header_2";
		document.getElementById("main_header_all_content").className = "main_header_all_content_2";
		document.getElementById("main_head_logo").className = "main_head_logo_2";
		document.getElementById("main_header_content").className = "main_header_menu_2";
		document.getElementById("main_header_content").style.marginLeft = (sc_width)/2 -340 + "px";
    } else {
        document.getElementById("main_nav").className = "main_header_1";
		document.getElementById("main_header_all_content").className = "main_header_all_content_1";
		document.getElementById("main_head_logo").className = "main_head_logo_1";
		document.getElementById("main_header_content").className = "main_header_menu_1";
		document.getElementById("main_header_content").style.marginLeft = "0px";
    }
}
</script>


</body>

</html>