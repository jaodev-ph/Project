<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/batch.php");
include_once("../classes/logbatch.php");
include_once("../classes/card.php");
include_once("../classes/logpass.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$reference = explode(" ",$_GET['reference']);
	$model = $_GET['model'];
	/*$station = explode(" ",$_GET['station']);*/
	$batchexist = Batch::checkExist($account,$serialno[0]);
	$cardexist = Card::checkExist($account,$serialno[0]);

if ($serialno[0]==''){
echo 'notexist_';
}else{


	if($batchexist == 'true'){

		$Batch = new Batch($account,$serialno[0]);

		$ModelRoute = new ModelRoute();
		$ModelRoute->setAccount($account);
		$ModelRoute->setStation($Batch->getCurtStage());
		$ModelRoute->setModelNo($model);
		$ModelRoute->getStationDetails2();
		$NextStation = explode(":",$ModelRoute->getnextstage1($account,$Batch->getPartNo(),$ModelRoute->getFlowsequence()));

		$ModelRoute ->getLotStation();
		$getlotstation = $ModelRoute->getStation();
		
		if($Batch->getstatus() == 'GOOD'){

			if($Batch->getPartNo() == $model){

			if($Batch->getLotNo() == ''){

				if($NextStation[0] == $getlotstation){

					echo 'true_'.$serialno[0]."_".$Batch->getstatus();

				}else{
					echo 'offroute_'.$serialno[0];
				}	

			}else{
			echo 'alreadyinlot_'.$serialno[0];
		}
	}else{
				echo 'wrongmodel_'.$serialno[0];
			}
}else{
			echo 'serialreject_'.$serialno[0];
		}

	}else if ($cardexist == 'true'){

		$Serial = new Card($account,$serialno[0]);

		$ModelRoute = new ModelRoute();
		$ModelRoute->setAccount($account);
		$ModelRoute->setStation($Serial->getCurtStage());
		$ModelRoute->setModelNo($model);
		$ModelRoute->getStationDetails2();
		$NextStation = explode(":",$ModelRoute->getnextstage1($account,$Serial->getPartNo(),$ModelRoute->getFlowsequence()));

		$ModelRoute ->getLotStation();
		$getlotstation = $ModelRoute->getStation();
		
		if($Serial->getstatus() == 'GOOD'){

			if($Serial->getPartNo() == $model){

			if($Serial->getLotNo() == ''){

				if($NextStation[0] == $getlotstation){

					echo 'true_'.$serialno[0]."_".$Serial->getstatus()."_".$Serial->getCurtStage();

				}else{
					echo 'offroute_'.$serialno[0];
				}	

			}else{
			echo 'alreadyinlot_'.$serialno[0];
		}
	}else{
				echo 'wrongmodel_'.$serialno[0];
			}
}else{
			echo 'serialreject_'.$serialno[0];
		}
}
	}



?>