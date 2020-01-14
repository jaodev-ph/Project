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
	$station1  = explode(":",$_GET['station']);
	$model = $_GET['model'];
	$count = $_GET['count'];
	$qty = $_GET['qty'];
	$type = '';
	$count1 = 0;

	$Serial = new Card($account,$serialno[0]);
	$exist = Card::checkExist($account,$serialno[0]);
	$ModelRoute = new ModelRoute();
	$ModelRoute->setAccount($account);
	$ModelRoute->setStation($Serial->getCurtStage());
	$ModelRoute->getStationDetails();
	$curr = $ModelRoute->getFlowsequence();



			if($exist == 'false'){
				echo 'notexist_'.$_GET['serialno'];
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

$count1 = (int)$count + 1;

			$ModelRoute->setAccount($account);
			$ModelRoute->setStation($Serial->getCurtStage());
			$ModelRoute->setModelNo($model);
			$ModelRoute->getStationDetails2();
			$nextstation = explode(":",$ModelRoute->getnextstage($account,$model,$ModelRoute->getFlowsequence()));
			if($nextstation[0] == $station1[0]){

				echo 'true_'.$_GET['serialno']."_".$Serial->getStatus()."_".$count1."_".$nextstation[0];
			}else{

			if((ModelRoute::isvalidnextstage($account,$Serial->getPartNo(), $curr, 10)=='true')){


			echo 'true_'.$_GET['serialno']."_".$Serial->getStatus()."_".$count1."_".$nextstation[0];

			}else{

			echo 'offroute'."_".$serialno[0];

			}


				
			}

			
			}else{
				echo 'wrongmodel_'.$_GET['serialno'];
			}
				}
			}	

?>