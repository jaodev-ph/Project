<?php
include_once("../classes/feeder_insert.php");


session_start();

$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$feederId = $_GET['feederId'];



$feeder = new Insert();
$feeder->setfeederId($feederId);
$feeder->CalGood();

?>