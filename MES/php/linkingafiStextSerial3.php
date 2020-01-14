<?php
include_once("../classes/card.php");
include_once("../classes/logpass.php");
/*include_once("../classes/serialformat.php");

include_once("../classes/station.php");
include_once("../classes/modelRoute.php");*/
//include_once("../classes/batch.php");
//include_once("../classes/kanban_partsrecords.php");
include_once("../classes/linking.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	//$did = explode(" ",$_GET['did']);
	$serialno = $_GET['serialno'];
	$serialno2 = $_GET['serialno2'];
	$serialno3 = $_GET['serialno3'];
	$model = $_GET['model'];
	$line = $_GET['line'];
	$sequence = $_GET['sequence'];
	$type = 'N';
	$fullstation = explode(":",$_GET['station']);
	$station = $fullstation[0];

	$linkpartno = '';
	$kanbanpartno = '';
/*	$quantity = 0;*/

	
	// $exist = Card::checkExist($account,$serialno);
	
	// $kanban = new Link2();
	// $kanban->pwbqty($did[0]);
	// $quantity = $kanban->getQty();

	// $kanban->pwblot($did[0]);
	// $kanbanpartno = $kanban->getPartno();
	// $kanbanstatus = $kanban->getStatus();

	// $kanban->linkinfowithseq($model,$station,$sequence);
	// $linkpartno = $kanban->getPartno();
	// $linkstatus = $kanban->getStatus();

			// if($exist == 'false'){
			// 	echo 'error1_'.$serialno3.'_'.$sequence;
			// 	return;
			// }
			if($serialno <> $serialno3){
				echo 'Serials does not match!_'.$serialno3,$sequence;
				return;
			}

			// if($kanbanpartno<>$linkpartno){
			// 	echo 'error2_'.$_GET['did'].'_'.$quantity;
			// 	return;
			// }

			// if($kanbanstatus<>$linkstatus){
			// 	echo 'error3_'.$_GET['did'].'_'.$quantity;
			// 	return;
			// }

			// if($quantity <= 0){
			// 	echo 'error4_'.$_GET['did'].'_'.$quantity;
			// 	return;
			// }

			// $Card = new Card();
			// $Card->setAccount($account);
			// $Card->setCardNo($serialno);
			// $Card->setStatus('GOOD');
			// $Card->setCurtStage($station);
			// $Card->setLastUpdatedBy($name);
			// $Card->updateStatus();

			$Logpass = new LogPass();
			$Logpass->setAccount($account);
			$Logpass->setCardNo($serialno);
			$Logpass->setLine($line);
			$Logpass->setSequence(1);
			$Logpass->setMachine('');
			$Logpass->setStation($station);
			$Logpass->setStatus('GOOD');
			$Logpass->setLastUpdatedBy($name);
			$Logpass->addLogpass();

			$totalseq = 1;
			
			echo 'success_'.$serialno3.'_'.$totalseq;
		
		
	

			


?>