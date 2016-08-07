<!DOCTYPE html>
<html lang="es">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link href="style.css" rel="stylesheet" type="text/css" media="screen"  />
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	 <script type="text/javascript">
	 
$(function(){
	$('input[type=file]').change(function(e){
		$("#submit").click();
	});
});
function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		vars[key] = value;
	});
	return vars;
}
$(document).ready(function(){
	if (screen.width > 880 && screen.height>450) {
		window.location = "../image_process.php";
	}
	$('input[type=file]').val("");
	isset=<?php if(isset($_POST['image'])){ $ist=true ; echo "true"; }else{ $ist=false; echo "false"; }?>;
	
	if(isset){
		btopx = <?php if($ist){echo $_POST["topx"];}else{echo 0;} ?>;
		btopy = <?php if($ist){echo $_POST["topy"];}else{echo 0;} ?>;
		bbside = <?php if($ist){echo $_POST["side"];}else{echo 5;} ?>;
		bimage = "<?php if($ist){echo $_POST["image"];}else{echo 0;} ?>";
	}
	
	
	imageid = getUrlVars()["id"];
	if (isset){imageid=bimage;}
	hor=$(window).width()-6;
	ver=$(window).height()-245;

	min=Math.min(hor,ver);
	
	tmin=(hor-min)/2;

	$("#canvas").attr("width",min + "px" );
	$("#canvas").attr("height", min + "px");
	$("#canvas").css("margin-left", tmin + "px");

	
	img2=document.createElement('img');
	img2.src='../images/circulo.png';
	var img= new Image();
	
	img.onload = function() {
		//set canvas first attributes
		$('#canvas').attr('style', 'background-image:url(' + '../filess/'+imageid + ')');
		x4=0;
		y4=0;
		scale=5;
		bside=0;
		scaler=0

		if((hor/img.width)>(ver/img.height)){
			width=ver*(img.width/img.height);
			$("#canvas").attr("width",width + "px" );
		}else{
			height=hor*(img.height/img.width);
			$("#canvas").attr("height", height + "px");
		}
			
			
		
		if(img.width<=img.height){
			small=$("#canvas").width();
			big=$("#canvas").height();
			if(!isset){
				topx=0;
				topy=(big-small)/2;
			}
		}else{
			big=$("#canvas").width();
			small=$("#canvas").height();
			if(!isset){
				topy=0;
				topx=(big-small)/2;
			}
		}
		tmin=($(window).width()-$("#canvas").width()-6)/2;
		$("#canvas").css("margin-left", tmin + "px");
		
		
		scaler=img.width/canvas.width;
		if (isset){topx=btopx/scaler; topy=btopy/scaler;}
		
		canvas=document.getElementById("canvas");
		var ctx=canvas.getContext("2d");
		
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		ctx.globalAlpha = 0.6;
		ctx.fillStyle = "black"; 
		ctx.fillRect(0, 0, canvas.width, canvas.height);

		side=small;
		ctx.clearRect(topx,topy,side,side); 
		
		if (isset){side=bbside/scaler;}
		
		//*set canvas first attributes
		
		//draw dahsed rectangle first time
		drawDashedSquare(topx,topy,small);
		function drawDashedSquare(topx,topy,side){
			ctx.globalAlpha = 1;
			ctx.strokeStyle = "rgb(0,0,0)";
			ctx.setLineDash([10, 5]);
			ctx.lineWidth=3;
			ctx.beginPath();
			ctx.moveTo(topx,topy);
			ctx.lineTo(topx+side, topy);
			ctx.lineTo(topx+side, topy+side);
			ctx.lineTo(topx, topy+side);
			ctx.lineTo(topx,topy);
			ctx.stroke();
			ctx.closePath();
		}		
		//*draw dahsed rectangle first time
		

		//on Mouse Down
		var can = document.getElementById("canvas");
		can.addEventListener("touchstart", function(evt){
			
			canvas=document.getElementById("canvas");
			var ctx=canvas.getContext("2d");

			offset=$("#canvas").offset();
			
			x2= evt.targetTouches[0].pageX - offset.left - topx;
			y2= evt.targetTouches[0].pageY - offset.top - topy;
			bside=side;
				
			//Check if down in rectangle
			if (x2 >= 0 && x2 <= side && y2 >= 0 && y2 <= side){
				//var doc = document.getElementById("document");
				document.addEventListener("touchmove", function(evt){
					
				
				
					//$(document).bind('touchmove mousemove', function(evt){
					//on Mouse Move when down and in rectangle
					//'touchmove.slider': function (evt) {
					
					if (x2 <= 0.2*side && y2 <= 0.2*side){
						
						//Escala top left
						selection="topl";
						
						x4=-1*(evt.targetTouches[0].pageX - offset.left-topx-x2);
						y4=-1*(evt.targetTouches[0].pageY - offset.top-topy-y2);
						scale=Math.abs(x4)< Math.abs(y4) ? x4 : y4;
						
						side+=scale;
						topx-=scale;
						topy-=scale;

						if(side<0.2*small || topx<0 || topy<0){
							side-=scale;
							topx+=scale;
							topy+=scale;
						}
						//*Escala top left
						
					}else{
						if (x2 >= 0.8*side && y2 <= 0.2*side){
							
							//Escala top right
							selection="topr";
							
							x4=evt.targetTouches[0].pageX - offset.left-(topx+side)-(x2-bside);
							y4=-1*(evt.targetTouches[0].pageX - offset.top-topy-y2);
							scale=Math.abs(x4)< Math.abs(y4) ? x4 : y4;
							
							side+=scale;
							topy-=scale;

							if(side<0.2*small || topx+side>canvas.width || topy<0){
								side-=scale;
								topy+=scale;
							}
						//*Escala top right
						
						}else{
							
							if (x2 >= 0.8*side && y2 >= 0.8*side){
								
								//Escala bottom right
								selection="botr";
								
								x4=evt.targetTouches[0].pageX - offset.left-(topx+side)-(x2-bside);
								y4=evt.targetTouches[0].pageY - offset.top-(topy+side)-(y2-bside);
								scale=Math.abs(x4)< Math.abs(y4) ? x4 : y4;
								
								side+=scale;

								if(side<0.2*small || topx+side>canvas.width || topy+side>canvas.height){
									side-=scale;
								}
								//*Escala bottom right
								
							}else{
								if (x2 <= 0.2*side && y2 >= 0.8*side){
									
									//Escala bottom left
									selection="botl";
									
									x4=-1*(evt.targetTouches[0].pageX - offset.left-topx-x2);
									y4=evt.targetTouches[0].pageY - offset.top-(topy+side)-(y2-bside);
									scale=Math.abs(x4)< Math.abs(y4) ? x4 : y4;
									
									side+=scale;
									topx-=scale;

									if(side<0.2*small || topx<0 || topy+side>canvas.height){
										side-=scale;
										topx+=scale;
									}
									//*Escala bottom left
									
								}else{
									
									//Desplaza
									selection="desplaza";
									
									topx= evt.targetTouches[0].pageX - offset.left-x2;
									topy= evt.targetTouches[0].pageY - offset.top-y2;
									
									if (topx < 0) {
										topx = 0;
									}
									if (topy < 0) {
										topy = 0;
									}
									
									if (topx+side > canvas.width) {
										topx = canvas.width-side;
									}
									if (topy+side > canvas.height) {
										topy = canvas.height-side;
									}
									//*Desplaza
									
								}
							}
						}	
					}
				});
			}
		});
		setInterval(draw, 100);
	}
	
	draw = function() {
		
		//$("#msg").html("topx: "+ img.width+", topy: " + canvas.width + ", scaler:" + scaler);
		canvas=document.getElementById("canvas");
		var ctx=canvas.getContext("2d");
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		ctx.globalAlpha = 0.6;
		ctx.fillStyle = "black"; 
		ctx.fillRect(0, 0, canvas.width, canvas.height);
		ctx.clearRect(topx,topy,side,side); 
		
		//draw dashed Circle
		ctx.drawImage(img2,topx,topy,side,side);
		
		//*draw dashed Circle
		
		
		//draw dashed rectangle
		drawDashedSquare(topx,topy,side);
		function drawDashedSquare(topx,topy,side){
			
			ctx.globalAlpha = 1;
			ctx.strokeStyle = "rgb(0,0,0)";
			ctx.setLineDash([10, 5]);
			ctx.lineWidth=3;
			ctx.beginPath();
			ctx.moveTo(topx,topy);
			ctx.lineTo(topx+side, topy);
			ctx.lineTo(topx+side, topy+side);
			ctx.lineTo(topx, topy+side);
			ctx.lineTo(topx,topy);
			ctx.stroke();
			
			ctx.closePath();
		}
	}
	
	img.src='../filess/'+imageid;
	
	$("#next").click(function(){
		ltopx=scaler*topx;
		ltopy=scaler*topy;
		lside=scaler*side;
		$('input[name=topx]').val(ltopx);
		$('input[name=topy]').val(ltopy);
		$('input[name=side]').val(lside);
		$('input[name=image]').val(imageid);
		$("#submit2").click();
	});
});
$(function(){
	$("#file_upload").click(function(){
		$("#fileToUpload").click();
	});
});

