<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/mother.php");
include_once("../classes/batch.php");
include_once("../classes/card.php");
include_once("../classes/repair.php");
include_once("../classes/batchrepair.php");
include_once("../classes/motherrepair.php");
session_start();


  $account = trim($_SESSION['account']);
  $name = $_SESSION['name'];
  $serialno = explode(" ",$_GET['serialno']);
  $type='';

  $motherexist = Mother::checkExist($account,$serialno[0]);
  $batchexist = Batch::checkExist($account,$serialno[0]);
  $cardexist = Card::checkExist($account,$serialno[0]);

  if($motherexist == 'true'){

      $mother = new Mother($account,$serialno[0]);

      if($mother->getStatus() == 'REJECT'){
        
           $motherrepair = MotherRepair::getRejectStatus($account,$serialno[0]);
        
        if($motherrepair == 0 ){

       echo "error3_".$serialno[0];

      }else{

        $Station = new Station();
        $Station->StationDetails($account,$mother->getCurtStation());
        $discription = $mother->getCurtStation().": ".$Station->getDescription();

        echo "success_".$serialno[0]."_".$mother->getPartNo()."_".$type."_".$discription."_".$mother->getStatus()."_".$mother->getLastUpdatedBy()."_".$mother->getCurrQuantity();
         
      }

      }else{
         echo "error2_".$serialno[0];
      }

  }else if($batchexist == 'true'){

      $batch = new Batch($account,$serialno[0]);

      if($batch->getStatus() == 'REJECT'){

        $batchrepair = BatchRepair::getRejectStatus($account,$serialno[0]);
        
        if($batchrepair == 0 ){

       echo "error3_".$serialno[0];

      }else{
   

        $Station = new Station();
        $Station->StationDetails($account,$batch->getCurtStage());
        $discription = $batch->getCurtStage().": ".$Station->getDescription();

        echo "success_".$serialno[0]."_".$batch->getPartNo()."_".$type."_".$discription."_".$batch->getStatus()."_".$batch->getLastUpdatedBy()."_".$batch->getCurrquantity();
         
      }

      }else{
         echo "error2_".$serialno[0];
      }

  }else if ($cardexist == 'true'){

              $card = new Card($account,$serialno[0]);



      if($card->getStatus() == 'REJECT'){
        
          $repair = Repair::getRejectStatus($account,$serialno[0]);
        
        if($repair == 0 ){

       echo "error3_".$serialno[0];

      }else{
 

        $Station = new Station();
        $Station->StationDetails($account,$card->getCurtStage());
        $discription = $card->getCurtStage().": ".$Station->getDescription();

        echo "success_".$serialno[0]."_".$card->getPartNo()."_".$type."_".$discription."_".$card->getStatus()."_".$card->getLastUpdatedBy()."_".'0';
         
      }

      }else{
         echo "error2_".$serialno[0];
      }


      }else{       
        echo "error1_".$serialno[0];
      }


?>