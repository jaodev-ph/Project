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
$validserialformat1 = SerialFormat::validserialformat($account,$serialno,'H980TH');
if($validserialformat1=='false'){
	echo 'Incorrect Format! Serial: '.$serialno;
	return;
}
$qty = Batch::getBatchQty($account,$serialno);
if($qty==360){
	echo 'Max Qty reached! Serial: '.$serialno;
	return;
}
	echo 'success_'.$serialno.'_'.$qty;

	

?>