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
	$RQuantity = $_GET['RQuantity'];
	$lotno = $_GET['lotno'];
	$station = explode(":",$_GET['station']);
	$Serial = new Card($account,$serialno[0]);
	
	if($Serial->getLotno() == ""){
			$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($serialno[0]);
			$Card->setStatus('GOOD');
			$Card->setCurtStage($station[0]);
			$Card->setLastUpdatedBy($name);
			$Card->updateStatus();
			$Card->setLotno($lotno);
			$Card->updatetheLotno();

			$Logpass = new LogPass();
			$Logpass->setAccount($account);
			$Logpass->setLine($line);
			$Logpass->setCardNo($serialno[0]);
			$Logpass->setSequence(0);
			$Logpass->setMachine('');
			$Logpass->setStation($station[0]);
			$Logpass->setStatus('GOOD');
			$Logpass->setLastUpdatedBy($name);
			$Logpass->addLogpass();

			$lotcount = Card::getCountSerialByLot($account,$lotno);

			if($lotcount == $RQuantity){
			echo 'success_'.$_GET['serialno']."_".$lotcount."_completed";
			}else{
			echo 'success_'.$_GET['serialno']."_".$lotcount."_notcompleted";	
			}

		}else{
			echo 'alreadyonlot_'.$_GET['serialno'];
		}


?>