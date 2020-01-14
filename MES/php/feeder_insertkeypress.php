<?php

include_once("../classes/feeder_insert.php");
session_start();

$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$feederId = $_GET['feederId'];

echo $feederId;
// $feederType = $_GET['feederType'];
// $plantNoFeeder = $_GET['plantNoFeeder'];

// $feeder = new Insert;
// $feeder->setfeederId($feederId);
// $feeder->setfeederType($feederType);
// $feeder->setplantNoFeeder($plantNoFeeder);

// $feeder->InsertInfo();

?>