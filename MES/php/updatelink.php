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
	$model = $_GET['model'];
	$modelno = $_GET['modelno'];	
	$station = explode(":",$_GET['station']);


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
	$ModelRoute->setStation($station[0]);
	$ModelRoute->modelDetails();
	$cardlink = $ModelRoute->getForCardLink();
	$lotmaking = $ModelRoute->getForLotMaking();


if((ModelRoute::isvalidnextstage($account,$Serial->getPartNo(), $curr, $next)=='true')){
	if($cardlink == 1){
		
			$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($serialno[0]);
			$Card->setStatus('GOOD');
			$Card->setPartNo($model);
			$Card->setLastUpdatedBy($name);
			$Card->updatePartNo();
			
			$Logpass = new LogPass();
			$Logpass->setAccount($account);
			$Logpass->setLine('');
			$Logpass->setCardNo($serialno[0]);
			$Logpass->setSequence(0);
			$Logpass->setMachine('');
			$Logpass->setStation('Link');
			$Logpass->setStatus('GOOD');
			$Logpass->setLastUpdatedBy($name);
			$Logpass->addLogpass();

			$link = new Link2();
			$link->setAccount($account);
			$link->setSerialno($serialno[0]);
			$link->setPartno($model);
			$link->setSerialnoLink($serialno[0]);
			$link->setPartnoLink($modelno);
			$link->setQty('0');
			$link->setStation($station[0]);
			$link->setDescription($station[1]);
			$link->setLastUpdatedBy($name);
			$link->addLogLink();


			echo 'success'."_".$serialno[0];
}else{
		 echo 'forcardlink'."_".$serialno[0];
	}
}else{
	
	 echo 'offroute'."_".$serialno[0];
}

?>