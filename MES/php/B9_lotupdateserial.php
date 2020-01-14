<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/card.php");
include_once("../classes/batch.php");
include_once("../classes/logpass.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$station = explode(":",$_GET['station']);
	$reference = explode(":",$_GET['refno']);
	$model = $_GET['model'];
	$type = '';

	$lotcardexist = Card::refcheckExist($account,$reference[0]);
	$lotbatchexist = Batch::refcheckExist($account,$reference[0]);

if ($lotcardexist == 'true'){

	$cardexist = Card::checkExist($account,$serialno[0]);

	if($cardexist == 'true'){

		$Serial = new Card();
		$Serial->getCarddetails($account,$serialno[0]);
		$ModelRoute = new ModelRoute();
		$ModelRoute->setAccount($account);
		$ModelRoute->setStation($Serial->getCurtStage());
		$ModelRoute->setModelNo($Serial->getPartNo());
		$ModelRoute->getStationDetails2();
		$NextStation = explode(":",$ModelRoute->getnextstage1($account,$Serial->getPartNo(),$ModelRoute->getFlowsequence()));

		/*$getstation = ModelRoute::getLotStation();
		$getstation->setAccount($account);
		$getstation->setModelNo($Serial->getPartNo());*/

	if (empty($Serial->getLotType()))
	{
		if($Serial->getstatus() == 'GOOD')
		{
			if($Serial->getPartNo() == $model)
			{
				if($NextStation[0] == $station[0]){

					echo 'true_'.$ModelRoute->getnextstage1($account,$Serial->getPartNo(),$ModelRoute->getFlowsequence()).'_'.$serialno[0].'_'.$Serial->getPartNo().'_'.$type."_".$Serial->getStatus()."_".$Serial->getLastUpdatedBy();
				}else{
					echo 'offroute_'.$serialno[0];
				}

			}else{
				echo 'wrongmodel_'.$serialno[0];
			}

		}else{
			echo 'serialreject_'.$serialno[0];
		}
}else{
	echo 'alreadyinlot_'.$serialno[0];
	}

	}else{
		echo 'notexist_'.$serialno[0];
	}

}else if ($lotbatchexist == 'true'){

	$batchexist = Batch::checkExist($account,$serialno[0]);

	if($batchexist == 'true'){

		$Batch = new Batch();
		$Batch->getBatchdetails($account,$serialno[0]);
		$ModelRoute = new ModelRoute();
		$ModelRoute->setAccount($account);
		$ModelRoute->setStation($Batch->getCurtStage());
		$ModelRoute->setModelNo($Batch->getPartNo());
		$ModelRoute->getStationDetails2();
		$NextStation = explode(":",$ModelRoute->getnextstage1($account,$Batch->getPartNo(),$ModelRoute->getFlowsequence()));

		/*$getstation = ModelRoute::getLotStation();
		$getstation->setAccount($account);
		$getstation->setModelNo($Serial->getPartNo());*/

	if (empty($Batch->getRefno()))
	{
		if($Batch->getstatus() == 'GOOD')
		{
			if($Batch->getPartNo() == $model)
			{
				if($NextStation[0] == $station[0]){

					echo 'true_'.$ModelRoute->getnextstage1($account,$Batch->getPartNo(),$ModelRoute->getFlowsequence()).'_'.$serialno[0].'_'.$Batch->getPartNo().'_'.$type."_".$Batch->getStatus()."_".$Batch->getLastUpdatedBy();
				}else{
					echo 'offroute_'.$serialno[0];
				}

			}else{
				echo 'wrongmodel_'.$serialno[0];
			}

		}else{
			echo 'serialreject_'.$serialno[0];
		}
}else{
	echo 'alreadyinlot_'.$serialno[0];
	}

	}else{
		echo 'notexist_'.$serialno[0];
	}

}


?>