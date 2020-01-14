<?php
include_once("../classes/batch.php");
include_once("../classes/card.php");
include_once("../classes/serialformat.php");
include_once("../classes/logbatch.php");
include_once("../classes/station.php");
include_once("../classes/lotnumber.php");
include_once("../classes/modelroute.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];

	$lotno = $_GET['lotno'];
	$model = $_GET['model'];
	$station = explode(":",$_GET['station']);
	$RQuantity = $_GET['RQuantity'];
	
	$exist = LotNumber::referencelotcheckExist1($account,$lotno);
			
			if($exist == 'true'){

	 $lotbatchexist = Lotnumber::refbatchcheckExist($account,$lotno);	
	 $lotcardexist = Lotnumber::refcardcheckExist($account,$lotno);
	 	

	 	if ($lotbatchexist == 'true'){

				$lotnumber = LotNumber::getReferenceDetails($account,$lotno);

				$ModelRoute = new ModelRoute();
				$ModelRoute->setAccount($account);
				$ModelRoute->setStation($lotnumber[0]->getStage());
				$ModelRoute->setModelNo($lotnumber[0]->getPartno());
				$ModelRoute->getStationDetails2();

				$Batch = Batch::getCountSerialByRef($account,$lotno);

				$nextstation = explode(":",$ModelRoute->getnextstage1($account,$lotnumber[0]->getPartno(),$ModelRoute->getFlowsequence()));
				
				if($lotnumber[0]->getStatus() == 'GOOD'){
					if($nextstation[0] == $station[0]){

						if($model == $lotnumber[0]->getPartno()){
						echo $Batch.'_true_'.$_GET['lotno']."_".$lotnumber[0]->getQuantity();
						}else{
						echo 'wrongmodel_'.$lotno;
						}
					}else{
						echo 'offroute_'.$lotno.'_'.$nextstation[0];
					}
				}else{
					echo 'lotreject_'.$lotno;
				}

			}else if($lotcardexist == 'true'){

				$lotnumber = LotNumber::getReferenceDetails($account,$lotno);
				
				$ModelRoute = new ModelRoute();
				$ModelRoute->setAccount($account);
				$ModelRoute->setStation($lotnumber[0]->getStage());
				$ModelRoute->setModelNo($lotnumber[0]->getPartno());
				$ModelRoute->getStationDetails2();

				$card = Card::getCountSerialByRef($account,$lotno);

			$nextstation = explode(":",$ModelRoute->getnextstage1($account,$lotnumber[0]->getPartno(),$ModelRoute->getFlowsequence()));
				
				if($lotnumber[0]->getStatus() == 'GOOD'){
					if($nextstation[0] == $station[0]){

						if($model == $lotnumber[0]->getPartno()){
						echo $card.'_true_'.$_GET['lotno']."_".$lotnumber[0]->getQuantity();
						}else{
						echo 'wrongmodel_'.$lotno;
						}
					}else{
						echo 'offroute_'.$lotno.'_'.$nextstation[0].'_'.$lotnumber[0]->getStage();
					}
				}else{
					echo 'lotreject_'.$lotno;
				}
			}






			}else{				
				
				echo 'lotnotexist_'.$lotno;
			}
?>