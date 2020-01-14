<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/batch.php");
include_once("../classes/logbatch.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$station = explode(":",$_GET['station']);
	$model = $_GET['model'];

	$exist = Batch::checkExist($account,$serialno[0]);
	
	if($exist == 'true'){

		$Serial = new Batch();
		$Serial->getBatchdetails($account,$serialno[0]);

		$ModelRoute = new ModelRoute();
		$ModelRoute->setAccount($account);
		$ModelRoute->setStation($Serial->getCurtStage());
		$ModelRoute->setModelNo($model);
		$ModelRoute->getStationDetails2();
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

					echo 'true_'.$ModelRoute->getnextstage1($account,$Serial->getPartNo(),$ModelRoute->getFlowsequence()).'_'.$Serial->getPartNo().'_'.$type."_".$Serial->getStatus()."_".$Serial->getLastUpdatedBy()."_".$Serial->getCurrquantity();
				}else{
					echo 'offroute_'.$serialno[0]."_".$ModelRoute->getFlowsequence()."_".$NextStation[0]."_".$station[0];
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