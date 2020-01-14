<?php
include_once("../classes/card.php");
include_once("../classes/logpass.php");
include_once("../classes/lotnumber.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);
	$lotno = explode(" ",$_GET['lotno']);
	$model = $_GET['modelno'];

	$Serial = new Card($account,$serialno[0]);

	$countlot = Card::getCountSerialByLot($account,$lotno[0])-1;
    $rejectcount = Card::rejectCount($account,$lotno[0])-1;

    if($Serial->getLotNo() == ''){
    	echo 'wronglot_';
    }else{

			$Card = new Card();
			$Card->setAccount($account);
			$Card->setCardNo($serialno[0]);
			$Card->setLotNo('');
			$Card->setCurtStage('007');
			$Card->setLastUpdatedBy($name);
			$Card->updateLotSort();

			$Logpass = new LogPass();
			$Logpass->setAccount($account);
			$Logpass->setLine('');
			$Logpass->setCardNo($serialno[0]);
			$Logpass->setSequence(0);
			$Logpass->setMachine($lotno[0]);
			$Logpass->setStation('LotSort');
			$Logpass->setStatus('REJECT');
			$Logpass->setLastUpdatedBy($name);
			$Logpass->addLogpass();

			echo 'success_'.$serialno[0]."_".$Serial->getPartNo()."_".$Serial->getStatus()."_".$countlot."_".$rejectcount."_".$Serial->getLotNo();
}




?>