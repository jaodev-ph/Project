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
	$serialno1 = $serialno[0];
	$fullserialno2 = explode(" ",$_GET['serialno2']);
	$serialno2 = $fullserialno2[0];
	$line = $_GET['line'];
	$model = $_GET['model'];
	$station = explode(": ",$_GET['station']);
	$nextStation = explode(":",$_GET['nextStation']);
	$result = "";

	$hrejectcat = json_decode($_GET['hrejectcat']);
	$hrejectcode = json_decode($_GET['hrejectcode']);
	$hlocation = json_decode($_GET['hlocation']);
	$hdetails = json_decode($_GET['hdetails']);
	

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

				$linkedMac = Link2::getLinkedMac($account,$serialno[0],$model,$station[0]);
			if(strlen($linkedMac)==0){
				$macPN = Link2::getB9MacAddressPN($account,$model);
				$link = new Link2();
				$link->setAccount($account);
				$link->setSerialNo($serialno1);
				$link->setSerialNoLink($serialno2);
				$link->setPartNo($model);
				$link->setPartNoLink($macPN);
				$link->setQty('1');
				$link->setStation($station[0]);
				$link->setDescription($station[1]);
				$link->setLastUpdatedBy($name);
				$link->addLogLink();
			}

		    echo 'successreject'."_".$serialno[0];


?>