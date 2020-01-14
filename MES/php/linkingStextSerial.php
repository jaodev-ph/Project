<?php
//include_once("../classes/card.php");
/*include_once("../classes/serialformat.php");
include_once("../classes/logpass.php");
include_once("../classes/station.php");
include_once("../classes/modelRoute.php");*/
//include_once("../classes/batch.php");
//include_once("../classes/kanban_partsrecords.php");
include_once("../classes/linking.php");
session_start();


	$account = trim($_SESSION['account']);
	$name = $_SESSION['name'];
	$did = explode(" ",$_GET['did']);
	$model = $_GET['model'];
	$type = 'N';
	$station = $_GET['station'];

	$linkpartno = '';
	$kanbanpartno = '';
/*	$quantity = 0;*/

	
	$exist = Link2::DIDcheckExist($account,$did[0]);
	$kanban = new Link2();
	$kanban->pwbqty($did[0]);
	$quantity = $kanban->getQty();

	$kanban->pwblot($did[0]);
	$kanbanpartno = $kanban->getPartno();
	$kanbanstatus = $kanban->getStatus();

	$kanban->linkinfo($model,$station);
	$linkpartno = $kanban->getPartno();
	$linkstatus = $kanban->getStatus();

			if($exist == 'false'){
				echo 'error1_'.$_GET['did'].'_'.$quantity;
				return;
			}

			if($kanbanpartno<>$linkpartno){
				echo 'error2_'.$_GET['did'].'_'.$quantity;
				return;
			}

			if($kanbanstatus<>$linkstatus){
				echo 'error3_'.$_GET['did'].'_'.$quantity;
				return;
			}

			if($quantity <= 0){
				echo 'error4_'.$_GET['did'].'_'.$quantity;
				return;
			}


			echo 'success_'.$_GET['did'].'_'.$quantity;
		
		
	

			


?>