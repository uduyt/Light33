<?php 
//include $_SERVER['DOCUMENT_ROOT'] . '/php/db_connect'; 
	header("Content-Type: text/html;charset=utf-8");
	
# mysql db constants DB_HOST, DB_USER, DB_PASS, DB_NAME
const DB_HOST = 'diverapp.es.mysql';		 
const DB_USER = "diverapp_es";				 
const DB_PASS = 'Ruh6dGBv';
const DB_NAME = 'diverapp_es';


# connect mysql server
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

# check connection
if ($mysqli->connet_errno) {
	//echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
	echo 'error in db connection';
	exit();
}
$acentos = $mysqli->query("SET NAMES 'utf8'");

$event_id= $_GET['event_id'];

$sql="SELECT event_name,event_id,clubs.club_name FROM events,clubs WHERE events.club_id=clubs.club_id";
$result = $mysqli->query($sql);

 while($row = mysqli_fetch_array($result))
    {
		echo "<a href='http://diverapp.es/php/generate_excel_from_event.php?event_id=" . $row['event_id'] . "'>" . $row['event_name'] . ", " . $row['club_name'] . "</a></br>";	
	}
?>