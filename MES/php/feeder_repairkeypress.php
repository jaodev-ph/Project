<?php
include_once("../classes/feeder_receiving.php");
session_start();

$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$feederId = $_GET['feederId'];





$feeder = new Receiving();
$feeder->setfeederId($feederId);

$feeder->RepairInfo(); 

 

echo 'ok_'.$feeder->getfeederId()."_".$feeder->getfeederType()."_".$feeder->getfeederSize();

?>