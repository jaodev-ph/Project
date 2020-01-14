<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/model.php");
include_once("../classes/lotnumber.php");
include_once("../classes/loglot.php");
include_once("../classes/batch.php");
include_once("../classes/logbatch.php");
session_start();


	$account = trim($_SESSION['account']);
	$modelno = $_GET['modelno'];
	$station = explode(":",$_GET['station']);
	$name = $_SESSION['name'];
	$lotno = explode(" ",$_GET['lotno']);
	$samplingCount = $_GET['samplingCount'];
	$hserialno = json_decode($_GET['hserialno']);
	$hstatus = json_decode($_GET['hstatus']);
	$hqty = json_decode($_GET['hqty']);


$lotreject = Batch::getLotSerialReject($account,$lotno[0]);

if ($lotreject == true){

	$lotnumber = new Lotnumber();
	$lotnumber->setPartno($modelno);
	$lotnumber->setAccount($account);
	$lotnumber->setLotno($lotno[0]);
	$lotnumber->setStatus('REJECT');
	$lotnumber->setSamplingSize($samplingCount);
	$lotnumber->setStage($station[0]);
	$lotnumber->setLastUpdatedBy($name);
	$lotnumber->updateLotQas();

	$loglot = new Loglot();
	$loglot->setAccount($account);
	$loglot->setLotno($lotno[0]);
	$loglot->setModelno($modelno);
	$loglot->setStation($station[0]);
	$loglot->setStatus('REJECT');
	$loglot->setSamplingsize($samplingCount);
	$loglot->setLastUpdatedBy($name);
	$loglot->addLotLogpass();

}else{

	$lotnumber = new Lotnumber();
	$lotnumber->setPartno($modelno);
	$lotnumber->setAccount($account);
	$lotnumber->setLotno($lotno[0]);
	$lotnumber->setStatus('GOOD');
	$lotnumber->setSamplingSize($samplingCount);
	$lotnumber->setStage($station[0]);
	$lotnumber->setLastUpdatedBy($name);
	$lotnumber->updateLotQas();

	$loglot = new Loglot();
	$loglot->setAccount($account);
	$loglot->setLotno($lotno[0]);
	$loglot->setModelno($modelno);
	$loglot->setStation($station[0]);
	$loglot->setStatus('GOOD');
	$loglot->setSamplingsize($samplingCount);
	$loglot->setLastUpdatedBy($name);
	$loglot->addLotLogpass();
}

	for($x=0;$x<count($hserialno);$x++)
	{
			$Card = new Batch();
			$Card->setAccount($account);
			$Card->setCardNo($hserialno[$x]);
			$Card->setStatus($hstatus[$x]);
			$Card->setCurtStage($station[0]);
			$Card->setLastUpdatedBy($name);
			$Card->setCurrquantity($hqty[$x]);
			$Card->updateStatus();

			$LogBatch = new LogBatch();
			$LogBatch->setAccount($account);
			$LogBatch->setBatchno($hserialno[$x]);
			// $LogBatch->setSequence(0);
			// $LogBatch->setMachine('');
			$LogBatch->setCurtstage($station[0]);
			$LogBatch->setStatus($hstatus[$x]);
			$LogBatch->setLastUpdatedBy($name);
			$LogBatch->setCurrquantity($hqty[$x]);
			$LogBatch->setDisquantity(0);
			$LogBatch->addLogbatch();

	}

	echo 'success_'.$lotno[0];

?>