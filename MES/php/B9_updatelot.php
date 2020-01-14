<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/card.php");
include_once("../classes/batch.php");
include_once("../classes/logpass.php");
include_once("../classes/logbatch.php");
include_once("../classes/lotnumber.php");
include_once("../classes/loglot.php");

session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$reference = explode(" ",$_GET['reference']);
	$lotno = explode(" ",$_GET['lotno']);
	$station = explode(":",$_GET['station']);
	$model = explode(" ",$_GET['model']);
	$qty = trim($_GET['qty']);

	$htxtSerial = json_decode($_GET['htxtSerial']);
	$htxtstatus = json_decode($_GET['htxtstatus']);
	$htxtpartno = json_decode($_GET['htxtpartno']);

	$exist = Lotnumber::referencelotcheckExist1($account,$reference[0]);

	$lotcardexist = Card::refcheckExist($account,$reference[0]);
	$lotbatchexist = Batch::refcheckExist($account,$reference[0]);

if ($exist == 'true'){

	if ($lotcardexist == 'true'){

			for($i=0;$i<count($htxtSerial);$i++){

			$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($htxtSerial[$i]);
			$Card->setStatus('GOOD');
			$Card->setCurtStage($station[0]);
			$Card->setLastUpdatedBy($name);
			$Card->updateStatus();
			$Card->setLotno($lotno[0]);
			$Card->setLotType($reference[0]);
			$Card->updatetheLotnoRef();

			$Logpass = new LogPass();
			$Logpass->setAccount($account);
			$Logpass->setLine('');
			$Logpass->setCardNo($htxtSerial[$i]);
			$Logpass->setSequence(0);
			$Logpass->setMachine('');
			$Logpass->setStation($station[0]);
			$Logpass->setStatus('GOOD');
			$Logpass->setLastUpdatedBy($name);
			$Logpass->addLogpass();
}

	$lotnumber = new LotNumber();
	
	$lotnumber->setAccount($account);
	$lotnumber->setReference($reference[0]);
	$lotnumber->setPartno($model[0]);	
	$lotnumber->setStatus('GOOD');
	$lotnumber->setLastUpdatedBy($name);
	$lotnumber->setQuantity($qty);
	$lotnumber->updateLotRefStatus();

		$loglot = new Loglot();
	$loglot->setAccount($account);
	$loglot->setLotno($reference[0]);
	$loglot->setModelno($model[0]);
	$loglot->setStation($station[0]);
	$loglot->setStatus('updatelot');
	$loglot->setSamplingsize($qty);
	$loglot->setLastUpdatedBy($name);
	$loglot->addLotLogpass();

	}else if ($lotbatchexist == 'true'){

		

for($a=0;$a<count($htxtSerial);$a++){


		$batchqty = Batch::getBatchQty($account,$htxtSerial[$a]);
		
			$Batch = new Batch();
			$Batch->setAccount($account);
			$Batch->setCardNo($htxtSerial[$a]);
			$Batch->setStatus('GOOD');
			$Batch->setRefno($reference[0]);
			$Batch->setCurtStage($station[0]);
			$Batch->setLastUpdatedBy($name);	
			$Batch->setLotno($lotno[0]);
			$Batch->updateLotSortref();

			$LogBatch = new LogBatch();
			$LogBatch->setAccount($account);
			$LogBatch->setLine('');
			$LogBatch->setBatchno($htxtSerial[$a]);
			$LogBatch->setCurtstage($station[0]);
			$LogBatch->setStatus('GOOD');
			$LogBatch->setLastUpdatedBy($name);
			$LogBatch->setCurrquantity($batchqty);
			$LogBatch->setDisquantity(0);
			$LogBatch->setRemarks('');
			$LogBatch->addLogbatch();

			
}


$refqty = Batch::getRefBatchQty($account,$reference[0]);

	$lotnumber = new LotNumber();
	$lotnumber->setAccount($account);
	$lotnumber->setReference($reference[0]);
	$lotnumber->setPartno($model[0]);	
	$lotnumber->setStatus('GOOD');
	$lotnumber->setLastUpdatedBy($name);
	$lotnumber->setQuantity($refqty);
	$lotnumber->updateLotRefStatus();

	}else{
		echo 'notexist_';
	}

}else{
	echo 'notexist_';
}






?>