<?php

$servername = "localhost";
$username = "root";
$password = "";
$db_name = "napivers";

// Create connection
$conn = new mysqli($servername, $username, $password,$db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


#szerver konfig
/*
$servername = "lovas.it";//lovas.it - localhost
$username = "lovasit_lovasBertalan";//lovasit_lovasBertalan - root
$password = "LovasIt2424";//LovasIt2424 -mysql
$dbname = "lovasit_napivers";//lovasit_szavak - szavak
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");//kulonben nincsenek ekezetek
*/
    
?>