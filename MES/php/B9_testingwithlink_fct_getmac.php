<?php
include_once("../classes/card.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/modelRoute.php");
include_once("../classes/linking.php");
session_start();


$account = trim($_SESSION['account']);
$serialno = explode(" ",$_GET['serialno']);
$model = $_GET['model'];

$MacMatrix = Link2::getB9MacAddress($account,$model);
$SFModel = Link2::getB9MacFormatModel($account,$model,$serialno[0]);


if($MacMatrix<>$SFModel){
	echo 'Wrong Format'."_".$serialno[0];
	return;
}

$CountAcce = Link2::getSumAcce($account,$serialno[0]);

if($CountAcce>0){
	echo 'Already Linked!'."_".$serialno[0];
}


echo 'success'."_".$serialno[0];

?>