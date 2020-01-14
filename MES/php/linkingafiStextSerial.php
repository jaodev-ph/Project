<?php
include_once("../classes/card.php");
/*include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/modelRoute.php");*/
//include_once("../classes/batch.php");
//include_once("../classes/kanban_partsrecords.php");
include_once("../classes/modelroute.php");
include_once("../classes/linking.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	//$did = explode(" ",$_GET['did']);
	$fullstation = explode(":",$_GET['station']);
	$serialno = $_GET['serialno'];
	$model = $_GET['model'];
	$sequence = $_GET['sequence'];
	$type = 'N';
	$station = $fullstation[0];

	$linkpartno = '';
	$kanbanpartno = '';
/*	$quantity = 0;*/
$totalseq = $sequence +1;
	
	$exist = Card::checkExist($account,$serialno);
	$kanban = new Link2();
	// $kanban->pwbqty($did[0]);
	// $quantity = $kanban->getQty();

	// $kanban->pwblot($did[0]);
	// $kanbanpartno = $kanban->getPartno();
	// $kanbanstatus = $kanban->getStatus();

	// $kanban->linkinfowithseq($model,$station,$sequence);
	// $linkpartno = $kanban->getPartno();
	// $linkstatus = $kanban->getStatus();

	$card = new Card($account,$serialno);
	$partno = $card->getPartno();
	$curtstage = $card->getCurtStage();
	$status = $card->getStatus();

	$isvalidnextstage = ModelRoute::isvalidnextstage2($account,$model,$curtstage,$station);

			if($exist == 'false'){
				echo 'Serial: '.$serialno.' does not exist!_'.$serialno.'_'.$sequence.'_'.$partno.'_'.$isvalidnextstage;
				return;
			}

			if($model<>$partno){
				echo 'Model '.$partno.' does not match!_'.$serialno.'_'.$sequence.'_'.$partno.'_'.$isvalidnextstage;
				return;
			}
			if($status<>'GOOD'){
				echo 'Serial: '.$serialno.' status is '.$status.'!_'.$serialno.'_'.$sequence.'_'.$partno.'_'.$isvalidnextstage;
				return;
			}

			if($isvalidnextstage<>'true'){
				echo 'Serial: '.$serialno.' is Offroute!_'.$serialno.'_'.$sequence.'_'.$partno.'_'.$isvalidnextstage;
				return;
			}

			// if($kanbanstatus<>$linkstatus){
			// 	echo 'error3_'.$_GET['did'].'_'.$quantity;
			// 	return;
			// }

			// if($quantity <= 0){
			// 	echo 'error4_'.$_GET['did'].'_'.$quantity;
			// 	return;
			// }

			
			echo 'success_'.$serialno.'_'.$totalseq.'_'.$partno.'_'.$station.'_'.$isvalidnextstage;
		
		
	

			


?>