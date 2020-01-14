<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/card.php");
include_once("../classes/logpass.php");
include_once("../classes/repair.php");
include_once("../classes/lotnumber.php");
include_once("../classes/loglot.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$line = $_GET['line'];
	$station = explode(":",$_GET['station']);
	$nextStation = explode(":",$_GET['nextStation']);
	$result = "";


	$hrejectcat = json_decode($_GET['hrejectcat']);
	$hrejectcode = json_decode($_GET['hrejectcode']);
	$hlocation = json_decode($_GET['hlocation']);
	$hdetails = json_decode($_GET['hdetails']);
	$lotno = $_GET['lotno'];
	$modelno = $_GET['modelno'];

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


	$lotnumber = new Lotnumber();
	$lotnumber->setAccount($account);
	$lotnumber->setLotno($lotno);
	$lotnumber->setStatus('REJECT');
	$lotnumber->setStage($station[0]);
	$lotnumber->setLastUpdatedBy($name);
	$lotnumber->updateQASStatus();

	$loglot = new Loglot();
	$loglot->setAccount($account);
	$loglot->setLotno($lotno);
	$loglot->setModelno($modelno);
	$loglot->setStation($station[0]);
	$loglot->setStatus('REJECT');
	$loglot->setSamplingsize(0);
	$loglot->setLastUpdatedBy($name);
	$loglot->addLotLogpass();

		    echo 'successreject'."_".$serialno[0];


?>