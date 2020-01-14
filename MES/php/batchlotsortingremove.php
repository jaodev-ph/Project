<?php
include_once("../classes/batch.php");
include_once("../classes/logbatch.php");
include_once("../classes/lotnumber.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$lotno = explode(" ",$_GET['lotno']);
	$model = $_GET['modelno'];
	$station = $_GET['station'];

	$Serial = new Batch($account,$serialno[0]);

	$countlot = Batch::getCountBatchByLot($account,$lotno[0]) - $Serial->getCurrquantity();
    $rejectcount = Batch::rejectCount1($account,$lotno[0]) - $Serial->getCurrquantity();

    if($Serial->getLotNo() == ''){
    	echo 'wronglot_';
    }else{

			
			$Card = new Batch();
			$Card->setAccount($account);
			$Card->setCardNo($serialno[0]);
			$Card->setLotNo('');
			$Card->setCurtStage($station);
			$Card->setLastUpdatedBy($name);
			$Card->updateLotSort();

			$LogBatch = new LogBatch();
			$LogBatch->setAccount($account);
			$LogBatch->setBatchno($serialno[0]);
			// $LogBatch->setSequence(0);
			// $LogBatch->setMachine('');
			$LogBatch->setCurtstage($station);
			$LogBatch->setStatus('REJECT');
			$LogBatch->setLastUpdatedBy($name);
			$LogBatch->setCurrquantity($Serial->getCurrquantity());
			$LogBatch->setRemarks('LotSort (Removed)');
			$LogBatch->setDisquantity(0);
			$LogBatch->addLogbatch();

			echo 'success_'.$serialno[0]."_".$Serial->getPartNo()."_".$Serial->getStatus()."_".$countlot."_".$rejectcount."_".$Serial->getLotNo();
}




?>