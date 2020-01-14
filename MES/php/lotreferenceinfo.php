<?php
include_once("../classes/card.php");
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/station.php");
include_once("../classes/lotnumber.php");
include_once("../classes/modelroute.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$reference = explode(" ",$_GET['reference']);

			$exist = LotNumber::referencelotcheckExist1($account,$reference[0]);
			
		        
                    $batchexist = Batch::refcheckExist($account,$reference[0]);
                    $cardexist = Card::refcheckExist($account,$reference[0]);

			if($exist == 'true'){
 				$Lotnumber = LotNumber::getReferenceDetails($account,$reference[0]);
          		$status = $Lotnumber[0]->getStatus();
          		$model = $Lotnumber[0]->getPartno();
          		$station = $Lotnumber[0]->getStage();

          		if($status == 'REJECT'){


               if ($cardexist =='true'){

                    $countlot = Card::getCountSerialByRef($account,$reference[0]);
                    $rejectcount = Card::rejectCountRef($account,$reference[0]);
                    $getseriallot = Card::getAllSerialRef($account,$reference[0]);

                         for($i=0;$i<count($getseriallot);$i++){
                       
          			echo 'true_'.$_GET['reference']."_".$model."_".$station."_".$status."_".$name."_".$countlot."_".$rejectcount."_".$getseriallot[$i]->getSerialNo()."_".$getseriallot[$i]->getPartNo()."_".$getseriallot[$i]->getStatus()."&";
                    }
                         } else if ($batchexist =='true'){

                    $countlot1 = Batch::getCountSerialByRef($account,$reference[0]);
                    $rejectcount1 = Batch::rejectCountserialRef($account,$reference[0]);
                    $getseriallot1 = Batch::getAllSerialRef($account,$reference[0]);

                         for($i=0;$i<count($getseriallot1);$i++){
                       
                         echo 'true_'.$_GET['reference']."_".$model."_".$station."_".$status."_".$name."_".$countlot1."_".$rejectcount1."_".$getseriallot1[$i]->getBatchno()."_".$getseriallot1[$i]->getPartNo()."_".$getseriallot1[$i]->getStatus()."&";
                    }
               }

 			 }else{
                    echo 'lotreject_';
                    }

               }else{
                    echo 'lotnotexist_';
               }


 			

			
?>