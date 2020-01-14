<?php
include_once("../classes/feeder_receiving.php"); 

session_start();

$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$feederId = $_GET['feederId'];
/*$feederType = $_GET['feederType'];
$feederSize = $_GET['feederSize'];
$process = $_GET['process'];
$status = $_GET['status'];
$lastupdatedBy = $_GET['lastupdatedBy'];*/

$feeder = new Receiving();
$feeder->setfeederId($feederId);
/*$feeder->setfeederType($feederType);
$feeder->setfeederSize($feederSize);
$feeder->setprocess($process);
$feeder->setstatus($status);
$feeder->setlastupdatedBy($lastupdatedBy);*/
// $feeder->setlastupdate($lastupdate);

$feeder->ReceivingInfo();
$feeder->nextstage($feeder->getprocess());



echo 'ok_'.$feeder->getfeederId()."_".$feeder->getfeederType()."_".$feeder->getfeederSize()."_".$feeder->getdescription()."_".$feeder->getstatus()."_".$feeder->getlastupdatedBy()."_".$feeder->getprocess();

?>