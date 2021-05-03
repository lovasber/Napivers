<?php
include "connection.php";
include "functions.php";

$data = [];

$cim = $_POST["cim"];
$szerzo = $_POST["szerzo"];
$torzs = $_POST["vers_torzs"];

$data['cim'] = $cim;
$data['szerzo'] = $cim;
$data['vers_torzs'] = $torzs;

echo 'cim: '.$cim.'<br>';
echo 'szerzo: '.$szerzo.'<br>';
echo 'torzs: '.$torzs.'<br>';

echo json_encode($data);

?>


