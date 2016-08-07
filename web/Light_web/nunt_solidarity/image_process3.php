<!DOCTYPE html>

<html lang="es">
<head>

	<?php 
	if(!isset($_POST['image'])){
		header('Location: http://lightbeta.esy.es/nunt_solidarity/m/image_process.php');
	}
	?>

	 <link href="style.css" rel="stylesheet" type="text/css" media="screen"  />
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	 <script type="text/javascript">
	
	function getUrlVars() {
	var vars = {};

	vars["topx"] = <?php echo $_POST["topx"] ?>;
	vars["topy"] = <?php echo $_POST['topy'] ?>;
	vars["side"] = <?php echo $_POST['side'] ?>;
	vars["b_w"] = "<?php echo $_POST['b_w'] ?>";
	vars["opacity"] = <?php echo $_POST['opacity'] ?>;
	vars["image"] = "<?php echo $_POST['image'] ?>";
	return vars;
}

	$(document).ready(function(){
		
		vars=getUrlVars();
		
		btopx=vars["topx"];
		btopy=vars["topy"];
		bbside=vars["side"];
		bb_w=vars["b_w"];
		bopacity=vars["opacity"];
		bimage=vars["image"];
		
		bbtopx = <?php echo $_POST["btopx"] ?>;
		bbtopy = <?php echo $_POST['btopy'] ?>;
		bbbside = <?php echo $_POST['bside'] ?>;
		
		hor=$(window).width() - 620;
		ver=$(window).height();

		if(hor<ver){
			if((ver-hor)>80){
				$("#l_tools").css("margin-left", "50px");
				$("#r_tools3").css("margin-right", "0px");
				hor=$(window).width() - 540;
			}else{
				mm=Math.round((ver-hor)/2);
				$("#l_tools").css("margin-left", "-=" + mm + "px");
				$("#r_tools").css("margin-right","-=" + mm + "px");
				hor=$(window).width() - (620-mm*2);
				
			}
		}
	
	min=Math.min(hor,ver);
	
	tmin=min*0.8;
	$("#canvas").attr("width", tmin + "px");
	$("#canvas").attr("height", tmin + "px");
		
		canvas=document.getElementById("canvas");
		ctx=canvas.getContext("2d");
	 
		img=document.createElement('img');
		img.onload= function(){
			$('#canvas').css('background-image','url(' + 'filess3/'+bimage + ')');
		}
		
		img.src='filess3/'+bimage;
	 //go back to previous
		$("#previous").click(function(){
			
			$('#f_topx').val(btopx);
			$('#f_topy').val(btopy);
			$('#f_side').val(bbside);
			$('#f_btopx').val(bbtopx);
			$('#f_btopy').val(bbtopy);
			$('#f_bside').val(bbbside);
			$('#f_image').val(bimage);
			$('#f_b_w').val(bb_w);
			$('#f_opacity').val(bopacity);
			$("#submit2").click();

		});
		//*go back to previous
		
		//download file
		$("#file_download").click(function(){
			document.getElementById("alink").click()
			//document.execCommand('SaveAs',true,'file.jpg');
		});
		//*go back to previous
		
		//Twitter click
		$("#tw_image").click(function(){
			
			url="https://twitter.com/intent/tweet?text=En%20solidaridad%20con%20los%20cristianos%20perseguidos,%20he%20incorporado%20el%20nunt%20a%20mi%20foto%20de%20perfil%20con%20@nunt_solidarity%20http://lightbeta.esy.es/nunt_solidarity/image_process.php"
			window.open(url);
			
		});
		//*Twitter click
	});
	</script>
</head>
<body style="margin:0px" ondragstart="return false;" ondrop="return false;" >
<?php /*

$file_path=__DIR__ . "/filess2/" . $_POST['image'];

if(file_exists($file_path)) {
	header('Content-type:image/jpg'); 
	header("Content-disposition: attachment; filename=" .  $_POST['image']);
	
	readfile('file.jpg'); 
}else {
	echo "Sorry, the file does not exist!";
}*/
?>

