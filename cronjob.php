<?php
/*
$servername = "lovas.it";//lovas.it - localhost
$username = "lovasit_lovasBertalan";//lovasit_lovasBertalan - root
$password = "LovasIt2424";//LovasIt2424 -mysql
$dbname = "lovasit_napivers";//lovasit_szavak - szavak
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");//kulonben nincsenek ekezetek
// Check connection
if ($conn->connect_error) {
    //die("Connection failed: " . $conn->connect_error);
} 
*/
#echo "Connected successfully ";
//debug_to_console("Connected succesfully");


#lokális
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "napivers";
$conn = new mysqli($servername, $username, $password,$db_name);

// Create connection
//

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$napi_vers_count_sql = "SELECT COUNT(id) as db FROM aktualis_napi_vers";
$napi_vers_count_eredmeny = $conn->query($napi_vers_count_sql);
$napi_vers_sor = $napi_vers_count_eredmeny->fetch_assoc();
$napi_vers_db = $napi_vers_sor["db"];
echo 'Napi vers db: '.$napi_vers_db;


$osszes_vers_count_sql = "SELECT COUNT(id) as db FROM vers";
$osszes_vers_count_eredmeny = $conn->query($osszes_vers_count_sql);
$osszes_vers_sor = $osszes_vers_count_eredmeny->fetch_assoc();
$osszes_vers_db = $osszes_vers_sor["db"];
echo 'Összes vers db: '.$osszes_vers_db;

if($napi_vers_db == $osszes_vers_db){
    //delete 
    $napi_vers_torol_sql = "TRUNCATE aktualis_napi_vers";
    echo 'DELETE ALL';
    $conn->query($napi_vers_torol_sql);
}

$korabbi_vers_idk_sql = "SELECT versid FROM aktualis_napi_vers";
$korabbi_vers_result = $conn->query($korabbi_vers_idk_sql);

$random_id_sql = "SELECT id 
    FROM vers 
    WHERE id
    NOT IN
    (
        SELECT versid FROM aktualis_napi_vers
    )
    ORDER BY RAND() 
    LIMIT 1";
$random_id_sql_eredmeny = $conn->query($random_id_sql);
$random_id_sql_sor = $random_id_sql_eredmeny->fetch_assoc();
$random_id = $random_id_sql_sor["id"];

echo 'random id: '.$random_id;
//}

$stmt = $conn->prepare("INSERT INTO aktualis_napi_vers (id,datum,versid)
VALUES (Null,CURDATE(), $random_id)");
$stmt->execute();  

echo 'sikeres frissítés';


$conn->close();

?>