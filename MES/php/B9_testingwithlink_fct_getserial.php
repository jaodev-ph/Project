<?php
include_once("../classes/card.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/modelRoute.php");
include_once("../classes/linking.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$model = $_GET['model'];
	$fullstation = explode(": ",$_GET['station']);
	$station = $fullstation[0];
	$type = '';
	
	$Serial = new Card($account,$serialno[0]);
	$exist = Card::checkExist($account,$serialno[0]);

			if($exist == 'false'){
				echo 'error1_'.$_GET['serialno'];
			}else{

			if($Serial->getStatus() == 'REJECT'){

				echo 'serialreject_'.$_GET['serialno'];
			}else{
				if($model == $Serial->getPartNo()){

			$Serial = new Card($account,$serialno[0]); 
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
			$ModelRoute->setModelNo($Serial->getPartNo());
			$ModelRoute->getStationDetails2();
		
			$linkedMac = Link2::getLinkedMac($account,$serialno[0],$model,$station);
			$macstatus = 'notready';
			if(strlen($linkedMac)>0){
				$MacMatrix = Link2::getB9MacAddress($account,$model);
				if($linkedMac==$MacMatrix){
				$macstatus = 'ready';
			}
			}



			echo 'success_'.$_GET['serialno']."_".$Serial->getPartNo()."_".$type."_".$ModelRoute->getnextstage1($account,$Serial->getPartNo(),$ModelRoute->getFlowsequence())."_".$Serial->getStatus()."_".$Serial-> getLastUpdatedBy()."_".$macstatus."_".$linkedMac;
			}else{
				echo 'wrongmodel_'.$_GET['serialno'];
			}
			}
			}	
		
	

			


?>