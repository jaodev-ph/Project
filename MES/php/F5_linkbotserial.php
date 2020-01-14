<?php

include_once("../classes/batch.php");
include_once("../classes/modelroute.php");
include_once("../classes/model.php");
include_once("../classes/serialformat.php");
include_once("../classes/linking.php");
session_start();


	$account = trim($_SESSION['account']);
	$serialno = explode(" ",$_GET['batch']);
	$model = $_GET['model'];
	$proceed = false;

	$exist = Batch::checkExist($account,$serialno[0]);

	$getmodel = SerialFormat::SelectSerialFormatFromMother1(trim($account),$serialno[0],$model);

	$batchsum =  Link2::getsumbatchserialnolink($account,$serialno[0]);

if ($getmodel == 'Wall Charger - BS') {

$SerialFormat = SerialFormat::SelectSerialFormat(trim($account),$getmodel);
	
	$sub_serial = substr($serialno[0],intval($SerialFormat[0]->getStart()),intval($SerialFormat[0]->getLast()));
	
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

	if ($exist == 'true'){
			echo 'error1_'.$serialno[0];
	return;
	}else{
		echo 'success_'.$serialno[0].'_'.$batchsum;
	}
		}else{
			echo 'serialformat_'.$serialno[0];
				return;
		}
}else{
		echo 'serialformat_'.$serialno[0];
				return;
}

}else{
	echo 'notmodel_'.'Serial Not Belong to Model!'.$getmodel;
				return;
}


?>