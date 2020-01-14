<?php
include_once("../classes/cardlink_loglink.php");
include_once("../classes/card.php");
include_once("../classes/cardlink_check.php");
include_once("../classes/modelRoute.php");
include_once("../classes/station.php");
include_once("../classes/logpass.php");
session_start();

$account = trim($_SESSION['account']);
$name = $_SESSION['name'];
$serialno = explode(" ",$_GET['serial1']);
$serialno2 = explode(" ",$_GET['serial2']);
$serial1_model = $_GET['model1'];
$serial2_model = $_GET['model2'];
$line = $_GET['line'];
$link = new LogLink();
$linkexist = LogLink::LinkExist($account,$serialno[0],$serialno2[0]);
$Station = new Station();
$linking = new Check($account,$serial1_model,$serial2_model);
$Station->StationDetails($account,$linking->getstation());

if($linkexist=="true")
{
	echo 'alreadylinked_';
}
else
{
	if($linking->getserial2Reg()=="1")
	{
		$Card = new Card();
		$Card->setAccount($account);
		$Card->setCardNo($serialno2[0]);
		$Card->setSerialNo($serialno2[0]);
		$Card->setSystem21('');
		$Card->setWorkorder('');
		$Card->setPartNo($serial2_model);
		$Card->setRevision('');
		$Card->setLineCode('');
		$Card->setHoldFlag(0);
		$Card->setPackFlag(0);
		$Card->setShipFlag(0);
		$Card->setRTVFlag(0);
		$Card->setRejectFlag(0);
		$Card->setStatus('GOOD');
		$Card->setLotno('');
		$Card->setLotType('');
		$Card->setCurtStage($linking->getstation());
		$Card->setLotType('');
		$Card->setLastUpdatedBy($name);
		$Card->addCard();

		$link->setaccount($account);
		$link->setserialno($serialno[0]);
		$link->setpartno($serial1_model);
		$link->setserialnoLink($serialno2[0]);
		$link->setpartnoLink($serial2_model);
		$link->setquantity("1");
		$link->setstation($linking->getstation());
		$link->setdescription($Station->getdescription());
		$link->setlastupdatedBy($name);
		$link->addLogLink();

		$Logpass = new LogPass();

		$Logpass->setAccount($account);
		$Logpass->setLine($line);
		$Logpass->setCardNo($serialno[0]);
		$Logpass->setSequence(0);
		$Logpass->setMachine('');
		$Logpass->setStation($linking->getstation());
		$Logpass->setStatus('GOOD');
		$Logpass->setLastUpdatedBy($name);
		$Logpass->addLogpass();

		$Logpass->setAccount($account);
		$Logpass->setLine($line);
		$Logpass->setCardNo($serialno2[0]);
		$Logpass->setSequence(0);
		$Logpass->setMachine('');
		$Logpass->setStation($linking->getstation());
		$Logpass->setStatus('GOOD');
		$Logpass->setLastUpdatedBy($name);
		$Logpass->addLogpass();
		echo 'ok_';
	}
	else
	{
		$link->setaccount($account);
		$link->setserialno($serialno[0]);
		$link->setpartno($serial1_model);
		$link->setserialnoLink($serialno2[0]);
		$link->setpartnoLink($serial2_model);
		$link->setquantity("1");
		$link->setstation($linking->getstation());
		$link->setdescription($Station->getdescription());
		$link->setlastupdatedBy($name);
		$link->addLogLink();

		$Logpass = new LogPass();

		$Logpass->setAccount($account);
		$Logpass->setLine($line);
		$Logpass->setCardNo($serialno[0]);
		$Logpass->setSequence(0);
		$Logpass->setMachine('');
		$Logpass->setStation($linking->getstation());
		$Logpass->setStatus('GOOD');
		$Logpass->setLastUpdatedBy($name);
		$Logpass->addLogpass();

		$Logpass->setAccount($account);
		$Logpass->setLine($line);
		$Logpass->setCardNo($serialno2[0]);
		$Logpass->setSequence(0);
		$Logpass->setMachine('');
		$Logpass->setStation($linking->getstation());
		$Logpass->setStatus('GOOD');
		$Logpass->setLastUpdatedBy($name);
		$Logpass->addLogpass();
		echo 'ok_';
	}
}



?> 