<?php
include_once("../classes/card.php");
include_once("../classes/serialformat.php");
include_once("../classes/station.php");
include_once("../classes/lotnumber.php");
include_once("../classes/modelroute.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$model = $_GET['model'];
	$lotno = explode(" ",$_GET['lotno']);

			$exist = LotNumber::lotcheckExist($account,$lotno[0]);
			
		
			if($exist == 'true'){
 				$Lotnumber = new LotNumber($account,$lotno[0]);
          		$status = $Lotnumber->getStatus();
          		$model = $Lotnumber->getPartno();
          		$station = $Lotnumber->getStage();

          	
          		$countlot = Card::getCountSerialByLot($account,$lotno[0]);
                    $rejectcount = Card::rejectCount($account,$lotno[0]);
                    $getseriallot = Card::getAllLotno($account,$lotno[0]);

          		if($status == 'REJECT'){

                         for($i=0;$i<count($getseriallot);$i++){
                       
          			echo 'true_'.$_GET['lotno']."_".$model."_".$station."_".$status."_".$name."_".$countlot."_".$rejectcount."_".$getseriallot[$i]->getCardNo()."_".$getseriallot[$i]->getPartNo()."_".$getseriallot[$i]->getStatus()."&";
                    }


 			 }else{
                    echo 'lotreject_';
                    }
               }
               else
               {
                    echo 'lotnotexist_';
               }


 			

			
?>