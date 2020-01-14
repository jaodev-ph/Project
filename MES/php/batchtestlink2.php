<?php
//include_once("../classes/card.php");
/*include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/modelRoute.php");*/
include_once("../classes/logbatch.php");
include_once("../classes/batch.php");
include_once("../classes/linking.php");
session_start();


$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$did = explode(" ",$_GET['did']);
$serialno = explode(" ",$_GET['serialno']);
$model = $_GET['model'];
$line = $_GET['line'];
$type = 'N';
$station = $_GET['station'];
$pwbqty = $_GET['pwbqty'];
$quantity = 200;
	

$diff = $pwbqty - $quantity;


$exist = Batch::checkExist($account,$serialno[0]);

if($exist == 'true'){
	echo 'error1_'.$serialno[0];
		return;
 }
				$Batch = new Batch();
				$Batch->setAccount($account);
				$Batch->setCardNo($serialno[0]);
				$Batch->setBatchno($serialno[0]);
			
				$Batch->setWorkorder('');
				$Batch->setPartNo($model);
				$Batch->setRevision('');
				$Batch->setLineCode($line);
				$Batch->setRefno('');
				$Batch->setHoldFlag(0);
				$Batch->setPackFlag(0);
				$Batch->setShipFlag(0);
				$Batch->setRTVFlag(0);
				$Batch->setRejectFlag(0);
				$Batch->setStatus('GOOD');
				$Batch->setLotno('');
				$Batch->setLotType('');
				$Batch->setCurtStage($station);
				$Batch->setLotType($type);
				$Batch->setLastUpdatedBy($name);
				$Batch->setParentbatchno('');
				$Batch->setChildbatchno('');
				$Batch->setOrigquantity($quantity);
				$Batch->setCurrquantity($quantity);
				$Batch->addBatch();

				$LogBatch = new LogBatch();
				$LogBatch->setAccount($account);
				$LogBatch->setLine($line);
				$LogBatch->setBatchno($serialno[0]);
			
				$LogBatch->setCurtstage($station);
				$LogBatch->setStatus('GOOD');
				$LogBatch->setLastUpdatedBy($name);
				$LogBatch->setCurrquantity($quantity);
				$LogBatch->setDisquantity(0);
				$LogBatch->addLogbatch();

				$link = new Link2();
				$link->setAccount($account);
				$link->setSerialNo($did[0]);
				$link->setSerialNoLink($serialno[0]);
				$link->setPartNo($model);
				$link->setPartNoLink($model);
				$link->setQty($quantity);
				$link->setStation($station);
				$link->setDescription('SPA');
				$link->setLastUpdatedBy($name);
				$link->addLogLink();

				echo 'success_'.$model."_".$line."_"."GOOD"."_".$name."_".$diff;
		










			?>