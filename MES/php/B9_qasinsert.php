<?php
include_once("../classes/card.php");
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/logbatch.php");
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
	$a = 0;

	$batchexist = Batch::checkExist($account,$serialno[0]);
	$cardexist = Card::checkExist($account,$serialno[0]);
	
	if($batchexist=='true'){
		
		$Serial = new Batch($account,$serialno[0]);

	if(intval($Quantity) == intval($count) + 1){
		$counter = intval($count) + 1;
		echo 'true_'.$_GET['serialno']."_".$counter."_".$Serial->getPartNo()."_".$Serial->getCurrquantity()."_GOOD";

	}else{
		$counter = intval($count) + 1;
		echo 'false_'.$_GET['serialno']."_".$counter."_".$Serial->getPartNo()."_".$Serial->getCurrquantity()."_GOOD";	
	 }
	}

	if($cardexist=='true'){
		
		$Serial = new Card($account,$serialno[0]);

	if(intval($Quantity) == intval($count) + 1){
		$counter = intval($count) + 1;
		echo 'true_'.$_GET['serialno']."_".$counter."_".$Serial->getPartNo()."_1"."_GOOD";

	}else{
		$counter = intval($count) + 1;
		echo 'false_'.$_GET['serialno']."_".$counter."_".$Serial->getPartNo()."_1"."_GOOD";	
	 }
	}


?>