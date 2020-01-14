<?php
include_once("../classes/card.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/lotnumber.php");
include_once("../classes/packing.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$packingno = $_GET['packingno'];
	$lotno = json_decode($_GET['lotnumber']);
	$model = $_GET['model'];
	$station = explode(":",$_GET['station']);
	$total = $_GET['total'];

	$proceed = false;
	

	$SerialFormat = SerialFormat::SelectpackingFormat(trim($account),$model);
	
	$sub_serial = substr($packingno,intval($SerialFormat[0]->getStart()),intval($SerialFormat[0]->getLast()));
	
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

	if(strlen($packingno) == $SerialFormat[0]->getSerialLength()){

		if($proceed  == true)
		{
			$exist = Packing::packingcheckExist($account,$packingno);
			
			if($exist == 'true'){
				$Packing = new Packing($account,$packingno);
				if($model == $Packing->setPartno()){
					if($Packing->getStatus() == 'completed'){
						echo 'completed_'.$_GET['packingno'];
					}else{
						// $lotcount = Card::getCountSerialByLot($account,$lotno);

						// if($lotcount == $RQuantity){
						// echo $lotcount.'_'.'false';
						// }else{
						// echo $lotcount.'_'.'true';	
						// }
						echo 'insert_'.$packingno;	
						
					}
				}else{
					echo 'wrongmodel_'.$packingno;	
				}
			}else{				
				
				$Packingno = new Packing();
				$Packingno->setAccount($account);
				$Packingno->setPackingno($packingno);
				$Packingno->setRefno('');
				$Packingno->setPartno($model);
				$Packingno->setStage($station[0]);
				$Packingno->setStatus('GOOD');
				$Packingno->setQuantity(0);
				$Packingno->setLastupdatedby($name);
				$Packingno->addPacking();
				echo 'insert_'.$packingno;		
			}

		}else{
			echo 'error2_'.$_GET['packingno'].'_'.$SerialFormat[0]->getValue().'_'.$sub_serial;
		}
	}else{
		echo 'error1_'.$_GET['packingno'];
	}
	

			


?>