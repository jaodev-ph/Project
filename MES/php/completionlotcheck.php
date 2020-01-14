<?php
include_once("../classes/card.php");
include_once("../classes/serialformat.php");
include_once("../classes/station.php");
include_once("../classes/lotnumber.php");
include_once("../classes/modelroute.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$model = $_GET['model'];
	$lotno = $_GET['lotno'];

			$exist = LotNumber::lotcheckExist($account,$lotno);
			$lotqty = Card::getCountSerialByLot($account,$lotno);
		
			if($exist == 'true'){
 				$Lotnumber = new LotNumber($account,$lotno);
 				$ModelRoute = new ModelRoute();
				$ModelRoute->setAccount($account);
				$ModelRoute->setStation($Lotnumber->getStage());
				$ModelRoute->getStationDetails();

          		$status = $Lotnumber->getStatus();
          		$model = $Lotnumber->getPartno();
          		$station = $Lotnumber->getStage();

          		$nextstation = explode(":",$ModelRoute->getnextstage($account,$model,$ModelRoute->getFlowsequence()));

          		if($nextstation[0] == '010'){

          		if($status == 'REJECT'){
          			echo 'error1';
 				}else{
          		echo 'true_'.$_GET['lotno']."_".$model."_".$lotqty."_".$status."_".$ModelRoute->getnextstage($account,$model,$ModelRoute->getFlowsequence())."_".$nextstation[0];
          		}
          	}else{
          		echo 'offroute_';
          	}
 			}
 			else
 			{
 				echo 'notexist';
 			}

 			

			
?>