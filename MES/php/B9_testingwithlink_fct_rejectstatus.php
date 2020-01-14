<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/card.php");
include_once("../classes/logpass.php");
include_once("../classes/linking.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$serialno1 = $serialno[0];
	$fullserialno2 = explode(" ",$_GET['serialno2']);
	$serialno2 = $fullserialno2[0];
	$line = $_GET['line'];
	$model = $_GET['model'];
	$station = explode(": ",$_GET['station']);
	$nextStation = explode(":",$_GET['nextStation']);
	$result = "";

	$Serial = new Card($account,trim($serialno[0]));
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


			
		    echo 'success'."_".$serialno[0];

		}else{

		if((ModelRoute::isvalidnextstage($account,trim($Serial->getPartNo()), $curr, $next)=='true')){

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