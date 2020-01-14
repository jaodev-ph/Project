<?php
include_once("../classes/kanban_partsrecords.php");
include_once("../classes/kanban_thawpwb.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];

	$remarks ="";

	$did = $_GET['DID'];
	$Startdate = $_GET['StartDate'];
	$Enddate = $_GET['EndDate'];
	$machineId = $_GET['machineId'];

	$Partsrecords = new Partsrecords();
	$Partsrecords->didInfo($did);

	$Partsrecords->updateThaw($Startdate,$Enddate,$did,$account);


		$Partsrecords->thawbakelogs($Startdate,$Enddate,$did,$machineId,$Partsrecords->getCompotype(),$name,$remarks,$account);

		echo "ok";
	


			
	
?>