<?php
//include_once("../classes/card.php");
/*include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/modelRoute.php");*/
include_once("../classes/batch.php");
include_once("../classes/linking.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$did = explode(" ",$_GET['did']);
	$model = $_GET['model'];
	$type = 'N';
	$station = '';
	$quantity = 200;

	//$Serial = new Link2($account,$did[0]);
	$exist = Link2::DIDcheckExist($account,$did[0]);

			if($exist == 'false'){
				echo 'error1_'.$_GET['did'];
				return;
			}


			$Batch = new Batch();
			$Batch->setAccount($account);
			$Batch->setCardNo($serialno[0]);
			$Batch->setBatchno($serialno[0]);
			// $Batch->setSystem21('');
			$Batch->setWorkorder('');
			$Batch->setPartNo($model);
			$Batch->setRevision('');
			$Batch->setLineCode('');
			$Batch->setRefno('');
			$Batch->setHoldFlag(0);
			$Batch->setPackFlag(0);
			$Batch->setShipFlag(0);
			$Batch->setRTVFlag(0);
			$Batch->setRejectFlag(0);
			$Batch->setStatus('GOOD');
			$Batch->setLotno('');
			$Batch->setLotType('');
			$Batch->setCurtStage($station);
			$Batch->setLotType($type);
			$Batch->setLastUpdatedBy($name);
			$Batch->setParentbatchno('');
			$Batch->setChildbatchno('');
			$Batch->setOrigquantity($quantity);
			$Batch->setCurrquantity($quantity);
			$Batch->addBatch();


			// else{

			// if($Serial->getStatus() == 'REJECT'){

			// 	echo 'serialreject_'.$_GET['serialno'];
			// }else{
			// 	if($model == $Serial->getPartNo()){

			// $Serial = new Card($account,$serialno[0]); 
			// $Station = new Station();
			// $ModelRoute = new ModelRoute();

			// $Station->StationDetails($account,$Serial->getCurtStage());
			// $discription = $Station->getDescription();

			// if($Serial->getLotType() == 'N'){
			// 	$type ='N: Normal';
			// }else if($Serial->getLotType() == 'D'){
			// 	$type ='D: Debug';
			// }else if($Serial->getLotType() == 'R'){
			// 	$type ='R: Return';
			// }else if($Serial->getLotType() == 'S'){
			// 	$type ='S: Special';
			// }
			// $ModelRoute->setAccount($account);
			// $ModelRoute->setStation($Serial->getCurtStage());
			// $ModelRoute->getStationDetails();
		
			


			echo 'success_'.$did[0];
			// }else{
			// 	echo 'wrongmodel_'.$_GET['serialno'];
			// }
			// }
			// }	
		
	

			


?>