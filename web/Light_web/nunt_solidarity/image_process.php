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
	if (screen.width <= 880 || screen.height<=450) {
		window.location = "m/image_process.php";
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
	hor=$(window).width() - 700;
	ver=$(window).height();

		if(hor<ver){
			if((ver-hor)>80){
				$("#l_tools").css("margin-left", "70px");
				$("#r_tools").css("margin-right", "0px");
				hor=$(window).width() - 620;
			}else{
				mm=Math.round((ver-hor)/2);
				$("#l_tools").css("margin-left", "-=" + mm + "px");
				$("#r_tools").css("margin-right","-=" + mm + "px");
				hor=$(window).width() - (700-mm*2);
				
			}
		}
	
	min=Math.min(hor,ver);
	
	tmin=min*0.8;
	$("#canvas").attr("width", tmin + "px");
	$("#canvas").attr("height", tmin + "px");


	
	img2=document.createElement('img');
	img2.src='images/circulo.png';
	var img= new Image();
	
	img.onload = function() {
		//set canvas first attributes
		$('#canvas').attr('style', 'background-image:url(' + 'filess/'+imageid + ')');
		x4=0;
		y4=0;
		scale=5;
		bside=0;
		scaler=0
		mouseup=true;
		if((hor/img.width)<(ver/img.height)){
			tmin=hor*0.8;
			$("#canvas").attr("width", tmin + "px");
			tmin=tmin*(img.height/img.width);
			$("#canvas").attr("height", tmin + "px");
		}else{
			tmin=ver*0.8;
			$("#canvas").attr("height", tmin + "px");
			tmin=tmin*(img.width/img.height);
			$("#canvas").attr("width", tmin + "px");
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
		
		scaler=img.width/canvas.width;
		if (isset){topx=btopx/scaler; topy=btopy/scaler;}
		canvas=document.getElementById("canvas");
		var ctx=canvas.getContext("2d");
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		ctx.globalAlpha = 0.6;
		ctx.fillStyle = "black"; 
		ctx.fillRect(0, 0, canvas.width, canvas.height);

		ctx.clearRect(topx,topy,small,small); 
		side=small;
		if (isset){side=bbside/scaler;}
		//*set canvas first attributes
		
		
		//Draw dashed circle first time
		
		//*DrawCircle first time
		
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
		
		
		$("#canvas").on({
			//on Mouse Down
			'mousedown.slider': function (evt){
				mouseup=false;
				canvas=document.getElementById("canvas");
				var ctx=canvas.getContext("2d");

					offset=$("#canvas").offset();
					x2= evt.pageX - offset.left - topx;
					y2= evt.pageY - offset.top - topy;
					bside=side;
				if (x2 >= 0
				  && x2 <= side
				  && y2 >= 0
				  && y2 <= side
				){
					$(document).on({
						//on Mouse Move when down and in rectangle
						'mousemove.slider': function (evt) {
							
							//desplazar
							if(selection=="desplaza"){
										
								topx= evt.pageX - offset.left-x2;
								topy= evt.pageY - offset.top-y2;
								
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
							}
							//*desplazar
							
							//escalar
							if(selection!="desplaza"){
								
								if(selection=="topl"){
									x4=-1*(evt.pageX - offset.left-topx-x2);
									y4=-1*(evt.pageY - offset.top-topy-y2);
									scale=Math.abs(x4)< Math.abs(y4) ? x4 : y4;
									
									side+=scale;
									topx-=scale;
									topy-=scale;

									if(side<0.2*small || topx<0 || topy<0){
										side-=scale;
										topx+=scale;
										topy+=scale;
									}
								}
								if(selection=="topr"){
									x4=evt.pageX - offset.left-(topx+side)-(x2-bside);
									y4=-1*(evt.pageY - offset.top-topy-y2);
									scale=Math.abs(x4)< Math.abs(y4) ? x4 : y4;
									
									side+=scale;
									topy-=scale;

									if(side<0.2*small || topx+side>canvas.width || topy<0){
										side-=scale;
										topy+=scale;
									}
								}
								if(selection=="botl"){
									x4=-1*(evt.pageX - offset.left-topx-x2);
									y4=evt.pageY - offset.top-(topy+side)-(y2-bside);
									scale=Math.abs(x4)< Math.abs(y4) ? x4 : y4;
									
									side+=scale;
									topx-=scale;

									if(side<0.2*small || topx<0 || topy+side>canvas.height){
										side-=scale;
										topx+=scale;
									}
								}
								if(selection=="botr"){
									
									x4=evt.pageX - offset.left-(topx+side)-(x2-bside);
									y4=evt.pageY - offset.top-(topy+side)-(y2-bside);
									scale=Math.abs(x4)< Math.abs(y4) ? x4 : y4;
									
									side+=scale;

									if(side<0.2*small || topx+side>canvas.width || topy+side>canvas.height){
										side-=scale;
									}
								}			
							}
							//*escalar
							
						},
						'mouseup.slider': function () {
							mouseup=true;
							$(document).off('.slider');
						}
					});
				}
			}
		});
		
		//mouse over to change cursor
		$("#canvas").mousemove(function(evt) {
			if(mouseup){
				
				offset=$("#canvas").offset();
				x3= evt.pageX - offset.left - topx;
				y3= evt.pageY - offset.top - topy;
				if (x3 >= 0 && x3 <= side && y3 >= 0 && y3 <= side){
					if (x3 <= 0.2*side && y3 <= 0.2*side){
						selection="topl";
						$("#canvas").css('cursor', 'nw-resize');
					}else{
						
						if (x3 >= 0.8*side && y3 <= 0.2*side){
							selection="topr";
							$("#canvas").css('cursor', 'ne-resize');
						}else{
							
							if (x3 >= 0.8*side && y3 >= 0.8*side){
								selection="botr";
								$("#canvas").css('cursor', 'nw-resize');
							}else{
								if (x3 <= 0.2*side && y3 >= 0.8*side){
									selection="botl";
									$("#canvas").css('cursor', 'ne-resize');
								}else{
									selection="desplaza";
									$("#canvas").css('cursor', 'move');
								}
							}
						}
					}
					
				}else{
					$("#canvas").css('cursor', 'auto');
				}
			}
		});
		//*mouse over to change cursor
		
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
	};
	
	img.src='filess/'+imageid;
	
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
<div id="logo">
		<div id="image_logo"></div>
		<div class="title"> <p  class="title">Nunt Image creator_</p></div>
	</div>
<div id="wrapper">
	<div id="l_tools">
		<div style="display:flex">
			<div id="file_upload"></div>
			<form action="upload.php" method="post" enctype="multipart/form-data">
				<input type="file" style="display:none" name="fileToUpload" id="fileToUpload">
				<input id="submit" style="display:none" type="submit" value="Upload Image" name="submit">
			</form>
			<p  id="p_file_upload">Selecciona tu imagen de perfil</p>
		</div>
		<div style="opacity: 0;" class="redes_sociales">
			<div class="enlaces" style="margin-left:12px">
				<div style="background-image: url('images/fb.png')"></div>
				<div style="background-image: url('images/instagram.png')"></div>
				<div style="background-image: url('images/twitter.png')"></div>
			</div>
			<div class="flex-center">
				<p >Importar de mis redes sociales</p>
			</div>
		</div>
	</div>
	<div id="r_tools">
		<div id="dimensiona" class="dimensiona selected">
			<div class="imagen"></div>
			<p>Dimensiona. Ajusta el tama&ntildeo de tu foto de perfil</p>
		</div>
		<div id="desplaza" class="desplaza">
			<div class="imagen"></div>
			<p>Desplaza. Coloca la imagen en su posici&oacuten correcta</p>
		</div>
		<p id="msg"></p>
	</div>
	<canvas id="canvas"> </canvas>

	<div class="arrow">
			<div id="next" class="imagen"></div>
			<p >Siguiente</p>
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