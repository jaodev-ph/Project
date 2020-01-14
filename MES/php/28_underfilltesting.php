<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/batch.php");
include_once("../classes/logbatch.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$line = $_GET['line'];
	$station = explode(":",$_GET['station']);
	$nextStation = explode(":",$_GET['nextStation']);
	$quantity = $_GET['Qty'];
	$did = $_GET['DID'];
	$result = "";

	$Serial = new Batch($account,$serialno[0]);
	$ModelRoute = new ModelRoute();
	$ModelRoute->setAccount($account);
	$ModelRoute->setStation($Serial->getCurtStage());
	$ModelRoute->getStationDetails();
	$curr = $ModelRoute->getFlowsequence();
	$ModelRoute->setAccount($account);
	$ModelRoute->setStation($station[0]);
	$ModelRoute->getStationDetails();
	$next = $ModelRoute->getFlowsequence();
	$ModelRoute->setAccount($account);
	$ModelRoute->setModelNo($Serial->getPartNo());
	$ModelRoute->setStation($nextStation[0]);
	$ModelRoute->modelDetails();
	$cardlink = $ModelRoute->getForCardLink();
	$lotmaking = $ModelRoute->getForLotMaking();
	

	
	if($cardlink == 0){
	if($lotmaking == 0){
		if($station[0]==$nextStation[0]){

			$Card = new Batch();
			$Card->setAccount($account);
			$Card->setCardNo($serialno[0]);
			$Card->setStatus('GOOD');
			$Card->setCurtStage($station[0]);
			$Card->setLastUpdatedBy($name);
			$Card->setCurrquantity($quantity);
			$Card->setWorkOrder($did);
			$Card->updateStatus4();
			

			$LogBatch = new LogBatch();
			$LogBatch->setAccount($account);
			$LogBatch->setLine($line);
			$LogBatch->setBatchno($serialno[0]);
			//$Logpass->setSequence(0);
			// $Logpass->setMachine('');
			$LogBatch->setCurtstage($station[0]);
			$LogBatch->setCurrquantity($quantity);
			$LogBatch->setStatus('GOOD');
			$LogBatch->setRemarks('');
			$LogBatch->setLastUpdatedBy($name);
			$LogBatch->addLogbatch();

		    echo 'success'."_".$serialno[0];

		}else{

		if((ModelRoute::isvalidnextstage($account,$Serial->getPartNo(), $curr, $next)=='true')){

			$Card = new Batch();
			$Card->setAccount($account);
			$Card->setCardNo($serialno[0]);
			$Card->setStatus('GOOD');
			$Card->setCurtStage($station[0]);
			$Card->setLastUpdatedBy($name);
			$Card->setCurrquantity($quantity);
			$Card->setWorkOrder($did);
			$Card->updateStatus4();
			

			$LogBatch = new LogBatch();
			$LogBatch->setAccount($account);
			$LogBatch->setLine($line);
			$LogBatch->setBatchno($serialno[0]);
			//$Logpass->setSequence(0);
			// $Logpass->setMachine('');
			$LogBatch->setCurtstage($station[0]);
			$LogBatch->setCurrquantity($quantity);
			$LogBatch->setStatus('GOOD');
			$LogBatch->setRemarks('');
			$LogBatch->setLastUpdatedBy($name);
			$LogBatch->addLogbatch();


			echo 'success'."_".$serialno[0];

		}else{

		echo 'offroute'."_".$serialno[0];

			}

		}

	}else{
	  echo 'forlotmaking'."_".$serialno[0];
	}
	}else{
	  echo 'forcardlink'."_".$serialno[0];
	}



?>