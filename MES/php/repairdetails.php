<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/card.php");
include_once("../classes/logpass.php");
session_start();


  $account = trim($_SESSION['account']);
  $name = $_SESSION['name'];
  $serialno = explode(" ",$_GET['serialno']);


  $exist = Card::checkExist($account,$serialno[0]);

      if($exist == 'true'){



      $Card = new Card($account,$serialno[0]);

      if($Card->getStatus() == 'REJECT'){
        $forFa = ModelRoute::forFA($account,$Card->getCurtStage(),$Card->getPartNo());
        
        if($Card->getRejectFlag() == 0 && $forFa == 'true'){

       echo "error3_".$serialno[0];

      }else{
        if($Card->getLotType() == 'N'){
          $type ='N: Normal';
        }else if($Card->getLotType() == 'D'){
          $type ='D: Debug';
        }else if($Card->getLotType() == 'R'){
          $type ='R: Return';
        }else if($Card->getLotType() == 'S'){
          $type ='S: Special';
        }

        $Station = new Station();
        $Station->StationDetails($account,$Card->getCurtStage());
        $discription = $Card->getCurtStage().": ".$Station->getDescription();

        echo "success_".$serialno[0]."_".$Card->getPartNo()."_".$type."_".$discription."_".$Card->getStatus()."_".$Card->getLastUpdatedBy();
         
      }

      }else{
         echo "error2_".$serialno[0];
      }

      }else{       
        echo "error1_".$serialno[0];
      }


?>