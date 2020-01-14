<?php
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/logbatch.php");
include_once("../classes/station.php");
include_once("../classes/modelRoute.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$model = $_GET['model'];
	$type = '';
	// echo $serialno[0];
	$Serial = new Batch($account,$serialno[0]);
	$exist = Batch::checkExist($account,$serialno[0]);

			if($exist == 'false'){
				echo 'error1_'.$_GET['serialno'];
			}else{

			if($Serial->getStatus() == 'REJECT'){

				echo 'serialreject_'.$_GET['serialno'];
			}else{

				if($model == $Serial->getPartNo()){

			
			$Station = new Station();
			$ModelRoute = new ModelRoute();

			$Station->StationDetails($account,$Serial->getCurtStage());
			$discription = $Station->getDescription();

			if($Serial->getLotType() == 'N'){
				$type ='N: Normal';
			}else if($Serial->getLotType() == 'D'){
				$type ='D: Debug';
			}else if($Serial->getLotType() == 'R'){
				$type ='R: Return';
			}else if($Serial->getLotType() == 'S'){
				$type ='S: Special';
			}
			$ModelRoute->setAccount($account);
			$ModelRoute->setStation($Serial->getCurtStage());
			$ModelRoute->setModelNo($model);
			$ModelRoute->getStationDetails2();
		
			


			echo 'success_'.$_GET['serialno']."_".$Serial->getPartNo()."_".$type."_".$ModelRoute->getnextstage1($account,$Serial->getPartNo(),$ModelRoute->getFlowsequence())."_".$Serial->getStatus()."_".$Serial-> getLastUpdatedBy()."_".$Serial-> getCurrquantity();
			}else{
				echo 'wrongmodel_'.$_GET['serialno'];
			}
			}
			}	
		
	

			


?>