<!DOCTYPE html>

<html lang="es">

<?php 
	if(!isset($_POST['image'])){
		header('Location: http://lightbeta.esy.es/nunt_solidarity/m/image_process.php');
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
		
	if (screen.width > 880 && screen.height>450) {
		window.location = "../image_process2.php";
	}
	
	isset=<?php if(isset($_POST["b_w"])){$ist=true ;echo "true";}else{$ist=false ;echo "false";}?>;
	mousedown=false;
	
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
	
	hor=$(window).width()-6;
	ver=$(window).height()-280;

	min=Math.min(hor,ver);
	
	tmin=(hor-min)/2;

	$("#canvas").attr("width",min + "px" );
	$("#canvas").attr("height", min + "px");
	$("#canvas").css("margin-left", tmin + "px");
	
	$("#opacity").attr("width","150px" );
	$("#opacity").attr("height", "55px");
	
	canvas=document.getElementById("canvas");
	ctx=canvas.getContext("2d");
	canvas2=document.getElementById("opacity");
	ctx2=canvas.getContext("2d");
	
	img2=document.createElement('img');
	img2.src='../images/nunt.png';
	img4=document.createElement('img');
	img4.src='../images/nunt_white.png';	
	
	ml= canvas.width/2 - 83;
	//$('#opacity').attr('style', 'margin-left:'+ ml +'px');
	//$('#op_text').attr('style', 'margin-left:'+ ml +'px');
	var img= new Image();
	
	img.onload = function() {
		$('#canvas').css('background-image', 'url(../filess2/'+bimage + ')');
		
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
		img3.src='../images/slide opacidad.png';
		img3.onload = function () {
			ctx2.drawImage(img3,canvas2.width,45,10,10);
		}
		if(!isset){side=canvas.width;}
		//*set canvas first attributes
		
		
		//Draw dashed circle first time
		
		//*DrawCircle first time
		
		var can = document.getElementById("canvas");
		can.addEventListener("touchstart", function(evt){
			mousedown=true;
			offset=$("#canvas").offset();
			x2= evt.targetTouches[0].pageX - offset.left - topx;
			y2= evt.targetTouches[0].pageY - offset.top - topy;
			bside=side;
			if (x2 >= 0 && x2 <= side && y2 >= 0 && y2 <= side){
				can.addEventListener("touchmove", function(evt){
					//desplazar
					if(x2 < 0.8*side && x2 > 0.2*side && y2 > 0.2*side && y2 < 0.8*side){
								
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
					}
					//*desplazar
					
					//escalar
					small=$("#canvas").width()
					if (x2 <= 0.2*side && y2 <= 0.2*side){
						x4=-1*(evt.targetTouches[0].pageX - offset.left-topx-x2);
						y4=-1*(evt.targetTouches[0].pageY - offset.top-topy-y2);
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
					if (x2 >= 0.8*side && y2 <= 0.2*side){
						x4=evt.targetTouches[0].pageX - offset.left-(topx+side)-(x2-bside);
						y4=-1*(evt.targetTouches[0].pageY - offset.top-topy-y2);
						scale=Math.abs(x4)< Math.abs(y4) ? x4 : y4;
						
						side+=scale;
						topy-=scale;

						if(side<0.1*small || topx+side>canvas.width || topy<0){
							side-=scale;
							topy+=scale;
						}
					}
					if (x2 <= 0.2*side && y2 >= 0.8*side){
						x4=-1*(evt.targetTouches[0].pageX - offset.left-topx-x2);
						y4=evt.targetTouches[0].pageY - offset.top-(topy+side)-(y2-bside);
						scale=Math.abs(x4)< Math.abs(y4) ? x4 : y4;
						
						side+=scale;
						topx-=scale;

						if(side<0.1*small || topx<0 || topy+side>canvas.height){
							side-=scale;
							topx+=scale;
						}
					}
					if (x2 >= 0.8*side && y2 >= 0.8*side){

						x4=evt.targetTouches[0].pageX - offset.left-(topx+side)-(x2-bside);
						y4=evt.targetTouches[0].pageY - offset.top-(topy+side)-(y2-bside);
						scale=Math.abs(x4)< Math.abs(y4) ? x4 : y4;

						side+=scale;

						if(side<0.1*small || topx+side>canvas.width || topy+side>canvas.height){
							side-=scale;
						}
					}
					//*escalar

				});
			}
		});
		
		can.addEventListener("touchend", function(evt){
			mousedown=false;
		});
		
		//mouse move opacity slider
		offset2=$("#opacity").offset();
		var opa = document.getElementById("opacity");
		
		opa.addEventListener("touchstart", function(evt){
			x6= evt.targetTouches[0].pageX - offset2.left - op*canvas2.width + 12;
			y6= evt.targetTouches[0].pageY - offset2.top - 12;
			
			listener=function(evt){
					
					//desplazar
					op= (evt.targetTouches[0].pageX - offset2.left-x6+12)/canvas2.width;
					
					op=op<0?0:op;
					op=op>1?1:op;
				};
			
			if (x6 >= 0 && x6 <= 24 && y6 >= 0 && y6 <= 24){
				opa.addEventListener("touchmove", listener);
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

		if(mousedown){
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
		ctx2.setLineDash([2, 1]);
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
	img.src='../filess2/'+bimage;
});

</script>
</head>
<body style="margin:0px" ondragstart="return false;" ondrop="return false;" >

<?php 
if(!$ist){
		$im = imagecreatefromjpeg('../filess/' .  $_POST['image'] );

		$to_crop_array = array('x' =>  $_POST["topx"] , 'y' =>  $_POST['topy'] , 'width' =>  $_POST['side'] , 'height'=>  $_POST['side'] );
		$thumb_im = imagecrop($im, $to_crop_array);
		imagejpeg($thumb_im, '../filess2/' .  $_POST['image'] , 100);
}
?>

<div id="wrapper">

	<div class="flex">

		<div id="logo">
			<div id="image_logo"></div>
			<p  class="title">Nunt Image creator_</p>
		</div>
		<div id="l_tools">
			<div  class="b_w">
				<div id="b_w" class="imagen"></div>
				<p>&#191;Blanco o negro?</p>
			</div>	
			<div style="margin-top: 25px;">
				<p id="op_text">Opacidad:</p>
				<canvas id="opacity"> </canvas>
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
	
	
	<div class="arrow2">
		<div id="previous" class="imagen"></div>
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