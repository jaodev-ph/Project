<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/model.php");
include_once("../classes/lotnumber.php");
include_once("../classes/loglot.php");
session_start();


	$account = trim($_SESSION['account']);
	$modelno = $_GET['modelno'];
	$station = explode(":",$_GET['station']);
	$LotQuantity = $_GET['LotQuantity'];
	$name = $_SESSION['name'];
	$reference = $_GET['reference'];
	$lotno = $_GET['lotno'];
	$total = $_GET['total'];
	$partcode = trim($_GET['partcode']);

	$lot = Lotnumber::referencelotcheckExist($account,$lotno,$reference);
	
if ($lot == 'true'){
	 
	$lotnumber = new Lotnumber();
	$lotnumber->setPartno($modelno);
	$lotnumber->setAccount($account);
	$lotnumber->setLotno($lotno);
	$lotnumber->setQuantity($LotQuantity);
	$lotnumber->setPartno($modelno);
	$lotnumber->setStatus('GOOD');
	$lotnumber->setStage($station[0]);
	$lotnumber->setLastUpdatedBy($name);
	$lotnumber->updateLotStatus();

	$loglot = new Loglot();
	$loglot->setAccount($account);
	$loglot->setLotno($reference);
	$loglot->setModelno($modelno);
	$loglot->setStation($station[0]);
	$loglot->setStatus('GOOD');
	$loglot->setSamplingsize($LotQuantity);
	$loglot->setLastUpdatedBy($name);
	$loglot->addLotLogpass();

}else{

	 $LotNo = new LotNumber();
        $LotNo->setAccount($account);
        $LotNo->setLotno($lotno);
        $LotNo->setCounter(0);
        $LotNo->setReference($reference);
        $LotNo->setPartno($modelno);
        $LotNo->setStage($station[0]);
        $LotNo->setStatus('GOOD');
        $LotNo->setSamplingSize(0);
        $LotNo->setLastupdatedby($name);
        $LotNo->setQuantity($LotQuantity);
        $LotNo->setPackingref($partcode);
        $LotNo->addLot();

    $loglot = new Loglot();
	$loglot->setAccount($account);
	$loglot->setLotno($reference);
	$loglot->setModelno($modelno);
	$loglot->setStation($station[0]);
	$loglot->setStatus('GOOD');
	$loglot->setSamplingsize($LotQuantity);
	$loglot->setLastUpdatedBy($name);
	$loglot->addLotLogpass();
	}
	echo 'success_'.$lotno;

?>