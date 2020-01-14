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
	// $model = $_GET['model'];
	$type = '';
	
	$Serial = new Card($account,$serialno[0]);
	$exist = Card::checkExist($account,$serialno[0]);

			if($exist == 'false'){
				echo 'error1_'.$_GET['serialno'];
			}else{

			

			$Serial = new Card($account,$serialno[0]); 
			$Station = new Station();
		

			$Station->StationDetails($account,$Serial->getCurtStage());
			$description = $Station->getDescription();

			if($Serial->getLotType() == 'N'){
				$type ='N: Normal';
			}else if($Serial->getLotType() == 'D'){
				$type ='D: Debug';
			}else if($Serial->getLotType() == 'R'){
				$type ='R: Return';
			}else if($Serial->getLotType() == 'S'){
				$type ='S: Special';
			}
			// $ModelRoute->setAccount($account);
			// $ModelRoute->setStation($Serial->getCurtStage());
			// $ModelRoute->setModelNo($Serial->getPartNo());
			// $ModelRoute->getStationDetails2();
		
	

			echo 'success_'.$_GET['serialno']."_".$Serial->getPartNo()."_".$type."_".$Serial->getCurtStage()." : ".$description."_".$Serial->getStatus()."_".$Serial-> getLastUpdatedBy();
			
			
			}	
		
	

			


?>