<?php

include_once("../classes/card.php");
include_once("../classes/station.php");
include_once("../classes/lotnumber.php");
include_once("../classes/modelroute.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$model = $_GET['model'];
	$sublot = explode(" ",$_GET['sublot']);
  $txtqty = $_GET['qty'];
  $subcount = $_GET['count'];
  $tblcount = $_GET['tblcount'];


     $exist = LotNumber::lotcheckExist($account,$sublot[0]);
		$Lotnumber = new LotNumber($account,$sublot[0]);
          $status = $Lotnumber->getStatus();
          $model1 = $Lotnumber->getPartno();
          $station = $Lotnumber->getStage();	
          
          $count = lotnumber::getTotalLotqty($account,$sublot[0]);
          $qty = Card::getCountSerialByLot($account,$sublot[0]);

          $total = $txtqty + $qty;
		


		if($exist == 'true'){

               if ($model == $model1){

          		if($status == 'REJECT'){
                       echo 'lotreject_'; 

 			 }else{

        if ($station == '008'){
                if ($subcount == $tblcount){
        echo 'success_'.$model."_".$status."_".$count."_".$name."_".$sublot[0]."_".$model1."_".$qty."_".$total."_".$subcount."_".$tblcount."_completed";
      }else{
         echo 'success_'.$model."_".$status."_".$count."_".$name."_".$sublot[0]."_".$model1."_".$qty."_".$total."_".$subcount."_".$tblcount."_notcompleted";
      }  

        }else{

            echo 'offroute_';
                 
               }

                }
                 
                 }else{
                    echo 'wrongmodel_';

                }

               }else{
                    echo 'lotnotexist_';
               }


 			

			
?>