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


	$exist = LotNumber::referencelotcheckExist1($account,$reference[0]);

     $batchexist = Batch::refcheckExist($account,$reference[0]);
     $cardexist = Card::refcheckExist($account,$reference[0]);


			$Lotnumber = LotNumber::getReferenceDetails($account,$reference[0]);

                    $status = $Lotnumber[0]->getStatus();
                    $model = $Lotnumber[0]->getPartno();
                    $station = ModelRoute::getCurrentStation($account,$model,$Lotnumber[0]->getStage());
                    $lotno = $Lotnumber[0]->getLotno();

if($reference[0] == ''){
echo 'lotnotexist_';
}else{
  
     if($exist == 'true'){

          if($status == 'REJECT'){

        if ($cardexist == 'true'){

                    $countlot = Card::getCountSerialByRef($account,$reference[0]);
                    $rejectcount = Card::rejectCountRef($account,$reference[0]);
                    $rejectserial = Card::showRejectref($account,$reference[0]);
                    $cardrejectexist = Card::rejectexist($account,$reference[0]);

if ($cardrejectexist == 'false'){

   echo  'true_'.$lotno."_".$model."_".$station."_".$status."_".$name."_".$countlot."_".$rejectcount;

 }else{

          for($x=0;$x<count($rejectserial);$x++){
          echo 'true_'.$lotno."_".$model."_".$station."_".$status."_".$name."_".$countlot."_".$rejectcount."_".$rejectserial[$x]->getSerialNo()."_".$rejectserial[$x]->getStatus()."&";
          }

        }
          
          }else if ($batchexist == 'true'){

                    $countlot1 = Batch::getCountSerialByRef($account,$reference[0]);
                    $rejectcoun1t = Batch::rejectCountRef($account,$reference[0]);
                    $rejectserial1 = Batch::showRejectref($account,$reference[0]);
                    $batchrejectexist = Batch::rejectexist($account,$reference[0]);

if ($batchrejectexist == 'false'){

echo 'true_'.$lotno."_".$model."_".$station."_".$status."_".$name."_".$countlot1."_".$rejectcount1;

 }else{

          for($x=0;$x<count($rejectserial);$x++){
          echo 'true_'.$lotno."_".$model."_".$station."_".$status."_".$name."_".$countlot1."_".$rejectcount1."_".$rejectserial1[$x]->getSerialNo()."_".$rejectserial1[$x]->getStatus()."&";
          }       
}
          
     } 

 	}else{
        echo 'lotreject_';
          }
 
    
 	   }else{
 	   echo 'lotnotexist_';
 	}
         
 			}

//echo $exist;
			
?>