<?php
include_once("../classes/card.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$line ='';
	$serialno = explode(" ",$_GET['serialno']);
	$Quantity = $_GET['quantity'];
	$count = $_GET['count'];
	$lotno = $_GET['lotno'];
	$station = explode(":",$_GET['station']);
	$Serial = new Card($account,$serialno[0]);

	if(intval($Quantity) == intval($count) + 1){
		$counter = intval($count) + 1;
		echo 'true_'.$_GET['serialno']."_".$counter."_".$Serial->getPartNo();

	}else{
		$counter = intval($count) + 1;
		echo 'false_'.$_GET['serialno']."_".$counter."_".$Serial->getPartNo();	
	 }


?>