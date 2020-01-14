<?php
include_once("../classes/card.php");
include_once("../classes/serialformat.php");
include_once("../classes/batch.php");
include_once("../classes/mother.php");
include_once("../classes/station.php");
include_once("../classes/modelRoute.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);

	$motherexist = Mother::checkExist($account,$serialno[0]);
	$cardexist = Card::checkExist($account,$serialno[0]);
	$batchexist = Batch::checkExist($account,$serialno[0]);

if ($cardexist == 'true'){

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
		

			echo 'success_'.$_GET['serialno']."_".$Serial->getPartNo()."_".$ModelRoute->getCurrentStation($account,$Serial->getPartNo(),$Serial->getCurtStage())."_".$Serial->getStatus()."_".$Serial-> getLastUpdatedBy()."_".'0';
		
		

}else if($batchexist == 'true'){

	$Batch = new Batch($account,$serialno[0]);

			$Station = new Station();
			$ModelRoute = new ModelRoute();

			$Station->StationDetails($account,$Batch->getCurtStage());
			$discription = $Station->getDescription();

			if($Batch->getLotType() == 'N'){
				$type ='N: Normal';
			}else if($Batch->getLotType() == 'D'){
				$type ='D: Debug';
			}else if($Batch->getLotType() == 'R'){
				$type ='R: Return';
			}else if($Batch->getLotType() == 'S'){
				$type ='S: Special';
			}
			$ModelRoute->setAccount($account);
			$ModelRoute->setStation($Batch->getCurtStage());
			$ModelRoute->setModelNo($Batch->getPartNo());
			$ModelRoute->getStationDetails2();
		

			echo 'success_'.$_GET['serialno']."_".$Batch->getPartNo()."_".$ModelRoute->getCurrentStation($account,$Batch->getPartNo(),$Batch->getCurtStage())."_".$Batch->getStatus()."_".$Batch-> getLastUpdatedBy()."_".$Batch->getCurrquantity();
			


}else if ($motherexist == 'true'){

		$Mother = new Mother($account,$serialno[0]);

			$Station = new Station();
			$ModelRoute = new ModelRoute();

			$Station->StationDetails($account,$Mother->getCurtStation());
			$discription = $Station->getDescription();

			if($Mother->getLotType() == 'N'){
				$type ='N: Normal';
			}else if($Mother->getLotType() == 'D'){
				$type ='D: Debug';
			}else if($Mother->getLotType() == 'R'){
				$type ='R: Return';
			}else if($Mother->getLotType() == 'S'){
				$type ='S: Special';
			}
			$ModelRoute->setAccount($account);
			$ModelRoute->setStation($Mother->getCurtStation());
			$ModelRoute->setModelNo($Mother->getPartNo());
			$ModelRoute->getStationDetails2();

			echo 'success_'.$_GET['serialno']."_".$Mother->getPartNo()."_".$ModelRoute->getCurrentStation($account,$Serial->getPartNo(),$Mother->getCurtStation())."_".$Mother->getStatus()."_".$Mother-> getLastUpdatedBy()."_".$Mother-> getCurrquanitity();
		

}else{
	echo 'error1_'.$_GET['serialno'];
}

	

			


?>