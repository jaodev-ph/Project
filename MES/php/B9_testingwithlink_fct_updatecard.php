<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/card.php");
include_once("../classes/logpass.php");
include_once("../classes/linking.php");
session_start();


$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$model = $_GET['model'];
$serialno = explode(" ",$_GET['serialno']);
$serialno1 = $serialno[0];
$fullserialno2 = explode(" ",$_GET['serialno2']);
$serialno2 = $fullserialno2[0];
$line = $_GET['line'];
$station = explode(": ",$_GET['station']);
$nextStation = explode(":",$_GET['nextStation']);
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

			$linkedMac = Link2::getLinkedMac($account,$serialno[0],$model,$station[0]);
			if(strlen($linkedMac)==0){
				$macPN = Link2::getB9MacAddressPN($account,$model);
				$link = new Link2();
				$link->setAccount($account);
				$link->setSerialNo($serialno1);
				$link->setSerialNoLink($serialno2);
				$link->setPartNo($model);
				$link->setPartNoLink($macPN);
				$link->setQty('1');
				$link->setStation($station[0]);
				$link->setDescription($station[1]);
				$link->setLastUpdatedBy($name);
				$link->addLogLink();
			}

			echo 'success'."_".$serialno[0]."_".strlen($linkedMac);

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

			 	$linkedMac = Link2::getLinkedMac($account,$serialno[0],$model,$station[0]);
			if(strlen($linkedMac)==0){
				$macPN = Link2::getB9MacAddressPN($account,$model);
				$link = new Link2();
				$link->setAccount($account);
				$link->setSerialNo($serialno1);
				$link->setSerialNoLink($serialno2);
				$link->setPartNo($model);
				$link->setPartNoLink($macPN);
				$link->setQty('1');
				$link->setStation($station[0]);
				$link->setDescription($station[1]);
				$link->setLastUpdatedBy($name);
				$link->addAcce();
			}

				echo 'success'."_".$serialno[0]."_".strlen($linkedMac);

			}else{

				echo 'offroute'."_".$serialno[0];

			}

		}

	}else{
		echo 'forlotmaking'."_".$serialno[0];
	}
}



?>