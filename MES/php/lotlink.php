<?php

include_once("../classes/lotnumber.php");
include_once("../classes/loglot.php");

session_start();

	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];

	$lot = $_GET['masterlot'];
	$sublot = $_GET['sublot'];
	$model = $_GET['model'];
	$qty = $_GET['qty'];

	$txtsublot = json_decode($_GET['txtsublot']);
	$txtpartno = json_decode($_GET['txtpartno']);
	$txtqty = json_decode($_GET['txtqty']);



	for($i=0;$i<count($txtsublot);$i++){

			$lotnumber = new LotNumber($account,$txtsublot[$i]);

	$link = new lotnumber();
	$link->setAccount($account);
	$link->setLotno($txtsublot[$i]);
	$link->setReference($lot);
	$link->setLastUpdatedBy($name);
	$link->updatelotlink();

	$loglot = new Loglot();
	$loglot->setAccount($account);
	$loglot->setLotno($txtsublot[$i]);
	$loglot->setModelno($model);
	$loglot->setStation($lotnumber->getStage());
	$loglot->setStatus('Link');
	$loglot->setSamplingsize(0);
	$loglot->setLastUpdatedBy($name);
	$loglot->addLotLogpass();

	}
	


	echo 'success_';

?>