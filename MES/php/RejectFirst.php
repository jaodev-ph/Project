<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/card.php");
include_once("../classes/logpass.php");
include_once("../classes/repair.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$line = $_GET['line'];
	$station = explode(":",$_GET['station']);
	$nextStation = explode(":",$_GET['nextStation']);
	$result = "";
	$model = $_GET["model"];

	$hrejectcat = json_decode($_GET['hrejectcat']);
	$hrejectcode = json_decode($_GET['hrejectcode']);
	$hlocation = json_decode($_GET['hlocation']);
	$hdetails = json_decode($_GET['hdetails']);


	$ModelRoute1 = new ModelRoute();
	$ModelRoute1->setAccount($account);
	$ModelRoute1->setModelNo($model);
	$ModelRoute1->getFirstStation();
	
if ($ModelRoute1->getStation() == $station[0] ){
		
			$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($serialno[0]);
			$Card->setSerialNo($serialno[0]);
			$Card->setSystem21('');
			$Card->setWorkorder('');
			$Card->setPartNo($model);
			$Card->setRevision('');
			$Card->setLineCode($line);
			$Card->setHoldFlag(0);
			$Card->setPackFlag(0);
			$Card->setShipFlag(0);
			$Card->setRTVFlag(0);
			$Card->setRejectFlag(0);
			$Card->setStatus('REJECT');
			$Card->setLotno('');
			$Card->setLotType('');
			$Card->setCurtStage($station[0]);
			$Card->setLotType('N');
			$Card->setLastUpdatedBy($name);
			$Card->addCard();
			
			$Logpass = new LogPass();
			$Logpass->setAccount($account);
			$Logpass->setLine($line);
			$Logpass->setCardNo($serialno[0]);
			$Logpass->setSequence(0);
			$Logpass->setMachine('');
			$Logpass->setStation($station[0]);
			$Logpass->setStatus('REJECT');
			$Logpass->setLastUpdatedBy($name);
			$Logpass->addLogpass();

				$repair = new Repair();

	for($i=0;$i<count($hrejectcat);$i++){

			$rejectcat = explode(":",$hrejectcat[$i]);
			$rejectcode = explode(":",$hrejectcode[$i]);
			
            $repair->setAccount($account);
            $repair->setCardno($serialno[0].'_1');
            $repair->setStage($station[0]);
            $repair->setMachine('');
            $repair->setCategory($rejectcat[0]);
            $repair->setDefect($rejectcode[0]);
            $repair->setLocation($hlocation[$i]);
            $repair->setDetails($hdetails[$i]);
            $repair->setStatus('0');
            $repair->setAddInfo('');
            $repair->setSerialAffected('');
            $repair->setComponent('');
            $repair->setRemarks('');
            $repair->setRejectUser($name);
            $repair->setRepairUser('');
            $repair->setLastUpdatedBy($name);
            $repair->addRepair();
    }

   echo 'success'."_".$serialno[0];

}else{
		
	$repair = new Repair();

	for($i=0;$i<count($hrejectcat);$i++){

			$rejectcat = explode(":",$hrejectcat[$i]);
			$rejectcode = explode(":",$hrejectcode[$i]);
			
            $repair->setAccount($account);
            $repair->setCardno($serialno[0].'_1');
            $repair->setStage($station[0]);
            $repair->setMachine('');
            $repair->setCategory($rejectcat[0]);
            $repair->setDefect($rejectcode[0]);
            $repair->setLocation($hlocation[$i]);
            $repair->setDetails($hdetails[$i]);
            $repair->setStatus('0');
            $repair->setAddInfo('');
            $repair->setSerialAffected('');
            $repair->setComponent('');
            $repair->setRemarks('');
            $repair->setRejectUser($name);
            $repair->setRepairUser('');
            $repair->setLastUpdatedBy($name);
            $repair->addRepair();
    }

    $Card = new Card();
	$Card->setAccount($account);
	$Card->setCardNo($serialno[0]);
	$Card->setStatus('REJECT');
	$Card->setCurtStage($station[0]);
	$Card->setLastUpdatedBy($name);
	$Card->updateStatus();
			
	$Logpass = new LogPass();
	$Logpass->setAccount($account);
	$Logpass->setLine($line);
	$Logpass->setCardNo($serialno[0]);
	$Logpass->setSequence(0);
	$Logpass->setMachine('');
	$Logpass->setStation($station[0]);
	$Logpass->setStatus('REJECT');
	$Logpass->setLastUpdatedBy($name);
	$Logpass->addLogpass();

		    echo 'successreject'."_".$serialno[0];

}

?>