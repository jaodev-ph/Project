<?php
include_once("../classes/card.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/repair.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$line = '';
	$trackingnos = json_decode($_GET['trackingnos']);
	$cmbrejectcat2 = json_decode($_GET['cmbrejectcat2']);
	$cmbrejectcode2 = json_decode($_GET['cmbrejectcode2']);
	$txtlocation2 = json_decode($_GET['txtlocation2']);
	$txtdetails2 = json_decode($_GET['txtdetails2']);

	$Repair = new Repair();
	for($i=0;$i<count($trackingnos);$i++){
	$cmbrejectcat = explode(":",$cmbrejectcat2[$i]);	
	$cmbrejectcode = explode(":",$cmbrejectcode2[$i]);	
	
	$Repair->updateRejectDetail($account,$serialno[0],$trackingnos[$i],$cmbrejectcat[0],$cmbrejectcode[0],$txtlocation2[$i],$txtdetails2[$i]);

	}

			$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($serialno[0]);
			$Card->updateVarify();
			
			$Logpass = new LogPass();
			$Logpass->setAccount($account);
			$Logpass->setLine($line);
			$Logpass->setCardNo($serialno[0]);
			$Logpass->setSequence(0);
			$Logpass->setMachine('');
			$Logpass->setStation('FA');
			$Logpass->setStatus('');
			$Logpass->setLastUpdatedBy($name);
			$Logpass->addLogpass();

	echo 'success_'.$serialno[0];

?>