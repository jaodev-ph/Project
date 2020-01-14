<?php
include_once("../classes/feeder_receiving.php");


session_start();

$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$feederId = $_GET['feederId'];
$process = $_GET['process'];
$receivedByIssuance = $_GET['receivedByIssuance'];
$endorsedByfeeder = $_GET['endorsedByfeeder'];
$status = $_GET['status'];
$feederType = $_GET['feederType'];

if($status=="PM")
{
	$feeder = new Receiving();
	$feeder->setfeederId($feederId);
	$feeder->setprocess($process);
	$feeder->setlastupdatedBy($name);
	$feeder->setfeederId($feederId);
	$feeder->setreceivedByIssuance($receivedByIssuance);
	$feeder->setendorsedByfeeder($endorsedByfeeder);
	$feeder->Good($feederType);
}
else if($status=="REPAIR")
{
	$feeder = new Receiving();
	$feeder->setfeederId($feederId);
	$feeder->setprocess($process);
	$feeder->setlastupdatedBy($name);
	$feeder->setfeederId($feederId);
	$feeder->setreceivedByIssuance($receivedByIssuance);
	$feeder->setendorsedByfeeder($endorsedByfeeder);
	$feeder->Reject();
}


?>