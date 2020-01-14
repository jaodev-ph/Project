<?php
include_once("../classes/card.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/repair.php");
include_once("../classes/linking.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$fullserialno = explode(" ",$_GET['serialno']);
	$serialno = $fullserialno[0];
	$fullstation = explode(":",$_GET['station']);
	$station = $fullstation[0];
	$desc = $fullstation[1];
	$seq = $_GET['sequence'];

	$link = Link2::GetLinkDetails($account,$modelno,$station);
	echo 'success_'.$serialno[0].'_'.$account;
	
		

	

?>