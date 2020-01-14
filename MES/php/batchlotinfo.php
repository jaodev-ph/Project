<?php
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/station.php");
include_once("../classes/lotnumber.php");
include_once("../classes/modelroute.php");
session_start();

	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$model1 = $_GET['model'];
	$lotno = explode(" ",$_GET['lotno']);

     $proceed = false;

     $exist = LotNumber::lotcheckExist($account,$lotno[0]);
			
               $Lotnumber = new LotNumber($account,$lotno[0]);
               $status = $Lotnumber->getStatus();
               $model = $Lotnumber->getPartno();
               $station = $Lotnumber->getStage();

               $countlot = Batch::getCountBatchByLot($account,$lotno[0]);
               $rejectcount = Batch::rejectCount1($account,$lotno[0]);
               $getseriallot = Batch::getAllLotno($account,$lotno[0]);


if($lotno[0] == ''){
echo 'lotnotexist_';
}else{	

     if($exist == 'true'){

          if($model1 == $model){  

          	if($status == 'REJECT'){

               for($i=0;$i<count($getseriallot);$i++){
                       
          	echo 'true_'.$_GET['lotno']."_".$model1."_".$station."_".$status."_".$name."_".$countlot."_".$rejectcount."_".$getseriallot[$i]->getCardNo()."_".$getseriallot[$i]->getPartNo()."_".$getseriallot[$i]->getStatus()."_".$getseriallot[$i]->getCurrquantity()."&";
                    }
                    
 			 }else{
                    echo 'lotreject_';
                    }
               }
               else
               {
                       echo 'wrongmodel_';
               }
                   }else{
            
               echo 'lotnotexist_';
                    }
}

 			

			
?>