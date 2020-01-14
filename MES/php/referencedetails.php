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
	//$model1 = $_GET['model'];
	$reference = explode(" ",$_GET['reference']);

if($reference[0] == ''){
echo 'lotnotexist_';
}else{

      $exist = LotNumber::referencelotcheckExist1($account,$reference[0]);

      $batchexist = Batch::refcheckExist($account,$reference[0]);
      $cardexist = Card::refcheckExist($account,$reference[0]);

  
     if($exist == 'true'){


              $Lotnumber = LotNumber::getReferenceDetails($account,$reference[0]);

                    $status = $Lotnumber[0]->getStatus();
                    $model = $Lotnumber[0]->getPartno();
                    $station = $Lotnumber[0]->getStage();
                    $lotno = $Lotnumber[0]->getLotno();

                    $stage = ModelRoute::getCurrentStation($account,$model,$station);

            if($status == 'NC'){

                if ($cardexist == 'true'){

                    $countlot = Card::getCountSerialByRef($account,$reference[0]);
                    $getallserial = Card::getAllSerialRef($account,$reference[0]);

           

          for($x=0;$x<count($getallserial);$x++){
          echo 'true_'.$lotno."_".$model."_".$stage."_".$status."_".$name."_".$countlot."_".$getallserial[$x]->getSerialNo()."_".$getallserial[$x]->getPartNo()."_".$getallserial[$x]->getStatus()."&";
          }

                   }else if ($batchexist == 'true'){

                     $countlot1 = Batch::getCountSerialByRef1($account,$reference[0]);
                    $getallserial1 = Batch::getAllSerialRef($account,$reference[0]);
                   
           

                   

          for($x=0;$x<count($getallserial1);$x++){
          echo 'true_'.$lotno."_".$model."_".$stage."_".$status."_".$name."_".$countlot1."_".$getallserial1[$x]->getBatchNo()."_".$getallserial1[$x]->getPartNo()."_".$getallserial1[$x]->getStatus()."&";
          }

          
     }else{
        echo 'seriallotnotexist_';
     }   
      }else{
        echo 'lotcompleted_';
          }
 	   }else{
 	   echo 'lotnotexist_';
 	}
         
 			}

			
?>