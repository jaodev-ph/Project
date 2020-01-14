<?php
//include_once("../classes/card.php");
// include_once("../classes/serialformat.php");
// include_once("../classes/logpass.php");
// include_once("../classes/station.php");
include_once("../classes/modelRoute.php");
include_once("../classes/batch.php");
//include_once("../classes/kanban_partsrecords.php");
include_once("../classes/linking.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serial1 = explode(" ",$_GET['serial1']);
	$model = $_GET['model'];
	$type = 'N';
	$station = $_GET['station'];

	$linkpartno = '';
	$kanbanpartno = '';
	$quantity = 1;

	
	$exist = Link2::BatchCheckExist($account,$serial1[0]);

	if($exist == 'false'){
		echo 'error1_'.$serial1[0].'_'.$quantity;
		return;
	}

	$Batch = new Batch($account,$serial1[0]);
	$dbmodel = $Batch->getPartNo();
	$dbstation = $Batch->getCurtStage();
	$dbstatus = $Batch->getStatus();

	if($dbmodel <> $model){
		echo 'error2_'.$serial1[0].'_'.$quantity;
		return;
	}

	if($dbstatus <> 'GOOD'){
		echo 'error3_'.$serial1[0].'_'.$quantity;
		return;
	}

	$modelRoute = new modelRoute();
	$modelRoute->setAccount($account);
	$modelRoute->setStation($dbstation);
	$modelRoute->setModelNo($dbmodel);
	$modelRoute->getStationDetails2();
	$flowseq = $modelRoute->getFlowsequence();

	$modelRoute->setAccount($account);
	$modelRoute->setStation($station);
	$modelRoute->setModelNo($model);
	$modelRoute->getStationDetails2();
	$chooseflowseq = $modelRoute->getFlowsequence();

	$validstation = ModelRoute::isvalidnextstage2($account,$dbmodel, $flowseq, $chooseflowseq);

	if($validstation == 'false'){
		echo 'error4_'.$serial1[0].'_'.$quantity;
		return;
	}

	$link = new Link2();
	$link->batchqty($serial1[0]);
	$quantity = $link->getQty();

	// $kanban->pwblot($did[0]);
	// $kanbanpartno = $kanban->getPartno();
	// $kanbanstatus = $kanban->getStatus();

	// $kanban->linkinfo($model,$station);
	// $linkpartno = $kanban->getPartno();
	// $linkstatus = $kanban->getStatus();

			

	// 		if($kanbanpartno<>$linkpartno){
	// 			echo 'error2_'.$_GET['did'].'_'.$quantity;
	// 			return;
	// 		}

	// 		if($kanbanstatus<>$linkstatus){
	// 			echo 'error3_'.$_GET['did'].'_'.$quantity;
	// 			return;
	// 		}

			if($quantity <= 0){
				echo 'error4_'.$serial1[0].'_'.$quantity;
				return;
			}


			echo 'success_'.$serial1[0].'_'.$quantity.'_'.$validstation;
		
		
	

			


?>