<?php
include_once("../classes/card.php");
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/repair.php");
session_start();

$account = $_SESSION['account'];
$serialno2 = $_GET['serialno2'];
$validserialformat = SerialFormat::validserialformat($account,$serialno2,'H599ITLB');
if($validserialformat=='false'){
	echo 'Incorrect Format! Serial: '.$serialno2;
	return;
}
$qty = Batch::getBatchQty($account,$serialno2);

	echo 'success_'.$serialno2.'_'.$qty;

	

?>