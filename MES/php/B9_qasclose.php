<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/model.php");
include_once("../classes/lotnumber.php");
include_once("../classes/loglot.php");
include_once("../classes/batch.php");
include_once("../classes/logbatch.php");
include_once("../classes/card.php");
include_once("../classes/logpass.php");
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


$batchexist = Batch::refcheckexist($account,$lotno[0]);
$cardexist = Card::refcheckexist($account,$lotno[0]);

$lotreject = Batch::getLotSerialReject($account,$lotno[0]);

if ($lotreject == true){

	$lotnumber = new Lotnumber();
	$lotnumber->setPartno($modelno);
	$lotnumber->setAccount($account);
	$lotnumber->setReference($lotno[0]);
	$lotnumber->setStatus('REJECT');
	$lotnumber->setSamplingSize($samplingCount);
	$lotnumber->setStage($station[0]);
	$lotnumber->setLastUpdatedBy($name);
	$lotnumber->updateRefQas();

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
	$lotnumber->setReference($lotno[0]);
	$lotnumber->setStatus('GOOD');
	$lotnumber->setSamplingSize($samplingCount);
	$lotnumber->setStage($station[0]);
	$lotnumber->setLastUpdatedBy($name);
	$lotnumber->updateRefQas();

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

		if ($batchexist == 'true'){

			$Batch = new Batch();
			$Batch->setAccount($account);
			$Batch->setCardNo($hserialno[$x]);
			$Batch->setStatus($hstatus[$x]);
			$Batch->setCurtStage($station[0]);
			$Batch->setLastUpdatedBy($name);
			$Batch->setCurrquantity($hqty[$x]);
			$Batch->updateStatus();

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
}else{

			$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($hserialno[$x]);
			$Card->setStatus($hstatus[$x]);
			$Card->setCurtStage($station[0]);
			$Card->setLastUpdatedBy($name);
			$Card->updateStatus();

			$Logpass = new LogPass();
			$Logpass->setAccount($account);
			$Logpass->setCardNo($hserialno[$x]);
			$Logpass->setLine('');
			$Logpass->setSequence('');
			$Logpass->setStation($station[0]);
			$Logpass->setMachine('');
			$Logpass->setStatus($hstatus[$x]);
			$Logpass->setLastUpdatedBy($name);
			$Logpass->addLogpass();

			}
	
	}

echo 'success_'.$lotno[0]."_".$batchexist."_".$cardexist;

?>