</script>
</head>
<body style="margin:0px" ondragstart="return false;" ondrop="return false;">
	
<div id="wrapper">
	<div class="flex">
		<div id="logo">
			<div id="image_logo"></div>
			<p  class="title">Nunt Image creator_</p>
		</div>
		<div id="l_tools">
			
		
			<div class="file_upload">
				<div id="file_upload"></div>
				<form action="upload.php" method="post" enctype="multipart/form-data">
					<input type="file" accept="image/*" capture="camera" style="display:none" name="fileToUpload" id="fileToUpload">
					<input id="submit" style="display:none" type="submit" value="Upload Image" name="submit">
				</form>
				<p  id="p_file_upload">Selecciona tu imagen de perfil</p>
			</div>
			
			<div style="opacity: 0;" class="redes_sociales">
				<div class="enlaces">
					<div style="background-image: url('../images/fb.png')"></div>
					<div style="background-image: url('../images/instagram.png')"></div>
					<div style="background-image: url('../images/twitter.png')"></div>
				</div>
				<div class="flex-center">
					<p >Importar de mis redes sociales</p>
				</div>
			</div>
	</div>
	</div>
	<div id="r_tools">
		<div id="dimensiona" class="dimensiona selected">
			<div class="imagen"></div>
			<p>Dimensiona</p>
		</div>
		<div id="desplaza" class="desplaza">
			<div class="imagen"></div>
			<p>Desplaza</p>
		</div>
	</div>
	<canvas id="canvas"> </canvas>

	<div class="arrow">
			<div id="next" class="imagen"></div>
			<form action="image_process2.php" method="post" enctype="multipart/form-data">
				<input id="f_topx" style="display:none" type="hidden" value="v1" name="topx">
				<input id="f_topy" style="display:none" type="hidden" value="v2" name="topy">
				<input id="f_side" style="display:none" type="hidden" value="v3" name="side">
				<input id="f_image" style="display:none" type="hidden" value="v4" name="image">
				<input id="submit2" style="display:none" type="submit" value="upload" name="submit">
			</form>
		</div>
</div>
</body>
</html>