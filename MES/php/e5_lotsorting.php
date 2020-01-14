<?php
include_once("../classes/lotnumber.php");
include_once("../classes/modelroute.php");
include_once("../classes/logbatch.php");
include_once("../classes/batch.php");
include_once("../classes/loglot.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	
	$lotno = explode(" ",$_GET['lotno']);
	$model = explode(" ",$_GET['model']);
	$qty	= $_GET["qty"];
	$station = explode(" ",$_GET['station']);
	$status = $_GET['status'];

	
	$ModelRoute = new ModelRoute();
	$ModelRoute->setAccount($account);
	$ModelRoute->setStation($station[0]);
	$ModelRoute->setModelNo($model[0]);
	$ModelRoute->getStationDetails2();
	$getpreviousstage = ModelRoute::getpreviousstage1($account,$model[0],$ModelRoute->getFlowsequence());
	$exist = LotNumber::lotcheckExist($account,$lotno[0]);
			
			if($exist == 'true'){
				if($status == 'REJECT'){


$lotreject = Batch::getLotSerialReject($account,$lotno[0]);

if ($lotreject == true){

$lot = new lotnumber($account,$lotno[0]);
$lot->setAccount($account);
$lot->setlotno($lotno[0]);
$lot->setStage($station[0]);
$lot->setstatus('REJECT');
$lot->setQuantity($qty);
$lot->setlastupdatedby($name);
$lot->updateLotSorting();


	$loglot = new Loglot();
	$loglot->setAccount($account);
	$loglot->setLotno($lotno[0]);
	$loglot->setModelno($model[0]);
	$loglot->setStation($station[0]);
	$loglot->setStatus('LotSort (REJECT)');
	$loglot->setSamplingsize($qty);
	$loglot->setLastUpdatedBy($name);
	$loglot->addLotLogpass();

}else{


$lot = new lotnumber($account,$lotno[0]);
$lot->setAccount($account);
$lot->setlotno($lotno[0]);
$lot->setstage($getpreviousstage);
$lot->setstatus('completed');
$lot->setQuantity($qty);
$lot->setlastupdatedby($name);
$lot->updateLotSorting();

			$Batch = new Batch();
			$Batch->setAccount($account);
			/*$Card->setCardNo($serialno[0]);*/
			$Batch->setLotNo($lotno[0]);
			$Batch->setCurtStage($getpreviousstage);
			$Batch->setLastUpdatedBy($name);
			$Batch->updateLotSort1();

			$loglot = new Loglot();
	$loglot->setAccount($account);
	$loglot->setLotno($lotno[0]);
	$loglot->setModelno($model[0]);
	$loglot->setStation($station[0]);
	$loglot->setStatus('LotSort (GOOD)');
	$loglot->setSamplingsize($qty);
	$loglot->setLastUpdatedBy($name);
	$loglot->addLotLogpass();
}
echo 'success_'.$lotno[0]."_".$model[0]."_".$qty."_".$station[0]."_".$ModelRoute->getFlowsequence()."_".$getpreviousstage;
}else{
	echo 'lotreject_';
}
}else{					
	echo 'lotnotexist_'.$lotno[0];
			}
?>