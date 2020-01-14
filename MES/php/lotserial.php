<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/card.php");
include_once("../classes/logpass.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$station = explode(":",$_GET['station']);
	$model = $_GET['model'];

	$exist = Card::checkExist($account,$serialno[0]);
	
	if($exist == 'true'){

		$Serial = new Card($account,$serialno[0]);
		$ModelRoute = new ModelRoute();
		$ModelRoute->setAccount($account);
		$ModelRoute->setStation($Serial->getCurtStage());
		/*$ModelRoute->setModelNo($Serial->getPartNo());*/
		$ModelRoute->getStationDetails();
		
		$NextStation = explode(":",$ModelRoute->getnextstage1($account,$Serial->getPartNo(),$ModelRoute->getFlowsequence()));

		if($Serial->getLotType() == 'N'){
          $type ='N: Normal';
        }else if($Serial->getLotType() == 'D'){
          $type ='D: Debug';
        }else if($Serial->getLotType() == 'R'){
          $type ='R: Return';
        }else if($Serial->getLotType() == 'S'){
          $type ='S: Special';
        }
		
		if($Serial->getstatus() == 'GOOD'){

			if($Serial->getPartNo() == $model)
			{
				if($NextStation[0] == $station[0]){

					echo 'true_'.$ModelRoute->getnextstage1($account,$Serial->getPartNo(),$ModelRoute->getFlowsequence()).'_'.$Serial->getPartNo()."_".$Serial->getStatus()."_".$Serial->getLastUpdatedBy();
				}else{
					echo 'offroute_'.$serialno[0].'_'.$NextStation[0].'_'.$station[0].'_'.$Serial->getPartNo().'_'.'_'.$ModelRoute->getStation();
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