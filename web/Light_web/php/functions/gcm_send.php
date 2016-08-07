<?php 

const DB_HOST = 'mysql.hostinger.es';		 
		const DB_USER = "u739882124_roset";				 
		const DB_PASS = 'fertdgcv';
		const DB_NAME = 'u739882124_dbuse';
		
		$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		
		if ($mysqli->connet_errno) {
			//echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
			echo 'error in db connection';
			exit();}
			

function sendGoogleCloudMessage($topic, $title, $text, $type, $link,$apiKey)
{
    $url = 'https://gcm-http.googleapis.com/gcm/send';

	$data= array("title" => $title,
			"text" => $text,
			"type" => $type,
			"link" => $link, 
			);
	$post = array(
                    'to'  	=> '/topics/' . $topic,
                    'data'  => $data,
                    );
$headers = array(
             'Authorization: key=' . $apiKey,
             'Content-Type: application/json'
         );
					
    // Initialize curl handle       
    $ch = curl_init();

    // Set URL to GCM endpoint      
    curl_setopt( $ch, CURLOPT_URL, $url );

    // Set request method to POST       
    curl_setopt( $ch, CURLOPT_POST, true );

    // Set our custom headers       
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );

    // Get the response back as string instead of printing it       
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	
    // Set JSON post data
    curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $post ) );

    // Actually send the push   
    $result = curl_exec( $ch );

    // Error handling
    if ( curl_errno( $ch ) )
    {
        echo 'server tecnical error: ' . curl_error( $ch );
    }

    // Close curl handle
    curl_close( $ch );

}

include $_SERVER['DOCUMENT_ROOT'] . '/php/functions/gcm_data.php';

$title=$_GET["title"];
$text=$_GET["text"];
$type=$_GET["type"];
$link=$_GET["link"];
$topic=$_GET['topic'];
$url=$_GET["url"];

date_default_timezone_set("Europe/Madrid");
$timestamp=date_default_timezone_get();
$mydate = date('Y-m-d H:i:s', strtotime($timestamp));

$sql="INSERT INTO notificaciones (type, title,text, link, state, topic, date) VALUES ('{$type}', '{$title}','{$text}','{$link}','read','{$topic}','{$mydate}') ";
echo $sql;
$mysqli->query($sql);

header('Location: http://lightbeta.esy.es/' . $url);

sendGoogleCloudMessage($topic, $title, $text, $type, $link,$apiKey);

		?>