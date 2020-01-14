<?php
include_once("../classes/feeder_receiving.php");

session_start();

$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$feederId = $_GET['feederId'];
$endorsedByIssuance = $name;
$receivedByIssuance = $_GET['receivedByIssuance'];



$feeder = new Receiving();
$feeder->setfeederId($feederId);
$feeder->setendorsedByIssuance($endorsedByIssuance);
$feeder->setreceivedByIssuance($receivedByIssuance);

$feeder->Issue();
//echo 'ok_'.$feeder->getfeederId()."_".$feeder->getfeederType()."_".$feeder->getplantNoFeeder();
?>