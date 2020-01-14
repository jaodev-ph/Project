<?php
include_once("../classes/batch.php");
include_once("../classes/logbatch.php");
include_once("../classes/card.php");
include_once("../classes/logpass.php");
include_once("../classes/lotnumber.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$reference	 = explode(" ",$_GET['reference']);
	$model = $_GET['modelno'];
	$station = explode(": ",$_GET['station']);


	$batchexist = Batch::checkExist($account,$serialno[0]);
	$cardexist = Card::checkExist($account,$serialno[0]);

		if ($batchexist == 'true'){
			$Serial = new Batch($account,$serialno[0]);



			$Batch = new Batch();
			$Batch->setAccount($account);
			$Batch->setCardNo($serialno[0]);
			$Batch->setLotNo('');
			$Batch->setRefno('');
			$Batch->setCurtStage($station[0]);
			$Batch->setLastUpdatedBy($name);
			$Batch->updateLotSortref();

			$LogBatch = new LogBatch();
			$LogBatch->setAccount($account);
			$LogBatch->setBatchno($serialno[0]);
		
			$LogBatch->setCurtstage($station[0]);
			$LogBatch->setStatus('REJECT');
			$LogBatch->setLastUpdatedBy($name);
			$LogBatch->setCurrquantity($Serial->getCurrquantity());
			$LogBatch->setRemarks('LotSort (Removed)');
			$LogBatch->setDisquantity(0);
			$LogBatch->addLogbatch();

	$countlot = Batch::getCountBatchByLot($account,$reference[0]) - $Serial->getCurrquantity();
    $rejectcount = Batch::rejectCountref($account,$reference[0]) - $Serial->getCurrquantity();

			echo 'success_'.$serialno[0]."_".$Serial->getPartNo()."_".$Serial->getStatus()."_".$countlot."_".$rejectcount."_".$Serial->getLotNo();

		}else if ($cardexist == 'true'){

			$Serial1 = new Card($account,$serialno[0]);	

		
			
			$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($serialno[0]);
			$Card->setLotNo('');
			$Card->setLotType('');
			$Card->setCurtStage($station[0]);
			$Card->setLastUpdatedBy($name);
			$Card->updateLotSortref();

			$Logpass = new LogPass();
			$Logpass->setAccount($account);
			$Logpass->setCardNo($serialno[0]);
			$Logpass->setLine('');
			$Logpass->setSequence('');
			$Logpass->setStation($station[0]);
			$Logpass->setmachine('LotSort (Removed)');
			$Logpass->setStatus('REJECT');
			$Logpass->setLastUpdatedBy($name);
			/*$Logpass->setRemarks('LotSort (Removed)');*/
		
			$Logpass->addLogpass();

			$rejectcount1 = Card::rejectCountRef($account,$reference[0]);
			$countlot1 = Card::getCountSerialByRef($account,$reference[0]);

			echo 'success_'.$serialno[0]."_".$Serial1->getPartNo()."_".$Serial1->getStatus()."_".$countlot1."_".$rejectcount1."_".$Serial1->getLotNo();
		}





?>