<?php
include_once("../classes/card.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/lotnumber.php");
include_once("../classes/loglot.php");
include_once("../classes/packing.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$packingno = $_GET['packingno'];
	$lotno = json_decode($_GET['lotnumber']);
	$model = $_GET['model'];
	$station = explode(":",$_GET['station']);
	$total = $_GET['total'];

	
				// $Packing = new Packing();
				// $Packing->setAccount($account);
				// $Packing->setPackingno($packingno);
				// $Packing->setRefno('');
				// $Packing->setPartno($model);
				// $Packing->setStage($station[0]);
				// $Packing->setStatus('completed');
				// $Packing->setQuantity($total);
				// $Packing->setLastupdatedby($name);
				// $Packing->updatePackingStatus();
			

for($x=0;$x<count($lotno);$x++){

	$lotnumber = new Lotnumber();
	$lotnumber->setAccount($account);
	$lotnumber->setLotno($lotno[$x]);
	$lotnumber->setStatus('GOOD');
	$lotnumber->setStage($station[0]);
	$lotnumber->setPackingref($packingno);
	$lotnumber->setLastUpdatedBy($name);
	$lotnumber->updateLotPacking();

	$loglot = new Loglot();
	$loglot->setAccount($account);
	$loglot->setLotno($lotno[$x]);
	$loglot->setModelno($model);
	$loglot->setStation($station[0]);
	$loglot->setStatus('GOOD');
	$loglot->setSamplingsize(0);
	$loglot->setLastUpdatedBy($name);
	$loglot->addLotLogpass();	

	}


	for($y=0;$y<count($lotno);$y++){

		$selectcard = Card::getAllLotno($account,$lotno[$y]);

		for($i=0;$i<count($selectcard);$i++){
		
		  	$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($selectcard[$i]->getCardno());
			$Card->setStatus('GOOD');
			$Card->setCurtStage($station[0]);
			$Card->setLastUpdatedBy($name);
			$Card->updatePacking();
					
			$Logpass = new LogPass();
			$Logpass->setAccount($account);
			$Logpass->setLine('');
			$Logpass->setCardNo($selectcard[$i]->getCardno());
			$Logpass->setSequence(0);
			$Logpass->setMachine('');
			$Logpass->setStation($station[0]);
			$Logpass->setStatus('GOOD');
			$Logpass->setLastUpdatedBy($name);
			$Logpass->addLogpass();

		}
	}
		
	echo 'success_'.$packingno;

?>