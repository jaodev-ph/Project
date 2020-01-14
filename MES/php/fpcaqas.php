<?php
include_once("../classes/card.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/lotnumber.php");
include_once("../classes/modelroute.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];

	$lotno = $_GET['lotno'];
	$model =  $_GET['model'];
	$station = explode(":",$_GET['station']);
	$RQuantity = $_GET['RQuantity'];

	$proceed = false;
	
	$exist = LotNumber::lotcheckExist($account,$lotno);
			
			if($exist == 'true'){
				$lotnumber = new LotNumber($account,$lotno);
				$ModelRoute = new ModelRoute();
				$ModelRoute->setAccount($account);
				$ModelRoute->setStation($lotnumber->getStage());
				$ModelRoute->getStationDetails();

				$nextstation = explode(":",$ModelRoute->getnextstage($account,$lotnumber->getPartno(),$ModelRoute->getFlowsequence()));
				
				/*if($lotnumber->getStatus() == 'completed'){*/
					if($nextstation[0] == $station[0]){

						if($model == $lotnumber->getPartno()){
						echo $lotnumber->getQuantity().'_true_'.$_GET['lotno'];
						}else{
						echo 'wrongmodel_'.$lotno;
						}
					}else{
						echo 'offroute_'.$lotno;
					}
			/*	}else{
					echo 'lotreject_'.$lotno;
				}*/
			}else{				
				
				echo 'lotnotexist_'.$lotno;
			}

	
			


?>