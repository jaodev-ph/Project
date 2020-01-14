<?php

include_once("../classes/modelroute.php");
include_once("../classes/station.php");
include_once("../classes/mother.php");
include_once("../classes/batch.php");
include_once("../classes/card.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$serialno = explode(" ",$_GET['serialno']);


  $motherexist = Mother::checkExist($account,$serialno[0]);
  $batchexist = Batch::checkExist($account,$serialno[0]);
  $cardexist = Card::checkExist($account,$serialno[0]);

  if($motherexist == 'true'){

	$mother = new Mother($account,$serialno[0]);

	$optstation = ModelRoute::getBeforeStations($account, $mother->getPartNo(), $mother->getCurtStation());
    for($i=0;$i<count($optstation);$i++){

        echo $optstation[$i]->getStation().",";
    
    }
}else if($batchexist == 'true'){

		$batch = new Batch($account,$serialno[0]);

	$optstation = ModelRoute::getBeforeStations($account, $batch->getPartNo(), $batch->getCurtStage());
    for($i=0;$i<count($optstation);$i++){

        echo $optstation[$i]->getStation().",";
    
    }

}else if($cardexist == 'true'){

		$card = new Card($account,$serialno[0]);

	$optstation = ModelRoute::getBeforeStations($account, $card->getPartNo(), $card->getCurtStage());
    for($i=0;$i<count($optstation);$i++){

        echo $optstation[$i]->getStation().",";
    
    }

}


?>