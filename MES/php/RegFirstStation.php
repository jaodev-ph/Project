<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/card.php");
include_once("../classes/logpass.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$line = $_GET['line'];
	$station = explode(":",$_GET['station']);
	$nextStation = explode(":",$_GET['nextStation']);
	$model = $_GET['model'];
	$result = "";

	$Serial = new Card($account,$serialno[0]);
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
	
	$ModelRoute1 = new ModelRoute();
	$ModelRoute1->setAccount($account);
	$ModelRoute1->setModelNo($model);
	$ModelRoute1->getFirstStation();
	
if ($ModelRoute1->getStation() == $station[0]){
			
			$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($serialno[0]);
			$Card->setSerialNo($serialno[0]);
			$Card->setSystem21('');
			$Card->setWorkorder('');
			$Card->setPartNo($model);
			$Card->setRevision('');
			$Card->setLineCode($line);
			$Card->setHoldFlag(0);
			$Card->setPackFlag(0);
			$Card->setShipFlag(0);
			$Card->setRTVFlag(0);
			$Card->setRejectFlag(0);
			$Card->setStatus('GOOD');
			$Card->setLotno('');
			$Card->setLotType('');
			$Card->setCurtStage($station[0]);
			$Card->setLotType('N');
			$Card->setLastUpdatedBy($name);
			$Card->addCard();
			
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

   echo 'success'."_".$serialno[0];
}
else
{

	if($cardlink == 0){
	if($lotmaking == 0){
		if($station[0]==$nextStation[0]){

			$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($serialno[0]);
			$Card->setStatus('GOOD');
			$Card->setCurtStage($station[0]);
			$Card->setLastUpdatedBy($name);
			$Card->updateStatus();
			

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

		    echo 'success'."_".$serialno[0];

		}else{

		if((ModelRoute::isvalidnextstage($account,$Serial->getPartNo(), $curr, $next)=='true')){

			$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($serialno[0]);
			$Card->setStatus('GOOD');
			$Card->setCurtStage($station[0]);
			$Card->setLastUpdatedBy($name);
			$Card->updateStatus();
			

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

}

?>