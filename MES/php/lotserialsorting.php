<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/card.php");
include_once("../classes/logpass.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$lotno = explode(" ",$_GET['lotnumber']);
	$model = $_GET['model'];
	$station = explode(" ",$_GET['station']);

	$exist = Card::checkExist($account,$serialno[0]);
	
	if($exist == 'true'){

		$Serial = new Card($account,$serialno[0]);

		$ModelRoute = new ModelRoute();
		$ModelRoute->setAccount($account);
		$ModelRoute->setStation($Serial->getCurtStage());
		$ModelRoute->getStationDetails();
		$NextStation = explode(":",$ModelRoute->getnextstage($account,$Serial->getPartNo(),$ModelRoute->getFlowsequence()));
		
		if($Serial->getstatus() == 'GOOD'){

			if($Serial->getPartNo() == $model){

			if($Serial->getLotNo() == ''){

				if($NextStation[0] == $station[0]){

					echo 'true_'.$serialno[0]."_".$Serial->getstatus();

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


	}else{
		echo 'notexist_'.$serialno[0];
	}


?>