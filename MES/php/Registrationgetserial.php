<?php
include_once("../classes/card.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/modelRoute.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$model = $_GET['model'];
	$type = '';
	$station1 = explode(":",$_GET['station']);
	$Serial = new Card($account,$serialno[0]);
	$line = $_GET['line'];

	$ModelRoute1 = new ModelRoute();
	$ModelRoute1->setAccount($account);
	$ModelRoute1->setModelNo($model);
	$ModelRoute1->getFirstStation();
	
if ($ModelRoute1->getStation() == $station1[0] ){

	$proceed = false;

	$SerialFormat = SerialFormat::SelectSerialFormat(trim($account),$model);
	
	$sub_serial = substr($serialno[0],intval($SerialFormat[0]->getStart()),intval($SerialFormat[0]->getLast()));
	
	if($SerialFormat[0]->getAllowFormat() == 0){
		$proceed =true;
	
	}else{
		if($SerialFormat[0]->getValue() == $sub_serial)
		{
		$proceed = true;
		}else{
		$proceed = false;
		}
	}

	if(strlen($serialno[0]) == $SerialFormat[0]->getSerialLength()){

		if($proceed  == true)
		{
			$exist = Card::checkExist($account,$serialno[0]);

			if($exist == 'true'){
				echo 'error4_'.$_GET['serialno'];
			}else{

			$Station2 = new Station();
			$Station2->StationDetails($account,$station1[0]);
			$desc = $Station2->getDescription();

			echo 'success_'.$_GET['serialno']."_".$model."_"."N"."_".$ModelRoute1->getnextstage($account,$model,$ModelRoute1->getFlowsequence())."_"."REG"."_".$name;
			}	
		}else{
			echo 'error2_'.$_GET['serialno'];
		}
	}else{
		echo 'error3_'.$_GET['serialno'];
	}
	
		
	}
	else
	{

	$exist = Card::checkExist($account,$serialno[0]);

			if($exist == 'false'){
				echo 'error1_'.$_GET['station'];
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
			$ModelRoute->getStationDetails();
		
			echo 'success_'.$_GET['serialno']."_".$Serial->getPartNo()."_".$type."_".$ModelRoute->getnextstage($account,$Serial->getPartNo(),$ModelRoute->getFlowsequence())."_".$Serial->getStatus()."_".$Serial-> getLastUpdatedBy();
			}else{
				echo 'wrongmodel_'.$_GET['serialno'];
			}
			}
			}	
}
			
		
	

			


?>