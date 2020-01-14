<?php
include_once("../classes/batch.php");
include_once("../classes/logbatch.php");
include_once("../classes/card.php");
include_once("../classes/logpass.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$reference = explode(" ",$_GET['reference']);
	$model = $_GET['modelno'];
	$lotno = explode(" ",$_GET['lotno']);

	$station = explode(":",$_GET['station']);

	$batchexist = Batch::checkExist($account,$serialno[0]);
	$cardexist = Card::checkExist($account,$serialno[0]);

if ($batchexist == 'true'){

	$Serial = new Batch($account,$serialno[0]);

			$Card = new Batch();
			$Card->setAccount($account);
			$Card->setCardNo($serialno[0]);
			$Card->setLotNo($lotno[0]);
			$Card->setRefno($reference[0]);
			$Card->setCurtStage($station[0]);
			$Card->setLastUpdatedBy($name);
			$Card->updateLotSortref();

			$LogBatch = new LogBatch();
			$LogBatch->setAccount($account);
			$LogBatch->setBatchno($serialno[0]);
			
			$LogBatch->setCurtstage($station[0]);
			$LogBatch->setStatus('GOOD');
			$LogBatch->setLastUpdatedBy($name);
			$LogBatch->setCurrquantity($Serial->getCurrquantity());
			$LogBatch->setRemarks('LotSort (Added)');
			$LogBatch->setDisquantity(0);
			$LogBatch->addLogbatch();

	$countlot = Batch::getCountBatchByLot($account,$reference[0])+$Serial->getCurrquantity();

			echo 'success_'.$serialno[0]."_".$Serial->getPartNo()."_".$Serial->getStatus()."_".$countlot;
}else if ($cardexist == 'true'){

			$Serial1 = new Card($account,$serialno[0]);	
	
			$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($serialno[0]);
			$Card->setLotNo($lotno[0]);
			$Card->setLotType($reference[0]);
			$Card->setCurtStage($station[0]);
			$Card->setLastUpdatedBy($name);
			$Card->updateLotSortref();

			$Logpass = new LogPass();
			$Logpass->setAccount($account);
			$Logpass->setCardNo($serialno[0]);
			$Logpass->setLine('');
			$Logpass->setSequence('');
			$Logpass->setStation($station[0]);
			$Logpass->setmachine('LotSort (Added)');
			$Logpass->setStatus('GOOD');
			$Logpass->setLastUpdatedBy($name);
			/*$Logpass->setRemarks('LotSort (Removed)');*/
		
			$Logpass->addLogpass();
				
				$rejectcount1 = Card::rejectCountRef($account,$reference[0]);
				$countlot1 = Card::getCountSerialByRef($account,$reference[0]);
		
			echo 'success_'.$serialno[0]."_".$Serial1->getPartNo()."_".$Serial1->getStatus()."_".$countlot1;
		}




?>