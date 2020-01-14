<?php
include_once("../classes/ifactory_machinedetails.php");

session_start();

	$name = $_SESSION['name'];

	$machineid = machinedetails::SelectMaxMachineid();

	echo $machineid;

?>