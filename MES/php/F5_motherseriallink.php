<?php
include_once("../classes/card.php");
include_once("../classes/batch.php");
include_once("../classes/logbatch.php");
include_once("../classes/mother.php");
include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/logmother.php");
include_once("../classes/station.php");
include_once("../classes/linking.php");
include_once("../classes/modelroute.php");
include_once("../classes/model.php");
session_start();

$account = $_SESSION['account'];
$name = $_SESSION['name'];
$serialno = explode(" ",$_GET['serialno']);
$model = $_GET['model'];
$station = explode(":",$_GET['station']);
$total1 = 0;
$total2 = 0;
$qtypt1 = $_GET['qtypt1'];
$qtypt2 = $_GET['qtypt2'];
$pt1 = explode(" ",$_GET['pt1']);
$pt2 = explode(" ",$_GET['pt2']);	
$line = $_GET['line'];




$Serial = new Mother($account,$serialno[0]);

$exist = Mother::checkExist($account,$serialno[0]);

if($exist == 'true'){

$ModelRoute = new ModelRoute();

	$ModelRoute->setAccount($account);
	$ModelRoute->setStation($Serial->getCurtStation());
	$ModelRoute->setModelNo($Serial->getPartNo());
	$ModelRoute->getStationDetails2();

	$nextstage = explode(": ", $ModelRoute->getnextstage1($account,$Serial->getPartNo(),$ModelRoute->getFlowsequence()));

//$stage = explode(":",$nextstage);

$validserialformat1 = SerialFormat::validserialformat($account,$serialno[0],$model);


if ($model == 'Wall Charger - MA') {




	if($model == $Serial->getPartNo()){

	if($Serial->getStatus() == 'REJECT'){

				echo 'Serial is Reject! '.$serialno[0];
				return;
			}else{

if($nextstage[0] == $station[0]){

if($validserialformat1 == 'false'){
	echo 'Incorrect Format! Serial: '.$serialno[0];
	return;
}else{

$countserialTS = Link2::getcountlink($account,$serialno[0],'Wall Charger - TS');	
$countserialBS = Link2::getcountlink($account,$serialno[0],'Wall Charger - BS');	
$motherqty = Link2::getsumcountseriallink($account,$serialno[0]);

echo 'success_'.$serialno[0].'_'.$motherqty.'_'.$countserialTS.'_'.$countserialBS;

	//echo 'insert0_'.$serialno[0].'_'.$Serial->getCurrQuantity().'_'.$total1.'_'.$total2;

	}
}else{
	echo 'offroute_'.$serialno[0];
	return;
	}

		}
}else{
	echo 'wrongmodel_'.$serialno[0];
	return;
	}

/*	}else{
echo 'notexist_'.$serialno[0];
return;
}*/



	///////////////////////else/////////////////////////
}else{

	if($model == $Serial->getPartNo()){

	if($Serial->getStatus() == 'REJECT'){

				echo 'Serial is Reject! '.$serialno[0];
				return;
			}else{

if($nextstage[0] == $station[0]){

if($validserialformat1=='false'){
	echo 'Incorrect Format! Serial: '.$serialno[0];
	return;
}else{
$countserial = Link2::getcountseriallink($account,$serialno[0]);
	if($countserial==0){
	echo 'Mother Serial is Empty! '.$serialno[0];
	return;
}else{
	echo 'success_'.$serialno[0].'_'.$countserial.'_'.$Serial->getPartNo();
}
	}
}else{
	echo 'offroute_'.$serialno[0].'_'.$nextstage[0];
	return;
	}

		}
}else{
	echo 'wrongmodel_'.$serialno[0];
	return;
	}

}

	}else{
echo 'notexist_'.$serialno[0];
return;
}

?>