<?php 
$imageFileType = pathinfo('filess2/' . $_POST['image'],PATHINFO_EXTENSION);

$topx=$_POST['topx'];
$topy=$_POST['topy'];
$side=$_POST['side'];
$b_w=$_POST['b_w'];
$opacity=$_POST['opacity'];

if($b_w=="white"){
	$nunt1 = imagecreatefrompng('images/nunt_white.png');
}else{
	$nunt1 = imagecreatefrompng('images/nunt.png');
}


   function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){ 
        // creating a cut resource 
        $cut = imagecreatetruecolor($src_w, $src_h); 

        // copying relevant section from background to the cut resource 
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h); 
        
        // copying relevant section from watermark to the cut resource 
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h); 
        
        // insert cut resource to destination image 
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);

    } 
	
	$img = imagecreatefromjpeg('filess2/' .  $_POST['image'] );
	$min= min(imagesx($img),imagesy($img));
	if ($min<1024){
		
		if(imagesx($img)<imagesy($img)){
			$x=1024;
			$y=1024*imagesy($img)/imagesx($img);
		}else{
			$x=1024*imagesx($img)/imagesy($img);
			$y=1024;
			
		}
		
		$side=$side*$x/imagesx($img);
		$topx=$topx*$x/imagesx($img);
		$topy=$topy*$x/imagesx($img);
		
		$img=imagescale($img,$x,$y);
		
		
	}
	imageAlphaBlending($nunt1, true);
	imageSaveAlpha($nunt1, true);

	$nunt = imagescale($nunt1, $side);

	
	$error = imagecopymerge_alpha($img, $nunt, $topx, $topy , 0, 0, $side , $side , $opacity);
	imagejpeg($img, 'filess3/' .  $_POST['image'] , 100);

	$img = imagecreatefromjpeg('filess3/' .  $_POST['image'] );
	
	$resolution=100;
		$size=filesize('filess3/' .  $_POST['image'] );
		$size=$size/1024;
		
		if($size>200){
			$resolution=100/($size/200);
			$resolution=round($resolution);
		}
		imagejpeg($img, 'filess3/' .  $_POST['image'] , $resolution);
?>


<div id="wrapper">
	<div id="logo">
		<div id="image_logo"></div>
		<div class="title"> <p  class="title">Nunt Image creator_</p></div>
	</div>
	<div id="l_tools">
		<div style="display:flex" class="file_download">
			<div id="file_download" class="imagen"></div>
			<p  id="p_file_upload">Descarga tu imagen Nunt y l&uacute;cela en tus redes_</p>
			<a id="alink" style="display:none" href="<?php echo "filess3/" . $_POST['image'];?>" download="<?php echo $_POST['image'];?>"> </a>
		</div>
	</div>
	<div  id="r_tools3">
		<div  class="redes_sociales2">
			<div class="flex-center2">
				<p>Ay&uacutedanos a que el mundo solidarice con los cristianos perseguidos, comp&aacutertelo</p>
			</div>
			<div class="enlaces" style="margin: 0 auto; width:40px;">
				<div style="opacity: 0;"id="fb_image" style="cursor:pointer; background-image: url('images/fb.png')"></div>
				<div style="opacity: 0;"id="insta_image" style="cursor:pointer; background-image: url('images/instagram.png')"></div>
				<div id="tw_image" style="opacity: 1; cursor:pointer; background-image: url('images/twitter.png')"></div>
			</div>
			
		</div>
		<div style="opacity: 0;" class="email">
			<p>Recibe tu imagen Nunt en el mail para descargarla en todos tus disposiitivos</p>
			<div id="email" class="imagen"></div>
		</div>
		<p id="msg"></p>
		
	</div>
	<canvas id="canvas"> </canvas>
	
	<form method="get" action="<?php echo 'filess3/' . $_POST['image'];?>">
		<input id="submit3" style="display:none" type="submit" value="upload" name="submit">
	</form>

	<div class="arrow2">
		<div id="previous" class="imagen"></div>
		<p >Anterior</p>
		<form action="image_process2.php" method="post" enctype="multipart/form-data">
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