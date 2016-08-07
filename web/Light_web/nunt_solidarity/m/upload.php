<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
$target_dir =  __DIR__ . "/../filess/";
$maxsize=100; //size in megabytes
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "target_file:: " . $target_file . ":: File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.	";
		echo "getimagesize";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    //echo "Sorry, file already exists.	";
	//echo "no exist";
    //$uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > $maxsize*1000000) {
    //echo "Sorry, your file is too large.	";
    $uploadOk = 0;
	echo "maxsize";
}
// Allow certain file formats
if(strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpeg"
&& strtolower($imageFileType) != "gif" ) {
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed, your file is  " . $imageFileType . ".  	";
    $uploadOk = 0;
	echo "not type";
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.	";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.	";
		$filess = scandir(dirname($target_file));
		$imnum=count($filess)-2;
		rename($target_file,"../filess/image" . $imnum. "." . $imageFileType);
		$dir="../filess/image" . $imnum. "." . $imageFileType;
		$target_file=__DIR__ . "/../filess/image" . $imnum. "." . $imageFileType;

	if(strtolower($imageFileType) == "jpg" || strtolower($imageFileType) == "jpeg"){
		$im = imagecreatefromjpeg($dir );
	}

	if(strtolower($imageFileType) == "png"){
		$im = imagecreatefrompng($dir );
		$bg = imagecreatetruecolor(imagesx($im), imagesy($im));
		imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
		imagealphablending($bg, TRUE);
		imagecopy($bg, $im, 0, 0, 0, 0, imagesx($im), imagesy($im));
		imagedestroy($im);
		$im=$bg;
	}

	if(strtolower($imageFileType) == "gif" ) {
		$im = imagecreatefromgif($dir);
	}
	
		$resolution=100;
		$size=filesize($dir);
		$size=$size/1024;
		
		if($size>200){
			$resolution=100/($size/200);
			$resolution=round($resolution);
		}
		//echo $size. ", " . $resolution;
		

		$dir="../filess/image" . $imnum. ".jpg";
		
		imagejpeg($im,$dir , $resolution);
		imagedestroy($im);
		//echo 'Location: http://lightbeta.esy.es/nunt_solidarity/image_process2.html?id=' . 'image' . $imnum. '.' . $imageFileType;
		header('Location: http://lightbeta.esy.es/nunt_solidarity/m/image_process.php?id=' . 'image' . $imnum . '.jpg');
    } else {
        echo "Sorry, there was an error uploading your file.	";
    }
}
?>