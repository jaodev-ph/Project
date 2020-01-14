<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/mother.php");
include_once("../classes/logmother.php");
session_start();


  $account = trim($_SESSION['account']);
  $name = $_SESSION['name'];
  $serialno = explode(" ",$_GET['serialno']);


  $exist = Mother::checkExist($account,$serialno[0]);

      if($exist == 'true'){



      $mother = new Mother($account,$serialno[0]);

      if($mother->getStatus() == 'REJECT'){
        $forFa = ModelRoute::forFA($account,$mother->getCurtStation(),$mother->getPartNo());
        
        if($mother->getRejectFlag() == 0 && $forFa == 'true'){

       echo "error3_".$serialno[0];

      }else{
        if($mother->getLotType() == 'N'){
          $type ='N: Normal';
        }else if($mother->getLotType() == 'D'){
          $type ='D: Debug';
        }else if($mother->getLotType() == 'R'){
          $type ='R: Return';
        }else if($mother->getLotType() == 'S'){
          $type ='S: Special';
        }

        $Station = new Station();
        $Station->StationDetails($account,$mother->getCurtStation());
        $discription = $mother->getCurtStation().": ".$Station->getDescription();

        echo "success_".$serialno[0]."_".$mother->getPartNo()."_".$type."_".$discription."_".$mother->getStatus()."_".$mother->getLastUpdatedBy();
         
      }

      }else{
         echo "error2_".$serialno[0];
      }

      }else{       
        echo "error1_".$serialno[0];
      }


?>