<?php
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/logbatch.php");
include_once("../classes/station.php");
include_once("../classes/lotnumber.php");
include_once("../classes/modelroute.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
 
	$lotno =$_GET['lotno'];
/*	$reference = $_GET['reference'];*/
	$model = $_GET['model'];
	//$station = explode(": ",$_GET['station']);
	$RQuantity = $_GET['RQuantity'];
	//$partcode = trim($_GET['partcode']);

	$proceed = false;
	

	$exist = LotNumber::lotcheckexist($account,$lotno);
					
					if($exist == 'true'){
$lotnumber = new LotNumber($account,$lotno);

	$SerialFormat = SerialFormat::SelectlotFormat(trim($account),$lotnumber->getPartno());	
	$sub_serial = substr($lotno,intval($SerialFormat[0]->getStart()),intval($SerialFormat[0]->getLast()));
	
	
	if($SerialFormat[0]->getAllowFormat() == 0){
		
		$proceed =true;
	}else{
		if($SerialFormat[0]->getValue() == $sub_serial)
		{
		$proceed = true;
		}else{
		$proceed = false;
		}
	}

	if(strlen($lotno) == $SerialFormat[0]->getSerialLength()){

		if($proceed  == true)
		{



    $ModelRoute = new ModelRoute();
	$ModelRoute->setAccount($account);
	$ModelRoute->setModelNo($lotnumber->getPartno());
	$ModelRoute->getLotStation();

		$Station = new Station();
	    $Station->StationDetails($account,$ModelRoute->getStation());
	    $description = $ModelRoute->getStation().": ".$Station->getDescription();
	    	$station = explode(": ",$description);

			$mdate = date('n');
					          if($mdate>9){
                         if($mdate==10){
                           $mdate = 'X';
                         }else if($mdate==11){
                           $mdate = 'Y';
                         }else if($mdate==12){
                           $mdate = 'Z';
                         }
                       }

                      $t = microtime(true);
                      $micro = sprintf("%06d",($t - floor($t)) * 1000000);
                      $d = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
                      $reference = 'V'.'IONPCA'.date('y').$mdate.date('dhis').substr($d->format("u"),0,3); $disabledReference = '';

                         
        $LotNo = new LotNumber();
        $LotNo->setAccount($account);
        $LotNo->setLotno($lotno);
        $LotNo->setCounter(0);
        $LotNo->setReference($reference);
        $LotNo->setPartno($lotnumber->getPartno());
        $LotNo->setStage($station[0]);
        $LotNo->setStatus('NC');
        $LotNo->setSamplingSize(0);
        $LotNo->setLastupdatedby($name);
        $LotNo->setQuantity(0);
        $LotNo->setPackingref($lotnumber->getPackingRef());
        $LotNo->addLot();
		
	
 			
					$lotqty = Lotnumber::getCountRefByLot($account,$lotno);
					$totallotqty = Lotnumber::getTotalLotqty($account,$lotno);
					$lotcount = Batch::getCountSerialByLot($account,$lotno);
					$batchcount = Batch::getCountBatchByLot($account,$lotno);
				/*	if($lotcount == $RQuantity){
					echo $lotcount.'_'.'false'."_".$batchcount;
					}else{*/
					echo $lotcount.'_'.'true'."_".'0'."_".$reference."_".$lotnumber->getPartno()."_".$description."_".$lotnumber->getStatus()."_".$lotqty."_".$name."_".$lotnumber->getPackingRef()."_".$totallotqty."_".$lotno;	
					/*}*/

		}else{
			echo 'error2_'.$_GET['lotno'];
		}
	}else{
		echo 'error1_'.$_GET['lotno'];
	}
		}else{				
				
				echo 'lotnotexist_'.$_GET['lotno'];		
			}

			


?>