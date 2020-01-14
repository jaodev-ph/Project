<?php
include_once("../classes/batch.php");
include_once("../classes/logbatch.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$lotno = explode(" ",$_GET['lotno']);
	$model = $_GET['modelno'];
	$Serial = new Batch($account,$serialno[0]);
	$station = $_GET['station'];

	$Serial = new Batch($account,$serialno[0]);

	$countlot = Batch::getCountBatchByLot($account,$lotno[0])+$Serial->getCurrquantity();

/*  if($Serial->getLotNo() == ''){
    	echo 'wronglot_';
    }else{*/

			$Card = new Batch();
			$Card->setAccount($account);
			$Card->setCardNo($serialno[0]);
			$Card->setLotNo($lotno[0]);
			$Card->setCurtStage($station);
			$Card->setLastUpdatedBy($name);
			$Card->updateLotSort();

			$LogBatch = new LogBatch();
			$LogBatch->setAccount($account);
			$LogBatch->setBatchno($serialno[0]);
			// $LogBatch->setSequence(0);
			// $LogBatch->setMachine('');
			$LogBatch->setCurtstage($station);
			$LogBatch->setStatus('GOOD');
			$LogBatch->setLastUpdatedBy($name);
			$LogBatch->setCurrquantity($Serial->getCurrquantity());
			$LogBatch->setRemarks('LotSort (Added)');
			$LogBatch->setDisquantity(0);
			$LogBatch->addLogbatch();


			echo 'success_'.$serialno[0]."_".$Serial->getPartNo()."_".$Serial->getStatus()."_".$Serial->getCurrquantity()."_".$countlot;
/*}
*/



?>