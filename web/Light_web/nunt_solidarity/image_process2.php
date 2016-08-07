<!DOCTYPE html>

<html lang="es">

<?php 
	if(!isset($_POST['image'])){
		header('Location: http://lightbeta.esy.es/nunt_solidarity/image_process.php');
	}
?>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="style2.css" rel="stylesheet" type="text/css" media="screen"  />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript">

function getUrlVars() {
	
	return vars;
}

$(document).ready(function(){
		
	isset=<?php if(isset($_POST["b_w"])){$ist=true ;echo "true";}else{$ist=false ;echo "false";}?>;
	
	if(isset){
		
		b_w = "<?php  if($ist){echo $_POST['b_w'];}else{echo 0;} ?>";
		op = <?php  if($ist){echo $_POST['opacity'];}else{echo 0;} ?>;
		op=op/100;
		
		topx = <?php echo $_POST["topx"] ?>;
		topy = <?php echo $_POST['topy'] ?>;
		side = <?php echo $_POST['side'] ?>;
		bimage = "<?php echo $_POST['image'] ?>";
		btopx = <?php  if($ist){echo $_POST["btopx"];}else{echo 0;} ?>;
		btopy = <?php  if($ist){echo $_POST['btopy'];}else{echo 0;} ?>;
		bbside = <?php  if($ist){echo $_POST['bside'];}else{echo 0;} ?>;
	}else{
	
		btopx = <?php echo $_POST["topx"] ?>;
		btopy = <?php echo $_POST['topy'] ?>;
		bbside = <?php echo $_POST['side'] ?>;
		bimage = "<?php echo $_POST['image'] ?>";
		b_w="white";
		op=0.35;
		topx=0;
		topy=0;
	}
	
	hor=$(window).width() - 700;
	ver=$(window).height()-150;

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
	
	
	canvas=document.getElementById("canvas");
	ctx=canvas.getContext("2d");
	canvas2=document.getElementById("opacity");
	ctx2=canvas.getContext("2d");
	
	img2=document.createElement('img');
	img2.src='images/nunt.png';
	img4=document.createElement('img');
	img4.src='images/nunt_white.png';
	big=$("#canvas").width();
	small=big;
	
	mouseover=false;
	
	$("#opacity").attr("width", "200px");
	$("#opacity").attr("height", "50px");
	ml= canvas.width/2 - 83;
	$('#opacity').attr('style', 'margin-left:'+ ml +'px');
	$('#op_text').attr('style', 'margin-left:'+ ml +'px');
	var img= new Image();
	
	img.onload = function() {
		$('#canvas').attr('style', 'background-image:url(' + 'filess2/'+bimage + ')');
		
		x4=0;
		y4=0;
		scale=5;
		bside=0;
		scaler=img.width/canvas.width;
		if (isset){topx=topx/scaler; topy=topy/scaler; side=side/scaler;}
		mouseup=true;
		selection="";
		
		
		
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		ctx.globalAlpha = 0.5;
		
		img3=document.createElement('img');
		img3.src='images/slide opacidad.png';
		img3.onload = function () {
			ctx2.drawImage(img3,canvas2.width,45,10,10);
		}
		if(!isset){side=canvas.width;}
		//*set canvas first attributes
		
		
		//Draw dashed circle first time
		
		//*DrawCircle first time
		
		
		$("#canvas").on({
			//on Mouse Down
			'mousedown.slider': function (evt){
				mouseup=false;

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

									if(side<0.1*small || topx<0 || topy<0){
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

									if(side<0.1*small || topx+side>canvas.width || topy<0){
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

									if(side<0.1*small || topx<0 || topy+side>canvas.height){
										side-=scale;
										topx+=scale;
									}
								}
								if(selection=="botr"){
									
									x4=evt.pageX - offset.left-(topx+side)-(x2-bside);
									y4=evt.pageY - offset.top-(topy+side)-(y2-bside);
									scale=Math.abs(x4)< Math.abs(y4) ? x4 : y4;
									
									side+=scale;

									if(side<0.1*small || topx+side>canvas.width || topy+side>canvas.height){
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
			mouseover=true;
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
		
		$("#canvas").mouseleave(function(evt) {
			mouseover=false;
		});
		
		//mouse over opacity
		$("#opacity").mousemove(function(evt) {
			offset2=$("#opacity").offset();
			x5= evt.pageX - offset2.left - op*canvas2.width + 12;
			y5= evt.pageY - offset2.top - 12;
			//alert(x5 + ",  " + y5);
			if (x5 >= 0 && x5 <= 24 && y5 >= 0 && y5 <= 24){
				//alert("hey1");
				$('#opacity').attr('style', 'margin-left:'+ ml +'px; cursor:pointer');	
			}else{
				$('#opacity').attr('style', 'margin-left:'+ ml +'px; cursor:auto');	
			}
		});
		//*mouse over opacity
		
		
		//mouse move opacity slider
		$("#opacity").on({
			'mousedown.slider': function (evt){

				x6= evt.pageX - offset2.left - op*canvas2.width + 12;
				y6= evt.pageY - offset2.top - 12;
				
				if (x6 >= 0 && x6 <= 24 && y6 >= 0 && y6 <= 24){
					$(document).on({
						//on Mouse Move when down and in slider
						'mousemove.sliderr': function (evt) {
							
							//desplazar
							
							op= (evt.pageX - offset2.left-x6+12)/canvas2.width;
							
							op=op<0?0:op;
							op=op>1?1:op;
						},
						'mouseup.sliderr': function () {
							$(document).off('.sliderr');
						}
					});
				}
			}
		});		
		//*mouse move opacity slider
		
		//go back to previous
		$("#previous").click(function(){
			
			$('#f_topx1').val(btopx);
			$('#f_topy1').val(btopy);
			$('#f_side1').val(bbside);
			$('#f_image1').val(bimage);
			$("#submit21").click();

		});
		//*go back to previous
		
		//go to next
		$("#next").click(function(){
			ltopx=scaler*topx;
			ltopy=scaler*topy;
			lside=scaler*side;
			
			$('#f_btopx').val(btopx);
			$('#f_btopy').val(btopy);
			$('#f_bside').val(bbside);
			
			$('#f_topx').val(ltopx);
			$('#f_topy').val(ltopy);
			$('#f_side').val(lside);
			$('#f_image').val(bimage);
			$('#f_b_w').val(b_w);
			txop=Math.round(op*100);
			$('#f_opacity').val(txop);
			$("#submit2").click();

		});
		//*go to next
		
		//Toggle B/W
		$("#b_w").click(function(){
			b_w=b_w=="white"?"black":"white";
		});
		//*Toggle B/W
		
		setInterval(draw, 100);
	}
	
	draw = function() {
		
		//$("#msg").html("topx: "+ mouseover +", topy: " + topy);
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		
		if(mouseover){
			ctx.beginPath();
			ctx.fillStyle = "black";
			ctx.strokeStyle="#0000";
			ctx.globalAlpha = 1;
			ctx.rect(topx,topy,side,side);
			ctx.stroke();
			ctx.closePath();
		}
		
		ctx.globalAlpha = op;
		
		if(b_w=="white"){
			ctx.drawImage(img4,topx,topy,side,side);
		}else{
			ctx.drawImage(img2,topx,topy,side,side);
		}
		
		
		//opacity
		
		canvas2=document.getElementById("opacity");
		ctx2=canvas2.getContext("2d");
	
		ctx2.clearRect(0, 0, canvas2.width, canvas2.height);
		
		ctx2.beginPath();
		ctx2.globalAlpha = 1;
		ctx2.strokeStyle = "rgb(0,0,0)";
		ctx2.setLineDash([4, 1.5]);
		ctx2.lineWidth=0.8;
		ctx2.moveTo(0,canvas2.height/2);
		ctx2.lineTo(canvas2.width, canvas2.height/2);
		w=op*canvas2.width-12;
		h=canvas2.height/2-12;
		txop=op*100;
		txop=txop.toFixed(2)
		$('#op_text').html("Opacity:    " + txop + "%");
		ctx2.drawImage(img3,w,h,24,24);
		ctx2.stroke();
		ctx2.closePath();
			
	};
	img.src='filess2/'+bimage;
});

</script>
</head>
<body style="margin:0px" ondragstart="return false;" ondrop="return false;" >

<?php 
if(!$ist){
		$im = imagecreatefromjpeg('filess/' .  $_POST['image'] );

		$to_crop_array = array('x' =>  $_POST["topx"] , 'y' =>  $_POST['topy'] , 'width' =>  $_POST['side'] , 'height'=>  $_POST['side'] );
		$thumb_im = imagecrop($im, $to_crop_array);
		imagejpeg($thumb_im, 'filess2/' .  $_POST['image'] , 100);
}
?>

<div id="wrapper">
	<div id="logo">
		<div id="image_logo"></div>
		<div class="title"> <p  class="title">Nunt Image creator_</p></div>
	</div>
	<div id="l_tools">
		
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
		<div  class="b_w">
			<div id="b_w" class="imagen"></div>
			<p>&#191;Blanco o negro?</p>
		</div>
		<p id="msg"></p>
		
	</div>
	<canvas id="canvas"> </canvas>
	<p id="op_text">Opacidad:</p>
	<canvas id="opacity"> </canvas>
	
	<div class="arrow2">
		<div id="previous" class="imagen"></div>
		<p >Anterior</p>
		<form action="image_process.php" method="post" enctype="multipart/form-data">
			<input id="f_topx1" style="display:none" type="hidden" value="v1" name="topx">
			<input id="f_topy1" style="display:none" type="hidden" value="v2" name="topy">
			<input id="f_side1" style="display:none" type="hidden" value="v3" name="side">
			<input id="f_image1" style="display:none" type="hidden" value="v4" name="image">
			<input id="submit21" style="display:none" type="submit" value="upload" name="submit">
		</form>
	</div>
	
	<div class="arrow">
		<div id="next" class="imagen"></div>
		<p >Siguiente</p>
		<form action="image_process3.php" method="post" enctype="multipart/form-data">
			<input id="f_topx" style="display:none" type="hidden" value="v1" name="topx">
			<input id="f_topy" style="display:none" type="hidden" value="v2" name="topy">
			<input id="f_side" style="display:none" type="hidden" value="v3" name="side">
			<input id="f_image" style="display:none" type="hidden" value="v4" name="image">
			<input id="f_b_w" style="display:none" type="hidden" value="v5" name="b_w">
			<input id="f_opacity" style="display:none" type="hidden" value="v6" name="opacity">
			
			<input id="f_btopx" style="display:none" type="hidden" value="v7" name="btopx">
			<input id="f_btopy" style="display:none" type="hidden" value="v8" name="btopy">
			<input id="f_bside" style="display:none" type="hidden" value="v9" name="bside">
			
			<input id="submit2" style="display:none" type="submit" value="upload" name="submit">
		</form>
	</div>	
</div>
</body>
</html>