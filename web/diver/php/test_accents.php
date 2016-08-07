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

$sql="SELECT order_name as Nombre, order_dni as DNI, order_dob as DOB , datetime as DATETIME FROM orders WHERE datetime > DATE_SUB(NOW(), INTERVAL 2 DAY) AND entry_id in(SELECT entry_id
																																	FROM entries
																																	WHERE event_id={$event_id}) ORDER BY order_name";
	$result = $mysqli->query($sql);

$sql2="SELECT event_name FROM events WHERE event_id={$event_id}";
		
$result2 = $mysqli->query($sql2);

$row = mysqli_fetch_array($result2);
$event_name=$row['event_name'];

/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
$fields_result=$result;

while ($field=$result->fetch_field()) {
echo $field->name . "\t";
}
print("\n");    
//end of printing column names  
//start while loop to get data
    while($row = mysqli_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysqli_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = str_replace("á", "&#225;", $schema_insert);
        $schema_insert = str_replace("é", "7", $schema_insert);
        $schema_insert = str_replace("í", "7", $schema_insert);
        $schema_insert = str_replace("ó", "7", $schema_insert);
        $schema_insert = str_replace("ú", "7", $schema_insert);
        $schema_insert = str_replace("ñ", "7", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }   
?>