<?php
include_once("../classes/card.php");
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/station.php");
include_once("../classes/lotnumber.php");
include_once("../classes/modelroute.php");
include_once("../classes/partcode.php");

session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
  $reference = explode(" ",$_GET['reference']);

if($reference[0] == ''){
echo 'lotnotexist_';
}else{

    $exist = LotNumber::referencelotcheckExist1($account,$reference[0]);
    
    if($exist == 'true'){
    $ref = Lotnumber::getReferenceDetails($account,$reference[0]);
      $lotno = $ref[0]->getLotno();
       $status = $ref[0]->getStatus();
        $model = $ref[0]->getPartno();
         $station = $ref[0]->getStage();
          $partcode = $ref[0]->getPackingref();
            $qty = $ref[0]->getQuantity();

    $station1 = new Station();
    $station1->StationDetails($account,$station);
    
  /*  $result .= $station.": ".$station1->getDescription()."_";*/

       if($status == 'REJECT'){
 				      echo 'lotreject_';
          
                }else{
          echo 'success_'.$lotno."_".$model."_".$status."_".$station.": ".$station1->getDescription()."_".$partcode."_".$qty."_".$name;
      }  
 
 	}else{
 	   echo 'lotnotexist_';
 	  }
         
 			}

			
?>