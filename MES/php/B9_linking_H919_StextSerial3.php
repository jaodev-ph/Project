<?php
include_once("../classes/card.php");
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/repair.php");
session_start();

$account = $_SESSION['account'];
$serialno3 = $_GET['serialno3'];
$validserialformat1 = SerialFormat::validserialformat($account,$serialno3,'H919ITLC');
if($validserialformat1=='false'){
	echo 'Incorrect Format! Serial: '.$serialno3;
	return;
}
$qty = Batch::getBatchQty($account,$serialno3);
if($qty==20){
	echo 'Max Qty reached! Serial: '.$serialno3;
	return;
}
	echo 'success_'.$serialno3.'_'.$qty;

	

?>