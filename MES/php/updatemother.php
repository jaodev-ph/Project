<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/mother.php");
include_once("../classes/logmother.php");
include_once("../classes/model.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$line = $_GET['line'];
	$station = explode(":",$_GET['station']);
	$nextStation = explode(":",$_GET['nextStation']);
	$quantity = $_GET['Qty'];
	$result = "";
	$model = $_GET['model'];

	$Serial = new Mother($account,$serialno[0]);
	$ModelRoute = new ModelRoute();
	$ModelRoute->setAccount($account);
	$ModelRoute->setStation($Serial->getCurtStation());
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
	
	$childmodel = Model::SelectChildModel($account,$model);
	
	if($cardlink == 0){
	if($lotmaking == 0){
		if($station[0]==$nextStation[0]){
			
for($i=0;$i<count($childmodel);$i++){

			$Mother = new Mother();
			$Mother->setAccount($account);
			$Mother->setCardNo($serialno[0]);
			$Mother->setStatus('GOOD');
			$Mother->setCurtstation($station[0]);
			$Mother->setLastUpdatedBy($name);
			$Mother->updateStatus();

			$LogMother = new LogMother();
			$LogMother->setAccount($account);
			$LogMother->setLine($line);
			$LogMother->setMotherSerial($serialno[0]);
			$LogMother->setChildPartNo($childmodel[$i]->getModel());
			$LogMother->setStage($station[0]);
			$LogMother->setStatus('GOOD');
			$LogMother->setLastUpdatedBy($name);
			$LogMother->setCurrquantity($childmodel[$i]->getItemWt());
			$LogMother->setDisquantity(0);
			$LogMother->setRemarks('');
			$LogMother->addLogMother();
}
		    echo 'success'."_".$serialno[0];


		}else{

		if((ModelRoute::isvalidnextstage($account,$Serial->getPartNo(), $curr, $next)=='true')){

				$Mother = new Mother();
			$Mother->setAccount($account);
			$Mother->setCardNo($serialno[0]);
			$Mother->setStatus('GOOD');
			$Mother->setCurtstation($station[0]);
			$Mother->setLastUpdatedBy($name);
			$Mother->setCurrquantity($childmodel[$i]->getItemWt());
			$Mother->updateStatus();
			
for($i=0;$i<count($childmodel);$i++){
			$LogMother = new LogMother();
			$LogMother->setAccount($account);
			$LogMother->setLine($line);
			$LogMother->setMotherSerial($serialno[0]);
			$LogMother->setChildPartNo($childmodel[$i]->getModel());
			$LogMother->setStage($station);
			$LogMother->setStatus('GOOD');
			$LogMother->setLastUpdatedBy($name);
			$LogMother->setCurrquantity($childmodel[$i]->getItemWt());
			$LogMother->setDisquantity(0);
			$LogMother->setRemarks('');
			$LogMother->addLogMother();
}


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