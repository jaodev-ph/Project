<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/batch.php");
include_once("../classes/logbatch.php");
session_start();


  $account = trim($_SESSION['account']);
  $name = $_SESSION['name'];
  $serialno = explode(" ",$_GET['serialno']);


  $exist = Batch::checkExist($account,$serialno[0]);

      if($exist == 'true'){



      $Batch = new Batch($account,$serialno[0]);

      if($Batch->getStatus() == 'REJECT'){
        $forFa = ModelRoute::forFA($account,$Batch->getCurtStage(),$Batch->getPartNo());
        
        if($Batch->getRejectFlag() == 0 && $forFa == 'true'){

       echo "error3_".$serialno[0];

      }else{
        if($Batch->getLotType() == 'N'){
          $type ='N: Normal';
        }else if($Batch->getLotType() == 'D'){
          $type ='D: Debug';
        }else if($Batch->getLotType() == 'R'){
          $type ='R: Return';
        }else if($Batch->getLotType() == 'S'){
          $type ='S: Special';
        }

        $Station = new Station();
        $Station->StationDetails($account,$Batch->getCurtStage());
        $discription = $Batch->getCurtStage().": ".$Station->getDescription();

        echo "success_".$serialno[0]."_".$Batch->getPartNo()."_".$type."_".$discription."_".$Batch->getStatus()."_".$Batch->getLastUpdatedBy()."_".$Batch->getCurrquantity();
         
      }

      }else{
         echo "error2_".$serialno[0];
      }

      }else{       
        echo "error1_".$serialno[0];
      }


?>