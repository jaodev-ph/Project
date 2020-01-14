<?php
include_once("../classes/card.php");
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/repair.php");
include_once("../classes/linking.php");
session_start();

$account = $_SESSION['account'];
$serialno = $_GET['serialno'];
$validserialformat1 = SerialFormat::validserialformat($account,$serialno,'Wall Charger - TS');
if($validserialformat1=='false'){
	echo 'Incorrect Format! Serial: '.$serialno;
	return;
}
$serialexist = Card::checkExist($account,$serialno);
if($serialexist=='false'){
	echo 'Serial does not exist!: '.$serialno;
	return;
}
$qty = Link2::getcountlink($account,$serialno,'Wall Charger - BS');
if($qty>0){
	echo 'Serial already linked!: '.$serialno;
	return;
}
	echo 'success_'.$serialno;


?>