<?php
include_once("../classes/batch.php");
include_once("../classes/serialformat.php");
include_once("../classes/logbatch.php");
include_once("../classes/station.php");
include_once("../classes/lotnumber.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];

	$lotno = $_GET['lotno'];
	$model = $_GET['model'];
	$station = explode(":",$_GET['station']);
	$RQuantity = $_GET['RQuantity'];

	$proceed = false;
	

	$SerialFormat = SerialFormat::SelectlotFormat(trim($account),$model);
	
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
			$exist = LotNumber::lotcheckExist($account,$lotno);
		
			if($exist == 'true'){
 				$lotnumber = new LotNumber($account,$lotno);
				if($lotnumber->getStatus() == 'completed'){
					echo $lotnumber->getQuantity().'_error4_'.$_GET['lotno'];
				}else{
					$lotcount = Batch::getCountSerialByLot($account,$lotno);
					$batchcount = Batch::getCountBatchByLot($account,$lotno);
					if($lotcount == $RQuantity){
					echo $lotcount.'_'.'false'."_".$batchcount;
					}else{
					echo $lotcount.'_'.'true'."_".$batchcount;	
					}
					
				}
			}else{				
				
				$LotNo = new LotNumber();
				$LotNo->setAccount($account);
				$LotNo->setLotno($lotno);
				$LotNo->setCounter(0);
				$LotNo->setReference('');
				$LotNo->setPartno('');
				$LotNo->setStage($station[0]);
				$LotNo->setStatus('NC');
				$LotNo->setSamplingSize(0);
				$LotNo->setLastupdatedby($name);
				$LotNo->setQuantity(0);
				$LotNo->setPackingref('');
				$LotNo->addLot();
				echo '0_insert';		
			}

		}else{
			echo 'error2_'.$_GET['lotno'];
		}
	}else{
		echo 'error1_'.$_GET['lotno'];
	}
	

			


?>