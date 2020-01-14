<?php
include_once("../classes/mother.php");
include_once("../classes/serialformat.php");
include_once("../classes/logmother.php");
include_once("../classes/station.php");
include_once("../classes/model.php");
include_once("../classes/logpass.php");
include_once("../classes/card.php");
include_once("../classes/linking.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];

	$serialno = explode(" ",$_GET['serialno']);
	$station ='001';
	$model = $_GET['model'];
	$line = $_GET['line'];
	$type = $_GET['type'];
	$quantity = $_GET['quantity'];
	$proceed = false;
	
	$SerialFormat = SerialFormat::SelectSerialFormat(trim($account),$model);

	$sub_serial = substr($serialno[0],intval($SerialFormat[0]->getStart()),intval($SerialFormat[0]->getLast()));

	$childmodel = Model::SelectChildModel($account,$model);


	$txtChildSerial = json_decode($_GET['txtChildSerial']);
	$txtchildstatus = json_decode($_GET['txtchildstatus']);
	$txtchildpartno = json_decode($_GET['txtchildpartno']);

	
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

	if(strlen($serialno[0]) == $SerialFormat[0]->getSerialLength()){

		if($proceed  == true)
		{
			$exist = Mother::checkExist($account,$serialno[0]);

			if($exist == 'true'){
				echo 'error1_'.$_GET['serialno'];
			}else{
				
	for($i=0;$i<count($childmodel);$i++){


			$Mother = new Mother();
			$Mother->setAccount($account);
			$Mother->setCardNo($serialno[0]);
			$Mother->setMotherSerialNo($serialno[0]);
			$Mother->setPartNo($model);
			$Mother->setChildPartNo($childmodel[$i]->getModel());
			$Mother->setWorkorder('');
			$Mother->setRevision('');
			$Mother->setLineCode($line);
			$Mother->setHoldFlag(0);
			$Mother->setPackFlag(0);
			$Mother->setShipFlag(0);
			$Mother->setRTVFlag(0);
			$Mother->setRejectFlag(0);
			$Mother->setStatus('GOOD');
			$Mother->setLotno('');
			$Mother->setLotType($type);
			$Mother->setLastUpdatedBy($name);
			$Mother->setCurtStation($station);
			$Mother->setOrigquantity($childmodel[$i]->getItemWt());
			$Mother->setCurrquantity($childmodel[$i]->getItemWt());
			$Mother->setLinkedQuantity(0);
			$Mother->addMother();

			$LogMother = new LogMother();
			$LogMother->setAccount($account);
			$LogMother->setLine($line);
			$LogMother->setMotherSerial($serialno[0]);
			$LogMother->setChildPartNo($childmodel[$i]->getModel());
			$LogMother->setStage($station);
			$LogMother->setStatus('GOOD');
			$LogMother->setLastUpdatedBy($name);
			$LogMother->setCurrquantity($childmodel[$i]->getItemWt());
			$LogMother->setDisquantity(0);
			$LogMother->setRemarks('');
			$LogMother->addLogMother();

}for($x=0;$x<count($txtChildSerial);$x++){

			$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($txtChildSerial[$x]);
			$Card->setSerialNo($txtChildSerial[$x]);
			$Card->setSystem21('');
			$Card->setWorkorder('');
			$Card->setPartNo($txtchildpartno[$x]);
			$Card->setRevision('');
			$Card->setLineCode($line);
			$Card->setHoldFlag(0);
			$Card->setPackFlag(0);
			$Card->setShipFlag(0);
			$Card->setRTVFlag(0);
			$Card->setRejectFlag(0);
			$Card->setStatus('GOOD');
			$Card->setLotno('');
			$Card->setLotType('');
			$Card->setCurtStage('005');
			$Card->setLotType('');
			$Card->setLastUpdatedBy($name);
			$Card->addCard();

		/*	$Logpass = new LogPass();
			$Logpass->setAccount($account);
			$Logpass->setLine($line);
			$Logpass->setCardNo($txtChildSerial[$x]);
			$Logpass->setSequence(0);
			$Logpass->setMachine('');
			$Logpass->setStation('005');
			$Logpass->setStatus('GOOD');
			$Logpass->setLastUpdatedBy($name);
			$Logpass->addLogpass();*/

			$link = new Link2();
			$link->setAccount($account);
			$link->setSerialno($serialno[0]);
			$link->setPartno($model);
			$link->setSerialnoLink($txtChildSerial[$x]);
			$link->setPartnoLink($txtchildpartno[$x]);
			$link->setQty('1');
			$link->setStation($station);
			$link->setDescription('REG');
			$link->setLastUpdatedBy($name);
			$link->addLogLink();



			}
			

			$Station = new Station();
			$Station->StationDetails($account,$station);
			$description = $Station->getDescription();


			echo 'success_'.$_GET['serialno']."_".$model."_".$type."_".$line."_".$description."_"."GOOD"."_".$name;
			}	
		}else{
			echo 'error2_'.$_GET['serialno'];
		}
	}else{
		echo 'error3_'.$_GET['serialno'];
	}
	

			


?>