<?php
//include_once("../classes/card.php");
/*include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/modelRoute.php");*/
include_once("../classes/linking.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$batch = explode(" ",$_GET['batch']);
	// $model = $_GET['model']; 
	$type = '';

	//$Serial = new Link2($account,$did[0]);
	$exist = Link2::BatchCheckExist($account,$batch[0]);

			if($exist == 'true'){
				echo 'error1_'.$_GET['did'];
				return;
			}
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
		
			


			echo 'success_'.$batch[0];
			// }else{
			// 	echo 'wrongmodel_'.$_GET['serialno'];
			// }
			// }
			// }	
		
	

			


?>