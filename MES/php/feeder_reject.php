<?php
include_once("../classes/feeder_receiving.php");


session_start();

$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$feederId = $_GET['feederId'];
$process = $_GET['process'];
$receivedByIssuance = $_GET['receivedByIssuance'];
$endorsedByfeeder = $_GET['endorsedByfeeder'];
$feederType = $_GET['feederType'];
$partsReplaced = json_decode($_GET['partsReplaced']);
$defect = json_decode($_GET['defect']);
$defectDetails = json_decode($_GET['defectDetails']);


$feeder = new Receiving();
$feeder->setfeederId($feederId);
$feeder->setprocess($process);
$feeder->setlastupdatedBy($name);
$feeder->setreceivedByIssuance($receivedByIssuance);
$feeder->setendorsedByfeeder($endorsedByfeeder);
$feeder->Good($feederType);


for($i=0;$i<count($defect);$i++){

	$feeder->setfeederId($feederId);
	$feeder->setprocess($process);
	$feeder->setlastupdatedBy($name);
	$feeder->setpartsReplaced($partsReplaced[$i]);
    $feeder->setdefect($defect[$i]);
    $feeder->setdefectDetails($defectDetails[$i]);
	$feeder->logrepair();
}

?>