<?php
include_once("../classes/kanban_partsrecords.php");
include_once("../classes/kanban_thawpwb.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];

	

	$did = $_GET['DID'];
	$Startdate = $_GET['StartDate'];
	$Enddate = $_GET['EndDate'];

	$Partsrecords = new Partsrecords();
	$Partsrecords->updateThaw($Startdate,$Enddate,$did,$account);
 	
 	// $Partsrecords->thawbakelogs($Startdate,$Enddate,$did,$machineId,$compotype,$lastupdateby,$remarks)

		
   echo "ok";
	


			
	
?>