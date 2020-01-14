<?php
include_once("../classes/card.php");
include_once("../classes/serialformat.php");
include_once("../classes/station.php");
include_once("../classes/lotnumber.php");
include_once("../classes/modelroute.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$model1 = $_GET['model'];
	$lotno = explode(" ",$_GET['lotno']);

			$exist = LotNumber::lotcheckExist($account,$lotno[0]);
			$Lotnumber = new LotNumber($account,$lotno[0]);
                    $status = $Lotnumber->getStatus();
                    $model = $Lotnumber->getPartno();
                    $station = $Lotnumber->getStage();

                    $countlot = Card::getCountSerialByLot($account,$lotno[0]);
                    $rejectcount = Card::rejectCount($account,$lotno[0]);
                        $rejectserial = Card::showReject($account,$lotno[0]);
                    
if($lotno[0] == ''){
echo 'lotnotexist_';
}else{
     
if($model1 == $model){      

     if($exist == 'true'){
 				
          if($status == 'REJECT'){
                    
          for($x=0;$x<count($rejectserial);$x++){
          echo 'true_'.$_GET['lotno']."_".$model."_".$station."_".$status."_".$name."_".$countlot."_".$rejectcount."_".$rejectserial[$x]->getSerialNo()."_".$rejectserial[$x]->getStatus()."&";
          }
                
 	}else{
        echo 'lotreject_';
          }
 	}
     else
 		{
 	   echo 'lotnotexist_';
 	}
          }else{
               echo 'wrongmodel_';
                    }
 			}

			
?>