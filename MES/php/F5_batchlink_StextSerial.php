<?php
include_once("../classes/card.php");
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/repair.php");
session_start();

$account = $_SESSION['account'];
$serialno = $_GET['serialno'];
$validserialformat1 = SerialFormat::validserialformat($account,$serialno,'Wall Charger - PT');
if($validserialformat1=='false'){
	echo 'Incorrect Format! Serial: '.$serialno;
	return;
}
$serialexist = Batch::checkExist($account,$serialno);
if($serialexist=='false'){
	echo 'Serial does not exist!: '.$serialno;
	return;
}
$qty = Batch::getRemainingBatch($account,$serialno);
if($qty==0){
	echo 'PT already depleted!: '.$serialno;
	return;
}
	echo 'success_'.$serialno.'_'.$qty;

	

?>